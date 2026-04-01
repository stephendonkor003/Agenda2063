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
                    <input type="text" name="url" class="settings-input" placeholder="/about, https:// or #" required>
                </div>
                <div class="settings-field" style="min-width:160px;">
                    <label>Location</label>
                    <select name="location" class="settings-select" id="navLocationSelect">
                        <option value="header">Header</option>
                        <option value="footer">Footer</option>
                    </select>
                </div>
                <div class="settings-field" style="min-width:140px;">
                    <label>Locale</label>
                    <select name="locale" class="settings-select" id="navLocaleSelect">
                        @foreach(['en'=>'English','fr'=>'Français','ar'=>'Arabic','pt'=>'Português'] as $code => $label)
                            <option value="{{ $code }}">{{ $label }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="settings-field" style="min-width:220px;">
                    <label>Parent Link</label>
                    <select name="parent_id" class="settings-select" id="navParentSelect">
                        <option value="">Top-level tab</option>
                        @foreach($parentOptions as $parentOption)
                            <option value="{{ $parentOption->id }}" data-locale="{{ $parentOption->locale }}">
                                {{ strtoupper($parentOption->locale) }} · {{ $parentOption->label }}
                            </option>
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
            <p class="text-muted" style="margin-top:10px;">Create a parent tab like <strong>Programmes</strong> with URL <code>#</code>, then add fellowship links under it by choosing that parent. Programme child links should use an internal path such as <code>/programmes/au-media-fellowship</code>; put the external application platform under <strong>Design Page &gt; CTA URL</strong>.</p>
        </div>
    </div>

    <div class="settings-card" style="margin-top:14px;">
        <div class="settings-card-header"><h3>Existing Links</h3></div>
        <div class="settings-card-body">
            <form method="POST" action="{{ route('admin.public.nav.reorder') }}" id="navOrderForm">
                @csrf
                <input type="hidden" name="order" id="navOrderInput">
                <table class="admin-table compact" id="navTable">
                    <thead><tr><th>#</th><th>Label</th><th>Parent</th><th>URL</th><th>Locale</th><th>Location</th><th>Active</th><th>New Tab</th><th>Position</th><th>Actions</th></tr></thead>
                    <tbody>
                    @foreach($links as $link)
                        <tr data-id="{{ $link->id }}">
                            <td class="drag-handle"><i class="fa-solid fa-grip-vertical"></i></td>
                            <td>
                                <a href="{{ route('admin.public.nav.edit', $link) }}">
                                    {!! $link->parent_id ? '&nbsp;&nbsp;&nbsp;&boxur;&nbsp;' : '' !!}{{ $link->label }}
                                </a>
                            </td>
                            <td>{{ $link->parent?->label ?? 'Top level' }}</td>
                            <td>{{ $link->url }}</td>
                            <td>{{ strtoupper($link->locale) }}</td>
                            <td>{{ ucfirst($link->location) }}</td>
                            <td>{{ $link->is_active ? 'Yes' : 'Draft' }}</td>
                            <td>{{ $link->open_in_new_tab ? 'Yes' : 'No' }}</td>
                            <td>{{ $link->position }}</td>
                            <td>
                                <a href="{{ route('admin.public.nav.edit', $link) }}" class="action-icon-btn" title="Edit link"><i class="fa-solid fa-pen"></i></a>
                                <a href="{{ route('admin.public.nav.design', $link) }}" class="action-icon-btn" title="Design page"><i class="fa-solid fa-palette"></i></a>
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
    const locationSelect = document.getElementById('navLocationSelect');
    const localeSelect = document.getElementById('navLocaleSelect');
    const parentSelect = document.getElementById('navParentSelect');

    function syncParentOptions() {
        if (!locationSelect || !localeSelect || !parentSelect) return;

        const isHeader = locationSelect.value === 'header';
        const activeLocale = localeSelect.value;

        parentSelect.disabled = !isHeader;

        Array.from(parentSelect.options).forEach(option => {
            if (!option.value) {
                option.hidden = false;
                return;
            }

            const matchesLocale = option.dataset.locale === activeLocale;
            option.hidden = !isHeader || !matchesLocale;

            if (option.hidden && option.selected) {
                parentSelect.value = '';
            }
        });

        if (!isHeader) {
            parentSelect.value = '';
        }
    }

    syncParentOptions();
    locationSelect?.addEventListener('change', syncParentOptions);
    localeSelect?.addEventListener('change', syncParentOptions);

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
