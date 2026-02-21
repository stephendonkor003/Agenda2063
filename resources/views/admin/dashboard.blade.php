@extends('layouts.admin')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')

    <div class="page-header-banner">
        <div class="page-header-text">
            <h1><i class="fa-solid fa-gauge-high"></i> Platform Pulse</h1>
            <p>360° view of public usage, content, and integrations.</p>
        </div>
        <div class="page-header-actions">
            <span class="muted small">{{ now()->format('l, F j, Y') }}</span>
        </div>
    </div>

    <!-- KPI Cards -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon blue"><i class="fa-solid fa-eye"></i></div>
            <div class="stat-details"><span class="stat-number">{{ number_format($counts['visits']) }}</span><span class="stat-label">Visits</span></div>
        </div>
        <div class="stat-card">
            <div class="stat-icon green"><i class="fa-solid fa-download"></i></div>
            <div class="stat-details"><span class="stat-number">{{ number_format($counts['downloads']) }}</span><span class="stat-label">Downloads</span></div>
        </div>
        <div class="stat-card">
            <div class="stat-icon gold"><i class="fa-solid fa-clock"></i></div>
            <div class="stat-details">
                <span class="stat-number">{{ $counts['avg_time'] }}s</span>
                <span class="stat-label">Avg. Time on Page (seconds)</span>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon maroon"><i class="fa-solid fa-clipboard-question"></i></div>
            <div class="stat-details"><span class="stat-number">{{ number_format($counts['quiz']) }}</span><span class="stat-label">Quiz Submits</span></div>
        </div>
        <div class="stat-card">
            <div class="stat-icon purple"><i class="fa-solid fa-envelope-open-text"></i></div>
            <div class="stat-details"><span class="stat-number">{{ number_format($counts['subscriptions']) }}</span><span class="stat-label">Subscriptions</span></div>
        </div>
    </div>

    <div class="dashboard-grid">
        <!-- Content Snapshot -->
        <div class="dash-card">
            <div class="card-header"><h3><i class="fa-solid fa-database"></i> Content Snapshot</h3></div>
            <div class="card-body">
                <div class="snapshot-row">
                    <span>News & Events</span><strong>{{ $counts['news'] }}</strong>
                </div>
                <div class="snapshot-row">
                    <span>Publications</span><strong>{{ $counts['publications'] }}</strong>
                </div>
                <div class="snapshot-row">
                    <span>Knowledge Documents</span><strong>{{ $counts['knowledge'] }}</strong>
                </div>
                <div class="snapshot-row">
                    <span>Country Reports</span><strong>{{ $counts['country_reports'] }}</strong>
                </div>
                <div class="snapshot-row">
                    <span>Regional Reports</span><strong>{{ $counts['regional_reports'] }}</strong>
                </div>
            </div>
        </div>

        <!-- Top Pages -->
        <div class="dash-card">
            <div class="card-header"><h3><i class="fa-solid fa-fire"></i> Top Pages</h3></div>
            <div class="card-body">
                <div class="top-pages-list">
                    @forelse($topPages as $idx => $p)
                        <div class="page-item">
                            <span class="page-rank">{{ $idx+1 }}</span>
                            <div class="page-info">
                                <span class="page-name">{{ $p->path }}</span>
                            </div>
                            <span class="page-views">{{ $p->hits }}</span>
                        </div>
                    @empty
                        <p class="muted">No pageviews yet.</p>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Top Countries -->
        <div class="dash-card">
            <div class="card-header"><h3><i class="fa-solid fa-globe-africa"></i> Top Countries</h3></div>
            <div class="card-body">
                <table class="admin-table compact">
                    <thead><tr><th>Country</th><th>Hits</th></tr></thead>
                    <tbody>
                        @forelse($topCountries as $c)
                            <tr><td>{{ $c->country ?? 'N/A' }}</td><td>{{ $c->hits }}</td></tr>
                        @empty
                            <tr><td colspan="2" class="muted">No data yet.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Latest News -->
        <div class="dash-card">
            <div class="card-header"><h3><i class="fa-solid fa-newspaper"></i> Latest News</h3></div>
            <div class="card-body list-body">
                @forelse($latestNews as $news)
                    <div class="list-row">
                        <div>
                            <strong>{{ $news->title }}</strong>
                            <div class="muted small">{{ ucfirst($news->type) }} • {{ $news->created_at?->format('M d, Y') }}</div>
                        </div>
                        <a class="btn-outline-admin" href="{{ route('admin.news.edit', $news) }}">Edit</a>
                    </div>
                @empty
                    <p class="muted">No news yet.</p>
                @endforelse
            </div>
        </div>

        <!-- Latest Publications -->
        <div class="dash-card">
            <div class="card-header"><h3><i class="fa-solid fa-book"></i> Latest Publications</h3></div>
            <div class="card-body list-body">
                @forelse($latestPubs as $pub)
                    <div class="list-row">
                        <div>
                            <strong>{{ $pub->title }}</strong>
                            <div class="muted small">{{ $pub->year }} • {{ ucfirst($pub->type) }}</div>
                        </div>
                        <a class="btn-outline-admin" href="{{ route('admin.publications') }}">Manage</a>
                    </div>
                @empty
                    <p class="muted">No publications yet.</p>
                @endforelse
            </div>
        </div>

        <!-- Recent Downloads -->
        <div class="dash-card">
            <div class="card-header"><h3><i class="fa-solid fa-download"></i> Recent Downloads</h3></div>
            <div class="card-body list-body">
                @forelse($recentDownloads as $d)
                    <div class="list-row">
                        <div>
                            <strong>{{ $d->path ?? data_get($d->meta,'file') ?? '—' }}</strong>
                            <div class="muted small">{{ $d->country ?? 'N/A' }} • {{ $d->created_at?->diffForHumans() }}</div>
                        </div>
                    </div>
                @empty
                    <p class="muted">No downloads yet.</p>
                @endforelse
            </div>
        </div>

        <!-- Integrations -->
        <div class="dash-card">
            <div class="card-header"><h3><i class="fa-solid fa-plug"></i> Data Sources</h3></div>
            <div class="card-body list-body">
                @forelse($sources as $src)
                    <div class="list-row">
                        <div>
                            <strong>{{ $src->name }}</strong>
                            <div class="muted small">{{ strtoupper($src->type) }} • {{ $src->sync_frequency }}</div>
                        </div>
                        <span class="tag status {{ $src->status }}">{{ ucfirst($src->status) }}</span>
                    </div>
                @empty
                    <p class="muted">No external sources configured.</p>
                @endforelse
            </div>
        </div>
    </div>
@endsection

@push('styles')
<style>
.muted.small { font-size:12px; color:#6b7280; }
.stats-grid { display:grid; grid-template-columns:repeat(auto-fit,minmax(170px,1fr)); gap:10px; margin-bottom:14px; }
.stat-card { background:#fff; border:1px solid #e5e7eb; border-radius:12px; padding:12px; display:flex; align-items:center; gap:10px; box-shadow:0 10px 24px rgba(15,23,42,0.06); }
.stat-icon { width:42px; height:42px; border-radius:10px; display:flex; align-items:center; justify-content:center; color:#fff; }
.stat-icon.blue { background:#2563eb; }
.stat-icon.green { background:#16a34a; }
.stat-icon.gold { background:#d97706; }
.stat-icon.maroon { background:#7f1d1d; }
.stat-icon.purple { background:#7c3aed; }
.stat-number { font-size:22px; font-weight:800; }
.stat-label { color:#6b7280; font-size:12px; }
.dashboard-grid { display:grid; grid-template-columns:repeat(auto-fit,minmax(280px,1fr)); gap:12px; }
.dash-card { background:#fff; border:1px solid #e5e7eb; border-radius:12px; box-shadow:0 10px 24px rgba(0,0,0,0.05); padding:12px; display:flex; flex-direction:column; }
.card-header { display:flex; justify-content:space-between; align-items:center; margin-bottom:8px; }
.top-pages-list .page-item { display:flex; align-items:center; gap:10px; border-bottom:1px solid #e5e7eb; padding:8px 0; }
.page-rank { width:22px; height:22px; border-radius:50%; background:#f3f4f6; display:flex; align-items:center; justify-content:center; font-weight:700; }
.page-views { margin-left:auto; font-weight:700; }
.list-body .list-row { display:flex; justify-content:space-between; align-items:flex-start; border-bottom:1px solid #e5e7eb; padding:8px 0; gap:8px; }
.snapshot-row { display:flex; justify-content:space-between; padding:6px 0; border-bottom:1px solid #f1f5f9; }
.tag.status.active { color:#15803d; }
.tag.status.inactive { color:#6b7280; }
.tag.status.error { color:#b91c1c; }
</style>
@endpush
