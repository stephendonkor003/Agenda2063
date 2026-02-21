<?php

namespace Database\Seeders;

use App\Models\Publication;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PublicationSeeder extends Seeder
{
    public function run(): void
    {
        $seed = [
            [
                'title' => 'Agenda 2063: The Africa We Want - Popular Version',
                'type' => 'report',
                'language' => 'English',
                'year' => 2026,
                'file_url' => 'https://example.com/agenda2063-popular.pdf',
                'summary' => 'Official summary document for public dissemination.',
                'downloads' => 1800,
            ],
            [
                'title' => 'Continental Policy Brief on Youth Employment',
                'type' => 'policy-brief',
                'language' => 'English',
                'year' => 2025,
                'file_url' => 'https://example.com/youth-employment.pdf',
                'summary' => 'Key recommendations to accelerate youth employment initiatives.',
                'downloads' => 920,
            ],
            [
                'title' => 'Research Paper: Digital Transformation in Africa',
                'type' => 'research-paper',
                'language' => 'French',
                'year' => 2024,
                'file_url' => 'https://example.com/digital-transformation.pdf',
                'summary' => 'Study on digital infrastructure and innovation ecosystems.',
                'downloads' => 640,
            ],
        ];

        foreach ($seed as $data) {
            $data['slug'] = Str::slug($data['title']);
            Publication::firstOrCreate(['slug' => $data['slug']], $data);
        }
    }
}
