@extends('layouts.public')

@section('title', $aspiration['title'] ?? 'Aspiration')

@section('content')
@php
    $image = $aspiration['image'] ?? asset('images/flagships/Aspiration1.png');
    $label = $aspiration['label'] ?? 'Aspiration';
@endphp
<section class="page-hero aspiration-hero" style="position:relative; overflow:hidden;">
    <div class="page-hero-bg" style="background-image:url('{{ $image }}'); filter:brightness(.35);"></div>
    <div class="container hero-overlay">
        <p class="eyebrow">{{ $label }}</p>
        <h1>{{ $aspiration['title'] }}</h1>
        <p class="lead">{{ $aspiration['back_title'] ?? '' }}</p>
        <div class="hero-actions">
            <a class="btn-primary" href="{{ route('home') }}#aspirations">Back to Aspirations</a>
        </div>
    </div>
</section>

<section class="container aspiration-body">
    <div class="aspiration-content-card">
        <p>{{ $aspiration['body'] }}</p>
    </div>
</section>

@if($otherAspirations->count())
<section class="container other-aspirations">
    <div class="section-header">
        <h3>Explore the other aspirations</h3>
        <div class="slider-controls">
            <button class="slider-btn" id="aspPrev"><i class="fa-solid fa-arrow-left"></i></button>
            <button class="slider-btn" id="aspNext"><i class="fa-solid fa-arrow-right"></i></button>
        </div>
    </div>
    <div class="aspirations-slider" id="aspirationsSlider">
        @foreach($otherAspirations as $other)
            <a class="asp-card" href="{{ route('aspiration.show', $other['slug']) }}">
                <div class="asp-thumb" style="background-image:url('{{ $other['image'] ?? '' }}');"></div>
                <div class="asp-card-body">
                    <p class="asp-label">{{ $other['label'] ?? '' }}</p>
                    <h4>{{ $other['title'] ?? '' }}</h4>
                </div>
            </a>
        @endforeach
    </div>
</section>
@endif

@push('styles')
<style>
.aspiration-hero { color:#fff; padding:80px 0; }
.hero-overlay { position:relative; z-index:2; max-width:720px; }
.hero-overlay .eyebrow { letter-spacing:.08em; text-transform:uppercase; color:#bae6fd; font-weight:700; }
.hero-overlay h1 { margin:10px 0 8px; font-size:2.5rem; }
.hero-overlay .lead { font-size:1.1rem; color:#e2e8f0; }
.hero-actions .btn-primary { background:#0ea5e9; color:#fff; padding:10px 18px; border-radius:10px; display:inline-flex; gap:8px; align-items:center; text-decoration:none; }
.aspiration-content-card { background:#fff; border:1px solid #e2e8f0; border-radius:14px; padding:24px; box-shadow:0 12px 32px rgba(15,23,42,0.08); margin-top:-50px; position:relative; z-index:3; }
.aspiration-content-card p { margin:0; line-height:1.6; color:#0f172a; }
.other-aspirations { margin-top:40px; }
.other-aspirations .section-header { display:flex; justify-content:space-between; align-items:center; gap:12px; }
.slider-controls { display:flex; gap:8px; }
.slider-btn { border:1px solid #cbd5e1; background:#fff; border-radius:8px; padding:8px 10px; cursor:pointer; color:#0f172a; }
.aspirations-slider { display:flex; gap:14px; overflow-x:auto; padding-bottom:6px; scroll-behavior:smooth; }
.aspirations-slider::-webkit-scrollbar { height:8px; }
.aspirations-slider::-webkit-scrollbar-thumb { background:#cbd5e1; border-radius:999px; }
.asp-card { min-width:220px; background:#fff; border:1px solid #e2e8f0; border-radius:12px; box-shadow:0 8px 20px rgba(0,0,0,0.06); text-decoration:none; color:#0f172a; overflow:hidden; }
.asp-thumb { height:120px; background-size:cover; background-position:center; }
.asp-card-body { padding:12px; }
.asp-label { color:#0ea5e9; font-weight:700; font-size:12px; margin:0 0 6px; text-transform:uppercase; }
.asp-card h4 { margin:0; font-size:16px; }
@media (max-width:768px){ .hero-overlay h1{font-size:2rem;} .aspirations-slider{padding-bottom:12px;} }
</style>
@endpush

@push('scripts')
<script>
(function(){
    const slider = document.getElementById('aspirationsSlider');
    const prev = document.getElementById('aspPrev');
    const next = document.getElementById('aspNext');
    if (!slider || !prev || !next) return;
    const step = 260;
    prev.addEventListener('click', () => slider.scrollBy({left: -step, behavior:'smooth'}));
    next.addEventListener('click', () => slider.scrollBy({left: step, behavior:'smooth'}));
})();
</script>
@endpush

@endsection

