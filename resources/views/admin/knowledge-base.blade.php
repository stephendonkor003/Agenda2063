@extends('layouts.admin')

@section('title', 'Knowledge Base')
@section('page-title', 'Knowledge Base')

@section('content')
    <div class="page-header-banner">
        <div class="page-header-text">
            <h1><i class="fa-solid fa-book-open"></i> Knowledge Base</h1>
            <p>Manage documents, publications, and downloadable resources.</p>
        </div>
        <div class="page-header-actions">
            <button class="btn-outline-admin" onclick="openCategoryModal()"><i class="fa-solid fa-folder-plus"></i> New Category</button>
            <button class="btn-primary-admin" onclick="openDocumentModal()"><i class="fa-solid fa-upload"></i> Upload Document</button>
        </div>
    </div>

    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon blue"><i class="fa-solid fa-file-alt"></i></div>
            <div class="stat-details">
                <span class="stat-number">{{ $stats['documents'] }}</span>
                <span class="stat-label">Total Documents</span>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon green"><i class="fa-solid fa-folder"></i></div>
            <div class="stat-details">
                <span class="stat-number">{{ $stats['categories'] }}</span>
                <span class="stat-label">Categories</span>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon gold"><i class="fa-solid fa-download"></i></div>
            <div class="stat-details">
                <span class="stat-number">{{ number_format($stats['downloads']) }}</span>
                <span class="stat-label">Total Downloads</span>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon maroon"><i class="fa-solid fa-hard-drive"></i></div>
            <div class="stat-details">
                <span class="stat-number">{{ number_format($stats['storage'], 2) }} MB</span>
                <span class="stat-label">Storage Used</span>
            </div>
        </div>
    </div>

    @if(session('status'))
        <div class="alert success"><div class="alert-icon"><i class="fa-solid fa-check-circle"></i></div><div class="alert-body">{{ session('status') }}</div></div>
    @endif
    @if($errors->any())
        <div class="alert error"><div class="alert-icon"><i class="fa-solid fa-triangle-exclamation"></i></div><div class="alert-body">Please fix the highlighted fields.</div></div>
    @endif

    <div class="admin-toolbar">
        <div class="toolbar-search">
            <i class="fa-solid fa-search"></i>
            <input type="text" id="docSearch" placeholder="Search documents...">
        </div>
        <div class="toolbar-filters">
            <select id="filterCategory" class="filter-select">
                <option value="">All Categories</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                @endforeach
            </select>
            <select id="filterType" class="filter-select">
                <option value="">All Types</option>
                <option value="file">File</option>
                <option value="link">Link</option>
            </select>
            <select id="filterStatus" class="filter-select">
                <option value="">All Statuses</option>
                <option value="published">Published</option>
                <option value="draft">Draft</option>
                <option value="archived">Archived</option>
            </select>
        </div>
    </div>

    <div class="admin-table-card">
        <table class="admin-table" id="docsTable">
            <thead>
                <tr>
                    <th>Document</th>
                    <th>Category</th>
                    <th>Type</th>
                    <th>Status</th>
                    <th>Size</th>
                    <th>Downloads</th>
                    <th>Uploaded</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($documents as $doc)
                <tr data-category="{{ $doc->category_id }}" data-type="{{ $doc->type }}" data-status="{{ $doc->status }}">
                    <td>
                        <div class="table-title-cell">
                            <div class="doc-icon {{ $doc->type === 'link' ? 'link' : 'pdf' }}"><i class="fa-solid fa-file"></i></div>
                            <div>
                                <span class="table-title">{{ $doc->title }}</span>
                                <span class="table-subtitle">{{ \Illuminate\Support\Str::limit(strip_tags($doc->summary), 80) }}</span>
                            </div>
                        </div>
                    </td>
                    <td><span class="category-badge blue">{{ $doc->category?->name ?? 'Uncategorised' }}</span></td>
                    <td>{{ ucfirst($doc->type) }}</td>
                    <td><span class="tag status {{ $doc->status }}">{{ ucfirst($doc->status) }}</span></td>
                    <td>{{ $doc->size_bytes ? number_format($doc->size_bytes/1024/1024,2).' MB' : '—' }}</td>
                    <td>{{ $doc->downloads }}</td>
                    <td>{{ $doc->created_at?->format('M d, Y') }}</td>
                    <td>
                        <div class="table-actions">
                            <button class="action-icon-btn" title="Edit" onclick='editDoc(@json($doc))'><i class="fa-solid fa-pen"></i></button>
                            <a class="action-icon-btn" title="Download/Visit" href="{{ route('knowledge.download', $doc->slug) }}" target="_blank"><i class="fa-solid fa-download"></i></a>
                            <form method="POST" action="{{ route('admin.knowledge-base.documents.destroy', $doc) }}" style="display:inline;" onsubmit="return confirm('Delete {{ $doc->title }}?')">
                                @csrf @method('DELETE')
                                <button class="action-icon-btn danger" title="Delete"><i class="fa-solid fa-trash"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="admin-table-card" style="margin-top:12px;">
        <div class="flex-between" style="margin-bottom:8px;">
            <h3 style="margin:0;">Categories</h3>
            <button class="btn-outline-admin" onclick="openCategoryModal()"><i class="fa-solid fa-plus"></i> Add Category</button>
        </div>
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Docs</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($categories as $cat)
                <tr>
                    <td>{{ $cat->name }}</td>
                    <td>{{ \Illuminate\Support\Str::limit($cat->description, 80) }}</td>
                    <td>{{ $cat->documents()->count() }}</td>
                    <td>
                        <div class="table-actions">
                            <button class="action-icon-btn" title="Edit" onclick='openCategoryModal(@json($cat))'><i class="fa-solid fa-pen"></i></button>
                            <form method="POST" action="{{ route('admin.knowledge-base.categories.destroy', $cat) }}" style="display:inline;" onsubmit="return confirm('Delete {{ $cat->name }}?')">
                                @csrf @method('DELETE')
                                <button class="action-icon-btn danger" title="Delete"><i class="fa-solid fa-trash"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Category Modal -->
    <div id="categoryModal" class="modal-backdrop">
        <div class="modal-card" style="max-width:520px;">
            <div class="modal-head">
                <div>
                    <p class="modal-kicker">Knowledge Base</p>
                    <h3 id="categoryModalTitle"><i class="fa-solid fa-folder-plus"></i> New Category</h3>
                </div>
                <button class="modal-close" type="button" onclick="closeCategoryModal()"><i class="fa-solid fa-xmark"></i></button>
            </div>
            <form id="categoryForm" method="POST" action="{{ route('admin.knowledge-base.categories.store') }}">
                @csrf
                <input type="hidden" name="_method" id="categoryMethod" value="POST">
                <div class="settings-field">
                    <label>Name</label>
                    <input type="text" name="name" id="cat_name" class="settings-input" required>
                </div>
                <div class="settings-field">
                    <label>Color (hex or name)</label>
                    <input type="text" name="color" id="cat_color" class="settings-input" placeholder="#2563eb">
                </div>
                <div class="settings-field">
                    <label>Description</label>
                    <textarea name="description" id="cat_description" class="settings-textarea" rows="3"></textarea>
                </div>
                <div class="modal-actions">
                    <button type="button" class="btn-outline-admin" onclick="closeCategoryModal()">Cancel</button>
                    <button type="submit" class="btn-primary-admin"><i class="fa-solid fa-save"></i> Save</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Document Modal -->
    <div id="documentModal" class="modal-backdrop">
        <div class="modal-card" style="max-width:820px;">
            <div class="modal-head">
                <div>
                    <p class="modal-kicker">Knowledge Base</p>
                    <h3 id="documentModalTitle"><i class="fa-solid fa-upload"></i> Upload Document</h3>
                </div>
                <button class="modal-close" type="button" onclick="closeDocumentModal()"><i class="fa-solid fa-xmark"></i></button>
            </div>
            <form id="documentForm" method="POST" action="{{ route('admin.knowledge-base.documents.store') }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="_method" id="documentMethod" value="POST">
                <div class="settings-row">
                    <div class="settings-field" style="min-width:280px;">
                        <label>Title</label>
                        <input type="text" name="title" id="doc_title" class="settings-input" required>
                    </div>
                    <div class="settings-field" style="min-width:180px;">
                        <label>Category</label>
                        <select name="category_id" id="doc_category" class="settings-select">
                            <option value="">Uncategorised</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="settings-field" style="min-width:160px;">
                        <label>Status</label>
                        <select name="status" id="doc_status" class="settings-select">
                            <option value="published">Published</option>
                            <option value="draft">Draft</option>
                            <option value="archived">Archived</option>
                        </select>
                    </div>
                    @if($canViewAll)
                    <div class="settings-field" style="min-width:200px;">
                        <label>Department</label>
                        <select name="department_id" id="doc_department" class="settings-select">
                            <option value="">Unassigned</option>
                            @foreach($departments as $dept)
                                <option value="{{ $dept->id }}">{{ $dept->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    @endif
                </div>

                <div class="settings-row">
                    <div class="settings-field" style="flex:1;">
                        <label>Type</label>
                        <select name="type" id="doc_type" class="settings-select" onchange="toggleDocType()">
                            <option value="file">File upload</option>
                            <option value="link">External link</option>
                        </select>
                    </div>
                    <div class="settings-field" style="flex:1;" id="fileField">
                        <label>File Upload</label>
                        <input type="file" name="file_upload" class="settings-input">
                        <p class="settings-hint">Up to 50MB. PDFs, Word, Excel, PPT supported.</p>
                    </div>
                    <div class="settings-field" style="flex:1; display:none;" id="linkField">
                        <label>Source URL</label>
                        <input type="url" name="source_url" id="doc_source_url" class="settings-input" placeholder="https://...">
                    </div>
                </div>

                <div class="settings-field">
                    <label>Summary</label>
                    <textarea name="summary" id="doc_summary" class="settings-textarea" rows="3"></textarea>
                </div>
                <div class="settings-field">
                    <label>Body (rich text)</label>
                    <textarea name="body" id="doc_body" class="settings-textarea" rows="8"></textarea>
                </div>

                <div class="modal-actions">
                    <button type="button" class="btn-outline-admin" onclick="closeDocumentModal()">Cancel</button>
                    <button type="submit" class="btn-primary-admin"><i class="fa-solid fa-save"></i> Save</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('styles')
<style>
.stats-grid { display:grid; grid-template-columns:repeat(auto-fit,minmax(210px,1fr)); gap:12px; margin-bottom:14px; }
.stat-card { background:#fff; border:1px solid #e5e7eb; border-radius:12px; padding:12px; display:flex; align-items:center; gap:10px; box-shadow:0 10px 24px rgba(15,23,42,0.06); }
.stat-icon { width:44px; height:44px; border-radius:12px; display:flex; align-items:center; justify-content:center; color:#fff; }
.stat-icon.blue { background:#2563eb; }
.stat-icon.green { background:#16a34a; }
.stat-icon.gold { background:#d97706; }
.stat-icon.maroon { background:#7f1d1d; }
.stat-details { display:flex; flex-direction:column; }
.stat-number { font-weight:700; font-size:18px; }
.stat-label { color:#6b7280; font-size:12px; }
.admin-toolbar { margin:14px 0; display:flex; flex-wrap:wrap; gap:10px; align-items:center; }
.toolbar-search { background:#fff; border:1px solid #e5e7eb; border-radius:12px; padding:8px 12px; display:flex; align-items:center; gap:8px; flex:1; min-width:260px; box-shadow:0 8px 20px rgba(0,0,0,0.04); }
.toolbar-search input { border:none; outline:none; width:100%; }
.toolbar-filters { display:flex; gap:8px; flex-wrap:wrap; }
.filter-select { border:1px solid #e5e7eb; border-radius:10px; padding:8px 10px; background:#fff; min-width:150px; }
.admin-table-card { background:#fff; border:1px solid #e5e7eb; border-radius:12px; box-shadow:0 12px 24px rgba(0,0,0,0.05); padding:10px; }
.admin-table { width:100%; border-collapse:collapse; }
.admin-table th, .admin-table td { padding:12px; text-align:left; border-bottom:1px solid #e5e7eb; }
.table-title-cell { display:flex; gap:10px; align-items:center; }
.doc-icon { width:40px; height:40px; border-radius:10px; display:flex; align-items:center; justify-content:center; color:#fff; }
.doc-icon.pdf { background:#ef4444; }
.doc-icon.link { background:#3b82f6; }
.table-title { font-weight:700; display:block; }
.table-subtitle { color:#6b7280; font-size:12px; display:block; }
.category-badge { padding:4px 8px; border-radius:999px; background:#eef2ff; color:#312e81; font-size:12px; }
.tag.status { padding:4px 8px; border-radius:999px; font-size:12px; border:1px solid #e5e7eb; }
.tag.status.published { background:#ecfdf3; color:#15803d; border-color:#bbf7d0; }
.tag.status.draft { background:#fff7ed; color:#c2410c; border-color:#fed7aa; }
.tag.status.archived { background:#f3f4f6; color:#374151; }
.table-actions { display:flex; gap:6px; }
.modal-backdrop { position:fixed; inset:0; background:rgba(0,0,0,0.35); display:none; align-items:center; justify-content:center; z-index:1100; }
.modal-backdrop.show { display:flex; }
.modal-card { background:#fff; border-radius:12px; box-shadow:0 12px 32px rgba(0,0,0,0.18); padding:20px 24px; width:90%; max-height:90vh; overflow-y:auto; }
.modal-head { display:flex; justify-content:space-between; gap:12px; align-items:flex-start; }
.modal-kicker { text-transform:uppercase; letter-spacing:0.08em; color:#9b1c2c; font-size:11px; margin:0 0 4px; }
.modal-card h3 { margin:0; font-size:20px; }
.modal-close { border:none; background:transparent; color:#6b7280; font-size:18px; cursor:pointer; }
.modal-actions { display:flex; gap:12px; justify-content:flex-end; flex-wrap:wrap; margin-top:10px; }
.flex-between { display:flex; justify-content:space-between; align-items:center; }
.settings-field label { font-weight:700; color:#0f172a; }
.settings-input, .settings-select, .settings-textarea { border-radius:10px; }
</style>
@endpush

@push('scripts')
<script src="https://cdn.ckeditor.com/ckeditor5/41.2.1/classic/ckeditor.js"></script>
<script>
let docBodyEditor = null;
ClassicEditor.create(document.querySelector('#doc_body')).then(e => docBodyEditor = e).catch(console.error);

function toggleDocType() {
    const type = document.getElementById('doc_type').value;
    document.getElementById('fileField').style.display = type === 'file' ? 'block' : 'none';
    document.getElementById('linkField').style.display = type === 'link' ? 'block' : 'none';
}

function openCategoryModal(cat = null) {
    const form = document.getElementById('categoryForm');
    document.getElementById('categoryModalTitle').innerHTML = cat ? '<i class="fa-solid fa-pen"></i> Edit Category' : '<i class="fa-solid fa-folder-plus"></i> New Category';
    form.action = cat ? "{{ url('admin/knowledge-base/categories') }}/" + cat.id : "{{ route('admin.knowledge-base.categories.store') }}";
    document.getElementById('categoryMethod').value = cat ? 'PUT' : 'POST';
    document.getElementById('cat_name').value = cat ? cat.name : '';
    document.getElementById('cat_color').value = cat ? (cat.color || '') : '';
    document.getElementById('cat_description').value = cat ? (cat.description || '') : '';
    document.getElementById('categoryModal').classList.add('show');
}
function closeCategoryModal() {
    document.getElementById('categoryModal').classList.remove('show');
}

function openDocumentModal() {
    const form = document.getElementById('documentForm');
    document.getElementById('documentModalTitle').innerHTML = '<i class="fa-solid fa-upload"></i> Upload Document';
    form.action = "{{ route('admin.knowledge-base.documents.store') }}";
    document.getElementById('documentMethod').value = 'POST';
    form.reset();
    if (docBodyEditor) docBodyEditor.setData('');
    toggleDocType();
    document.getElementById('documentModal').classList.add('show');
}

function closeDocumentModal() {
    document.getElementById('documentModal').classList.remove('show');
}

function editDoc(doc) {
    const form = document.getElementById('documentForm');
    document.getElementById('documentModalTitle').innerHTML = '<i class="fa-solid fa-pen"></i> Edit Document';
    form.action = "{{ url('admin/knowledge-base/documents') }}/" + doc.id;
    document.getElementById('documentMethod').value = 'PUT';
    document.getElementById('doc_title').value = doc.title;
    document.getElementById('doc_category').value = doc.category_id || '';
    document.getElementById('doc_status').value = doc.status;
    document.getElementById('doc_type').value = doc.type;
    document.getElementById('doc_source_url').value = doc.source_url || '';
    document.getElementById('doc_summary').value = doc.summary || '';
    @if($canViewAll)
    document.getElementById('doc_department').value = doc.department_id || '';
    @endif
    toggleDocType();
    if (docBodyEditor) docBodyEditor.setData(doc.body || '');
    document.getElementById('documentModal').classList.add('show');
}

// simple front-end filtering
document.getElementById('docSearch').addEventListener('input', filterTable);
document.getElementById('filterCategory').addEventListener('change', filterTable);
document.getElementById('filterType').addEventListener('change', filterTable);
document.getElementById('filterStatus').addEventListener('change', filterTable);

function filterTable() {
    const q = document.getElementById('docSearch').value.toLowerCase();
    const cat = document.getElementById('filterCategory').value;
    const type = document.getElementById('filterType').value;
    const status = document.getElementById('filterStatus').value;
    document.querySelectorAll('#docsTable tbody tr').forEach(row => {
        const title = row.querySelector('.table-title').textContent.toLowerCase();
        const match = (!q || title.includes(q))
            && (!cat || row.dataset.category === cat)
            && (!type || row.dataset.type === type)
            && (!status || row.dataset.status === status);
        row.style.display = match ? '' : 'none';
    });
}

// push editor data on submit
document.getElementById('documentForm').addEventListener('submit', () => {
    if (docBodyEditor) document.getElementById('doc_body').value = docBodyEditor.getData();
});
</script>
@endpush
