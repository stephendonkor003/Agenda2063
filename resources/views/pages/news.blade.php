@extends('layouts.public')

@section('title', 'News & Events - Agenda 2063')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/news.css') }}">
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
                    <span>News & Events</span>
                </li>
            </ol>
        </div>
    </nav>

    <!-- Page Hero Banner -->
    <section class="page-hero" id="pageHero">
        <div class="page-hero-bg active" style="background-image: url('https://agenda2063.africa/assets/banner1.jpeg');"></div>
        <div class="page-hero-bg" style="background-image: url('https://agenda2063.africa/assets/news4.png');"></div>
        <div class="page-hero-bg" style="background-image: url('https://agenda2063.africa/assets/news3.png');"></div>
        <div class="page-hero-bg" style="background-image: url('https://agenda2063.africa/assets/Aspiration1.png');"></div>
        <div class="page-hero-content">
            <span class="hero-label">Stay Informed</span>
            <h1>News & Events</h1>
            <div class="hero-divider"></div>
            <p>Latest updates on Africa's transformation journey and Agenda 2063 milestones</p>
        </div>
    </section>

    <!-- News & Events Content -->
    <section class="news-events-content">
        <div class="content-wrapper">

            <!-- Filter and Search Section -->
            <div class="filter-section">
                <div class="filter-left">
                    <div class="category-filters">
                        <button class="filter-btn active" data-category="all">
                            <i class="fa-solid fa-globe"></i> All
                        </button>
                        <button class="filter-btn" data-category="news">
                            <i class="fa-solid fa-newspaper"></i> News
                        </button>
                        <button class="filter-btn" data-category="events">
                            <i class="fa-solid fa-calendar"></i> Events
                        </button>
                        <button class="filter-btn" data-category="press">
                            <i class="fa-solid fa-bullhorn"></i> Press Releases
                        </button>
                        <button class="filter-btn" data-category="media">
                            <i class="fa-solid fa-photo-film"></i> Media
                        </button>
                    </div>
                </div>
                <div class="filter-right">
                    <div class="search-box">
                        <input type="text" id="searchInput" placeholder="Search news and events...">
                        <button class="search-btn">
                            <i class="fa-solid fa-search"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Featured News Section -->
            <div class="featured-news-section">
                <h2 class="section-title">Featured Story</h2>
                <div class="featured-news-card">
                    <div class="featured-image">
                        <img src="https://agenda2063.africa/assets/banner1.jpeg" alt="Featured News">
                        <span class="featured-badge">FEATURED</span>
                    </div>
                    <div class="featured-content">
                        <div class="featured-meta">
                            <span class="category-tag news-tag">Breaking News</span>
                            <span class="date-tag"><i class="fa-solid fa-calendar"></i> March 18, 2024</span>
                        </div>
                        <h3>African Union Summit 2024: Leaders Commit to Accelerating Agenda 2063 Implementation</h3>
                        <p>Heads of State and Government from across the continent gathered in Addis Ababa for the 37th
                            Ordinary Session of the African Union Assembly, reaffirming their commitment to the full
                            implementation of Agenda 2063. The summit focused on accelerating progress in key flagship
                            projects including the African Continental Free Trade Area, infrastructure development, and
                            digital transformation initiatives.</p>
                        <div class="featured-stats">
                            <div class="stat-item">
                                <i class="fa-solid fa-users"></i>
                                <span>54 Member States</span>
                            </div>
                            <div class="stat-item">
                                <i class="fa-solid fa-handshake"></i>
                                <span>15 New Agreements</span>
                            </div>
                            <div class="stat-item">
                                <i class="fa-solid fa-dollar-sign"></i>
                                <span>$2.5B Pledged</span>
                            </div>
                        </div>
                        <button class="read-full-btn">
                            <i class="fa-solid fa-arrow-right"></i> Read Full Story
                        </button>
                    </div>
                </div>
            </div>

            <!-- Main Content Grid -->
            <div class="news-events-grid">

                <!-- News Article 1 -->
                <article class="news-event-card" data-category="news">
                    <div class="card-image">
                        <img src="https://agenda2063.africa/assets/news4.png" alt="AfCFTA Progress">
                        <span class="category-badge news-badge">News</span>
                    </div>
                    <div class="card-content">
                        <div class="card-meta">
                            <span class="date"><i class="fa-solid fa-calendar"></i> March 15, 2024</span>
                            <span class="read-time"><i class="fa-solid fa-clock"></i> 5 min read</span>
                        </div>
                        <h4>AfCFTA Trade Volume Surpasses $50 Billion Milestone</h4>
                        <p>The African Continental Free Trade Area has achieved a historic milestone with intra-African
                            trade reaching $50 billion, marking a 35% increase from the previous year...</p>
                        <div class="card-tags">
                            <span class="tag">Trade</span>
                            <span class="tag">Economy</span>
                            <span class="tag">AfCFTA</span>
                        </div>
                        <a href="#" class="card-link">Read More <i class="fa-solid fa-arrow-right"></i></a>
                    </div>
                </article>

                <!-- Event Card 1 -->
                <article class="news-event-card" data-category="events">
                    <div class="card-image">
                        <img src="https://agenda2063.africa/assets/Aspiration1.png" alt="Youth Summit">
                        <span class="category-badge event-badge">Event</span>
                    </div>
                    <div class="card-content">
                        <div class="card-meta">
                            <span class="date"><i class="fa-solid fa-calendar"></i> April 10-12, 2024</span>
                            <span class="location"><i class="fa-solid fa-location-dot"></i> Nairobi, Kenya</span>
                        </div>
                        <h4>Pan-African Youth Summit 2024</h4>
                        <p>Join thousands of young African leaders, entrepreneurs, and innovators for three days of
                            networking, workshops, and discussions on youth empowerment...</p>
                        <div class="event-info">
                            <div class="event-detail">
                                <i class="fa-solid fa-users"></i>
                                <span>5,000+ Attendees</span>
                            </div>
                            <div class="event-detail">
                                <i class="fa-solid fa-microphone"></i>
                                <span>50+ Speakers</span>
                            </div>
                        </div>
                        <a href="#" class="card-link register-link">Register Now <i
                                class="fa-solid fa-arrow-right"></i></a>
                    </div>
                </article>

                <!-- Press Release 1 -->
                <article class="news-event-card" data-category="press">
                    <div class="card-image">
                        <img src="https://agenda2063.africa/assets/Aspiration3.png" alt="Infrastructure">
                        <span class="category-badge press-badge">Press Release</span>
                    </div>
                    <div class="card-content">
                        <div class="card-meta">
                            <span class="date"><i class="fa-solid fa-calendar"></i> March 14, 2024</span>
                            <span class="source"><i class="fa-solid fa-building"></i> AU Commission</span>
                        </div>
                        <h4>Continental Infrastructure Projects Receive $5 Billion Investment</h4>
                        <p>The African Union Commission announces major funding for trans-African highway and energy
                            corridor projects across multiple regions...</p>
                        <div class="card-tags">
                            <span class="tag">Infrastructure</span>
                            <span class="tag">Investment</span>
                        </div>
                        <a href="#" class="card-link">Read Release <i class="fa-solid fa-arrow-right"></i></a>
                    </div>
                </article>

                <!-- News Article 2 -->
                <article class="news-event-card" data-category="news">
                    <div class="card-image">
                        <img src="https://agenda2063.africa/assets/Aspiration4.png" alt="Digital Transformation">
                        <span class="category-badge news-badge">News</span>
                    </div>
                    <div class="card-content">
                        <div class="card-meta">
                            <span class="date"><i class="fa-solid fa-calendar"></i> March 13, 2024</span>
                            <span class="read-time"><i class="fa-solid fa-clock"></i> 4 min read</span>
                        </div>
                        <h4>Digital Transformation Initiative Connects 100 Million Africans</h4>
                        <p>The Pan-African E-Network project achieves significant milestone, providing internet connectivity
                            to 100 million people across rural and urban areas...</p>
                        <div class="card-tags">
                            <span class="tag">Technology</span>
                            <span class="tag">Digital</span>
                            <span class="tag">Connectivity</span>
                        </div>
                        <a href="#" class="card-link">Read More <i class="fa-solid fa-arrow-right"></i></a>
                    </div>
                </article>

                <!-- Event Card 2 -->
                <article class="news-event-card" data-category="events">
                    <div class="card-image">
                        <img src="https://agenda2063.africa/assets/Aspiration5.png" alt="Trade Forum">
                        <span class="category-badge event-badge">Event</span>
                    </div>
                    <div class="card-content">
                        <div class="card-meta">
                            <span class="date"><i class="fa-solid fa-calendar"></i> May 5-7, 2024</span>
                            <span class="location"><i class="fa-solid fa-location-dot"></i> Accra, Ghana</span>
                        </div>
                        <h4>African Trade and Investment Forum</h4>
                        <p>Annual forum bringing together business leaders, policymakers, and investors to explore trade
                            opportunities under AfCFTA...</p>
                        <div class="event-info">
                            <div class="event-detail">
                                <i class="fa-solid fa-briefcase"></i>
                                <span>200+ Exhibitors</span>
                            </div>
                            <div class="event-detail">
                                <i class="fa-solid fa-handshake"></i>
                                <span>B2B Meetings</span>
                            </div>
                        </div>
                        <a href="#" class="card-link register-link">Register Now <i
                                class="fa-solid fa-arrow-right"></i></a>
                    </div>
                </article>

                <!-- Media Card 1 -->
                <article class="news-event-card" data-category="media">
                    <div class="card-image">
                        <img src="https://agenda2063.africa/assets/flagship-1.jpg" alt="Photo Gallery">
                        <span class="category-badge media-badge">Media</span>
                        <div class="media-overlay">
                            <i class="fa-solid fa-images"></i>
                            <span>45 Photos</span>
                        </div>
                    </div>
                    <div class="card-content">
                        <div class="card-meta">
                            <span class="date"><i class="fa-solid fa-calendar"></i> March 12, 2024</span>
                            <span class="type"><i class="fa-solid fa-camera"></i> Photo Gallery</span>
                        </div>
                        <h4>AU Summit 2024: Highlights and Key Moments</h4>
                        <p>Browse through exclusive photos from the 37th African Union Summit, capturing historic moments
                            and key discussions...</p>
                        <a href="#" class="card-link">View Gallery <i class="fa-solid fa-arrow-right"></i></a>
                    </div>
                </article>

                <!-- News Article 3 -->
                <article class="news-event-card" data-category="news">
                    <div class="card-image">
                        <img src="https://agenda2063.africa/assets/flagship-2.jpg" alt="Agriculture">
                        <span class="category-badge news-badge">News</span>
                    </div>
                    <div class="card-content">
                        <div class="card-meta">
                            <span class="date"><i class="fa-solid fa-calendar"></i> March 11, 2024</span>
                            <span class="read-time"><i class="fa-solid fa-clock"></i> 6 min read</span>
                        </div>
                        <h4>Agricultural Transformation Program Boosts Food Security</h4>
                        <p>CAADP initiative reports 40% increase in agricultural productivity across 15 countries,
                            significantly improving food security and farmer incomes...</p>
                        <div class="card-tags">
                            <span class="tag">Agriculture</span>
                            <span class="tag">Food Security</span>
                            <span class="tag">CAADP</span>
                        </div>
                        <a href="#" class="card-link">Read More <i class="fa-solid fa-arrow-right"></i></a>
                    </div>
                </article>

                <!-- Press Release 2 -->
                <article class="news-event-card" data-category="press">
                    <div class="card-image">
                        <img src="https://agenda2063.africa/assets/Aspiration6.png" alt="Climate Action">
                        <span class="category-badge press-badge">Press Release</span>
                    </div>
                    <div class="card-content">
                        <div class="card-meta">
                            <span class="date"><i class="fa-solid fa-calendar"></i> March 10, 2024</span>
                            <span class="source"><i class="fa-solid fa-building"></i> AU Commission</span>
                        </div>
                        <h4>Africa Launches Continental Climate Resilience Strategy</h4>
                        <p>New comprehensive strategy aims to build climate-resilient economies while promoting green growth
                            and sustainable development...</p>
                        <div class="card-tags">
                            <span class="tag">Climate</span>
                            <span class="tag">Environment</span>
                        </div>
                        <a href="#" class="card-link">Read Release <i class="fa-solid fa-arrow-right"></i></a>
                    </div>
                </article>

                <!-- Event Card 3 -->
                <article class="news-event-card" data-category="events">
                    <div class="card-image">
                        <img src="https://agenda2063.africa/assets/Aspiration7.png" alt="Innovation Summit">
                        <span class="category-badge event-badge">Event</span>
                    </div>
                    <div class="card-content">
                        <div class="card-meta">
                            <span class="date"><i class="fa-solid fa-calendar"></i> June 15-17, 2024</span>
                            <span class="location"><i class="fa-solid fa-location-dot"></i> Kigali, Rwanda</span>
                        </div>
                        <h4>Africa Innovation and Technology Summit</h4>
                        <p>Showcase of cutting-edge African innovations in AI, fintech, healthtech, and agritech with
                            startup pitch competitions...</p>
                        <div class="event-info">
                            <div class="event-detail">
                                <i class="fa-solid fa-rocket"></i>
                                <span>100+ Startups</span>
                            </div>
                            <div class="event-detail">
                                <i class="fa-solid fa-trophy"></i>
                                <span>$1M Prize Pool</span>
                            </div>
                        </div>
                        <a href="#" class="card-link register-link">Register Now <i
                                class="fa-solid fa-arrow-right"></i></a>
                    </div>
                </article>

                <!-- Media Card 2 -->
                <article class="news-event-card" data-category="media">
                    <div class="card-image">
                        <img src="https://agenda2063.africa/assets/flagship-3.jpg" alt="Video">
                        <span class="category-badge media-badge">Media</span>
                        <div class="media-overlay">
                            <i class="fa-solid fa-play"></i>
                            <span>12:45</span>
                        </div>
                    </div>
                    <div class="card-content">
                        <div class="card-meta">
                            <span class="date"><i class="fa-solid fa-calendar"></i> March 9, 2024</span>
                            <span class="type"><i class="fa-solid fa-video"></i> Video</span>
                        </div>
                        <h4>Agenda 2063: A Decade of Progress Documentary</h4>
                        <p>Watch the inspiring documentary showcasing the achievements and impact of Agenda 2063 over the
                            past ten years...</p>
                        <a href="#" class="card-link">Watch Now <i class="fa-solid fa-arrow-right"></i></a>
                    </div>
                </article>

                <!-- News Article 4 -->
                <article class="news-event-card" data-category="news">
                    <div class="card-image">
                        <img src="https://agenda2063.africa/assets/news3.png" alt="Education">
                        <span class="category-badge news-badge">News</span>
                    </div>
                    <div class="card-content">
                        <div class="card-meta">
                            <span class="date"><i class="fa-solid fa-calendar"></i> March 8, 2024</span>
                            <span class="read-time"><i class="fa-solid fa-clock"></i> 5 min read</span>
                        </div>
                        <h4>Pan-African University Expands to 10 New Campuses</h4>
                        <p>Major expansion of PAU brings world-class higher education to more African students with focus on
                            STEM and innovation...</p>
                        <div class="card-tags">
                            <span class="tag">Education</span>
                            <span class="tag">Youth</span>
                            <span class="tag">PAU</span>
                        </div>
                        <a href="#" class="card-link">Read More <i class="fa-solid fa-arrow-right"></i></a>
                    </div>
                </article>

                <!-- Press Release 3 -->
                <article class="news-event-card" data-category="press">
                    <div class="card-image">
                        <img src="https://agenda2063.africa/assets/Aspiration2.png" alt="Peace">
                        <span class="category-badge press-badge">Press Release</span>
                    </div>
                    <div class="card-content">
                        <div class="card-meta">
                            <span class="date"><i class="fa-solid fa-calendar"></i> March 7, 2024</span>
                            <span class="source"><i class="fa-solid fa-building"></i> Peace & Security Council</span>
                        </div>
                        <h4>African Peace and Security Architecture Strengthened</h4>
                        <p>New mechanisms for conflict prevention and resolution adopted, enhancing Africa's capacity to
                            maintain peace and stability...</p>
                        <div class="card-tags">
                            <span class="tag">Peace</span>
                            <span class="tag">Security</span>
                        </div>
                        <a href="#" class="card-link">Read Release <i class="fa-solid fa-arrow-right"></i></a>
                    </div>
                </article>

            </div>

            <!-- Load More Button -->
            <div class="load-more-section">
                <button class="load-more-btn">
                    <i class="fa-solid fa-spinner"></i> Load More Stories
                </button>
            </div>

            <!-- Newsletter Subscription -->
            <div class="newsletter-section">
                <div class="newsletter-content">
                    <div class="newsletter-icon">
                        <i class="fa-solid fa-envelope"></i>
                    </div>
                    <div class="newsletter-text">
                        <h3>Stay Updated</h3>
                        <p>Subscribe to our newsletter and never miss important updates on Agenda 2063</p>
                    </div>
                    <div class="newsletter-form">
                        <input type="email" placeholder="Enter your email address">
                        <button class="subscribe-btn">
                            <i class="fa-solid fa-paper-plane"></i> Subscribe
                        </button>
                    </div>
                </div>
            </div>

        </div>
    </section>

@endsection

@push('scripts')
    <script src="{{ asset('js/news.js') }}"></script>
@endpush
