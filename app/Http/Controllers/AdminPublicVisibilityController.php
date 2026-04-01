<?php

namespace App\Http\Controllers;

use App\Models\NavigationLink;
use App\Models\HomeSlider;
use App\Models\FooterLink;
use App\Models\PublicVisibilityRevision;
use App\Rules\SafeUrl;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class AdminPublicVisibilityController extends Controller
{
    public function navigation(Request $request)
    {
        $links = NavigationLink::with('parent')
            ->orderBy('location')
            ->orderByRaw('CASE WHEN parent_id IS NULL THEN id ELSE parent_id END')
            ->orderByRaw('CASE WHEN parent_id IS NULL THEN 0 ELSE 1 END')
            ->orderBy('position')
            ->get();

        $parentOptions = NavigationLink::query()
            ->where('location', 'header')
            ->whereNull('parent_id')
            ->orderBy('locale')
            ->orderBy('label')
            ->get();

        return view('admin.public-nav', compact('links', 'parentOptions'));
    }

    public function editNav(NavigationLink $link)
    {
        $parentOptions = NavigationLink::query()
            ->where('location', 'header')
            ->whereNull('parent_id')
            ->whereKeyNot($link->id)
            ->orderBy('locale')
            ->orderBy('label')
            ->get();

        $childrenCount = $link->children()->count();
        $isProgrammeChild = $this->isProgrammesParent($link->parent);

        return view('admin.public-nav-edit', compact('link', 'parentOptions', 'childrenCount', 'isProgrammeChild'));
    }

    public function designNav(NavigationLink $link)
    {
        $isProgrammeChild = $this->isProgrammesParent($link->parent);
        $meta = $link->page_meta ?? [];

        if ($isProgrammeChild && $meta === []) {
            $meta = $this->defaultProgrammePageMeta($link);
        }

        $meta = $this->preparePageDesignerMeta($meta);
        return view('admin.public-nav-design', compact('link', 'meta', 'isProgrammeChild'));
    }

    public function saveDesignNav(Request $request, NavigationLink $link)
    {
        $pageMeta = $this->buildPageMetaFromRequest($request, $link->page_meta ?? []);
        $link->update(['page_meta' => $pageMeta]);
        PublicVisibilityRevision::record('navigation_link', $link->id, $link->toArray(), $request->user());

        return back()->with('status', 'Page design saved.');
    }

    public function storeNav(Request $request)
    {
        $data = $request->validate([
            'label' => ['required','string','max:255'],
            'url' => ['required', new SafeUrl(true), 'max:1024'],
            'location' => ['required','in:header,footer'],
            'locale' => ['nullable','string','max:10'],
            'position' => ['nullable','integer','min:0'],
            'parent_id' => ['nullable','integer','exists:navigation_links,id'],
            'open_in_new_tab' => ['sometimes','boolean'],
            'is_active' => ['sometimes','boolean'],
        ]);
        $data['open_in_new_tab'] = $request->boolean('open_in_new_tab');
        $data['is_active'] = $request->boolean('is_active', true);
        $data['locale'] = $data['locale'] ?? app()->getLocale();
        $parent = $this->resolveNavigationParent($data['parent_id'] ?? null, $data['location'], $data['locale']);
        $data = $this->applyProgrammeLinkRules($data, $parent);
        $data['parent_id'] = $parent?->id;
        $link = NavigationLink::create($data);
        $this->seedProgrammePageMetaIfNeeded($link, $parent);
        PublicVisibilityRevision::record('navigation_link', $link->id, $link->toArray(), $request->user());
        return back()->with('status','Navigation link added.');
    }

    public function updateNav(Request $request, NavigationLink $link)
    {
        $data = $request->validate([
            'label' => ['required','string','max:255'],
            'url' => ['required', new SafeUrl(true), 'max:1024'],
            'location' => ['required','in:header,footer'],
            'locale' => ['nullable','string','max:10'],
            'position' => ['nullable','integer','min:0'],
            'parent_id' => ['nullable','integer','exists:navigation_links,id'],
            'open_in_new_tab' => ['sometimes','boolean'],
            'is_active' => ['sometimes','boolean'],
        ]);
        $data['open_in_new_tab'] = $request->boolean('open_in_new_tab');
        $data['is_active'] = $request->boolean('is_active', true);
        $data['locale'] = $data['locale'] ?? $link->locale ?? app()->getLocale();
        $parent = $this->resolveNavigationParent($data['parent_id'] ?? null, $data['location'], $data['locale'], $link);
        $data = $this->applyProgrammeLinkRules($data, $parent);
        $data['parent_id'] = $parent?->id;
        $link->update($data);
        $this->seedProgrammePageMetaIfNeeded($link, $parent);
        PublicVisibilityRevision::record('navigation_link', $link->id, $link->toArray(), $request->user());
        return back()->with('status','Navigation link updated.');
    }

    public function destroyNav(NavigationLink $link)
    {
        $link->delete();
        return back()->with('status','Navigation link deleted.');
    }

    public function reorderNav(Request $request)
    {
        $data = $request->validate([
            'order' => ['required'],
        ]);
        $order = is_string($data['order']) ? json_decode($data['order'], true) : $data['order'];
        $order = is_array($order) ? $order : [];
        foreach ($order as $index => $id) {
            NavigationLink::where('id', $id)->update(['position' => $index]);
        }
        return back()->with('status','Navigation order updated.');
    }

    public function sliders()
    {
        $sliders = HomeSlider::orderBy('position')->get();
        return view('admin.public-sliders', compact('sliders'));
    }

    public function storeSlider(Request $request)
    {
        $data = $request->validate([
            'title' => ['required','string','max:255'],
            'subtitle' => ['nullable','string','max:500'],
            'image_url' => ['nullable', new SafeUrl(true), 'max:1024'],
            'alt_text' => ['nullable','string','max:255'],
            'cta_label' => ['nullable','string','max:255'],
            'cta_url' => ['nullable', new SafeUrl(true), 'max:1024'],
            'locale' => ['nullable','string','max:10'],
            'position' => ['nullable','integer','min:0'],
            'active' => ['sometimes','boolean'],
            'is_active' => ['sometimes','boolean'],
            'starts_at' => ['nullable','date'],
            'ends_at' => ['nullable','date','after_or_equal:starts_at'],
            'upload_image' => ['nullable','image','mimes:jpg,jpeg,png,webp,gif','max:5120'],
        ]);
        $data['active'] = $request->boolean('active', true);
        $data['is_active'] = $request->boolean('is_active', $data['active']);
        $data['locale'] = $data['locale'] ?? app()->getLocale();
        if ($request->hasFile('upload_image')) {
            $path = $request->file('upload_image')->store('sliders', 'public');
            $data['image_url'] = Storage::url($path);
        }
        $this->validateCta($data);
        $slider = HomeSlider::create($data);
        PublicVisibilityRevision::record('home_slider', $slider->id, $slider->toArray(), $request->user());
        return back()->with('status','Slider added.');
    }

    public function updateSlider(Request $request, HomeSlider $slider)
    {
        $data = $request->validate([
            'title' => ['required','string','max:255'],
            'subtitle' => ['nullable','string','max:500'],
            'image_url' => ['nullable', new SafeUrl(true), 'max:1024'],
            'alt_text' => ['nullable','string','max:255'],
            'cta_label' => ['nullable','string','max:255'],
            'cta_url' => ['nullable', new SafeUrl(true), 'max:1024'],
            'locale' => ['nullable','string','max:10'],
            'position' => ['nullable','integer','min:0'],
            'active' => ['sometimes','boolean'],
            'is_active' => ['sometimes','boolean'],
            'starts_at' => ['nullable','date'],
            'ends_at' => ['nullable','date','after_or_equal:starts_at'],
            'upload_image' => ['nullable','image','mimes:jpg,jpeg,png,webp,gif','max:5120'],
        ]);
        $data['active'] = $request->boolean('active', $slider->active);
        $data['is_active'] = $request->boolean('is_active', $data['active']);
        $data['locale'] = $data['locale'] ?? $slider->locale ?? app()->getLocale();
        if ($request->hasFile('upload_image')) {
            $this->deletePublicUrl($slider->image_url);
            $path = $request->file('upload_image')->store('sliders', 'public');
            $data['image_url'] = Storage::url($path);
        }
        $this->validateCta($data);
        $slider->update($data);
        PublicVisibilityRevision::record('home_slider', $slider->id, $slider->toArray(), $request->user());
        return back()->with('status','Slider updated.');
    }

    public function destroySlider(HomeSlider $slider)
    {
        $this->deletePublicUrl($slider->image_url);
        $slider->delete();
        return back()->with('status','Slider deleted.');
    }

    public function reorderSliders(Request $request)
    {
        $data = $request->validate([
            'order' => ['required'],
        ]);
        $order = is_string($data['order']) ? json_decode($data['order'], true) : $data['order'];
        $order = is_array($order) ? $order : [];
        foreach ($order as $index => $id) {
            HomeSlider::where('id', $id)->update(['position' => $index]);
        }
        return back()->with('status','Slider order updated.');
    }

    public function footers()
    {
        $links = FooterLink::orderBy('section')->orderBy('position')->get();
        return view('admin.public-footer', compact('links'));
    }

    public function editFooter(FooterLink $link)
    {
        return view('admin.public-footer-edit', compact('link'));
    }

    public function designFooter(FooterLink $link)
    {
        $meta = $link->page_meta ?? [];

        if ($meta === []) {
            $meta = $this->defaultFooterPageMeta($link);
        }

        $meta = $this->preparePageDesignerMeta($meta);

        return view('admin.public-footer-design', compact('link', 'meta'));
    }

    public function storeFooter(Request $request)
    {
        $data = $request->validate([
            'label' => ['required','string','max:255'],
            'url' => ['required', new SafeUrl(true), 'max:1024'],
            'section' => ['required','string','max:50'],
            'locale' => ['nullable','string','max:10'],
            'position' => ['nullable','integer','min:0'],
            'open_in_new_tab' => ['sometimes','boolean'],
            'is_active' => ['sometimes','boolean'],
        ]);
        $data['url'] = $this->normalizeNavigationUrl($data['url']);
        $data['open_in_new_tab'] = $request->boolean('open_in_new_tab');
        $data['is_active'] = $request->boolean('is_active', true);
        $data['locale'] = $data['locale'] ?? app()->getLocale();
        $link = FooterLink::create($data);
        $this->seedFooterPageMetaIfNeeded($link);
        PublicVisibilityRevision::record('footer_link', $link->id, $link->toArray(), $request->user());
        return back()->with('status','Footer link added.');
    }

    public function updateFooter(Request $request, FooterLink $link)
    {
        $data = $request->validate([
            'label' => ['required','string','max:255'],
            'url' => ['required', new SafeUrl(true), 'max:1024'],
            'section' => ['required','string','max:50'],
            'locale' => ['nullable','string','max:10'],
            'position' => ['nullable','integer','min:0'],
            'open_in_new_tab' => ['sometimes','boolean'],
            'is_active' => ['sometimes','boolean'],
        ]);
        $data['url'] = $this->normalizeNavigationUrl($data['url']);
        $data['open_in_new_tab'] = $request->boolean('open_in_new_tab');
        $data['is_active'] = $request->boolean('is_active', true);
        $data['locale'] = $data['locale'] ?? $link->locale ?? app()->getLocale();
        $link->update($data);
        $this->seedFooterPageMetaIfNeeded($link);
        PublicVisibilityRevision::record('footer_link', $link->id, $link->toArray(), $request->user());
        return back()->with('status','Footer link updated.');
    }

    public function saveDesignFooter(Request $request, FooterLink $link)
    {
        $pageMeta = $this->buildPageMetaFromRequest($request, $link->page_meta ?? []);
        $link->update(['page_meta' => $pageMeta]);
        PublicVisibilityRevision::record('footer_link', $link->id, $link->toArray(), $request->user());

        return back()->with('status', 'Footer page design saved.');
    }

    public function destroyFooter(FooterLink $link)
    {
        $link->delete();
        return back()->with('status','Footer link deleted.');
    }

    public function reorderFooter(Request $request)
    {
        $data = $request->validate([
            'order' => ['required'],
        ]);
        $order = is_string($data['order']) ? json_decode($data['order'], true) : $data['order'];
        $order = is_array($order) ? $order : [];
        foreach ($order as $index => $id) {
            FooterLink::where('id', $id)->update(['position' => $index]);
        }
        return back()->with('status','Footer order updated.');
    }

    protected function validateCta(array $data): void
    {
        $label = $data['cta_label'] ?? null;
        $url = $data['cta_url'] ?? null;

        if ($label || $url) {
            if (! $label || ! $url) {
                abort(422, 'CTA label and URL must both be provided.');
            }

            if (! SafeUrl::isValidValue($url, true)) {
                abort(422, 'CTA URL must start with / or http/https.');
            }
        }
    }

    protected function resolveNavigationParent(?int $parentId, string $location, string $locale, ?NavigationLink $currentLink = null): ?NavigationLink
    {
        if ($currentLink && $currentLink->children()->exists()) {
            if ($location !== 'header') {
                throw ValidationException::withMessages([
                    'location' => 'Parent navigation tabs with child links must remain in the header menu.',
                ]);
            }

            if ($currentLink->locale !== $locale) {
                throw ValidationException::withMessages([
                    'locale' => 'Change the child link locales first before changing the parent tab locale.',
                ]);
            }

            if ($parentId) {
                throw ValidationException::withMessages([
                    'parent_id' => 'A navigation item that already has child links cannot be nested under another parent tab.',
                ]);
            }
        }

        if (! $parentId) {
            return null;
        }

        if ($location !== 'header') {
            throw ValidationException::withMessages([
                'parent_id' => 'Only header navigation items can be nested under a parent tab.',
            ]);
        }

        $parent = NavigationLink::query()->find($parentId);

        if (! $parent) {
            throw ValidationException::withMessages([
                'parent_id' => 'The selected parent navigation link could not be found.',
            ]);
        }

        if ($currentLink && $parent->id === $currentLink->id) {
            throw ValidationException::withMessages([
                'parent_id' => 'A navigation item cannot be its own parent.',
            ]);
        }

        if ($parent->parent_id) {
            throw ValidationException::withMessages([
                'parent_id' => 'Only top-level navigation items can be used as parent tabs.',
            ]);
        }

        if ($parent->location !== 'header') {
            throw ValidationException::withMessages([
                'parent_id' => 'Parent navigation items must belong to the header menu.',
            ]);
        }

        if ($parent->locale !== $locale) {
            throw ValidationException::withMessages([
                'parent_id' => 'Parent and child navigation items must use the same locale.',
            ]);
        }

        return $parent;
    }

    protected function assertSafeComponentUrls(array $components): void
    {
        $errors = [];
        $this->walkComponentUrls($components, $errors);

        if ($errors !== []) {
            throw ValidationException::withMessages($errors);
        }
    }

    protected function normalizeNavigationUrl(string $url): string
    {
        $url = trim($url);

        if ($url === '' || $url === '#') {
            return $url;
        }

        if (preg_match('/^(https?:)?\/\//i', $url) || str_starts_with($url, 'mailto:') || str_starts_with($url, 'tel:')) {
            return $url;
        }

        $normalized = '/' . ltrim($url, '/');

        if ($normalized !== '/') {
            $normalized = rtrim($normalized, '/');
        }

        return $normalized === '' ? '/' : $normalized;
    }

    protected function applyProgrammeLinkRules(array $data, ?NavigationLink $parent): array
    {
        $data['url'] = $this->normalizeNavigationUrl($data['url']);

        if (! $this->isProgrammesParent($parent)) {
            return $data;
        }

        if (! str_starts_with($data['url'], '/')) {
            throw ValidationException::withMessages([
                'url' => 'Programme submenu links must use an internal path such as /programmes/au-media-fellowship. Put the external application platform URL in Page Designer > CTA URL instead.',
            ]);
        }

        if ($data['url'] === '/') {
            throw ValidationException::withMessages([
                'url' => 'Programme submenu links need their own internal page path, not the homepage.',
            ]);
        }

        $data['open_in_new_tab'] = false;

        return $data;
    }

    protected function isProgrammesParent(?NavigationLink $link): bool
    {
        if (! $link) {
            return false;
        }

        if (($link->page_meta['nav_group'] ?? null) === 'programmes') {
            return true;
        }

        return Str::contains(Str::lower(trim($link->label)), ['programme', 'programmes']);
    }

    protected function seedProgrammePageMetaIfNeeded(NavigationLink $link, ?NavigationLink $parent): void
    {
        if (! $this->isProgrammesParent($parent) || ! empty($link->page_meta)) {
            return;
        }

        $link->update([
            'page_meta' => $this->defaultProgrammePageMeta($link),
        ]);
    }

    protected function defaultProgrammePageMeta(NavigationLink $link, ?string $applyUrl = null): array
    {
        $title = $link->label;

        return [
            'page_type' => 'programme',
            'hero_title' => $title,
            'hero_subtitle' => 'Official Agenda 2063 programme profile, eligibility notes, and application guidance.',
            'hero_bg' => '#5e1e28',
            'hero_text' => '#ffffff',
            'cta_label' => $applyUrl ? 'Apply Now' : '',
            'cta_url' => $applyUrl ?? '',
            'body_html' => '<p>' . e($title) . ' is presented on the Agenda 2063 platform as an official programme page with room for eligibility notes, milestones, partnership details, and application guidance.</p>',
            'components' => [
                [
                    'type' => 'about_page',
                    'title' => $title,
                    'hero' => [
                        'label' => 'Programmes & Fellowships',
                        'title' => $title,
                        'subtitle' => 'Agenda 2063 opportunity profile',
                        'images' => [
                            asset('images/flagships/au1.jpg'),
                            asset('images/flagships/au4.jpg'),
                        ],
                    ],
                    'sections' => [
                        [
                            'id' => 'overview',
                            'title' => 'Overview',
                            'intro' => $title . ' supports Agenda 2063 delivery through curated participation opportunities and continental collaboration.',
                            'paragraphs' => [
                                'This programme page can present the mandate, target audience, and the policy or implementation area it supports.',
                                'Applicants and partners can use it to review scope, benefits, deadlines, and institutional context before proceeding to the next step.',
                            ],
                            'image_url' => asset('images/flagships/au5.jpg'),
                        ],
                        [
                            'id' => 'eligibility',
                            'title' => 'Eligibility & Participation',
                            'intro' => 'Clarify who can apply, what profiles are prioritised, and any geographic or thematic requirements.',
                            'paragraphs' => [
                                'Experience level, qualification, language, sector, and member-state requirements can be presented here for transparency.',
                                'If the programme has multiple cohorts or tracks, each one can be described clearly so applicants can identify the right fit.',
                            ],
                            'image_url' => asset('images/flagships/au3.jpg'),
                        ],
                        [
                            'id' => 'application',
                            'title' => 'Application Process',
                            'intro' => 'Use the Apply Now button in the sidebar to connect applicants to the official external application platform.',
                            'paragraphs' => [
                                'This section can outline required documents, deadlines, and key steps applicants should complete before they continue.',
                                'If the application platform is hosted on another official domain, a short transition notice will appear before redirecting.',
                            ],
                            'image_url' => asset('images/flagships/au2.webp'),
                        ],
                    ],
                    'moonshots' => [],
                    'timeline' => [
                        [
                            'period' => 'Call Opens',
                            'title' => 'Applications Announced',
                            'text' => 'The programme publishes eligibility, dates, and participation guidance.',
                            'active' => false,
                        ],
                        [
                            'period' => 'Review',
                            'title' => 'Shortlisting & Assessment',
                            'text' => 'Applications are screened against programme criteria and evaluated by the relevant team.',
                            'active' => true,
                        ],
                        [
                            'period' => 'Cohort',
                            'title' => 'Selection & Onboarding',
                            'text' => 'Successful applicants are confirmed and onboarded into the programme or fellowship cycle.',
                            'active' => false,
                        ],
                    ],
                ],
                [
                    'type' => 'timeline',
                    'title' => 'Programme Journey',
                    'subtitle' => 'Typical flow from announcement to onboarding',
                    'items' => [
                        [
                            'period' => 'Announcement',
                            'title' => 'Call for Applications',
                            'text' => 'Publish programme scope, requirements, and deadlines.',
                            'active' => false,
                        ],
                        [
                            'period' => 'Assessment',
                            'title' => 'Review & Selection',
                            'text' => 'Evaluate submissions and confirm shortlisted participants.',
                            'active' => true,
                        ],
                        [
                            'period' => 'Onboarding',
                            'title' => 'Programme Start',
                            'text' => 'Launch the selected cohort and share implementation materials.',
                            'active' => false,
                        ],
                    ],
                ],
            ],
        ];
    }

    protected function seedFooterPageMetaIfNeeded(FooterLink $link): void
    {
        if (! empty($link->page_meta) || ! str_starts_with($link->url, '/')) {
            return;
        }

        $link->update([
            'page_meta' => $this->defaultFooterPageMeta($link),
        ]);
    }

    protected function defaultFooterPageMeta(FooterLink $link): array
    {
        $title = $link->label;
        $label = Str::lower(trim($title));
        $pageType = Str::contains($label, 'privacy') ? 'privacy' : (Str::contains($label, 'contact') ? 'contact' : 'information');
        $heroLabel = $pageType === 'privacy' ? 'Privacy & Data' : ($pageType === 'contact' ? 'Contact & Engagement' : 'Agenda 2063');
        $heroSubtitle = $pageType === 'privacy'
            ? 'Official platform guidance on privacy, cookies, records, and responsible data handling.'
            : ($pageType === 'contact'
                ? 'Official contact and engagement information for the Agenda 2063 platform.'
                : 'Official Agenda 2063 information page.');

        return [
            'page_type' => $pageType,
            'hero_title' => $title,
            'hero_subtitle' => $heroSubtitle,
            'hero_bg' => '#5e1e28',
            'hero_text' => '#ffffff',
            'cta_label' => '',
            'cta_url' => '',
            'body_html' => '<p>' . e($title) . ' can be managed from the admin CMS using the same page designer used for programme pages.</p>',
            'info_items' => [
                ['label' => 'Footer Section', 'value' => ucfirst($link->section)],
                ['label' => 'Link Path', 'value' => $link->url],
            ],
            'components' => [
                [
                    'type' => 'about_page',
                    'title' => $title,
                    'hero' => [
                        'label' => $heroLabel,
                        'title' => $title,
                        'subtitle' => $heroSubtitle,
                        'images' => [
                            asset('images/flagships/au1.jpg'),
                            asset('images/flagships/au4.jpg'),
                        ],
                    ],
                    'sections' => [
                        [
                            'id' => 'overview',
                            'title' => 'Overview',
                            'intro' => $title . ' content can be managed from the public visibility CMS.',
                            'paragraphs' => [
                                'Use this page to publish official guidance, public-facing explanations, and any linked follow-up information users need before leaving the page.',
                                'You can expand or replace this seeded content at any time from the page designer in the admin area.',
                            ],
                            'image_url' => asset('images/flagships/au5.jpg'),
                        ],
                    ],
                    'timeline' => [],
                ],
            ],
        ];
    }

    protected function preparePageDesignerMeta(array $meta): array
    {
        return array_merge([
            'hero_title' => '',
            'hero_subtitle' => '',
            'hero_bg' => '#0f172a',
            'hero_text' => '#ffffff',
            'cta_label' => '',
            'cta_url' => '',
            'body_html' => '',
            'info_items' => [],
            'aspirations_title' => 'Our Aspirations',
            'aspirations_intro' => '',
            'aspirations_items' => [
                ['title' => '', 'text' => '', 'image_url' => '', 'link' => ''],
                ['title' => '', 'text' => '', 'image_url' => '', 'link' => ''],
                ['title' => '', 'text' => '', 'image_url' => '', 'link' => ''],
            ],
            'flagship_title' => 'Flagship Projects',
            'flagship_items' => [
                ['title' => '', 'text' => '', 'image_url' => '', 'link' => ''],
                ['title' => '', 'text' => '', 'image_url' => '', 'link' => ''],
                ['title' => '', 'text' => '', 'image_url' => '', 'link' => ''],
            ],
            'press_title' => 'Press Releases',
            'press_items' => [
                ['title' => '', 'date' => '', 'link' => ''],
                ['title' => '', 'date' => '', 'link' => ''],
                ['title' => '', 'date' => '', 'link' => ''],
            ],
            'quiz_title' => 'Test Your Knowledge',
            'quiz_description' => '',
            'quiz_cta_label' => 'Start Quiz',
            'quiz_cta_url' => '/quiz',
        ], $meta);
    }

    protected function buildPageMetaFromRequest(Request $request, array $existingMeta = []): array
    {
        $data = $request->validate([
            'hero_title' => ['nullable','string','max:255'],
            'hero_subtitle' => ['nullable','string','max:500'],
            'hero_bg' => ['nullable','string','max:20'],
            'hero_text' => ['nullable','string','max:20'],
            'cta_label' => ['nullable','string','max:255'],
            'cta_url' => ['nullable', new SafeUrl(true), 'max:1024'],
            'body_html' => ['nullable','string'],
            'info_items' => ['nullable','array'],
            'info_items.*.label' => ['nullable','string','max:255'],
            'info_items.*.value' => ['nullable','string','max:255'],
            'aspirations_title' => ['nullable','string','max:255'],
            'aspirations_intro' => ['nullable','string','max:500'],
            'aspirations_items' => ['array'],
            'aspirations_items.*.title' => ['nullable','string','max:255'],
            'aspirations_items.*.text' => ['nullable','string'],
            'aspirations_items.*.image_url' => ['nullable', new SafeUrl(true), 'max:1024'],
            'aspirations_items.*.link' => ['nullable', new SafeUrl(true), 'max:1024'],
            'flagship_title' => ['nullable','string','max:255'],
            'flagship_items' => ['array'],
            'flagship_items.*.title' => ['nullable','string','max:255'],
            'flagship_items.*.text' => ['nullable','string'],
            'flagship_items.*.image_url' => ['nullable', new SafeUrl(true), 'max:1024'],
            'flagship_items.*.link' => ['nullable', new SafeUrl(true), 'max:1024'],
            'press_title' => ['nullable','string','max:255'],
            'press_items' => ['array'],
            'press_items.*.title' => ['nullable','string','max:255'],
            'press_items.*.date' => ['nullable','string','max:50'],
            'press_items.*.link' => ['nullable', new SafeUrl(true), 'max:1024'],
            'quiz_title' => ['nullable','string','max:255'],
            'quiz_description' => ['nullable','string','max:500'],
            'quiz_cta_label' => ['nullable','string','max:255'],
            'quiz_cta_url' => ['nullable', new SafeUrl(true), 'max:1024'],
            'components_json' => ['nullable','string'],
        ]);

        if (($data['cta_label'] ?? null) xor ($data['cta_url'] ?? null)) {
            throw ValidationException::withMessages([
                'cta' => 'CTA label and URL must both be provided when using a CTA.',
            ]);
        }

        if (($data['quiz_cta_label'] ?? null) xor ($data['quiz_cta_url'] ?? null)) {
            throw ValidationException::withMessages([
                'quiz' => 'Quiz CTA label and URL must both be provided when using quiz CTA.',
            ]);
        }

        $components = [];
        if (! empty($data['components_json'])) {
            $decoded = json_decode($data['components_json'], true);

            if (! is_array($decoded)) {
                throw ValidationException::withMessages([
                    'components_json' => 'Components payload must be valid JSON.',
                ]);
            }

            $components = collect($decoded)
                ->take(20)
                ->values()
                ->toArray();

            $this->assertSafeComponentUrls($components);
        }

        $pageMeta = array_merge($existingMeta, $data);
        $pageMeta['components'] = $components;
        unset($pageMeta['components_json']);

        foreach ($pageMeta['components'] as $idx => &$component) {
            if (! is_array($component)) {
                continue;
            }

            if ($component['type'] === 'aspirations' && $request->hasFile("upload_component_{$idx}_cards")) {
                $files = $request->file("upload_component_{$idx}_cards");
                foreach ($files as $i => $file) {
                    if (! $file) {
                        continue;
                    }

                    $path = $file->store('components', 'public');
                    $component['cards'][$i]['image_url'] = Storage::url($path);
                }
            }

            if ($component['type'] === 'flagships' && $request->hasFile("upload_component_{$idx}_items")) {
                $files = $request->file("upload_component_{$idx}_items");
                foreach ($files as $i => $file) {
                    if (! $file) {
                        continue;
                    }

                    $path = $file->store('components', 'public');
                    $component['items'][$i]['image_url'] = Storage::url($path);
                }
            }

            if ($component['type'] === 'press' && $request->hasFile("upload_component_{$idx}_press")) {
                $files = $request->file("upload_component_{$idx}_press");
                foreach ($files as $i => $file) {
                    if (! $file) {
                        continue;
                    }

                    $path = $file->store('components', 'public');
                    $component['items'][$i]['attachment_url'] = Storage::url($path);
                }
            }

            if ($component['type'] === 'hero_slider' && $request->hasFile("upload_component_{$idx}_slides")) {
                $files = $request->file("upload_component_{$idx}_slides");
                foreach ($files as $i => $file) {
                    if (! $file) {
                        continue;
                    }

                    $path = $file->store('components', 'public');
                    $component['slides'][$i]['image_url'] = Storage::url($path);
                }
            }

            if ($component['type'] === 'about_page' && $request->hasFile("upload_component_{$idx}_hero")) {
                $component['hero'] = $component['hero'] ?? [];
                $component['hero']['images'] = $component['hero']['images'] ?? [];

                foreach ($request->file("upload_component_{$idx}_hero") as $file) {
                    if (! $file) {
                        continue;
                    }

                    $path = $file->store('components', 'public');
                    $component['hero']['images'][] = Storage::url($path);
                }
            }

            if ($component['type'] === 'about_page' && $request->hasFile("upload_component_{$idx}_sections")) {
                $files = $request->file("upload_component_{$idx}_sections");
                foreach ($files as $i => $file) {
                    if (! $file) {
                        continue;
                    }

                    $path = $file->store('components', 'public');
                    if (! isset($component['sections'][$i])) {
                        $component['sections'][$i] = [];
                    }
                    $component['sections'][$i]['image_url'] = Storage::url($path);
                }
            }

            if ($component['type'] === 'flagship_page' && $request->hasFile("upload_component_{$idx}_items")) {
                $files = $request->file("upload_component_{$idx}_items");
                foreach ($files as $i => $file) {
                    if (! $file) {
                        continue;
                    }

                    $path = $file->store('components', 'public');
                    if (! isset($component['items'][$i])) {
                        $component['items'][$i] = [];
                    }
                    $component['items'][$i]['image_url'] = Storage::url($path);
                }
            }

            if ($component['type'] === 'flagship_page' && $request->hasFile("upload_component_{$idx}_hero_image")) {
                $file = $request->file("upload_component_{$idx}_hero_image");
                if ($file) {
                    $path = $file->store('components', 'public');
                    $component['hero_image'] = Storage::url($path);
                }
            }

            if ($component['type'] === 'flagship_page' && ! empty($component['items'])) {
                foreach ($component['items'] as $i => $item) {
                    if (isset($item['tags']) && is_string($item['tags'])) {
                        $component['items'][$i]['tags'] = collect(explode(',', $item['tags']))
                            ->map(fn ($tag) => trim($tag))
                            ->filter()
                            ->values()
                            ->all();
                    }

                    if (empty($item['paragraphs']) && ! empty($item['text'])) {
                        $component['items'][$i]['paragraphs'] = [$item['text']];
                    }
                }
            }
        }

        return $pageMeta;
    }

    protected function walkComponentUrls(array $payload, array &$errors, string $prefix = 'components'): void
    {
        foreach ($payload as $key => $value) {
            $path = $prefix . '.' . $key;

            if (is_array($value)) {
                $this->walkComponentUrls($value, $errors, $path);
                continue;
            }

            if (! is_string($value) || $value === '') {
                continue;
            }

            if (in_array((string) $key, ['link', 'link_url', 'image_url', 'attachment_url', 'cta_url', 'hero_image'], true)
                && ! SafeUrl::isValidValue($value, true)) {
                $errors[$path] = 'This URL must use http(s) or an internal path.';
            }
        }
    }

    protected function deletePublicUrl(?string $url): void
    {
        if (! $url || ! str_starts_with($url, '/storage/')) {
            return;
        }

        $path = ltrim(substr($url, strlen('/storage/')), '/');

        if ($path !== '' && Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }
    }
}
