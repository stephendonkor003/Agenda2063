@props([
    'title' => 'Join the Movement',
    'description' => "Be part of Africa's transformation. Together, we can build the Africa we want.",
    'buttons' => [],
])

@php
    $buttons = collect($buttons)
        ->filter(fn ($button) => is_array($button) && filled($button['label'] ?? null) && filled($button['link'] ?? null))
        ->values();

    if ($buttons->isEmpty()) {
        $buttons = collect([
            ['label' => 'Get Involved', 'link' => '#', 'style' => 'primary', 'icon' => 'fa-hands-helping'],
            ['label' => 'Download Resources', 'link' => '#', 'style' => 'secondary', 'icon' => 'fa-download'],
        ]);
    }
@endphp

<div class="cta-section">
    <div class="cta-content">
        <h2>{{ $title }}</h2>
        <p>{{ $description }}</p>
        <div class="cta-buttons">
            @foreach($buttons as $button)
                <a href="{{ $button['link'] }}"
                   class="cta-btn {{ $button['style'] ?? ($loop->first ? 'primary' : 'secondary') }}">
                    @if(!empty($button['icon']))
                        <i class="fa-solid {{ $button['icon'] }}"></i>
                    @endif
                    {{ $button['label'] }}
                </a>
            @endforeach
        </div>
    </div>
</div>
