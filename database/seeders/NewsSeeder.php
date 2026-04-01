<?php

namespace Database\Seeders;

use App\Models\NewsAttachment;
use App\Models\NewsCategory;
use App\Models\NewsItem;
use Illuminate\Database\Seeder;

class NewsSeeder extends Seeder
{
    public function run(): void
    {
        $categoryIds = NewsCategory::pluck('id', 'name');

        NewsItem::query()->delete();

        foreach ($this->officialNewsItems() as $item) {
            $newsItem = NewsItem::create([
                'title' => $item['title'],
                'slug' => $item['slug'],
                'type' => $item['type'],
                'status' => 'published',
                'category_id' => $categoryIds[$item['category']] ?? null,
                'category' => $item['category'],
                'summary' => $item['summary'],
                'body' => $this->buildBody($item['paragraphs'], $item['source_url'], $item['highlights'] ?? []),
                'banner_path' => $item['banner_path'],
                'featured' => $item['featured'] ?? false,
                'published_at' => $item['published_at'],
                'starts_at' => $item['starts_at'] ?? null,
                'ends_at' => $item['ends_at'] ?? null,
                'location' => $item['location'] ?? null,
            ]);

            NewsAttachment::create([
                'news_item_id' => $newsItem->id,
                'label' => 'Official African Union Source',
                'file_url' => $item['source_url'],
                'mime' => 'text/html',
            ]);
        }
    }

    protected function officialNewsItems(): array
    {
        return [
            [
                'title' => 'African Leaders Endorse and Launch the Africa Water Vision 2063 & Policy at 39th AU Summit',
                'slug' => 'africa-water-vision-2063-launch-au-summit',
                'type' => 'press',
                'category' => 'Infrastructure',
                'summary' => 'African leaders endorsed the Africa Water Vision 2063 and its policy framework at the 39th AU Summit, linking water security and safe sanitation directly to long-term Agenda 2063 delivery.',
                'published_at' => '2026-02-17 09:00:00',
                'banner_path' => 'news/banners/official/africa-water-vision-2063-launch.jpg',
                'source_url' => 'https://au.int/en/node/46026',
                'featured' => true,
                'paragraphs' => [
                    'At the 39th African Union Summit, leaders endorsed and launched the Africa Water Vision 2063 and its supporting policy framework as a continental response to water security, sanitation access, and long-term resilience. The decision reinforces that water and sanitation are not side issues: they are part of the infrastructure, health, productivity, and dignity agenda that underpins Agenda 2063.',
                    'The official AU release presents the vision as a coordinated continental effort rather than a stand-alone sector initiative. It connects national action, regional coordination, and long-term investment to the practical challenge of ensuring that safe water systems and sanitation services keep pace with urbanization, climate pressure, and population growth.',
                    'For the Agenda 2063 platform, this story signals a concrete policy shift with implications for infrastructure planning, resilience programming, and development accountability. It is also a useful public reference point for explaining how high-level AU summit decisions move from endorsement into policy guidance, implementation pathways, and member-state follow-through.',
                ],
                'highlights' => [
                    'Continental endorsement at the 39th AU Summit',
                    'Water availability and sanitation framed as Agenda 2063 priorities',
                    'Policy focus on implementation, resilience, and coordination',
                ],
            ],
            [
                'title' => 'AU Theme of the Year 2026 Calls for Safe Water and Sanitation Action',
                'slug' => 'au-theme-of-the-year-2026-water-and-sanitation',
                'type' => 'article',
                'category' => 'Infrastructure',
                'summary' => 'The African Union Theme of the Year 2026 places safe water availability and sanitation systems at the center of continental action, linking public health, dignity, resilience, and delivery of Agenda 2063 goals.',
                'published_at' => '2026-02-14 09:00:00',
                'banner_path' => 'news/banners/official/theme-of-the-year-2026-water.png',
                'source_url' => 'https://au.int/ar/node/45991',
                'paragraphs' => [
                    'The African Union Theme of the Year 2026 makes water availability and safe sanitation systems a central public priority for the continent. The message is framed as a call to action, highlighting that reliable water systems are inseparable from health, food systems, education, urban growth, and community resilience.',
                    'The theme matters beyond symbolism. It gives institutions, member states, and public-facing platforms a clear policy signal about what should be emphasized in communication, implementation planning, and visibility work during the year. That makes it especially relevant to Agenda 2063 reporting and public engagement efforts.',
                    'For this platform, the theme provides a coherent narrative frame for related summit decisions, technical policy work, infrastructure priorities, and public campaigns. It also gives visitors a clearer way to connect individual stories and events to one continental direction of travel.',
                ],
                'highlights' => [
                    'Theme of the Year 2026 focused on water and sanitation',
                    'Strong link to health, resilience, and public service delivery',
                    'Relevant to policy communication across AU institutions',
                ],
            ],
            [
                'title' => 'AUC Chairperson and Key Partners Welcome AU Media Fellowship Cohort 3.0 to Advance African Storytelling',
                'slug' => 'au-media-fellowship-cohort-3-african-storytelling',
                'type' => 'press',
                'category' => 'Press Releases',
                'summary' => 'The AU Media Fellowship Cohort 3.0 was welcomed as part of a wider effort to strengthen African storytelling, public-interest communication, and agenda-setting around continental priorities.',
                'published_at' => '2026-03-16 09:00:00',
                'banner_path' => 'news/banners/official/au-media-fellowship-cohort-3.jpg',
                'source_url' => 'https://au.int/en/pressreleases/20260316/auc-chairperson-and-key-partners-welcome-au-media-fellowship-cohort-30',
                'paragraphs' => [
                    'The official AU release on the AU Media Fellowship Cohort 3.0 presents the programme as a practical investment in stronger African storytelling. The emphasis is not only on media visibility, but on the quality of continental narratives, the ability to communicate policy and programme realities well, and the importance of African voices shaping public understanding.',
                    'By welcoming a new cohort with institutional and partner support, the release highlights the fellowship as part of a broader communications ecosystem. It reflects how media engagement can support accountability, public education, and wider awareness of Agenda 2063 priorities.',
                    "This is also important for the public platform because it shows a live bridge between programme visibility and official AU communications practice. The fellowship is not presented as a generic training opportunity; it is tied to the strategic need for informed, credible, and African-led storytelling around the continent's policy and development agenda.",
                ],
                'highlights' => [
                    'Third fellowship cohort formally welcomed',
                    'Focus on African storytelling and public-interest communication',
                    'Connects programme visibility to Agenda 2063 communication goals',
                ],
            ],
            [
                'title' => 'Second Africa Urban Forum (AUF2)',
                'slug' => 'second-africa-urban-forum-auf2',
                'type' => 'event',
                'category' => 'Events',
                'summary' => 'The Second Africa Urban Forum brings attention to the policy, planning, and knowledge-sharing work needed to guide inclusive and risk-informed urban development across the continent.',
                'published_at' => '2026-04-08 09:00:00',
                'starts_at' => '2026-04-08 09:00:00',
                'ends_at' => '2026-04-10 17:00:00',
                'banner_path' => 'news/banners/official/second-africa-urban-forum-auf2.jpeg',
                'source_url' => 'https://au.int/en/newsevents/20260408/second-africa-urban-forum-auf2',
                'paragraphs' => [
                    "The Second Africa Urban Forum is positioned as a convening space for urban policy, planning, and implementation dialogue at a time when cities are carrying more of the continent's demographic, infrastructure, and climate pressure. The official AU event page places the forum inside a broader conversation about sustainable and resilient urban transformation.",
                    'Urban growth is one of the clearest cross-cutting Agenda 2063 issues because it touches transport, housing, public services, risk management, jobs, and spatial inclusion all at once. Events like AUF2 matter because they bring that multi-sector thinking into one policy conversation rather than treating each challenge in isolation.',
                    'For public readers, the event helps explain why urban development is not just a local planning issue. It is part of the continental development agenda, and it depends on better data, coordination, and knowledge sharing between AU institutions, member states, and technical partners.',
                ],
                'highlights' => [
                    'Continental forum focused on inclusive urban development',
                    'Urban policy linked to resilience, services, and risk-informed planning',
                    'Direct relevance to Agenda 2063 implementation in growing cities',
                ],
            ],
            [
                'title' => '5th Session of the Sub-Committee on Tax and Illicit Financial Flows',
                'slug' => 'fifth-session-tax-and-illicit-financial-flows',
                'type' => 'event',
                'category' => 'Events',
                'summary' => 'The fifth session of the AU sub-committee on tax and illicit financial flows highlights the policy work needed to protect domestic resources and strengthen public finance for development.',
                'published_at' => '2026-03-31 09:00:00',
                'starts_at' => '2026-03-31 09:00:00',
                'ends_at' => '2026-04-02 17:00:00',
                'banner_path' => 'news/banners/official/tax-and-illicit-financial-flows-session.jpg',
                'source_url' => 'https://au.int/en/newsevents/20260331/5th-session-sub-committee-tax-and-illicit-financial-flows',
                'paragraphs' => [
                    'The fifth session of the sub-committee on tax and illicit financial flows brings an important economic governance issue back into focus: development priorities cannot be sustained if domestic resources are weakened by leakages, weak coordination, or cross-border financial abuse.',
                    'The official AU event listing positions the session as part of ongoing institutional work rather than a one-off discussion. That matters because resource mobilization, tax cooperation, and anti-IFF work are fundamental to funding the ambitions of Agenda 2063 in a durable way.',
                    'For the public site, this item helps connect governance language to real implementation stakes. Questions about taxation and illicit financial flows are not abstract technical debates. They shape whether states can finance infrastructure, social services, resilience, and long-term transformation priorities.',
                ],
                'highlights' => [
                    'Focus on tax cooperation and illicit financial flows',
                    'Strong connection to domestic resource mobilization',
                    'Relevant to sustainable financing of Agenda 2063 priorities',
                ],
            ],
            [
                'title' => 'Official Launch of the African Union Fellowship Programme on Disarmament and Non-Proliferation',
                'slug' => 'au-fellowship-disarmament-non-proliferation-launch',
                'type' => 'press',
                'category' => 'Peace & Security',
                'summary' => 'The official launch of the AU Fellowship Programme on Disarmament and Non-Proliferation connects capacity building to peace, security, and policy leadership on strategic issues.',
                'published_at' => '2025-07-15 09:00:00',
                'banner_path' => 'news/banners/official/disarmament-non-proliferation-fellowship.jpeg',
                'source_url' => 'https://au.int/en/pressreleases/20250715/official-launch-african-union-fellowship-programme-disarmament-and-non',
                'paragraphs' => [
                    "The official launch of the African Union Fellowship Programme on Disarmament and Non-Proliferation shows how specialised capacity-building can support the continent's peace and security agenda. The release frames the fellowship as a policy-facing intervention, not simply an academic exercise.",
                    'Disarmament and non-proliferation are often discussed at a distance from everyday development conversations, but the AU position makes clear that security governance is part of the same long-term vision that underpins stability, cooperation, and institutional confidence.',
                    'This item is especially useful within the platform because it expands the public understanding of what an AU fellowship can be. It demonstrates that fellowship programmes may support communications, technology, youth pathways, or high-level peace and security competencies depending on the strategic need.',
                ],
                'highlights' => [
                    'Specialized fellowship launched on disarmament and non-proliferation',
                    'Direct link between capacity building and peace governance',
                    'Expands the public understanding of AU fellowship models',
                ],
            ],
            [
                'title' => 'African Union and Germany Deepen Strategic Partnership to Advance Agenda 2063 Priorities',
                'slug' => 'au-germany-strategic-partnership-agenda-2063',
                'type' => 'press',
                'category' => 'Governance',
                'summary' => 'The African Union and Germany highlighted a deeper strategic partnership focused on advancing Agenda 2063 priorities through cooperation, alignment, and implementation support.',
                'published_at' => '2025-11-19 09:00:00',
                'banner_path' => 'news/banners/official/au-germany-strategic-partnership.jpeg',
                'source_url' => 'https://au.int/en/pressreleases/20251119/au-and-germany-deepen-strategic-partnership-advance-agenda-2063-priorities',
                'paragraphs' => [
                    'The official AU release on the partnership with Germany highlights the role of strategic cooperation in advancing Agenda 2063 priorities. Rather than describing partnership in generic diplomatic terms, the framing points back to implementation and support for continental priorities.',
                    'This is important because Agenda 2063 depends not only on internal coordination, but also on well-aligned partnerships that respect African priorities and contribute to execution. Public readers can see from this release that external cooperation is judged by how it supports the continental agenda rather than by symbolism alone.',
                    "For the platform, the item provides a concrete example of partnership diplomacy connected to delivery. It helps visitors understand that Agenda 2063 visibility is not only about internal AU programmes but also about how strategic partners align with the continent's own priorities and institutional direction.",
                ],
                'highlights' => [
                    'Strategic partnership framed around Agenda 2063 delivery',
                    'External cooperation linked to implementation priorities',
                    'Useful example of partnership alignment in practice',
                ],
            ],
            [
                'title' => 'African Union Commission Undertakes Humanitarian Assessment Mission to Madagascar',
                'slug' => 'auc-humanitarian-assessment-mission-madagascar',
                'type' => 'press',
                'category' => 'Press Releases',
                'summary' => 'The AU humanitarian assessment mission to Madagascar underscores coordination, solidarity, and evidence-based response planning after a major emergency shock.',
                'published_at' => '2026-03-14 09:00:00',
                'banner_path' => 'news/banners/official/humanitarian-mission-madagascar.jpeg',
                'source_url' => 'https://au.int/es/node/46135',
                'paragraphs' => [
                    "The AU Commission's humanitarian assessment mission to Madagascar reflects the operational side of continental solidarity. The official release explains that the mission was deployed to assess the situation, strengthen coordination with partners, and support a more informed response after a severe shock.",
                    'This kind of mission matters because resilience is not only about long-term planning; it also depends on how quickly institutions can assess needs, coordinate with national authorities and technical partners, and translate information into response planning.',
                    'On the Agenda 2063 platform, the item helps connect humanitarian action to the larger development vision. Crisis response, institutional coordination, and public communication are part of the same wider effort to protect people, maintain stability, and strengthen long-term resilience across member states.',
                ],
                'highlights' => [
                    'Assessment mission deployed to support coordinated response',
                    'Shows continental solidarity in practice',
                    'Connects humanitarian response to resilience and institutional coordination',
                ],
            ],
        ];
    }

    protected function buildBody(array $paragraphs, string $sourceUrl, array $highlights = []): string
    {
        $html = collect($paragraphs)
            ->map(fn ($paragraph) => '<p>' . e($paragraph) . '</p>')
            ->implode('');

        if ($highlights !== []) {
            $html .= '<h3>Key Points</h3><ul>';
            foreach ($highlights as $highlight) {
                $html .= '<li>' . e($highlight) . '</li>';
            }
            $html .= '</ul>';
        }

        $html .= '<p><a href="' . e($sourceUrl) . '" target="_blank" rel="noopener">Read the official African Union source</a></p>';

        return $html;
    }
}
