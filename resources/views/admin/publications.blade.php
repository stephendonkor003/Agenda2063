@extends('layouts.admin')

@section('title', 'Publications')
@section('page-title', 'Publications')

@section('content')
@php use Illuminate\Support\Str; @endphp

    <div class="page-header-banner">
        <div class="page-header-text">
            <h1><i class="fa-solid fa-file-alt"></i> Publications</h1>
            <p>Manage reports, policy briefs, research papers, and official publications.</p>
        </div>
        <div class="page-header-actions">
            <form method="GET" action="{{ route('admin.publications') }}">
                <button class="btn-outline-admin" type="submit"><i class="fa-solid fa-arrows-rotate"></i> Reset Filters</button>
            </form>
            <button class="btn-primary-admin" onclick="openPubModal()" type="button"><i class="fa-solid fa-plus"></i> Add Publication</button>
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
            <div class="alert-body">
                Please fix the highlighted fields.
                <ul style="margin:6px 0 0 18px; text-align:left;">
                    @foreach($errors->all() as $err)
                        <li>{{ $err }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    <form class="admin-toolbar" method="GET" action="{{ route('admin.publications') }}" style="flex-wrap:wrap; gap:10px;">
        <div class="toolbar-search">
            <i class="fa-solid fa-search"></i>
            <input type="text" name="q" value="{{ request('q') }}" placeholder="Search publications...">
        </div>
        <div class="toolbar-filters">
            <select class="filter-select" name="type" onchange="this.form.submit()">
                <option value="">All Types</option>
                @foreach($types as $type)
                    <option value="{{ $type }}" @selected(request('type')===$type)>{{ ucfirst(str_replace('-',' ', $type)) }}</option>
                @endforeach
            </select>
            <select class="filter-select" name="language" onchange="this.form.submit()">
                <option value="">All Languages</option>
                @foreach($languages as $lang)
                    <option value="{{ $lang }}" @selected(request('language')===$lang)>{{ $lang }}</option>
                @endforeach
            </select>
            <select class="filter-select" name="year" onchange="this.form.submit()">
                <option value="">All Years</option>
                @foreach($years as $yr)
                    <option value="{{ $yr }}" @selected(request('year')==$yr)>{{ $yr }}</option>
                @endforeach
            </select>
            @if($canViewAll)
                <select class="filter-select" name="department_id" onchange="this.form.submit()">
                    <option value="">All Departments</option>
                    @foreach($departments as $dept)
                        <option value="{{ $dept->id }}" @selected(request('department_id')==$dept->id)>{{ $dept->name }}</option>
                    @endforeach
                </select>
            @endif
        </div>
        <div style="flex:1;"></div>
        <button class="btn-primary-admin" type="submit"><i class="fa-solid fa-filter"></i> Apply</button>
    </form>

    <div class="admin-table-card">
        <div id="pubTableButtons" class="datatable-buttons"></div>
        <table class="admin-table" id="pubTable">
            <thead>
                <tr>
                    <th>Publication</th>
                    <th>Type</th>
                    <th>Language</th>
                    <th>Year</th>
                    <th>Status</th>
                    <th>Downloads</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($publications as $pub)
                    <tr>
                        <td>
                            <div class="table-title-cell">
                                @if($pub->image_url)
                                    <img src="{{ $pub->image_url }}" alt="banner" style="width:56px; height:38px; object-fit:cover; border-radius:6px; margin-right:10px;">
                                @endif
                                <div class="doc-icon pdf"><i class="fa-solid fa-file-pdf"></i></div>
                                <div>
                                    <span class="table-title">{{ $pub->title }}</span>
                                    <span class="table-subtitle">{{ Str::limit($pub->summary ?: 'No summary', 90) }}</span>
                                    <span class="table-subtitle">Created by: {{ $pub->creator?->name ?? 'N/A' }}</span>
                                </div>
                            </div>
                        </td>
                        <td><span class="category-badge blue">{{ ucfirst(str_replace('-',' ', $pub->type)) }}</span></td>
                        <td>{{ $pub->language ?: '—' }}</td>
                        <td>{{ $pub->year ?: '—' }}</td>
                        <td>
                            @php $status = $pub->status ?? 'pending'; @endphp
                            <span class="status-badge {{ $status }}">
                                {{ ucfirst($status) }}
                            </span>
                            @if($pub->approver && $status==='approved')
                                <div class="table-subtitle">By {{ $pub->approver->name }}</div>
                            @elseif($pub->rejector && $status==='rejected')
                                <div class="table-subtitle">By {{ $pub->rejector->name }}</div>
                            @endif
                        </td>
                        <td>{{ $pub->downloads }}</td>
                        <td>
                            <div class="table-actions">
                                <button class="action-icon-btn" title="Edit"
                                    data-action="{{ route('admin.publications.update', $pub) }}"
                                    data-title="{{ $pub->title }}"
                                    data-summary="{{ $pub->summary }}"
                                    data-type="{{ $pub->type }}"
                                    data-language="{{ $pub->language }}"
                                    data-year="{{ $pub->year }}"
                                    data-files='@json($pub->files->map(fn($f)=>["label"=>$f->label,"file_url"=>$f->file_url]))'
                                    data-slug="{{ $pub->slug }}"
                                    data-department="{{ $pub->department_id }}"
                                    data-status="{{ $pub->status }}"
                                    onclick="openPubModal(this)">
                                    <i class="fa-solid fa-pen"></i>
                                </button>
                                <form method="POST" action="{{ route('admin.publications.destroy', $pub) }}" onsubmit="return confirm('Delete {{ $pub->title }}?')" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button class="action-icon-btn danger" title="Delete"><i class="fa-solid fa-trash"></i></button>
                                </form>
                                @if($pub->status === 'pending' || $pub->status === 'rejected')
                                    <form method="POST" action="{{ route('admin.publications.approve', $pub) }}" style="display:inline;">
                                        @csrf
                                        <button class="action-icon-btn" title="Approve"><i class="fa-solid fa-check"></i></button>
                                    </form>
                                @endif
                                @if($pub->status === 'pending' || $pub->status === 'approved')
                                    <form method="POST" action="{{ route('admin.publications.reject', $pub) }}" style="display:inline;">
                                        @csrf
                                        <button class="action-icon-btn danger" title="Reject"><i class="fa-solid fa-ban"></i></button>
                                    </form>
                                @endif
                                @if($pub->file_url)
                                    <a class="action-icon-btn" href="{{ $pub->file_url }}" target="_blank" title="Open file"><i class="fa-solid fa-arrow-up-right-from-square"></i></a>
                                @endif
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" style="text-align:center; padding:20px;">No publications found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div style="padding: 12px 16px;">
            {{ $publications->links() }}
        </div>
    </div>

    <!-- Publication Modal -->
    <div id="pubModal" class="modal-backdrop">
        <div class="modal-card" style="max-width:720px;">
            <div class="modal-head">
                <div>
                    <p class="modal-kicker">Publication</p>
                    <h3 id="pubModalTitle"><i class="fa-solid fa-plus"></i> Add Publication</h3>
                </div>
                <button class="modal-close" type="button" onclick="closePubModal()"><i class="fa-solid fa-xmark"></i></button>
            </div>
            <p class="modal-sub">Fill in details; optional file URL can be a public link.</p>
            <form id="pubForm" method="POST" action="{{ route('admin.publications.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="settings-row">
                    <div class="settings-field" style="min-width:280px;">
                        <label for="pub_title">Title</label>
                        <input id="pub_title" name="title" type="text" class="settings-input" required>
                    </div>
                    <div class="settings-field" style="min-width:180px;">
                        <label for="pub_type">Type</label>
                        <select id="pub_type" name="type" class="settings-select" required>
                            @foreach(['report','policy-brief','research-paper','communique'] as $type)
                                <option value="{{ $type }}">{{ ucfirst(str_replace('-',' ', $type)) }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="settings-row">
                    <div class="settings-field" style="min-width:160px;">
                        <label for="pub_language">Language</label>
                        <input id="pub_language" name="language" type="text" class="settings-input" placeholder="English">
                    </div>
                    <div class="settings-field" style="min-width:120px;">
                        <label for="pub_year">Year</label>
                        <input id="pub_year" name="year" type="number" class="settings-input" min="1900" max="{{ date('Y') }}">
                    </div>
                    <div class="settings-field" style="min-width:200px;">
                        <label for="pub_slug">Slug (optional)</label>
                        <input id="pub_slug" name="slug" type="text" class="settings-input" placeholder="auto-generated">
                    </div>
                    <div class="settings-field" style="min-width:160px;">
                        <label for="pub_status">Status</label>
                        <select id="pub_status" name="status" class="settings-select">
                            <option value="pending">Pending</option>
                            <option value="approved">Approved</option>
                            <option value="rejected">Rejected</option>
                        </select>
                    </div>
                </div>
                @if($canViewAll)
                <div class="settings-field" style="min-width:200px;">
                    <label for="pub_department">Department</label>
                    <select id="pub_department" name="department_id" class="settings-select">
                        @foreach($departments as $dept)
                            <option value="{{ $dept->id }}">{{ $dept->name }}</option>
                        @endforeach
                    </select>
                </div>
                @endif
                <div class="settings-field">
                    <label for="pub_banner">Banner Image (optional)</label>
                    <input id="pub_banner" name="banner" type="file" accept="image/*" class="settings-input">
                    <p class="settings-hint">Upload a cover image for this publication.</p>
                </div>
                <div class="settings-field">
                    <label>Attachments (URLs)</label>
                    <div id="fileRepeater">
                    <div class="file-row">
                        <input type="text" name="files[0][label]" class="settings-input" placeholder="Label (optional)" style="margin-bottom:6px;">
                        <input type="url" name="files[0][file_url]" class="settings-input" placeholder="https://example.com/file.pdf">
                    </div>
                </div>
                <button type="button" class="btn-outline-admin" onclick="addFileRow()" style="margin-top:8px;"><i class="fa-solid fa-plus"></i> Add Attachment</button>
            </div>
            <div class="settings-field">
                <label>Upload Files (optional)</label>
                <input type="file" name="upload_files[]" multiple class="settings-input" accept=".pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx,.txt">
                <p class="settings-hint">You can upload multiple files; they will be attached to this publication.</p>
            </div>
                <div class="settings-field">
                    <label for="pub_summary">Summary (rich text)</label>
                    <textarea id="pub_summary" name="summary" class="settings-textarea" rows="6" placeholder="Short description with formatting"></textarea>
                </div>
                <div class="modal-actions" style="margin-top:12px;">
                    <button type="button" class="btn-outline-admin" onclick="closePubModal()">Cancel</button>
                    <button type="submit" class="btn-primary-admin"><i class="fa-solid fa-save"></i> Save</button>
                </div>
            </form>
        </div>
    </div>

@endsection

@push('styles')
<!-- DataTables + Buttons -->
<link rel="stylesheet" href="https://cdn.datatables.net/v/bs5/dt-2.0.3/b-3.0.1/b-colvis-3.0.1/r-3.0.1/datatables.min.css">
<style>
.modal-backdrop { position:fixed; inset:0; background:rgba(0,0,0,0.35); display:none; align-items:center; justify-content:center; z-index:1000;}
.modal-backdrop.show { display:flex; }
.modal-card { background: var(--card-bg, #fff); color: var(--text, #1c1c1c); border-radius: 12px; box-shadow: 0 12px 32px rgba(0,0,0,0.18); padding: 20px 24px; width: 90%; max-height: 90vh; overflow-y: auto; }
.modal-head { display:flex; justify-content:space-between; gap:12px; align-items:flex-start;}
.modal-kicker { text-transform: uppercase; letter-spacing: 0.1em; color:#9b1c2c; font-size:11px; margin:0 0 4px;}
.modal-card h3 { margin:0; font-size:20px;}
.modal-sub { margin:6px 0 12px; color:#6b7280;}
.modal-close { border:none; background:transparent; color:#6b7280; font-size:18px; cursor:pointer;}
.modal-actions { display:flex; gap:12px; justify-content:flex-end; flex-wrap:wrap;}
.modal-card .btn-primary-admin { background:#822b39; color:#fff; border:none;}
.modal-card .btn-primary-admin:hover { background:#6d202f; }
.modal-card .btn-outline-admin { border:1px solid #d1d5db; color:#374151; background:#fff;}
.modal-card .btn-outline-admin:hover { border-color:#9ca3af; color:#111827;}
.category-badge { padding:6px 10px; border-radius:999px; font-size:12px; background:#eef2ff; color:#1f2937;}
.status-badge { padding:6px 10px; border-radius:999px; font-size:12px; color:#fff; }
.status-badge.approved { background:#16a34a; }
.status-badge.pending { background:#f59e0b; }
.status-badge.rejected { background:#dc2626; }
.datatable-buttons { display:flex; flex-wrap:wrap; gap:8px; margin-bottom:10px;}
#pubTable { width:100% !important; }
#pubTable thead th { background:#f8fafc; }
#pubTable tbody tr:nth-child(even) { background:#f9fafb; }
#pubTable tbody tr:hover { background:#f1f5f9; }
.dt-buttons .btn-outline-admin,
.dt-buttons .btn-primary-admin {
    padding: 6px 10px;
}
.dt-button { border: 1px solid #d1d5db; background:#fff; color:#374151; border-radius:6px; padding:6px 10px; }
.dt-button:hover { border-color:#9ca3af; color:#111827; }
.dt-button.buttons-collection { background:#fff; }
</style>
@endpush

@push('scripts')
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/v/bs5/dt-2.0.3/b-3.0.1/b-colvis-3.0.1/r-3.0.1/datatables.min.js"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/41.2.1/classic/ckeditor.js"></script>
<script>
let summaryEditor = null;

function openPubModal(btn = null) {
    const modal = document.getElementById('pubModal');
    const form = document.getElementById('pubForm');
    document.getElementById('pubModalTitle').innerHTML = '<i class="fa-solid fa-plus"></i> Add Publication';
    form.action = "{{ route('admin.publications.store') }}";
    const existingMethod = form.querySelector('input[name="_method"]');
    if (existingMethod) existingMethod.remove();

    // reset fields
    form.reset();
    // clear file input
    const fileInput = form.querySelector('input[type="file"]');
    if (fileInput) fileInput.value = '';
    if (summaryEditor) summaryEditor.setData('');

    if (btn) {
        document.getElementById('pubModalTitle').innerHTML = '<i class="fa-solid fa-pen"></i> Edit Publication';
        form.action = btn.getAttribute('data-action');
        let method = document.createElement('input');
        method.type = 'hidden';
        method.name = '_method';
        method.value = 'PUT';
        form.appendChild(method);

        document.getElementById('pub_title').value = btn.getAttribute('data-title');
        const summaryVal = btn.getAttribute('data-summary') || '';
        if (summaryEditor) {
            summaryEditor.setData(summaryVal);
        } else {
            document.getElementById('pub_summary').value = summaryVal;
        }
        document.getElementById('pub_type').value = btn.getAttribute('data-type') || '';
        document.getElementById('pub_language').value = btn.getAttribute('data-language') || '';
        document.getElementById('pub_year').value = btn.getAttribute('data-year') || '';
        document.getElementById('pub_slug').value = btn.getAttribute('data-slug') || '';
        @if($canViewAll)
        document.getElementById('pub_department').value = btn.getAttribute('data-department') || '';
        @endif
        const statusSelect = document.getElementById('pub_status');
        if (statusSelect) statusSelect.value = btn.getAttribute('data-status') || 'pending';

        // attachments
        const files = JSON.parse(btn.getAttribute('data-files') || '[]');
        rebuildFileRows(files);
    } else {
        rebuildFileRows([]);
    }

    modal.classList.add('show');
}

function closePubModal() {
    const modal = document.getElementById('pubModal');
    modal.classList.remove('show');
    // remove _method if exists for next create
    const method = document.querySelector('#pubForm input[name="_method"]');
    if (method) method.remove();
}

document.addEventListener('DOMContentLoaded', () => {
const pubModalEl = document.getElementById('pubModal');
if (pubModalEl) {
    pubModalEl.addEventListener('click', (e) => {
        if (e.target.id === 'pubModal') closePubModal();
    });
}
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') closePubModal();
    });

    // column toggles
    document.querySelectorAll('.column-toggles input[type="checkbox"]').forEach(cb => {
        cb.addEventListener('change', () => toggleColumn(cb.dataset.col, cb.checked));
    });
});

// DataTable init
$(function() {
    const table = $('#pubTable').DataTable({
        responsive: true,
        paging: true,
        pageLength: 10,
        lengthMenu: [10,25,50,100],
        order: [[0,'asc']],
        dom: 'Bfrtip',
        buttons: [
            { extend: 'copy', className: 'btn-outline-admin' },
            { extend: 'csv', className: 'btn-outline-admin' },
            { extend: 'excel', className: 'btn-outline-admin' },
            { extend: 'pdf', className: 'btn-outline-admin' },
            { extend: 'print', className: 'btn-outline-admin' },
            { extend: 'colvis', className: 'btn-outline-admin' },
        ]
    });
    table.buttons().container().appendTo('#pubTableButtons');
});

// CKEditor init
ClassicEditor
    .create(document.querySelector('#pub_summary'), {
        toolbar: ['heading','bold','italic','link','bulletedList','numberedList','blockQuote','undo','redo'],
        heading: {
            options: [
                { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                { model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3' },
                { model: 'heading4', view: 'h4', title: 'Heading 4', class: 'ck-heading_heading4' },
            ]
        }
    })
    .then(editor => { summaryEditor = editor; })
    .catch(error => console.error(error));

function addFileRow(data = {label:'', file_url:''}) {
    const wrap = document.getElementById('fileRepeater');
    const index = wrap.children.length;
    const row = document.createElement('div');
    row.className = 'file-row';
    row.innerHTML = `
        <input type="text" name="files[${index}][label]" class="settings-input" placeholder="Label (optional)" value="${data.label || ''}" style="margin-bottom:6px;">
        <div style="display:flex; gap:8px; align-items:center;">
            <input type="url" name="files[${index}][file_url]" class="settings-input" placeholder="https://example.com/file.pdf" value="${data.file_url || ''}">
            <button type="button" class="action-icon-btn danger" title="Remove" onclick="this.closest('.file-row').remove();"><i class="fa-solid fa-trash"></i></button>
        </div>
    `;
    wrap.appendChild(row);
}

function rebuildFileRows(files) {
    const wrap = document.getElementById('fileRepeater');
    wrap.innerHTML = '';
    if (!files || files.length === 0) {
        addFileRow();
        return;
    }
    files.forEach(f => addFileRow(f));
}

function toggleColumn(colKey, show) {
    const map = { type:2, language:3, year:4, downloads:5 }; // 1-based table positions
    const idx = map[colKey];
    if (!idx) return;
    document.querySelectorAll(`#pubTable th:nth-child(${idx}), #pubTable td:nth-child(${idx})`).forEach(el => {
        el.style.display = show ? '' : 'none';
    });
}

function exportTable(format) {
    const table = document.getElementById('pubTable');
    if (!table) return;
    const rows = Array.from(table.querySelectorAll('tr')).map(tr =>
        Array.from(tr.querySelectorAll('th,td')).map(td => td.innerText.replace(/\s+/g,' ').trim())
    );
    const csv = rows.map(r => r.map(v => `"${v.replace(/"/g,'""')}"`).join(',')).join('\n');
    const blob = new Blob([csv], {type:'text/csv;charset=utf-8;'});
    const url = URL.createObjectURL(blob);
    const a = document.createElement('a');
    a.href = url;
    a.download = `publications.${format === 'excel' ? 'csv' : 'csv'}`;
    document.body.appendChild(a);
    a.click();
    a.remove();
    URL.revokeObjectURL(url);
}
</script>
@endpush
