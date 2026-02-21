@extends('layouts.public')

@section('title', $flagshipData['hero']['title'] ?? 'Flagship Projects - Agenda 2063')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/about.css') }}">
@endpush

@section('content')
    <x-about.hero :images="$flagshipData['hero']['images'] ?? []"
                  :label="$flagshipData['hero']['label'] ?? 'Flagship Projects'"
                  :title="$flagshipData['hero']['title'] ?? 'Flagship Projects'"
                  :subtitle="$flagshipData['hero']['subtitle'] ?? ''" />

    <section class="about-content">
        <div class="content-wrapper">
            <div class="about-main-layout">
                <x-about.sidebar :items="$flagshipData['sidebar'] ?? []" />

                <div class="about-main-content">
                    @foreach(($flagshipData['sections'] ?? []) as $idx => $section)
                        <x-about.section :section="$section" :active="$idx===0" />
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endsection
