@props(['images' => [], 'label' => null, 'title' => null, 'subtitle' => null])
<section class="page-hero" id="pageHero">
    @foreach($images as $i => $img)
        <div class="page-hero-bg {{ $i === 0 ? 'active' : '' }}" style="background-image: url('{{ $img }}');"></div>
    @endforeach
    <div class="page-hero-content">
        @if($label)<span class="hero-label">{{ $label }}</span>@endif
        @if($title)<h1>{{ $title }}</h1>@endif
        @if($subtitle)<div class="hero-divider"></div><p>{{ $subtitle }}</p>@endif
    </div>
</section>
