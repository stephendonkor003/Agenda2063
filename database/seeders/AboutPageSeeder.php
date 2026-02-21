<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\NavigationLink;

class AboutPageSeeder extends Seeder
{
    public function run(): void
    {
        $heroImages = [
            'https://agenda2063.africa/assets/banner1.jpeg',
            'https://agenda2063.africa/assets/news4.png',
            'https://agenda2063.africa/assets/news3.png',
            'https://agenda2063.africa/assets/Aspiration1.png',
        ];

        $sections = [
            [
                'id' => 'overview',
                'title' => 'About the Africa We Want',
                'intro' => "AGENDA 2063 is Africa's blueprint and master plan for transforming Africa into the global powerhouse of the future.",
                'image_url' => 'https://agenda2063.africa/assets/Aspiration1.png',
                'paragraphs' => [
                    'The genesis of Agenda 2063 was the realisation by African leaders that there was a need to refocus and reprioritise Africa\'s agenda from the struggle against apartheid and the attainment of political independence for the continent which had been the focus of The Organisation of African Unity (OAU), the precursor of the African Union; and instead to prioritise inclusive social and economic development, continental and regional integration, democratic governance and peace and security amongst other issues aimed at repositioning Africa to becoming a dominant player in the global arena.',
                    'As an affirmation of their commitment to support Africa\'s new path for attaining inclusive and sustainable economic growth and development African heads of state and government signed the 50th Anniversary Solemn Declaration during the Golden Jubilee celebrations of the formation of the OAU /AU in May 2013. The declaration marked the re-dedication of Africa towards the attainment of the Pan African Vision of An integrated, prosperous and peaceful Africa, driven by its own citizens, representing a dynamic force in the international arena and Agenda 2063 is the concrete manifestation of how the continent intends to achieve this vision within a 50 year period from 2013 to 2063.',
                ],
            ],
            [
                'id' => 'goals',
                'title' => 'Goals & Priority Areas of Agenda 2063',
                'intro' => "Agenda 2063 has identified 20 goals and priority areas that will guide Africa's transformation over the next 50 years.",
                'image_url' => 'https://agenda2063.africa/assets/Aspiration2.png',
                'paragraphs' => [
                    'The goals encompass economic prosperity, infrastructure development, education and skills development, health and nutrition, agricultural transformation, modern and livable habitats, environmentally sustainable climate-resilient economies, united Africa through federal or confederate governance, world-class infrastructure, quality education and skills revolution, healthy and well-nourished citizens, transformed economies and job creation, modern agriculture for increased production and productivity, blue/ocean economy, and African cultural renaissance.',
                    'Each goal is supported by specific targets and indicators that allow for monitoring and evaluation of progress. The goals are interconnected and mutually reinforcing, ensuring a holistic approach to Africa\'s development. Implementation is coordinated at continental, regional, and national levels to ensure alignment and maximize impact.',
                ],
            ],
            [
                'id' => 'implementation',
                'title' => 'The First Ten-Year Implementation Plan',
                'intro' => 'The First Ten-Year Implementation Plan (2014-2023) set the foundation for achieving Agenda 2063\'s vision.',
                'image_url' => 'https://agenda2063.africa/assets/news4.png',
                'paragraphs' => [
                    'The plan emphasized structural economic transformation and inclusive growth, science, technology and innovation, people-centered development, environmental sustainability, peace and security, and finance and partnerships. It established clear milestones, targets, and indicators to track progress and ensure accountability.',
                    'During this period, significant progress was made in establishing the African Continental Free Trade Area, advancing infrastructure projects, improving governance systems, and strengthening regional integration. The lessons learned from the first ten-year plan are now informing the second implementation phase (2024-2033), which aims to accelerate progress and address remaining challenges.',
                ],
            ],
            [
                'id' => 'flagship',
                'title' => 'Flagship Projects of Agenda 2063',
                'intro' => 'Transformative initiatives designed to accelerate Africa\'s economic growth and development.',
                'image_url' => 'https://agenda2063.africa/assets/flagship-1.jpg',
                'paragraphs' => [
                    'Key flagship projects include the Integrated High-Speed Train Network, the African Continental Free Trade Area (AfCFTA), the African Commodities Strategy, the Single African Air Transport Market (SAATM), the African Passport and free movement of people, the Pan-African E-Network, and the Pan-African Virtual and E-University.',
                    'These projects are at various stages of implementation, with some already showing tangible results. The AfCFTA, for instance, has been operationalized and is facilitating increased intra-African trade.',
                ],
            ],
            [
                'id' => 'national',
                'title' => 'National & RECs Development Priorities',
                'intro' => 'Strong coordination between continental, regional, and national levels is essential.',
                'image_url' => 'https://agenda2063.africa/assets/Aspiration3.png',
                'paragraphs' => [
                    'Each member state has aligned its national development plans with Agenda 2063 priorities. RECs serve as building blocks for continental integration, facilitating regional cooperation on trade, infrastructure, peace and security, and other priority areas.',
                    'Regular monitoring and reporting mechanisms track progress; best practices are shared to foster learning and innovation.',
                ],
            ],
            [
                'id' => 'frameworks',
                'title' => 'Continental Frameworks',
                'intro' => 'Agenda 2063 is supported by continental frameworks and policies that guide thematic areas.',
                'image_url' => 'https://agenda2063.africa/assets/Aspiration4.png',
                'paragraphs' => [
                    'Key frameworks include the African Governance Architecture (AGA), the African Peace and Security Architecture (APSA), the Programme for Infrastructure Development in Africa (PIDA), the Comprehensive Africa Agriculture Development Programme (CAADP), and the Science, Technology and Innovation Strategy for Africa (STISA-2024).',
                    'These frameworks provide a common language for addressing priorities and mobilizing resources.',
                ],
            ],
            [
                'id' => 'outcomes',
                'title' => 'Key Transformational Outcomes of Agenda 2063',
                'intro' => 'Specific transformational outcomes that will change Africa\'s trajectory.',
                'image_url' => 'https://agenda2063.africa/assets/Aspiration7.png',
                'paragraphs' => [
                    'Outcomes include a prosperous Africa with high standards of living, an integrated continent with seamless movement, a peaceful and secure Africa, a democratic Africa with respect for human rights, an Africa with a strong cultural identity, an influential global player, and people-driven development unleashing women and youth.',
                ],
            ],
        ];

        $aboutData = [
            'hero' => [
                'label' => 'The Africa We Want',
                'title' => 'About Agenda 2063',
                'subtitle' => "Africa's Blueprint for Transformation into the Global Powerhouse of the Future",
                'images' => $heroImages,
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
            'sections' => $sections,
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
            'title' => 'About Page',
        ];

        NavigationLink::updateOrCreate(
            ['url' => '/about', 'location' => 'header'],
            [
                'label' => 'About',
                'position' => 2,
                'open_in_new_tab' => false,
                'is_active' => true,
                'locale' => app()->getLocale(),
                'page_meta' => [
                    'about' => $aboutData,
                    'components' => [
                        array_merge(['type' => 'about_page'], $aboutData),
                        [
                            'type' => 'timeline',
                            'title' => 'Our Journey to 2063',
                            'subtitle' => 'Key milestones in Africa\'s transformation',
                            'items' => $aboutData['timeline'],
                        ],
                    ],
                ],
            ]
        );
    }
}
