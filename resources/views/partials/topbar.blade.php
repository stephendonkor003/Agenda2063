<!-- Top Bar -->
<div class="top-bar">
    <div class="news-ticker">
        <span class="news-badge">NEWS</span>
        <div class="ticker-wrapper">
            <div class="ticker-content">
                <a href="{{ url('/news') }}">Agenda 2063 &bull; African Union Delegation Visits Sahrawi Arab Democratic Republic to Strengthen Bilateral Ties and Discuss Regional Security...</a>
            </div>
        </div>
    </div>
    <div class="top-bar-actions">
        <div class="nav-arrows">
            <button><i class="fa-solid fa-chevron-left"></i></button>
            <button><i class="fa-solid fa-chevron-right"></i></button>
        </div>
        @php
            $langs = [
                'en' => 'English',
                'fr' => 'Français',
                'ar' => 'العربية',
                'sw' => 'Kiswahili',
                'pt' => 'Português',
                'es' => 'Español',
            ];
            $current = app()->getLocale();
        @endphp
        <div class="language-selector">
            @foreach($langs as $code => $label)
                @if(!$loop->first)<span>|</span>@endif
                @if($code === $current)
                    <span class="lang-active">{{ $label }}</span>
                @else
                    <a href="{{ url('/locale/'.$code) }}" class="lang-link">{{ $label }}</a>
                @endif
            @endforeach
        </div>
    </div>
</div>
