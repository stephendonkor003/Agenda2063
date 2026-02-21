@extends('layouts.public')

@section('title', 'Performance - Agenda 2063')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/performance.css') }}">
@endpush

@section('content')


    <!-- Page Breadcrumb -->
    <nav class="page-breadcrumb" aria-label="Breadcrumb">
        <div class="breadcrumb-container">
            <ol class="breadcrumb-list">
                <li class="breadcrumb-item">
                    <a href="{{ route('home') }}"><i class="fa-solid fa-house"></i><span>Home</span></a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    <span>Performance & Regional Blocks</span>
                </li>
            </ol>
        </div>
    </nav>

    <!-- Page Hero Banner -->
    <section class="page-hero" id="pageHero">
        <div class="page-hero-bg active" style="background-image: url('{{ asset('images/flagships/au5.jpg') }}');"></div>
        <div class="page-hero-bg" style="background-image: url('{{ asset('images/flagships/au1.jpg') }}');"></div>
        <div class="page-hero-bg" style="background-image: url('{{ asset('images/flagships/Aspiration1.png') }}');"></div>
        <div class="page-hero-bg" style="background-image: url('{{ asset('images/flagships/Aspiration3.png') }}');"></div>
        <div class="page-hero-content">
            <span class="hero-label">Agenda 2063 Tracking</span>
            <h1>Regional Performance Dashboard</h1>
            <div class="hero-divider"></div>
            <p>Track Agenda 2063 implementation across Africa's Regional Economic Communities</p>
        </div>
    </section>

    <!-- Performance Content -->
    <section class="performance-content">
        <div class="content-wrapper">

            <!-- Regional Tabs -->
            <div class="regional-tabs">
                <button class="tab-btn active" data-region="continental">
                    <i class="fa-solid fa-globe-africa"></i>
                    <span>Continental Overview</span>
                </button>
                <button class="tab-btn" data-region="ecowas">
                    <i class="fa-solid fa-map-location-dot"></i>
                    <span>ECOWAS</span>
                </button>
                <button class="tab-btn" data-region="eccas">
                    <i class="fa-solid fa-map-location-dot"></i>
                    <span>ECCAS</span>
                </button>
                <button class="tab-btn" data-region="comesa">
                    <i class="fa-solid fa-map-location-dot"></i>
                    <span>COMESA</span>
                </button>
                <button class="tab-btn" data-region="eac">
                    <i class="fa-solid fa-map-location-dot"></i>
                    <span>EAC</span>
                </button>
                <button class="tab-btn" data-region="sadc">
                    <i class="fa-solid fa-map-location-dot"></i>
                    <span>SADC</span>
                </button>
                <button class="tab-btn" data-region="amu">
                    <i class="fa-solid fa-map-location-dot"></i>
                    <span>AMU</span>
                </button>
                <button class="tab-btn" data-region="igad">
                    <i class="fa-solid fa-map-location-dot"></i>
                    <span>IGAD</span>
                </button>
                <button class="tab-btn" data-region="censad">
                    <i class="fa-solid fa-map-location-dot"></i>
                    <span>CEN-SAD</span>
                </button>
            </div>

            <!-- Regional Content Panels -->
            <div class="regional-panels">

                <!-- Continental Overview Panel -->
                <div class="regional-panel active" data-panel="continental">
                    <div class="panel-layout">
                        <div class="map-section">
                            <h3>Africa - Continental View</h3>
                            <div class="africa-map-container">
                                <svg viewBox="0 0 800 900" class="africa-map continental-map">
                                    <!-- Entire Africa Map -->
                                    <g id="africa-continent" class="continent-group">
                                        <!-- North Africa -->
                                        <path class="region north-africa"
                                            d="M 150 100 L 650 100 L 680 150 L 650 200 L 600 220 L 550 200 L 500 220 L 450 200 L 400 220 L 350 200 L 300 220 L 250 200 L 200 220 L 150 200 Z" />

                                        <!-- West Africa -->
                                        <path class="region west-africa"
                                            d="M 150 200 L 200 220 L 250 200 L 300 220 L 300 350 L 280 400 L 250 420 L 200 400 L 150 380 L 120 350 L 130 300 L 140 250 Z" />

                                        <!-- Central Africa -->
                                        <path class="region central-africa"
                                            d="M 300 220 L 350 200 L 400 220 L 450 200 L 500 220 L 520 280 L 500 350 L 480 400 L 450 420 L 400 400 L 350 420 L 300 400 L 280 350 Z" />

                                        <!-- East Africa -->
                                        <path class="region east-africa"
                                            d="M 500 220 L 550 200 L 600 220 L 650 200 L 680 250 L 700 300 L 680 350 L 650 400 L 620 450 L 600 500 L 580 520 L 550 500 L 520 480 L 500 450 L 520 400 L 520 350 L 520 280 Z" />

                                        <!-- Southern Africa -->
                                        <path class="region southern-africa"
                                            d="M 300 400 L 350 420 L 400 400 L 450 420 L 480 400 L 500 450 L 520 480 L 500 550 L 480 600 L 450 650 L 420 700 L 400 750 L 380 780 L 350 750 L 320 700 L 300 650 L 280 600 L 270 550 L 280 500 L 280 450 Z" />
                                    </g>
                                </svg>
                            </div>
                            <div class="map-legend">
                                <h4>Regional Economic Communities</h4>
                                <div class="legend-items">
                                    <div class="legend-item"><span class="legend-color north"></span> North Africa (AMU)
                                    </div>
                                    <div class="legend-item"><span class="legend-color west"></span> West Africa (ECOWAS)
                                    </div>
                                    <div class="legend-item"><span class="legend-color central"></span> Central Africa
                                        (ECCAS)</div>
                                    <div class="legend-item"><span class="legend-color east"></span> East Africa
                                        (EAC/IGAD/COMESA)</div>
                                    <div class="legend-item"><span class="legend-color south"></span> Southern Africa (SADC)
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="info-section">
                            <div class="region-header">
                                <h2>Continental Performance Overview</h2>
                                <span class="region-badge continental-badge">All Africa</span>
                            </div>

                            <div class="stats-overview">
                                <div class="stat-card">
                                    <i class="fa-solid fa-flag"></i>
                                    <div class="stat-info">
                                        <span class="stat-number">54</span>
                                        <span class="stat-label">Member States</span>
                                    </div>
                                </div>
                                <div class="stat-card">
                                    <i class="fa-solid fa-users"></i>
                                    <div class="stat-info">
                                        <span class="stat-number">1.4B</span>
                                        <span class="stat-label">Population</span>
                                    </div>
                                </div>
                                <div class="stat-card">
                                    <i class="fa-solid fa-chart-line"></i>
                                    <div class="stat-info">
                                        <span class="stat-number">$3.4T</span>
                                        <span class="stat-label">Combined GDP</span>
                                    </div>
                                </div>
                                <div class="stat-card">
                                    <i class="fa-solid fa-trophy"></i>
                                    <div class="stat-info">
                                        <span class="stat-number">62%</span>
                                        <span class="stat-label">Overall Progress</span>
                                    </div>
                                </div>
                            </div>

                            <div class="performance-metrics">
                                <h3>Key Performance Indicators</h3>
                                <div class="metric-item">
                                    <div class="metric-header">
                                        <span class="metric-name">Economic Integration</span>
                                        <span class="metric-value">68%</span>
                                    </div>
                                    <div class="metric-bar">
                                        <div class="metric-fill" style="width: 68%;"></div>
                                    </div>
                                </div>
                                <div class="metric-item">
                                    <div class="metric-header">
                                        <span class="metric-name">Infrastructure Development</span>
                                        <span class="metric-value">55%</span>
                                    </div>
                                    <div class="metric-bar">
                                        <div class="metric-fill" style="width: 55%;"></div>
                                    </div>
                                </div>
                                <div class="metric-item">
                                    <div class="metric-header">
                                        <span class="metric-name">Peace & Security</span>
                                        <span class="metric-value">71%</span>
                                    </div>
                                    <div class="metric-bar">
                                        <div class="metric-fill" style="width: 71%;"></div>
                                    </div>
                                </div>
                                <div class="metric-item">
                                    <div class="metric-header">
                                        <span class="metric-name">Democratic Governance</span>
                                        <span class="metric-value">64%</span>
                                    </div>
                                    <div class="metric-bar">
                                        <div class="metric-fill" style="width: 64%;"></div>
                                    </div>
                                </div>
                                <div class="metric-item">
                                    <div class="metric-header">
                                        <span class="metric-name">Social Development</span>
                                        <span class="metric-value">59%</span>
                                    </div>
                                    <div class="metric-bar">
                                        <div class="metric-fill" style="width: 59%;"></div>
                                    </div>
                                </div>
                            </div>

                            <button class="view-details-btn">
                                <i class="fa-solid fa-arrow-right"></i> View Detailed Report
                            </button>
                        </div>
                    </div>

                    <!-- News & Updates Section -->
                    <div class="news-updates-section">
                        <h3><i class="fa-solid fa-newspaper"></i> Latest Continental Updates</h3>
                        <div class="news-grid">
                            <div class="news-card">
                                <div class="news-date">March 15, 2024</div>
                                <h4>AfCFTA Reaches $50 Billion in Trade Volume</h4>
                                <p>The African Continental Free Trade Area has achieved a significant milestone with
                                    intra-African trade reaching $50 billion...</p>
                                <a href="#" class="news-link">Read More <i class="fa-solid fa-arrow-right"></i></a>
                            </div>
                            <div class="news-card">
                                <div class="news-date">March 10, 2024</div>
                                <h4>Continental Infrastructure Projects Accelerate</h4>
                                <p>Major progress reported in the development of trans-African highways and energy corridors
                                    across multiple regions...</p>
                                <a href="#" class="news-link">Read More <i class="fa-solid fa-arrow-right"></i></a>
                            </div>
                            <div class="news-card">
                                <div class="news-date">March 5, 2024</div>
                                <h4>Digital Transformation Initiative Launched</h4>
                                <p>African Union launches comprehensive digital transformation strategy to connect 500
                                    million Africans by 2030...</p>
                                <a href="#" class="news-link">Read More <i class="fa-solid fa-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ECOWAS Panel -->
                <div class="regional-panel" data-panel="ecowas">
                    <div class="panel-layout">
                        <div class="map-section">
                            <h3>ECOWAS Region</h3>
                            <div class="africa-map-container">
                                <svg viewBox="0 0 800 900" class="africa-map">
                                    <g class="africa-outline">
                                        <path class="outline-path"
                                            d="M 150 100 L 650 100 L 680 150 L 650 200 L 600 220 L 550 200 L 500 220 L 520 280 L 520 350 L 520 400 L 520 480 L 500 550 L 480 600 L 450 650 L 420 700 L 400 750 L 380 780 L 350 750 L 320 700 L 300 650 L 280 600 L 270 550 L 280 500 L 280 450 L 280 400 L 280 350 L 300 350 L 300 220 L 250 200 L 200 220 L 150 200 L 120 350 L 130 300 L 140 250 Z" />
                                    </g>
                                    <path class="region-highlight west-africa-highlight"
                                        d="M 150 200 L 200 220 L 250 200 L 300 220 L 300 350 L 280 400 L 250 420 L 200 400 L 150 380 L 120 350 L 130 300 L 140 250 Z" />
                                </svg>
                            </div>
                        </div>

                        <div class="info-section">
                            <div class="region-header">
                                <h2>Economic Community of West African States</h2>
                                <span class="region-badge ecowas-badge">ECOWAS</span>
                            </div>

                            <div class="stats-overview">
                                <div class="stat-card">
                                    <i class="fa-solid fa-flag"></i>
                                    <div class="stat-info">
                                        <span class="stat-number">15</span>
                                        <span class="stat-label">Member States</span>
                                    </div>
                                </div>
                                <div class="stat-card">
                                    <i class="fa-solid fa-users"></i>
                                    <div class="stat-info">
                                        <span class="stat-number">400M</span>
                                        <span class="stat-label">Population</span>
                                    </div>
                                </div>
                                <div class="stat-card">
                                    <i class="fa-solid fa-chart-line"></i>
                                    <div class="stat-info">
                                        <span class="stat-number">$750B</span>
                                        <span class="stat-label">Combined GDP</span>
                                    </div>
                                </div>
                                <div class="stat-card">
                                    <i class="fa-solid fa-trophy"></i>
                                    <div class="stat-info">
                                        <span class="stat-number">65%</span>
                                        <span class="stat-label">Regional Progress</span>
                                    </div>
                                </div>
                            </div>

                            <div class="countries-list">
                                <h3>Member Countries</h3>
                                <div class="countries-grid">
                                    <div class="country-item"><i class="fa-solid fa-location-dot"></i> Benin</div>
                                    <div class="country-item"><i class="fa-solid fa-location-dot"></i> Burkina Faso</div>
                                    <div class="country-item"><i class="fa-solid fa-location-dot"></i> Cape Verde</div>
                                    <div class="country-item"><i class="fa-solid fa-location-dot"></i> Côte d'Ivoire</div>
                                    <div class="country-item"><i class="fa-solid fa-location-dot"></i> Gambia</div>
                                    <div class="country-item"><i class="fa-solid fa-location-dot"></i> Ghana</div>
                                    <div class="country-item"><i class="fa-solid fa-location-dot"></i> Guinea</div>
                                    <div class="country-item"><i class="fa-solid fa-location-dot"></i> Guinea-Bissau</div>
                                    <div class="country-item"><i class="fa-solid fa-location-dot"></i> Liberia</div>
                                    <div class="country-item"><i class="fa-solid fa-location-dot"></i> Mali</div>
                                    <div class="country-item"><i class="fa-solid fa-location-dot"></i> Niger</div>
                                    <div class="country-item"><i class="fa-solid fa-location-dot"></i> Nigeria</div>
                                    <div class="country-item"><i class="fa-solid fa-location-dot"></i> Senegal</div>
                                    <div class="country-item"><i class="fa-solid fa-location-dot"></i> Sierra Leone</div>
                                    <div class="country-item"><i class="fa-solid fa-location-dot"></i> Togo</div>
                                </div>
                            </div>

                            <div class="performance-metrics">
                                <h3>Key Performance Indicators</h3>
                                <div class="metric-item">
                                    <div class="metric-header">
                                        <span class="metric-name">Trade Integration</span>
                                        <span class="metric-value">72%</span>
                                    </div>
                                    <div class="metric-bar">
                                        <div class="metric-fill" style="width: 72%;"></div>
                                    </div>
                                </div>
                                <div class="metric-item">
                                    <div class="metric-header">
                                        <span class="metric-name">Free Movement Protocol</span>
                                        <span class="metric-value">68%</span>
                                    </div>
                                    <div class="metric-bar">
                                        <div class="metric-fill" style="width: 68%;"></div>
                                    </div>
                                </div>
                                <div class="metric-item">
                                    <div class="metric-header">
                                        <span class="metric-name">Infrastructure Connectivity</span>
                                        <span class="metric-value">58%</span>
                                    </div>
                                    <div class="metric-bar">
                                        <div class="metric-fill" style="width: 58%;"></div>
                                    </div>
                                </div>
                                <div class="metric-item">
                                    <div class="metric-header">
                                        <span class="metric-name">Peace & Stability</span>
                                        <span class="metric-value">64%</span>
                                    </div>
                                    <div class="metric-bar">
                                        <div class="metric-fill" style="width: 64%;"></div>
                                    </div>
                                </div>
                            </div>

                            <button class="view-details-btn">
                                <i class="fa-solid fa-arrow-right"></i> View Detailed Report
                            </button>
                        </div>
                    </div>

                    <div class="news-updates-section">
                        <h3><i class="fa-solid fa-newspaper"></i> ECOWAS Regional Updates</h3>
                        <div class="news-grid">
                            <div class="news-card">
                                <div class="news-date">March 12, 2024</div>
                                <h4>ECOWAS Single Currency Initiative Advances</h4>
                                <p>Member states make significant progress towards the implementation of the ECO currency
                                    with enhanced monetary cooperation...</p>
                                <a href="#" class="news-link">Read More <i class="fa-solid fa-arrow-right"></i></a>
                            </div>
                            <div class="news-card">
                                <div class="news-date">March 8, 2024</div>
                                <h4>Regional Infrastructure Projects Launched</h4>
                                <p>ECOWAS announces major highway and energy projects connecting Lagos, Accra, and Abidjan
                                    corridors...</p>
                                <a href="#" class="news-link">Read More <i class="fa-solid fa-arrow-right"></i></a>
                            </div>
                            <div class="news-card">
                                <div class="news-date">March 3, 2024</div>
                                <h4>Youth Employment Program Expands</h4>
                                <p>New regional initiative aims to create 5 million jobs for West African youth through
                                    skills development...</p>
                                <a href="#" class="news-link">Read More <i class="fa-solid fa-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ECCAS Panel -->
                <div class="regional-panel" data-panel="eccas">
                    <div class="panel-layout">
                        <div class="map-section">
                            <h3>ECCAS Region</h3>
                            <div class="africa-map-container">
                                <svg viewBox="0 0 800 900" class="africa-map">
                                    <g class="africa-outline">
                                        <path class="outline-path"
                                            d="M 150 100 L 650 100 L 680 150 L 650 200 L 600 220 L 550 200 L 500 220 L 520 280 L 520 350 L 520 400 L 520 480 L 500 550 L 480 600 L 450 650 L 420 700 L 400 750 L 380 780 L 350 750 L 320 700 L 300 650 L 280 600 L 270 550 L 280 500 L 280 450 L 280 400 L 280 350 L 300 350 L 300 220 L 250 200 L 200 220 L 150 200 L 120 350 L 130 300 L 140 250 Z" />
                                    </g>
                                    <path class="region-highlight central-africa-highlight"
                                        d="M 300 220 L 350 200 L 400 220 L 450 200 L 500 220 L 520 280 L 500 350 L 480 400 L 450 420 L 400 400 L 350 420 L 300 400 L 280 350 Z" />
                                </svg>
                            </div>
                        </div>

                        <div class="info-section">
                            <div class="region-header">
                                <h2>Economic Community of Central African States</h2>
                                <span class="region-badge eccas-badge">ECCAS</span>
                            </div>

                            <div class="stats-overview">
                                <div class="stat-card">
                                    <i class="fa-solid fa-flag"></i>
                                    <div class="stat-info">
                                        <span class="stat-number">11</span>
                                        <span class="stat-label">Member States</span>
                                    </div>
                                </div>
                                <div class="stat-card">
                                    <i class="fa-solid fa-users"></i>
                                    <div class="stat-info">
                                        <span class="stat-number">200M</span>
                                        <span class="stat-label">Population</span>
                                    </div>
                                </div>
                                <div class="stat-card">
                                    <i class="fa-solid fa-chart-line"></i>
                                    <div class="stat-info">
                                        <span class="stat-number">$280B</span>
                                        <span class="stat-label">Combined GDP</span>
                                    </div>
                                </div>
                                <div class="stat-card">
                                    <i class="fa-solid fa-trophy"></i>
                                    <div class="stat-info">
                                        <span class="stat-number">58%</span>
                                        <span class="stat-label">Regional Progress</span>
                                    </div>
                                </div>
                            </div>

                            <div class="countries-list">
                                <h3>Member Countries</h3>
                                <div class="countries-grid">
                                    <div class="country-item"><i class="fa-solid fa-location-dot"></i> Angola</div>
                                    <div class="country-item"><i class="fa-solid fa-location-dot"></i> Burundi</div>
                                    <div class="country-item"><i class="fa-solid fa-location-dot"></i> Cameroon</div>
                                    <div class="country-item"><i class="fa-solid fa-location-dot"></i> Central African
                                        Republic</div>
                                    <div class="country-item"><i class="fa-solid fa-location-dot"></i> Chad</div>
                                    <div class="country-item"><i class="fa-solid fa-location-dot"></i> Congo</div>
                                    <div class="country-item"><i class="fa-solid fa-location-dot"></i> DR Congo</div>
                                    <div class="country-item"><i class="fa-solid fa-location-dot"></i> Equatorial Guinea
                                    </div>
                                    <div class="country-item"><i class="fa-solid fa-location-dot"></i> Gabon</div>
                                    <div class="country-item"><i class="fa-solid fa-location-dot"></i> Rwanda</div>
                                    <div class="country-item"><i class="fa-solid fa-location-dot"></i> São Tomé and
                                        Príncipe</div>
                                </div>
                            </div>

                            <div class="performance-metrics">
                                <h3>Key Performance Indicators</h3>
                                <div class="metric-item">
                                    <div class="metric-header">
                                        <span class="metric-name">Regional Integration</span>
                                        <span class="metric-value">55%</span>
                                    </div>
                                    <div class="metric-bar">
                                        <div class="metric-fill" style="width: 55%;"></div>
                                    </div>
                                </div>
                                <div class="metric-item">
                                    <div class="metric-header">
                                        <span class="metric-name">Infrastructure Development</span>
                                        <span class="metric-value">52%</span>
                                    </div>
                                    <div class="metric-bar">
                                        <div class="metric-fill" style="width: 52%;"></div>
                                    </div>
                                </div>
                                <div class="metric-item">
                                    <div class="metric-header">
                                        <span class="metric-name">Peace & Security</span>
                                        <span class="metric-value">61%</span>
                                    </div>
                                    <div class="metric-bar">
                                        <div class="metric-fill" style="width: 61%;"></div>
                                    </div>
                                </div>
                                <div class="metric-item">
                                    <div class="metric-header">
                                        <span class="metric-name">Natural Resource Management</span>
                                        <span class="metric-value">64%</span>
                                    </div>
                                    <div class="metric-bar">
                                        <div class="metric-fill" style="width: 64%;"></div>
                                    </div>
                                </div>
                            </div>

                            <button class="view-details-btn">
                                <i class="fa-solid fa-arrow-right"></i> View Detailed Report
                            </button>
                        </div>
                    </div>

                    <div class="news-updates-section">
                        <h3><i class="fa-solid fa-newspaper"></i> ECCAS Regional Updates</h3>
                        <div class="news-grid">
                            <div class="news-card">
                                <div class="news-date">March 14, 2024</div>
                                <h4>Central African Transport Corridor Opens</h4>
                                <p>New highway connecting Cameroon, CAR, and DRC inaugurated, boosting regional trade and
                                    connectivity...</p>
                                <a href="#" class="news-link">Read More <i class="fa-solid fa-arrow-right"></i></a>
                            </div>
                            <div class="news-card">
                                <div class="news-date">March 9, 2024</div>
                                <h4>Peace and Security Framework Strengthened</h4>
                                <p>ECCAS member states adopt enhanced mechanisms for conflict prevention and resolution...
                                </p>
                                <a href="#" class="news-link">Read More <i class="fa-solid fa-arrow-right"></i></a>
                            </div>
                            <div class="news-card">
                                <div class="news-date">March 4, 2024</div>
                                <h4>Sustainable Forest Management Initiative</h4>
                                <p>Regional program launched to protect Congo Basin while promoting sustainable economic
                                    development...</p>
                                <a href="#" class="news-link">Read More <i class="fa-solid fa-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Additional panels for other regions would follow the same pattern -->
                <!-- COMESA, EAC, SADC, AMU, IGAD, CEN-SAD panels -->

                <!-- COMESA Panel (abbreviated for brevity) -->
                <div class="regional-panel" data-panel="comesa">
                    <div class="panel-layout">
                        <div class="map-section">
                            <h3>COMESA Region</h3>
                            <div class="africa-map-container">
                                <svg viewBox="0 0 800 900" class="africa-map">
                                    <g class="africa-outline">
                                        <path class="outline-path"
                                            d="M 150 100 L 650 100 L 680 150 L 650 200 L 600 220 L 550 200 L 500 220 L 520 280 L 520 350 L 520 400 L 520 480 L 500 550 L 480 600 L 450 650 L 420 700 L 400 750 L 380 780 L 350 750 L 320 700 L 300 650 L 280 600 L 270 550 L 280 500 L 280 450 L 280 400 L 280 350 L 300 350 L 300 220 L 250 200 L 200 220 L 150 200 L 120 350 L 130 300 L 140 250 Z" />
                                    </g>
                                    <path class="region-highlight east-africa-highlight"
                                        d="M 500 220 L 550 200 L 600 220 L 650 200 L 680 250 L 700 300 L 680 350 L 650 400 L 620 450 L 600 500 L 580 520 L 550 500 L 520 480 L 500 450 L 520 400 L 520 350 L 520 280 Z" />
                                    <path class="region-highlight southern-africa-highlight"
                                        d="M 300 400 L 350 420 L 400 400 L 450 420 L 480 400 L 500 450 L 520 480 L 500 550 L 480 600 L 450 650 L 420 700 L 400 750 L 380 780 L 350 750 L 320 700 L 300 650 L 280 600 L 270 550 L 280 500 L 280 450 Z" />
                                </svg>
                            </div>
                        </div>

                        <div class="info-section">
                            <div class="region-header">
                                <h2>Common Market for Eastern and Southern Africa</h2>
                                <span class="region-badge comesa-badge">COMESA</span>
                            </div>

                            <div class="stats-overview">
                                <div class="stat-card">
                                    <i class="fa-solid fa-flag"></i>
                                    <div class="stat-info">
                                        <span class="stat-number">21</span>
                                        <span class="stat-label">Member States</span>
                                    </div>
                                </div>
                                <div class="stat-card">
                                    <i class="fa-solid fa-users"></i>
                                    <div class="stat-info">
                                        <span class="stat-number">580M</span>
                                        <span class="stat-label">Population</span>
                                    </div>
                                </div>
                                <div class="stat-card">
                                    <i class="fa-solid fa-chart-line"></i>
                                    <div class="stat-info">
                                        <span class="stat-number">$850B</span>
                                        <span class="stat-label">Combined GDP</span>
                                    </div>
                                </div>
                                <div class="stat-card">
                                    <i class="fa-solid fa-trophy"></i>
                                    <div class="stat-info">
                                        <span class="stat-number">70%</span>
                                        <span class="stat-label">Regional Progress</span>
                                    </div>
                                </div>
                            </div>

                            <div class="countries-list">
                                <h3>Member Countries</h3>
                                <div class="countries-grid">
                                    <div class="country-item"><i class="fa-solid fa-location-dot"></i> Burundi</div>
                                    <div class="country-item"><i class="fa-solid fa-location-dot"></i> Comoros</div>
                                    <div class="country-item"><i class="fa-solid fa-location-dot"></i> DR Congo</div>
                                    <div class="country-item"><i class="fa-solid fa-location-dot"></i> Djibouti</div>
                                    <div class="country-item"><i class="fa-solid fa-location-dot"></i> Egypt</div>
                                    <div class="country-item"><i class="fa-solid fa-location-dot"></i> Eritrea</div>
                                    <div class="country-item"><i class="fa-solid fa-location-dot"></i> Eswatini</div>
                                    <div class="country-item"><i class="fa-solid fa-location-dot"></i> Ethiopia</div>
                                    <div class="country-item"><i class="fa-solid fa-location-dot"></i> Kenya</div>
                                    <div class="country-item"><i class="fa-solid fa-location-dot"></i> Libya</div>
                                    <div class="country-item"><i class="fa-solid fa-location-dot"></i> Madagascar</div>
                                    <div class="country-item"><i class="fa-solid fa-location-dot"></i> Malawi</div>
                                    <div class="country-item"><i class="fa-solid fa-location-dot"></i> Mauritius</div>
                                    <div class="country-item"><i class="fa-solid fa-location-dot"></i> Rwanda</div>
                                    <div class="country-item"><i class="fa-solid fa-location-dot"></i> Seychelles</div>
                                    <div class="country-item"><i class="fa-solid fa-location-dot"></i> Somalia</div>
                                    <div class="country-item"><i class="fa-solid fa-location-dot"></i> Sudan</div>
                                    <div class="country-item"><i class="fa-solid fa-location-dot"></i> Tunisia</div>
                                    <div class="country-item"><i class="fa-solid fa-location-dot"></i> Uganda</div>
                                    <div class="country-item"><i class="fa-solid fa-location-dot"></i> Zambia</div>
                                    <div class="country-item"><i class="fa-solid fa-location-dot"></i> Zimbabwe</div>
                                </div>
                            </div>

                            <div class="performance-metrics">
                                <h3>Key Performance Indicators</h3>
                                <div class="metric-item">
                                    <div class="metric-header">
                                        <span class="metric-name">Free Trade Area Implementation</span>
                                        <span class="metric-value">78%</span>
                                    </div>
                                    <div class="metric-bar">
                                        <div class="metric-fill" style="width: 78%;"></div>
                                    </div>
                                </div>
                                <div class="metric-item">
                                    <div class="metric-header">
                                        <span class="metric-name">Customs Union Progress</span>
                                        <span class="metric-value">65%</span>
                                    </div>
                                    <div class="metric-bar">
                                        <div class="metric-fill" style="width: 65%;"></div>
                                    </div>
                                </div>
                                <div class="metric-item">
                                    <div class="metric-header">
                                        <span class="metric-name">Infrastructure Connectivity</span>
                                        <span class="metric-value">68%</span>
                                    </div>
                                    <div class="metric-bar">
                                        <div class="metric-fill" style="width: 68%;"></div>
                                    </div>
                                </div>
                                <div class="metric-item">
                                    <div class="metric-header">
                                        <span class="metric-name">Trade Facilitation</span>
                                        <span class="metric-value">72%</span>
                                    </div>
                                    <div class="metric-bar">
                                        <div class="metric-fill" style="width: 72%;"></div>
                                    </div>
                                </div>
                            </div>

                            <button class="view-details-btn">
                                <i class="fa-solid fa-arrow-right"></i> View Detailed Report
                            </button>
                        </div>
                    </div>

                    <div class="news-updates-section">
                        <h3><i class="fa-solid fa-newspaper"></i> COMESA Regional Updates</h3>
                        <div class="news-grid">
                            <div class="news-card">
                                <div class="news-date">March 13, 2024</div>
                                <h4>COMESA Digital Free Trade Area Launched</h4>
                                <p>Revolutionary digital platform enables seamless cross-border e-commerce across 21 member
                                    states...</p>
                                <a href="#" class="news-link">Read More <i class="fa-solid fa-arrow-right"></i></a>
                            </div>
                            <div class="news-card">
                                <div class="news-date">March 7, 2024</div>
                                <h4>Regional Payment System Goes Live</h4>
                                <p>New payment infrastructure facilitates instant cross-border transactions in local
                                    currencies...</p>
                                <a href="#" class="news-link">Read More <i class="fa-solid fa-arrow-right"></i></a>
                            </div>
                            <div class="news-card">
                                <div class="news-date">March 2, 2024</div>
                                <h4>Agricultural Value Chain Initiative Expands</h4>
                                <p>COMESA launches comprehensive program to boost agricultural productivity and food
                                    security...</p>
                                <a href="#" class="news-link">Read More <i class="fa-solid fa-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Remaining panels (EAC, SADC, AMU, IGAD, CEN-SAD) would follow similar structure -->
                <!-- For brevity, I'll create simplified versions -->

                <div class="regional-panel" data-panel="eac">
                    <div class="panel-layout">
                        <div class="map-section">
                            <h3>EAC Region</h3>
                            <div class="africa-map-container">
                                <svg viewBox="0 0 800 900" class="africa-map">
                                    <g class="africa-outline">
                                        <path class="outline-path"
                                            d="M 150 100 L 650 100 L 680 150 L 650 200 L 600 220 L 550 200 L 500 220 L 520 280 L 520 350 L 520 400 L 520 480 L 500 550 L 480 600 L 450 650 L 420 700 L 400 750 L 380 780 L 350 750 L 320 700 L 300 650 L 280 600 L 270 550 L 280 500 L 280 450 L 280 400 L 280 350 L 300 350 L 300 220 L 250 200 L 200 220 L 150 200 L 120 350 L 130 300 L 140 250 Z" />
                                    </g>
                                    <path class="region-highlight east-africa-highlight"
                                        d="M 480 280 L 520 260 L 560 280 L 600 300 L 620 350 L 600 400 L 580 450 L 560 480 L 540 460 L 520 440 L 500 420 L 480 380 L 470 330 Z" />
                                </svg>
                            </div>
                        </div>

                        <div class="info-section">
                            <div class="region-header">
                                <h2>East African Community</h2>
                                <span class="region-badge eac-badge">EAC</span>
                            </div>

                            <div class="stats-overview">
                                <div class="stat-card">
                                    <i class="fa-solid fa-flag"></i>
                                    <div class="stat-info">
                                        <span class="stat-number">7</span>
                                        <span class="stat-label">Member States</span>
                                    </div>
                                </div>
                                <div class="stat-card">
                                    <i class="fa-solid fa-users"></i>
                                    <div class="stat-info">
                                        <span class="stat-number">300M</span>
                                        <span class="stat-label">Population</span>
                                    </div>
                                </div>
                                <div class="stat-card">
                                    <i class="fa-solid fa-chart-line"></i>
                                    <div class="stat-info">
                                        <span class="stat-number">$320B</span>
                                        <span class="stat-label">Combined GDP</span>
                                    </div>
                                </div>
                                <div class="stat-card">
                                    <i class="fa-solid fa-trophy"></i>
                                    <div class="stat-info">
                                        <span class="stat-number">75%</span>
                                        <span class="stat-label">Regional Progress</span>
                                    </div>
                                </div>
                            </div>

                            <div class="countries-list">
                                <h3>Member Countries</h3>
                                <div class="countries-grid">
                                    <div class="country-item"><i class="fa-solid fa-location-dot"></i> Burundi</div>
                                    <div class="country-item"><i class="fa-solid fa-location-dot"></i> DR Congo</div>
                                    <div class="country-item"><i class="fa-solid fa-location-dot"></i> Kenya</div>
                                    <div class="country-item"><i class="fa-solid fa-location-dot"></i> Rwanda</div>
                                    <div class="country-item"><i class="fa-solid fa-location-dot"></i> South Sudan</div>
                                    <div class="country-item"><i class="fa-solid fa-location-dot"></i> Tanzania</div>
                                    <div class="country-item"><i class="fa-solid fa-location-dot"></i> Uganda</div>
                                </div>
                            </div>

                            <button class="view-details-btn">
                                <i class="fa-solid fa-arrow-right"></i> View Detailed Report
                            </button>
                        </div>
                    </div>
                </div>

                <div class="regional-panel" data-panel="sadc">
                    <div class="panel-layout">
                        <div class="map-section">
                            <h3>SADC Region</h3>
                            <div class="africa-map-container">
                                <svg viewBox="0 0 800 900" class="africa-map">
                                    <g class="africa-outline">
                                        <path class="outline-path"
                                            d="M 150 100 L 650 100 L 680 150 L 650 200 L 600 220 L 550 200 L 500 220 L 520 280 L 520 350 L 520 400 L 520 480 L 500 550 L 480 600 L 450 650 L 420 700 L 400 750 L 380 780 L 350 750 L 320 700 L 300 650 L 280 600 L 270 550 L 280 500 L 280 450 L 280 400 L 280 350 L 300 350 L 300 220 L 250 200 L 200 220 L 150 200 L 120 350 L 130 300 L 140 250 Z" />
                                    </g>
                                    <path class="region-highlight southern-africa-highlight"
                                        d="M 300 400 L 350 420 L 400 400 L 450 420 L 480 400 L 500 450 L 520 480 L 500 550 L 480 600 L 450 650 L 420 700 L 400 750 L 380 780 L 350 750 L 320 700 L 300 650 L 280 600 L 270 550 L 280 500 L 280 450 Z" />
                                </svg>
                            </div>
                        </div>

                        <div class="info-section">
                            <div class="region-header">
                                <h2>Southern African Development Community</h2>
                                <span class="region-badge sadc-badge">SADC</span>
                            </div>

                            <div class="stats-overview">
                                <div class="stat-card">
                                    <i class="fa-solid fa-flag"></i>
                                    <div class="stat-info">
                                        <span class="stat-number">16</span>
                                        <span class="stat-label">Member States</span>
                                    </div>
                                </div>
                                <div class="stat-card">
                                    <i class="fa-solid fa-users"></i>
                                    <div class="stat-info">
                                        <span class="stat-number">360M</span>
                                        <span class="stat-label">Population</span>
                                    </div>
                                </div>
                                <div class="stat-card">
                                    <i class="fa-solid fa-chart-line"></i>
                                    <div class="stat-info">
                                        <span class="stat-number">$800B</span>
                                        <span class="stat-label">Combined GDP</span>
                                    </div>
                                </div>
                                <div class="stat-card">
                                    <i class="fa-solid fa-trophy"></i>
                                    <div class="stat-info">
                                        <span class="stat-number">68%</span>
                                        <span class="stat-label">Regional Progress</span>
                                    </div>
                                </div>
                            </div>

                            <div class="countries-list">
                                <h3>Member Countries</h3>
                                <div class="countries-grid">
                                    <div class="country-item"><i class="fa-solid fa-location-dot"></i> Angola</div>
                                    <div class="country-item"><i class="fa-solid fa-location-dot"></i> Botswana</div>
                                    <div class="country-item"><i class="fa-solid fa-location-dot"></i> Comoros</div>
                                    <div class="country-item"><i class="fa-solid fa-location-dot"></i> DR Congo</div>
                                    <div class="country-item"><i class="fa-solid fa-location-dot"></i> Eswatini</div>
                                    <div class="country-item"><i class="fa-solid fa-location-dot"></i> Lesotho</div>
                                    <div class="country-item"><i class="fa-solid fa-location-dot"></i> Madagascar</div>
                                    <div class="country-item"><i class="fa-solid fa-location-dot"></i> Malawi</div>
                                    <div class="country-item"><i class="fa-solid fa-location-dot"></i> Mauritius</div>
                                    <div class="country-item"><i class="fa-solid fa-location-dot"></i> Mozambique</div>
                                    <div class="country-item"><i class="fa-solid fa-location-dot"></i> Namibia</div>
                                    <div class="country-item"><i class="fa-solid fa-location-dot"></i> Seychelles</div>
                                    <div class="country-item"><i class="fa-solid fa-location-dot"></i> South Africa</div>
                                    <div class="country-item"><i class="fa-solid fa-location-dot"></i> Tanzania</div>
                                    <div class="country-item"><i class="fa-solid fa-location-dot"></i> Zambia</div>
                                    <div class="country-item"><i class="fa-solid fa-location-dot"></i> Zimbabwe</div>
                                </div>
                            </div>

                            <button class="view-details-btn">
                                <i class="fa-solid fa-arrow-right"></i> View Detailed Report
                            </button>
                        </div>
                    </div>
                </div>

                <!-- AMU, IGAD, CEN-SAD panels would follow similar structure -->
                <div class="regional-panel" data-panel="amu">
                    <div class="panel-layout">
                        <div class="map-section">
                            <h3>AMU Region</h3>
                            <div class="africa-map-container">
                                <svg viewBox="0 0 800 900" class="africa-map">
                                    <g class="africa-outline">
                                        <path class="outline-path"
                                            d="M 150 100 L 650 100 L 680 150 L 650 200 L 600 220 L 550 200 L 500 220 L 520 280 L 520 350 L 520 400 L 520 480 L 500 550 L 480 600 L 450 650 L 420 700 L 400 750 L 380 780 L 350 750 L 320 700 L 300 650 L 280 600 L 270 550 L 280 500 L 280 450 L 280 400 L 280 350 L 300 350 L 300 220 L 250 200 L 200 220 L 150 200 L 120 350 L 130 300 L 140 250 Z" />
                                    </g>
                                    <path class="region-highlight north-africa-highlight"
                                        d="M 150 100 L 650 100 L 680 150 L 650 200 L 600 220 L 550 200 L 500 220 L 450 200 L 400 220 L 350 200 L 300 220 L 250 200 L 200 220 L 150 200 Z" />
                                </svg>
                            </div>
                        </div>

                        <div class="info-section">
                            <div class="region-header">
                                <h2>Arab Maghreb Union</h2>
                                <span class="region-badge amu-badge">AMU</span>
                            </div>

                            <div class="stats-overview">
                                <div class="stat-card">
                                    <i class="fa-solid fa-flag"></i>
                                    <div class="stat-info">
                                        <span class="stat-number">5</span>
                                        <span class="stat-label">Member States</span>
                                    </div>
                                </div>
                                <div class="stat-card">
                                    <i class="fa-solid fa-users"></i>
                                    <div class="stat-info">
                                        <span class="stat-number">100M</span>
                                        <span class="stat-label">Population</span>
                                    </div>
                                </div>
                                <div class="stat-card">
                                    <i class="fa-solid fa-chart-line"></i>
                                    <div class="stat-info">
                                        <span class="stat-number">$450B</span>
                                        <span class="stat-label">Combined GDP</span>
                                    </div>
                                </div>
                                <div class="stat-card">
                                    <i class="fa-solid fa-trophy"></i>
                                    <div class="stat-info">
                                        <span class="stat-number">60%</span>
                                        <span class="stat-label">Regional Progress</span>
                                    </div>
                                </div>
                            </div>

                            <div class="countries-list">
                                <h3>Member Countries</h3>
                                <div class="countries-grid">
                                    <div class="country-item"><i class="fa-solid fa-location-dot"></i> Algeria</div>
                                    <div class="country-item"><i class="fa-solid fa-location-dot"></i> Libya</div>
                                    <div class="country-item"><i class="fa-solid fa-location-dot"></i> Mauritania</div>
                                    <div class="country-item"><i class="fa-solid fa-location-dot"></i> Morocco</div>
                                    <div class="country-item"><i class="fa-solid fa-location-dot"></i> Tunisia</div>
                                </div>
                            </div>

                            <button class="view-details-btn">
                                <i class="fa-solid fa-arrow-right"></i> View Detailed Report
                            </button>
                        </div>
                    </div>
                </div>

                <div class="regional-panel" data-panel="igad">
                    <div class="panel-layout">
                        <div class="map-section">
                            <h3>IGAD Region</h3>
                            <div class="africa-map-container">
                                <svg viewBox="0 0 800 900" class="africa-map">
                                    <g class="africa-outline">
                                        <path class="outline-path"
                                            d="M 150 100 L 650 100 L 680 150 L 650 200 L 600 220 L 550 200 L 500 220 L 520 280 L 520 350 L 520 400 L 520 480 L 500 550 L 480 600 L 450 650 L 420 700 L 400 750 L 380 780 L 350 750 L 320 700 L 300 650 L 280 600 L 270 550 L 280 500 L 280 450 L 280 400 L 280 350 L 300 350 L 300 220 L 250 200 L 200 220 L 150 200 L 120 350 L 130 300 L 140 250 Z" />
                                    </g>
                                    <path class="region-highlight east-africa-highlight"
                                        d="M 520 200 L 580 180 L 640 200 L 680 240 L 700 290 L 680 340 L 650 380 L 620 410 L 590 430 L 560 410 L 540 380 L 530 340 L 520 290 Z" />
                                </svg>
                            </div>
                        </div>

                        <div class="info-section">
                            <div class="region-header">
                                <h2>Intergovernmental Authority on Development</h2>
                                <span class="region-badge igad-badge">IGAD</span>
                            </div>

                            <div class="stats-overview">
                                <div class="stat-card">
                                    <i class="fa-solid fa-flag"></i>
                                    <div class="stat-info">
                                        <span class="stat-number">8</span>
                                        <span class="stat-label">Member States</span>
                                    </div>
                                </div>
                                <div class="stat-card">
                                    <i class="fa-solid fa-users"></i>
                                    <div class="stat-info">
                                        <span class="stat-number">280M</span>
                                        <span class="stat-label">Population</span>
                                    </div>
                                </div>
                                <div class="stat-card">
                                    <i class="fa-solid fa-chart-line"></i>
                                    <div class="stat-info">
                                        <span class="stat-number">$380B</span>
                                        <span class="stat-label">Combined GDP</span>
                                    </div>
                                </div>
                                <div class="stat-card">
                                    <i class="fa-solid fa-trophy"></i>
                                    <div class="stat-info">
                                        <span class="stat-number">63%</span>
                                        <span class="stat-label">Regional Progress</span>
                                    </div>
                                </div>
                            </div>

                            <div class="countries-list">
                                <h3>Member Countries</h3>
                                <div class="countries-grid">
                                    <div class="country-item"><i class="fa-solid fa-location-dot"></i> Djibouti</div>
                                    <div class="country-item"><i class="fa-solid fa-location-dot"></i> Eritrea</div>
                                    <div class="country-item"><i class="fa-solid fa-location-dot"></i> Ethiopia</div>
                                    <div class="country-item"><i class="fa-solid fa-location-dot"></i> Kenya</div>
                                    <div class="country-item"><i class="fa-solid fa-location-dot"></i> Somalia</div>
                                    <div class="country-item"><i class="fa-solid fa-location-dot"></i> South Sudan</div>
                                    <div class="country-item"><i class="fa-solid fa-location-dot"></i> Sudan</div>
                                    <div class="country-item"><i class="fa-solid fa-location-dot"></i> Uganda</div>
                                </div>
                            </div>

                            <button class="view-details-btn">
                                <i class="fa-solid fa-arrow-right"></i> View Detailed Report
                            </button>
                        </div>
                    </div>
                </div>

                <div class="regional-panel" data-panel="censad">
                    <div class="panel-layout">
                        <div class="map-section">
                            <h3>CEN-SAD Region</h3>
                            <div class="africa-map-container">
                                <svg viewBox="0 0 800 900" class="africa-map">
                                    <g class="africa-outline">
                                        <path class="outline-path"
                                            d="M 150 100 L 650 100 L 680 150 L 650 200 L 600 220 L 550 200 L 500 220 L 520 280 L 520 350 L 520 400 L 520 480 L 500 550 L 480 600 L 450 650 L 420 700 L 400 750 L 380 780 L 350 750 L 320 700 L 300 650 L 280 600 L 270 550 L 280 500 L 280 450 L 280 400 L 280 350 L 300 350 L 300 220 L 250 200 L 200 220 L 150 200 L 120 350 L 130 300 L 140 250 Z" />
                                    </g>
                                    <path class="region-highlight north-africa-highlight"
                                        d="M 150 100 L 650 100 L 680 150 L 650 200 L 600 220 L 550 200 L 500 220 L 450 200 L 400 220 L 350 200 L 300 220 L 250 200 L 200 220 L 150 200 Z" />
                                    <path class="region-highlight west-africa-highlight"
                                        d="M 150 200 L 200 220 L 250 200 L 300 220 L 300 350 L 280 400 L 250 420 L 200 400 L 150 380 L 120 350 L 130 300 L 140 250 Z" />
                                </svg>
                            </div>
                        </div>

                        <div class="info-section">
                            <div class="region-header">
                                <h2>Community of Sahel-Saharan States</h2>
                                <span class="region-badge censad-badge">CEN-SAD</span>
                            </div>

                            <div class="stats-overview">
                                <div class="stat-card">
                                    <i class="fa-solid fa-flag"></i>
                                    <div class="stat-info">
                                        <span class="stat-number">28</span>
                                        <span class="stat-label">Member States</span>
                                    </div>
                                </div>
                                <div class="stat-card">
                                    <i class="fa-solid fa-users"></i>
                                    <div class="stat-info">
                                        <span class="stat-number">550M</span>
                                        <span class="stat-label">Population</span>
                                    </div>
                                </div>
                                <div class="stat-card">
                                    <i class="fa-solid fa-chart-line"></i>
                                    <div class="stat-info">
                                        <span class="stat-number">$1.2T</span>
                                        <span class="stat-label">Combined GDP</span>
                                    </div>
                                </div>
                                <div class="stat-card">
                                    <i class="fa-solid fa-trophy"></i>
                                    <div class="stat-info">
                                        <span class="stat-number">57%</span>
                                        <span class="stat-label">Regional Progress</span>
                                    </div>
                                </div>
                            </div>

                            <div class="countries-list">
                                <h3>Member Countries (Selected)</h3>
                                <div class="countries-grid">
                                    <div class="country-item"><i class="fa-solid fa-location-dot"></i> Benin</div>
                                    <div class="country-item"><i class="fa-solid fa-location-dot"></i> Burkina Faso</div>
                                    <div class="country-item"><i class="fa-solid fa-location-dot"></i> Chad</div>
                                    <div class="country-item"><i class="fa-solid fa-location-dot"></i> Djibouti</div>
                                    <div class="country-item"><i class="fa-solid fa-location-dot"></i> Egypt</div>
                                    <div class="country-item"><i class="fa-solid fa-location-dot"></i> Eritrea</div>
                                    <div class="country-item"><i class="fa-solid fa-location-dot"></i> Gambia</div>
                                    <div class="country-item"><i class="fa-solid fa-location-dot"></i> Ghana</div>
                                    <div class="country-item"><i class="fa-solid fa-location-dot"></i> Libya</div>
                                    <div class="country-item"><i class="fa-solid fa-location-dot"></i> Mali</div>
                                    <div class="country-item"><i class="fa-solid fa-location-dot"></i> Mauritania</div>
                                    <div class="country-item"><i class="fa-solid fa-location-dot"></i> Morocco</div>
                                    <div class="country-item"><i class="fa-solid fa-location-dot"></i> Niger</div>
                                    <div class="country-item"><i class="fa-solid fa-location-dot"></i> Nigeria</div>
                                    <div class="country-item"><i class="fa-solid fa-location-dot"></i> Senegal</div>
                                    <div class="country-item"><i class="fa-solid fa-location-dot"></i> Somalia</div>
                                    <div class="country-item"><i class="fa-solid fa-location-dot"></i> Sudan</div>
                                    <div class="country-item"><i class="fa-solid fa-location-dot"></i> Tunisia</div>
                                </div>
                            </div>

                            <button class="view-details-btn">
                                <i class="fa-solid fa-arrow-right"></i> View Detailed Report
                            </button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

@endsection

@push('scripts')
    <script src="{{ asset('js/performance.js') }}"></script>
@endpush
