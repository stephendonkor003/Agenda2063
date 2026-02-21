@extends('layouts.admin')

@section('title', 'Edit Flagship Update')
@section('page-title', 'Edit Flagship Update')

@section('content')
@php $filesOld = old('files', $update->files->map(fn($f)=>['label'=>$f->label,'file_url'=>$f->file_url])->toArray() ?: [['label'=>'','file_url'=>'']]); @endphp

<div class="page-header-banner">
    <div class="page-header-text">
        <h1><i class="fa-solid fa-pen-to-square"></i> Edit Update for "{{ $project->title }}"</h1>
        <p>Refine the story, attachments, and status for this flagship project.</p>
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

<div class="edit-shell">
<form method="POST" action="{{ route('admin.flagship-projects.updates.update', [$project, $update]) }}" enctype="multipart/form-data" class="settings-card">
    @csrf
    @method('PUT')
    <input type="hidden" name="flagship_project_id" value="{{ $project->id }}">
    <div class="section-grid">
        <div class="main-col">
            <div class="settings-card-body">
                <div class="meta-strip">
                    <span class="badge badge-soft">Project: {{ $project->title }}</span>
                    <span class="badge badge-muted">Dept: {{ optional($project->department)->name ?? 'Unassigned' }}</span>
                    <span class="badge badge-status {{ $update->status }}">Status: {{ ucfirst($update->status) }}</span>
                </div>
                <div class="settings-row">
                    <div class="settings-field" style="min-width:320px;">
                        <label for="title">Title</label>
                        <input id="title" type="text" name="title" class="settings-input @error('title') field-error @enderror" value="{{ old('title', $update->title) }}" required>
                        @error('title')<span class="field-error-text">{{ $message }}</span>@enderror
                    </div>
                    <div class="settings-field" style="min-width:180px;">
                        <label for="type">Type</label>
                        <select id="type" name="type" class="settings-select @error('type') field-error @enderror">
                            @foreach(['update','news','article'] as $t)
                                <option value="{{ $t }}" @selected(old('type', $update->type)===$t)>{{ ucfirst($t) }}</option>
                            @endforeach
                        </select>
                        @error('type')<span class="field-error-text">{{ $message }}</span>@enderror
                    </div>
                    <div class="settings-field" style="min-width:180px;">
                        <label for="status">Status</label>
                        <select id="status" name="status" class="settings-select @error('status') field-error @enderror">
                            @foreach(['pending','approved','rejected'] as $s)
                                <option value="{{ $s }}" @selected(old('status',$update->status)===$s)>{{ ucfirst($s) }}</option>
                            @endforeach
                        </select>
                        @error('status')<span class="field-error-text">{{ $message }}</span>@enderror
                    </div>
                </div>

                <div class="settings-field">
                    <label for="body">Body (rich text)</label>
                    <textarea id="body" name="body" class="settings-textarea @error('body') field-error @enderror" rows="12">{{ old('body', $update->body) }}</textarea>
                    @error('body')<span class="field-error-text">{{ $message }}</span>@enderror
                </div>

                <div class="settings-row">
                    <div class="settings-field" style="flex:1;">
                        <label>Attachments (URLs)</label>
                        <div id="updFileRepeater">
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
                        <p class="settings-hint">Optional: attach supporting docs.</p>
                    </div>
                </div>
            </div>
            <div class="settings-card-footer">
                <div class="actions-bar">
                    <button class="btn-primary-admin" type="submit"><i class="fa-solid fa-save"></i> Save Update</button>
                    <a class="btn-outline-admin" href="{{ route('admin.flagship-projects') }}">Cancel</a>
                </div>
                <div class="muted" style="margin-top:6px;">Saving keeps file links and uploads intact. Status changes will trigger approval flow.</div>
            </div>
        </div>

        <aside class="side-panel">
            <div class="side-card sticky">
                <h4><i class="fa-solid fa-lightbulb"></i> Editing tips</h4>
                <ul>
                    <li>Use concise headlines and lead with the main change.</li>
                    <li>Add timelines, milestones, and stakeholder names.</li>
                    <li>Link or attach source docs; keep URLs descriptive.</li>
                    <li>Note approvals or blockers; keep tone factual.</li>
                </ul>
            </div>
            <div class="side-card sticky">
                <h4><i class="fa-solid fa-clock"></i> Estimated read time</h4>
                <p class="muted">Updates as you type.</p>
                <div id="readTime" class="read-time">0 min</div>
            </div>
        </aside>
    </div>
</form>
</div>
@endsection

@push('scripts')
<script src="https://cdn.ckeditor.com/ckeditor5/41.2.1/classic/ckeditor.js"></script>
<style>
body { background: radial-gradient(circle at 18% 18%, #fdf2f8 0, #f8fafc 32%, #eef2ff 68%); }
.edit-shell { max-width:1280px; margin:0 auto 32px; }
.settings-card { border:1px solid #e5e7eb; box-shadow:0 18px 40px rgba(15,23,42,0.08); border-radius:14px; overflow:hidden; }
.settings-card-body { background:#fff; border-radius:12px; }
.section-grid { display:grid; grid-template-columns:minmax(0,2.6fr) minmax(280px,1fr); gap:20px; align-items:flex-start; }
.main-col { min-width:0; }
.side-panel { display:flex; flex-direction:column; gap:14px; }
.side-card { background:#0f172a; color:#e2e8f0; border:1px solid #1f2937; border-radius:12px; padding:14px; box-shadow:0 12px 30px rgba(0,0,0,0.18); }
.side-card.sticky { position:sticky; top:110px; }
.side-card h4 { margin:0 0 8px; color:#f8fafc; }
.side-card ul { padding-left:18px; margin:0; color:#cbd5e1; }
.read-time { font-size:24px; font-weight:700; color:#fbbf24; }
.settings-field label { font-weight:700; color:#0f172a; }
.settings-input, .settings-select, .settings-textarea { border-radius:10px; }
.btn-primary-admin { box-shadow:0 8px 20px rgba(130,43,57,0.35); }
.file-row { margin-bottom:10px; padding:8px; border:1px dashed #e5e7eb; border-radius:10px; background:#f8fafc; }
.meta-strip { display:flex; flex-wrap:wrap; gap:8px; margin-bottom:12px; }
.badge { display:inline-flex; align-items:center; gap:6px; padding:6px 10px; border-radius:999px; font-size:12px; letter-spacing:0.01em; }
.badge-soft { background:#eef2ff; color:#312e81; border:1px solid #c7d2fe; }
.badge-muted { background:#f1f5f9; color:#0f172a; border:1px solid #e2e8f0; }
.badge-status.pending { background:#fff7ed; color:#c2410c; border:1px solid #fed7aa; }
.badge-status.approved { background:#ecfdf3; color:#15803d; border:1px solid #bbf7d0; }
.badge-status.rejected { background:#fef2f2; color:#b91c1c; border:1px solid #fecdd3; }
.actions-bar { display:flex; flex-wrap:wrap; gap:12px; align-items:center; }
@media (max-width:1100px){
    .section-grid { grid-template-columns:1fr; }
    .side-card.sticky { position:static; }
}
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

// read time
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
