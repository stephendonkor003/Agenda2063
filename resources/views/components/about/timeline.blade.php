@props(['items' => []])
<div class="timeline-section">
    <div class="section-header-center">
        <h2>Our Journey to 2063</h2>
        <p class="section-subtitle">Key milestones in Africa's transformation</p>
    </div>
    <div class="timeline">
        @foreach($items as $item)
            <div class="timeline-item {{ !empty($item['active']) ? 'active' : '' }}" data-period="{{ $item['period'] ?? '' }}">
                <div class="timeline-marker"></div>
                <div class="timeline-content">
                    <span class="timeline-year">{{ $item['period'] ?? '' }}</span>
                    <h4>{{ $item['title'] ?? '' }}</h4>
                    <p>{{ $item['text'] ?? '' }}</p>
                </div>
            </div>
        @endforeach
    </div>
</div>
