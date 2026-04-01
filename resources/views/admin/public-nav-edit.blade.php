@extends('layouts.admin')

@section('title', 'Edit Navigation Link')
@section('page-title', 'Edit Navigation Link')

@section('content')
    <div class="page-header-banner">
        <div class="page-header-text">
            <h1><i class="fa-solid fa-pen-to-square"></i> Edit Navigation Link</h1>
            <p>Update the menu label, destination URL, locale, and parent tab assignment.</p>
        </div>
        <div class="page-header-actions">
            <a class="btn-outline-admin" href="{{ route('admin.public.nav') }}"><i class="fa-solid fa-arrow-left"></i> Back to Navigation</a>
            <a class="btn-primary-admin" href="{{ route('admin.public.nav.design', $link) }}"><i class="fa-solid fa-palette"></i> Design Page</a>
        </div>
    </div>

    <div class="settings-card">
        <div class="settings-card-header">
            <h3>{{ $link->label }}</h3>
            <p>
                {{ strtoupper($link->locale) }} · {{ ucfirst($link->location) }}
                @if($childrenCount > 0)
                    · {{ $childrenCount }} child {{ \Illuminate\Support\Str::plural('link', $childrenCount) }}
                @endif
            </p>
        </div>
        <div class="settings-card-body">
            @if($childrenCount > 0)
                <div class="alert success">
                    <div class="alert-icon"><i class="fa-solid fa-diagram-project"></i></div>
                    <div class="alert-body">
                        This tab already has child links under it. You can safely edit its URL and label, but it must remain a top-level header tab in the same locale.
                    </div>
                </div>
            @endif

            @if($isProgrammeChild)
                <div class="alert success">
                    <div class="alert-icon"><i class="fa-solid fa-layer-group"></i></div>
                    <div class="alert-body">
                        This link is a programme submenu page. Keep the link URL internal, for example <code>/programmes/au-media-fellowship</code>. Add the external application platform under <strong>Design Page &gt; CTA URL</strong> so the public page keeps its own CMS content and Apply Now button.
                    </div>
                </div>
            @endif

            <form method="POST" action="{{ route('admin.public.nav.update', $link) }}">
                @csrf
                @method('PUT')

                <div class="settings-row">
                    <div class="settings-field">
                        <label for="label">Label</label>
                        <input id="label" type="text" name="label" class="settings-input" value="{{ old('label', $link->label) }}" required>
                    </div>
                    <div class="settings-field">
                        <label for="url">URL</label>
                        <input id="url" type="text" name="url" class="settings-input" value="{{ old('url', $link->url) }}" placeholder="/about, https:// or #" required>
                        <div class="settings-hint">
                            @if($isProgrammeChild)
                                Use an internal page path here. The external application domain should go in the page designer CTA fields.
                            @else
                                Use <code>#</code> for a dropdown-only tab, or set any internal/external URL if the tab should open a page.
                            @endif
                        </div>
                    </div>
                </div>

                <div class="settings-row">
                    <div class="settings-field">
                        <label for="location">Location</label>
                        <select id="navEditLocationSelect" name="location" class="settings-select">
                            <option value="header" @selected(old('location', $link->location) === 'header')>Header</option>
                            <option value="footer" @selected(old('location', $link->location) === 'footer')>Footer</option>
                        </select>
                    </div>
                    <div class="settings-field">
                        <label for="locale">Locale</label>
                        <select id="navEditLocaleSelect" name="locale" class="settings-select">
                            @foreach(['en' => 'English', 'fr' => 'Français', 'ar' => 'Arabic', 'pt' => 'Português'] as $code => $label)
                                <option value="{{ $code }}" @selected(old('locale', $link->locale) === $code)>{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="settings-row">
                    <div class="settings-field">
                        <label for="parent_id">Parent Link</label>
                        <select id="navEditParentSelect" name="parent_id" class="settings-select" data-has-children="{{ $childrenCount > 0 ? '1' : '0' }}">
                            <option value="">Top-level tab</option>
                            @foreach($parentOptions as $parentOption)
                                <option value="{{ $parentOption->id }}"
                                        data-locale="{{ $parentOption->locale }}"
                                        @selected((string) old('parent_id', $link->parent_id) === (string) $parentOption->id)>
                                    {{ strtoupper($parentOption->locale) }} · {{ $parentOption->label }}
                                </option>
                            @endforeach
                        </select>
                        <div class="settings-hint">To add more programmes under <strong>Programmes</strong>, create new links on the main navigation page and choose it here as the parent.</div>
                    </div>
                    <div class="settings-field">
                        <label for="position">Position</label>
                        <input id="position" type="number" name="position" class="settings-input" value="{{ old('position', $link->position) }}" min="0">
                    </div>
                </div>

                <div class="settings-row">
                    <div class="settings-field">
                        <label style="display:flex; align-items:center; gap:10px;">
                            <input type="checkbox" name="open_in_new_tab" value="1" @checked(old('open_in_new_tab', $link->open_in_new_tab))>
                            Open in new tab
                        </label>
                    </div>
                    <div class="settings-field">
                        <label style="display:flex; align-items:center; gap:10px;">
                            <input type="checkbox" name="is_active" value="1" @checked(old('is_active', $link->is_active))>
                            Active
                        </label>
                    </div>
                </div>

                <div style="display:flex; gap:12px; flex-wrap:wrap;">
                    <button class="btn-primary-admin" type="submit"><i class="fa-solid fa-save"></i> Save Changes</button>
                    <a class="btn-outline-admin" href="{{ route('admin.public.nav') }}">Cancel</a>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
    <script>
    document.addEventListener('DOMContentLoaded', () => {
        const locationSelect = document.getElementById('navEditLocationSelect');
        const localeSelect = document.getElementById('navEditLocaleSelect');
        const parentSelect = document.getElementById('navEditParentSelect');
        const hasChildren = parentSelect?.dataset.hasChildren === '1';

        function syncParentOptions() {
            if (!locationSelect || !localeSelect || !parentSelect) return;

            const isHeader = locationSelect.value === 'header';
            const activeLocale = localeSelect.value;

            parentSelect.disabled = !isHeader || hasChildren;

            Array.from(parentSelect.options).forEach(option => {
                if (!option.value) {
                    option.hidden = false;
                    return;
                }

                const matchesLocale = option.dataset.locale === activeLocale;
                option.hidden = !isHeader || !matchesLocale || hasChildren;

                if (option.hidden && option.selected) {
                    parentSelect.value = '';
                }
            });

            if (!isHeader || hasChildren) {
                parentSelect.value = '';
            }
        }

        syncParentOptions();
        locationSelect?.addEventListener('change', syncParentOptions);
        localeSelect?.addEventListener('change', syncParentOptions);
    });
    </script>
    @endpush
@endsection
