@extends('layouts.admin')

@section('title', 'Users')
@section('page-title', 'Users')

@section('content')

    <div class="page-header-banner">
        <div class="page-header-text">
            <h1><i class="fa-solid fa-users"></i> User Management</h1>
            <p>Manage admin users, roles, and access permissions.</p>
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

    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon blue"><i class="fa-solid fa-users"></i></div>
            <div class="stat-details">
                <span class="stat-number">{{ $stats['total'] }}</span>
                <span class="stat-label">Total Users</span>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon green"><i class="fa-solid fa-user-check"></i></div>
            <div class="stat-details">
                <span class="stat-number">{{ $stats['active'] }}</span>
                <span class="stat-label">Active (verified)</span>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon gold"><i class="fa-solid fa-user-shield"></i></div>
            <div class="stat-details">
                <span class="stat-number">{{ $stats['super_admins'] }}</span>
                <span class="stat-label">Super Admins</span>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon maroon"><i class="fa-solid fa-user-clock"></i></div>
            <div class="stat-details">
                <span class="stat-number">{{ $stats['inactive'] }}</span>
                <span class="stat-label">Inactive</span>
            </div>
        </div>
    </div>

    <div class="admin-toolbar" style="flex-wrap: wrap; gap: 12px;">
        <div class="toolbar-search">
            <i class="fa-solid fa-search"></i>
            <input type="text" placeholder="Search users by name or email..." oninput="filterTable(this.value)">
        </div>
        <div style="flex:1"></div>
        <button class="btn-primary-admin" onclick="document.getElementById('createUserCard').scrollIntoView({behavior:'smooth'});">
            <i class="fa-solid fa-user-plus"></i> Add User
        </button>
    </div>

    <div class="settings-card" id="createUserCard" style="margin-bottom: 24px;">
        <div class="settings-card-header">
            <h3>Create User</h3>
            <p>New users default to password <code>ChangeMe123!</code>; ask them to update after first login.</p>
        </div>
        <div class="settings-card-body">
            <form class="settings-row" method="POST" action="{{ route('admin.users.store') }}">
                @csrf
                <div class="settings-field" style="min-width: 220px;">
                    <label for="name">Full Name</label>
                    <input id="name" name="name" type="text" class="settings-input" value="{{ old('name') }}" required>
                    @error('name')<span class="field-error">{{ $message }}</span>@enderror
                </div>
                <div class="settings-field" style="min-width: 240px;">
                    <label for="email">Email</label>
                    <input id="email" name="email" type="email" class="settings-input" value="{{ old('email') }}" required>
                    @error('email')<span class="field-error">{{ $message }}</span>@enderror
                </div>
                <div class="settings-field" style="min-width: 200px;">
                    <label for="department_id">Department</label>
                    <select id="department_id" name="department_id" class="settings-select" required>
                        @foreach($departments as $department)
                            <option value="{{ $department->id }}" @selected(old('department_id') == $department->id)>{{ $department->name }}</option>
                        @endforeach
                    </select>
                    @error('department_id')<span class="field-error">{{ $message }}</span>@enderror
                </div>
                <div class="settings-field" style="min-width: 240px;">
                    <label for="role_id">Role</label>
                    <select id="role_id" name="role_id" class="settings-select">
                        <option value="">Select role</option>
                        @foreach($roles as $role)
                            <option value="{{ $role->id }}" @selected(old('role_id') == $role->id)>{{ $role->name }}</option>
                        @endforeach
                    </select>
                    @error('role_id')<span class="field-error">{{ $message }}</span>@enderror
                </div>
                <div class="settings-card-footer" style="align-self:flex-end; padding-left:0">
                    <button class="btn-primary-admin" type="submit"><i class="fa-solid fa-save"></i> Create User</button>
                </div>
            </form>
        </div>
    </div>

    <div class="admin-table-card">
        <table class="admin-table" id="usersTable">
            <thead>
                <tr>
                    <th>User</th>
                    <th>Department</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th>Created</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $u)
                    <tr>
                        <td>
                            <div class="user-cell">
                                <div class="user-cell-avatar" style="background: linear-gradient(135deg, #822b39, #991b35);">
                                    <span>{{ strtoupper(substr($u->name, 0, 1)) }}</span>
                                </div>
                                <div>
                                    <span class="table-title">{{ $u->name }}</span>
                                    <span class="table-subtitle">{{ $u->email }}</span>
                                </div>
                            </div>
                        </td>
                        <td>{{ $u->department?->name ?? '—' }}</td>
                        <td>
                            @if($u->roles->first())
                                <span class="role-badge {{ str_replace(' ', '-', strtolower($u->roles->first()->slug)) }}">{{ $u->roles->first()->name }}</span>
                            @else
                                <span class="role-badge viewer">None</span>
                            @endif
                        </td>
                        <td>
                            @if($u->email_verified_at)
                                <span class="status-badge published">Active</span>
                            @else
                                <span class="status-badge draft">Inactive</span>
                            @endif
                        </td>
                        <td>{{ $u->created_at?->format('M d, Y') }}</td>
                        <td>
                            <div class="table-actions">
                                <button class="action-icon-btn"
                                    title="Edit"
                                    type="button"
                                    data-id="{{ $u->id }}"
                                    data-action="{{ route('admin.users.update', $u) }}"
                                    data-name="{{ $u->name }}"
                                    data-email="{{ $u->email }}"
                                    data-department="{{ $u->department_id }}"
                                    data-role="{{ $u->roles->first()->id ?? '' }}"
                                    data-admin="{{ $u->is_admin ? '1' : '0' }}"
                                    onclick="openEditModal(this)">
                                    <i class="fa-solid fa-pen"></i>
                                </button>
                                <form method="POST" action="{{ route('admin.users.destroy', $u) }}" onsubmit="return confirm('Delete {{ $u->name }}?')" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button class="action-icon-btn danger" title="Delete"><i class="fa-solid fa-trash"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" style="text-align:center; padding:20px;">No users found for your department.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Edit User Modal -->
    <div id="editUserModal" class="modal-backdrop" style="display:none;">
        <div class="modal-card">
            <div class="modal-head">
                <div>
                    <p class="modal-kicker">User</p>
                    <h3><i class="fa-solid fa-pen-to-square"></i> Edit User</h3>
                </div>
                <button class="modal-close" type="button" onclick="closeEditModal()"><i class="fa-solid fa-xmark"></i></button>
            </div>
            <p class="modal-sub">Update details, department, role, and privileges.</p>
            <form id="editUserForm" method="POST" action="">
                @csrf
                @method('PUT')
                <div class="settings-field">
                    <label for="edit_name">Full Name</label>
                    <input id="edit_name" name="name" type="text" class="settings-input" required>
                </div>
                <div class="settings-field">
                    <label for="edit_email">Email</label>
                    <input id="edit_email" name="email" type="email" class="settings-input" required>
                </div>
                <div class="settings-row">
                    <div class="settings-field" style="min-width:220px;">
                        <label for="edit_department">Department</label>
                        <select id="edit_department" name="department_id" class="settings-select" required>
                            @foreach($departments as $department)
                                <option value="{{ $department->id }}">{{ $department->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="settings-field" style="min-width:220px;">
                        <label for="edit_role">Role</label>
                        <select id="edit_role" name="role_id" class="settings-select">
                            <option value="">Select role</option>
                            @foreach($roles as $role)
                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="settings-field" style="display:flex; gap:8px; align-items:center;">
                    <input type="hidden" name="is_admin" value="0">
                    <input id="edit_admin" name="is_admin" type="checkbox" value="1" style="width:auto;">
                    <label for="edit_admin" style="margin:0;">Super Admin (all-access)</label>
                </div>
                <div class="modal-actions">
                    <button type="button" class="btn-outline-admin" onclick="closeEditModal()">Cancel</button>
                    <button type="submit" class="btn-primary-admin"><i class="fa-solid fa-save"></i> Save Changes</button>
                </div>
            </form>
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
    max-width: 520px;
    width: 90%;
}
.modal-head {
    display:flex;
    justify-content:space-between;
    align-items:flex-start;
    gap:12px;
}
.modal-kicker {
    text-transform: uppercase;
    letter-spacing: 0.08em;
    color: #6b7280;
    font-size: 11px;
    margin: 0 0 2px;
}
.modal-card h3 {
    margin: 0;
    font-size: 20px;
}
.modal-sub {
    margin: 6px 0 14px;
    color: #6b7280;
}
.modal-close {
    border: none;
    background: transparent;
    color: #6b7280;
    font-size: 18px;
    cursor: pointer;
}
.modal-actions {
    display: flex;
    gap: 12px;
    justify-content: flex-end;
    flex-wrap: wrap;
}
.modal-card .btn-primary-admin {
    background: #822b39;
    color: #fff;
    border: none;
}
.modal-card .btn-primary-admin:hover {
    background: #6d202f;
}
.modal-card .btn-outline-admin {
    border: 1px solid #d1d5db;
    color: #374151;
    background: #fff;
}
.modal-card .btn-outline-admin:hover {
    border-color: #9ca3af;
    color: #111827;
}
</style>
@endpush
@push('scripts')
<script>
function filterTable(query) {
    query = query.toLowerCase();
    document.querySelectorAll('#usersTable tbody tr').forEach(row => {
        const text = row.innerText.toLowerCase();
        row.style.display = text.includes(query) ? '' : 'none';
    });
}

function openEditModal(btn) {
    const modal = document.getElementById('editUserModal');
    const form = document.getElementById('editUserForm');
    form.action = btn.getAttribute('data-action');

    document.getElementById('edit_name').value = btn.getAttribute('data-name');
    document.getElementById('edit_email').value = btn.getAttribute('data-email');
    document.getElementById('edit_department').value = btn.getAttribute('data-department');
    document.getElementById('edit_role').value = btn.getAttribute('data-role') || '';
    document.getElementById('edit_admin').checked = btn.getAttribute('data-admin') === '1';

    modal.style.display = 'flex';
}

function closeEditModal() {
    document.getElementById('editUserModal').style.display = 'none';
}

document.addEventListener('DOMContentLoaded', () => {
    document.getElementById('editUserModal')?.addEventListener('click', (e) => {
        if (e.target.id === 'editUserModal') closeEditModal();
    });
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') closeEditModal();
    });
});
</script>
@endpush
