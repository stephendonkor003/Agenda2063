@extends('layouts.public')

@section('title', ($pageData['hero']['title'] ?? $link->label) . ' - Agenda 2063')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/about.css') }}">
@endpush

@section('content')
    <x-about.hero :images="$pageData['hero']['images'] ?? []"
                  :label="$pageData['hero']['label'] ?? null"
                  :title="$pageData['hero']['title'] ?? $link->label"
                  :subtitle="$pageData['hero']['subtitle'] ?? null" />

    <section class="about-content programme-page">
        <div class="content-wrapper">
            <div class="about-main-layout programme-main-layout">
                <x-about.sidebar :items="$pageData['sidebar'] ?? []" />

                <div class="about-main-content">
                    @foreach(($pageData['blocks'] ?? []) as $block)
                        @if(($block['type'] ?? '') === 'section')
                            <x-about.section :section="$block['section']" :active="$loop->first" />
                        @else
                            <article id="{{ $block['id'] }}"
                                     class="content-block programme-html-block {{ $loop->first ? 'active' : '' }}"
                                     data-section="{{ $block['id'] }}">
                                @if(!empty($block['heading']))
                                    <h2>{{ $block['heading'] }}</h2>
                                @endif
                                <div class="programme-html-copy">
                                    {!! $block['body'] !!}
                                </div>
                            </article>
                        @endif
                    @endforeach
                </div>

                <aside class="programme-sidebar">
                    @if(!empty($pageData['cta']['enabled']) || !empty($pageData['cta']['show_placeholder']))
                        <div class="programme-apply-card">
                            <span class="programme-card-eyebrow">{{ $pageData['cta']['eyebrow'] ?? 'Quick Action' }}</span>
                            <h3>{{ $pageData['cta']['title'] ?? $link->label }}</h3>
                            <p>
                                {{ $pageData['cta']['description'] ?? '' }}
                                @if(!empty($pageData['cta']['host']))
                                    The next step continues on <strong>{{ $pageData['cta']['host'] }}</strong>.
                                @endif
                            </p>

                            @if(!empty($pageData['cta']['enabled']))
                                <a href="{{ $pageData['cta']['url'] }}" class="programme-apply-btn">
                                    <span>{{ $pageData['cta']['label'] }}</span>
                                    <i class="fa-solid fa-arrow-up-right-from-square" aria-hidden="true"></i>
                                </a>
                            @elseif(!empty($pageData['cta']['show_placeholder']))
                                <div class="programme-apply-pending">
                                    {{ $pageData['cta']['placeholder'] ?? 'The action URL has not been configured yet.' }}
                                </div>
                            @endif

                            @if(!empty($pageData['cta']['note']))
                                <p class="programme-apply-note">{{ $pageData['cta']['note'] }}</p>
                            @endif
                        </div>
                    @endif

                    @if(!empty($pageData['info_card']['items']))
                        <div class="programme-meta-card">
                            <span class="programme-card-eyebrow">{{ $pageData['info_card']['eyebrow'] ?? 'Page Details' }}</span>
                            <ul class="programme-meta-list">
                                @foreach($pageData['info_card']['items'] as $item)
                                    <li>
                                        <strong>{{ $item['label'] }}</strong>
                                        <span>{{ $item['value'] }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </aside>
            </div>

            @if(!empty($pageData['timeline']['items']))
                <x-about.timeline :items="$pageData['timeline']['items']"
                                  :title="$pageData['timeline']['title'] ?? 'Programme Journey'"
                                  :subtitle="$pageData['timeline']['subtitle'] ?? ''" />
            @endif
        </div>
    </section>
@endsection
