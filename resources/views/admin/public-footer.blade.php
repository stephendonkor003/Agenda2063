@extends('layouts.admin')

@section('title', 'Footer Links')
@section('page-title', 'Footer Links')

@section('content')
    <div class="page-header-banner">
        <div class="page-header-text">
            <h1><i class="fa-solid fa-link"></i> Footer Links</h1>
            <p>Manage footer sections for the public site.</p>
        </div>
    </div>

    @if(session('status'))
        <div class="alert success"><div class="alert-icon"><i class="fa-solid fa-check-circle"></i></div><div class="alert-body">{{ session('status') }}</div></div>
    @endif

    <div class="settings-card">
        <div class="settings-card-header"><h3>Add Footer Link</h3></div>
        <div class="settings-card-body">
            <form class="settings-row" method="POST" action="{{ route('admin.public.footer.store') }}">
                @csrf
                <div class="settings-field" style="min-width:220px;">
                    <label>Label</label>
                    <input type="text" name="label" class="settings-input" required>
                </div>
                <div class="settings-field" style="min-width:320px;">
                    <label>URL</label>
                    <input type="text" name="url" class="settings-input" placeholder="/about or https://" required>
                </div>
                <div class="settings-field" style="min-width:200px;">
                    <label>Section</label>
                    <input type="text" name="section" class="settings-input" placeholder="about, resources, legal, social" required>
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
                    <label>New Tab</label><br>
                    <input type="checkbox" name="open_in_new_tab" value="1">
                </div>
                <div class="settings-field" style="min-width:120px;">
                    <label>Active</label><br>
                    <input type="checkbox" name="is_active" value="1" checked>
                </div>
                <button class="btn-primary-admin" type="submit"><i class="fa-solid fa-save"></i> Save</button>
            </form>
            <p class="text-muted" style="margin-top:10px;">
                Use an internal path such as <code>/contact</code> or <code>/privacy-notice</code> when the footer link should open a full CMS page.
                External URLs will continue to redirect directly.
            </p>
        </div>
    </div>

    <div class="settings-card" style="margin-top:14px;">
        <div class="settings-card-header"><h3>Existing Footer Links</h3></div>
        <div class="settings-card-body">
            <form method="POST" action="{{ route('admin.public.footer.reorder') }}" id="footerOrderForm">
                @csrf
                <input type="hidden" name="order" id="footerOrderInput">
                <table class="admin-table compact" id="footerTable">
                    <thead><tr><th>#</th><th>Label</th><th>URL</th><th>Section</th><th>Locale</th><th>Active</th><th>Pos</th><th>New Tab</th><th>Actions</th></tr></thead>
                    <tbody>
                    @foreach($links as $link)
                        <tr data-id="{{ $link->id }}">
                            <td class="drag-handle"><i class="fa-solid fa-grip-vertical"></i></td>
                            <td><a href="{{ route('admin.public.footer.edit', $link) }}">{{ $link->label }}</a></td>
                            <td>{{ $link->url }}</td>
                            <td>{{ $link->section }}</td>
                            <td>{{ strtoupper($link->locale) }}</td>
                            <td>{{ $link->is_active ? 'Yes' : 'Draft' }}</td>
                            <td>{{ $link->position }}</td>
                            <td>{{ $link->open_in_new_tab ? 'Yes' : 'No' }}</td>
                            <td>
                                <a href="{{ route('admin.public.footer.edit', $link) }}" class="action-icon-btn" title="Edit link"><i class="fa-solid fa-pen"></i></a>
                                <a href="{{ route('admin.public.footer.design', $link) }}" class="action-icon-btn" title="Design page"><i class="fa-solid fa-palette"></i></a>
                                <form method="POST" action="{{ route('admin.public.footer.destroy', $link) }}" style="display:inline-block;" onsubmit="return confirm('Delete {{ $link->label }}?')">
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
    const tbody = document.querySelector('#footerTable tbody');
    if (!tbody) return;
    let dragSrc;
    tbody.querySelectorAll('tr').forEach(row => {
        row.draggable = true;
        row.addEventListener('dragstart', e => { dragSrc = row; e.dataTransfer.effectAllowed = 'move'; });
        row.addEventListener('dragover', e => e.preventDefault());
        row.addEventListener('drop', e => {
            e.preventDefault();
            if (dragSrc && dragSrc !== row) {
                row.parentNode.insertBefore(dragSrc, row.nextSibling);
            }
        });
    });
    document.getElementById('footerOrderForm').addEventListener('submit', e => {
        const ids = Array.from(tbody.querySelectorAll('tr')).map(r => r.dataset.id);
        document.getElementById('footerOrderInput').value = JSON.stringify(ids);
    });
});
</script>
@endpush
@endsection
