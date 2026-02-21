@extends('layouts.admin')

@section('title', 'Add Flagship Update')
@section('page-title', 'Add Flagship Update')

@section('content')
<div class="page-header-banner">
    <div class="page-header-text">
        <h1><i class="fa-solid fa-newspaper"></i> New Update for "{{ $project->title }}"</h1>
        <p>Create a news/article/update entry with rich text and attachments.</p>
    </div>
    <div class="page-header-actions">
        <a class="btn-outline-admin" href="{{ route('admin.flagship-projects') }}"><i class="fa-solid fa-arrow-left"></i> Back to Projects</a>
    </div>
</div>

@if(session('status'))
    <div class="alert success"><div class="alert-icon"><i class="fa-solid fa-check-circle"></i></div><div class="alert-body">{{ session('status') }}</div></div>
@endif
@if($errors->any())
    <div class="alert error">
        <div class="alert-icon"><i class="fa-solid fa-triangle-exclamation"></i></div>
        <div class="alert-body">
            Please fix the issues below.
            <ul style="margin:6px 0 0 18px; text-align:left;">
                @foreach($errors->all() as $err)<li>{{ $err }}</li>@endforeach
            </ul>
        </div>
    </div>
@endif

<form method="POST" action="{{ route('admin.flagship-projects.updates.store', $project) }}" enctype="multipart/form-data" class="settings-card" style="max-width:1280px;">
    @csrf
    <input type="hidden" name="flagship_project_id" value="{{ $project->id }}">
    <div class="two-col">
        <div class="main-col">
            <div class="settings-card-body">
                <div class="settings-row">
                    <div class="settings-field" style="min-width:320px;">
                        <label for="title">Title</label>
                        <input id="title" type="text" name="title" class="settings-input @error('title') field-error @enderror" value="{{ old('title') }}" required>
                        @error('title')<span class="field-error-text">{{ $message }}</span>@enderror
                    </div>
                    <div class="settings-field" style="min-width:180px;">
                        <label for="type">Type</label>
                        <select id="type" name="type" class="settings-select @error('type') field-error @enderror">
                            @foreach(['update','news','article'] as $t)
                                <option value="{{ $t }}" @selected(old('type')===$t)>{{ ucfirst($t) }}</option>
                            @endforeach
                        </select>
                        @error('type')<span class="field-error-text">{{ $message }}</span>@enderror
                    </div>
                    <div class="settings-field" style="min-width:180px;">
                        <label for="status">Status</label>
                        <select id="status" name="status" class="settings-select @error('status') field-error @enderror">
                            @foreach(['pending','approved','rejected'] as $s)
                                <option value="{{ $s }}" @selected(old('status','pending')===$s)>{{ ucfirst($s) }}</option>
                            @endforeach
                        </select>
                        @error('status')<span class="field-error-text">{{ $message }}</span>@enderror
                    </div>
                </div>

                <div class="settings-field">
                    <label for="body">Body (rich text)</label>
                    <textarea id="body" name="body" class="settings-textarea @error('body') field-error @enderror" rows="12">{{ old('body') }}</textarea>
                    @error('body')<span class="field-error-text">{{ $message }}</span>@enderror
                </div>

                <div class="settings-row">
                    <div class="settings-field" style="flex:1;">
                        <label>Attachments (URLs)</label>
                        <div id="updFileRepeater">
                            @php $filesOld = old('files', [['label'=>'','file_url'=>'']]); @endphp
                            @foreach($filesOld as $idx => $file)
                                <div class="file-row">
                                    <input type="text" name="files[{{ $idx }}][label]" class="settings-input" placeholder="Label (optional)" value="{{ $file['label'] ?? '' }}" style="margin-bottom:6px;">
                                    <input type="url" name="files[{{ $idx }}][file_url]" class="settings-input" placeholder="https://example.com/file.pdf" value="{{ $file['file_url'] ?? '' }}">
                                </div>
                            @endforeach
                        </div>
                        <button type="button" class="btn-outline-admin" onclick="addUpdFileRow()" style="margin-top:8px;"><i class="fa-solid fa-plus"></i> Add Attachment</button>
                    </div>
                    <div class="settings-field" style="flex:1;">
                        <label>Upload Files</label>
                        <input type="file" name="upload_files[]" multiple class="settings-input @error('upload_files.*') field-error @enderror">
                        @error('upload_files.*')<span class="field-error-text">{{ $message }}</span>@enderror
                        <p class="settings-hint">You can attach documents, PDFs, etc. (optional)</p>
                    </div>
                </div>
            </div>
            <div class="settings-card-footer">
                <button class="btn-primary-admin" type="submit"><i class="fa-solid fa-save"></i> Save Update</button>
                <a class="btn-outline-admin" href="{{ route('admin.flagship-projects') }}">Cancel</a>
            </div>
        </div>

        <aside class="side-panel">
            <div class="side-card">
                <h4><i class="fa-solid fa-lightbulb"></i> Writing guidance</h4>
                <ul>
                    <li>Keep headlines clear and action-oriented.</li>
                    <li>Use short paragraphs and bullet lists for key points.</li>
                    <li>Link to source documents and attach supporting PDFs.</li>
                    <li>Specify dates, locations, and stakeholders.</li>
                    <li>Include outcomes and next steps; avoid jargon.</li>
                </ul>
            </div>
            <div class="side-card">
                <h4><i class="fa-solid fa-clock"></i> Estimated read time</h4>
                <p class="muted">Based on your content, the reader time updates live.</p>
                <div id="readTime" class="read-time">0 min</div>
            </div>
        </aside>
    </div>
</form>
@endsection

@push('scripts')
<script src="https://cdn.ckeditor.com/ckeditor5/41.2.1/classic/ckeditor.js"></script>
<style>
body { background: radial-gradient(circle at 20% 20%, #fdf2f8 0, #f8fafc 35%, #eef2ff 70%); }
.settings-card { border:1px solid #e5e7eb; box-shadow:0 18px 40px rgba(15,23,42,0.08); border-radius:14px; }
.settings-card-body { background:#fff; border-radius:12px; }
.two-col { display:flex; gap:20px; align-items:flex-start; }
.main-col { flex:3; }
.side-panel { flex:1.1; display:flex; flex-direction:column; gap:14px; }
.side-card { background:#0f172a; color:#e2e8f0; border:1px solid #1f2937; border-radius:12px; padding:14px; box-shadow:0 12px 30px rgba(0,0,0,0.18); }
.side-card h4 { margin:0 0 8px; color:#f8fafc; }
.side-card ul { padding-left:18px; margin:0; color:#cbd5e1; }
.read-time { font-size:24px; font-weight:700; color:#fbbf24; }
.settings-field label { font-weight:700; color:#0f172a; }
.settings-input, .settings-select, .settings-textarea { border-radius:10px; }
.btn-primary-admin { box-shadow:0 8px 20px rgba(130,43,57,0.35); }
.file-row { margin-bottom:10px; padding:8px; border:1px dashed #e5e7eb; border-radius:10px; background:#f8fafc; }
</style>
<script>
let updEditor = null;
ClassicEditor.create(document.querySelector('#body')).then(e => updEditor = e).catch(console.error);

function addUpdFileRow() {
    const wrap = document.getElementById('updFileRepeater');
    const index = wrap.children.length;
    const row = document.createElement('div'); row.className='file-row';
    row.innerHTML = `
        <input type="text" name="files[${index}][label]" class="settings-input" placeholder="Label (optional)" style="margin-bottom:6px;">
        <input type="url" name="files[${index}][file_url]" class="settings-input" placeholder="https://example.com/file.pdf">
    `;
    wrap.appendChild(row);
}

document.querySelector('form').addEventListener('submit', () => {
    if (updEditor) document.querySelector('#body').value = updEditor.getData();
});

// simple read-time estimator (~200 wpm)
const bodyEl = document.querySelector('#body');
const readOut = document.getElementById('readTime');
function updateReadTime(text) {
    const words = text.trim().split(/\s+/).filter(Boolean).length;
    const minutes = Math.max(1, Math.ceil(words / 200));
    readOut.textContent = `${minutes} min`;
}
bodyEl.addEventListener('input', () => updateReadTime(bodyEl.value));
if (bodyEl.value) updateReadTime(bodyEl.value);
</script>
@endpush
