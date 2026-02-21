@extends('layouts.admin')

@section('title', 'News & Events')
@section('page-title', 'News & Events')

@section('content')
    <div class="page-header-banner">
        <div class="page-header-text">
            <h1><i class="fa-solid fa-newspaper"></i> News & Events</h1>
            <p>Manage articles, press releases, and events with approvals and rich media.</p>
        </div>
        <div class="page-header-actions">
            <a class="btn-outline-admin" href="{{ route('admin.news.create') }}"><i class="fa-solid fa-plus"></i> New Article</a>
            <a class="btn-primary-admin" href="{{ route('admin.events.create') }}"><i class="fa-solid fa-calendar-plus"></i> New Event</a>
        </div>
    </div>

    <div class="admin-tabs">
        <button class="admin-tab active" data-tab="all">All <span class="tab-count">{{ $items->count() }}</span></button>
        <button class="admin-tab" data-tab="article">Articles <span class="tab-count">{{ $stats['articles'] }}</span></button>
        <button class="admin-tab" data-tab="event">Events <span class="tab-count">{{ $stats['events'] }}</span></button>
        <button class="admin-tab" data-tab="press">Press Releases <span class="tab-count">{{ $stats['press'] }}</span></button>
        <button class="admin-tab" data-tab="draft">Drafts <span class="tab-count">{{ $stats['drafts'] }}</span></button>
    </div>

    <div class="admin-toolbar">
        <div class="toolbar-search">
            <i class="fa-solid fa-search"></i>
            <input type="text" id="newsSearch" placeholder="Search news, press, events...">
        </div>
        <div class="toolbar-filters">
            <select id="newsCategory" class="filter-select">
                <option value="">All Categories</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->name }}">{{ $cat->name }}</option>
                @endforeach
            </select>
            <select id="newsStatus" class="filter-select">
                <option value="">All Status</option>
                <option value="published">Published</option>
                <option value="draft">Draft</option>
                <option value="scheduled">Scheduled</option>
            </select>
            <input id="newsCountry" class="filter-select" style="min-width:110px;" placeholder="Country ISO">
            <input id="newsRegion" class="filter-select" style="min-width:110px;" placeholder="Region code">
        </div>
    </div>

    <div class="admin-table-card">
        <table class="admin-table" id="newsTable">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Type</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th>Views</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($items as $item)
                <tr data-type="{{ $item->type }}" data-status="{{ $item->status }}" data-category="{{ $item->category }}" data-country="{{ $item->country_code }}" data-region="{{ $item->region_code }}">
                    <td>
                        <div class="table-title-cell">
                            <span class="table-title">{{ $item->title }}</span>
                            <span class="table-subtitle">/{{ $item->slug }}</span>
                            <div class="link-copy-row">
                                @php $publicUrl = route('news.detail', $item->slug); @endphp
                                <input type="text" readonly class="link-copy-input" value="{{ $publicUrl }}">
                                <button class="copy-link-btn" type="button" data-link="{{ $publicUrl }}"><i class="fa-solid fa-copy"></i></button>
                            </div>
                        </div>
                    </td>
                    <td><span class="category-badge blue">{{ $item->category ?? 'General' }}</span></td>
                    <td>{{ ucfirst($item->type) }}</td>
                    <td><span class="status-badge {{ $item->status }}">{{ ucfirst($item->status) }}</span></td>
                    <td>{{ $item->published_at?->format('M d, Y') ?? ($item->starts_at?->format('M d, Y') ?? '—') }}</td>
                    <td>{{ $item->views }}</td>
                    <td>
                        <div class="table-actions">
                            <a class="action-icon-btn" title="Edit" href="{{ route('admin.news.edit', $item) }}"><i class="fa-solid fa-pen"></i></a>
                            <a class="action-icon-btn" title="View" href="{{ route('admin.news.show', $item) }}" target="_blank"><i class="fa-solid fa-eye"></i></a>
                            <form method="POST" action="{{ route('admin.news.destroy', $item) }}" style="display:inline;" onsubmit="return confirm('Delete {{ $item->title }}?')">
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
@endsection

@push('styles')
<style>
.admin-tabs { display:flex; gap:8px; margin:14px 0; }
.admin-tab { border:1px solid #e5e7eb; background:#fff; padding:8px 12px; border-radius:999px; cursor:pointer; display:flex; align-items:center; gap:6px; }
.admin-tab.active { background:var(--admin-primary,#822b39); color:#fff; border-color:var(--admin-primary,#822b39); }
.tab-count { background:rgba(255,255,255,0.18); padding:2px 8px; border-radius:999px; font-size:12px; }
.status-badge { padding:4px 8px; border-radius:999px; font-size:12px; border:1px solid #e5e7eb; }
.status-badge.published { background:#ecfdf3; color:#15803d; border-color:#bbf7d0; }
.status-badge.draft { background:#fff7ed; color:#c2410c; border-color:#fed7aa; }
.status-badge.scheduled { background:#eef2ff; color:#4338ca; border-color:#c7d2fe; }
.admin-table-card { background:#fff; border:1px solid #e5e7eb; border-radius:12px; box-shadow:0 12px 24px rgba(0,0,0,0.05); padding:10px; }
.admin-table { width:100%; border-collapse:collapse; }
.admin-table th, .admin-table td { padding:12px; text-align:left; border-bottom:1px solid #e5e7eb; }
.table-title-cell { display:flex; flex-direction:column; gap:4px; }
.table-title { font-weight:700; }
.table-subtitle { color:#6b7280; font-size:12px; }
.link-copy-row { display:flex; align-items:center; gap:6px; margin-top:4px; }
.link-copy-input { width:100%; max-width:260px; font-size:12px; padding:4px 6px; border:1px solid #e5e7eb; border-radius:6px; background:#f8fafc; color:#475569; }
.copy-link-btn { border:1px solid #e5e7eb; background:#fff; border-radius:6px; padding:5px 8px; cursor:pointer; }
.category-badge { padding:4px 8px; border-radius:999px; background:#eef2ff; color:#312e81; font-size:12px; }
.table-actions { display:flex; gap:6px; }
.filter-select { border:1px solid #e5e7eb; border-radius:10px; padding:8px 10px; background:#fff; min-width:150px; }
</style>
@endpush

@push('scripts')
<script>
document.getElementById('newsSearch').addEventListener('input', filterNews);
document.getElementById('newsCategory').addEventListener('change', filterNews);
document.getElementById('newsStatus').addEventListener('change', filterNews);
document.querySelectorAll('.admin-tab').forEach(btn => {
    btn.addEventListener('click', () => {
        document.querySelectorAll('.admin-tab').forEach(b=>b.classList.remove('active'));
        btn.classList.add('active');
        filterNews();
    });
});

function filterNews() {
    const q = document.getElementById('newsSearch').value.toLowerCase();
    const cat = document.getElementById('newsCategory').value;
    const status = document.getElementById('newsStatus').value;
    const country = document.getElementById('newsCountry').value.toUpperCase();
    const region = document.getElementById('newsRegion').value.toUpperCase();
    const activeTab = document.querySelector('.admin-tab.active').dataset.tab;
    document.querySelectorAll('#newsTable tbody tr').forEach(row => {
        const title = row.querySelector('.table-title').textContent.toLowerCase();
        const rowCat = row.dataset.category || '';
        const rowStatus = row.dataset.status || '';
        const rowType = row.dataset.type || '';
        const rowCountry = (row.dataset.country || '').toUpperCase();
        const rowRegion = (row.dataset.region || '').toUpperCase();
        const match = (!q || title.includes(q))
            && (!cat || rowCat === cat)
            && (!status || rowStatus === status)
            && (!country || rowCountry === country)
            && (!region || rowRegion === region)
            && (activeTab === 'all' || rowType === activeTab || (activeTab === 'draft' && rowStatus === 'draft'));
        row.style.display = match ? '' : 'none';
    });
}

// Copy link buttons
document.querySelectorAll('.copy-link-btn').forEach(btn => {
    btn.addEventListener('click', () => {
        const link = btn.getAttribute('data-link');
        navigator.clipboard.writeText(link);
        btn.innerHTML = '<i class="fa-solid fa-check"></i>';
        setTimeout(()=>btn.innerHTML = '<i class="fa-solid fa-copy"></i>', 1200);
    });
});
</script>
@endpush
