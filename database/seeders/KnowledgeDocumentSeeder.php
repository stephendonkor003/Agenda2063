<?php

namespace Database\Seeders;

use App\Models\KnowledgeCategory;
use App\Models\KnowledgeDocument;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class KnowledgeDocumentSeeder extends Seeder
{
    public function run(): void
    {
        $categories = KnowledgeCategory::pluck('id', 'name');

        $docs = [
            [
                'title' => 'Agenda 2063 Framework (Popular Version)',
                'category' => 'Strategic Frameworks',
                'type' => 'link',
                'source_url' => 'https://example.com/agenda2063-framework.pdf',
                'summary' => 'Readable overview of the Agenda 2063 vision and flagship projects.',
                'status' => 'published',
                'language' => 'English',
            ],
            [
                'title' => 'AfCFTA Operational Guide',
                'category' => 'Economic Development',
                'type' => 'link',
                'source_url' => 'https://example.com/afcfta-guide.pdf',
                'summary' => 'Guide to implementation and customs procedures for AfCFTA.',
                'status' => 'published',
                'language' => 'English',
            ],
            [
                'title' => 'Continental Education Strategy for Africa (CESA)',
                'category' => 'Science & Technology',
                'type' => 'link',
                'source_url' => 'https://example.com/cesa.pdf',
                'summary' => 'Continental strategy document for education and skills revolution.',
                'status' => 'published',
                'language' => 'English',
            ],
        ];

        foreach ($docs as $doc) {
            KnowledgeDocument::updateOrCreate(
                ['slug' => Str::slug($doc['title'])],
                [
                    'title' => $doc['title'],
                    'category_id' => $categories[$doc['category']] ?? null,
                    'type' => $doc['type'],
                    'source_url' => $doc['source_url'],
                    'status' => $doc['status'],
                    'summary' => $doc['summary'],
                    'body' => $doc['summary'],
                    'language' => $doc['language'] ?? null,
                    'downloads' => rand(100, 1000),
                ]
            );
        }
    }
}
