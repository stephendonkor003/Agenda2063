@extends('layouts.admin')

@section('title', 'Roles')
@section('page-title', 'Roles')

@section('content')
    <div class="page-header-banner">
        <div class="page-header-text">
            <h1><i class="fa-solid fa-user-shield"></i> Roles</h1>
            <p>Define roles and assign permissions.</p>
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
            <h3>Create Role</h3>
            <p>Step 1 — create the role. Step 2 — assign permissions below.</p>
        </div>
        <div class="settings-card-body">
            <form class="settings-row" method="POST" action="{{ route('admin.roles.store') }}">
                @csrf
                <div class="settings-field" style="min-width: 240px;">
                    <label for="name">Role Name</label>
                    <input id="name" name="name" type="text" class="settings-input" value="{{ old('name') }}" required>
                    @error('name')<span class="field-error">{{ $message }}</span>@enderror
                </div>
                <div class="settings-field" style="min-width: 320px;">
                    <label for="description">Description</label>
                    <input id="description" name="description" type="text" class="settings-input" value="{{ old('description') }}">
                    @error('description')<span class="field-error">{{ $message }}</span>@enderror
                </div>
                <div class="settings-card-footer" style="align-self:flex-end; padding-left:0">
                    <button class="btn-primary-admin" type="submit"><i class="fa-solid fa-plus"></i> Create Role</button>
                </div>
            </form>
        </div>
    </div>

    <div class="roles-grid">
        @forelse($roles as $role)
            <div class="role-card">
                <div class="role-card-head">
                    <div>
                        <div class="role-kicker">Role</div>
                        <h3>{{ $role->name }}</h3>
                        <p class="role-sub">{{ $role->description ?? 'No description' }}</p>
                        <p class="role-slug"><code>{{ $role->slug }}</code></p>
                    </div>
                    <form method="POST" action="{{ route('admin.roles.destroy', $role) }}" onsubmit="return confirm('Delete role {{ $role->name }}?')" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button class="action-icon-btn danger" title="Delete" @disabled($role->slug === 'super-admin')>
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </form>
                </div>

                <form method="POST" action="{{ route('admin.roles.update', $role) }}" class="permissions-form">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="name" value="{{ $role->name }}">
                    <input type="hidden" name="description" value="{{ $role->description }}">

                    <div class="permissions-grid">
                        @foreach($permissions as $perm)
                            <label class="perm-pill">
                                <input type="checkbox" name="permissions[]" value="{{ $perm->id }}" @checked($role->permissions->contains('id', $perm->id))>
                                <span>{{ $perm->name }}</span>
                            </label>
                        @endforeach
                    </div>

                    <div class="role-actions">
                        <span class="small-muted">Check permissions and save.</span>
                        <button class="btn-primary-admin" type="submit"><i class="fa-solid fa-link"></i> Save Permissions</button>
                    </div>
                </form>
            </div>
        @empty
            <p style="padding:20px;">No roles yet.</p>
        @endforelse
    </div>
@endsection

@push('styles')
<style>
.roles-grid {
    display: grid;
    gap: 16px;
    grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
}
.role-card {
    background: linear-gradient(180deg, #ffffff, #faf5f5);
    border: 1px solid #f1e6e8;
    border-radius: 12px;
    padding: 16px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.06);
}
.role-card-head {
    display: flex;
    justify-content: space-between;
    gap: 12px;
    align-items: flex-start;
    margin-bottom: 12px;
}
.role-kicker {
    text-transform: uppercase;
    letter-spacing: 0.1em;
    color: #9b1c2c;
    font-size: 11px;
    margin-bottom: 4px;
}
.role-card h3 {
    margin: 0;
    font-size: 18px;
}
.role-sub {
    margin: 4px 0 6px;
    color: #6b7280;
}
.role-slug {
    margin: 0;
    color: #9b1c2c;
}
.permissions-form {
    border-top: 1px solid #f1e6e8;
    padding-top: 12px;
}
.permissions-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
    gap: 10px;
    margin-bottom: 12px;
}
.perm-pill {
    display: flex;
    align-items: center;
    gap: 8px;
    padding: 10px 12px;
    border-radius: 10px;
    border: 1px solid #e5e7eb;
    background: #fff;
    box-shadow: 0 4px 12px rgba(0,0,0,0.03);
    cursor: pointer;
    transition: border-color 0.2s, box-shadow 0.2s;
}
.perm-pill input {
    accent-color: #9b1c2c;
}
.perm-pill:hover {
    border-color: #d1d5db;
    box-shadow: 0 8px 16px rgba(0,0,0,0.06);
}
.role-actions {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 12px;
}
.role-card .btn-primary-admin {
    background: #822b39;
    color: #fff;
    border: none;
}
.role-card .btn-primary-admin:hover {
    background: #6d202f;
}
.small-muted {
    color: #6b7280;
    font-size: 12px;
}
</style>
@endpush
