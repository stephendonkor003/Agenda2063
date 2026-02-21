@extends('layouts.admin')

@section('title', 'Regional Data')
@section('page-title', 'Regional Data')

@section('content')
    <div class="page-header-banner">
        <div class="page-header-text">
            <h1><i class="fa-solid fa-map-marked-alt"></i> Regional Data</h1>
            <p>REC performance with attached news per region.</p>
        </div>
        <div class="page-header-actions">
            <button class="btn-outline-admin" onclick="openRegionModal()"><i class="fa-solid fa-plus"></i> Add Regional Report</button>
        </div>
    </div>

    <div class="admin-table-card">
        <table class="admin-table" id="regionTable">
            <thead>
                <tr>
                    <th>Region</th>
                    <th>Score</th>
                    <th>Year</th>
                    <th>Status</th>
                    <th>News</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($reports as $report)
                    @php $newsItems = $report->news()->latest()->take(3)->get(); @endphp
                    <tr data-region="{{ $report->region_code }}" data-status="{{ $report->status }}">
                        <td>
                            <div class="table-title-cell">
                                <span class="table-title">{{ $report->region_name }}</span>
                                <span class="muted small">{{ $report->region_code }}</span>
                            </div>
                        </td>
                        <td>
                            <div class="score-cell">
                                <div class="mini-bar"><div class="mini-fill" style="width: {{ $report->overall_score }}%; background:#3498db;"></div></div>
                                <span>{{ number_format($report->overall_score,1) }}%</span>
                            </div>
                        </td>
                        <td>{{ $report->year }}</td>
                        <td><span class="status-badge {{ $report->status }}">{{ ucfirst($report->status) }}</span></td>
                        <td>
                            @forelse($newsItems as $news)
                                <div class="muted small">• {{ $news->title }}</div>
                            @empty
                                <span class="muted small">No news</span>
                            @endforelse
                            <a class="btn-outline-admin" style="margin-top:6px; display:inline-block;" href="{{ route('admin.news.create', ['region_code'=>$report->region_code, 'type'=>'event']) }}" target="_blank">Add News</a>
                        </td>
                        <td>
                            <div class="table-actions">
                                <button class="action-icon-btn" title="Edit" onclick='editRegion(@json($report))'><i class="fa-solid fa-pen"></i></button>
                                <form method="POST" action="{{ route('admin.regional-data.destroy', $report) }}" style="display:inline;" onsubmit="return confirm('Delete {{ $report->region_name }}?')">
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

    <!-- Region Modal -->
    <div id="regionModal" class="modal-backdrop">
        <div class="modal-card" style="max-width:760px;">
            <div class="modal-head">
                <div>
                    <p class="modal-kicker">Regional Report</p>
                    <h3 id="regionModalTitle"><i class="fa-solid fa-plus"></i> Add Regional Report</h3>
                </div>
                <button class="modal-close" type="button" onclick="closeRegionModal()"><i class="fa-solid fa-xmark"></i></button>
            </div>
            <form id="regionForm" method="POST" action="{{ route('admin.regional-data.store') }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="_method" id="regionMethod" value="POST">
                <div class="settings-row">
                    <div class="settings-field" style="min-width:200px;">
                        <label>Region Name</label>
                        <input type="text" name="region_name" id="reg_name" class="settings-input" required>
                    </div>
                    <div class="settings-field" style="min-width:140px;">
                        <label>Region Code</label>
                        <input type="text" name="region_code" id="reg_code" class="settings-input" required>
                    </div>
                    <div class="settings-field" style="min-width:140px;">
                        <label>Year</label>
                        <input type="number" name="year" id="reg_year" class="settings-input" value="{{ now()->year }}">
                    </div>
                </div>
                <div class="settings-row">
                    <div class="settings-field" style="min-width:140px;">
                        <label>Status</label>
                        <select name="status" id="reg_status" class="settings-select">
                            <option value="draft">Draft</option>
                            <option value="submitted">Submitted</option>
                            <option value="published">Published</option>
                        </select>
                    </div>
                    <div class="settings-field" style="min-width:140px;">
                        <label>Score (%)</label>
                        <input type="number" step="0.1" min="0" max="100" name="overall_score" id="reg_score" class="settings-input" value="0">
                    </div>
                </div>
                <div class="settings-field">
                    <label>Banner</label>
                    <input type="file" name="banner" class="settings-input">
                </div>
                <div class="settings-field">
                    <label>Summary</label>
                    <textarea name="summary" id="reg_summary" class="settings-textarea" rows="3"></textarea>
                </div>
                <div class="settings-field">
                    <label>Body</label>
                    <textarea name="body" id="reg_body" class="settings-textarea" rows="6"></textarea>
                </div>
                <div class="modal-actions">
                    <button type="button" class="btn-outline-admin" onclick="closeRegionModal()">Cancel</button>
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
function openRegionModal() {
    const form = document.getElementById('regionForm');
    form.reset();
    document.getElementById('regionMethod').value = 'POST';
    form.action = "{{ route('admin.regional-data.store') }}";
    document.getElementById('regionModalTitle').innerHTML = '<i class="fa-solid fa-plus"></i> Add Regional Report';
    document.getElementById('regionModal').classList.add('show');
}
function closeRegionModal() {
    document.getElementById('regionModal').classList.remove('show');
}
function editRegion(rep) {
    const form = document.getElementById('regionForm');
    form.action = "{{ url('admin/regional-data') }}/" + rep.id;
    document.getElementById('regionMethod').value = 'PUT';
    document.getElementById('reg_name').value = rep.region_name;
    document.getElementById('reg_code').value = rep.region_code;
    document.getElementById('reg_year').value = rep.year;
    document.getElementById('reg_status').value = rep.status;
    document.getElementById('reg_score').value = rep.overall_score;
    document.getElementById('reg_summary').value = rep.summary || '';
    document.getElementById('reg_body').value = rep.body || '';
    document.getElementById('regionModalTitle').innerHTML = '<i class="fa-solid fa-pen"></i> Edit Regional Report';
    document.getElementById('regionModal').classList.add('show');
}
</script>
@endpush
