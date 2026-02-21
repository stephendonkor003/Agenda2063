@extends('layouts.admin')

@section('title', 'Campaign Subscribers')
@section('page-title', 'Campaign Subscribers')

@section('content')
    <div class="page-header-banner">
        <div class="page-header-text">
            <h1><i class="fa-solid fa-users-rectangle"></i> Campaign Subscribers</h1>
            <p>Track signups, newsletter opt-ins, and interests.</p>
        </div>
    </div>

    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon blue"><i class="fa-solid fa-user-plus"></i></div>
            <div class="stat-details"><span class="stat-number">{{ number_format($total) }}</span><span class="stat-label">Total Signups</span></div>
        </div>
        <div class="stat-card">
            <div class="stat-icon green"><i class="fa-solid fa-envelope"></i></div>
            <div class="stat-details"><span class="stat-number">{{ $newsletterPct }}%</span><span class="stat-label">Newsletter Opt-in</span></div>
        </div>
    </div>

    <div class="dashboard-grid">
        <div class="dash-card">
            <div class="card-header"><h3><i class="fa-solid fa-flag"></i> Top Countries</h3></div>
            <div class="card-body">
                <table class="admin-table compact">
                    <thead><tr><th>Country</th><th>Signups</th></tr></thead>
                    <tbody>
                        @forelse($byCountry as $row)
                            <tr><td>{{ $row->country }}</td><td>{{ $row->total }}</td></tr>
                        @empty
                            <tr><td colspan="2" class="muted">No data yet.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="dash-card">
            <div class="card-header"><h3><i class="fa-solid fa-star"></i> Interests</h3></div>
            <div class="card-body list-body">
                @forelse($byInterest as $row)
                    <div class="list-row">
                        <div><strong>{{ $row->interest ?: 'Not specified' }}</strong></div>
                        <span class="muted small">{{ $row->total }} signups</span>
                    </div>
                @empty
                    <p class="muted">No interests captured.</p>
                @endforelse
            </div>
        </div>
    </div>

    <div class="dash-card" style="margin-top:12px;">
        <div class="card-header"><h3><i class="fa-solid fa-clock-rotate-left"></i> Recent Signups</h3></div>
        <div class="card-body">
            <table class="admin-table compact">
                <thead><tr><th>Name</th><th>Email</th><th>Country</th><th>Interest</th><th>Newsletter</th><th>When</th></tr></thead>
                <tbody>
                    @forelse($recent as $row)
                        <tr>
                            <td>{{ $row->first_name }} {{ $row->last_name }}</td>
                            <td>{{ $row->email }}</td>
                            <td>{{ $row->country }}</td>
                            <td>{{ $row->interest ?: '—' }}</td>
                            <td>{{ $row->newsletter ? 'Yes' : 'No' }}</td>
                            <td>{{ $row->created_at?->diffForHumans() }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="muted">No signups yet.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="dash-card" style="margin-top:12px;">
        <div class="card-header"><h3><i class="fa-solid fa-bullhorn"></i> Broadcast to Subscribers</h3></div>
        <div class="card-body">
            <form method="POST" action="{{ route('campaign-subscribers.broadcast') }}">
                @csrf
                <div class="form-grid">
                    <label>Subject
                        <input type="text" name="subject" class="settings-input" required maxlength="255">
                    </label>
                    <label>Preview text (optional)
                        <input type="text" name="preview" class="settings-input" maxlength="255">
                    </label>
                    <label>Footer note (optional)
                        <input type="text" name="footer" class="settings-input" maxlength="500" placeholder="You receive this update because...">
                    </label>
                    <label class="checkbox-row">
                        <input type="checkbox" name="only_newsletter" value="1"> Send only to newsletter opt-in
                    </label>
                </div>
                <label>Body (HTML allowed)
                    <textarea name="body_html" class="settings-textarea" rows="10" required placeholder="<p>Write your announcement...</p>"></textarea>
                </label>
                <div class="broadcast-help">Messages queue on the `mail` queue and send in batches for reliability.</div>
                <button class="btn-primary-admin" type="submit"><i class="fa-solid fa-paper-plane"></i> Queue Broadcast</button>
            </form>
        </div>
    </div>
@endsection

@push('styles')
<style>
.stats-grid { display:grid; grid-template-columns:repeat(auto-fit,minmax(180px,1fr)); gap:10px; margin-bottom:14px; }
.stat-card { background:#fff; border:1px solid #e5e7eb; border-radius:12px; padding:12px; display:flex; align-items:center; gap:10px; box-shadow:0 10px 24px rgba(15,23,42,0.06); }
.stat-icon { width:42px; height:42px; border-radius:10px; display:flex; align-items:center; justify-content:center; color:#fff; }
.stat-icon.blue { background:#2563eb; }
.stat-icon.green { background:#16a34a; }
.stat-number { font-size:20px; font-weight:800; }
.stat-label { color:#6b7280; font-size:12px; }
.dashboard-grid { display:grid; grid-template-columns:repeat(auto-fit,minmax(280px,1fr)); gap:12px; }
.dash-card { background:#fff; border:1px solid #e5e7eb; border-radius:12px; box-shadow:0 10px 24px rgba(0,0,0,0.05); padding:12px; display:flex; flex-direction:column; }
.card-header { display:flex; justify-content:space-between; align-items:center; margin-bottom:8px; }
.list-body .list-row { display:flex; justify-content:space-between; align-items:flex-start; border-bottom:1px solid #e5e7eb; padding:8px 0; gap:8px; }
.admin-table.compact th, .admin-table.compact td { padding:8px; }
.muted.small { font-size:12px; color:#6b7280; }
.form-grid { display:grid; grid-template-columns:repeat(auto-fit,minmax(240px,1fr)); gap:12px; margin-bottom:12px; }
.checkbox-row { display:flex; align-items:center; gap:8px; margin-top:8px; }
.broadcast-help { color:#6b7280; font-size:12px; margin:8px 0; }
</style>
@endpush
