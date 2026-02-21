@props(['section', 'active' => false])
<section id="{{ $section['id'] ?? '' }}" class="content-block {{ $active ? 'active' : '' }}" data-section="{{ $section['id'] ?? '' }}">
    <div class="section-flex">
        <div class="section-copy">
            <h2>{{ $section['title'] ?? '' }}</h2>
            @if(!empty($section['intro']))<p class="intro-text">{{ $section['intro'] }}</p>@endif
            @if(!empty($section['paragraphs']))
                <div class="genesis-content">
                    @foreach($section['paragraphs'] as $p)
                        <p>{{ $p }}</p>
                    @endforeach
                </div>
            @endif
            @if(!empty($section['tags']))
                <div class="section-tags">
                    @foreach($section['tags'] as $tag)
                        <span class="tag-pill">{{ $tag }}</span>
                    @endforeach
                    @if(!empty($section['tags']))
                        <a class="tag-link" href="{{ route('news') }}?tags={{ urlencode(implode(',', $section['tags'])) }}">Related news & events</a>
                    @endif
                </div>
            @endif
        </div>
        @if(!empty($section['image_url']))
            <div class="section-media">
                <div class="section-img" style="background-image:url('{{ $section['image_url'] }}');"></div>
            </div>
        @endif
    </div>
</section>
