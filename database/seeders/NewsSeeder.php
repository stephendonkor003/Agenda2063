<?php

namespace Database\Seeders;

use App\Models\NewsCategory;
use App\Models\NewsItem;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class NewsSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('en_US');
        $cats = NewsCategory::pluck('id', 'name');

        $baseLong = 'Agenda 2063 drives integration, climate resilience, digital backbone build-out, food security, and people-centered governance across Africa. ';
        $longPara = fn(int $multiplier) => str_repeat($baseLong, $multiplier);

        $preset = [
            [
                'title' => 'AU Launches Continental Free Trade Training Week',
                'type' => 'article',
                'status' => 'published',
                'category' => 'Trade & Economy',
                'country_code' => 'GHA',
                'region_code' => 'ECOWAS',
                'summary' => 'Capacity building sessions for customs and SMEs on AfCFTA rules of origin.',
            ],
            [
                'title' => 'ECOWAS Heads of State Summit 2026',
                'type' => 'event',
                'status' => 'published',
                'category' => 'Events',
                'country_code' => 'NGA',
                'region_code' => 'ECOWAS',
                'summary' => 'Regional leaders meet in Abuja to review progress on regional integration.',
                'location' => 'Abuja, Nigeria',
            ],
            [
                'title' => 'Press Release: Agenda 2063 Mid-Term Review Findings',
                'type' => 'press',
                'status' => 'published',
                'category' => 'Press Releases',
                'summary' => 'Key highlights from the mid-term review of Agenda 2063 implementation.',
            ],
            [
                'title' => 'Africa Climate Adaptation Investment Forum 2026',
                'type' => 'event',
                'status' => 'published',
                'category' => 'Climate',
                'country_code' => 'ETH',
                'region_code' => 'EAC',
                'summary' => 'Ministers, financiers, and innovators convene to mobilize climate adaptation capital for agriculture and cities.',
                'location' => 'Addis Ababa, Ethiopia',
            ],
            [
                'title' => 'Deep Dive: African Union Digital Backbone Progress Report',
                'type' => 'article',
                'status' => 'published',
                'category' => 'Digital Transformation',
                'country_code' => 'ETH',
                'region_code' => 'EAC',
                'summary' => 'Comprehensive report on fibre corridors, data sovereignty, and inclusive access.',
                'body' => '<p>'.$longPara(500).'</p><p>'.$longPara(500).'</p><p>'.$longPara(500).'</p><p>'.$longPara(500).'</p><figure><img src="'.asset('images/flagships/placeholder.svg').'" alt="Digital Backbone"></figure>',
            ],
        ];

        $bulk = [];
        $types = [
            'article' => 120,
            'event' => 80,
            'press' => 80,
            'media' => 40,
        ];

        foreach ($types as $type => $count) {
            for ($i = 0; $i < $count; $i++) {
                $title = ucfirst($faker->sentence(rand(6, 10)));
                $category = $faker->randomElement(['Economy','Innovation','Health','Education','Climate','Transport','Digital Transformation','Governance','Trade & Economy']);
                $summary = $faker->paragraph(3);
                $bodyParas = [];
                // 4 long paragraphs ~5000 words total using repeated sentences
                for ($p = 0; $p < 4; $p++) {
                    $bodyParas[] = '<p>'.$faker->paragraphs(20, true).$longPara(50).'</p>';
                }
                $body = implode('', $bodyParas).'<figure><img src="'.asset('images/flagships/placeholder.svg').'" alt="'.$title.'"></figure>';
                $bulk[] = [
                    'title' => $title,
                    'type' => $type,
                    'status' => 'published',
                    'category' => $category,
                    'country_code' => strtoupper($faker->countryCode()),
                    'region_code' => strtoupper($faker->lexify('??')),
                    'summary' => $summary,
                    'body' => $body,
                    'location' => $type === 'event' ? $faker->city().', '.$faker->country() : null,
                    'starts_at' => $type === 'event' ? now()->addDays($faker->numberBetween(-30, 90)) : null,
                    'ends_at' => $type === 'event' ? now()->addDays($faker->numberBetween(1, 120)) : null,
                    'published_at' => now()->subDays(rand(1, 40)),
                ];
            }
        }

        $records = array_merge($preset, $bulk);

        foreach ($records as $item) {
            $body = $item['body'] ?? '<p>'.$item['summary'].'</p>';
            NewsItem::updateOrCreate(
                ['slug' => Str::slug($item['title']).'-'.Str::random(6)],
                [
                    'title' => $item['title'],
                    'type' => $item['type'],
                    'status' => $item['status'],
                    'category_id' => $cats[$item['category']] ?? null,
                    'category' => $item['category'],
                    'summary' => $item['summary'],
                    'body' => $body,
                    'country_code' => $item['country_code'] ?? null,
                    'region_code' => $item['region_code'] ?? null,
                    'location' => $item['location'] ?? null,
                    'starts_at' => $item['starts_at'] ?? null,
                    'ends_at' => $item['ends_at'] ?? null,
                    'published_at' => $item['published_at'] ?? now(),
                ]
            );
        }
    }
}
