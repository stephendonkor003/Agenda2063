@extends('layouts.admin')

@section('title', 'Home Sliders')
@section('page-title', 'Home Sliders')

@section('content')
    <div class="page-header-banner">
        <div class="page-header-text">
            <h1><i class="fa-solid fa-image"></i> Home Sliders</h1>
            <p>Manage hero slides for the public home page.</p>
        </div>
    </div>

    @if(session('status'))
        <div class="alert success"><div class="alert-icon"><i class="fa-solid fa-check-circle"></i></div><div class="alert-body">{{ session('status') }}</div></div>
    @endif

    <div class="settings-card">
        <div class="settings-card-header"><h3>Add Slide</h3></div>
        <div class="settings-card-body">
            <form class="settings-row" method="POST" action="{{ route('admin.public.sliders.store') }}">
                @csrf
                <div class="settings-field" style="min-width:260px;">
                    <label>Title</label>
                    <input type="text" name="title" class="settings-input" required>
                </div>
                <div class="settings-field" style="min-width:260px;">
                    <label>Subtitle</label>
                    <input type="text" name="subtitle" class="settings-input">
                </div>
                <div class="settings-field" style="min-width:260px;">
                    <label>Image URL</label>
                    <input type="text" name="image_url" class="settings-input" placeholder="https://...">
                </div>
                <div class="settings-field" style="min-width:200px;">
                    <label>CTA Label</label>
                    <input type="text" name="cta_label" class="settings-input" placeholder="Learn more">
                </div>
                <div class="settings-field" style="min-width:260px;">
                    <label>CTA URL</label>
                    <input type="text" name="cta_url" class="settings-input" placeholder="/about">
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
                    <label>Active</label><br>
                    <input type="checkbox" name="active" value="1" checked>
                </div>
                <div class="settings-field" style="min-width:120px;">
                    <label>Published</label><br>
                    <input type="checkbox" name="is_active" value="1" checked>
                </div>
                <button class="btn-primary-admin" type="submit"><i class="fa-solid fa-save"></i> Save</button>
            </form>
        </div>
    </div>

    <div class="settings-card" style="margin-top:14px;">
        <div class="settings-card-header"><h3>Existing Slides</h3></div>
        <div class="settings-card-body">
            <form method="POST" action="{{ route('admin.public.sliders.reorder') }}" id="sliderOrderForm">
                @csrf
                <input type="hidden" name="order" id="sliderOrderInput">
                <table class="admin-table compact" id="sliderTable">
                    <thead><tr><th>#</th><th>Title</th><th>Locale</th><th>CTA</th><th>Active</th><th>Published</th><th>Position</th><th>Actions</th></tr></thead>
                    <tbody>
                    @foreach($sliders as $slider)
                        <tr data-id="{{ $slider->id }}">
                            <td class="drag-handle"><i class="fa-solid fa-grip-vertical"></i></td>
                            <td>{{ $slider->title }}</td>
                            <td>{{ strtoupper($slider->locale) }}</td>
                            <td>{{ $slider->cta_label }} → {{ $slider->cta_url }}</td>
                            <td>{{ $slider->active ? 'Yes' : 'No' }}</td>
                            <td>{{ $slider->is_active ? 'Yes' : 'Draft' }}</td>
                            <td>{{ $slider->position }}</td>
                            <td>
                                <form method="POST" action="{{ route('admin.public.sliders.update', $slider) }}" style="display:inline-block;">
                                    @csrf @method('PUT')
                                    <input type="hidden" name="title" value="{{ $slider->title }}">
                                    <input type="hidden" name="subtitle" value="{{ $slider->subtitle }}">
                                    <input type="hidden" name="image_url" value="{{ $slider->image_url }}">
                                    <input type="hidden" name="cta_label" value="{{ $slider->cta_label }}">
                                    <input type="hidden" name="cta_url" value="{{ $slider->cta_url }}">
                                    <input type="hidden" name="position" value="{{ $slider->position }}">
                                    <input type="hidden" name="active" value="{{ $slider->active }}">
                                    <input type="hidden" name="is_active" value="{{ $slider->is_active }}">
                                    <input type="hidden" name="locale" value="{{ $slider->locale }}">
                                    <button class="action-icon-btn" title="Re-save"><i class="fa-solid fa-pen"></i></button>
                                </form>
                                <form method="POST" action="{{ route('admin.public.sliders.destroy', $slider) }}" style="display:inline-block;" onsubmit="return confirm('Delete slide {{ $slider->title }}?')">
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
    const tbody = document.querySelector('#sliderTable tbody');
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
    document.getElementById('sliderOrderForm').addEventListener('submit', e => {
        const ids = Array.from(tbody.querySelectorAll('tr')).map(r => r.dataset.id);
        document.getElementById('sliderOrderInput').value = JSON.stringify(ids);
    });
});
</script>
@endpush
@endsection
