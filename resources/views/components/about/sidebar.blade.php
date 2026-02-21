@props(['items' => []])
<aside class="about-sidebar">
    <nav class="sidebar-nav">
        @foreach($items as $i => $item)
            <a href="#{{ $item['id'] ?? '' }}" class="sidebar-link {{ $i === 0 ? 'active' : '' }}">
                <span class="link-text">{{ $item['label'] ?? '' }}</span>
            </a>
        @endforeach
    </nav>
</aside>
