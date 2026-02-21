@extends('layouts.admin')

@section('title', 'Country Reports')
@section('page-title', 'Country Reports')

@section('content')
    <div class="page-header-banner">
        <div class="page-header-text">
            <h1><i class="fa-solid fa-flag"></i> Country Reports</h1>
            <p>Manage country performance, attach news, and ingest partner feeds.</p>
        </div>
        <div class="page-header-actions">
            <button class="btn-outline-admin" onclick="openReportModal()"><i class="fa-solid fa-plus"></i> Add Report</button>
        </div>
    </div>

    <div class="admin-toolbar">
        <div class="toolbar-search">
            <i class="fa-solid fa-search"></i>
            <input type="text" id="countrySearch" placeholder="Search by country...">
        </div>
        <div class="toolbar-filters">
            <select class="filter-select" id="regionFilter">
                <option value="">All Regions</option>
                <option>North Africa</option>
                <option>West Africa</option>
                <option>Central Africa</option>
                <option>East Africa</option>
                <option>Southern Africa</option>
            </select>
            <select class="filter-select" id="statusFilter">
                <option value="">All Status</option>
                <option value="draft">Draft</option>
                <option value="submitted">Submitted</option>
                <option value="published">Published</option>
            </select>
        </div>
    </div>

    <div class="admin-table-card">
        <table class="admin-table" id="countriesTable">
            <thead>
                <tr>
                    <th>Country</th>
                    <th>Region</th>
                    <th>Score</th>
                    <th>Year</th>
                    <th>Status</th>
                    <th>Updated</th>
                    <th>News</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($reports as $report)
                    @php $newsItems = $report->news()->latest()->take(3)->get(); @endphp
                    <tr data-region="{{ $report->region }}" data-status="{{ $report->status }}" data-country="{{ strtolower($report->country_name) }}">
                        <td class="country-cell">
                            <span class="table-title">{{ $report->country_name }}</span>
                            <span class="muted small">{{ $report->country_code }}</span>
                        </td>
                        <td>{{ $report->region ?? '—' }}</td>
                        <td>
                            <div class="score-cell">
                                <div class="mini-bar"><div class="mini-fill" style="width: {{ $report->overall_score }}%; background:#822b39;"></div></div>
                                <span>{{ number_format($report->overall_score,1) }}%</span>
                            </div>
                        </td>
                        <td>{{ $report->year }}</td>
                        <td><span class="status-badge {{ $report->status }}">{{ ucfirst($report->status) }}</span></td>
                        <td>{{ $report->updated_at?->format('M d, Y') }}</td>
                        <td>
                            @forelse($newsItems as $news)
                                <div class="muted small">• {{ $news->title }}</div>
                            @empty
                                <span class="muted small">No news</span>
                            @endforelse
                            <a class="btn-outline-admin" style="margin-top:6px; display:inline-block;" href="{{ route('admin.news.create', ['country_code'=>$report->country_code]) }}" target="_blank">Add News</a>
                        </td>
                        <td>
                            <div class="table-actions">
                                <button class="action-icon-btn" title="Edit" onclick='editReport(@json($report))'><i class="fa-solid fa-pen"></i></button>
                                <form method="POST" action="{{ route('admin.country-reports.destroy', $report) }}" style="display:inline;" onsubmit="return confirm('Delete {{ $report->country_name }} report?')">
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

    <!-- Report Modal -->
    <div id="reportModal" class="modal-backdrop">
        <div class="modal-card" style="max-width:760px;">
            <div class="modal-head">
                <div>
                    <p class="modal-kicker">Country Report</p>
                    <h3 id="reportModalTitle"><i class="fa-solid fa-plus"></i> Add Report</h3>
                </div>
                <button class="modal-close" type="button" onclick="closeReportModal()"><i class="fa-solid fa-xmark"></i></button>
            </div>
            <form id="reportForm" method="POST" action="{{ route('admin.country-reports.store') }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="_method" id="reportMethod" value="POST">
                <div class="settings-row">
                    <div class="settings-field" style="min-width:200px;">
                        <label>Country Name</label>
                        <input type="text" name="country_name" id="rep_country_name" class="settings-input" required>
                    </div>
                    <div class="settings-field" style="min-width:120px;">
                        <label>Country Code (ISO3)</label>
                        <input type="text" name="country_code" id="rep_country_code" class="settings-input" required>
                    </div>
                    <div class="settings-field" style="min-width:160px;">
                        <label>Region</label>
                        <input type="text" name="region" id="rep_region" class="settings-input" placeholder="ECOWAS, EAC...">
                    </div>
                </div>
                <div class="settings-row">
                    <div class="settings-field" style="min-width:120px;">
                        <label>Year</label>
                        <input type="number" name="year" id="rep_year" class="settings-input" value="{{ now()->year }}">
                    </div>
                    <div class="settings-field" style="min-width:150px;">
                        <label>Status</label>
                        <select name="status" id="rep_status" class="settings-select">
                            <option value="draft">Draft</option>
                            <option value="submitted">Submitted</option>
                            <option value="published">Published</option>
                        </select>
                    </div>
                    <div class="settings-field" style="min-width:150px;">
                        <label>Score (%)</label>
                        <input type="number" step="0.1" min="0" max="100" name="overall_score" id="rep_score" class="settings-input" value="0">
                    </div>
                </div>
                <div class="settings-field">
                    <label>Banner</label>
                    <input type="file" name="banner" class="settings-input">
                </div>
                <div class="settings-field">
                    <label>Summary</label>
                    <textarea name="summary" id="rep_summary" class="settings-textarea" rows="3"></textarea>
                </div>
                <div class="settings-field">
                    <label>Body</label>
                    <textarea name="body" id="rep_body" class="settings-textarea" rows="6"></textarea>
                </div>
                <div class="modal-actions">
                    <button type="button" class="btn-outline-admin" onclick="closeReportModal()">Cancel</button>
                    <button type="submit" class="btn-primary-admin"><i class="fa-solid fa-save"></i> Save</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('styles')
<style>
.score-cell { display:flex; align-items:center; gap:6px; }
.mini-bar { width:80px; height:8px; background:#e5e7eb; border-radius:999px; overflow:hidden; }
.mini-fill { height:100%; }
.status-badge { padding:4px 8px; border-radius:999px; font-size:12px; border:1px solid #e5e7eb; }
.status-badge.draft { background:#fff7ed; color:#c2410c; }
.status-badge.submitted { background:#eef2ff; color:#4338ca; }
.status-badge.published { background:#ecfdf3; color:#15803d; border-color:#bbf7d0; }
.modal-backdrop { position:fixed; inset:0; background:rgba(0,0,0,0.35); display:none; align-items:center; justify-content:center; z-index:1100; }
.modal-backdrop.show { display:flex; }
.modal-card { background:#fff; border-radius:12px; box-shadow:0 12px 32px rgba(0,0,0,0.18); padding:20px 24px; width:90%; max-height:90vh; overflow-y:auto; }
.modal-head { display:flex; justify-content:space-between; gap:12px; align-items:flex-start; }
.modal-kicker { text-transform:uppercase; letter-spacing:0.08em; color:#9b1c2c; font-size:11px; margin:0 0 4px; }
.modal-card h3 { margin:0; font-size:20px; }
.modal-close { border:none; background:transparent; color:#6b7280; font-size:18px; cursor:pointer; }
.modal-actions { display:flex; gap:12px; justify-content:flex-end; flex-wrap:wrap; margin-top:10px; }
</style>
@endpush

@push('scripts')
<script>
function openReportModal() {
    const form = document.getElementById('reportForm');
    form.reset();
    document.getElementById('reportMethod').value = 'POST';
    form.action = "{{ route('admin.country-reports.store') }}";
    document.getElementById('reportModalTitle').innerHTML = '<i class="fa-solid fa-plus"></i> Add Report';
    document.getElementById('reportModal').classList.add('show');
}
function closeReportModal() {
    document.getElementById('reportModal').classList.remove('show');
}
function editReport(rep) {
    const form = document.getElementById('reportForm');
    form.action = "{{ url('admin/country-reports') }}/" + rep.id;
    document.getElementById('reportMethod').value = 'PUT';
    document.getElementById('rep_country_name').value = rep.country_name;
    document.getElementById('rep_country_code').value = rep.country_code;
    document.getElementById('rep_region').value = rep.region || '';
    document.getElementById('rep_year').value = rep.year;
    document.getElementById('rep_status').value = rep.status;
    document.getElementById('rep_score').value = rep.overall_score;
    document.getElementById('rep_summary').value = rep.summary || '';
    document.getElementById('rep_body').value = rep.body || '';
    document.getElementById('reportModalTitle').innerHTML = '<i class="fa-solid fa-pen"></i> Edit Report';
    document.getElementById('reportModal').classList.add('show');
}
document.getElementById('countrySearch').addEventListener('input', filterTable);
document.getElementById('regionFilter').addEventListener('change', filterTable);
document.getElementById('statusFilter').addEventListener('change', filterTable);
function filterTable() {
    const q = document.getElementById('countrySearch').value.toLowerCase();
    const region = document.getElementById('regionFilter').value;
    const status = document.getElementById('statusFilter').value;
    document.querySelectorAll('#countriesTable tbody tr').forEach(row => {
        const country = row.dataset.country;
        const r = row.dataset.region || '';
        const s = row.dataset.status || '';
        const match = (!q || country.includes(q))
            && (!region || r === region)
            && (!status || s === status);
        row.style.display = match ? '' : 'none';
    });
}
</script>
@endpush
