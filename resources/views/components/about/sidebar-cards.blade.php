@props(['cards' => []])

@php
    $defaultCards = [
        [
            'section_id' => 'overview',
            'title' => "Chairperson's Message",
            'headline' => 'H.E. Mahmoud Ali Youssouf',
            'subheadline' => 'Chairperson of the African Union Commission',
            'body' => "Agenda 2063 represents our collective vision for a prosperous, integrated, and peaceful Africa. Together, we are building the Africa we want.",
            'image_url' => asset('images/flagships/Aspiration1.png'),
            'icon' => 'fa-quote-left',
            'link' => '',
        ],
        [
            'section_id' => 'goals',
            'title' => 'Priority Goals',
            'headline' => '20 Goals for Transformation',
            'subheadline' => 'Comprehensive Development Framework',
            'body' => "Our 20 goals cover every aspect of Africa's development - from economic prosperity to social inclusion, from infrastructure to innovation, ensuring no one is left behind.",
            'image_url' => asset('images/flagships/Aspiration2.png'),
            'icon' => 'fa-bullseye',
            'link' => '',
        ],
        [
            'section_id' => 'implementation',
            'title' => 'Implementation Progress',
            'headline' => 'First Decade Achievements',
            'subheadline' => '2014-2023 Implementation Plan',
            'body' => "The first ten years have laid a strong foundation. We've made significant progress in trade integration, infrastructure development, and regional cooperation.",
            'image_url' => asset('images/flagships/au5.jpg'),
            'icon' => 'fa-chart-line',
            'link' => '',
        ],
        [
            'section_id' => 'flagship',
            'title' => 'Flagship Projects',
            'headline' => 'Transformative Initiatives',
            'subheadline' => 'Game-Changing Projects',
            'body' => "Our flagship projects are catalyzing Africa's transformation - from the AfCFTA creating a single market to high-speed rail connecting our cities.",
            'image_url' => asset('images/flagships/au6.jpg'),
            'icon' => 'fa-rocket',
            'link' => '',
        ],
        [
            'section_id' => 'national',
            'title' => 'National Integration',
            'headline' => 'Country-Level Implementation',
            'subheadline' => 'Localized Development Plans',
            'body' => 'Every member state has aligned their national plans with Agenda 2063, ensuring continental vision translates into local action and impact.',
            'image_url' => asset('images/flagships/Aspiration3.png'),
            'icon' => 'fa-flag',
            'link' => '',
        ],
        [
            'section_id' => 'frameworks',
            'title' => 'Continental Frameworks',
            'headline' => 'Guiding Policies',
            'subheadline' => 'Strategic Policy Frameworks',
            'body' => 'Our continental frameworks provide the roadmap for coordinated action across sectors - from governance to agriculture, from peace to innovation.',
            'image_url' => asset('images/flagships/Aspiration4.png'),
            'icon' => 'fa-book',
            'link' => '',
        ],
        [
            'section_id' => 'outcomes',
            'title' => 'Expected Outcomes',
            'headline' => 'Transformational Results',
            'subheadline' => 'The Africa We Want by 2063',
            'body' => 'By 2063, Africa will be prosperous, integrated, peaceful, and influential - a continent where every citizen enjoys dignity, opportunity, and prosperity.',
            'image_url' => asset('images/flagships/Aspiration7.png'),
            'icon' => 'fa-trophy',
            'link' => '',
        ],
    ];

    $cards = collect($cards)
        ->filter(fn ($card) => is_array($card) && filled($card['section_id'] ?? null))
        ->values();

    if ($cards->isEmpty()) {
        $cards = collect($defaultCards);
    }

    $placeholderImage = asset('images/flagships/placeholder.svg');
@endphp

<aside class="chairperson-sidebar">
    @foreach($cards as $index => $card)
        <div class="chairperson-card" data-card="{{ $card['section_id'] ?? '' }}" @if($index > 0) style="display: none;" @endif>
            @if(!empty($card['title']))
                <h3>{{ $card['title'] }}</h3>
            @endif

            <div class="chairperson-image-wrapper">
                <img src="{{ $card['image_url'] ?? $placeholderImage }}"
                     alt="{{ $card['headline'] ?? ($card['title'] ?? 'Agenda 2063') }}"
                     class="chairperson-image">
            </div>

            @if(!empty($card['headline']))
                <h4>{{ $card['headline'] }}</h4>
            @endif

            @if(!empty($card['subheadline']))
                <p class="chairperson-title">{{ $card['subheadline'] }}</p>
            @endif

            @if(!empty($card['body']))
                <blockquote class="chairperson-quote">
                    <i class="fa-solid {{ $card['icon'] ?? 'fa-quote-left' }} quote-icon"></i>
                    <p>{{ $card['body'] }}</p>
                </blockquote>
            @endif

            @if(!empty($card['link']))
                <a href="{{ $card['link'] }}" class="read-more-arrow" aria-label="{{ $card['button_label'] ?? 'Read more' }}">
                    <i class="fa-solid fa-arrow-right"></i>
                </a>
            @else
                <button type="button" class="read-more-arrow" aria-hidden="true">
                    <i class="fa-solid fa-arrow-right"></i>
                </button>
            @endif
        </div>
    @endforeach
</aside>
