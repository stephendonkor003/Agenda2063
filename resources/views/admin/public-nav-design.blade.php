@extends('layouts.admin')

@section('title', 'Design: ' . $link->label)
@section('page-title', 'Design Page for "' . $link->label . '"')

@section('content')
    <div class="page-header-banner">
        <div class="page-header-text">
            <h1><i class="fa-solid fa-pen-ruler"></i> Page Designer</h1>
            <p>Configure the hero, components, and body for this page.</p>
        </div>
    </div>

    @if(session('status'))
        <div class="alert success"><div class="alert-icon"><i class="fa-solid fa-check-circle"></i></div><div class="alert-body">{{ session('status') }}</div></div>
    @endif
    @if($errors->any())
        <div class="alert danger"><div class="alert-icon"><i class="fa-solid fa-circle-exclamation"></i></div><div class="alert-body">{{ $errors->first() }}</div></div>
    @endif

    <div class="settings-card">
        <div class="settings-card-header">
            <h3>Hero & Body</h3>
            <p>Content will be used on the public page linked to {{ $link->label }}.</p>
        </div>
        <div class="settings-card-body">
            <form method="POST" action="{{ route('admin.public.nav.design.save', $link) }}" id="pageDesignForm" enctype="multipart/form-data">
                @csrf
                <div class="settings-row">
                    <div class="settings-field" style="min-width:280px;">
                        <label>Hero Title</label>
                        <input type="text" name="hero_title" class="settings-input" value="{{ old('hero_title', $meta['hero_title']) }}" maxlength="255">
                    </div>
                    <div class="settings-field" style="min-width:280px;">
                        <label>Hero Subtitle</label>
                        <input type="text" name="hero_subtitle" class="settings-input" value="{{ old('hero_subtitle', $meta['hero_subtitle']) }}" maxlength="500">
                    </div>
                </div>
                <div class="settings-row">
                    <div class="settings-field" style="min-width:180px;">
                        <label>Hero Background Color</label>
                        <input type="text" name="hero_bg" class="settings-input" value="{{ old('hero_bg', $meta['hero_bg']) }}" placeholder="#0f172a">
                    </div>
                    <div class="settings-field" style="min-width:180px;">
                        <label>Hero Text Color</label>
                        <input type="text" name="hero_text" class="settings-input" value="{{ old('hero_text', $meta['hero_text']) }}" placeholder="#ffffff">
                    </div>
                </div>
                <div class="settings-row">
                    <div class="settings-field" style="min-width:240px;">
                        <label>CTA Label</label>
                        <input type="text" name="cta_label" class="settings-input" value="{{ old('cta_label', $meta['cta_label']) }}" maxlength="255">
                    </div>
                    <div class="settings-field" style="min-width:320px;">
                        <label>CTA URL</label>
                        <input type="text" name="cta_url" class="settings-input" value="{{ old('cta_url', $meta['cta_url']) }}" maxlength="1024" placeholder="/about or https://">
                    </div>
                </div>
                <div class="settings-field">
                    <label>Body (HTML allowed)</label>
                    <textarea name="body_html" class="settings-textarea" rows="10">{{ old('body_html', $meta['body_html']) }}</textarea>
                </div>

                <hr>
                <div class="component-builder">
                    <div class="component-library">
                        <h3>Component Library</h3>
                        <p>Drag or click "Add" to include sections.</p>
                        <div class="component-item" data-type="hero_slider">Hero Slider</div>
                        <div class="component-item" data-type="about_page">About Page</div>
                        <div class="component-item" data-type="timeline">Our Journey (Timeline)</div>
                        <div class="component-item" data-type="flagship_page">Flagship Page</div>
                        <div class="component-item" data-type="aspirations">Aspirations Section</div>
                        <div class="component-item" data-type="flagships">Flagship Projects</div>
                        <div class="component-item" data-type="press">Press Releases</div>
                        <div class="component-item" data-type="quiz">Test Your Knowledge</div>
                        <div class="component-item" data-type="richtext">Rich Text Block</div>
                    </div>
                    <div class="component-canvas">
                        <h3>Page Structure</h3>
                        <ol id="componentList"></ol>
                        <input type="hidden" name="components_json" id="componentsJson" value="{{ old('components_json', json_encode($meta['components'] ?? [])) }}">
                        <div id="componentEditor" class="component-editor">
                            <div class="editor-empty">Select a component to edit its content.</div>
                        </div>
                    </div>
                </div>

                <div class="settings-card-footer" style="margin-top:16px;">
                    <button class="btn-primary-admin" type="submit"><i class="fa-solid fa-save"></i> Save Page</button>
                    <a class="btn-outline-admin" href="{{ route('admin.public.nav') }}"><i class="fa-solid fa-arrow-left"></i> Back to Navigation</a>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('styles')
@include('admin._nav_design_styles')
@endpush

@push('scripts')
@include('admin._nav_design_scripts')
@endpush
