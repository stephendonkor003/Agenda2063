<!-- Navigation (driven from admin > Public Visibility > Navigation) -->
@php
    $links = $navLinks ?? collect();
    $buildHref = function ($value) {
        $rawUrl = trim((string) ($value ?? ''));
        $isExternal = preg_match('/^(https?:)?\\/\\//i', $rawUrl);
        $isSpecial = str_starts_with($rawUrl, '#') || str_starts_with($rawUrl, 'mailto:') || str_starts_with($rawUrl, 'tel:');
        $href = ($rawUrl && !$isExternal && !$isSpecial) ? url($rawUrl) : $rawUrl;

        return [$rawUrl, $href];
    };
@endphp
<nav class="main-nav" id="mainNav">
    <ul>
        @forelse($links as $link)
            @php
                [$rawUrl, $href] = $buildHref($link->url);
                $children = ($link instanceof \Illuminate\Database\Eloquent\Model && $link->relationLoaded('children'))
                    ? collect($link->children)
                    : collect();
                $children = $children->map(function ($child) use ($buildHref) {
                    [$childRawUrl, $childHref] = $buildHref($child->url);

                    return [
                        'model' => $child,
                        'rawUrl' => $childRawUrl,
                        'href' => $childHref,
                        'isActive' => $childHref ? url()->current() === $childHref : false,
                    ];
                });
                $hasChildren = $children->isNotEmpty();
                $isActive = $href ? url()->current() === $href : false;
                $isActive = $isActive || $children->contains(fn ($child) => $child['isActive']);
            @endphp
            <li class="{{ $hasChildren ? 'has-dropdown nav-has-children' : '' }}">
                <a href="{{ $href }}"
                   class="{{ $isActive ? 'active' : '' }}"
                   target="{{ $link->open_in_new_tab ? '_blank' : '_self' }}"
                   rel="{{ $link->open_in_new_tab ? 'noopener' : '' }}"
                   @if($hasChildren) aria-haspopup="true" aria-expanded="false" @endif>
                    <span>{{ $link->label }}</span>
                    @if($hasChildren)
                        <i class="fa-solid fa-chevron-down" aria-hidden="true"></i>
                    @endif
                </a>
                @if($hasChildren)
                    <div class="mega-dropdown menu-dropdown">
                        <div class="dropdown-column">
                            <h4>{{ $link->label }}</h4>
                            @if($rawUrl && $rawUrl !== '#')
                                <a href="{{ $href }}"
                                   class="nav-dropdown-overview"
                                   target="{{ $link->open_in_new_tab ? '_blank' : '_self' }}"
                                   rel="{{ $link->open_in_new_tab ? 'noopener' : '' }}">
                                    <span>Open {{ $link->label }}</span>
                                    <i class="fa-solid fa-arrow-up-right-from-square" aria-hidden="true"></i>
                                </a>
                            @endif
                            <ul class="nav-dropdown-links">
                                @foreach($children as $child)
                                    @php $item = $child['model']; @endphp
                                    <li>
                                        <a href="{{ $child['href'] }}"
                                           class="{{ $child['isActive'] ? 'active' : '' }}"
                                           target="{{ $item->open_in_new_tab ? '_blank' : '_self' }}"
                                           rel="{{ $item->open_in_new_tab ? 'noopener' : '' }}">
                                            <span class="nav-dropdown-label">{{ $item->label }}</span>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif
            </li>
        @empty
            <!-- Fallback when no links configured yet -->
            <li><a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Home</a></li>
            <li><a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'active' : '' }}">About</a></li>
            <li><a href="{{ route('flagship-projects') }}" class="{{ request()->routeIs('flagship-projects') ? 'active' : '' }}">Flagship Projects</a></li>
            <li><a href="{{ route('news') }}" class="{{ request()->routeIs('news*') ? 'active' : '' }}">News & Events</a></li>
            <li><a href="{{ route('knowledge-base') }}" class="{{ request()->routeIs('knowledge-base') ? 'active' : '' }}">Knowledge</a></li>
        @endforelse
    </ul>
</nav>
