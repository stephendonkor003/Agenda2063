<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\NavigationLink;
use App\Models\HomeSlider;
use App\Models\FooterLink;

class PublicVisibilitySeeder extends Seeder
{
    public function run(): void
    {
        NavigationLink::truncate();
        NavigationLink::insert([
            ['label' => 'Home', 'url' => url('/'), 'location' => 'header', 'position' => 1],
            ['label' => 'About', 'url' => url('/about'), 'location' => 'header', 'position' => 2],
            ['label' => 'Flagship Projects', 'url' => url('/flagship-projects'), 'location' => 'header', 'position' => 3],
            ['label' => 'News & Events', 'url' => url('/news'), 'location' => 'header', 'position' => 4],
            ['label' => 'Knowledge Base', 'url' => url('/knowledge-base'), 'location' => 'header', 'position' => 5],
            ['label' => 'Performance', 'url' => url('/performance'), 'location' => 'header', 'position' => 6],
        ]);

        HomeSlider::truncate();
        HomeSlider::insert([
            [
                'title' => 'The Africa We Want',
                'subtitle' => 'Agenda 2063 - 50-year blueprint for transformation',
                'image_url' => '' . asset('images/flagships/au1.jpg') . '',
                'cta_label' => 'Discover Agenda 2063',
                'cta_url' => url('/about'),
                'position' => 1,
                'active' => true,
            ],
            [
                'title' => 'Flagship Projects',
                'subtitle' => '15 catalytic initiatives accelerating integration',
                'image_url' => '' . asset('images/flagships/au4.jpg') . '',
                'cta_label' => 'View Projects',
                'cta_url' => url('/flagship-projects'),
                'position' => 2,
                'active' => true,
            ],
            [
                'title' => 'Continental Performance',
                'subtitle' => 'Track aspirations, goals, and country progress',
                'image_url' => '' . asset('images/flagships/au5.jpg') . '',
                'cta_label' => 'See Dashboard',
                'cta_url' => url('/performance'),
                'position' => 3,
                'active' => true,
            ],
            [
                'title' => 'Voices of the Youth',
                'subtitle' => 'Empowering women and young people to lead the future',
                'image_url' => '' . asset('images/flagships/au3.jpg') . '',
                'cta_label' => 'Youth Stories',
                'cta_url' => url('/news'),
                'position' => 4,
                'active' => true,
            ],
            [
                'title' => 'Partnerships that Deliver',
                'subtitle' => 'Collaboration across member states for shared prosperity',
                'image_url' => '' . asset('images/flagships/au2.webp') . '',
                'cta_label' => 'See Collaborations',
                'cta_url' => url('/about#partners'),
                'position' => 5,
                'active' => true,
            ],
        ]);

        FooterLink::truncate();
        FooterLink::insert([
            ['label' => 'About Agenda 2063', 'url' => url('/about'), 'section' => 'about', 'position' => 1, 'open_in_new_tab' => false],
            ['label' => 'Flagship Projects', 'url' => url('/flagship-projects'), 'section' => 'about', 'position' => 2, 'open_in_new_tab' => false],
            ['label' => 'Knowledge Base', 'url' => url('/knowledge-base'), 'section' => 'resources', 'position' => 1, 'open_in_new_tab' => false],
            ['label' => 'Publications', 'url' => url('/publications'), 'section' => 'resources', 'position' => 2, 'open_in_new_tab' => false],
            ['label' => 'Contact Us', 'url' => url('/contact'), 'section' => 'legal', 'position' => 1, 'open_in_new_tab' => false],
            ['label' => 'Privacy Notice', 'url' => '#', 'section' => 'legal', 'position' => 2, 'open_in_new_tab' => false],
            ['label' => 'Twitter', 'url' => 'https://twitter.com/africanunion', 'section' => 'social', 'position' => 1, 'open_in_new_tab' => true],
            ['label' => 'Facebook', 'url' => 'https://facebook.com/africanunioncommission', 'section' => 'social', 'position' => 2, 'open_in_new_tab' => true],
            ['label' => 'YouTube', 'url' => 'https://youtube.com', 'section' => 'social', 'position' => 3, 'open_in_new_tab' => true],
            ['label' => 'Instagram', 'url' => 'https://instagram.com', 'section' => 'social', 'position' => 4, 'open_in_new_tab' => true],
        ]);
    }
}
