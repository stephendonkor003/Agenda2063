@extends('layouts.admin')

@section('title', ($isEdit ? 'Edit' : 'Create') . ' ' . ucfirst($type))
@section('page-title', ($isEdit ? 'Edit' : 'Create') . ' ' . ucfirst($type))

@section('content')
    <div class="page-header-banner">
        <div class="page-header-text">
            <h1><i class="fa-solid fa-newspaper"></i> {{ $isEdit ? 'Edit' : 'Create' }} {{ ucfirst($type) }}</h1>
            <p>{{ $isEdit ? 'Update content, scheduling, and media.' : 'Add a new item with rich content and attachments.' }}</p>
        </div>
        <div class="page-header-actions">
            <a class="btn-outline-admin" href="{{ route('admin.news') }}"><i class="fa-solid fa-arrow-left"></i> Back to list</a>
        </div>
    </div>

    @if(session('status'))
        <div class="alert success"><div class="alert-icon"><i class="fa-solid fa-check-circle"></i></div><div class="alert-body">{{ session('status') }}</div></div>
    @endif
    @if($errors->any())
        <div class="alert error"><div class="alert-icon"><i class="fa-solid fa-triangle-exclamation"></i></div><div class="alert-body">Please fix the highlighted fields.</div></div>
    @endif

    <form method="POST" action="{{ $isEdit ? route('admin.news.update', $item) : route('admin.news.store') }}" enctype="multipart/form-data" class="settings-card">
        @csrf
        @if($isEdit) @method('PUT') @endif
        <input type="hidden" name="type" value="{{ $type }}">

        <div class="settings-card-body">
            <div class="settings-row">
                <div class="settings-field" style="min-width:300px;">
                    <label>Title</label>
                    <input type="text" name="title" class="settings-input @error('title') field-error @enderror" value="{{ old('title', $item->title) }}" required>
                    @error('title')<span class="field-error-text">{{ $message }}</span>@enderror
                </div>
                <div class="settings-field" style="min-width:220px;">
                    <label>Category</label>
                    <select name="category_id" class="settings-select">
                        <option value="">Uncategorised</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" @selected(old('category_id', $item->category_id)==$cat->id)>{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="settings-field" style="min-width:160px;">
                    <label>Status</label>
                    <select name="status" class="settings-select">
                        @foreach(['draft','published','scheduled'] as $s)
                            <option value="{{ $s }}" @selected(old('status', $item->status ?? 'draft')==$s)>{{ ucfirst($s) }}</option>
                        @endforeach
                    </select>
                </div>
                @if($canViewAll)
                <div class="settings-field" style="min-width:200px;">
                    <label>Department</label>
                    <select name="department_id" class="settings-select">
                        <option value="">Unassigned</option>
                        @foreach($departments as $dept)
                            <option value="{{ $dept->id }}" @selected(old('department_id',$item->department_id)==$dept->id)>{{ $dept->name }}</option>
                        @endforeach
                    </select>
                </div>
                @endif
            </div>

            <div class="settings-row">
                <div class="settings-field" style="flex:1;">
                    <label>Banner Image</label>
                    <input type="file" name="banner" class="settings-input @error('banner') field-error @enderror">
                    <p class="settings-hint">Up to 20MB; hero for the item.</p>
                    @if($item->banner_path)
                        <p class="settings-hint">Current: <a href="{{ Storage::url($item->banner_path) }}" target="_blank">view</a></p>
                    @endif
                    @error('banner')<span class="field-error-text">{{ $message }}</span>@enderror
                </div>
                <div class="settings-field" style="flex:1;">
                    <label>{{ $type === 'event' ? 'Starts At' : 'Published At' }}</label>
                    <input type="datetime-local" name="published_at" class="settings-input" value="{{ old('published_at', optional($item->published_at)->format('Y-m-d\TH:i')) }}">
                </div>
                <div class="settings-field" style="flex:1; {{ $type === 'event' ? '' : 'display:none;' }}" id="eventFields">
                    <label>Ends At</label>
                    <input type="datetime-local" name="ends_at" class="settings-input" value="{{ old('ends_at', optional($item->ends_at)->format('Y-m-d\TH:i')) }}">
                    <input type="text" name="location" class="settings-input" placeholder="Location" value="{{ old('location', $item->location) }}" style="margin-top:6px;">
                </div>
                <div class="settings-field" style="min-width:140px;">
                    <label>Country (ISO3)</label>
                    <input type="text" name="country_code" class="settings-input" placeholder="GHA" value="{{ old('country_code', $item->country_code ?? request('country_code')) }}">
                </div>
                <div class="settings-field" style="min-width:140px;">
                    <label>Region Code</label>
                    <input type="text" name="region_code" class="settings-input" placeholder="ECOWAS" value="{{ old('region_code', $item->region_code ?? request('region_code')) }}">
                </div>
            </div>

            <div class="settings-row">
                <div class="settings-field" style="flex:1;">
                    <label>Summary</label>
                    <textarea name="summary" class="settings-textarea" rows="3">{{ old('summary', $item->summary) }}</textarea>
                </div>
                <div class="settings-field" style="flex:1;">
                    <label>Attachments (URLs)</label>
                    <div id="newsLinks">
                        @php
                            $links = old('attachments', $item->attachments->whereNotNull('file_url')->map(fn($a)=>['label'=>$a->label,'file_url'=>$a->file_url])->toArray() ?: [['label'=>'','file_url'=>'']]);
                        @endphp
                        @foreach($links as $idx => $att)
                            <div class="link-row">
                                <input class="settings-input" type="text" name="attachments[{{ $idx }}][label]" placeholder="Label (optional)" value="{{ $att['label'] ?? '' }}" style="margin-bottom:4px;">
                                <div style="display:flex; gap:8px; align-items:center;">
                                    <input class="settings-input" type="url" name="attachments[{{ $idx }}][file_url]" placeholder="https://example.com" value="{{ $att['file_url'] ?? '' }}">
                                    <button type="button" class="action-icon-btn danger" onclick="this.closest('.link-row').remove()"><i class="fa-solid fa-trash"></i></button>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <button class="btn-outline-admin" type="button" onclick="addLinkRow()"><i class="fa-solid fa-plus"></i> Add Link</button>
                </div>
            </div>

            <div class="settings-field">
                <label>Upload Files</label>
                <input type="file" name="upload_files[]" multiple class="settings-input @error('upload_files.*') field-error @enderror">
                @error('upload_files.*')<span class="field-error-text">{{ $message }}</span>@enderror
                <p class="settings-hint">Optional supporting docs up to 50MB each.</p>
            </div>

            <div class="settings-field">
                <label>Body (rich text)</label>
                <textarea name="body" id="news_body" class="settings-textarea" rows="12">{{ old('body', $item->body) }}</textarea>
            </div>
        </div>
        <div class="settings-card-footer">
            <button class="btn-primary-admin" type="submit"><i class="fa-solid fa-save"></i> {{ $isEdit ? 'Update' : 'Create' }}</button>
            <a class="btn-outline-admin" href="{{ route('admin.news') }}">Cancel</a>
        </div>
    </form>
@endsection

@push('scripts')
<script src="https://cdn.ckeditor.com/ckeditor5/41.2.1/classic/ckeditor.js"></script>
<script>
let editor = null;
ClassicEditor.create(document.querySelector('#news_body')).then(e => editor = e).catch(console.error);

function addLinkRow(data = {label:'', file_url:''}) {
    const wrap = document.getElementById('newsLinks');
    const idx = wrap.children.length;
    const div = document.createElement('div'); div.className='link-row';
    div.innerHTML = `
        <input class="settings-input" type="text" name="attachments[${idx}][label]" placeholder="Label (optional)" value="${data.label || ''}" style="margin-bottom:4px;">
        <div style="display:flex; gap:8px; align-items:center;">
            <input class="settings-input" type="url" name="attachments[${idx}][file_url]" placeholder="https://example.com" value="${data.file_url || ''}">
            <button type="button" class="action-icon-btn danger" onclick="this.closest('.link-row').remove()"><i class="fa-solid fa-trash"></i></button>
        </div>`;
    wrap.appendChild(div);
}

document.querySelector('form').addEventListener('submit', () => {
    if (editor) document.querySelector('#news_body').value = editor.getData();
});

function toggleEventFields() {
    const type = "{{ $type }}";
    const ev = document.getElementById('eventFields');
    if (type === 'event') {
        ev.style.display = 'block';
    } else {
        ev.style.display = 'none';
    }
}
toggleEventFields();
</script>
@endpush
