@extends('layouts.admin')

@section('title', 'Edit Flagship Project')
@section('page-title', 'Edit Flagship Project')

@php
    $updatesCount = $project->relationLoaded('updates') ? $project->updates->count() : $project->updates()->count();
    $newsCount = $project->relationLoaded('updates') ? $project->updates->where('type','news')->count() : $project->updates()->where('type','news')->count();
    $articlesCount = $project->relationLoaded('updates') ? $project->updates->where('type','article')->count() : $project->updates()->where('type','article')->count();
    $filesCount = $project->relationLoaded('updates')
        ? $project->updates->flatMap->files->count()
        : $project->updates()->withCount('files')->get()->sum('files_count');
@endphp

@section('content')
<div class="page-header-banner">
    <div class="page-header-text">
        <h1><i class="fa-solid fa-pen-to-square"></i> Edit "{{ $project->title }}"</h1>
        <p>Update status, progress, banner, and summary with a full-page editor.</p>
    </div>
    <div class="page-header-actions">
        <a class="btn-outline-admin" href="{{ route('admin.flagship-projects') }}"><i class="fa-solid fa-arrow-left"></i> Back to projects</a>
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
    <form id="projectEditForm" method="POST" action="{{ route('admin.flagship-projects.update', $project) }}" enctype="multipart/form-data" class="settings-card">
        @csrf
        @method('PUT')

        <div class="section-grid">
            <div class="main-col">
                <div class="settings-card-body">
                    <div class="meta-strip">
                        <span class="badge badge-soft">Status: {{ ucfirst($project->status) }}</span>
                        <span class="badge badge-muted">Progress: {{ number_format($project->progress, 2) }}%</span>
                        <span class="badge badge-muted">Dept: {{ optional($project->department)->name ?? 'Unassigned' }}</span>
                    </div>

                    <div class="settings-row">
                        <div class="settings-field" style="min-width:320px;">
                            <label for="title">Title</label>
                            <input id="title" type="text" name="title" class="settings-input @error('title') field-error @enderror" value="{{ old('title', $project->title) }}" required>
                            @error('title')<span class="field-error-text">{{ $message }}</span>@enderror
                        </div>
                        <div class="settings-field" style="min-width:180px;">
                            <label for="status">Status</label>
                            <select id="status" name="status" class="settings-select @error('status') field-error @enderror">
                                @foreach(['active','on-hold','completed'] as $s)
                                    <option value="{{ $s }}" @selected(old('status',$project->status)===$s)>{{ ucfirst($s) }}</option>
                                @endforeach
                            </select>
                            @error('status')<span class="field-error-text">{{ $message }}</span>@enderror
                        </div>
                        <div class="settings-field" style="min-width:180px;">
                            <label for="progress">Progress (%)</label>
                            <div class="progress-field">
                                <input id="progress" type="number" name="progress" class="settings-input @error('progress') field-error @enderror" min="0" max="100" step="0.01" value="{{ old('progress', $project->progress) }}">
                                <input id="progressRange" type="range" min="0" max="100" step="0.5" value="{{ old('progress', $project->progress) }}">
                            </div>
                            @error('progress')<span class="field-error-text">{{ $message }}</span>@enderror
                        </div>
                        @if($canViewAll)
                        <div class="settings-field" style="min-width:220px;">
                            <label for="department_id">Department</label>
                            <select id="department_id" name="department_id" class="settings-select @error('department_id') field-error @enderror">
                                @foreach($departments as $dept)
                                    <option value="{{ $dept->id }}" @selected(old('department_id', $project->department_id)==$dept->id)>{{ $dept->name }}</option>
                                @endforeach
                            </select>
                            @error('department_id')<span class="field-error-text">{{ $message }}</span>@enderror
                        </div>
                        @else
                        <div class="settings-field" style="min-width:220px;">
                            <label>Department</label>
                            <input type="text" class="settings-input" value="{{ optional($project->department)->name ?? 'Unassigned' }}" disabled>
                        </div>
                        @endif
                    </div>

                    <div class="settings-field">
                        <label for="banner">Banner Image</label>
                        <div class="banner-row">
                            <div id="bannerPreview" class="banner-preview" style="background-image:url('{{ $project->image_url ?: asset('images/placeholder.jpg') }}')"></div>
                            <div style="flex:1;">
                                <input id="banner" type="file" name="banner" accept="image/*" class="settings-input @error('banner') field-error @enderror">
                                <p class="settings-hint">Uploading a new banner replaces the current one. Max 5MB.</p>
                                @error('banner')<span class="field-error-text">{{ $message }}</span>@enderror
                            </div>
                        </div>
                    </div>

                    <div class="settings-field">
                        <label for="summary">Summary (rich text)</label>
                        <textarea id="summary" name="summary" class="settings-textarea @error('summary') field-error @enderror" rows="10">{{ old('summary', $project->summary) }}</textarea>
                        @error('summary')<span class="field-error-text">{{ $message }}</span>@enderror
                    </div>
                </div>

                <div class="settings-card-footer">
                    <div class="actions-bar">
                        <button class="btn-primary-admin" type="submit"><i class="fa-solid fa-save"></i> Save Project</button>
                        <a class="btn-outline-admin" href="{{ route('admin.flagship-projects') }}">Cancel</a>
                    </div>
                    <div class="muted" style="margin-top:6px;">Saving keeps all updates and attachments intact. Progress accepts decimals (e.g., 3.34).</div>
                </div>
            </div>

            <aside class="side-panel">
                <div class="side-card sticky">
                    <h4><i class="fa-solid fa-lightbulb"></i> Review checklist</h4>
                    <ul>
                        <li>Title is concise and reflects current scope.</li>
                        <li>Status matches reality (Active / On hold / Completed).</li>
                        <li>Progress slider mirrors the numeric value.</li>
                        <li>Banner is clear and high-resolution.</li>
                        <li>Summary covers milestones, risks, and next steps.</li>
                    </ul>
                </div>
                <div class="side-card sticky">
                    <h4><i class="fa-solid fa-chart-line"></i> Project at a glance</h4>
                    <div class="stat-block">
                        <span class="stat-label">Updates</span>
                        <strong>{{ $updatesCount }}</strong>
                    </div>
                    <div class="stat-block">
                        <span class="stat-label">News</span>
                        <strong>{{ $newsCount }}</strong>
                    </div>
                    <div class="stat-block">
                        <span class="stat-label">Articles</span>
                        <strong>{{ $articlesCount }}</strong>
                    </div>
                    <div class="stat-block">
                        <span class="stat-label">Attachments</span>
                        <strong>{{ $filesCount }}</strong>
                    </div>
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
.section-grid { display:grid; grid-template-columns:minmax(0,2.6fr) minmax(280px,1fr); gap:28px; align-items:flex-start; }
.main-col { min-width:0; }
.side-panel { display:flex; flex-direction:column; gap:14px; }
.side-card { background:#0f172a; color:#e2e8f0; border:1px solid #1f2937; border-radius:12px; padding:14px; box-shadow:0 12px 30px rgba(0,0,0,0.18); }
.side-card.sticky { position:sticky; top:110px; }
.side-card h4 { margin:0 0 10px; color:#f8fafc; }
.side-card ul { padding-left:18px; margin:0; color:#cbd5e1; line-height:1.5; }
.side-panel > .side-card:not(:last-child) { margin-bottom:6px; }
.stat-block { display:flex; justify-content:space-between; align-items:center; padding:10px 12px; margin-bottom:8px; background:#111827; border-radius:10px; border:1px solid #1f2937; }
.stat-label { color:#cbd5e1; font-size:13px; }
.stat-block strong { color:#fbbf24; font-size:18px; }
.meta-strip { display:flex; flex-wrap:wrap; gap:8px; margin-bottom:12px; }
.badge { display:inline-flex; align-items:center; gap:6px; padding:6px 10px; border-radius:999px; font-size:12px; letter-spacing:0.01em; }
.badge-soft { background:#eef2ff; color:#312e81; border:1px solid #c7d2fe; }
.badge-muted { background:#f1f5f9; color:#0f172a; border:1px solid #e2e8f0; }
.settings-field label { font-weight:700; color:#0f172a; }
.settings-input, .settings-select, .settings-textarea { border-radius:10px; }
.btn-primary-admin { box-shadow:0 8px 20px rgba(130,43,57,0.35); }
.actions-bar { display:flex; flex-wrap:wrap; gap:12px; align-items:center; }
.progress-field { display:flex; flex-direction:column; gap:6px; }
.banner-row { display:flex; gap:12px; align-items:center; }
.banner-preview { width:140px; height:90px; border-radius:12px; background-size:cover; background-position:center; border:1px solid #e5e7eb; box-shadow:inset 0 0 0 1px rgba(0,0,0,0.04); }
@media (max-width:1100px){
    .section-grid { grid-template-columns:1fr; }
    .side-card.sticky { position:static; }
    .banner-row { flex-direction:column; align-items:flex-start; }
}
</style>
<script>
let summaryEditor = null;
ClassicEditor.create(document.querySelector('#summary')).then(e => summaryEditor = e).catch(console.error);

// keep range and number in sync
const progInput = document.getElementById('progress');
const progRange = document.getElementById('progressRange');
const syncProgress = (fromRange = false) => {
    if (fromRange) {
        progInput.value = progRange.value;
    } else {
        progRange.value = progInput.value || 0;
    }
};
progInput.addEventListener('input', () => syncProgress(false));
progRange.addEventListener('input', () => syncProgress(true));
syncProgress(true); // align number with initial range value

document.getElementById('projectEditForm').addEventListener('submit', () => {
    if (summaryEditor) document.querySelector('#summary').value = summaryEditor.getData();
    if (!progInput.value) progInput.value = progRange.value || 0;
});

// live banner preview
const bannerInput = document.getElementById('banner');
const bannerPreview = document.getElementById('bannerPreview');
bannerInput.addEventListener('change', (e) => {
    const file = e.target.files?.[0];
    if (!file) return;
    const reader = new FileReader();
    reader.onload = ev => {
        bannerPreview.style.backgroundImage = `url('${ev.target.result}')`;
    };
    reader.readAsDataURL(file);
});
</script>
@endpush
