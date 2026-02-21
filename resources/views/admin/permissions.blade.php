@extends('layouts.admin')

@section('title', 'Permissions')
@section('page-title', 'Permissions')

@section('content')
    <div class="page-header-banner">
        <div class="page-header-text">
            <h1><i class="fa-solid fa-key"></i> Permissions</h1>
            <p>Atomic capabilities that can be attached to roles.</p>
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
            <h3>Create Permission</h3>
            <p>Keep names short and action-focused, e.g. “Manage Users”.</p>
        </div>
        <div class="settings-card-body">
            <form class="settings-row" method="POST" action="{{ route('admin.permissions.store') }}">
                @csrf
                <div class="settings-field" style="min-width: 260px;">
                    <label for="name">Permission Name</label>
                    <input id="name" name="name" type="text" class="settings-input" value="{{ old('name') }}" required>
                    @error('name')<span class="field-error">{{ $message }}</span>@enderror
                </div>
                <div class="settings-field" style="min-width: 360px;">
                    <label for="description">Description</label>
                    <input id="description" name="description" type="text" class="settings-input" value="{{ old('description') }}">
                    @error('description')<span class="field-error">{{ $message }}</span>@enderror
                </div>
                <div class="settings-card-footer" style="align-self:flex-end; padding-left:0">
                    <button class="btn-primary-admin" type="submit"><i class="fa-solid fa-save"></i> Create Permission</button>
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
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($permissions as $permission)
                    <tr>
                        <td>{{ $permission->name }}</td>
                        <td><code>{{ $permission->slug }}</code></td>
                        <td>{{ $permission->description ?? '—' }}</td>
                        <td>
                            <div class="table-actions">
                                <form method="POST" action="{{ route('admin.permissions.update', $permission) }}" style="display:inline-flex; gap:8px; align-items:center;">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="name" value="{{ $permission->name }}">
                                    <input type="hidden" name="description" value="{{ $permission->description }}">
                                    <button class="action-icon-btn" title="Quick save" type="submit"><i class="fa-solid fa-pen"></i></button>
                                </form>
                                <form method="POST" action="{{ route('admin.permissions.destroy', $permission) }}" onsubmit="return confirm('Delete permission {{ $permission->name }}?')" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button class="action-icon-btn danger" title="Delete"
                                        @disabled(in_array($permission->slug, ['manage-users','view-all-departments']))>
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" style="text-align:center; padding:20px;">No permissions yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
