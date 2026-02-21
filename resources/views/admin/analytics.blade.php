@extends('layouts.admin')

@section('title', 'Analytics')
@section('page-title', 'Analytics')

@section('content')
    <div class="page-header-banner">
        <div class="page-header-text">
            <h1><i class="fa-solid fa-chart-line"></i> Analytics</h1>
            <p>Public-site usage: visitors, downloads, quiz answers, subscriptions, and time on page.</p>
            <p class="muted small">Last updated: {{ $updatedAt?->diffForHumans() ?? 'just now' }}</p>
        </div>
        <div class="page-header-actions"></div>
    </div>

    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon blue"><i class="fa-solid fa-users"></i></div>
            <div class="stat-details"><span class="stat-number">{{ number_format($totals['visits']) }}</span><span class="stat-label">Visits</span></div>
        </div>
        <div class="stat-card">
            <div class="stat-icon green"><i class="fa-solid fa-download"></i></div>
            <div class="stat-details"><span class="stat-number">{{ number_format($totals['downloads']) }}</span><span class="stat-label">Downloads</span></div>
        </div>
        <div class="stat-card">
            <div class="stat-icon gold"><i class="fa-solid fa-clock"></i></div>
            <div class="stat-details"><span class="stat-number">{{ $totals['avg_time'] }}s</span><span class="stat-label">Avg. Time on Page</span></div>
        </div>
        <div class="stat-card">
            <div class="stat-icon maroon"><i class="fa-solid fa-clipboard-question"></i></div>
            <div class="stat-details"><span class="stat-number">{{ number_format($totals['quiz_answers']) }}</span><span class="stat-label">Quiz Answers</span></div>
        </div>
        <div class="stat-card">
            <div class="stat-icon purple"><i class="fa-solid fa-envelope-open-text"></i></div>
            <div class="stat-details"><span class="stat-number">{{ number_format($totals['subscriptions']) }}</span><span class="stat-label">Subscriptions</span></div>
        </div>
    </div>

    <div class="grid-two">
        <div class="panel">
            <div class="panel-head"><h3>Top Countries</h3></div>
            <table class="admin-table compact">
                <thead><tr><th>Country</th><th>Hits</th></tr></thead>
                <tbody>
                    @forelse($topCountries as $c)
                        <tr><td>{{ $c->country }}</td><td>{{ $c->hits }}</td></tr>
                    @empty
                        <tr><td colspan="2" class="muted">No data yet</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="panel">
            <div class="panel-head"><h3>Top Pages</h3></div>
            <table class="admin-table compact">
                <thead><tr><th>Page</th><th>Views</th></tr></thead>
                <tbody>
                    @forelse($topPages as $p)
                        <tr><td>{{ $p->path }}</td><td>{{ $p->hits }}</td></tr>
                    @empty
                        <tr><td colspan="2" class="muted">No data yet</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="grid-two" style="margin-top:16px;">
        <div class="panel">
            <div class="panel-head"><h3>Recent Downloads</h3></div>
        <table class="admin-table compact">
            <thead><tr><th>File/Path</th><th>Country</th><th>When</th></tr></thead>
            <tbody>
                @forelse($recentDownloads as $d)
                    <tr>
                        <td>{{ $d->path ?? data_get($d->meta,'file') ?? '—' }}</td>
                        <td>{{ $d->country ?? '—' }}</td>
                        <td>{{ $d->created_at?->diffForHumans() }}</td>
                    </tr>
                @empty
                    <tr><td colspan="3" class="muted">No downloads yet</td></tr>
                @endforelse
            </tbody>
        </table>
        </div>

        <div class="panel">
            <div class="panel-head"><h3>Recent Quiz Answers</h3></div>
            <table class="admin-table compact">
                <thead><tr><th>Path</th><th>Country</th><th>When</th></tr></thead>
                <tbody>
                    @forelse($quizRecent as $q)
                        <tr>
                            <td>{{ $q->path ?? '—' }}</td>
                            <td>{{ $q->country ?? '—' }}</td>
                            <td>{{ $q->created_at?->diffForHumans() }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="3" class="muted">No quiz activity yet</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="panel" style="margin-top:16px;">
        <div class="panel-head"><h3>Recent Subscriptions</h3></div>
        <table class="admin-table compact">
            <thead><tr><th>Path</th><th>Country</th><th>When</th></tr></thead>
            <tbody>
                @forelse($subsRecent as $s)
                    <tr>
                        <td>{{ $s->path ?? '—' }}</td>
                        <td>{{ $s->country ?? '—' }}</td>
                        <td>{{ $s->created_at?->diffForHumans() }}</td>
                    </tr>
                @empty
                    <tr><td colspan="3" class="muted">No subscriptions yet</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

@endsection

@push('styles')
<style>
.stats-grid { display:grid; grid-template-columns:repeat(auto-fit,minmax(180px,1fr)); gap:12px; margin-bottom:16px; }
.stat-card { background:#fff; border:1px solid #e5e7eb; border-radius:12px; padding:12px; display:flex; align-items:center; gap:10px; box-shadow:0 10px 24px rgba(15,23,42,0.06); }
.stat-icon { width:42px; height:42px; border-radius:10px; display:flex; align-items:center; justify-content:center; color:#fff; }
.stat-icon.blue { background:#2563eb; }
.stat-icon.green { background:#16a34a; }
.stat-icon.gold { background:#d97706; }
.stat-icon.maroon { background:#7f1d1d; }
.stat-icon.purple { background:#7c3aed; }
.stat-number { font-size:18px; font-weight:700; }
.stat-label { color:#6b7280; font-size:12px; }
.grid-two { display:grid; grid-template-columns:1fr 1fr; gap:12px; }
.panel { background:#fff; border:1px solid #e5e7eb; border-radius:12px; box-shadow:0 10px 24px rgba(0,0,0,0.05); padding:12px; }
.panel-head { display:flex; justify-content:space-between; align-items:center; margin-bottom:8px; }
.admin-table.compact th, .admin-table.compact td { padding:8px; }
.api-block { background:#0f172a; color:#e2e8f0; padding:12px; border-radius:10px; overflow:auto; }
.api-block code { color:inherit; }
.muted.small { font-size:12px; color:#6b7280; }
@media (max-width:900px){ .grid-two { grid-template-columns:1fr; } }
</style>
@endpush
