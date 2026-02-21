<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\NavigationLink;

class HomePageSeeder extends Seeder
{
    public function run(): void
    {
        $pageMeta = [
            'components' => [
                [
                    'type' => 'hero_slider',
                    'title' => 'Homepage Hero',
                    'slides' => [
                        [
                            'title' => 'Agenda 2063',
                            'subtitle' => 'The Africa We Want.',
                            'link_label' => 'Explore',
                            'link_url' => url('/about'),
                            'image_url' => '' . asset('images/flagships/au1.jpg') . '',
                            'alt' => 'Agenda 2063 banner',
                        ],
                        [
                            'title' => 'Flagship Projects',
                            'subtitle' => 'Catalytic initiatives accelerating integration',
                            'link_label' => 'View Projects',
                            'link_url' => url('/flagship-projects'),
                            'image_url' => '' . asset('images/flagships/au4.jpg') . '',
                            'alt' => 'Flagship projects collage',
                        ],
                        [
                            'title' => 'Continental Performance',
                            'subtitle' => 'Track aspirations, goals, and country progress',
                            'link_label' => 'See Dashboard',
                            'link_url' => url('/performance'),
                            'image_url' => '' . asset('images/flagships/au5.jpg') . '',
                            'alt' => 'Performance dashboard graphic',
                        ],
                        [
                            'title' => 'Voices of the Youth',
                            'subtitle' => 'Empowering women and young people to lead the future',
                            'link_label' => 'Youth Stories',
                            'link_url' => url('/news'),
                            'image_url' => '' . asset('images/flagships/au3.jpg') . '',
                            'alt' => 'Youth collaboration',
                        ],
                        [
                            'title' => 'Partnerships that Deliver',
                            'subtitle' => 'Collaboration across member states for shared prosperity',
                            'link_label' => 'See Collaborations',
                            'link_url' => url('/about#partners'),
                            'image_url' => '' . asset('images/flagships/au2.webp') . '',
                            'alt' => 'Partnership handshake',
                        ],
                    ],
                ],
                [
                    'type' => 'press',
                    'title' => 'Press Releases',
                    'items' => [[
                        'title' => 'African Union launches 2024 Agenda 2063 Continental Progress Report at Addis Ababa Summit',
                        'date' => '2024-02-11',
                        'text' => 'Key highlights from the continental progress report.',
                        'link' => url('/news/detail'),
                    ]],
                ],
                [
                    'type' => 'aspirations',
                    'title' => 'Aspirations',
                    'intro' => 'Seven aspirations powering Agenda 2063.',
                    'cards' => [
                        ['title'=>"Africa's Economic Growth", 'label'=>'Aspiration 1', 'front'=>'' . asset('images/flagships/Aspiration1.png') . '', 'back_title'=>'A Prosperous Africa', 'back_text'=>'Inclusive growth and sustainable development.', 'link'=>url('/about#goals')],
                        ['title'=>"Integrated Continent", 'label'=>'Aspiration 2', 'front'=>'' . asset('images/flagships/Aspiration2.png') . '', 'back_title'=>'Political Unity', 'back_text'=>'Pan-Africanism and Africa Renaissance.', 'link'=>url('/about#goals')],
                        ['title'=>"Good Governance", 'label'=>'Aspiration 3', 'front'=>'' . asset('images/flagships/Aspiration3.png') . '', 'back_title'=>'Rule of Law', 'back_text'=>'Democracy and human rights.', 'link'=>url('/about#goals')],
                        ['title'=>"Peace & Security", 'label'=>'Aspiration 4', 'front'=>'' . asset('images/flagships/Aspiration4.png') . '', 'back_title'=>'A Peaceful Africa', 'back_text'=>'Dialogue over conflict.', 'link'=>url('/about#goals')],
                        ['title'=>"Cultural Renaissance", 'label'=>'Aspiration 5', 'front'=>'' . asset('images/flagships/Aspiration5.png') . '', 'back_title'=>'Strong Identity', 'back_text'=>'Shared values and ethics.', 'link'=>url('/about#goals')],
                        ['title'=>"People-Driven", 'label'=>'Aspiration 6', 'front'=>'' . asset('images/flagships/Aspiration6.png') . '', 'back_title'=>'Youth & Women', 'back_text'=>'Harnessing people power.', 'link'=>url('/about#goals')],
                        ['title'=>"Global Player", 'label'=>'Aspiration 7', 'front'=>'' . asset('images/flagships/Aspiration7.png') . '', 'back_title'=>'Influential Partner', 'back_text'=>'A resilient and influential Africa.', 'link'=>url('/about#goals')],
                    ],
                ],
                [
                    'type' => 'flagships',
                    'title' => 'Flagship Projects',
                    'items' => [
                        ['title'=>'INTEGRATED HIGH SPEED TRAIN NETWORK', 'subtitle'=>'Connecting African Capitals and Commercial Centres', 'image_url'=>'' . asset('images/flagships/au6.jpg') . '', 'text'=>'Connecting all African capitals with high-speed rail.', 'link'=>url('/about#flagship')],
                        ['title'=>'AFRICAN COMMODITIES STRATEGY', 'subtitle'=>"Transforming Africa's Commodities Sector", 'image_url'=>'' . asset('images/flagships/au7.jpg') . '', 'text'=>'Continental commodities value-add strategy.', 'link'=>url('/about#flagship')],
                        ['title'=>'AFRICAN CONTINENTAL FREE TRADE AREA (AFCFTA)', 'subtitle'=>'Boosting Intra-African Trade', 'image_url'=>'' . asset('images/flagships/au.jpeg') . '', 'text'=>'Accelerates intra-African trade.', 'link'=>url('/about#flagship')],
                    ],
                ],
            ],
        ];

        NavigationLink::updateOrCreate(
            ['url' => '/', 'location' => 'header'],
            [
                'label' => 'Home',
                'position' => 0,
                'open_in_new_tab' => false,
                'is_active' => true,
                'locale' => app()->getLocale(),
                'page_meta' => $pageMeta,
            ]
        );
    }
}
