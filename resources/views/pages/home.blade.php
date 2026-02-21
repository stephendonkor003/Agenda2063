@extends('layouts.public')

@section('title', 'Agenda 2063 - The Africa We Want')

@section('content')

    <!-- Hero Section (driven from admin sliders) -->
    @php
        $heroSlides = collect($sliders ?? [])->chunk(3);
        $placeholder = 'https://agenda2063.africa/assets/banner1.jpeg';
    @endphp
    <section class="hero" id="heroSection">
        <div class="hero-wrapper">
            @forelse($heroSlides as $slideIndex => $chunk)
                <div class="hero-slide {{ $slideIndex === 0 ? 'active' : '' }}" data-slide="{{ $slideIndex }}">
                    @foreach($chunk as $cardIndex => $slide)
                        <div class="hero-card {{ $cardIndex === 0 ? 'active' : '' }}" data-index="{{ ($slideIndex * 3) + $cardIndex }}">
                            <div class="hero-bg" style="background-image: url('{{ $slide->image_url ?: $placeholder }}');"></div>
                            <div class="hero-content">
                                <h3>{{ $slide->title }}</h3>
                                @if($slide->subtitle)
                                    <p>{{ $slide->subtitle }}</p>
                                @endif
                                @if($slide->cta_label)
                                    <a class="hero-cta" href="{{ $slide->cta_url ?? '#' }}" target="{{ $slide->cta_url ? '_blank' : '_self' }}">
                                        {{ $slide->cta_label }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            @empty
                <!-- Fallback static hero when no sliders are configured -->
                <div class="hero-slide active" data-slide="0">
                    <div class="hero-card active" data-index="0">
                        <div class="hero-bg" style="background-image: url('https://agenda2063.africa/assets/banner1.jpeg');"></div>
                        <div class="hero-content">
                            <h3>Agenda 2063</h3>
                            <p>The Africa We Want.</p>
                            <a class="hero-cta" href="{{ route('about') }}">Explore</a>
                        </div>
                    </div>
                </div>
            @endforelse
        </div>

        <div class="hero-indicators">
            @forelse($heroSlides as $slideIndex => $chunk)
                <div class="hero-indicator {{ $slideIndex === 0 ? 'active' : '' }}" data-slide="{{ $slideIndex }}"></div>
            @empty
                <div class="hero-indicator active" data-slide="0"></div>
            @endforelse
        </div>
    </section>

    @php
        $press = $pressItems[0] ?? [
            'title' => 'African Union launches 2024 Agenda 2063 Continental Progress Report at Addis Ababa Summit',
            'link' => url('/news/detail'),
        ];
        $aspirationsItems = collect($aspirationsItems ?? [])->map(function ($card) {
            return [
                'front' => $card['front'] ?? $card['image_url'] ?? '',
                'title' => $card['title'] ?? '',
                'label' => $card['label'] ?? ($card['aspiration'] ?? ''),
                'back_title' => $card['back_title'] ?? ($card['title'] ?? ''),
                'back_text' => $card['back_text'] ?? ($card['text'] ?? ''),
                'link' => $card['link'] ?? '#',
            ];
        });
        $flagships = collect($flagships ?? [])->map(function ($item) {
            return [
                'image' => $item['image'] ?? $item['image_url'] ?? '',
                'title' => $item['title'] ?? '',
                'subtitle' => $item['subtitle'] ?? '',
                'text' => $item['text'] ?? '',
                'link' => $item['link'] ?? '#',
            ];
        });
    @endphp

    <!-- Press Release Bar -->
    <div class="press-release-bar">
        <span class="press-label">PRESS RELEASE:</span>
        <div class="press-content-wrapper">
            <a href="{{ $press['link'] ?? '#' }}" id="pressReleaseLink" class="press-link">{{ $press['title'] ?? '' }}</a>
        </div>
    </div>

    <!-- Aspirations Section -->
    <section class="content-section aspirations-section" id="aspirations">
        <div class="section-header">
            <h2>Aspirations</h2>
            <a href="#" class="read-more">Read More</a>
        </div>
        <div class="aspirations-grid">
            @foreach($aspirationsItems as $index => $asp)
            <div class="aspiration-card">
                <div class="aspiration-card-inner">
                    <div class="aspiration-card-front">
                        <div class="card-bg" style="background-image: url('{{ $asp['front'] ?? '' }}');"></div>
                        <div class="card-content">
                            <h3>{{ $asp['title'] }}</h3>
                            <p><i class="fa-solid fa-chart-line"></i> {{ $asp['label'] }}</p>
                        </div>
                    </div>
                    <div class="aspiration-card-back">
                        <h3>{{ $asp['back_title'] ?? '' }}</h3>
                        <p>{{ $asp['back_text'] ?? '' }}</p>
                        <a href="{{ $asp['link'] ?? route('aspiration.show', $asp['slug'] ?? '') }}" class="view-aspiration-btn">View Aspiration <i class="fa-solid fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </section>

    <!-- Flagship Projects Section -->
    <section class="content-section flagship-section">
        <div class="section-header">
            <h2>Flagship Projects</h2>
            <a href="#" class="see-all">See All</a>
        </div>
        <div class="flagship-grid">
            @foreach($flagships as $flag)
            <div class="flagship-card">
                <div class="card-bg" style="background-image: url('{{ $flag['image'] ?? '' }}');"></div>
                <div class="card-content">
                    <div class="card-text-wrapper">
                        <h3>{{ $flag['title'] }}</h3>
                        <small>{{ $flag['subtitle'] }}</small>
                        <div class="card-hidden-content">
                            <p>{{ $flag['text'] }}</p>
                            <a href="{{ $flag['link'] ?? '#' }}" class="view-project-btn">View Project <i class="fa-solid fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </section>

@endsection
