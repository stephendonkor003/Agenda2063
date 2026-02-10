@extends('layouts.admin')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')

    <!-- Welcome Banner -->
    <div class="welcome-banner">
        <div class="welcome-text">
            <h1>Welcome back, Admin</h1>
            <p>Here's what's happening with Agenda 2063 platform today.</p>
        </div>
        <div class="welcome-date">
            <i class="fa-solid fa-calendar-day"></i>
            <span>{{ date('l, F j, Y') }}</span>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon blue">
                <i class="fa-solid fa-newspaper"></i>
            </div>
            <div class="stat-details">
                <span class="stat-number">156</span>
                <span class="stat-label">Published Articles</span>
            </div>
            <div class="stat-trend up">
                <i class="fa-solid fa-arrow-up"></i> 12%
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon green">
                <i class="fa-solid fa-eye"></i>
            </div>
            <div class="stat-details">
                <span class="stat-number">24,589</span>
                <span class="stat-label">Total Visits</span>
            </div>
            <div class="stat-trend up">
                <i class="fa-solid fa-arrow-up"></i> 8%
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon gold">
                <i class="fa-solid fa-file-pdf"></i>
            </div>
            <div class="stat-details">
                <span class="stat-number">46</span>
                <span class="stat-label">Documents</span>
            </div>
            <div class="stat-trend up">
                <i class="fa-solid fa-arrow-up"></i> 3%
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon maroon">
                <i class="fa-solid fa-users"></i>
            </div>
            <div class="stat-details">
                <span class="stat-number">1,247</span>
                <span class="stat-label">Subscribers</span>
            </div>
            <div class="stat-trend down">
                <i class="fa-solid fa-arrow-down"></i> 2%
            </div>
        </div>
    </div>

    <!-- Main Dashboard Grid -->
    <div class="dashboard-grid">

        <!-- Recent Activity -->
        <div class="dash-card activity-card">
            <div class="card-header">
                <h3><i class="fa-solid fa-clock-rotate-left"></i> Recent Activity</h3>
                <a href="#" class="card-link">View All</a>
            </div>
            <div class="card-body">
                <div class="activity-list">
                    <div class="activity-item">
                        <div class="activity-dot blue"></div>
                        <div class="activity-content">
                            <p><strong>New article published:</strong> AfCFTA Trade Report 2025</p>
                            <span class="activity-time">2 hours ago</span>
                        </div>
                    </div>
                    <div class="activity-item">
                        <div class="activity-dot green"></div>
                        <div class="activity-content">
                            <p><strong>Document uploaded:</strong> Second Ten-Year Implementation Plan</p>
                            <span class="activity-time">5 hours ago</span>
                        </div>
                    </div>
                    <div class="activity-item">
                        <div class="activity-dot gold"></div>
                        <div class="activity-content">
                            <p><strong>Performance data updated:</strong> ECOWAS Regional Report</p>
                            <span class="activity-time">Yesterday</span>
                        </div>
                    </div>
                    <div class="activity-item">
                        <div class="activity-dot maroon"></div>
                        <div class="activity-content">
                            <p><strong>New subscriber:</strong> 15 new email subscriptions this week</p>
                            <span class="activity-time">2 days ago</span>
                        </div>
                    </div>
                    <div class="activity-item">
                        <div class="activity-dot blue"></div>
                        <div class="activity-content">
                            <p><strong>Flagship project updated:</strong> SAATM status report refreshed</p>
                            <span class="activity-time">3 days ago</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="dash-card actions-card">
            <div class="card-header">
                <h3><i class="fa-solid fa-bolt"></i> Quick Actions</h3>
            </div>
            <div class="card-body">
                <div class="quick-actions">
                    <a href="#" class="action-btn">
                        <div class="action-icon blue"><i class="fa-solid fa-plus"></i></div>
                        <span>New Article</span>
                    </a>
                    <a href="#" class="action-btn">
                        <div class="action-icon green"><i class="fa-solid fa-upload"></i></div>
                        <span>Upload Document</span>
                    </a>
                    <a href="#" class="action-btn">
                        <div class="action-icon gold"><i class="fa-solid fa-chart-pie"></i></div>
                        <span>Update Stats</span>
                    </a>
                    <a href="#" class="action-btn">
                        <div class="action-icon maroon"><i class="fa-solid fa-calendar-plus"></i></div>
                        <span>New Event</span>
                    </a>
                    <a href="#" class="action-btn">
                        <div class="action-icon blue"><i class="fa-solid fa-image"></i></div>
                        <span>Media Library</span>
                    </a>
                    <a href="#" class="action-btn">
                        <div class="action-icon green"><i class="fa-solid fa-envelope"></i></div>
                        <span>Send Newsletter</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Regional Performance Overview -->
        <div class="dash-card performance-card">
            <div class="card-header">
                <h3><i class="fa-solid fa-globe-africa"></i> Regional Performance</h3>
                <a href="#" class="card-link">Full Report</a>
            </div>
            <div class="card-body">
                <div class="region-bars">
                    <div class="region-bar-item">
                        <div class="region-bar-label">
                            <span>ECOWAS</span>
                            <span class="region-pct">68%</span>
                        </div>
                        <div class="region-bar"><div class="region-fill" style="width: 68%; background: #3498db;"></div></div>
                    </div>
                    <div class="region-bar-item">
                        <div class="region-bar-label">
                            <span>SADC</span>
                            <span class="region-pct">54%</span>
                        </div>
                        <div class="region-bar"><div class="region-fill" style="width: 54%; background: #9b59b6;"></div></div>
                    </div>
                    <div class="region-bar-item">
                        <div class="region-bar-label">
                            <span>EAC</span>
                            <span class="region-pct">72%</span>
                        </div>
                        <div class="region-bar"><div class="region-fill" style="width: 72%; background: #f39c12;"></div></div>
                    </div>
                    <div class="region-bar-item">
                        <div class="region-bar-label">
                            <span>ECCAS</span>
                            <span class="region-pct">41%</span>
                        </div>
                        <div class="region-bar"><div class="region-fill" style="width: 41%; background: #2ecc71;"></div></div>
                    </div>
                    <div class="region-bar-item">
                        <div class="region-bar-label">
                            <span>COMESA</span>
                            <span class="region-pct">59%</span>
                        </div>
                        <div class="region-bar"><div class="region-fill" style="width: 59%; background: #e74c3c;"></div></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Top Pages -->
        <div class="dash-card pages-card">
            <div class="card-header">
                <h3><i class="fa-solid fa-fire"></i> Top Pages</h3>
            </div>
            <div class="card-body">
                <div class="top-pages-list">
                    <div class="page-item">
                        <span class="page-rank">1</span>
                        <div class="page-info">
                            <span class="page-name">Home Page</span>
                            <span class="page-url">/</span>
                        </div>
                        <span class="page-views">8,432</span>
                    </div>
                    <div class="page-item">
                        <span class="page-rank">2</span>
                        <div class="page-info">
                            <span class="page-name">About Agenda 2063</span>
                            <span class="page-url">/about</span>
                        </div>
                        <span class="page-views">5,201</span>
                    </div>
                    <div class="page-item">
                        <span class="page-rank">3</span>
                        <div class="page-info">
                            <span class="page-name">Knowledge Base</span>
                            <span class="page-url">/knowledge-base</span>
                        </div>
                        <span class="page-views">3,847</span>
                    </div>
                    <div class="page-item">
                        <span class="page-rank">4</span>
                        <div class="page-info">
                            <span class="page-name">Performance Dashboard</span>
                            <span class="page-url">/performance</span>
                        </div>
                        <span class="page-views">2,965</span>
                    </div>
                    <div class="page-item">
                        <span class="page-rank">5</span>
                        <div class="page-info">
                            <span class="page-name">News & Events</span>
                            <span class="page-url">/news</span>
                        </div>
                        <span class="page-views">2,114</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
