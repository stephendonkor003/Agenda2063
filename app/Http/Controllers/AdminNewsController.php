<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\NewsAttachment;
use App\Models\NewsCategory;
use App\Models\NewsItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AdminNewsController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $canViewAll = $user->canDo('view-all-departments');

        $items = NewsItem::with(['attachments','category'])
            ->when(! $canViewAll, fn ($q) => $q->where('department_id', $user->department_id))
            ->latest()
            ->get();

        $categories = NewsCategory::orderBy('name')->get();
        $departments = $canViewAll ? Department::orderBy('name')->get() : collect([]);

        $stats = [
            'articles' => $items->where('type', 'article')->count(),
            'events' => $items->where('type', 'event')->count(),
            'press' => $items->where('type', 'press')->count(),
            'drafts' => $items->where('status', 'draft')->count(),
        ];

        return view('admin.news', compact('items', 'categories', 'departments', 'stats', 'canViewAll'));
    }

    public function store(Request $request)
    {
        $data = $this->validateNews($request);
        $user = $request->user();
        $data['department_id'] = $this->resolveDepartment($request);
        // keep legacy text category for backwards compatibility
        if ($data['category_id']) {
            $cat = NewsCategory::find($data['category_id']);
            $data['category'] = $cat?->name;
        }
        $data['created_by'] = $user->id;
        $data['updated_by'] = $user->id;
        $data['slug'] = $data['slug'] ?? Str::slug($data['title'] . '-' . now()->timestamp);

        if ($request->hasFile('banner')) {
            $path = $request->file('banner')->store('news/banners', 'public');
            $data['banner_path'] = $path;
        }

        $item = NewsItem::create($data);
        $this->syncAttachments($item, $request);

        return back()->with('status', 'News item created.');
    }

    public function update(Request $request, NewsItem $news)
    {
        $this->authorizeNews($request, $news);
        $data = $this->validateNews($request, $news->id);
        $data['department_id'] = $this->resolveDepartment($request);
        if ($data['category_id']) {
            $cat = NewsCategory::find($data['category_id']);
            $data['category'] = $cat?->name;
        }
        $data['updated_by'] = $request->user()->id;

        if ($request->hasFile('banner')) {
            if ($news->banner_path) {
                Storage::disk('public')->delete($news->banner_path);
            }
            $path = $request->file('banner')->store('news/banners', 'public');
            $data['banner_path'] = $path;
        }

        $news->update($data);
        $this->syncAttachments($news, $request);

        return back()->with('status', 'News item updated.');
    }

    public function destroy(Request $request, NewsItem $news)
    {
        $this->authorizeNews($request, $news);
        if ($news->banner_path) {
            Storage::disk('public')->delete($news->banner_path);
        }
        foreach ($news->attachments as $att) {
            if ($att->file_path) {
                Storage::disk('public')->delete($att->file_path);
            }
        }
        $news->delete();
        return back()->with('status', 'News item deleted.');
    }

    public function create(Request $request)
    {
        return $this->formView($request, new NewsItem(), 'article');
    }

    public function createEvent(Request $request)
    {
        return $this->formView($request, new NewsItem(['type'=>'event']), 'event');
    }

    public function edit(Request $request, NewsItem $news)
    {
        $this->authorizeNews($request, $news);
        return $this->formView($request, $news, $news->type, true);
    }

    public function show(Request $request, NewsItem $news)
    {
        $this->authorizeNews($request, $news);
        return view('admin.news-show', ['item' => $news->load('attachments','category','department')]);
    }

    protected function formView(Request $request, NewsItem $news, string $type, bool $isEdit = false)
    {
        $user = $request->user();
        $canViewAll = $user->canDo('view-all-departments');
        $departments = $canViewAll ? Department::orderBy('name')->get() : collect([]);
        $categories = NewsCategory::where('type', $type === 'press' ? 'press' : ($type === 'event' ? 'event' : 'news'))
            ->orderBy('name')->get();

        return view('admin.news-form', [
            'item' => $news,
            'type' => $type,
            'categories' => $categories,
            'departments' => $departments,
            'canViewAll' => $canViewAll,
            'isEdit' => $isEdit,
        ]);
    }

    protected function validateNews(Request $request, $ignoreId = null): array
    {
        $user = $request->user();
        $canViewAll = $user->canDo('view-all-departments');
        return $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'unique:news_items,slug,' . $ignoreId],
            'type' => ['required', 'in:article,event,press'],
            'status' => ['required', 'in:draft,published,scheduled'],
            'category' => ['nullable', 'string', 'max:120'],
            'category_id' => ['nullable', 'exists:news_categories,id'],
            'summary' => ['nullable', 'string'],
            'body' => ['nullable', 'string'],
            'published_at' => ['nullable', 'date'],
            'starts_at' => ['nullable', 'date'],
            'ends_at' => ['nullable', 'date', 'after_or_equal:starts_at'],
            'location' => ['nullable', 'string', 'max:255'],
            'country_code' => ['nullable', 'string', 'max:3'],
            'region_code' => ['nullable', 'string', 'max:10'],
            'featured' => ['nullable', 'boolean'],
            'banner' => ['nullable', 'image', 'max:20480'],
            'attachments.*.label' => ['nullable', 'string', 'max:255'],
            'attachments.*.file_url' => ['nullable', 'url'],
            'upload_files.*' => ['nullable', 'file', 'max:51200'],
            'department_id' => [$canViewAll ? 'nullable' : 'prohibited', 'exists:departments,id'],
        ]);
    }

    protected function resolveDepartment(Request $request): ?int
    {
        $user = $request->user();
        return $user->canDo('view-all-departments') ? $request->input('department_id') : $user->department_id;
    }

    protected function authorizeNews(Request $request, NewsItem $news): void
    {
        $user = $request->user();
        if (! $user->canDo('view-all-departments') && $user->department_id !== $news->department_id) {
            abort(403);
        }
    }

    protected function syncAttachments(NewsItem $item, Request $request): void
    {
        $links = $request->input('attachments', []);
        $item->attachments()->delete();
        foreach ($links as $att) {
            if (empty($att['file_url'])) continue;
            $item->attachments()->create([
                'label' => $att['label'] ?? null,
                'file_url' => $att['file_url'],
            ]);
        }

        if ($request->hasFile('upload_files')) {
            foreach ($request->file('upload_files') as $file) {
                if (! $file) continue;
                $path = $file->store('news/files', 'public');
                $item->attachments()->create([
                    'label' => $file->getClientOriginalName(),
                    'file_path' => $path,
                    'mime' => $file->getClientMimeType(),
                    'size_bytes' => $file->getSize(),
                ]);
            }
        }
    }
}
