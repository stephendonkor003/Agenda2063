@extends('layouts.admin')

@section('title', 'Goals Tracking')
@section('page-title', 'Goals Tracking')

@section('content')
    <div class="page-header-banner">
        <div class="page-header-text">
            <h1><i class="fa-solid fa-bullseye"></i> Goals Tracking</h1>
            <p>Ingest partner platform data and compute Agenda 2063 goal progress.</p>
        </div>
        <div class="page-header-actions">
            <button class="btn-outline-admin" onclick="openSourceModal()"><i class="fa-solid fa-plug"></i> Add Data Source</button>
            <button class="btn-primary-admin" onclick="document.getElementById('apiDocs').scrollIntoView({behavior:'smooth'})"><i class="fa-solid fa-book"></i> API Docs</button>
        </div>
    </div>

    <div class="grid-two">
        <div class="goals-overview">
            <div class="goals-overview-card">
                <div class="overview-ring">
                    <svg viewBox="0 0 120 120">
                        <circle cx="60" cy="60" r="52" stroke="var(--border-color)" stroke-width="10" fill="none"/>
                        @php $pct = $overall['progress'] ?? 0; $dash = 327; @endphp
                        <circle cx="60" cy="60" r="52" stroke="#822b39" stroke-width="10" fill="none"
                                stroke-dasharray="{{ $dash }}" stroke-dashoffset="{{ $dash - ($dash * $pct / 100) }}" stroke-linecap="round"
                                transform="rotate(-90, 60, 60)"/>
                    </svg>
                    <span class="ring-value">{{ $pct }}%</span>
                </div>
                <div class="overview-info">
                    <h3>Overall Progress</h3>
                    <p>Average completion across aspirations using synced partner indicators.</p>
                </div>
            </div>
            <div class="overview-stats-row">
                <div class="overview-stat">
                    <span class="overview-stat-num on-track">{{ $overall['on_track'] ?? 0 }}</span>
                    <span class="overview-stat-label">On Track</span>
                </div>
                <div class="overview-stat">
                    <span class="overview-stat-num at-risk">{{ $overall['at_risk'] ?? 0 }}</span>
                    <span class="overview-stat-label">At Risk</span>
                </div>
                <div class="overview-stat">
                    <span class="overview-stat-num off-track">{{ $overall['off_track'] ?? 0 }}</span>
                    <span class="overview-stat-label">Off Track</span>
                </div>
            </div>
        </div>

        <div class="settings-card" id="settings-panel">
            <div class="settings-card-body">
                <div class="flex-between">
                    <div>
                        <h3 style="margin:0;">Data Sources</h3>
                        <p class="muted" style="margin:4px 0 0;">Connect other departmental portals and donor dashboards.</p>
                    </div>
                    <button class="btn-outline-admin" type="button" onclick="openSourceModal()"><i class="fa-solid fa-plus"></i> Add</button>
                </div>
                <div class="source-list">
                    @forelse($sources as $src)
                        <div class="source-row">
                            <div>
                                <div class="source-name">{{ $src->name }}</div>
                                <div class="muted small">{{ strtoupper($src->type) }} • {{ $src->base_url ?? '—' }}</div>
                                <div class="muted small">Sync: {{ ucfirst($src->sync_frequency) }} • Status: <span class="tag status {{ $src->status }}">{{ ucfirst($src->status) }}</span></div>
                            </div>
                            <div class="source-actions">
                                <button class="action-icon-btn" title="Edit" onclick='editSource(@json($src))'><i class="fa-solid fa-pen"></i></button>
                            </div>
                        </div>
                    @empty
                        <p class="muted">No sources yet. Add connections to start ingesting indicators.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <div class="settings-card" style="margin-top:16px;">
        <div class="settings-card-body">
            <div class="flex-between">
                <h3 style="margin:0;">Aspirations & Goals</h3>
                <button class="btn-outline-admin"><i class="fa-solid fa-pen"></i> Update Targets</button>
            </div>
            <div class="goals-list" style="max-height:520px; overflow:auto;">
                <div class="aspiration-group">
                    <div class="aspiration-header">
                        <div class="aspiration-number">1</div>
                        <div>
                            <h3>A Prosperous Africa</h3>
                            <p>Based on inclusive growth and sustainable development</p>
                        </div>
                        <span class="aspiration-avg">65%</span>
                    </div>
                    <div class="goals-items">
                        <div class="goal-item">
                            <div class="goal-info">
                                <span class="goal-number">Goal 1</span>
                                <span class="goal-title">A high standard of living, quality of life and well-being for all citizens</span>
                            </div>
                            <div class="goal-progress-wrap">
                                <div class="goal-bar"><div class="goal-fill" style="width: 58%;"></div></div>
                                <span class="goal-pct">58%</span>
                            </div>
                            <span class="goal-status at-risk">At Risk</span>
                            <button class="action-icon-btn" title="Edit"><i class="fa-solid fa-pen"></i></button>
                        </div>
                        <div class="goal-item">
                            <div class="goal-info">
                                <span class="goal-number">Goal 2</span>
                                <span class="goal-title">Well educated citizens and skills revolution underpinned by STI</span>
                            </div>
                            <div class="goal-progress-wrap">
                                <div class="goal-bar"><div class="goal-fill" style="width: 62%;"></div></div>
                                <span class="goal-pct">62%</span>
                            </div>
                            <span class="goal-status on-track">On Track</span>
                            <button class="action-icon-btn" title="Edit"><i class="fa-solid fa-pen"></i></button>
                        </div>
                    </div>
                </div>
                <!-- keep sample; real data to be bound from DB later -->
            </div>
        </div>
    </div>

    <div id="apiDocs" class="settings-card" style="margin-top:16px;">
        <div class="settings-card-body">
            <h3 style="margin-top:0;"><i class="fa-solid fa-book"></i> External API Blueprint</h3>
            <p class="muted">Share with partner platform developers to push indicators into this system.</p>
            <pre class="api-block"><code>Base URL: {{ url('/api/v1/goals') }}
Auth: Bearer &lt;token&gt; (generated per data source)

POST /ingest
Content-Type: application/json
Headers: Authorization: Bearer &lt;token&gt;
Body:
{
  "country": "GHA",
  "region": "West Africa",
  "aspiration_id": 1,
  "goal_id": 2,
  "indicator_code": "EDU.GER",
  "value": 0.72,
  "unit": "percent",
  "period": "2026-Q1",
  "source": "MinEdu Ghana"
}

Response: 202 Accepted { "status": "queued" }</code></pre>
            <p class="muted">Partners may also call <code>/ingest/bulk</code> with an array of payloads. Rate limit: 200 req/min/source.</p>
        </div>
    </div>

    <!-- Source Modal -->
    <div id="sourceModal" class="modal-backdrop">
        <div class="modal-card" style="max-width:720px;">
            <div class="modal-head">
                <div>
                    <p class="modal-kicker">Data Source</p>
                    <h3 id="sourceModalTitle"><i class="fa-solid fa-plug"></i> Add Data Source</h3>
                </div>
                <button class="modal-close" type="button" onclick="closeSourceModal()"><i class="fa-solid fa-xmark"></i></button>
            </div>
            <form id="sourceForm" method="POST" action="{{ route('admin.goals-tracking.sources.store') }}">
                @csrf
                <input type="hidden" name="_method" id="sourceMethod" value="POST">
                <div class="settings-row">
                    <div class="settings-field" style="min-width:260px;">
                        <label>Name</label>
                        <input type="text" name="name" id="src_name" class="settings-input" required>
                    </div>
                    <div class="settings-field" style="min-width:200px;">
                        <label>Provider</label>
                        <input type="text" name="provider" id="src_provider" class="settings-input" placeholder="AfDB, UNDP, Custom">
                    </div>
                </div>
                <div class="settings-row">
                    <div class="settings-field" style="flex:1;">
                        <label>Type</label>
                        <select name="type" id="src_type" class="settings-select">
                            <option value="rest">REST</option>
                            <option value="graphql">GraphQL</option>
                            <option value="sftp">SFTP</option>
                            <option value="manual">Manual</option>
                        </select>
                    </div>
                    <div class="settings-field" style="flex:1;">
                        <label>Auth</label>
                        <select name="auth_type" id="src_auth" class="settings-select">
                            <option value="api_key">API Key</option>
                            <option value="bearer">Bearer Token</option>
                            <option value="basic">Basic</option>
                            <option value="none">None</option>
                        </select>
                    </div>
                    <div class="settings-field" style="flex:1;">
                        <label>Sync Frequency</label>
                        <select name="sync_frequency" id="src_freq" class="settings-select">
                            <option value="hourly">Hourly</option>
                            <option value="daily">Daily</option>
                            <option value="weekly">Weekly</option>
                            <option value="manual">Manual</option>
                        </select>
                    </div>
                </div>
                <div class="settings-field">
                    <label>Base URL</label>
                    <input type="url" name="base_url" id="src_base" class="settings-input" placeholder="https://api.partner.org/v1">
                </div>
                <div class="settings-row">
                    <div class="settings-field" style="flex:1;">
                        <label>Auth Header</label>
                        <input type="text" name="auth_header" id="src_header" class="settings-input" placeholder="X-API-Key">
                    </div>
                    <div class="settings-field" style="flex:1;">
                        <label>API Key / Token</label>
                        <input type="text" name="api_key" id="src_key" class="settings-input" placeholder="Paste secret here">
                    </div>
                </div>
                <div class="settings-field">
                    <label>Notes</label>
                    <textarea name="notes" id="src_notes" class="settings-textarea" rows="3"></textarea>
                </div>
                <div class="modal-actions">
                    <button type="button" class="btn-outline-admin" onclick="closeSourceModal()">Cancel</button>
                    <button type="submit" class="btn-primary-admin"><i class="fa-solid fa-save"></i> Save</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('styles')
<style>
.grid-two { display:grid; grid-template-columns:2fr 1.2fr; gap:16px; align-items:start; }
.goals-overview { width:100%; }
.goals-overview-card { display:flex; gap:14px; align-items:center; background:#fff; border:1px solid #e5e7eb; border-radius:12px; padding:14px; box-shadow:0 12px 24px rgba(0,0,0,0.05); }
.overview-ring { position:relative; width:140px; height:140px; }
.overview-ring svg { position:absolute; inset:0; transform:rotate(0deg); }
.ring-value { position:absolute; inset:0; display:flex; align-items:center; justify-content:center; font-weight:700; font-size:24px; color:#822b39; }
.overview-info h3 { margin:0; }
.overview-info p { margin:4px 0 0; color:#6b7280; }
.overview-stats-row { display:flex; gap:12px; margin-top:12px; }
.overview-stat { flex:1; background:#fff; border:1px solid #e5e7eb; border-radius:12px; padding:10px; text-align:center; box-shadow:0 8px 18px rgba(0,0,0,0.04); }
.overview-stat-num { display:block; font-weight:700; font-size:20px; }
.on-track { color:#15803d; }
.at-risk { color:#c2410c; }
.off-track { color:#b91c1c; }
.source-list { display:flex; flex-direction:column; gap:10px; margin-top:12px; }
.source-row { border:1px solid #e5e7eb; border-radius:10px; padding:10px; display:flex; justify-content:space-between; gap:8px; background:#f8fafc; }
.source-name { font-weight:700; }
.source-actions { display:flex; gap:6px; }
.goals-list { margin-top:10px; }
.aspiration-group { border:1px solid #e5e7eb; border-radius:12px; padding:12px; background:#fff; margin-bottom:12px; }
.aspiration-header { display:flex; gap:10px; align-items:center; }
.aspiration-number { width:32px; height:32px; border-radius:50%; background:#822b39; color:#fff; display:flex; align-items:center; justify-content:center; font-weight:700; }
.aspiration-avg { margin-left:auto; font-weight:700; color:#4338ca; }
.goals-items { margin-top:10px; display:flex; flex-direction:column; gap:8px; }
.goal-item { display:grid; grid-template-columns:1fr auto auto auto; gap:8px; align-items:center; border:1px solid #e5e7eb; border-radius:10px; padding:10px; background:#f8fafc; }
.goal-progress-wrap { display:flex; align-items:center; gap:8px; }
.goal-bar { width:140px; height:8px; background:#e5e7eb; border-radius:999px; overflow:hidden; }
.goal-fill { height:100%; background:#822b39; }
.goal-status { padding:4px 8px; border-radius:999px; font-size:12px; border:1px solid #e5e7eb; }
.modal-backdrop { position:fixed; inset:0; background:rgba(0,0,0,0.35); display:none; align-items:center; justify-content:center; z-index:1100; }
.modal-backdrop.show { display:flex; }
.modal-card { background:#fff; border-radius:12px; box-shadow:0 12px 32px rgba(0,0,0,0.18); padding:20px 24px; width:90%; max-height:90vh; overflow-y:auto; }
.modal-head { display:flex; justify-content:space-between; gap:12px; align-items:flex-start; }
.modal-kicker { text-transform:uppercase; letter-spacing:0.08em; color:#9b1c2c; font-size:11px; margin:0 0 4px; }
.modal-card h3 { margin:0; font-size:20px; }
.modal-close { border:none; background:transparent; color:#6b7280; font-size:18px; cursor:pointer; }
.modal-actions { display:flex; gap:12px; justify-content:flex-end; flex-wrap:wrap; margin-top:10px; }
.flex-between { display:flex; justify-content:space-between; align-items:center; }
.tag.status.active { color:#15803d; }
.tag.status.inactive { color:#6b7280; }
.tag.status.error { color:#b91c1c; }
.api-block { background:#0f172a; color:#e2e8f0; padding:12px; border-radius:10px; overflow:auto; }
.api-block code { color:inherit; }
@media (max-width:1024px){ .grid-two { grid-template-columns:1fr; } }
</style>
@endpush

@push('scripts')
<script>
function openSourceModal() {
    const form = document.getElementById('sourceForm');
    form.reset();
    document.getElementById('sourceMethod').value = 'POST';
    form.action = "{{ route('admin.goals-tracking.sources.store') }}";
    document.getElementById('sourceModalTitle').innerHTML = '<i class="fa-solid fa-plug"></i> Add Data Source';
    document.getElementById('sourceModal').classList.add('show');
}
function closeSourceModal() {
    document.getElementById('sourceModal').classList.remove('show');
}
function editSource(src) {
    const form = document.getElementById('sourceForm');
    form.action = "{{ url('admin/goals-tracking/sources') }}/" + src.id;
    document.getElementById('sourceMethod').value = 'PUT';
    document.getElementById('src_name').value = src.name;
    document.getElementById('src_provider').value = src.provider || '';
    document.getElementById('src_type').value = src.type;
    document.getElementById('src_base').value = src.base_url || '';
    document.getElementById('src_auth').value = src.auth_type;
    document.getElementById('src_header').value = src.auth_header || '';
    document.getElementById('src_key').value = src.api_key || '';
    document.getElementById('src_freq').value = src.sync_frequency || 'daily';
    document.getElementById('src_notes').value = src.notes || '';
    document.getElementById('sourceModalTitle').innerHTML = '<i class="fa-solid fa-pen"></i> Edit Data Source';
    document.getElementById('sourceModal').classList.add('show');
}
</script>
@endpush
