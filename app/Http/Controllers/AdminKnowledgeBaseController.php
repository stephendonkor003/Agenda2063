<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\KnowledgeCategory;
use App\Models\KnowledgeDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AdminKnowledgeBaseController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $canViewAll = $user->canDo('view-all-departments');

        $categories = KnowledgeCategory::orderBy('name')->get();
        $documents = KnowledgeDocument::with(['category', 'department'])
            ->when(! $canViewAll, fn ($q) => $q->where('department_id', $user->department_id))
            ->latest()
            ->get();

        $departments = $canViewAll ? Department::orderBy('name')->get() : collect([]);
        $stats = [
            'documents' => $documents->count(),
            'categories' => $categories->count(),
            'downloads' => $documents->sum('downloads'),
            'storage' => $documents->sum('size_bytes') / (1024 * 1024), // MB
        ];

        return view('admin.knowledge-base', compact('categories', 'documents', 'departments', 'stats', 'canViewAll'));
    }

    public function storeCategory(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'color' => ['nullable', 'string', 'max:32'],
            'description' => ['nullable', 'string'],
        ]);
        $data['slug'] = Str::slug($data['name']);
        KnowledgeCategory::create($data);

        return back()->with('status', 'Category created.');
    }

    public function updateCategory(Request $request, KnowledgeCategory $category)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'color' => ['nullable', 'string', 'max:32'],
            'description' => ['nullable', 'string'],
        ]);
        $data['slug'] = Str::slug($data['name']);
        $category->update($data);
        return back()->with('status', 'Category updated.');
    }

    public function destroyCategory(Request $request, KnowledgeCategory $category)
    {
        $category->delete();
        return back()->with('status', 'Category deleted.');
    }

    public function storeDocument(Request $request)
    {
        $data = $this->validateDocument($request);
        $user = $request->user();

        if ($data['type'] === 'file' && ! $request->hasFile('file_upload')) {
            return back()->withErrors(['file_upload' => 'Please upload a file.'])->withInput();
        }
        if ($data['type'] === 'link' && empty($data['source_url'])) {
            return back()->withErrors(['source_url' => 'A source URL is required for link type.'])->withInput();
        }

        if ($request->hasFile('file_upload')) {
            $path = $request->file('file_upload')->store('knowledge/docs', 'public');
            $data['file_path'] = $path;
            $data['mime'] = $request->file('file_upload')->getClientMimeType();
            $data['size_bytes'] = $request->file('file_upload')->getSize();
            $data['type'] = 'file';
        }

        $data['created_by'] = $user->id;
        $data['updated_by'] = $user->id;
        $data['department_id'] = $this->resolveDepartment($request);

        KnowledgeDocument::create($data);

        return back()->with('status', 'Document added.');
    }

    public function updateDocument(Request $request, KnowledgeDocument $document)
    {
        $this->authorizeDocument($request, $document);
        $data = $this->validateDocument($request, $document->id);

        if ($data['type'] === 'file' && ! $request->hasFile('file_upload') && ! $document->file_path) {
            return back()->withErrors(['file_upload' => 'Please upload a file.'])->withInput();
        }
        if ($data['type'] === 'link' && empty($data['source_url'])) {
            return back()->withErrors(['source_url' => 'A source URL is required for link type.'])->withInput();
        }

        if ($request->hasFile('file_upload')) {
            // delete old file if existed
            if ($document->file_path) {
                Storage::disk('public')->delete($document->file_path);
            }
            $path = $request->file('file_upload')->store('knowledge/docs', 'public');
            $data['file_path'] = $path;
            $data['mime'] = $request->file('file_upload')->getClientMimeType();
            $data['size_bytes'] = $request->file('file_upload')->getSize();
            $data['type'] = 'file';
        }

        $data['updated_by'] = $request->user()->id;
        $data['department_id'] = $this->resolveDepartment($request);

        $document->update($data);

        return back()->with('status', 'Document updated.');
    }

    public function destroyDocument(Request $request, KnowledgeDocument $document)
    {
        $this->authorizeDocument($request, $document);
        if ($document->file_path) {
            Storage::disk('public')->delete($document->file_path);
        }
        $document->delete();
        return back()->with('status', 'Document deleted.');
    }

    protected function validateDocument(Request $request, $ignoreId = null): array
    {
        $user = $request->user();
        $canViewAll = $user->canDo('view-all-departments');
        return $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'unique:knowledge_documents,slug,' . $ignoreId],
            'category_id' => ['nullable', 'exists:knowledge_categories,id'],
            'type' => ['required', 'in:file,link'],
            'status' => ['required', 'in:draft,published,archived'],
            'summary' => ['nullable', 'string'],
            'body' => ['nullable', 'string'],
            'source_url' => ['nullable', 'url'],
            'file_upload' => ['nullable', 'file', 'max:51200'], // 50MB
            'department_id' => [$canViewAll ? 'nullable' : 'prohibited', 'exists:departments,id'],
        ]);
    }

    protected function resolveDepartment(Request $request): ?int
    {
        $user = $request->user();
        if ($user->canDo('view-all-departments')) {
            return $request->input('department_id');
        }
        return $user->department_id;
    }

    protected function authorizeDocument(Request $request, KnowledgeDocument $document): void
    {
        $user = $request->user();
        if (! $user->canDo('view-all-departments') && $user->department_id !== $document->department_id) {
            abort(403);
        }
    }
}
