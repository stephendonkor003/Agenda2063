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
        @foreach($heroImages as $image)
            <div class="page-hero-bg {{ $loop->first ? 'active' : '' }}" style="background-image: url('{{ $image }}');"></div>
        @endforeach
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
                        <button class="filter-btn" data-category="article">
                            <i class="fa-solid fa-newspaper"></i> Articles
                        </button>
                        <button class="filter-btn" data-category="event">
                            <i class="fa-solid fa-calendar"></i> Events
                        </button>
                        <button class="filter-btn" data-category="press">
                            <i class="fa-solid fa-bullhorn"></i> Press Releases
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
            @if($featuredCard)
            <div class="featured-news-section">
                <h2 class="section-title">Featured Story</h2>
                <div class="featured-news-card">
                    <div class="featured-image">
                        <img src="{{ $featuredCard['image'] }}" alt="Featured News">
                        <span class="featured-badge">FEATURED</span>
                    </div>
                    <div class="featured-content">
                        <div class="featured-meta">
                            <span class="category-tag news-tag">{{ $featuredCard['category'] }}</span>
                            <span class="date-tag"><i class="fa-solid fa-calendar"></i> {{ $featuredCard['date'] }}</span>
                        </div>
                        <h3>{{ $featuredCard['title'] }}</h3>
                        <p>{{ $featuredCard['summary'] }}</p>
                        <a class="read-full-btn" href="{{ $featuredCard['url'] }}">
                            <i class="fa-solid fa-arrow-right"></i> Read Full Story
                        </a>
                    </div>
                </div>
            </div>
            @endif

            <!-- Main Content Grid -->
            <div class="news-events-grid">
                @forelse($cards as $card)
                    <article class="news-event-card" data-category="{{ $card['type'] }}">
                        <div class="card-image">
                            <img src="{{ $card['image'] }}" alt="{{ $card['title'] }}">
                            <span class="category-badge {{ $card['type'] === 'event' ? 'event-badge' : ($card['type']==='press' ? 'press-badge' : 'news-badge') }}">{{ ucfirst($card['type']) }}</span>
                        </div>
                        <div class="card-content">
                            <div class="card-meta">
                                <span class="date"><i class="fa-solid fa-calendar"></i> {{ $card['date'] }}</span>
                                @if($card['location'])<span class="location"><i class="fa-solid fa-location-dot"></i> {{ $card['location'] }}</span>@endif
                            </div>
                            <h4>{{ $card['title'] }}</h4>
                            <p>{{ $card['summary'] }}</p>
                            <div class="card-tags">
                                <span class="tag">{{ $card['category'] }}</span>
                            </div>
                            <a href="{{ $card['url'] }}" class="card-link">Read More <i class="fa-solid fa-arrow-right"></i></a>
                        </div>
                    </article>
                @empty
                    <p style="text-align:center;color:#94a3b8;width:100%;">No news or events published yet.</p>
                @endforelse
            </div>

            <div class="newsletter-section">
                <div class="newsletter-content">
                    <div class="newsletter-icon">
                        <i class="fa-solid fa-globe-africa"></i>
                    </div>
                    <div class="newsletter-text">
                        <h3>Explore Official AU Channels</h3>
                        <p>Continue to the African Union newsroom and events pages for more official releases, notices, and event updates.</p>
                    </div>
                    <div class="newsletter-actions">
                        <a class="subscribe-btn" href="https://au.int/en/pressreleases" target="_blank" rel="noopener">
                            <i class="fa-solid fa-bullhorn"></i> Press Releases
                        </a>
                        <a class="subscribe-btn secondary" href="https://au.int/en/newsevents" target="_blank" rel="noopener">
                            <i class="fa-solid fa-calendar-days"></i> Events
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </section>

@endsection

@push('scripts')
    <script src="{{ asset('js/news.js') }}"></script>
@endpush
