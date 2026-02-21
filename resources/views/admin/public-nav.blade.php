@extends('layouts.admin')

@section('title', 'Public Navigation')
@section('page-title', 'Public Navigation')

@section('content')
    <div class="page-header-banner">
        <div class="page-header-text">
            <h1><i class="fa-solid fa-eye"></i> Navigation (Header & Footer)</h1>
            <p>Manage visible links for the public site.</p>
        </div>
    </div>

    @if(session('status'))
        <div class="alert success"><div class="alert-icon"><i class="fa-solid fa-check-circle"></i></div><div class="alert-body">{{ session('status') }}</div></div>
    @endif

    <div class="settings-card">
        <div class="settings-card-header"><h3>Add Link</h3></div>
        <div class="settings-card-body">
            <form class="settings-row" method="POST" action="{{ route('admin.public.nav.store') }}">
                @csrf
                <div class="settings-field" style="min-width:220px;">
                    <label>Label</label>
                    <input type="text" name="label" class="settings-input" required>
                </div>
                <div class="settings-field" style="min-width:320px;">
                    <label>URL</label>
                    <input type="text" name="url" class="settings-input" placeholder="/about or https://" required>
                </div>
                <div class="settings-field" style="min-width:160px;">
                    <label>Location</label>
                    <select name="location" class="settings-select">
                        <option value="header">Header</option>
                        <option value="footer">Footer</option>
                    </select>
                </div>
                <div class="settings-field" style="min-width:140px;">
                    <label>Locale</label>
                    <select name="locale" class="settings-select">
                        @foreach(['en'=>'English','fr'=>'Français','ar'=>'Arabic','pt'=>'Português'] as $code => $label)
                            <option value="{{ $code }}">{{ $label }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="settings-field" style="min-width:120px;">
                    <label>Position</label>
                    <input type="number" name="position" class="settings-input" value="0">
                </div>
                <div class="settings-field" style="min-width:120px;">
                    <label>New Tab</label>
                    <input type="checkbox" name="open_in_new_tab" value="1">
                </div>
                <div class="settings-field" style="min-width:120px;">
                    <label>Active</label>
                    <input type="checkbox" name="is_active" value="1" checked>
                </div>
                <button class="btn-primary-admin" type="submit"><i class="fa-solid fa-save"></i> Save</button>
            </form>
        </div>
    </div>

    <div class="settings-card" style="margin-top:14px;">
        <div class="settings-card-header"><h3>Existing Links</h3></div>
        <div class="settings-card-body">
            <form method="POST" action="{{ route('admin.public.nav.reorder') }}" id="navOrderForm">
                @csrf
                <input type="hidden" name="order" id="navOrderInput">
                <table class="admin-table compact" id="navTable">
                    <thead><tr><th>#</th><th>Label</th><th>URL</th><th>Locale</th><th>Location</th><th>Active</th><th>New Tab</th><th>Position</th><th>Actions</th></tr></thead>
                    <tbody>
                    @foreach($links as $link)
                        <tr data-id="{{ $link->id }}">
                            <td class="drag-handle"><i class="fa-solid fa-grip-vertical"></i></td>
                        <td><a href="{{ route('admin.public.nav.design', $link) }}">{{ $link->label }}</a></td>
                            <td>{{ $link->url }}</td>
                            <td>{{ strtoupper($link->locale) }}</td>
                            <td>{{ ucfirst($link->location) }}</td>
                            <td>{{ $link->is_active ? 'Yes' : 'Draft' }}</td>
                            <td>{{ $link->open_in_new_tab ? 'Yes' : 'No' }}</td>
                            <td>{{ $link->position }}</td>
                            <td>
                                <form method="POST" action="{{ route('admin.public.nav.update', $link) }}" style="display:inline-block;">
                                    @csrf @method('PUT')
                                    <input type="hidden" name="label" value="{{ $link->label }}">
                                    <input type="hidden" name="url" value="{{ $link->url }}">
                                    <input type="hidden" name="location" value="{{ $link->location }}">
                                    <input type="hidden" name="position" value="{{ $link->position }}">
                                    <input type="hidden" name="open_in_new_tab" value="{{ $link->open_in_new_tab }}">
                                    <input type="hidden" name="is_active" value="{{ $link->is_active }}">
                                    <input type="hidden" name="locale" value="{{ $link->locale }}">
                                    <button class="action-icon-btn" title="Re-save"><i class="fa-solid fa-pen"></i></button>
                                </form>
                                <form method="POST" action="{{ route('admin.public.nav.destroy', $link) }}" style="display:inline-block;" onsubmit="return confirm('Delete {{ $link->label }}?')">
                                    @csrf @method('DELETE')
                                    <button class="action-icon-btn danger" title="Delete"><i class="fa-solid fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div style="margin-top:10px; display:flex; gap:10px; align-items:center;">
                    <button class="btn-primary-admin" type="submit"><i class="fa-solid fa-up-down-left-right"></i> Save Order</button>
                    <span class="text-muted">Drag rows to reorder, then click Save Order.</span>
                </div>
            </form>
        </div>
    </div>
@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    const tbody = document.querySelector('#navTable tbody');
    if (!tbody) return;
    let dragSrc;
    tbody.querySelectorAll('tr').forEach(row => {
        row.draggable = true;
        row.addEventListener('dragstart', e => { dragSrc = row; e.dataTransfer.effectAllowed = 'move'; });
        row.addEventListener('dragover', e => { e.preventDefault(); });
        row.addEventListener('drop', e => {
            e.preventDefault();
            if (dragSrc && dragSrc !== row) {
                row.parentNode.insertBefore(dragSrc, row.nextSibling);
            }
        });
    });
    document.getElementById('navOrderForm').addEventListener('submit', e => {
        const ids = Array.from(tbody.querySelectorAll('tr')).map(r => r.dataset.id);
        document.getElementById('navOrderInput').value = JSON.stringify(ids);
    });
});
</script>
@endpush
@endsection
