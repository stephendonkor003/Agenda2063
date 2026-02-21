@extends('layouts.public')

@section('title', ($data['title'] ?? 'News Detail') . ' - Agenda 2063')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/news-detail.css') }}">
@endpush

@section('content')
    @php
        $heroImg = $data['image'] ?? asset('images/flagships/placeholder.svg');
    @endphp

    <section class="page-hero news-hero" id="pageHero">
        <div class="page-hero-bg active" style="background-image: url('{{ $heroImg }}');"></div>
        <div class="page-hero-content">
            <span class="hero-label">{{ $data['category'] ?? 'News' }}</span>
            <h1>{{ $data['title'] ?? '' }}</h1>
            <div class="hero-divider"></div>
            <div class="hero-meta">
                @if(!empty($data['date']))<span><i class="fa-solid fa-calendar"></i> {{ $data['date'] }}</span>@endif
                @if(!empty($data['location']))<span><i class="fa-solid fa-location-dot"></i> {{ $data['location'] }}</span>@endif
            </div>
        </div>
    </section>

    <section class="news-detail-section">
        <div class="content-wrapper">
            <div class="news-detail-layout">
                <article class="news-article">
                    <div class="article-body">
                        {!! $data['body'] !!}
                    </div>
                    @if(!empty($data['attachments']) && count($data['attachments']))
                        <div class="article-attachments">
                            <h3><i class="fa-solid fa-paperclip"></i> Downloads</h3>
                            <ul>
                                @foreach($data['attachments'] as $att)
                                    <li><a href="{{ $att['url'] }}" target="_blank" rel="noopener">{{ $att['label'] }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </article>

                <aside class="news-sidebar">
                    <div class="sidebar-card">
                        <h4>Share</h4>
                        <div class="share-actions">
                            <button class="share-btn" onclick="navigator.clipboard.writeText(window.location.href)"><i class="fa-solid fa-link"></i> Copy Link</button>
                            <a class="share-btn" target="_blank" rel="noopener" href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}&text={{ urlencode($data['title'] ?? '') }}"><i class="fa-brands fa-twitter"></i> Tweet</a>
                        </div>
                    </div>
                    @if(!empty($heroImg))
                        <div class="sidebar-card image-card">
                            <div class="sidebar-image" style="background-image:url('{{ $heroImg }}');"></div>
                        </div>
                    @endif
                </aside>
            </div>
        </div>
    </section>
@endsection
