<?php

namespace App\Http\Controllers;

use App\Models\NavigationLink;
use App\Models\HomeSlider;
use App\Models\FooterLink;
use App\Models\PublicVisibilityRevision;
use Illuminate\Http\Request;

class AdminPublicVisibilityController extends Controller
{
    public function navigation(Request $request)
    {
        $links = NavigationLink::orderBy('location')->orderBy('position')->get();
        return view('admin.public-nav', compact('links'));
    }

    public function designNav(NavigationLink $link)
    {
        $meta = $link->page_meta ?? [];
        $meta = array_merge([
            'hero_title' => '',
            'hero_subtitle' => '',
            'hero_bg' => '#0f172a',
            'hero_text' => '#ffffff',
            'cta_label' => '',
            'cta_url' => '',
            'body_html' => '',
            // Components
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
        return view('admin.public-nav-design', compact('link', 'meta'));
    }

    public function saveDesignNav(Request $request, NavigationLink $link)
    {
        $data = $request->validate([
            'hero_title' => ['nullable','string','max:255'],
            'hero_subtitle' => ['nullable','string','max:500'],
            'hero_bg' => ['nullable','string','max:20'],
            'hero_text' => ['nullable','string','max:20'],
            'cta_label' => ['nullable','string','max:255'],
            'cta_url' => ['nullable','string','max:1024'],
            'body_html' => ['nullable','string'],
            'aspirations_title' => ['nullable','string','max:255'],
            'aspirations_intro' => ['nullable','string','max:500'],
            'aspirations_items' => ['array'],
            'aspirations_items.*.title' => ['nullable','string','max:255'],
            'aspirations_items.*.text' => ['nullable','string'],
            'aspirations_items.*.image_url' => ['nullable','string','max:1024'],
            'aspirations_items.*.link' => ['nullable','string','max:1024'],
            'flagship_title' => ['nullable','string','max:255'],
            'flagship_items' => ['array'],
            'flagship_items.*.title' => ['nullable','string','max:255'],
            'flagship_items.*.text' => ['nullable','string'],
            'flagship_items.*.image_url' => ['nullable','string','max:1024'],
            'flagship_items.*.link' => ['nullable','string','max:1024'],
            'press_title' => ['nullable','string','max:255'],
            'press_items' => ['array'],
            'press_items.*.title' => ['nullable','string','max:255'],
            'press_items.*.date' => ['nullable','string','max:50'],
            'press_items.*.link' => ['nullable','string','max:1024'],
            'quiz_title' => ['nullable','string','max:255'],
            'quiz_description' => ['nullable','string','max:500'],
            'quiz_cta_label' => ['nullable','string','max:255'],
            'quiz_cta_url' => ['nullable','string','max:1024'],
            'components_json' => ['nullable','string'],
        ]);

        if (($data['cta_label'] ?? null) xor ($data['cta_url'] ?? null)) {
            return back()->withErrors(['cta' => 'CTA label and URL must both be provided when using a CTA.']);
        }

        if (($data['quiz_cta_label'] ?? null) xor ($data['quiz_cta_url'] ?? null)) {
            return back()->withErrors(['quiz' => 'Quiz CTA label and URL must both be provided when using quiz CTA.']);
        }

        $components = [];
        if (!empty($data['components_json'])) {
            $decoded = json_decode($data['components_json'], true);
            if (! is_array($decoded)) {
                return back()->withErrors(['components_json' => 'Components payload must be valid JSON.']);
            }
            $components = collect($decoded)
                ->take(20) // safety cap
                ->values()
                ->toArray();
        }

        $pageMeta = $data;
        $pageMeta['components'] = $components;
        unset($pageMeta['components_json']);

        // handle uploaded images mapped by component index
        foreach ($pageMeta['components'] as $idx => &$component) {
            if (!is_array($component)) continue;
            // aspirations cards images
            if ($component['type'] === 'aspirations' && $request->hasFile("upload_component_{$idx}_cards")) {
                $files = $request->file("upload_component_{$idx}_cards");
                foreach ($files as $i => $file) {
                    if (!$file) continue;
                    $path = $file->store('components', 'public');
                    $component['cards'][$i]['image_url'] = \Illuminate\Support\Facades\Storage::url($path);
                }
            }
            // flagships items images
            if ($component['type'] === 'flagships' && $request->hasFile("upload_component_{$idx}_items")) {
                $files = $request->file("upload_component_{$idx}_items");
                foreach ($files as $i => $file) {
                    if (!$file) continue;
                    $path = $file->store('components', 'public');
                    $component['items'][$i]['image_url'] = \Illuminate\Support\Facades\Storage::url($path);
                }
            }
            // press releases: allow optional image or attachment
            if ($component['type'] === 'press' && $request->hasFile("upload_component_{$idx}_press")) {
                $files = $request->file("upload_component_{$idx}_press");
                foreach ($files as $i => $file) {
                    if (!$file) continue;
                    $path = $file->store('components', 'public');
                    $component['items'][$i]['attachment_url'] = \Illuminate\Support\Facades\Storage::url($path);
                }
            }
            // hero slider images
            if ($component['type'] === 'hero_slider' && $request->hasFile("upload_component_{$idx}_slides")) {
                $files = $request->file("upload_component_{$idx}_slides");
                foreach ($files as $i => $file) {
                    if (!$file) continue;
                    $path = $file->store('components', 'public');
                    $component['slides'][$i]['image_url'] = \Illuminate\Support\Facades\Storage::url($path);
                }
            }
            // about page hero images upload
            if ($component['type'] === 'about_page' && $request->hasFile("upload_component_{$idx}_hero")) {
                $component['hero'] = $component['hero'] ?? [];
                $component['hero']['images'] = $component['hero']['images'] ?? [];
                foreach ($request->file("upload_component_{$idx}_hero") as $file) {
                    if (!$file) continue;
                    $path = $file->store('components', 'public');
                    $component['hero']['images'][] = \Illuminate\Support\Facades\Storage::url($path);
                }
            }
            // about page section images upload
            if ($component['type'] === 'about_page' && $request->hasFile("upload_component_{$idx}_sections")) {
                $files = $request->file("upload_component_{$idx}_sections");
                foreach ($files as $i => $file) {
                    if (!$file) continue;
                    $path = $file->store('components', 'public');
                    if (!isset($component['sections'][$i])) {
                        $component['sections'][$i] = [];
                    }
                    $component['sections'][$i]['image_url'] = \Illuminate\Support\Facades\Storage::url($path);
                }
            }
            // flagship page item images upload
            if ($component['type'] === 'flagship_page' && $request->hasFile("upload_component_{$idx}_items")) {
                $files = $request->file("upload_component_{$idx}_items");
                foreach ($files as $i => $file) {
                    if (!$file) continue;
                    $path = $file->store('components', 'public');
                    if (!isset($component['items'][$i])) {
                        $component['items'][$i] = [];
                    }
                    $component['items'][$i]['image_url'] = \Illuminate\Support\Facades\Storage::url($path);
                }
            }
            if ($component['type'] === 'flagship_page' && $request->hasFile("upload_component_{$idx}_hero_image")) {
                $file = $request->file("upload_component_{$idx}_hero_image");
                if ($file) {
                    $path = $file->store('components', 'public');
                    $component['hero_image'] = \Illuminate\Support\Facades\Storage::url($path);
                }
            }

            // normalize flagship page items: tags -> array, paragraphs fallback
            if ($component['type'] === 'flagship_page' && !empty($component['items'])) {
                foreach ($component['items'] as $i => $item) {
                    // tags can arrive as CSV string from editor
                    if (isset($item['tags']) && is_string($item['tags'])) {
                        $component['items'][$i]['tags'] = collect(explode(',', $item['tags']))
                            ->map(fn($t) => trim($t))
                            ->filter()
                            ->values()
                            ->all();
                    }
                    // ensure paragraphs array exists
                    if (empty($item['paragraphs']) && !empty($item['text'])) {
                        $component['items'][$i]['paragraphs'] = [$item['text']];
                    }
                }
            }
        }

        $link->update(['page_meta' => $pageMeta]);
        PublicVisibilityRevision::record('navigation_link', $link->id, $link->toArray(), $request->user());

        return back()->with('status', 'Page design saved.');
    }

    public function storeNav(Request $request)
    {
        $data = $request->validate([
            'label' => ['required','string','max:255'],
            'url' => ['required','string','max:1024'],
            'location' => ['required','in:header,footer'],
            'locale' => ['nullable','string','max:10'],
            'position' => ['nullable','integer','min:0'],
            'open_in_new_tab' => ['sometimes','boolean'],
            'is_active' => ['sometimes','boolean'],
        ]);
        $data['open_in_new_tab'] = $request->boolean('open_in_new_tab');
        $data['is_active'] = $request->boolean('is_active', true);
        $data['locale'] = $data['locale'] ?? app()->getLocale();
        $link = NavigationLink::create($data);
        PublicVisibilityRevision::record('navigation_link', $link->id, $link->toArray(), $request->user());
        return back()->with('status','Navigation link added.');
    }

    public function updateNav(Request $request, NavigationLink $link)
    {
        $data = $request->validate([
            'label' => ['required','string','max:255'],
            'url' => ['required','string','max:1024'],
            'location' => ['required','in:header,footer'],
            'locale' => ['nullable','string','max:10'],
            'position' => ['nullable','integer','min:0'],
            'open_in_new_tab' => ['sometimes','boolean'],
            'is_active' => ['sometimes','boolean'],
        ]);
        $data['open_in_new_tab'] = $request->boolean('open_in_new_tab');
        $data['is_active'] = $request->boolean('is_active', true);
        $data['locale'] = $data['locale'] ?? $link->locale ?? app()->getLocale();
        $link->update($data);
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
            'image_url' => ['nullable','string','max:1024'],
            'alt_text' => ['nullable','string','max:255'],
            'cta_label' => ['nullable','string','max:255'],
            'cta_url' => ['nullable','string','max:1024'],
            'locale' => ['nullable','string','max:10'],
            'position' => ['nullable','integer','min:0'],
            'active' => ['sometimes','boolean'],
            'is_active' => ['sometimes','boolean'],
            'starts_at' => ['nullable','date'],
            'ends_at' => ['nullable','date','after_or_equal:starts_at'],
            'upload_image' => ['nullable','image','max:5120'],
        ]);
        $data['active'] = $request->boolean('active', true);
        $data['is_active'] = $request->boolean('is_active', $data['active']);
        $data['locale'] = $data['locale'] ?? app()->getLocale();
        if ($request->hasFile('upload_image')) {
            $path = $request->file('upload_image')->store('sliders', 'public');
            $data['image_url'] = \Illuminate\Support\Facades\Storage::url($path);
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
            'image_url' => ['nullable','string','max:1024'],
            'alt_text' => ['nullable','string','max:255'],
            'cta_label' => ['nullable','string','max:255'],
            'cta_url' => ['nullable','string','max:1024'],
            'locale' => ['nullable','string','max:10'],
            'position' => ['nullable','integer','min:0'],
            'active' => ['sometimes','boolean'],
            'is_active' => ['sometimes','boolean'],
            'starts_at' => ['nullable','date'],
            'ends_at' => ['nullable','date','after_or_equal:starts_at'],
            'upload_image' => ['nullable','image','max:5120'],
        ]);
        $data['active'] = $request->boolean('active', $slider->active);
        $data['is_active'] = $request->boolean('is_active', $data['active']);
        $data['locale'] = $data['locale'] ?? $slider->locale ?? app()->getLocale();
        if ($request->hasFile('upload_image')) {
            $path = $request->file('upload_image')->store('sliders', 'public');
            $data['image_url'] = \Illuminate\Support\Facades\Storage::url($path);
        }
        $this->validateCta($data);
        $slider->update($data);
        PublicVisibilityRevision::record('home_slider', $slider->id, $slider->toArray(), $request->user());
        return back()->with('status','Slider updated.');
    }

    public function destroySlider(HomeSlider $slider)
    {
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

    public function storeFooter(Request $request)
    {
        $data = $request->validate([
            'label' => ['required','string','max:255'],
            'url' => ['required','string','max:1024'],
            'section' => ['required','string','max:50'],
            'locale' => ['nullable','string','max:10'],
            'position' => ['nullable','integer','min:0'],
            'open_in_new_tab' => ['sometimes','boolean'],
            'is_active' => ['sometimes','boolean'],
        ]);
        $data['open_in_new_tab'] = $request->boolean('open_in_new_tab');
        $data['is_active'] = $request->boolean('is_active', true);
        $data['locale'] = $data['locale'] ?? app()->getLocale();
        $link = FooterLink::create($data);
        PublicVisibilityRevision::record('footer_link', $link->id, $link->toArray(), $request->user());
        return back()->with('status','Footer link added.');
    }

    public function updateFooter(Request $request, FooterLink $link)
    {
        $data = $request->validate([
            'label' => ['required','string','max:255'],
            'url' => ['required','string','max:1024'],
            'section' => ['required','string','max:50'],
            'locale' => ['nullable','string','max:10'],
            'position' => ['nullable','integer','min:0'],
            'open_in_new_tab' => ['sometimes','boolean'],
            'is_active' => ['sometimes','boolean'],
        ]);
        $data['open_in_new_tab'] = $request->boolean('open_in_new_tab');
        $data['is_active'] = $request->boolean('is_active', true);
        $data['locale'] = $data['locale'] ?? $link->locale ?? app()->getLocale();
        $link->update($data);
        PublicVisibilityRevision::record('footer_link', $link->id, $link->toArray(), $request->user());
        return back()->with('status','Footer link updated.');
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
            if (! preg_match('#^/|https?://#', $url)) {
                abort(422, 'CTA URL must start with / or http/https.');
            }
        }
    }
}
