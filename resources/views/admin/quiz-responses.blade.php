@extends('layouts.admin')

@section('title', 'Quiz Responses')
@section('page-title', 'Quiz Responses')

@section('content')
    <div class="page-header-banner">
        <div class="page-header-text">
            <h1><i class="fa-solid fa-clipboard-question"></i> Quiz Responses</h1>
            <p>Monitor quiz participation, accuracy, and top slides/questions.</p>
        </div>
    </div>

    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon blue"><i class="fa-solid fa-list-ol"></i></div>
            <div class="stat-details"><span class="stat-number">{{ number_format($stats['total']) }}</span><span class="stat-label">Total Responses</span></div>
        </div>
        <div class="stat-card">
            <div class="stat-icon green"><i class="fa-solid fa-bullseye"></i></div>
            <div class="stat-details"><span class="stat-number">{{ $stats['correct_pct'] }}%</span><span class="stat-label">Correct</span></div>
        </div>
    </div>

    <div class="dashboard-grid">
        <div class="dash-card">
            <div class="card-header"><h3><i class="fa-solid fa-chart-bar"></i> Accuracy by Slide</h3></div>
            <div class="card-body">
                <table class="admin-table compact">
                    <thead><tr><th>Slide</th><th>Responses</th><th>% Correct</th></tr></thead>
                    <tbody>
                        @foreach($bySlide as $row)
                            @php $pct = $row->total ? round(($row->correct / $row->total)*100,1) : 0; @endphp
                            <tr><td>{{ $row->slide_number }}</td><td>{{ $row->total }}</td><td>{{ $pct }}%</td></tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="dash-card">
            <div class="card-header"><h3><i class="fa-solid fa-star"></i> Top Questions</h3></div>
            <div class="card-body list-body">
                @forelse($topQuestions as $q)
                    <div class="list-row">
                        <div><strong>{{ $q->question }}</strong></div>
                        <span class="muted small">{{ $q->total }} responses</span>
                    </div>
                @empty
                    <p class="muted">No responses yet.</p>
                @endforelse
            </div>
        </div>
    </div>

    <div class="dash-card" style="margin-top:12px;">
        <div class="card-header"><h3><i class="fa-solid fa-clock-rotate-left"></i> Recent Responses</h3></div>
        <div class="card-body">
            <table class="admin-table compact">
                <thead><tr><th>Email</th><th>Slide</th><th>Question</th><th>Answer</th><th>Correct</th><th>When</th></tr></thead>
                <tbody>
                    @forelse($recent as $row)
                        <tr>
                            <td>{{ $row->email }}</td>
                            <td>{{ $row->slide_number }}</td>
                            <td>{{ Str::limit($row->question, 60) }}</td>
                            <td>{{ $row->selected_answer }}</td>
                            <td>{{ $row->is_correct ? 'Yes' : 'No' }}</td>
                            <td>{{ $row->created_at?->diffForHumans() }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="muted">No responses yet.</td></tr>
                    @endforelse
                </tbody>
            </table>
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
</style>
@endpush
