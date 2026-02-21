@extends('layouts.admin')

@section('title', 'Flagship Projects')
@section('page-title', 'Flagship Projects')

@section('content')
@php use Illuminate\Support\Str; @endphp

    <div class="page-header-banner">
        <div class="page-header-text">
            <h1><i class="fa-solid fa-rocket"></i> Flagship Projects</h1>
            <p>Track progress, news, documents, and departmental ownership.</p>
        </div>
        <div class="page-header-actions">
            <button class="btn-primary-admin" type="button" onclick="openProjectModal()"><i class="fa-solid fa-plus"></i> Add Project</button>
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

    <div class="projects-grid">
        @forelse($projects as $project)
            <div class="project-card">
                <div class="project-card-head">
                    <div class="project-cover" style="background-image:url('{{ $project->image_url ?: asset('images/placeholder.jpg') }}')"></div>
                    <div class="project-meta">
                        <h3>{{ $project->title }}</h3>
                        <p class="muted">{{ Str::limit(strip_tags($project->summary), 120) }}</p>
                        <div class="tag-row">
                            <span class="tag status {{ $project->status }}">{{ ucfirst($project->status) }}</span>
                            <span class="tag dept">{{ $project->department?->name ?? 'Dept N/A' }}</span>
                        </div>
                    </div>
                    <div class="project-actions">
                        <a class="action-icon-btn" title="Edit on full page" href="{{ route('admin.flagship-projects.edit', $project) }}">
                            <i class="fa-solid fa-pen"></i>
                        </a>
                        <form method="POST" action="{{ route('admin.flagship-projects.destroy', $project) }}" onsubmit="return confirm('Delete {{ $project->title }}?')" style="display:inline;">
                            @csrf @method('DELETE')
                            <button class="action-icon-btn danger" title="Delete"><i class="fa-solid fa-trash"></i></button>
                        </form>
                    </div>
                </div>

                <div class="progress-row">
                    <span>Progress</span>
                    <div class="progress-bar">
                        <div class="progress-fill" style="width: {{ $project->progress }}%;"></div>
                    </div>
                    <span class="progress-label">{{ number_format($project->progress, 0) }}%</span>
                </div>

                <div class="stats-row">
                    <div><strong>{{ $project->updates->count() }}</strong><span>Updates</span></div>
                    <div><strong>{{ $project->updates->flatMap->files->count() }}</strong><span>Attachments</span></div>
                    <div><strong>{{ $project->updates->where('type','news')->count() }}</strong><span>News</span></div>
                    <div><strong>{{ $project->updates->where('type','article')->count() }}</strong><span>Articles</span></div>
                </div>

                <div class="updates-list">
                    <div class="updates-head">
                        <h4>Updates</h4>
                        <div class="updates-actions">
                            <a class="btn-outline-admin" href="{{ route('admin.flagship-projects.updates.create', $project) }}"><i class="fa-solid fa-plus"></i> Add Update</a>
                            <a class="btn-primary-admin" href="{{ route('admin.flagship-projects.updates.create', $project) }}" target="_blank"><i class="fa-solid fa-newspaper"></i> Add News/Article</a>
                        </div>
                    </div>
                    @forelse($project->updates->sortByDesc('created_at')->take(4) as $update)
                        <a class="update-item" href="{{ route('admin.flagship-projects.updates.edit', [$project, $update]) }}" title="Click to view/edit">
                            <div class="update-main">
                                <div class="tag type">{{ ucfirst($update->type) }}</div>
                                <div class="tag status {{ $update->status }}">{{ ucfirst($update->status) }}</div>
                                <strong>{{ $update->title }}</strong>
                                <div class="muted">{{ Str::limit(strip_tags($update->body), 20) }}</div>
                            </div>
                            <div class="update-meta">
                                <span class="muted small">Attachments: {{ $update->files->count() }}</span>
                                <span class="muted small">Created: {{ $update->created_at?->format('M d, Y') }}</span>
                            </div>
                        </a>
                    @empty
                        <p class="muted">No updates yet.</p>
                    @endforelse
                </div>
            </div>
        @empty
            <p>No flagship projects yet.</p>
        @endforelse
    </div>

    <!-- Project Modal -->
    <div id="projectModal" class="modal-backdrop">
        <div class="modal-card" style="max-width:760px;">
            <div class="modal-head">
                <div>
                    <p class="modal-kicker">Flagship Project</p>
                    <h3 id="projectModalTitle"><i class="fa-solid fa-plus"></i> Add Project</h3>
                </div>
                <button class="modal-close" type="button" onclick="closeProjectModal()"><i class="fa-solid fa-xmark"></i></button>
            </div>
            <form id="projectForm" method="POST" action="{{ route('admin.flagship-projects.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="settings-row">
                    <div class="settings-field" style="min-width:260px;">
                        <label>Title</label>
                        <input type="text" name="title" id="proj_title" class="settings-input" required>
                    </div>
                    <div class="settings-field" style="min-width:140px;">
                        <label>Status</label>
                        <select name="status" id="proj_status" class="settings-select">
                            <option value="active">Active</option>
                            <option value="on-hold">On Hold</option>
                            <option value="completed">Completed</option>
                        </select>
                    </div>
                    <div class="settings-field" style="min-width:160px;">
                        <label>Progress (%)</label>
                        <input type="number" name="progress" id="proj_progress" class="settings-input" min="0" max="100" value="0">
                    </div>
                    @if($canViewAll)
                    <div class="settings-field" style="min-width:200px;">
                        <label>Department</label>
                        <select name="department_id" id="proj_department" class="settings-select">
                            @foreach($departments as $dept)
                                <option value="{{ $dept->id }}">{{ $dept->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    @endif
                </div>
                <div class="settings-field">
                    <label>Banner Image</label>
                    <input type="file" name="banner" id="proj_banner" accept="image/*" class="settings-input">
                </div>
                <div class="settings-field">
                    <label>Summary (rich text)</label>
                    <textarea name="summary" id="proj_summary" class="settings-textarea" rows="6"></textarea>
                </div>
                <div class="modal-actions" style="margin-top:12px;">
                    <button type="button" class="btn-outline-admin" onclick="closeProjectModal()">Cancel</button>
                    <button type="submit" class="btn-primary-admin"><i class="fa-solid fa-save"></i> Save</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Update Modal -->
    <div id="updateModal" class="modal-backdrop">
        <div class="modal-card" style="max-width:760px;">
            <div class="modal-head">
                <div>
                    <p class="modal-kicker">Flagship Update</p>
                    <h3 id="updateModalTitle"><i class="fa-solid fa-plus"></i> Add Update</h3>
                </div>
                <button class="modal-close" type="button" onclick="closeUpdateModal()"><i class="fa-solid fa-xmark"></i></button>
            </div>
            <form id="updateForm" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="settings-row">
                    <div class="settings-field" style="min-width:260px;">
                        <label>Title</label>
                        <input type="text" name="title" id="upd_title" class="settings-input" required>
                    </div>
                    <div class="settings-field" style="min-width:140px;">
                        <label>Type</label>
                        <select name="type" id="upd_type" class="settings-select">
                            <option value="update">Update</option>
                            <option value="news">News</option>
                            <option value="article">Article</option>
                        </select>
                    </div>
                    <div class="settings-field" style="min-width:140px;">
                        <label>Status</label>
                        <select name="status" id="upd_status" class="settings-select">
                            <option value="draft">Draft</option>
                            <option value="published">Published</option>
                        </select>
                    </div>
                </div>
                <div class="settings-field">
                    <label>Body (rich text)</label>
                    <textarea name="body" id="upd_body" class="settings-textarea" rows="6"></textarea>
                </div>
                <div class="settings-field">
                    <label>Attachments (URLs)</label>
                    <div id="updFileRepeater">
                        <div class="file-row">
                            <input type="text" name="files[0][label]" class="settings-input" placeholder="Label (optional)" style="margin-bottom:6px;">
                            <input type="url" name="files[0][file_url]" class="settings-input" placeholder="https://example.com/file.pdf">
                        </div>
                    </div>
                    <button type="button" class="btn-outline-admin" onclick="addUpdFileRow()" style="margin-top:8px;"><i class="fa-solid fa-plus"></i> Add Attachment</button>
                </div>
                <div class="settings-field">
                    <label>Upload Files</label>
                    <input type="file" name="upload_files[]" multiple class="settings-input">
                </div>
                <div class="modal-actions" style="margin-top:12px;">
                    <button type="button" class="btn-outline-admin" onclick="closeUpdateModal()">Cancel</button>
                    <button type="submit" class="btn-primary-admin"><i class="fa-solid fa-save"></i> Save</button>
                </div>
            </form>
        </div>
    </div>

@endsection

@push('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/v/bs5/dt-2.0.3/datatables.min.css">
<link rel="stylesheet" href="https://cdn.ckeditor.com/ckeditor5/41.2.1/classic/styles.css">
<style>
.projects-grid { display:grid; grid-template-columns:repeat(auto-fit,minmax(360px,1fr)); gap:16px; }
.project-card { background:#fff; border:1px solid #e5e7eb; border-radius:12px; padding:14px; box-shadow:0 12px 32px rgba(0,0,0,0.05); display:flex; flex-direction:column; gap:10px; }
.project-card-head { display:flex; gap:12px; align-items:flex-start; }
.project-cover { width:88px; height:88px; background-size:cover; background-position:center; border-radius:10px; border:1px solid #e5e7eb; }
.project-meta h3 { margin:0 0 6px; }
.muted { color:#6b7280; }
.muted.small { font-size:12px; }
.tag-row { display:flex; gap:6px; flex-wrap:wrap; }
.tag { padding:4px 8px; border-radius:999px; font-size:12px; border:1px solid #e5e7eb; }
.tag.status.active { background:#ecfdf3; color:#15803d; border-color:#bbf7d0; }
.tag.status.on-hold { background:#fff7ed; color:#c2410c; border-color:#fed7aa; }
.tag.status.completed { background:#eff6ff; color:#1d4ed8; border-color:#bfdbfe; }
.tag.dept { background:#f8fafc; }
.project-actions { margin-left:auto; display:flex; gap:6px; }
.progress-row { display:grid; grid-template-columns:1fr 4fr auto; gap:8px; align-items:center; }
.progress-bar { width:100%; height:8px; background:#f3f4f6; border-radius:999px; overflow:hidden; }
.progress-fill { height:100%; background:var(--admin-primary,#822b39); }
.progress-label { font-weight:600; }
.stats-row { display:flex; gap:14px; flex-wrap:wrap; font-size:13px; }
.stats-row div { background:#f9fafb; padding:8px 10px; border-radius:10px; border:1px solid #e5e7eb; text-align:center; }
.stats-row strong { display:block; font-size:16px; }
.updates-list { border-top:1px solid #e5e7eb; padding-top:10px; display:flex; flex-direction:column; gap:10px; }
.updates-head { display:flex; justify-content:space-between; align-items:center; }
.updates-actions { display:flex; gap:8px; flex-wrap:wrap; }
.update-item { border:1px solid #e5e7eb; border-radius:10px; padding:12px; display:flex; justify-content:space-between; gap:8px; background:#f8fafc; text-decoration:none; color:inherit; transition:transform .12s ease, box-shadow .12s ease, border-color .12s ease; position:relative; overflow:hidden; }
.update-item::after { content:'Click to edit'; position:absolute; inset:0; display:flex; align-items:center; justify-content:center; font-size:14px; font-weight:700; color:#fff; background:rgba(130,43,57,0.72); opacity:0; transition:opacity .12s ease; text-transform:uppercase; letter-spacing:0.05em; }
.update-item:hover { transform: translateY(-2px); box-shadow:0 10px 24px rgba(15,23,42,0.12); border-color:#d1d5db; }
.update-item:hover::after { opacity:1; }
.update-main { display:flex; flex-direction:column; gap:4px; }
.update-meta { display:flex; flex-direction:column; align-items:flex-end; gap:2px; min-width:120px; }
.tag.type { background:#eef2ff; color:#4338ca; border:1px solid #e0e7ff; }
.tag.status.approved { background:#ecfdf3; color:#15803d; border:1px solid #bbf7d0; }
.tag.status.pending { background:#fff7ed; color:#c2410c; border:1px solid #fed7aa; }
.tag.status.rejected { background:#fef2f2; color:#b91c1c; border:1px solid #fecdd3; }
.modal-backdrop { position:fixed; inset:0; background:rgba(0,0,0,0.35); display:none; align-items:center; justify-content:center; z-index:1100; }
.modal-backdrop.show { display:flex; }
.modal-card { background:#fff; border-radius:12px; box-shadow:0 12px 32px rgba(0,0,0,0.18); padding:20px 24px; width:90%; max-height:90vh; overflow-y:auto; }
.modal-head { display:flex; justify-content:space-between; gap:12px; align-items:flex-start; }
.modal-kicker { text-transform:uppercase; letter-spacing:0.08em; color:#9b1c2c; font-size:11px; margin:0 0 4px; }
.modal-card h3 { margin:0; font-size:20px; }
.modal-close { border:none; background:transparent; color:#6b7280; font-size:18px; cursor:pointer; }
.modal-actions { display:flex; gap:12px; justify-content:flex-end; flex-wrap:wrap; }
.file-row { margin-bottom:8px; }
</style>
@endpush

@push('scripts')
<script src="https://cdn.ckeditor.com/ckeditor5/41.2.1/classic/ckeditor.js"></script>
<script>
let projSummaryEditor = null;
let updBodyEditor = null;

document.addEventListener('DOMContentLoaded', () => {
    ClassicEditor.create(document.querySelector('#proj_summary')).then(e=>projSummaryEditor=e);
    ClassicEditor.create(document.querySelector('#upd_body')).then(e=>updBodyEditor=e);

    const projForm = document.getElementById('projectForm');
    if (projForm) {
        projForm.addEventListener('submit', () => {
            if (projSummaryEditor) {
                document.getElementById('proj_summary').value = projSummaryEditor.getData();
            }
        });
    }

    const updForm = document.getElementById('updateForm');
    if (updForm) {
        updForm.addEventListener('submit', () => {
            if (updBodyEditor) {
                document.getElementById('upd_body').value = updBodyEditor.getData();
            }
        });
    }
});

function openProjectModal() {
    const modal = document.getElementById('projectModal');
    const form = document.getElementById('projectForm');
    document.getElementById('projectModalTitle').innerHTML = '<i class="fa-solid fa-plus"></i> Add Project';
    form.action = "{{ route('admin.flagship-projects.store') }}";
    const existingMethod = form.querySelector('input[name=\"_method\"]');
    if (existingMethod) existingMethod.remove();
    form.reset();
    if (projSummaryEditor) projSummaryEditor.setData('');
    modal.classList.add('show');
}
function closeProjectModal() {
    document.getElementById('projectModal').classList.remove('show');
    const m = document.querySelector('#projectForm input[name=\"_method\"]'); if (m) m.remove();
}

function openUpdateModal(projectId) {
    const modal = document.getElementById('updateModal');
    const form = document.getElementById('updateForm');
    document.getElementById('updateModalTitle').innerHTML = '<i class=\"fa-solid fa-plus\"></i> Add Update';
    form.action = "{{ url('admin/flagship-projects') }}/" + projectId + "/updates";
    const m = form.querySelector('input[name=\"_method\"]'); if (m) m.remove();
    form.reset();
    if (updBodyEditor) updBodyEditor.setData('');
    document.getElementById('updFileRepeater').innerHTML = '';
    addUpdFileRow();
    modal.classList.add('show');
}
function closeUpdateModal() {
    document.getElementById('updateModal').classList.remove('show');
    const m = document.querySelector('#updateForm input[name=\"_method\"]'); if (m) m.remove();
}

function addUpdFileRow(data = {label:'', file_url:''}) {
    const wrap = document.getElementById('updFileRepeater');
    const index = wrap.children.length;
    const row = document.createElement('div'); row.className='file-row';
    row.innerHTML = `
        <input type=\"text\" name=\"files[${index}][label]\" class=\"settings-input\" placeholder=\"Label (optional)\" value=\"${data.label || ''}\" style=\"margin-bottom:6px;\">
        <div style=\"display:flex; gap:8px; align-items:center;\">
            <input type=\"url\" name=\"files[${index}][file_url]\" class=\"settings-input\" placeholder=\"https://example.com/file.pdf\" value=\"${data.file_url || ''}\">
            <button type=\"button\" class=\"action-icon-btn danger\" title=\"Remove\" onclick=\"this.closest('.file-row').remove();\"><i class=\"fa-solid fa-trash\"></i></button>
        </div>`;
    wrap.appendChild(row);
}
</script>
@endpush
