@php
    $iosStoreUrl = config('app.mobile_app.ios_store_url');
    $androidStoreUrl = config('app.mobile_app.android_store_url');
    $languageLabels = [
        'en' => 'EN',
        'fr' => 'FR',
        'ar' => 'AR',
        'sw' => 'SW',
        'pt' => 'PT',
        'es' => 'ES',
    ];
    $supportedLocales = config('app.supported_locales', ['en', 'fr', 'pt', 'ar']);
    $headerLocales = collect($supportedLocales)->mapWithKeys(function ($code) use ($languageLabels) {
        return [$code => $languageLabels[$code] ?? strtoupper($code)];
    });
    $currentLocale = app()->getLocale();
@endphp

<!-- Main Header -->
<header class="main-header">
    <div class="logo-container">
        <img src="https://c.animaapp.com/mlex63tv0vlvAW/assets/aulogo.png" alt="African Union Logo" class="au-logo">
        <div class="social-icons">
            <a href="#"><i class="fa-brands fa-twitter"></i></a>
            <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
            <a href="#"><i class="fa-brands fa-youtube"></i></a>
            <a href="#"><i class="fa-brands fa-instagram"></i></a>
            <a href="#"><i class="fa-brands fa-linkedin-in"></i></a>
        </div>
    </div>

    <div class="agenda-logo-container">
        <div class="app-download-promo">
            <span>Mobile App version is available on iOS and Android</span>
            <div class="app-store-badges">
                <a href="{{ $iosStoreUrl }}" target="_blank" rel="noopener">
                    <i class="fa-brands fa-app-store-ios"></i> App Store
                </a>
                <a href="{{ $androidStoreUrl }}" target="_blank" rel="noopener">
                    <i class="fa-brands fa-google-play"></i> Google Play
                </a>
            </div>
        </div>
        <img src="https://c.animaapp.com/mlex63tv0vlvAW/assets/agenda_2063_logo.png" alt="Agenda 2063 Logo" class="agenda-logo">
    </div>

    <div class="mobile-language-switcher">
        <i class="fa-solid fa-globe"></i>
        <select onchange="window.location='{{ url('/locale') }}/'+this.value" aria-label="Language selector">
            @foreach($headerLocales as $code => $label)
                <option value="{{ $code }}" @selected($code === $currentLocale)>{{ $label }}</option>
            @endforeach
        </select>
    </div>

    <button class="mobile-menu-toggle" id="mobileMenuToggle">
        <i class="fa-solid fa-bars"></i>
    </button>
</header>
