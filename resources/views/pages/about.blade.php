@extends('layouts.public')

@section('title', 'About - Agenda 2063')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/about.css') }}">
@endpush

@section('content')
    <x-about.hero :images="$aboutData['hero']['images'] ?? []"
                  :label="$aboutData['hero']['label'] ?? null"
                  :title="$aboutData['hero']['title'] ?? null"
                  :subtitle="$aboutData['hero']['subtitle'] ?? null" />

    <section class="about-content">
        <div class="content-wrapper">
            <div class="about-main-layout">
                <x-about.sidebar :items="$aboutData['sidebar'] ?? []" />

                <div class="about-main-content">
                    @foreach(($aboutData['sections'] ?? []) as $idx => $section)
                        <x-about.section :section="$section" :active="$idx===0" />
                    @endforeach
                </div>

                <x-about.sidebar-cards />
            </div>

            <x-about.moonshots :items="$aboutData['moonshots'] ?? []" />
            <x-about.timeline :items="$timelineItems ?? ($aboutData['timeline'] ?? [])" />
            <x-about.cta />
        </div>
    </section>

    <x-about.subscription />
@endsection
