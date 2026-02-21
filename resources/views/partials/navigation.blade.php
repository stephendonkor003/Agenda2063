<!-- Navigation (driven from admin > Public Visibility > Navigation) -->
@php
    $links = $navLinks ?? collect();
@endphp
<nav class="main-nav" id="mainNav">
    <ul>
        @forelse($links as $link)
            @php
                $rawUrl = trim($link->url ?? '');
                $isExternal = preg_match('/^(https?:)?\\/\\//i', $rawUrl);
                $isSpecial = str_starts_with($rawUrl, '#') || str_starts_with($rawUrl, 'mailto:') || str_starts_with($rawUrl, 'tel:');
                $href = ($rawUrl && !$isExternal && !$isSpecial) ? url($rawUrl) : $rawUrl;
                $isActive = $href ? url()->current() === $href : false;
            @endphp
            <li>
                <a href="{{ $href }}"
                   class="{{ $isActive ? 'active' : '' }}"
                   target="{{ $link->open_in_new_tab ? '_blank' : '_self' }}"
                   rel="{{ $link->open_in_new_tab ? 'noopener' : '' }}">
                    {{ $link->label }}
                </a>
            </li>
        @empty
            <!-- Fallback when no links configured yet -->
            <li><a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Home</a></li>
            <li><a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'active' : '' }}">About</a></li>
            <li><a href="{{ route('flagship-projects') }}" class="{{ request()->routeIs('flagship-projects') ? 'active' : '' }}">Flagship Projects</a></li>
            <li><a href="{{ route('news') }}" class="{{ request()->routeIs('news*') ? 'active' : '' }}">News & Events</a></li>
            <li><a href="{{ route('knowledge-base') }}" class="{{ request()->routeIs('knowledge-base') ? 'active' : '' }}">Knowledge</a></li>
        @endforelse
        @php
            $locales = ['en'=>'EN','fr'=>'FR','pt'=>'PT','ar'=>'AR'];
            $current = app()->getLocale();
        @endphp
        <li class="locale-switcher">
            <span class="locale-label"><i class="fa-solid fa-globe"></i></span>
            <select onchange="window.location='{{ url('/locale') }}/'+this.value" aria-label="Language selector">
                @foreach($locales as $code => $label)
                    <option value="{{ $code }}" {{ $code === $current ? 'selected' : '' }}>{{ $label }}</option>
                @endforeach
            </select>
        </li>
    </ul>
</nav>
