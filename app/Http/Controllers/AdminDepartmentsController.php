<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\User;
use App\Models\Publication;
use App\Models\NewsItem;
use App\Models\KnowledgeDocument;
use App\Models\FlagshipProject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class AdminDepartmentsController extends Controller
{
    public function index()
    {
        Gate::authorize('manage-users');

        $departments = Department::withCount(['users', 'news', 'publications', 'knowledgeDocuments', 'flagshipProjects'])
            ->orderBy('name')
            ->get();

        return view('admin.departments', compact('departments'));
    }

    public function store(Request $request)
    {
        Gate::authorize('manage-users');

        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', Rule::unique('departments', 'name')->whereNull('deleted_at')],
            'description' => ['nullable', 'string', 'max:500'],
        ]);

        Department::create([
            'name' => $data['name'],
            'slug' => Str::slug($data['name']),
            'description' => $data['description'] ?? null,
        ]);

        return back()->with('status', 'Department created.');
    }

    public function update(Request $request, Department $department)
    {
        Gate::authorize('manage-users');

        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', Rule::unique('departments', 'name')->ignore($department->id)->whereNull('deleted_at')],
            'description' => ['nullable', 'string', 'max:500'],
        ]);

        $department->update([
            'name' => $data['name'],
            'slug' => Str::slug($data['name']),
            'description' => $data['description'] ?? null,
        ]);

        return back()->with('status', 'Department updated.');
    }

    public function destroy(Request $request, Department $department)
    {
        Gate::authorize('manage-users');

        $data = $request->validate([
            'reassign_to' => ['nullable', 'exists:departments,id'],
        ]);

        $reassignTo = $data['reassign_to'] ?? null;

        if ($reassignTo && (int) $reassignTo === (int) $department->id) {
            return back()->withErrors(['department' => 'Reassignment target must be a different department.']);
        }

        $contentCounts = [
            'users' => $department->users()->count(),
            'news' => $department->news()->count(),
            'publications' => $department->publications()->count(),
            'knowledge' => $department->knowledgeDocuments()->count(),
            'flagships' => $department->flagshipProjects()->count(),
        ];

        $totalLinked = array_sum($contentCounts);
        if ($totalLinked > 0 && ! $reassignTo) {
            return back()->withErrors(['department' => 'This department has linked records. Choose a department to reassign users/content before deletion.']);
        }

        $target = $reassignTo
            ? Department::where('id', $reassignTo)->whereNull('deleted_at')->first()
            : null;

        DB::transaction(function () use ($department, $target) {
            if ($target) {
                User::where('department_id', $department->id)->update(['department_id' => $target->id]);
                Publication::where('department_id', $department->id)->update(['department_id' => $target->id]);
                NewsItem::where('department_id', $department->id)->update(['department_id' => $target->id]);
                KnowledgeDocument::where('department_id', $department->id)->update(['department_id' => $target->id]);
                FlagshipProject::where('department_id', $department->id)->update(['department_id' => $target->id]);
            }
            $department->delete();
        });

        return back()->with('status', 'Department archived' . ($target ? ' and content reassigned.' : '.'));
    }
}
