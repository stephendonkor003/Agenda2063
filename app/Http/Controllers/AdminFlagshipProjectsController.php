<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\FlagshipProject;
use App\Models\FlagshipUpdate;
use App\Models\AuditLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Notifications\ContentStatusNotification;

class AdminFlagshipProjectsController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $canViewAll = $user->canDo('view-all-departments');

        $projects = FlagshipProject::query()
            ->with(['updates.files'])
            ->when(! $canViewAll, fn ($q) => $q->where('department_id', $user->department_id))
            ->latest()
            ->get();

        $departments = $canViewAll ? Department::orderBy('name')->get() : collect([]);

        return view('admin.flagship-projects', compact('projects', 'departments', 'canViewAll'));
    }

    public function storeProject(Request $request)
    {
        $data = $this->validateProject($request);
        if ($request->file('banner')) {
            $path = $request->file('banner')->store('flagships/banners', 'public');
            $data['image_url'] = Storage::url($path);
        }
        $data['created_by'] = $request->user()->id;
        $data['updated_by'] = $request->user()->id;
        FlagshipProject::create($data);

        return back()->with('status', 'Flagship project created.');
    }

    public function updateProject(Request $request, FlagshipProject $project)
    {
        $this->authorizeProject($request, $project);
        $data = $this->validateProject($request, $project->id);
        if ($request->file('banner')) {
            $path = $request->file('banner')->store('flagships/banners', 'public');
            $data['image_url'] = Storage::url($path);
        }
        $data['updated_by'] = $request->user()->id;
        $project->update($data);

        return back()->with('status', 'Flagship project updated.');
    }

    public function destroyProject(Request $request, FlagshipProject $project)
    {
        $this->authorizeProject($request, $project);
        $project->delete();
        return back()->with('status', 'Flagship project deleted.');
    }

    public function storeUpdate(Request $request, FlagshipProject $flagship_project)
    {
        $this->authorizeProject($request, $flagship_project);
        $data = $this->validateUpdate($request);

        $update = FlagshipUpdate::create([
            ...$data,
            'flagship_project_id' => $flagship_project->id,
            'created_by' => $request->user()->id,
        ]);

        $this->syncUpdateFiles($update, $request);

        AuditLog::record('flagship_update.created', $update, $request->user(), [
            'title' => $update->title,
        ], $request->ip());
        $this->notifyUpdate($update, 'created', $request->user());

        return back()->with('status', 'Flagship update added.');
    }

    public function editProject(Request $request, FlagshipProject $flagship_project)
    {
        $this->authorizeProject($request, $flagship_project);
        $user = $request->user();
        $departments = $user->canDo('view-all-departments') ? Department::orderBy('name')->get() : collect([]);
        return view('admin.flagship-projects-edit', [
            'project' => $flagship_project,
            'departments' => $departments,
            'canViewAll' => $user->canDo('view-all-departments'),
        ]);
    }

    public function createUpdate(Request $request, FlagshipProject $flagship_project)
    {
        $this->authorizeProject($request, $flagship_project);
        return view('admin.flagship-updates-create', ['project' => $flagship_project]);
    }

    public function editUpdate(Request $request, FlagshipProject $flagship_project, FlagshipUpdate $flagship_update)
    {
        $this->authorizeProject($request, $flagship_project);
        return view('admin.flagship-updates-edit', [
            'project' => $flagship_project,
            'update' => $flagship_update,
        ]);
    }

    public function updateUpdate(Request $request, FlagshipProject $flagship_project, FlagshipUpdate $flagship_update)
    {
        $this->authorizeProject($request, $flagship_project);
        $data = $this->validateUpdate($request, $flagship_update->id);
        $flagship_update->update([
            ...$data,
            'flagship_project_id' => $flagship_project->id,
        ]);
        $this->syncUpdateFiles($flagship_update, $request);
        AuditLog::record('flagship_update.updated', $flagship_update, $request->user(), [
            'title' => $flagship_update->title,
        ], $request->ip());
        $this->notifyUpdate($flagship_update, 'updated', $request->user());
        return redirect()->route('admin.flagship-projects')->with('status', 'Update saved.');
    }

    public function approveUpdate(Request $request, FlagshipUpdate $flagship_update)
    {
        \Gate::authorize('manage-content');
        $flagship_update->update([
            'status' => 'approved',
            'approved_by' => $request->user()->id,
            'rejected_by' => null,
        ]);
        AuditLog::record('flagship_update.approved', $flagship_update, $request->user(), [
            'title' => $flagship_update->title,
        ], $request->ip());
        $this->notifyUpdate($flagship_update, 'approved', $request->user());
        return back()->with('status', 'Update approved.');
    }

    public function rejectUpdate(Request $request, FlagshipUpdate $flagship_update)
    {
        \Gate::authorize('manage-content');
        $flagship_update->update([
            'status' => 'rejected',
            'rejected_by' => $request->user()->id,
            'approved_by' => null,
        ]);
        AuditLog::record('flagship_update.rejected', $flagship_update, $request->user(), [
            'title' => $flagship_update->title,
        ], $request->ip());
        $this->notifyUpdate($flagship_update, 'rejected', $request->user());
        return back()->with('status', 'Update rejected.');
    }

    public function destroyUpdate(Request $request, FlagshipUpdate $update)
    {
        $project = $update->project;
        if (! $project) {
            abort(404, 'Associated project not found.');
        }
        $this->authorizeProject($request, $project);
        $update->delete();
        return back()->with('status', 'Update deleted.');
    }

    protected function authorizeProject(Request $request, FlagshipProject $project): void
    {
        $user = $request->user();
        if (! $user->canDo('view-all-departments') && $user->department_id !== $project->department_id) {
            abort(403);
        }
    }

    protected function validateProject(Request $request, $ignoreId = null): array
    {
        $user = $request->user();
        $canViewAll = $user->canDo('view-all-departments');
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'unique:flagship_projects,slug,' . $ignoreId],
            'status' => ['required', 'in:active,on-hold,completed'],
            'progress' => ['required', 'numeric', 'min:0', 'max:100'],
            'summary' => ['nullable', 'string'],
            'department_id' => [$canViewAll ? 'required' : 'nullable', 'exists:departments,id'],
            // allow up to 20MB images for banners
            'banner' => ['nullable', 'image', 'max:20480'],
        ]);
        $validated['department_id'] = $canViewAll ? $validated['department_id'] : $user->department_id;
        $validated['slug'] = $validated['slug'] ?? Str::slug($validated['title']);
        return $validated;
    }

    protected function validateUpdate(Request $request, $ignoreId = null): array
    {
        return $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'type' => ['required', 'in:update,news,article'],
            'status' => ['required', 'in:pending,approved,rejected'],
            'body' => ['nullable', 'string'],
            'published_at' => ['nullable', 'date'],
            'files' => ['array'],
            'files.*.file_url' => ['nullable', 'url', 'max:500'],
            'files.*.label' => ['nullable', 'string', 'max:255'],
            'upload_files' => ['array'],
            'upload_files.*' => ['file', 'max:10240'],
            'flagship_project_id' => ['sometimes','exists:flagship_projects,id'],
        ]);
    }

    protected function syncUpdateFiles(FlagshipUpdate $update, Request $request): void
    {
        $files = collect($request->input('files', []))
            ->filter(fn ($f) => !empty($f['file_url']))
            ->values();

        $uploads = collect($request->file('upload_files', []))
            ->filter()
            ->map(function ($file) {
                $path = $file->store('flagships/files', 'public');
                return [
                    'file_url' => Storage::url($path),
                    'label' => $file->getClientOriginalName(),
                ];
            });

        $update->files()->delete();
        foreach ($files->concat($uploads) as $file) {
            $update->files()->create([
                'file_url' => $file['file_url'],
                'label' => $file['label'] ?? null,
            ]);
        }
    }

    protected function notifyUpdate(FlagshipUpdate $update, string $action, $actor): void
    {
        $url = route('admin.flagship-projects');
        if ($update->creator) {
            $update->creator->notify(new ContentStatusNotification(
                $update->title,
                'flagship update',
                $action,
                $url,
                $actor->name ?? 'System'
            ));
        }
    }
}
