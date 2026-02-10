@extends('layouts.admin')

@section('title', 'Flagship Projects')
@section('page-title', 'Flagship Projects')

@section('content')

    <!-- Page Header -->
    <div class="page-header-banner">
        <div class="page-header-text">
            <h1><i class="fa-solid fa-rocket"></i> Flagship Projects</h1>
            <p>Manage and track Agenda 2063's 15 flagship projects and their progress.</p>
        </div>
        <div class="page-header-actions">
            <button class="btn-outline-admin"><i class="fa-solid fa-chart-pie"></i> Progress Report</button>
            <button class="btn-primary-admin"><i class="fa-solid fa-plus"></i> Add Project Update</button>
        </div>
    </div>

    <!-- Stats -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon blue"><i class="fa-solid fa-project-diagram"></i></div>
            <div class="stat-details">
                <span class="stat-number">15</span>
                <span class="stat-label">Total Flagship Projects</span>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon green"><i class="fa-solid fa-spinner"></i></div>
            <div class="stat-details">
                <span class="stat-number">9</span>
                <span class="stat-label">In Progress</span>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon gold"><i class="fa-solid fa-clock"></i></div>
            <div class="stat-details">
                <span class="stat-number">4</span>
                <span class="stat-label">Planning Phase</span>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon maroon"><i class="fa-solid fa-check-circle"></i></div>
            <div class="stat-details">
                <span class="stat-number">2</span>
                <span class="stat-label">Completed</span>
            </div>
        </div>
    </div>

    <!-- Projects Grid -->
    <div class="flagship-grid">

        <div class="flagship-card">
            <div class="flagship-card-header">
                <div class="flagship-icon" style="background: rgba(52, 152, 219, 0.12); color: #3498db;">
                    <i class="fa-solid fa-train"></i>
                </div>
                <span class="flagship-status in-progress">In Progress</span>
            </div>
            <h3 class="flagship-title">Integrated High-Speed Train Network</h3>
            <p class="flagship-desc">Connecting all African capitals and commercial centres through high-speed rail.</p>
            <div class="flagship-progress">
                <div class="progress-info"><span>Progress</span><span>34%</span></div>
                <div class="progress-bar"><div class="progress-fill" style="width: 34%; background: #3498db;"></div></div>
            </div>
            <div class="flagship-meta">
                <span><i class="fa-solid fa-calendar"></i> Updated: Jan 2026</span>
                <div class="flagship-actions">
                    <button class="action-icon-btn" title="Edit"><i class="fa-solid fa-pen"></i></button>
                    <button class="action-icon-btn" title="View"><i class="fa-solid fa-eye"></i></button>
                </div>
            </div>
        </div>

        <div class="flagship-card">
            <div class="flagship-card-header">
                <div class="flagship-icon" style="background: rgba(46, 204, 113, 0.12); color: #2ecc71;">
                    <i class="fa-solid fa-plane"></i>
                </div>
                <span class="flagship-status in-progress">In Progress</span>
            </div>
            <h3 class="flagship-title">Single African Air Transport Market (SAATM)</h3>
            <p class="flagship-desc">Liberalizing air transport to create a single unified market for African aviation.</p>
            <div class="flagship-progress">
                <div class="progress-info"><span>Progress</span><span>68%</span></div>
                <div class="progress-bar"><div class="progress-fill" style="width: 68%; background: #2ecc71;"></div></div>
            </div>
            <div class="flagship-meta">
                <span><i class="fa-solid fa-calendar"></i> Updated: Feb 2026</span>
                <div class="flagship-actions">
                    <button class="action-icon-btn" title="Edit"><i class="fa-solid fa-pen"></i></button>
                    <button class="action-icon-btn" title="View"><i class="fa-solid fa-eye"></i></button>
                </div>
            </div>
        </div>

        <div class="flagship-card">
            <div class="flagship-card-header">
                <div class="flagship-icon" style="background: rgba(245, 193, 67, 0.12); color: #f5c143;">
                    <i class="fa-solid fa-exchange-alt"></i>
                </div>
                <span class="flagship-status in-progress">In Progress</span>
            </div>
            <h3 class="flagship-title">African Continental Free Trade Area (AfCFTA)</h3>
            <p class="flagship-desc">Creating the world's largest free trade area by connecting 1.3 billion people.</p>
            <div class="flagship-progress">
                <div class="progress-info"><span>Progress</span><span>72%</span></div>
                <div class="progress-bar"><div class="progress-fill" style="width: 72%; background: #f5c143;"></div></div>
            </div>
            <div class="flagship-meta">
                <span><i class="fa-solid fa-calendar"></i> Updated: Feb 2026</span>
                <div class="flagship-actions">
                    <button class="action-icon-btn" title="Edit"><i class="fa-solid fa-pen"></i></button>
                    <button class="action-icon-btn" title="View"><i class="fa-solid fa-eye"></i></button>
                </div>
            </div>
        </div>

        <div class="flagship-card">
            <div class="flagship-card-header">
                <div class="flagship-icon" style="background: rgba(130, 43, 57, 0.12); color: #822b39;">
                    <i class="fa-solid fa-passport"></i>
                </div>
                <span class="flagship-status in-progress">In Progress</span>
            </div>
            <h3 class="flagship-title">African Passport & Free Movement</h3>
            <p class="flagship-desc">Removing restrictions on movement for African citizens across the continent.</p>
            <div class="flagship-progress">
                <div class="progress-info"><span>Progress</span><span>45%</span></div>
                <div class="progress-bar"><div class="progress-fill" style="width: 45%; background: #822b39;"></div></div>
            </div>
            <div class="flagship-meta">
                <span><i class="fa-solid fa-calendar"></i> Updated: Dec 2025</span>
                <div class="flagship-actions">
                    <button class="action-icon-btn" title="Edit"><i class="fa-solid fa-pen"></i></button>
                    <button class="action-icon-btn" title="View"><i class="fa-solid fa-eye"></i></button>
                </div>
            </div>
        </div>

        <div class="flagship-card">
            <div class="flagship-card-header">
                <div class="flagship-icon" style="background: rgba(155, 89, 182, 0.12); color: #9b59b6;">
                    <i class="fa-solid fa-shield-halved"></i>
                </div>
                <span class="flagship-status planning">Planning</span>
            </div>
            <h3 class="flagship-title">Silencing the Guns by 2030</h3>
            <p class="flagship-desc">Ending all wars, civil conflicts, and gender-based violence in Africa.</p>
            <div class="flagship-progress">
                <div class="progress-info"><span>Progress</span><span>28%</span></div>
                <div class="progress-bar"><div class="progress-fill" style="width: 28%; background: #9b59b6;"></div></div>
            </div>
            <div class="flagship-meta">
                <span><i class="fa-solid fa-calendar"></i> Updated: Nov 2025</span>
                <div class="flagship-actions">
                    <button class="action-icon-btn" title="Edit"><i class="fa-solid fa-pen"></i></button>
                    <button class="action-icon-btn" title="View"><i class="fa-solid fa-eye"></i></button>
                </div>
            </div>
        </div>

        <div class="flagship-card">
            <div class="flagship-card-header">
                <div class="flagship-icon" style="background: rgba(231, 76, 60, 0.12); color: #e74c3c;">
                    <i class="fa-solid fa-dam"></i>
                </div>
                <span class="flagship-status in-progress">In Progress</span>
            </div>
            <h3 class="flagship-title">Grand Inga Dam Project</h3>
            <p class="flagship-desc">Harnessing the hydro potential of the Congo River for continental energy supply.</p>
            <div class="flagship-progress">
                <div class="progress-info"><span>Progress</span><span>18%</span></div>
                <div class="progress-bar"><div class="progress-fill" style="width: 18%; background: #e74c3c;"></div></div>
            </div>
            <div class="flagship-meta">
                <span><i class="fa-solid fa-calendar"></i> Updated: Oct 2025</span>
                <div class="flagship-actions">
                    <button class="action-icon-btn" title="Edit"><i class="fa-solid fa-pen"></i></button>
                    <button class="action-icon-btn" title="View"><i class="fa-solid fa-eye"></i></button>
                </div>
            </div>
        </div>

    </div>

@endsection
