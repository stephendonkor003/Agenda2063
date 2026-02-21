<?php

namespace Database\Seeders;

use App\Models\NewsCategory;
use Illuminate\Database\Seeder;

class NewsCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Trade & Economy', 'type' => 'news', 'color' => '#2563eb'],
            ['name' => 'Governance', 'type' => 'news', 'color' => '#d97706'],
            ['name' => 'Peace & Security', 'type' => 'news', 'color' => '#b91c1c'],
            ['name' => 'Infrastructure', 'type' => 'news', 'color' => '#16a34a'],
            ['name' => 'Science & Technology', 'type' => 'news', 'color' => '#7c3aed'],
            ['name' => 'Events', 'type' => 'event', 'color' => '#0ea5e9'],
            ['name' => 'Summits', 'type' => 'event', 'color' => '#f59e0b'],
            ['name' => 'Press Releases', 'type' => 'press', 'color' => '#334155'],
        ];

        foreach ($categories as $cat) {
            NewsCategory::updateOrCreate(
                ['slug' => \Illuminate\Support\Str::slug($cat['name'] . '-' . $cat['type'])],
                $cat
            );
        }
    }
}
