<?php

namespace App\Http\Controllers;

use App\Models\Publication;
use App\Models\PublicationFile;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Gate;
use App\Models\AuditLog;
use App\Notifications\ContentStatusNotification;

class AdminPublicationsController extends Controller
{
    public function index(Request $request)
    {
        $query = Publication::query();
        $user = $request->user();
        $canViewAll = $user->canDo('view-all-departments');
        if (! $canViewAll) {
            $query->where('department_id', $user->department_id);
        }

        if ($search = $request->string('q')->trim()) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('summary', 'like', "%{$search}%");
            });
        }

        if ($type = $request->input('type')) {
            $query->where('type', $type);
        }

        if ($lang = $request->input('language')) {
            $query->where('language', $lang);
        }

        if ($year = $request->input('year')) {
            $query->where('year', $year);
        }

        $publications = $query->latest()->paginate(15)->withQueryString();

        $base = $canViewAll ? Publication::query() : Publication::where('department_id', $user->department_id);
        $types = $base->clone()->select('type')->distinct()->pluck('type')->filter()->values();
        $languages = $base->clone()->select('language')->distinct()->pluck('language')->filter()->values();
        $years = $base->clone()->select('year')->distinct()->orderBy('year', 'desc')->pluck('year')->filter()->values();
        $departments = $canViewAll ? Department::orderBy('name')->get() : collect([]);

        return view('admin.publications', compact('publications', 'types', 'languages', 'years', 'departments', 'canViewAll'));
    }

    public function store(Request $request)
    {
        $data = $this->validated($request, null, $request->user());
        $data['slug'] = Str::slug($data['title']);
        $pub = Publication::create($data);

        $this->syncFiles($pub, $request);

        AuditLog::record('publication.created', $pub, $request->user(), [
            'title' => $pub->title,
        ], $request->ip());

        return back()->with('status', 'Publication created.');
    }

    public function update(Request $request, Publication $publication)
    {
        $data = $this->validated($request, $publication->id, $request->user());
        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['title']);
        }
        $publication->update($data);

        $this->syncFiles($publication, $request);

        AuditLog::record('publication.updated', $publication, $request->user(), [
            'title' => $publication->title,
        ], $request->ip());
        $this->notifyContent($publication, 'updated', $request->user());

        return back()->with('status', 'Publication updated.');
    }

    public function destroy(Publication $publication)
    {
        $publication->delete();
        AuditLog::record('publication.deleted', $publication, request()->user(), [
            'title' => $publication->title,
        ], request()->ip());
        return back()->with('status', 'Publication deleted.');
    }

    public function approve(Publication $publication, Request $request)
    {
        Gate::authorize('manage-content');
        $publication->update([
            'status' => 'approved',
            'approved_by' => $request->user()->id,
            'rejected_by' => null,
        ]);
        AuditLog::record('publication.approved', $publication, $request->user(), [
            'title' => $publication->title,
        ], $request->ip());
        $this->notifyContent($publication, 'approved', $request->user());
        return back()->with('status', 'Publication approved.');
    }

    public function reject(Publication $publication, Request $request)
    {
        Gate::authorize('manage-content');
        $publication->update([
            'status' => 'rejected',
            'rejected_by' => $request->user()->id,
            'approved_by' => null,
        ]);
        AuditLog::record('publication.rejected', $publication, $request->user(), [
            'title' => $publication->title,
        ], $request->ip());
        $this->notifyContent($publication, 'rejected', $request->user());
        return back()->with('status', 'Publication rejected.');
    }

    protected function notifyContent(Publication $pub, string $action, $actor): void
    {
        $url = route('admin.publications');
        if ($pub->creator) {
            $pub->creator->notify(new ContentStatusNotification(
                $pub->title,
                'publication',
                $action,
                $url,
                $actor->name ?? 'System'
            ));
        }
    }

    protected function validated(Request $request, $ignoreId = null, $user = null): array
    {
        $user = $user ?: $request->user();
        $canViewAll = $user?->canDo('view-all-departments');

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'unique:publications,slug,' . $ignoreId],
            'type' => ['required', 'string', 'max:100'],
            'language' => ['nullable', 'string', 'max:50'],
            'year' => ['nullable', 'integer', 'min:1900', 'max:' . date('Y')],
            'summary' => ['nullable', 'string'],
            'file_url' => ['nullable', 'url', 'max:500'], // legacy single link
            'files' => ['array'],
            'files.*.file_url' => ['required_with:files', 'url', 'max:500'],
            'files.*.label' => ['nullable', 'string', 'max:255'],
            'upload_files' => ['array'],
            'upload_files.*' => ['file', 'max:10240', 'mimes:pdf,doc,docx,xls,xlsx,ppt,pptx,txt'],
            'department_id' => [$canViewAll ? 'required' : 'nullable', 'exists:departments,id'],
            'status' => ['nullable', 'in:pending,approved,rejected'],
            'banner' => ['nullable', 'image', 'max:5120'],
        ]);

        $validated['department_id'] = $canViewAll
            ? $validated['department_id']
            : ($user?->department_id);

        if ($request->file('banner')) {
            $path = $request->file('banner')->store('publications/banners', 'public');
            $validated['image_url'] = Storage::url($path);
        }

        if (! $ignoreId) {
            $validated['created_by'] = $user?->id;
            $validated['status'] = 'pending';
        }

        return $validated;
    }

    protected function syncFiles(Publication $pub, Request $request): void
    {
        $files = collect($request->input('files', []))
            ->filter(fn ($f) => !empty($f['file_url']))
            ->values();

        // handle uploaded files and convert to file entries
        $uploads = collect($request->file('upload_files', []))
            ->filter()
            ->map(function ($file) {
                $path = $file->store('publications', 'public');
                return [
                    'file_url' => Storage::url($path),
                    'label' => $file->getClientOriginalName(),
                ];
            });

        $allFiles = $files->concat($uploads)->values();

        $pub->files()->delete();

        foreach ($allFiles as $file) {
            $pub->files()->create([
                'file_url' => $file['file_url'],
                'label' => $file['label'] ?? null,
            ]);
        }

        // Keep backward compatibility if single file_url provided
        if ($request->filled('file_url') && $files->isEmpty()) {
            $pub->files()->create([
                'file_url' => $request->input('file_url'),
                'label' => 'Primary File',
            ]);
        }
    }
}
