<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PublicController extends Controller
{
    public function home()
    {
        $defaultPress = [[
            'title' => 'African Union launches 2024 Agenda 2063 Continental Progress Report at Addis Ababa Summit',
            'date'  => now()->toDateString(),
            'text'  => '',
            'link'  => url('/news/detail'),
        ]];

        $defaultAspirations = [
            ['title'=>"Africa's Economic Growth", 'label'=>'Aspiration 1', 'front'=>'https://agenda2063.africa/assets/Aspiration1.png', 'back_title'=>'A Prosperous Africa', 'back_text'=>'A prosperous Africa based on inclusive growth and sustainable development, eradicating poverty and creating opportunities for all.', 'link'=>url('/about#goals')],
            ['title'=>"Integrated Continent", 'label'=>'Aspiration 2', 'front'=>'https://agenda2063.africa/assets/Aspiration2.png', 'back_title'=>'Political Unity', 'back_text'=>"An integrated continent, politically united and based on the ideals of Pan-Africanism and the vision of Africa's Renaissance.", 'link'=>url('/about#goals')],
            ['title'=>"Good Governance", 'label'=>'Aspiration 3', 'front'=>'https://agenda2063.africa/assets/Aspiration3.png', 'back_title'=>'Rule of Law', 'back_text'=>'An Africa of good governance, democracy, respect for human rights, justice and the rule of law.', 'link'=>url('/about#goals')],
            ['title'=>"Peace & Security", 'label'=>'Aspiration 4', 'front'=>'https://agenda2063.africa/assets/Aspiration4.png', 'back_title'=>'A Peaceful Africa', 'back_text'=>'A peaceful and secure Africa, free from conflict and violence, where dialogue prevails over guns.', 'link'=>url('/about#goals')],
            ['title'=>"Cultural Renaissance", 'label'=>'Aspiration 5', 'front'=>'https://agenda2063.africa/assets/Aspiration5.png', 'back_title'=>'Strong Identity', 'back_text'=>"An Africa with a strong cultural identity, common heritage, shared values and ethics.", 'link'=>url('/about#goals')],
            ['title'=>"People-Driven", 'label'=>'Aspiration 6', 'front'=>'https://agenda2063.africa/assets/Aspiration6.png', 'back_title'=>'Youth & Women', 'back_text'=>"An Africa whose development is people-driven, relying on the potential of African people, especially its women and youth.", 'link'=>url('/about#goals')],
            ['title'=>"Global Player", 'label'=>'Aspiration 7', 'front'=>'https://agenda2063.africa/assets/Aspiration7.png', 'back_title'=>'Influential Partner', 'back_text'=>"Africa as a strong, united, resilient and influential global player and partner.", 'link'=>url('/about#goals')],
        ];

        $defaultFlagships = [
            ['title'=>'INTEGRATED HIGH SPEED TRAIN NETWORK', 'subtitle'=>'Connecting African Capitals and Commercial Centres', 'image'=>'https://agenda2063.africa/assets/flagship-1.jpg', 'text'=>'Aims to connect all African capitals and commercial centres through a high-speed train network.', 'link'=>url('/about#flagship')],
            ['title'=>'AFRICAN COMMODITIES STRATEGY', 'subtitle'=>"Transforming Africa's Commodities Sector", 'image'=>'https://agenda2063.africa/assets/flagship-2.jpg', 'text'=>'Developing a continental commodities strategy to enable African countries to add value.', 'link'=>url('/about#flagship')],
            ['title'=>'AFRICAN CONTINENTAL FREE TRADE AREA (AFCFTA)', 'subtitle'=>'Boosting Intra-African Trade', 'image'=>'https://agenda2063.africa/assets/flagship-3.jpg', 'text'=>"Accelerates intra-African trade and strengthens Africa's position in the global market.", 'link'=>url('/about#flagship')],
        ];

        // optional page meta from nav link pointing to "/"
        $pageMeta = \App\Models\NavigationLink::where('url', '/')->value('page_meta') ?? [];
        $components = collect($pageMeta['components'] ?? []);

        $pressItems = $components->firstWhere('type', 'press')['items'] ?? $pageMeta['press_items'] ?? $defaultPress;
        $aspirationsItems = $components->firstWhere('type', 'aspirations')['cards'] ?? $pageMeta['aspirations_items'] ?? $defaultAspirations;
        $flagships = $components->firstWhere('type', 'flagships')['items'] ?? $pageMeta['flagship_items'] ?? $defaultFlagships;
        $heroSlidesComponent = $components->firstWhere('type', 'hero_slider')['slides'] ?? null;

        if ($heroSlidesComponent) {
            $sliders = collect($heroSlidesComponent)->map(function ($slide) {
                return (object)[
                    'image_url' => $slide['image_url'] ?? null,
                    'title' => $slide['title'] ?? '',
                    'subtitle' => $slide['subtitle'] ?? '',
                    'cta_label' => $slide['link_label'] ?? $slide['cta_label'] ?? null,
                    'cta_url' => $slide['link_url'] ?? $slide['cta_url'] ?? null,
                ];
            });
        } else {
            $sliders = \App\Models\HomeSlider::where('active', true)
                ->where(function ($q) {
                    $now = now();
                    $q->whereNull('starts_at')->orWhere('starts_at', '<=', $now);
                })
                ->where(function ($q) {
                    $now = now();
                    $q->whereNull('ends_at')->orWhere('ends_at', '>=', $now);
                })
                ->where('locale', app()->getLocale())
                ->orderBy('position')
                ->get();
        }

        $aspirationsItems = collect($aspirationsItems)->map(function ($item) {
            $slug = Str::slug($item['title'] ?? $item['label'] ?? 'aspiration');
            return array_merge($item, [
                'slug' => $slug,
                'link' => route('aspiration.show', $slug),
            ]);
        });

        return view('pages.home', compact('sliders', 'pressItems', 'aspirationsItems', 'flagships', 'pageMeta'));
    }

    public function aspirationDetail(string $slug)
    {
        $pageMeta = \App\Models\NavigationLink::where('url', '/')->value('page_meta') ?? [];
        $components = collect($pageMeta['components'] ?? []);
        $defaultAspirations = [
            ['title'=>"Africa's Economic Growth", 'label'=>'Aspiration 1', 'front'=>'https://agenda2063.africa/assets/Aspiration1.png', 'back_title'=>'A Prosperous Africa', 'back_text'=>'A prosperous Africa based on inclusive growth and sustainable development, eradicating poverty and creating opportunities for all.'],
            ['title'=>"Integrated Continent", 'label'=>'Aspiration 2', 'front'=>'https://agenda2063.africa/assets/Aspiration2.png', 'back_title'=>'Political Unity', 'back_text'=>"An integrated continent, politically united and based on the ideals of Pan-Africanism and the vision of Africa's Renaissance."],
            ['title'=>"Good Governance", 'label'=>'Aspiration 3', 'front'=>'https://agenda2063.africa/assets/Aspiration3.png', 'back_title'=>'Rule of Law', 'back_text'=>'An Africa of good governance, democracy, respect for human rights, justice and the rule of law.'],
            ['title'=>"Peace & Security", 'label'=>'Aspiration 4', 'front'=>'https://agenda2063.africa/assets/Aspiration4.png', 'back_title'=>'A Peaceful Africa', 'back_text'=>'A peaceful and secure Africa, free from conflict and violence, where dialogue prevails over guns.'],
            ['title'=>"Cultural Renaissance", 'label'=>'Aspiration 5', 'front'=>'https://agenda2063.africa/assets/Aspiration5.png', 'back_title'=>'Strong Identity', 'back_text'=>"An Africa with a strong cultural identity, common heritage, shared values and ethics."],
            ['title'=>"People-Driven", 'label'=>'Aspiration 6', 'front'=>'https://agenda2063.africa/assets/Aspiration6.png', 'back_title'=>'Youth & Women', 'back_text'=>"An Africa whose development is people-driven, relying on the potential of African people, especially its women and youth."],
            ['title'=>"Global Player", 'label'=>'Aspiration 7', 'front'=>'https://agenda2063.africa/assets/Aspiration7.png', 'back_title'=>'Influential Partner', 'back_text'=>"Africa as a strong, united, resilient and influential global player and partner."],
        ];

        $aspirations = $components->firstWhere('type', 'aspirations')['cards'] ?? $pageMeta['aspirations_items'] ?? $defaultAspirations;
        $aspirations = collect($aspirations)->map(function ($item) {
            $slug = Str::slug($item['title'] ?? $item['label'] ?? 'aspiration');
            return array_merge($item, [
                'slug' => $slug,
                'image' => $item['front'] ?? $item['image_url'] ?? '',
                'body' => $item['back_text'] ?? $item['text'] ?? '',
                'back_title' => $item['back_title'] ?? ($item['title'] ?? ''),
                'link' => route('aspiration.show', $slug),
            ]);
        });

        $aspiration = $aspirations->firstWhere('slug', $slug);
        if (!$aspiration) {
            abort(404);
        }

        $others = $aspirations->reject(fn($a) => $a['slug'] === $slug)->values();

        return view('pages.aspiration-detail', [
            'aspiration' => $aspiration,
            'otherAspirations' => $others,
        ]);
    }

    public function about()
    {
        $pageMeta = \App\Models\NavigationLink::where('url', '/about')->value('page_meta') ?? [];
        $components = collect($pageMeta['components'] ?? []);
        $aboutComponent = $components->firstWhere('type', 'about_page');
        $aboutData = [
            'hero' => [
                'label' => 'The Africa We Want',
                'title' => 'About Agenda 2063',
                'subtitle' => "Africa's Blueprint for Transformation into the Global Powerhouse of the Future",
                'images' => [
                    'https://agenda2063.africa/assets/banner1.jpeg',
                    'https://agenda2063.africa/assets/news4.png',
                    'https://agenda2063.africa/assets/news3.png',
                    'https://agenda2063.africa/assets/Aspiration1.png',
                ],
            ],
            'sections' => [
                [
                    'id' => 'overview',
                    'title' => 'About the Africa We Want',
                    'intro' => "AGENDA 2063 is Africa's blueprint and master plan for transforming Africa into the global powerhouse of the future.",
                    'paragraphs' => [
                        'The genesis of Agenda 2063 was the realisation by African leaders that there was a need to refocus and reprioritise Africa\'s agenda from the struggle against apartheid and the attainment of political independence for the continent which had been the focus of The Organisation of African Unity (OAU), the precursor of the African Union; and instead to prioritise inclusive social and economic development, continental and regional integration, democratic governance and peace and security amongst other issues aimed at repositioning Africa to becoming a dominant player in the global arena.',
                        'As an affirmation of their commitment to support Africa\'s new path for attaining inclusive and sustainable economic growth and development African heads of state and government signed the 50th Anniversary Solemn Declaration during the Golden Jubilee celebrations of the formation of the OAU /AU in May 2013. The declaration marked the re-dedication of Africa towards the attainment of the Pan African Vision of An integrated, prosperous and peaceful Africa, driven by its own citizens, representing a dynamic force in the international arena and Agenda 2063 is the concrete manifestation of how the continent intends to achieve this vision within a 50 year period from 2013 to 2063.',
                    ],
                ],
                [
                    'id' => 'goals',
                    'title' => 'Goals & Priority Areas of Agenda 2063',
                    'intro' => "Agenda 2063 has identified 20 goals and priority areas that will guide Africa's transformation over the next 50 years.",
                    'paragraphs' => [
                        'The goals encompass economic prosperity, infrastructure development, education and skills development, health and nutrition, agricultural transformation, modern and livable habitats, environmentally sustainable climate-resilient economies, united Africa through federal or confederate governance, world-class infrastructure, quality education and skills revolution, healthy and well-nourished citizens, transformed economies and job creation, modern agriculture for increased production and productivity, blue/ocean economy, and African cultural renaissance.',
                        'Each goal is supported by specific targets and indicators that allow for monitoring and evaluation of progress. The goals are interconnected and mutually reinforcing, ensuring a holistic approach to Africa\'s development. Implementation is coordinated at continental, regional, and national levels to ensure alignment and maximize impact.',
                    ],
                ],
                [
                    'id' => 'implementation',
                    'title' => 'The First Ten-Year Implementation Plan',
                    'intro' => 'The First Ten-Year Implementation Plan (2014-2023) set the foundation for achieving Agenda 2063\'s vision.',
                    'paragraphs' => [
                        'The plan emphasized structural economic transformation and inclusive growth, science, technology and innovation, people-centered development, environmental sustainability, peace and security, and finance and partnerships. It established clear milestones, targets, and indicators to track progress and ensure accountability.',
                        'During this period, significant progress was made in establishing the African Continental Free Trade Area, advancing infrastructure projects, improving governance systems, and strengthening regional integration. The lessons learned from the first ten-year plan are now informing the second implementation phase (2024-2033), which aims to accelerate progress and address remaining challenges.',
                    ],
                ],
                [
                    'id' => 'flagship',
                    'title' => 'Flagship Projects of Agenda 2063',
                    'intro' => 'Transformative initiatives designed to accelerate Africa\'s economic growth and development.',
                    'paragraphs' => [
                        'Key flagship projects include the Integrated High-Speed Train Network, the African Continental Free Trade Area (AfCFTA), the African Commodities Strategy, the Single African Air Transport Market (SAATM), the African Passport and free movement of people, the Pan-African E-Network, and the Pan-African Virtual and E-University.',
                        'These projects are at various stages of implementation, with some already showing tangible results. The AfCFTA, for instance, has been operationalized and is facilitating increased intra-African trade.',
                    ],
                ],
                [
                    'id' => 'national',
                    'title' => 'National & RECs Development Priorities',
                    'intro' => 'Strong coordination between continental, regional, and national levels is essential.',
                    'paragraphs' => [
                        'Each member state has aligned its national development plans with Agenda 2063 priorities. RECs serve as building blocks for continental integration, facilitating regional cooperation on trade, infrastructure, peace and security, and other priority areas.',
                        'Regular monitoring and reporting mechanisms track progress; best practices are shared to foster learning and innovation.',
                    ],
                ],
                [
                    'id' => 'frameworks',
                    'title' => 'Continental Frameworks',
                    'intro' => 'Agenda 2063 is supported by continental frameworks and policies that guide thematic areas.',
                    'paragraphs' => [
                        'Key frameworks include the African Governance Architecture (AGA), the African Peace and Security Architecture (APSA), the Programme for Infrastructure Development in Africa (PIDA), the Comprehensive Africa Agriculture Development Programme (CAADP), and the Science, Technology and Innovation Strategy for Africa (STISA-2024).',
                        'These frameworks provide a common language for addressing priorities and mobilizing resources.',
                    ],
                ],
                [
                    'id' => 'outcomes',
                    'title' => 'Key Transformational Outcomes of Agenda 2063',
                    'intro' => 'Specific transformational outcomes that will change Africa\'s trajectory.',
                    'paragraphs' => [
                        'Outcomes include a prosperous Africa with high standards of living, an integrated continent with seamless movement, a peaceful and secure Africa, a democratic Africa with respect for human rights, an Africa with a strong cultural identity, an influential global player, and people-driven development unleashing women and youth.',
                    ],
                ],
            ],
            'sidebar' => [
                ['id' => 'overview', 'label' => 'Overview'],
                ['id' => 'goals', 'label' => 'Goals & Priority Areas of Agenda 2063'],
                ['id' => 'implementation', 'label' => 'The First-Ten Year Implementation Plan'],
                ['id' => 'flagship', 'label' => 'Flagship Projects of Agenda 2063'],
                ['id' => 'national', 'label' => 'National & RECs Development Priorities'],
                ['id' => 'frameworks', 'label' => 'Continental Frameworks'],
                ['id' => 'outcomes', 'label' => 'Key Transformational Outcomes of Agenda 2063'],
            ],
            'moonshots' => [
                ['number' => '01', 'icon' => 'fa-graduation-cap', 'title' => 'Education Revolution', 'text' => '100% of African children will complete primary and secondary education with quality learning outcomes', 'progress' => 45],
                ['number' => '02', 'icon' => 'fa-heart-pulse', 'title' => 'Universal Healthcare', 'text' => 'All Africans will have access to quality and affordable healthcare services', 'progress' => 38],
                ['number' => '03', 'icon' => 'fa-bolt', 'title' => 'Energy Access', 'text' => 'Universal access to clean, reliable, and affordable energy for all African households', 'progress' => 52],
                ['number' => '04', 'icon' => 'fa-wifi', 'title' => 'Digital Connectivity', 'text' => '100% broadband connectivity across Africa with affordable internet access for all', 'progress' => 41],
                ['number' => '05', 'icon' => 'fa-utensils', 'title' => 'Food Security', 'text' => 'End hunger and ensure food security through sustainable agriculture and nutrition', 'progress' => 35],
                ['number' => '06', 'icon' => 'fa-industry', 'title' => 'Industrialization', 'text' => 'Transform Africa into a manufacturing hub with value-added production across all sectors', 'progress' => 29],
                ['number' => '07', 'icon' => 'fa-leaf', 'title' => 'Climate Resilience', 'text' => 'Build climate-resilient economies and communities with sustainable environmental practices', 'progress' => 44],
                ['number' => '08', 'icon' => 'fa-users', 'title' => 'Youth Empowerment', 'text' => 'Empower African youth with skills, opportunities, and leadership for the future', 'progress' => 48],
                ['number' => '09', 'icon' => 'fa-venus-mars', 'title' => 'Gender Equality', 'text' => "Achieve full gender equality and women's empowerment in all spheres of life", 'progress' => 56],
            ],
            'timeline' => [
                ['period' => '2013', 'title' => 'Agenda 2063 Adopted', 'text' => "African Union Heads of State and Government adopted Agenda 2063 as Africa's development blueprint", 'active' => false],
                ['period' => '2014-2023', 'title' => 'First Ten-Year Plan', 'text' => 'Implementation of the first 10-year plan with focus on flagship projects and priority areas', 'active' => false],
                ['period' => '2024-2033', 'title' => 'Second Ten-Year Plan', 'text' => 'Accelerating implementation with enhanced focus on industrialization and integration', 'active' => true],
                ['period' => '2034-2043', 'title' => 'Third Ten-Year Plan', 'text' => 'Consolidating gains and scaling up successful initiatives across the continent', 'active' => false],
                ['period' => '2044-2053', 'title' => 'Fourth Ten-Year Plan', 'text' => 'Advancing towards full realization of Agenda 2063 aspirations and goals', 'active' => false],
                ['period' => '2054-2063', 'title' => 'Final Ten-Year Plan', 'text' => 'Achieving the vision of a prosperous, integrated, and peaceful Africa', 'active' => false],
            ],
        ];

        $source = $aboutComponent ?? ($pageMeta['about'] ?? null);
        if (!empty($source) && is_array($source)) {
            $aboutData = array_replace_recursive($aboutData, $source);
        }

        $timelineItems = $components->firstWhere('type', 'timeline')['items'] ?? $aboutData['timeline'];

        return view('pages.about', compact('aboutData', 'pageMeta', 'timelineItems'));
    }

    public function performance()
    {
        return view('pages.performance');
    }

    public function news()
    {
        $locale = app()->getLocale();
        $items = \App\Models\NewsItem::with('category')
            ->where('status', 'published')
            ->orderByDesc('published_at')
            ->orderByDesc('created_at')
            ->get();

        $featured = $items->firstWhere('featured', true) ?? $items->first();

        $map = function (\App\Models\NewsItem $item) use ($locale) {
            return [
                'title' => $item->localizedTitle($locale),
                'slug' => $item->slug,
                'summary' => \Illuminate\Support\Str::limit(strip_tags($item->localizedSummary($locale) ?: $item->localizedBody($locale)), 320),
                'type' => $item->type,
                'category' => $item->category?->name ?? $item->category ?? ucfirst($item->type),
                'date' => optional($item->published_at)->format('M d, Y'),
                'image' => $item->banner_path ? \Illuminate\Support\Facades\Storage::url($item->banner_path) : asset('images/flagships/placeholder.svg'),
                'url' => route('news.detail', $item->slug ?: $item->id),
                'location' => $item->location,
                'starts_at' => optional($item->starts_at)->format('M d, Y'),
                'ends_at' => optional($item->ends_at)->format('M d, Y'),
            ];
        };

        $featuredCard = $featured ? $map($featured) : null;
        $cards = $items->reject(fn($i) => $featured && $i->id === $featured->id)->map($map)->values();

        return view('pages.news', compact('featuredCard', 'cards'));
    }

    public function newsDetail($slug = null)
    {
        if (empty($slug)) {
            return redirect()->route('news');
        }

        $locale = app()->getLocale();
        $item = \App\Models\NewsItem::with(['attachments','category'])
            ->where(function($q) use ($slug) {
                $q->where('slug', $slug);
                if (is_numeric($slug)) {
                    $q->orWhere('id', (int)$slug);
                }
            })
            ->where('status', 'published')
            ->first();

        if (!$item) {
            abort(404);
        }

        $data = [
            'title' => $item->localizedTitle($locale),
            'category' => $item->category?->name ?? $item->category ?? ucfirst($item->type),
            'type' => $item->type,
            'date' => optional($item->published_at)->format('M d, Y'),
            'location' => $item->location,
            'image' => $item->banner_path ? \Illuminate\Support\Facades\Storage::url($item->banner_path) : asset('images/flagships/placeholder.svg'),
            'body' => $item->localizedBody($locale) ?? $item->localizedSummary($locale),
            'attachments' => $item->attachments->map(function($att){
                return [
                    'label' => $att->label ?: 'Download',
                    'url' => $att->file_url ?: ($att->file_path ? \Illuminate\Support\Facades\Storage::url($att->file_path) : null),
                ];
            })->filter(fn($a)=>!empty($a['url']))->values(),
        ];

        return view('pages.news-detail', compact('data'));
    }

    public function knowledgeBase()
    {
        return view('pages.knowledge-base');
    }

    public function flagshipProjects()
    {
        $placeholderImages = [
            asset('images/flagships/placeholder.svg'),
            asset('images/flagships/placeholder.svg'),
            asset('images/flagships/placeholder.svg'),
        ];
        $pageMeta = \App\Models\NavigationLink::where('url', '/flagship-projects')->value('page_meta') ?? [];
        $components = collect($pageMeta['components'] ?? []);
        $flagshipComp = $components->firstWhere('type', 'flagship_page');

        $defaultFlagships = [
            ['title'=>'INTEGRATED HIGH SPEED TRAIN NETWORK', 'subtitle'=>'Connecting African Capitals and Commercial Centres', 'image_url'=>'https://agenda2063.africa/assets/flagship-1.jpg', 'text'=>'Aims to connect all African capitals and commercial centres through a high-speed train network.', 'link'=>url('/about#flagship')],
            ['title'=>'AFRICAN COMMODITIES STRATEGY', 'subtitle'=>"Transforming Africa's Commodities Sector", 'image_url'=>'https://agenda2063.africa/assets/flagship-2.jpg', 'text'=>'Developing a continental commodities strategy to enable African countries to add value.', 'link'=>url('/about#flagship')],
            ['title'=>'AFRICAN CONTINENTAL FREE TRADE AREA (AFCFTA)', 'subtitle'=>'Boosting Intra-African Trade', 'image_url'=>'https://agenda2063.africa/assets/flagship-3.jpg', 'text'=>"Accelerates intra-African trade and strengthens Africa's position in the global market.", 'link'=>url('/about#flagship')],
        ];

        $items = $flagshipComp['items'] ?? $pageMeta['flagship_items'] ?? $defaultFlagships;

        // Fallback to FlagshipProject model if component/items missing
        if (empty($items)) {
            $models = \App\Models\FlagshipProject::select('title','summary')->limit(9)->get();
            if ($models->count()) {
                $items = $models->map(function($m, $i) use ($placeholderImages) {
                    return [
                        'title' => $m->title,
                        'subtitle' => '',
                        'text' => $m->summary,
                        'link' => '#',
                        'image_url' => $placeholderImages[$i % count($placeholderImages)],
                    ];
                })->toArray();
            }
        }

        // Ensure every item has an image
        foreach ($items as $k => $item) {
            if (empty($item['image_url'])) {
                $items[$k]['image_url'] = $placeholderImages[$k % count($placeholderImages)];
            }
            // ensure public/relative URLs resolve
            if (isset($items[$k]['image_url']) && str_starts_with($items[$k]['image_url'], 'storage/')) {
                $items[$k]['image_url'] = asset($items[$k]['image_url']);
            }
        }

        $heroImages = [];
        if (!empty($flagshipComp['hero_image'])) {
            $heroImages[] = str_starts_with($flagshipComp['hero_image'], 'storage/') ? asset($flagshipComp['hero_image']) : $flagshipComp['hero_image'];
        }
        foreach ($items as $it) {
            if (!empty($it['image_url'])) {
                $heroImages[] = $it['image_url'];
            }
        }
        if (empty($heroImages)) {
            $heroImages[] = 'https://agenda2063.africa/assets/flagship-1.jpg';
        }

        $flagshipData = [
            'hero' => [
                'label' => 'Flagship Projects',
                'title' => $flagshipComp['title'] ?? 'Flagship Projects',
                'subtitle' => $flagshipComp['subtitle'] ?? 'Transformative initiatives accelerating Africa\'s integration',
                'images' => $heroImages,
            ],
            'sidebar' => [],
            'sections' => collect($items)->map(function ($item, $i) {
                $slug = \Illuminate\Support\Str::slug($item['title'] ?? 'flagship-'.$i);
                $paragraphs = $item['paragraphs'] ?? [$item['text'] ?? ''];
                if (is_string($paragraphs)) {
                    $paragraphs = [$paragraphs];
                }
                $paragraphs = collect($paragraphs)->filter(fn($p)=>trim((string)$p)!=='')->values()->all();
                if (empty($paragraphs) && !empty($item['text'])) {
                    $paragraphs = [$item['text']];
                }
                $tags = $item['tags'] ?? [];
                if (is_string($tags)) {
                    $tags = collect(explode(',', $tags))->map(fn($t)=>trim($t))->filter()->values()->all();
                }
                return [
                    'id' => $slug,
                    'title' => $item['title'] ?? '',
                    'intro' => $item['subtitle'] ?? '',
                    'paragraphs' => $paragraphs,
                    'image_url' => $item['image_url'] ?? '',
                    'link' => $item['link'] ?? '#',
                    'tags' => $tags,
                ];
            })->values()->all(),
        ];
        $flagshipData['sidebar'] = collect($flagshipData['sections'])->map(fn($s)=>['id'=>$s['id'],'label'=>$s['title']])->values()->all();

        return view('pages.flagship-projects', compact('flagshipData', 'pageMeta'));
    }

    public function continentalFrameworks()
    {
        return view('pages.continental-frameworks');
    }
}
