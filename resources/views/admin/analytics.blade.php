@extends('layouts.admin')

@section('title', 'Analytics')
@section('page-title', 'Analytics')

@section('content')

    <!-- Page Header -->
    <div class="page-header-banner">
        <div class="page-header-text">
            <h1><i class="fa-solid fa-chart-bar"></i> Analytics Overview</h1>
            <p>Monitor platform traffic, user engagement, and content performance.</p>
        </div>
        <div class="page-header-actions">
            <select class="filter-select" id="dateRange">
                <option>Last 7 Days</option>
                <option>Last 30 Days</option>
                <option>Last 90 Days</option>
                <option>This Year</option>
            </select>
            <button class="btn-primary-admin"><i class="fa-solid fa-download"></i> Export Report</button>
        </div>
    </div>

    <!-- Key Metrics -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon blue"><i class="fa-solid fa-eye"></i></div>
            <div class="stat-details">
                <span class="stat-number">45,231</span>
                <span class="stat-label">Page Views</span>
            </div>
            <div class="stat-trend up"><i class="fa-solid fa-arrow-up"></i> 15%</div>
        </div>
        <div class="stat-card">
            <div class="stat-icon green"><i class="fa-solid fa-users"></i></div>
            <div class="stat-details">
                <span class="stat-number">12,847</span>
                <span class="stat-label">Unique Visitors</span>
            </div>
            <div class="stat-trend up"><i class="fa-solid fa-arrow-up"></i> 9%</div>
        </div>
        <div class="stat-card">
            <div class="stat-icon gold"><i class="fa-solid fa-clock"></i></div>
            <div class="stat-details">
                <span class="stat-number">4:32</span>
                <span class="stat-label">Avg. Session Duration</span>
            </div>
            <div class="stat-trend up"><i class="fa-solid fa-arrow-up"></i> 5%</div>
        </div>
        <div class="stat-card">
            <div class="stat-icon maroon"><i class="fa-solid fa-arrow-right-from-bracket"></i></div>
            <div class="stat-details">
                <span class="stat-number">32.4%</span>
                <span class="stat-label">Bounce Rate</span>
            </div>
            <div class="stat-trend down"><i class="fa-solid fa-arrow-down"></i> 3%</div>
        </div>
    </div>

    <!-- Charts Row -->
    <div class="dashboard-grid">

        <!-- Traffic Chart Placeholder -->
        <div class="dash-card">
            <div class="card-header">
                <h3><i class="fa-solid fa-chart-line"></i> Traffic Overview</h3>
                <div class="chart-tabs">
                    <button class="chart-tab active">Daily</button>
                    <button class="chart-tab">Weekly</button>
                    <button class="chart-tab">Monthly</button>
                </div>
            </div>
            <div class="card-body">
                <div class="chart-placeholder">
                    <div class="chart-bars">
                        <div class="chart-bar-group" style="--val: 65%"><div class="chart-bar-fill"></div><span>Mon</span></div>
                        <div class="chart-bar-group" style="--val: 80%"><div class="chart-bar-fill"></div><span>Tue</span></div>
                        <div class="chart-bar-group" style="--val: 55%"><div class="chart-bar-fill"></div><span>Wed</span></div>
                        <div class="chart-bar-group" style="--val: 90%"><div class="chart-bar-fill"></div><span>Thu</span></div>
                        <div class="chart-bar-group" style="--val: 72%"><div class="chart-bar-fill"></div><span>Fri</span></div>
                        <div class="chart-bar-group" style="--val: 45%"><div class="chart-bar-fill"></div><span>Sat</span></div>
                        <div class="chart-bar-group" style="--val: 38%"><div class="chart-bar-fill"></div><span>Sun</span></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Device Breakdown -->
        <div class="dash-card">
            <div class="card-header">
                <h3><i class="fa-solid fa-laptop-mobile"></i> Device Breakdown</h3>
            </div>
            <div class="card-body">
                <div class="device-list">
                    <div class="device-item">
                        <div class="device-info">
                            <i class="fa-solid fa-desktop" style="color: #3498db;"></i>
                            <span>Desktop</span>
                        </div>
                        <div class="device-bar-wrap">
                            <div class="device-bar"><div class="device-fill" style="width: 52%; background: #3498db;"></div></div>
                            <span class="device-pct">52%</span>
                        </div>
                    </div>
                    <div class="device-item">
                        <div class="device-info">
                            <i class="fa-solid fa-mobile-screen" style="color: #2ecc71;"></i>
                            <span>Mobile</span>
                        </div>
                        <div class="device-bar-wrap">
                            <div class="device-bar"><div class="device-fill" style="width: 38%; background: #2ecc71;"></div></div>
                            <span class="device-pct">38%</span>
                        </div>
                    </div>
                    <div class="device-item">
                        <div class="device-info">
                            <i class="fa-solid fa-tablet-screen-button" style="color: #f5c143;"></i>
                            <span>Tablet</span>
                        </div>
                        <div class="device-bar-wrap">
                            <div class="device-bar"><div class="device-fill" style="width: 10%; background: #f5c143;"></div></div>
                            <span class="device-pct">10%</span>
                        </div>
                    </div>
                </div>

                <div class="geo-summary">
                    <h4>Top Countries</h4>
                    <div class="geo-list">
                        <div class="geo-item"><span class="geo-flag">🇳🇬</span> <span>Nigeria</span> <span class="geo-visits">3,421</span></div>
                        <div class="geo-item"><span class="geo-flag">🇰🇪</span> <span>Kenya</span> <span class="geo-visits">2,105</span></div>
                        <div class="geo-item"><span class="geo-flag">🇿🇦</span> <span>South Africa</span> <span class="geo-visits">1,892</span></div>
                        <div class="geo-item"><span class="geo-flag">🇪🇹</span> <span>Ethiopia</span> <span class="geo-visits">1,547</span></div>
                        <div class="geo-item"><span class="geo-flag">🇬🇭</span> <span>Ghana</span> <span class="geo-visits">1,203</span></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Top Content -->
        <div class="dash-card">
            <div class="card-header">
                <h3><i class="fa-solid fa-fire"></i> Top Content</h3>
                <a href="#" class="card-link">View All</a>
            </div>
            <div class="card-body">
                <div class="top-pages-list">
                    <div class="page-item">
                        <span class="page-rank">1</span>
                        <div class="page-info">
                            <span class="page-name">AfCFTA Implementation Guide</span>
                            <span class="page-url">/knowledge-base</span>
                        </div>
                        <span class="page-views">4,218</span>
                    </div>
                    <div class="page-item">
                        <span class="page-rank">2</span>
                        <div class="page-info">
                            <span class="page-name">Second Ten-Year Plan Overview</span>
                            <span class="page-url">/about</span>
                        </div>
                        <span class="page-views">3,102</span>
                    </div>
                    <div class="page-item">
                        <span class="page-rank">3</span>
                        <div class="page-info">
                            <span class="page-name">SAATM Flagship Project</span>
                            <span class="page-url">/flagship-projects</span>
                        </div>
                        <span class="page-views">2,456</span>
                    </div>
                    <div class="page-item">
                        <span class="page-rank">4</span>
                        <div class="page-info">
                            <span class="page-name">ECOWAS Performance Report</span>
                            <span class="page-url">/performance</span>
                        </div>
                        <span class="page-views">1,890</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Traffic Sources -->
        <div class="dash-card">
            <div class="card-header">
                <h3><i class="fa-solid fa-share-nodes"></i> Traffic Sources</h3>
            </div>
            <div class="card-body">
                <div class="source-list">
                    <div class="source-item">
                        <div class="source-info">
                            <div class="source-icon" style="background: rgba(52, 152, 219, 0.12); color: #3498db;"><i class="fa-solid fa-search"></i></div>
                            <div>
                                <span class="source-name">Organic Search</span>
                                <span class="source-detail">Google, Bing, Yahoo</span>
                            </div>
                        </div>
                        <div class="source-stats">
                            <span class="source-number">18,432</span>
                            <span class="source-pct up">+12%</span>
                        </div>
                    </div>
                    <div class="source-item">
                        <div class="source-info">
                            <div class="source-icon" style="background: rgba(46, 204, 113, 0.12); color: #2ecc71;"><i class="fa-solid fa-link"></i></div>
                            <div>
                                <span class="source-name">Direct Traffic</span>
                                <span class="source-detail">Bookmarks & URLs</span>
                            </div>
                        </div>
                        <div class="source-stats">
                            <span class="source-number">9,215</span>
                            <span class="source-pct up">+5%</span>
                        </div>
                    </div>
                    <div class="source-item">
                        <div class="source-info">
                            <div class="source-icon" style="background: rgba(155, 89, 182, 0.12); color: #9b59b6;"><i class="fa-brands fa-twitter"></i></div>
                            <div>
                                <span class="source-name">Social Media</span>
                                <span class="source-detail">Twitter, Facebook, LinkedIn</span>
                            </div>
                        </div>
                        <div class="source-stats">
                            <span class="source-number">6,891</span>
                            <span class="source-pct up">+22%</span>
                        </div>
                    </div>
                    <div class="source-item">
                        <div class="source-info">
                            <div class="source-icon" style="background: rgba(245, 193, 67, 0.12); color: #f5c143;"><i class="fa-solid fa-envelope"></i></div>
                            <div>
                                <span class="source-name">Email Campaigns</span>
                                <span class="source-detail">Newsletters & alerts</span>
                            </div>
                        </div>
                        <div class="source-stats">
                            <span class="source-number">3,104</span>
                            <span class="source-pct down">-4%</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
