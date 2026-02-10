@extends('layouts.public')

@section('title', 'Knowledge Base - Agenda 2063')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/knowledge-base.css') }}">
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
                    <span>Knowledge Base</span>
                </li>
            </ol>
        </div>
    </nav>

    <!-- Page Hero Banner -->
    <section class="page-hero" id="pageHero">
        <div class="page-hero-bg active" style="background-image: url('https://agenda2063.africa/assets/banner1.jpeg');"></div>
        <div class="page-hero-bg" style="background-image: url('https://agenda2063.africa/assets/news4.png');"></div>
        <div class="page-hero-bg" style="background-image: url('https://agenda2063.africa/assets/Aspiration1.png');"></div>
        <div class="page-hero-bg" style="background-image: url('https://agenda2063.africa/assets/Aspiration3.png');"></div>
        <div class="page-hero-content">
            <span class="hero-label">Resource Library</span>
            <h1>Knowledge Base</h1>
            <div class="hero-divider"></div>
            <p>Access reports, frameworks, policy documents and publications driving Africa's transformation</p>
        </div>
    </section>

    <!-- Knowledge Base Content -->
    <section class="kb-content">
        <div class="kb-wrapper">

            <!-- Search & Filter Bar -->
            <div class="kb-toolbar">
                <div class="kb-search">
                    <i class="fa-solid fa-search"></i>
                    <input type="text" id="kbSearch" placeholder="Search documents, reports, frameworks...">
                </div>
                <div class="kb-view-toggle">
                    <button class="view-btn active" data-view="grid" title="Grid View">
                        <i class="fa-solid fa-grip"></i>
                    </button>
                    <button class="view-btn" data-view="list" title="List View">
                        <i class="fa-solid fa-list"></i>
                    </button>
                </div>
            </div>

            <!-- Category Navigation -->
            <div class="kb-category-nav">
                <button class="kb-cat-btn active" data-category="all">
                    <i class="fa-solid fa-layer-group"></i>
                    <span>All Resources</span>
                </button>
                <button class="kb-cat-btn" data-category="strategic-frameworks">
                    <i class="fa-solid fa-sitemap"></i>
                    <span>Strategic Frameworks</span>
                </button>
                <button class="kb-cat-btn" data-category="implementation-plans">
                    <i class="fa-solid fa-list-check"></i>
                    <span>Implementation Plans</span>
                </button>
                <button class="kb-cat-btn" data-category="progress-reports">
                    <i class="fa-solid fa-chart-line"></i>
                    <span>Progress Reports</span>
                </button>
                <button class="kb-cat-btn" data-category="flagship-projects">
                    <i class="fa-solid fa-rocket"></i>
                    <span>Flagship Projects</span>
                </button>
                <button class="kb-cat-btn" data-category="governance">
                    <i class="fa-solid fa-landmark"></i>
                    <span>Governance & Policy</span>
                </button>
                <button class="kb-cat-btn" data-category="peace-security">
                    <i class="fa-solid fa-shield-halved"></i>
                    <span>Peace & Security</span>
                </button>
                <button class="kb-cat-btn" data-category="economic-development">
                    <i class="fa-solid fa-coins"></i>
                    <span>Economic Development</span>
                </button>
                <button class="kb-cat-btn" data-category="social-development">
                    <i class="fa-solid fa-people-group"></i>
                    <span>Social Development</span>
                </button>
                <button class="kb-cat-btn" data-category="science-technology">
                    <i class="fa-solid fa-microchip"></i>
                    <span>Science & Technology</span>
                </button>
                <button class="kb-cat-btn" data-category="environment-climate">
                    <i class="fa-solid fa-leaf"></i>
                    <span>Environment & Climate</span>
                </button>
                <button class="kb-cat-btn" data-category="regional-integration">
                    <i class="fa-solid fa-globe-africa"></i>
                    <span>Regional Integration</span>
                </button>
            </div>

            <!-- Catalogues -->
            <div class="kb-catalogues" id="kbCatalogues">

                <!-- 1. Strategic Frameworks -->
                <div class="kb-catalogue" data-category="strategic-frameworks">
                    <div class="catalogue-header">
                        <div class="catalogue-icon">
                            <i class="fa-solid fa-sitemap"></i>
                        </div>
                        <div class="catalogue-info">
                            <h2>Strategic Frameworks</h2>
                            <p>Core documents outlining the vision, aspirations, and strategic direction of Agenda 2063</p>
                        </div>
                        <span class="catalogue-count">5 Documents</span>
                    </div>
                    <div class="catalogue-items">
                        <div class="doc-card" data-type="pdf">
                            <div class="doc-icon pdf"><i class="fa-solid fa-file-pdf"></i></div>
                            <div class="doc-details">
                                <h4>Agenda 2063: The Africa We Want</h4>
                                <p>The comprehensive framework document outlining Africa's 50-year development blueprint</p>
                                <div class="doc-meta">
                                    <span><i class="fa-solid fa-calendar"></i> 2015</span>
                                    <span><i class="fa-solid fa-file"></i> PDF</span>
                                    <span><i class="fa-solid fa-weight-hanging"></i> 4.2 MB</span>
                                </div>
                            </div>
                            <a href="#" class="doc-download" title="Download"><i class="fa-solid fa-download"></i></a>
                        </div>
                        <div class="doc-card" data-type="pdf">
                            <div class="doc-icon pdf"><i class="fa-solid fa-file-pdf"></i></div>
                            <div class="doc-details">
                                <h4>Agenda 2063 Popular Version</h4>
                                <p>A simplified version of the Agenda 2063 framework for wider public consumption</p>
                                <div class="doc-meta">
                                    <span><i class="fa-solid fa-calendar"></i> 2015</span>
                                    <span><i class="fa-solid fa-file"></i> PDF</span>
                                    <span><i class="fa-solid fa-weight-hanging"></i> 2.8 MB</span>
                                </div>
                            </div>
                            <a href="#" class="doc-download" title="Download"><i class="fa-solid fa-download"></i></a>
                        </div>
                        <div class="doc-card" data-type="pdf">
                            <div class="doc-icon pdf"><i class="fa-solid fa-file-pdf"></i></div>
                            <div class="doc-details">
                                <h4>The Seven Aspirations of Agenda 2063</h4>
                                <p>Detailed breakdown of the seven aspirations guiding Africa's transformation journey</p>
                                <div class="doc-meta">
                                    <span><i class="fa-solid fa-calendar"></i> 2015</span>
                                    <span><i class="fa-solid fa-file"></i> PDF</span>
                                    <span><i class="fa-solid fa-weight-hanging"></i> 1.5 MB</span>
                                </div>
                            </div>
                            <a href="#" class="doc-download" title="Download"><i class="fa-solid fa-download"></i></a>
                        </div>
                        <div class="doc-card" data-type="doc">
                            <div class="doc-icon doc"><i class="fa-solid fa-file-word"></i></div>
                            <div class="doc-details">
                                <h4>50th Anniversary Solemn Declaration</h4>
                                <p>The declaration signed by AU Heads of State committing to Africa's renewal</p>
                                <div class="doc-meta">
                                    <span><i class="fa-solid fa-calendar"></i> 2013</span>
                                    <span><i class="fa-solid fa-file"></i> DOCX</span>
                                    <span><i class="fa-solid fa-weight-hanging"></i> 850 KB</span>
                                </div>
                            </div>
                            <a href="#" class="doc-download" title="Download"><i class="fa-solid fa-download"></i></a>
                        </div>
                        <div class="doc-card" data-type="pdf">
                            <div class="doc-icon pdf"><i class="fa-solid fa-file-pdf"></i></div>
                            <div class="doc-details">
                                <h4>Agenda 2063 Results Framework</h4>
                                <p>Goals, priority areas, targets and indicators for measuring continental progress</p>
                                <div class="doc-meta">
                                    <span><i class="fa-solid fa-calendar"></i> 2016</span>
                                    <span><i class="fa-solid fa-file"></i> PDF</span>
                                    <span><i class="fa-solid fa-weight-hanging"></i> 3.1 MB</span>
                                </div>
                            </div>
                            <a href="#" class="doc-download" title="Download"><i class="fa-solid fa-download"></i></a>
                        </div>
                    </div>
                </div>

                <!-- 2. Implementation Plans -->
                <div class="kb-catalogue" data-category="implementation-plans">
                    <div class="catalogue-header">
                        <div class="catalogue-icon">
                            <i class="fa-solid fa-list-check"></i>
                        </div>
                        <div class="catalogue-info">
                            <h2>Implementation Plans</h2>
                            <p>Ten-year implementation plans with targets, milestones and accountability frameworks</p>
                        </div>
                        <span class="catalogue-count">4 Documents</span>
                    </div>
                    <div class="catalogue-items">
                        <div class="doc-card" data-type="pdf">
                            <div class="doc-icon pdf"><i class="fa-solid fa-file-pdf"></i></div>
                            <div class="doc-details">
                                <h4>First Ten-Year Implementation Plan (2014-2023)</h4>
                                <p>Strategic priorities, flagship projects and key milestones for the first decade</p>
                                <div class="doc-meta">
                                    <span><i class="fa-solid fa-calendar"></i> 2015</span>
                                    <span><i class="fa-solid fa-file"></i> PDF</span>
                                    <span><i class="fa-solid fa-weight-hanging"></i> 5.6 MB</span>
                                </div>
                            </div>
                            <a href="#" class="doc-download" title="Download"><i class="fa-solid fa-download"></i></a>
                        </div>
                        <div class="doc-card" data-type="pdf">
                            <div class="doc-icon pdf"><i class="fa-solid fa-file-pdf"></i></div>
                            <div class="doc-details">
                                <h4>Second Ten-Year Implementation Plan (2024-2033)</h4>
                                <p>Accelerated implementation priorities building on lessons from the first decade</p>
                                <div class="doc-meta">
                                    <span><i class="fa-solid fa-calendar"></i> 2024</span>
                                    <span><i class="fa-solid fa-file"></i> PDF</span>
                                    <span><i class="fa-solid fa-weight-hanging"></i> 6.3 MB</span>
                                </div>
                            </div>
                            <a href="#" class="doc-download" title="Download"><i class="fa-solid fa-download"></i></a>
                        </div>
                        <div class="doc-card" data-type="doc">
                            <div class="doc-icon doc"><i class="fa-solid fa-file-word"></i></div>
                            <div class="doc-details">
                                <h4>National Implementation Guidelines</h4>
                                <p>Guidelines for domesticating Agenda 2063 into national development plans</p>
                                <div class="doc-meta">
                                    <span><i class="fa-solid fa-calendar"></i> 2019</span>
                                    <span><i class="fa-solid fa-file"></i> DOCX</span>
                                    <span><i class="fa-solid fa-weight-hanging"></i> 1.9 MB</span>
                                </div>
                            </div>
                            <a href="#" class="doc-download" title="Download"><i class="fa-solid fa-download"></i></a>
                        </div>
                        <div class="doc-card" data-type="pdf">
                            <div class="doc-icon pdf"><i class="fa-solid fa-file-pdf"></i></div>
                            <div class="doc-details">
                                <h4>Monitoring & Evaluation Framework</h4>
                                <p>Continental M&E framework for tracking implementation across member states</p>
                                <div class="doc-meta">
                                    <span><i class="fa-solid fa-calendar"></i> 2020</span>
                                    <span><i class="fa-solid fa-file"></i> PDF</span>
                                    <span><i class="fa-solid fa-weight-hanging"></i> 2.4 MB</span>
                                </div>
                            </div>
                            <a href="#" class="doc-download" title="Download"><i class="fa-solid fa-download"></i></a>
                        </div>
                    </div>
                </div>

                <!-- 3. Progress Reports -->
                <div class="kb-catalogue" data-category="progress-reports">
                    <div class="catalogue-header">
                        <div class="catalogue-icon">
                            <i class="fa-solid fa-chart-line"></i>
                        </div>
                        <div class="catalogue-info">
                            <h2>Progress Reports</h2>
                            <p>Biennial and annual reports assessing continental progress towards Agenda 2063 goals</p>
                        </div>
                        <span class="catalogue-count">5 Documents</span>
                    </div>
                    <div class="catalogue-items">
                        <div class="doc-card" data-type="pdf">
                            <div class="doc-icon pdf"><i class="fa-solid fa-file-pdf"></i></div>
                            <div class="doc-details">
                                <h4>First Continental Report on Agenda 2063</h4>
                                <p>Inaugural progress report covering the initial years of implementation across Africa</p>
                                <div class="doc-meta">
                                    <span><i class="fa-solid fa-calendar"></i> 2020</span>
                                    <span><i class="fa-solid fa-file"></i> PDF</span>
                                    <span><i class="fa-solid fa-weight-hanging"></i> 8.7 MB</span>
                                </div>
                            </div>
                            <a href="#" class="doc-download" title="Download"><i class="fa-solid fa-download"></i></a>
                        </div>
                        <div class="doc-card" data-type="pdf">
                            <div class="doc-icon pdf"><i class="fa-solid fa-file-pdf"></i></div>
                            <div class="doc-details">
                                <h4>Second Continental Progress Report</h4>
                                <p>Mid-term assessment of the first ten-year plan with regional performance analysis</p>
                                <div class="doc-meta">
                                    <span><i class="fa-solid fa-calendar"></i> 2022</span>
                                    <span><i class="fa-solid fa-file"></i> PDF</span>
                                    <span><i class="fa-solid fa-weight-hanging"></i> 9.2 MB</span>
                                </div>
                            </div>
                            <a href="#" class="doc-download" title="Download"><i class="fa-solid fa-download"></i></a>
                        </div>
                        <div class="doc-card" data-type="pdf">
                            <div class="doc-icon pdf"><i class="fa-solid fa-file-pdf"></i></div>
                            <div class="doc-details">
                                <h4>End-of-Decade Review Report (2014-2023)</h4>
                                <p>Comprehensive review of achievements, challenges and lessons from the first decade</p>
                                <div class="doc-meta">
                                    <span><i class="fa-solid fa-calendar"></i> 2024</span>
                                    <span><i class="fa-solid fa-file"></i> PDF</span>
                                    <span><i class="fa-solid fa-weight-hanging"></i> 12.1 MB</span>
                                </div>
                            </div>
                            <a href="#" class="doc-download" title="Download"><i class="fa-solid fa-download"></i></a>
                        </div>
                        <div class="doc-card" data-type="pdf">
                            <div class="doc-icon pdf"><i class="fa-solid fa-file-pdf"></i></div>
                            <div class="doc-details">
                                <h4>SDGs and Agenda 2063 Convergence Report</h4>
                                <p>Analysis of alignment between the UN Sustainable Development Goals and Agenda 2063</p>
                                <div class="doc-meta">
                                    <span><i class="fa-solid fa-calendar"></i> 2021</span>
                                    <span><i class="fa-solid fa-file"></i> PDF</span>
                                    <span><i class="fa-solid fa-weight-hanging"></i> 3.5 MB</span>
                                </div>
                            </div>
                            <a href="#" class="doc-download" title="Download"><i class="fa-solid fa-download"></i></a>
                        </div>
                        <div class="doc-card" data-type="doc">
                            <div class="doc-icon doc"><i class="fa-solid fa-file-word"></i></div>
                            <div class="doc-details">
                                <h4>Member States Self-Assessment Template</h4>
                                <p>Standardised template for national self-assessment reporting on Agenda 2063 targets</p>
                                <div class="doc-meta">
                                    <span><i class="fa-solid fa-calendar"></i> 2023</span>
                                    <span><i class="fa-solid fa-file"></i> DOCX</span>
                                    <span><i class="fa-solid fa-weight-hanging"></i> 620 KB</span>
                                </div>
                            </div>
                            <a href="#" class="doc-download" title="Download"><i class="fa-solid fa-download"></i></a>
                        </div>
                    </div>
                </div>

                <!-- 4. Flagship Projects -->
                <div class="kb-catalogue" data-category="flagship-projects">
                    <div class="catalogue-header">
                        <div class="catalogue-icon">
                            <i class="fa-solid fa-rocket"></i>
                        </div>
                        <div class="catalogue-info">
                            <h2>Flagship Projects</h2>
                            <p>Documentation on Africa's transformative flagship initiatives and their progress</p>
                        </div>
                        <span class="catalogue-count">4 Documents</span>
                    </div>
                    <div class="catalogue-items">
                        <div class="doc-card" data-type="pdf">
                            <div class="doc-icon pdf"><i class="fa-solid fa-file-pdf"></i></div>
                            <div class="doc-details">
                                <h4>African Continental Free Trade Area (AfCFTA) Guide</h4>
                                <p>Comprehensive guide to the AfCFTA agreement, protocols and implementation roadmap</p>
                                <div class="doc-meta">
                                    <span><i class="fa-solid fa-calendar"></i> 2021</span>
                                    <span><i class="fa-solid fa-file"></i> PDF</span>
                                    <span><i class="fa-solid fa-weight-hanging"></i> 5.4 MB</span>
                                </div>
                            </div>
                            <a href="#" class="doc-download" title="Download"><i class="fa-solid fa-download"></i></a>
                        </div>
                        <div class="doc-card" data-type="pdf">
                            <div class="doc-icon pdf"><i class="fa-solid fa-file-pdf"></i></div>
                            <div class="doc-details">
                                <h4>Single African Air Transport Market (SAATM)</h4>
                                <p>Framework for liberalising civil aviation and creating a unified African air market</p>
                                <div class="doc-meta">
                                    <span><i class="fa-solid fa-calendar"></i> 2018</span>
                                    <span><i class="fa-solid fa-file"></i> PDF</span>
                                    <span><i class="fa-solid fa-weight-hanging"></i> 2.1 MB</span>
                                </div>
                            </div>
                            <a href="#" class="doc-download" title="Download"><i class="fa-solid fa-download"></i></a>
                        </div>
                        <div class="doc-card" data-type="pdf">
                            <div class="doc-icon pdf"><i class="fa-solid fa-file-pdf"></i></div>
                            <div class="doc-details">
                                <h4>Integrated High-Speed Train Network Masterplan</h4>
                                <p>Continental rail connectivity masterplan linking all African capitals and commercial centres</p>
                                <div class="doc-meta">
                                    <span><i class="fa-solid fa-calendar"></i> 2019</span>
                                    <span><i class="fa-solid fa-file"></i> PDF</span>
                                    <span><i class="fa-solid fa-weight-hanging"></i> 7.8 MB</span>
                                </div>
                            </div>
                            <a href="#" class="doc-download" title="Download"><i class="fa-solid fa-download"></i></a>
                        </div>
                        <div class="doc-card" data-type="doc">
                            <div class="doc-icon doc"><i class="fa-solid fa-file-word"></i></div>
                            <div class="doc-details">
                                <h4>Pan-African E-Network & Virtual University</h4>
                                <p>Digital connectivity and e-learning flagship project framework and status report</p>
                                <div class="doc-meta">
                                    <span><i class="fa-solid fa-calendar"></i> 2020</span>
                                    <span><i class="fa-solid fa-file"></i> DOCX</span>
                                    <span><i class="fa-solid fa-weight-hanging"></i> 1.6 MB</span>
                                </div>
                            </div>
                            <a href="#" class="doc-download" title="Download"><i class="fa-solid fa-download"></i></a>
                        </div>
                    </div>
                </div>

                <!-- 5. Governance & Policy -->
                <div class="kb-catalogue" data-category="governance">
                    <div class="catalogue-header">
                        <div class="catalogue-icon">
                            <i class="fa-solid fa-landmark"></i>
                        </div>
                        <div class="catalogue-info">
                            <h2>Governance & Policy</h2>
                            <p>Frameworks for democratic governance, human rights and institutional reform across Africa</p>
                        </div>
                        <span class="catalogue-count">4 Documents</span>
                    </div>
                    <div class="catalogue-items">
                        <div class="doc-card" data-type="pdf">
                            <div class="doc-icon pdf"><i class="fa-solid fa-file-pdf"></i></div>
                            <div class="doc-details">
                                <h4>African Governance Architecture (AGA) Framework</h4>
                                <p>Continental framework promoting democratic governance, human rights and rule of law</p>
                                <div class="doc-meta">
                                    <span><i class="fa-solid fa-calendar"></i> 2017</span>
                                    <span><i class="fa-solid fa-file"></i> PDF</span>
                                    <span><i class="fa-solid fa-weight-hanging"></i> 3.2 MB</span>
                                </div>
                            </div>
                            <a href="#" class="doc-download" title="Download"><i class="fa-solid fa-download"></i></a>
                        </div>
                        <div class="doc-card" data-type="pdf">
                            <div class="doc-icon pdf"><i class="fa-solid fa-file-pdf"></i></div>
                            <div class="doc-details">
                                <h4>African Charter on Democracy, Elections & Governance</h4>
                                <p>The binding charter on democratic principles, elections and constitutional governance</p>
                                <div class="doc-meta">
                                    <span><i class="fa-solid fa-calendar"></i> 2012</span>
                                    <span><i class="fa-solid fa-file"></i> PDF</span>
                                    <span><i class="fa-solid fa-weight-hanging"></i> 1.1 MB</span>
                                </div>
                            </div>
                            <a href="#" class="doc-download" title="Download"><i class="fa-solid fa-download"></i></a>
                        </div>
                        <div class="doc-card" data-type="doc">
                            <div class="doc-icon doc"><i class="fa-solid fa-file-word"></i></div>
                            <div class="doc-details">
                                <h4>AU Institutional Reform Report</h4>
                                <p>Report on the reform of African Union institutions for improved efficiency and delivery</p>
                                <div class="doc-meta">
                                    <span><i class="fa-solid fa-calendar"></i> 2021</span>
                                    <span><i class="fa-solid fa-file"></i> DOCX</span>
                                    <span><i class="fa-solid fa-weight-hanging"></i> 2.0 MB</span>
                                </div>
                            </div>
                            <a href="#" class="doc-download" title="Download"><i class="fa-solid fa-download"></i></a>
                        </div>
                        <div class="doc-card" data-type="pdf">
                            <div class="doc-icon pdf"><i class="fa-solid fa-file-pdf"></i></div>
                            <div class="doc-details">
                                <h4>African Peer Review Mechanism (APRM) Guidelines</h4>
                                <p>Self-assessment guidelines for governance quality and policy best practices</p>
                                <div class="doc-meta">
                                    <span><i class="fa-solid fa-calendar"></i> 2019</span>
                                    <span><i class="fa-solid fa-file"></i> PDF</span>
                                    <span><i class="fa-solid fa-weight-hanging"></i> 1.8 MB</span>
                                </div>
                            </div>
                            <a href="#" class="doc-download" title="Download"><i class="fa-solid fa-download"></i></a>
                        </div>
                    </div>
                </div>

                <!-- 6. Peace & Security -->
                <div class="kb-catalogue" data-category="peace-security">
                    <div class="catalogue-header">
                        <div class="catalogue-icon">
                            <i class="fa-solid fa-shield-halved"></i>
                        </div>
                        <div class="catalogue-info">
                            <h2>Peace & Security</h2>
                            <p>Documents on conflict prevention, peacekeeping, and silencing the guns in Africa</p>
                        </div>
                        <span class="catalogue-count">4 Documents</span>
                    </div>
                    <div class="catalogue-items">
                        <div class="doc-card" data-type="pdf">
                            <div class="doc-icon pdf"><i class="fa-solid fa-file-pdf"></i></div>
                            <div class="doc-details">
                                <h4>African Peace and Security Architecture (APSA) Roadmap</h4>
                                <p>Comprehensive roadmap for conflict prevention, management and resolution across Africa</p>
                                <div class="doc-meta">
                                    <span><i class="fa-solid fa-calendar"></i> 2016</span>
                                    <span><i class="fa-solid fa-file"></i> PDF</span>
                                    <span><i class="fa-solid fa-weight-hanging"></i> 4.5 MB</span>
                                </div>
                            </div>
                            <a href="#" class="doc-download" title="Download"><i class="fa-solid fa-download"></i></a>
                        </div>
                        <div class="doc-card" data-type="pdf">
                            <div class="doc-icon pdf"><i class="fa-solid fa-file-pdf"></i></div>
                            <div class="doc-details">
                                <h4>Silencing the Guns Masterplan</h4>
                                <p>AU flagship initiative to end all wars, civil conflicts and gender-based violence by 2030</p>
                                <div class="doc-meta">
                                    <span><i class="fa-solid fa-calendar"></i> 2020</span>
                                    <span><i class="fa-solid fa-file"></i> PDF</span>
                                    <span><i class="fa-solid fa-weight-hanging"></i> 3.8 MB</span>
                                </div>
                            </div>
                            <a href="#" class="doc-download" title="Download"><i class="fa-solid fa-download"></i></a>
                        </div>
                        <div class="doc-card" data-type="doc">
                            <div class="doc-icon doc"><i class="fa-solid fa-file-word"></i></div>
                            <div class="doc-details">
                                <h4>Continental Early Warning System Report</h4>
                                <p>Status report on the AU Continental Early Warning System for conflict prevention</p>
                                <div class="doc-meta">
                                    <span><i class="fa-solid fa-calendar"></i> 2022</span>
                                    <span><i class="fa-solid fa-file"></i> DOCX</span>
                                    <span><i class="fa-solid fa-weight-hanging"></i> 1.4 MB</span>
                                </div>
                            </div>
                            <a href="#" class="doc-download" title="Download"><i class="fa-solid fa-download"></i></a>
                        </div>
                        <div class="doc-card" data-type="pdf">
                            <div class="doc-icon pdf"><i class="fa-solid fa-file-pdf"></i></div>
                            <div class="doc-details">
                                <h4>Women, Peace and Security Strategy</h4>
                                <p>Continental strategy for women's participation in peace processes and security governance</p>
                                <div class="doc-meta">
                                    <span><i class="fa-solid fa-calendar"></i> 2019</span>
                                    <span><i class="fa-solid fa-file"></i> PDF</span>
                                    <span><i class="fa-solid fa-weight-hanging"></i> 2.6 MB</span>
                                </div>
                            </div>
                            <a href="#" class="doc-download" title="Download"><i class="fa-solid fa-download"></i></a>
                        </div>
                    </div>
                </div>

                <!-- 7. Economic Development -->
                <div class="kb-catalogue" data-category="economic-development">
                    <div class="catalogue-header">
                        <div class="catalogue-icon">
                            <i class="fa-solid fa-coins"></i>
                        </div>
                        <div class="catalogue-info">
                            <h2>Economic Development</h2>
                            <p>Publications on trade, industrialisation, agriculture and financial integration</p>
                        </div>
                        <span class="catalogue-count">4 Documents</span>
                    </div>
                    <div class="catalogue-items">
                        <div class="doc-card" data-type="pdf">
                            <div class="doc-icon pdf"><i class="fa-solid fa-file-pdf"></i></div>
                            <div class="doc-details">
                                <h4>African Industrialisation Strategy (AIDA)</h4>
                                <p>Action plan for accelerating Africa's industrial development and value addition</p>
                                <div class="doc-meta">
                                    <span><i class="fa-solid fa-calendar"></i> 2018</span>
                                    <span><i class="fa-solid fa-file"></i> PDF</span>
                                    <span><i class="fa-solid fa-weight-hanging"></i> 4.0 MB</span>
                                </div>
                            </div>
                            <a href="#" class="doc-download" title="Download"><i class="fa-solid fa-download"></i></a>
                        </div>
                        <div class="doc-card" data-type="pdf">
                            <div class="doc-icon pdf"><i class="fa-solid fa-file-pdf"></i></div>
                            <div class="doc-details">
                                <h4>CAADP Biennial Review Report</h4>
                                <p>Comprehensive Africa Agriculture Development Programme performance review</p>
                                <div class="doc-meta">
                                    <span><i class="fa-solid fa-calendar"></i> 2023</span>
                                    <span><i class="fa-solid fa-file"></i> PDF</span>
                                    <span><i class="fa-solid fa-weight-hanging"></i> 6.1 MB</span>
                                </div>
                            </div>
                            <a href="#" class="doc-download" title="Download"><i class="fa-solid fa-download"></i></a>
                        </div>
                        <div class="doc-card" data-type="doc">
                            <div class="doc-icon doc"><i class="fa-solid fa-file-word"></i></div>
                            <div class="doc-details">
                                <h4>African Commodities Strategy</h4>
                                <p>Strategy for commodity value addition, beneficiation and intra-African trade growth</p>
                                <div class="doc-meta">
                                    <span><i class="fa-solid fa-calendar"></i> 2020</span>
                                    <span><i class="fa-solid fa-file"></i> DOCX</span>
                                    <span><i class="fa-solid fa-weight-hanging"></i> 1.7 MB</span>
                                </div>
                            </div>
                            <a href="#" class="doc-download" title="Download"><i class="fa-solid fa-download"></i></a>
                        </div>
                        <div class="doc-card" data-type="pdf">
                            <div class="doc-icon pdf"><i class="fa-solid fa-file-pdf"></i></div>
                            <div class="doc-details">
                                <h4>Africa Blue Economy Strategy</h4>
                                <p>Framework for harnessing Africa's oceans, seas and inland waterways for prosperity</p>
                                <div class="doc-meta">
                                    <span><i class="fa-solid fa-calendar"></i> 2019</span>
                                    <span><i class="fa-solid fa-file"></i> PDF</span>
                                    <span><i class="fa-solid fa-weight-hanging"></i> 3.3 MB</span>
                                </div>
                            </div>
                            <a href="#" class="doc-download" title="Download"><i class="fa-solid fa-download"></i></a>
                        </div>
                    </div>
                </div>

                <!-- 8. Social Development -->
                <div class="kb-catalogue" data-category="social-development">
                    <div class="catalogue-header">
                        <div class="catalogue-icon">
                            <i class="fa-solid fa-people-group"></i>
                        </div>
                        <div class="catalogue-info">
                            <h2>Social Development</h2>
                            <p>Strategies for education, health, youth empowerment and gender equality</p>
                        </div>
                        <span class="catalogue-count">4 Documents</span>
                    </div>
                    <div class="catalogue-items">
                        <div class="doc-card" data-type="pdf">
                            <div class="doc-icon pdf"><i class="fa-solid fa-file-pdf"></i></div>
                            <div class="doc-details">
                                <h4>Continental Education Strategy for Africa (CESA 16-25)</h4>
                                <p>Strategy for transforming education systems and building a knowledge-based Africa</p>
                                <div class="doc-meta">
                                    <span><i class="fa-solid fa-calendar"></i> 2016</span>
                                    <span><i class="fa-solid fa-file"></i> PDF</span>
                                    <span><i class="fa-solid fa-weight-hanging"></i> 3.9 MB</span>
                                </div>
                            </div>
                            <a href="#" class="doc-download" title="Download"><i class="fa-solid fa-download"></i></a>
                        </div>
                        <div class="doc-card" data-type="pdf">
                            <div class="doc-icon pdf"><i class="fa-solid fa-file-pdf"></i></div>
                            <div class="doc-details">
                                <h4>Africa Health Strategy (2016-2030)</h4>
                                <p>Continental strategy for universal health coverage and resilient health systems</p>
                                <div class="doc-meta">
                                    <span><i class="fa-solid fa-calendar"></i> 2016</span>
                                    <span><i class="fa-solid fa-file"></i> PDF</span>
                                    <span><i class="fa-solid fa-weight-hanging"></i> 2.8 MB</span>
                                </div>
                            </div>
                            <a href="#" class="doc-download" title="Download"><i class="fa-solid fa-download"></i></a>
                        </div>
                        <div class="doc-card" data-type="pdf">
                            <div class="doc-icon pdf"><i class="fa-solid fa-file-pdf"></i></div>
                            <div class="doc-details">
                                <h4>AU Strategy for Gender Equality & Women's Empowerment</h4>
                                <p>Ten-year strategy for achieving full gender parity across all sectors in Africa</p>
                                <div class="doc-meta">
                                    <span><i class="fa-solid fa-calendar"></i> 2018</span>
                                    <span><i class="fa-solid fa-file"></i> PDF</span>
                                    <span><i class="fa-solid fa-weight-hanging"></i> 2.3 MB</span>
                                </div>
                            </div>
                            <a href="#" class="doc-download" title="Download"><i class="fa-solid fa-download"></i></a>
                        </div>
                        <div class="doc-card" data-type="doc">
                            <div class="doc-icon doc"><i class="fa-solid fa-file-word"></i></div>
                            <div class="doc-details">
                                <h4>African Youth Charter & Action Plan</h4>
                                <p>Framework for youth empowerment, skills development and leadership across Africa</p>
                                <div class="doc-meta">
                                    <span><i class="fa-solid fa-calendar"></i> 2017</span>
                                    <span><i class="fa-solid fa-file"></i> DOCX</span>
                                    <span><i class="fa-solid fa-weight-hanging"></i> 1.2 MB</span>
                                </div>
                            </div>
                            <a href="#" class="doc-download" title="Download"><i class="fa-solid fa-download"></i></a>
                        </div>
                    </div>
                </div>

                <!-- 9. Science & Technology -->
                <div class="kb-catalogue" data-category="science-technology">
                    <div class="catalogue-header">
                        <div class="catalogue-icon">
                            <i class="fa-solid fa-microchip"></i>
                        </div>
                        <div class="catalogue-info">
                            <h2>Science & Technology</h2>
                            <p>Strategies for innovation, digital transformation and technology-driven development</p>
                        </div>
                        <span class="catalogue-count">4 Documents</span>
                    </div>
                    <div class="catalogue-items">
                        <div class="doc-card" data-type="pdf">
                            <div class="doc-icon pdf"><i class="fa-solid fa-file-pdf"></i></div>
                            <div class="doc-details">
                                <h4>STISA-2024: Science, Technology & Innovation Strategy</h4>
                                <p>Continental strategy for using science and innovation to accelerate Africa's development</p>
                                <div class="doc-meta">
                                    <span><i class="fa-solid fa-calendar"></i> 2014</span>
                                    <span><i class="fa-solid fa-file"></i> PDF</span>
                                    <span><i class="fa-solid fa-weight-hanging"></i> 3.6 MB</span>
                                </div>
                            </div>
                            <a href="#" class="doc-download" title="Download"><i class="fa-solid fa-download"></i></a>
                        </div>
                        <div class="doc-card" data-type="pdf">
                            <div class="doc-icon pdf"><i class="fa-solid fa-file-pdf"></i></div>
                            <div class="doc-details">
                                <h4>AU Digital Transformation Strategy for Africa</h4>
                                <p>Blueprint for digital innovation, e-governance and a connected African continent</p>
                                <div class="doc-meta">
                                    <span><i class="fa-solid fa-calendar"></i> 2020</span>
                                    <span><i class="fa-solid fa-file"></i> PDF</span>
                                    <span><i class="fa-solid fa-weight-hanging"></i> 4.4 MB</span>
                                </div>
                            </div>
                            <a href="#" class="doc-download" title="Download"><i class="fa-solid fa-download"></i></a>
                        </div>
                        <div class="doc-card" data-type="pdf">
                            <div class="doc-icon pdf"><i class="fa-solid fa-file-pdf"></i></div>
                            <div class="doc-details">
                                <h4>African Space Policy & Strategy</h4>
                                <p>Continental framework for space science, satellite technology and earth observation</p>
                                <div class="doc-meta">
                                    <span><i class="fa-solid fa-calendar"></i> 2017</span>
                                    <span><i class="fa-solid fa-file"></i> PDF</span>
                                    <span><i class="fa-solid fa-weight-hanging"></i> 2.0 MB</span>
                                </div>
                            </div>
                            <a href="#" class="doc-download" title="Download"><i class="fa-solid fa-download"></i></a>
                        </div>
                        <div class="doc-card" data-type="doc">
                            <div class="doc-icon doc"><i class="fa-solid fa-file-word"></i></div>
                            <div class="doc-details">
                                <h4>Africa Data Consensus & Policy Framework</h4>
                                <p>Framework for data governance, open data and statistics harmonisation across Africa</p>
                                <div class="doc-meta">
                                    <span><i class="fa-solid fa-calendar"></i> 2022</span>
                                    <span><i class="fa-solid fa-file"></i> DOCX</span>
                                    <span><i class="fa-solid fa-weight-hanging"></i> 980 KB</span>
                                </div>
                            </div>
                            <a href="#" class="doc-download" title="Download"><i class="fa-solid fa-download"></i></a>
                        </div>
                    </div>
                </div>

                <!-- 10. Environment & Climate -->
                <div class="kb-catalogue" data-category="environment-climate">
                    <div class="catalogue-header">
                        <div class="catalogue-icon">
                            <i class="fa-solid fa-leaf"></i>
                        </div>
                        <div class="catalogue-info">
                            <h2>Environment & Climate</h2>
                            <p>Frameworks addressing climate change adaptation, green growth and sustainability</p>
                        </div>
                        <span class="catalogue-count">4 Documents</span>
                    </div>
                    <div class="catalogue-items">
                        <div class="doc-card" data-type="pdf">
                            <div class="doc-icon pdf"><i class="fa-solid fa-file-pdf"></i></div>
                            <div class="doc-details">
                                <h4>African Climate Change Strategy</h4>
                                <p>Continental strategy for climate adaptation, mitigation and resilience building</p>
                                <div class="doc-meta">
                                    <span><i class="fa-solid fa-calendar"></i> 2022</span>
                                    <span><i class="fa-solid fa-file"></i> PDF</span>
                                    <span><i class="fa-solid fa-weight-hanging"></i> 5.2 MB</span>
                                </div>
                            </div>
                            <a href="#" class="doc-download" title="Download"><i class="fa-solid fa-download"></i></a>
                        </div>
                        <div class="doc-card" data-type="pdf">
                            <div class="doc-icon pdf"><i class="fa-solid fa-file-pdf"></i></div>
                            <div class="doc-details">
                                <h4>Africa Green Recovery Action Plan</h4>
                                <p>Post-pandemic green recovery strategies integrating environmental sustainability</p>
                                <div class="doc-meta">
                                    <span><i class="fa-solid fa-calendar"></i> 2021</span>
                                    <span><i class="fa-solid fa-file"></i> PDF</span>
                                    <span><i class="fa-solid fa-weight-hanging"></i> 3.7 MB</span>
                                </div>
                            </div>
                            <a href="#" class="doc-download" title="Download"><i class="fa-solid fa-download"></i></a>
                        </div>
                        <div class="doc-card" data-type="doc">
                            <div class="doc-icon doc"><i class="fa-solid fa-file-word"></i></div>
                            <div class="doc-details">
                                <h4>Great Green Wall Initiative Progress Report</h4>
                                <p>Status update on Africa's flagship environmental project combating desertification</p>
                                <div class="doc-meta">
                                    <span><i class="fa-solid fa-calendar"></i> 2023</span>
                                    <span><i class="fa-solid fa-file"></i> DOCX</span>
                                    <span><i class="fa-solid fa-weight-hanging"></i> 2.5 MB</span>
                                </div>
                            </div>
                            <a href="#" class="doc-download" title="Download"><i class="fa-solid fa-download"></i></a>
                        </div>
                        <div class="doc-card" data-type="pdf">
                            <div class="doc-icon pdf"><i class="fa-solid fa-file-pdf"></i></div>
                            <div class="doc-details">
                                <h4>Africa Renewable Energy Initiative (AREI)</h4>
                                <p>Framework for scaling renewable energy capacity to 300GW across the continent</p>
                                <div class="doc-meta">
                                    <span><i class="fa-solid fa-calendar"></i> 2018</span>
                                    <span><i class="fa-solid fa-file"></i> PDF</span>
                                    <span><i class="fa-solid fa-weight-hanging"></i> 2.9 MB</span>
                                </div>
                            </div>
                            <a href="#" class="doc-download" title="Download"><i class="fa-solid fa-download"></i></a>
                        </div>
                    </div>
                </div>

                <!-- 11. Regional Integration -->
                <div class="kb-catalogue" data-category="regional-integration">
                    <div class="catalogue-header">
                        <div class="catalogue-icon">
                            <i class="fa-solid fa-globe-africa"></i>
                        </div>
                        <div class="catalogue-info">
                            <h2>Regional Integration</h2>
                            <p>Documents on RECs, free movement of people, infrastructure connectivity and continental unity</p>
                        </div>
                        <span class="catalogue-count">4 Documents</span>
                    </div>
                    <div class="catalogue-items">
                        <div class="doc-card" data-type="pdf">
                            <div class="doc-icon pdf"><i class="fa-solid fa-file-pdf"></i></div>
                            <div class="doc-details">
                                <h4>Protocol on Free Movement of Persons</h4>
                                <p>AU protocol on free movement, right of residence and right of establishment in Africa</p>
                                <div class="doc-meta">
                                    <span><i class="fa-solid fa-calendar"></i> 2018</span>
                                    <span><i class="fa-solid fa-file"></i> PDF</span>
                                    <span><i class="fa-solid fa-weight-hanging"></i> 1.3 MB</span>
                                </div>
                            </div>
                            <a href="#" class="doc-download" title="Download"><i class="fa-solid fa-download"></i></a>
                        </div>
                        <div class="doc-card" data-type="pdf">
                            <div class="doc-icon pdf"><i class="fa-solid fa-file-pdf"></i></div>
                            <div class="doc-details">
                                <h4>PIDA: Programme for Infrastructure Development</h4>
                                <p>Continental infrastructure plan for transport, energy, water and ICT connectivity</p>
                                <div class="doc-meta">
                                    <span><i class="fa-solid fa-calendar"></i> 2017</span>
                                    <span><i class="fa-solid fa-file"></i> PDF</span>
                                    <span><i class="fa-solid fa-weight-hanging"></i> 7.2 MB</span>
                                </div>
                            </div>
                            <a href="#" class="doc-download" title="Download"><i class="fa-solid fa-download"></i></a>
                        </div>
                        <div class="doc-card" data-type="doc">
                            <div class="doc-icon doc"><i class="fa-solid fa-file-word"></i></div>
                            <div class="doc-details">
                                <h4>African Passport & Visa Openness Report</h4>
                                <p>Annual report tracking visa policies and progress towards borderless Africa</p>
                                <div class="doc-meta">
                                    <span><i class="fa-solid fa-calendar"></i> 2023</span>
                                    <span><i class="fa-solid fa-file"></i> DOCX</span>
                                    <span><i class="fa-solid fa-weight-hanging"></i> 1.5 MB</span>
                                </div>
                            </div>
                            <a href="#" class="doc-download" title="Download"><i class="fa-solid fa-download"></i></a>
                        </div>
                        <div class="doc-card" data-type="pdf">
                            <div class="doc-icon pdf"><i class="fa-solid fa-file-pdf"></i></div>
                            <div class="doc-details">
                                <h4>RECs Harmonisation & Coordination Framework</h4>
                                <p>Framework for aligning Regional Economic Communities with Agenda 2063 priorities</p>
                                <div class="doc-meta">
                                    <span><i class="fa-solid fa-calendar"></i> 2021</span>
                                    <span><i class="fa-solid fa-file"></i> PDF</span>
                                    <span><i class="fa-solid fa-weight-hanging"></i> 2.2 MB</span>
                                </div>
                            </div>
                            <a href="#" class="doc-download" title="Download"><i class="fa-solid fa-download"></i></a>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Stats Summary -->
            <div class="kb-stats">
                <div class="kb-stat-item">
                    <span class="kb-stat-number">46</span>
                    <span class="kb-stat-label">Total Documents</span>
                </div>
                <div class="kb-stat-item">
                    <span class="kb-stat-number">11</span>
                    <span class="kb-stat-label">Categories</span>
                </div>
                <div class="kb-stat-item">
                    <span class="kb-stat-number">34</span>
                    <span class="kb-stat-label">PDF Reports</span>
                </div>
                <div class="kb-stat-item">
                    <span class="kb-stat-number">12</span>
                    <span class="kb-stat-label">Word Documents</span>
                </div>
            </div>

        </div>
    </section>

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Category filtering
    const catBtns = document.querySelectorAll('.kb-cat-btn');
    const catalogues = document.querySelectorAll('.kb-catalogue');

    catBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            catBtns.forEach(b => b.classList.remove('active'));
            this.classList.add('active');
            const cat = this.dataset.category;

            catalogues.forEach(c => {
                if (cat === 'all' || c.dataset.category === cat) {
                    c.style.display = '';
                    c.style.animation = 'fadeInCatalogue 0.4s ease-out';
                } else {
                    c.style.display = 'none';
                }
            });
        });
    });

    // Search functionality
    const searchInput = document.getElementById('kbSearch');
    searchInput.addEventListener('input', function() {
        const query = this.value.toLowerCase().trim();

        catalogues.forEach(catalogue => {
            const cards = catalogue.querySelectorAll('.doc-card');
            let visibleCards = 0;

            cards.forEach(card => {
                const title = card.querySelector('h4').textContent.toLowerCase();
                const desc = card.querySelector('p').textContent.toLowerCase();
                if (query === '' || title.includes(query) || desc.includes(query)) {
                    card.style.display = '';
                    visibleCards++;
                } else {
                    card.style.display = 'none';
                }
            });

            catalogue.style.display = visibleCards > 0 || query === '' ? '' : 'none';
        });

        // Reset category filter to "All" on search
        if (query !== '') {
            catBtns.forEach(b => b.classList.remove('active'));
            catBtns[0].classList.add('active');
        }
    });

    // View toggle (grid/list)
    const viewBtns = document.querySelectorAll('.view-btn');
    const catalogueContainer = document.getElementById('kbCatalogues');

    viewBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            viewBtns.forEach(b => b.classList.remove('active'));
            this.classList.add('active');
            const view = this.dataset.view;
            catalogueContainer.classList.toggle('list-view', view === 'list');
        });
    });

    // Hero background rotation
    const heroBgs = document.querySelectorAll('.page-hero-bg');
    if (heroBgs.length > 1) {
        let currentBg = 0;
        setInterval(() => {
            heroBgs[currentBg].classList.remove('active');
            currentBg = (currentBg + 1) % heroBgs.length;
            heroBgs[currentBg].classList.add('active');
        }, 5000);
    }
});
</script>
@endpush
