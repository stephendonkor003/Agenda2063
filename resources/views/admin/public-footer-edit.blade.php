@extends('layouts.admin')

@section('title', 'Edit Footer Link')
@section('page-title', 'Edit Footer Link')

@section('content')
    @php
        $isInternalUrl = str_starts_with($link->url, '/');
    @endphp

    <div class="page-header-banner">
        <div class="page-header-text">
            <h1><i class="fa-solid fa-pen-to-square"></i> Edit Footer Link</h1>
            <p>Update the footer label, destination, section, locale, and visibility.</p>
        </div>
        <div class="page-header-actions">
            <a class="btn-outline-admin" href="{{ route('admin.public.footer') }}"><i class="fa-solid fa-arrow-left"></i> Back to Footer Links</a>
            <a class="btn-primary-admin" href="{{ route('admin.public.footer.design', $link) }}"><i class="fa-solid fa-palette"></i> Design Page</a>
        </div>
    </div>

    <div class="settings-card">
        <div class="settings-card-header">
            <h3>{{ $link->label }}</h3>
            <p>{{ strtoupper($link->locale) }} · {{ ucfirst($link->section) }}</p>
        </div>
        <div class="settings-card-body">
            @if($isInternalUrl)
                <div class="alert success">
                    <div class="alert-icon"><i class="fa-solid fa-file-lines"></i></div>
                    <div class="alert-body">
                        This footer link uses an internal path, so it can open a CMS-managed public page. Use <strong>Design Page</strong> to control the page content.
                    </div>
                </div>
            @else
                <div class="alert success">
                    <div class="alert-icon"><i class="fa-solid fa-arrow-up-right-from-square"></i></div>
                    <div class="alert-body">
                        This footer link points outside the platform. Change it to an internal path such as <code>/contact</code> if you want a full editable page on this site.
                    </div>
                </div>
            @endif

            <form method="POST" action="{{ route('admin.public.footer.update', $link) }}">
                @csrf
                @method('PUT')

                <div class="settings-row">
                    <div class="settings-field">
                        <label for="label">Label</label>
                        <input id="label" type="text" name="label" class="settings-input" value="{{ old('label', $link->label) }}" required>
                    </div>
                    <div class="settings-field">
                        <label for="url">URL</label>
                        <input id="url" type="text" name="url" class="settings-input" value="{{ old('url', $link->url) }}" placeholder="/contact or https://" required>
                        <div class="settings-hint">Internal paths render editable platform pages. External URLs open the destination directly.</div>
                    </div>
                </div>

                <div class="settings-row">
                    <div class="settings-field">
                        <label for="section">Section</label>
                        <input id="section" type="text" name="section" class="settings-input" value="{{ old('section', $link->section) }}" placeholder="legal, resources, social" required>
                    </div>
                    <div class="settings-field">
                        <label for="locale">Locale</label>
                        <select id="locale" name="locale" class="settings-select">
                            @foreach(['en' => 'English', 'fr' => 'Français', 'ar' => 'Arabic', 'pt' => 'Português'] as $code => $label)
                                <option value="{{ $code }}" @selected(old('locale', $link->locale) === $code)>{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="settings-row">
                    <div class="settings-field">
                        <label for="position">Position</label>
                        <input id="position" type="number" name="position" class="settings-input" value="{{ old('position', $link->position) }}" min="0">
                    </div>
                    <div class="settings-field">
                        <label style="display:flex; align-items:center; gap:10px;">
                            <input type="checkbox" name="open_in_new_tab" value="1" @checked(old('open_in_new_tab', $link->open_in_new_tab))>
                            Open in new tab
                        </label>
                        <label style="display:flex; align-items:center; gap:10px; margin-top:12px;">
                            <input type="checkbox" name="is_active" value="1" @checked(old('is_active', $link->is_active))>
                            Active
                        </label>
                    </div>
                </div>

                <div style="display:flex; gap:12px; flex-wrap:wrap;">
                    <button class="btn-primary-admin" type="submit"><i class="fa-solid fa-save"></i> Save Changes</button>
                    <a class="btn-outline-admin" href="{{ route('admin.public.footer') }}">Cancel</a>
                </div>
            </form>
        </div>
    </div>
@endsection
