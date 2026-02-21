@extends('layouts.admin')

@section('title', 'Departments')
@section('page-title', 'Departments')

@section('content')
    <div class="page-header-banner">
        <div class="page-header-text">
            <h1><i class="fa-solid fa-building"></i> Departments</h1>
            <p>Manage departments to scope data and user access.</p>
        </div>
    </div>

    @if(session('status'))
        <div class="alert success">
            <div class="alert-icon"><i class="fa-solid fa-check-circle"></i></div>
            <div class="alert-body">{{ session('status') }}</div>
        </div>
    @endif
    @if($errors->any())
        <div class="alert error">
            <div class="alert-icon"><i class="fa-solid fa-triangle-exclamation"></i></div>
            <div class="alert-body">Please fix the highlighted fields.</div>
        </div>
    @endif

    <div class="settings-card" style="margin-bottom: 24px;">
        <div class="settings-card-header">
            <h3>Create Department</h3>
            <p>Each user must belong to exactly one department.</p>
        </div>
        <div class="settings-card-body">
            <form class="settings-row" method="POST" action="{{ route('admin.departments.store') }}">
                @csrf
                <div class="settings-field" style="min-width: 260px;">
                    <label for="name">Department Name</label>
                    <input id="name" name="name" type="text" class="settings-input" value="{{ old('name') }}" required>
                    @error('name')<span class="field-error">{{ $message }}</span>@enderror
                </div>
                <div class="settings-field" style="min-width: 360px;">
                    <label for="description">Description</label>
                    <input id="description" name="description" type="text" class="settings-input" value="{{ old('description') }}">
                    @error('description')<span class="field-error">{{ $message }}</span>@enderror
                </div>
                <div class="settings-card-footer" style="align-self:flex-end; padding-left:0">
                    <button class="btn-primary-admin" type="submit"><i class="fa-solid fa-save"></i> Create Department</button>
                </div>
            </form>
        </div>
    </div>

    <div class="admin-table-card">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Slug</th>
                    <th>Description</th>
                    <th>Users</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($departments as $department)
                    <tr>
                        <td>
                            <form method="POST" action="{{ route('admin.departments.update', $department) }}" class="inline-edit-form">
                                @csrf
                                @method('PUT')
                                <input type="text" name="name" value="{{ $department->name }}" class="settings-input" style="min-width:200px;">
                        </td>
                        <td><code>{{ $department->slug }}</code></td>
                        <td>
                                <input type="text" name="description" value="{{ $department->description }}" class="settings-input" placeholder="Description" style="min-width:240px;">
                        </td>
                        <td>{{ $department->users()->count() }}</td>
                        <td>
                            <div class="table-actions">
                                    <button class="action-icon-btn" title="Save" type="submit"><i class="fa-solid fa-pen"></i></button>
                            </form>
                                <button class="action-icon-btn danger"
                                    data-action="{{ route('admin.departments.destroy', $department) }}"
                                    data-name="{{ $department->name }}"
                                    data-disabled="{{ $department->users()->count() > 0 ? 'true' : 'false' }}"
                                    title="Delete"
                                    @disabled($department->users()->count() > 0)>
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" style="text-align:center; padding:20px;">No departments yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Delete confirmation modal -->
    <div id="confirmModal" class="modal-backdrop" style="display:none;">
        <div class="modal-card">
            <h3><i class="fa-solid fa-triangle-exclamation"></i> Confirm Delete</h3>
            <p id="confirmText">Are you sure?</p>
            <div class="modal-actions">
                <button id="cancelDelete" class="btn-outline-admin" type="button">Cancel</button>
                <form id="deleteForm" method="POST" action="">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('styles')
<style>
.modal-backdrop {
    position: fixed;
    inset: 0;
    background: rgba(0,0,0,0.35);
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 1000;
}
.modal-card {
    background: var(--card-bg, #fff);
    color: var(--text, #1c1c1c);
    border-radius: 12px;
    box-shadow: 0 12px 32px rgba(0,0,0,0.18);
    padding: 20px 24px;
    max-width: 420px;
    width: 90%;
}
.modal-card h3 {
    margin: 0 0 8px;
    font-size: 18px;
}
.modal-card p {
    margin: 0 0 16px;
    line-height: 1.5;
}
.modal-actions {
    display: flex;
    gap: 12px;
    justify-content: flex-end;
    flex-wrap: wrap;
}
.btn-danger {
    background: #c0392b;
    color: #fff;
    border: none;
    padding: 10px 14px;
    border-radius: 8px;
    cursor: pointer;
}
.btn-danger:hover { background: #a83226; }
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    const modal = document.getElementById('confirmModal');
    const deleteForm = document.getElementById('deleteForm');
    const confirmText = document.getElementById('confirmText');
    const cancelBtn = document.getElementById('cancelDelete');

    document.querySelectorAll('.action-icon-btn.danger').forEach(btn => {
        btn.addEventListener('click', (e) => {
            const disabled = btn.getAttribute('data-disabled') === 'true';
            if (disabled) {
                e.preventDefault();
                return;
            }
            e.preventDefault();
            const action = btn.getAttribute('data-action');
            const name = btn.getAttribute('data-name');
            deleteForm.setAttribute('action', action);
            confirmText.textContent = `Delete department "${name}"? This cannot be undone.`;
            modal.style.display = 'flex';
        });
    });

    cancelBtn.addEventListener('click', (e) => {
        e.preventDefault();
        modal.style.display = 'none';
    });

    modal.addEventListener('click', (e) => {
        if (e.target === modal) {
            modal.style.display = 'none';
        }
    });
});
</script>
@endpush
