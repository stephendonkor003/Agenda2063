@props(['items' => []])
<div class="moonshots-section">
    <div class="section-header-center">
        <h2>Africa's Moon Shots</h2>
        <p class="section-subtitle">Ambitious goals that will transform Africa by 2063</p>
    </div>
    <div class="moonshots-grid">
        @foreach($items as $item)
            <div class="moonshot-card">
                <div class="moonshot-number">{{ $item['number'] ?? '' }}</div>
                <div class="moonshot-icon">
                    <i class="fa-solid {{ $item['icon'] ?? 'fa-circle' }}"></i>
                </div>
                <h4>{{ $item['title'] ?? '' }}</h4>
                <p>{{ $item['text'] ?? '' }}</p>
                <div class="moonshot-progress">
                    <div class="progress-bar">
                        <div class="progress-fill" style="width: {{ $item['progress'] ?? 0 }}%;"></div>
                    </div>
                    <span class="progress-label">{{ $item['progress'] ?? 0 }}% Progress</span>
                </div>
            </div>
        @endforeach
    </div>
</div>
