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
        $locale = config('app.locale', 'en');

        $this->syncNavigationLink([
            'label' => 'Home',
            'url' => '/',
            'location' => 'header',
            'locale' => $locale,
            'position' => 0,
            'parent_id' => null,
            'open_in_new_tab' => false,
            'is_active' => true,
        ]);

        $this->syncNavigationLink([
            'label' => 'About',
            'url' => '/about',
            'location' => 'header',
            'locale' => $locale,
            'position' => 1,
            'parent_id' => null,
            'open_in_new_tab' => false,
            'is_active' => true,
        ]);

        $this->syncNavigationLink([
            'label' => 'Flagship Projects',
            'url' => '/flagship-projects',
            'location' => 'header',
            'locale' => $locale,
            'position' => 2,
            'parent_id' => null,
            'open_in_new_tab' => false,
            'is_active' => true,
        ]);

        $programmes = $this->syncNavigationLink([
            'label' => 'Programmes',
            'url' => '#',
            'location' => 'header',
            'locale' => $locale,
            'position' => 3,
            'parent_id' => null,
            'open_in_new_tab' => false,
            'is_active' => true,
            'page_meta' => [
                'nav_group' => 'programmes',
            ],
        ]);

        $this->syncNavigationLink([
            'label' => 'News & Events',
            'url' => '/news',
            'location' => 'header',
            'locale' => $locale,
            'position' => 4,
            'parent_id' => null,
            'open_in_new_tab' => false,
            'is_active' => true,
        ]);

        $this->syncNavigationLink([
            'label' => 'Knowledge Base',
            'url' => '/knowledge-base',
            'location' => 'header',
            'locale' => $locale,
            'position' => 5,
            'parent_id' => null,
            'open_in_new_tab' => false,
            'is_active' => true,
        ]);

        $this->syncNavigationLink([
            'label' => 'Performance',
            'url' => '/performance',
            'location' => 'header',
            'locale' => $locale,
            'position' => 6,
            'parent_id' => null,
            'open_in_new_tab' => false,
            'is_active' => true,
        ]);

        foreach ($this->programmeDefinitions() as $index => $programme) {
            $this->syncNavigationLink([
                'label' => $programme['label'],
                'url' => '/programmes/' . $programme['slug'],
                'location' => 'header',
                'locale' => $locale,
                'position' => $index,
                'parent_id' => $programmes->id,
                'open_in_new_tab' => false,
                'is_active' => true,
                'page_meta' => $this->programmePageMeta($programme),
            ]);
        }

        HomeSlider::truncate();
        HomeSlider::insert([
            [
                'title' => 'The Africa We Want',
                'subtitle' => 'Agenda 2063 - 50-year blueprint for transformation',
                'image_url' => '' . asset('images/flagships/au1.jpg') . '',
                'cta_label' => 'Discover Agenda 2063',
                'cta_url' => '/about',
                'position' => 1,
                'locale' => $locale,
                'is_active' => true,
                'active' => true,
            ],
            [
                'title' => 'Flagship Projects',
                'subtitle' => '15 catalytic initiatives accelerating integration',
                'image_url' => '' . asset('images/flagships/au4.jpg') . '',
                'cta_label' => 'View Projects',
                'cta_url' => '/flagship-projects',
                'position' => 2,
                'locale' => $locale,
                'is_active' => true,
                'active' => true,
            ],
            [
                'title' => 'Continental Performance',
                'subtitle' => 'Track aspirations, goals, and country progress',
                'image_url' => '' . asset('images/flagships/au5.jpg') . '',
                'cta_label' => 'See Dashboard',
                'cta_url' => '/performance',
                'position' => 3,
                'locale' => $locale,
                'is_active' => true,
                'active' => true,
            ],
            [
                'title' => 'Voices of the Youth',
                'subtitle' => 'Empowering women and young people to lead the future',
                'image_url' => '' . asset('images/flagships/au3.jpg') . '',
                'cta_label' => 'Youth Stories',
                'cta_url' => '/news',
                'position' => 4,
                'locale' => $locale,
                'is_active' => true,
                'active' => true,
            ],
            [
                'title' => 'Partnerships that Deliver',
                'subtitle' => 'Collaboration across member states for shared prosperity',
                'image_url' => '' . asset('images/flagships/au2.webp') . '',
                'cta_label' => 'See Collaborations',
                'cta_url' => '/about#partners',
                'position' => 5,
                'locale' => $locale,
                'is_active' => true,
                'active' => true,
            ],
        ]);

        foreach ($this->footerDefinitions($locale) as $footerLink) {
            $this->syncFooterLink($footerLink);
        }
    }

    protected function syncNavigationLink(array $attributes): NavigationLink
    {
        $matches = NavigationLink::query()
            ->where('location', $attributes['location'])
            ->where('locale', $attributes['locale'])
            ->where('label', $attributes['label'])
            ->when(
                array_key_exists('parent_id', $attributes) && $attributes['parent_id'] !== null,
                fn ($query) => $query->where('parent_id', $attributes['parent_id']),
                fn ($query) => $query->whereNull('parent_id')
            )
            ->orderBy('id')
            ->get();

        $link = $matches->first() ?? new NavigationLink();
        $link->fill($attributes);
        $link->save();

        if ($matches->count() > 1) {
            NavigationLink::query()
                ->whereIn('id', $matches->skip(1)->pluck('id'))
                ->delete();
        }

        return $link;
    }

    protected function syncFooterLink(array $attributes): FooterLink
    {
        $matches = FooterLink::query()
            ->where('section', $attributes['section'])
            ->where('locale', $attributes['locale'])
            ->where('label', $attributes['label'])
            ->orderBy('id')
            ->get();

        $link = $matches->first() ?? new FooterLink();
        $link->fill($attributes);
        $link->save();

        if ($matches->count() > 1) {
            FooterLink::query()
                ->whereIn('id', $matches->skip(1)->pluck('id'))
                ->delete();
        }

        return $link;
    }

    protected function programmeDefinitions(): array
    {
        return [
            [
                'label' => 'AU Media Fellowship',
                'slug' => 'au-media-fellowship',
                'subtitle' => 'Continental storytelling, journalism, and public-interest media engagement',
                'apply_url' => 'https://au.int/en/aumf',
                'body_html' => '<p>The AU Media Fellowship supports stronger African storytelling around integration, development priorities, and Agenda 2063 implementation. This page introduces the opportunity, explains its focus, and guides applicants toward the official application step.</p>',
                'sections' => [
                    [
                        'id' => 'overview',
                        'title' => 'Programme Overview',
                        'intro' => 'A platform for communicators, journalists, and media professionals engaging African Union priorities.',
                        'paragraphs' => [
                            'The fellowship can spotlight the type of media professionals targeted, the storytelling priorities in focus, and the outcomes expected from each cohort.',
                            'Each cycle can refresh this page with new themes, delivery formats, and collaboration opportunities.',
                        ],
                        'image_url' => asset('images/flagships/au1.jpg'),
                    ],
                    [
                        'id' => 'focus-areas',
                        'title' => 'Focus Areas',
                        'intro' => 'Typical focus areas may include public-interest reporting, AU programmes, digital storytelling, and continental visibility.',
                        'paragraphs' => [
                            'Thematic tracks, editorial priorities, and institutional partners can be presented here for each fellowship cycle.',
                            'This helps applicants assess whether their reporting background aligns with the current intake.',
                        ],
                        'image_url' => asset('images/flagships/au4.jpg'),
                    ],
                    [
                        'id' => 'application',
                        'title' => 'Application Guidance',
                        'intro' => 'The Apply Now button connects candidates to the official external application form.',
                        'paragraphs' => [
                            'Document requirements, deadlines, and portfolio expectations can be reviewed here before continuing.',
                            'The redirect modal will inform users that they are moving to another official domain.',
                        ],
                        'image_url' => asset('images/flagships/au5.jpg'),
                    ],
                ],
                'timeline' => [
                    ['period' => 'Call', 'title' => 'Applications Open', 'text' => 'Publish the fellowship call and communicate participation criteria.', 'active' => false],
                    ['period' => 'Review', 'title' => 'Editorial Assessment', 'text' => 'Review applications and shortlist the strongest media profiles.', 'active' => true],
                    ['period' => 'Cohort', 'title' => 'Fellowship Begins', 'text' => 'Selected fellows enter the programme and begin activities.', 'active' => false],
                ],
            ],
            [
                'label' => 'AU Tech Fellowship',
                'slug' => 'au-tech-fellowship',
                'subtitle' => 'Technology, digital public infrastructure, and innovation capacity development',
                'apply_url' => 'https://auinnovationfellowship.com/',
                'body_html' => '<p>The AU Tech Fellowship highlights current focus areas, technical domains, partner ecosystems, and the official route into the application process.</p>',
                'sections' => [
                    [
                        'id' => 'overview',
                        'title' => 'Programme Overview',
                        'intro' => 'A technology-focused programme space for innovation, digital capability, and continental collaboration.',
                        'paragraphs' => [
                            'This area can describe the technical themes covered by the fellowship and the problem spaces targeted in the current cohort.',
                            'It can also present mentor profiles, institutional partners, or delivery partners supporting the intake.',
                        ],
                        'image_url' => asset('images/flagships/au3.jpg'),
                    ],
                    [
                        'id' => 'tracks',
                        'title' => 'Innovation Tracks',
                        'intro' => 'Example tracks may include civic tech, digital transformation, AI, public-sector tools, and data systems.',
                        'paragraphs' => [
                            'Applicants can review the domains, expected outputs, and collaborative workstreams before leaving for the application platform.',
                            'The page can also clarify prototype expectations, solution areas, or policy-tech priorities.',
                        ],
                        'image_url' => asset('images/flagships/au2.webp'),
                    ],
                    [
                        'id' => 'application',
                        'title' => 'Application Guidance',
                        'intro' => 'The official application link is provided through the Apply Now action for the current fellowship cycle.',
                        'paragraphs' => [
                            'Portfolio requirements, engineering expectations, and overall selection stages can be reviewed before continuing.',
                            'The public guidance stays on the Agenda 2063 platform while the formal application can continue on the official partner domain.',
                        ],
                        'image_url' => asset('images/flagships/au5.jpg'),
                    ],
                ],
                'timeline' => [
                    ['period' => 'Launch', 'title' => 'Tech Fellowship Announced', 'text' => 'Open the cohort and publish the technical focus areas.', 'active' => false],
                    ['period' => 'Selection', 'title' => 'Review & Interviews', 'text' => 'Assess applicant capability, fit, and motivation.', 'active' => true],
                    ['period' => 'Delivery', 'title' => 'Build & Collaborate', 'text' => 'Selected fellows begin the implementation cycle.', 'active' => false],
                ],
            ],
            [
                'label' => 'AU Internship Programme',
                'slug' => 'au-internship-programme',
                'subtitle' => 'Structured learning and placement opportunities within AU institutions',
                'apply_url' => 'https://au.int/en/internship/apply',
                'body_html' => '<p>The AU Internship Programme page explains placement types, eligibility, duration, required documents, and the official application flow for interested candidates.</p>',
                'sections' => [
                    [
                        'id' => 'overview',
                        'title' => 'Programme Overview',
                        'intro' => 'A structured internship pathway that introduces participants to AU workstreams and institutional operations.',
                        'paragraphs' => [
                            'Department placements, duration, learning objectives, and the intended applicant profile can be outlined here.',
                            'This helps students and early-career applicants understand the opportunity before applying.',
                        ],
                        'image_url' => asset('images/flagships/au4.jpg'),
                    ],
                    [
                        'id' => 'requirements',
                        'title' => 'Eligibility Requirements',
                        'intro' => 'Clarify academic status, documentation, language expectations, and any country-specific requirements.',
                        'paragraphs' => [
                            'Clear requirements on this page help reduce incomplete applications on the external system.',
                            'Internship streams, offices, or reporting structures can also be described here.',
                        ],
                        'image_url' => asset('images/flagships/au1.jpg'),
                    ],
                    [
                        'id' => 'application',
                        'title' => 'Application Guidance',
                        'intro' => 'Set expectations for deadlines, CVs, transcripts, letters, and onboarding materials.',
                        'paragraphs' => [
                            'The Apply Now button connects users to the official AU application domain after they review the guidance on this page.',
                            'The redirect modal will confirm the external destination before leaving the platform.',
                        ],
                        'image_url' => asset('images/flagships/au5.jpg'),
                    ],
                ],
                'timeline' => [
                    ['period' => 'Open', 'title' => 'Internship Intake Opens', 'text' => 'Publish openings, timelines, and requirements.', 'active' => false],
                    ['period' => 'Screening', 'title' => 'Eligibility Review', 'text' => 'Review applications and shortlist suitable candidates.', 'active' => true],
                    ['period' => 'Placement', 'title' => 'Placement & Onboarding', 'text' => 'Assign successful candidates and begin orientation.', 'active' => false],
                ],
            ],
            [
                'label' => 'AU Youth Volunteer Corps',
                'slug' => 'au-youth-volunteer-corps',
                'subtitle' => 'Youth leadership, service, and continental engagement opportunities',
                'apply_url' => 'https://go.au.int/en/youth-volunteer-corps',
                'body_html' => '<p>The AU Youth Volunteer Corps page presents the opportunity overview, deployment focus, volunteer pathway, and official route into the application journey.</p>',
                'sections' => [
                    [
                        'id' => 'overview',
                        'title' => 'Programme Overview',
                        'intro' => 'A youth-focused engagement pathway for service, leadership, and practical continental contribution.',
                        'paragraphs' => [
                            'The page can describe the volunteer mandate, mission types, deployment environment, and expected contribution to Agenda 2063 priorities.',
                            'It can also share cohort stories, placement details, and service outcomes over time.',
                        ],
                        'image_url' => asset('images/flagships/au3.jpg'),
                    ],
                    [
                        'id' => 'volunteer-pathway',
                        'title' => 'Volunteer Pathway',
                        'intro' => 'Outline how volunteers are recruited, prepared, deployed, and supported.',
                        'paragraphs' => [
                            'Country, age, experience, or language expectations can be presented here along with the kind of support volunteers receive.',
                            'Focus sectors such as community engagement, policy support, innovation, or advocacy can also be highlighted.',
                        ],
                        'image_url' => asset('images/flagships/au2.webp'),
                    ],
                    [
                        'id' => 'application',
                        'title' => 'Application Guidance',
                        'intro' => 'The sidebar button redirects interested applicants to the official volunteer platform.',
                        'paragraphs' => [
                            'Deadlines, supporting documents, and any pre-deployment commitments or orientation steps can be reviewed on this page.',
                            'Applicants will see the external-domain transition modal before being redirected.',
                        ],
                        'image_url' => asset('images/flagships/au5.jpg'),
                    ],
                ],
                'timeline' => [
                    ['period' => 'Call', 'title' => 'Volunteer Call Published', 'text' => 'Announce the intake and participation conditions.', 'active' => false],
                    ['period' => 'Selection', 'title' => 'Assessment & Matching', 'text' => 'Screen profiles and match volunteers to programme needs.', 'active' => true],
                    ['period' => 'Deployment', 'title' => 'Placement Begins', 'text' => 'Selected volunteers enter the deployment cycle.', 'active' => false],
                ],
            ],
        ];
    }

    protected function footerDefinitions(string $locale): array
    {
        return [
            ['label' => 'About Agenda 2063', 'url' => '/about', 'section' => 'about', 'locale' => $locale, 'position' => 1, 'open_in_new_tab' => false, 'is_active' => true],
            ['label' => 'Flagship Projects', 'url' => '/flagship-projects', 'section' => 'about', 'locale' => $locale, 'position' => 2, 'open_in_new_tab' => false, 'is_active' => true],
            ['label' => 'Knowledge Base', 'url' => '/knowledge-base', 'section' => 'resources', 'locale' => $locale, 'position' => 1, 'open_in_new_tab' => false, 'is_active' => true],
            ['label' => 'Publications', 'url' => '/publications', 'section' => 'resources', 'locale' => $locale, 'position' => 2, 'open_in_new_tab' => false, 'is_active' => true],
            [
                'label' => 'Contact Us',
                'url' => '/contact',
                'section' => 'legal',
                'locale' => $locale,
                'position' => 1,
                'open_in_new_tab' => false,
                'is_active' => true,
                'page_meta' => $this->contactFooterPageMeta(),
            ],
            [
                'label' => 'Cookie Policy',
                'url' => '/privacy-notice#cookies',
                'section' => 'legal',
                'locale' => $locale,
                'position' => 2,
                'open_in_new_tab' => false,
                'is_active' => true,
            ],
            [
                'label' => 'Privacy Notice',
                'url' => '/privacy-notice',
                'section' => 'legal',
                'locale' => $locale,
                'position' => 3,
                'open_in_new_tab' => false,
                'is_active' => true,
                'page_meta' => $this->privacyFooterPageMeta(),
            ],
            [
                'label' => 'Site Terms',
                'url' => '/privacy-notice#terms',
                'section' => 'legal',
                'locale' => $locale,
                'position' => 4,
                'open_in_new_tab' => false,
                'is_active' => true,
            ],
            ['label' => 'Twitter', 'url' => 'https://twitter.com/_AfricanUnion', 'section' => 'social', 'locale' => $locale, 'position' => 1, 'open_in_new_tab' => true, 'is_active' => true],
            ['label' => 'Facebook', 'url' => 'https://www.facebook.com/AfricanUnionCommission', 'section' => 'social', 'locale' => $locale, 'position' => 2, 'open_in_new_tab' => true, 'is_active' => true],
            ['label' => 'YouTube', 'url' => 'https://www.youtube.com/AUCommission', 'section' => 'social', 'locale' => $locale, 'position' => 3, 'open_in_new_tab' => true, 'is_active' => true],
            ['label' => 'Flickr', 'url' => 'https://www.flickr.com/photos/africanunioncommission/', 'section' => 'social', 'locale' => $locale, 'position' => 4, 'open_in_new_tab' => true, 'is_active' => true],
        ];
    }

    protected function contactFooterPageMeta(): array
    {
        return [
            'page_type' => 'contact',
            'hero_title' => 'Contact Us',
            'hero_subtitle' => 'Official public contact, engagement, and platform guidance for Agenda 2063 visitors, partners, media, and institutions.',
            'hero_bg' => '#5e1e28',
            'hero_text' => '#ffffff',
            'body_html' => '<p>The Agenda 2063 platform is designed to connect citizens, institutions, media practitioners, researchers, and partners to official information about continental priorities, flagship initiatives, and public programmes. This contact page provides a clear route for public engagement and explains how enquiries are handled, routed, and followed up through the platform and the wider African Union ecosystem.</p><p>Use this page as the central reference point for public-facing communications. Administrators can keep it current with the right contact pathways, office guidance, regional coordination notes, and public engagement instructions without editing templates directly.</p>',
            'info_items' => [
                ['label' => 'Headquarters', 'value' => 'African Union Headquarters, Addis Ababa, Ethiopia'],
                ['label' => 'Postal Address', 'value' => 'P.O. Box 3243'],
                ['label' => 'Main Switchboard', 'value' => '+251 11 551 77 00'],
                ['label' => 'Primary Use', 'value' => 'Public enquiries, partnerships, programme referrals, and media coordination'],
            ],
            'components' => [
                [
                    'type' => 'about_page',
                    'title' => 'Contact Us',
                    'hero' => [
                        'label' => 'Contact & Engagement',
                        'title' => 'Contact Us',
                        'subtitle' => 'Official public contact and engagement guidance',
                        'images' => [
                            asset('images/flagships/au1.jpg'),
                            asset('images/flagships/au4.jpg'),
                            asset('images/flagships/au5.jpg'),
                        ],
                    ],
                    'sections' => [
                        [
                            'id' => 'overview',
                            'title' => 'Overview',
                            'intro' => 'A single contact page helps visitors understand where to direct questions and how the platform routes engagement.',
                            'paragraphs' => [
                                'Agenda 2063 spans policy communication, programme visibility, publications, data, youth engagement, and continental partnerships. Because those streams often involve different offices, this page helps visitors start from the right public-facing entry point instead of navigating disconnected channels.',
                                'It is also the right place to explain response expectations, business-hour coverage, and what information users should prepare before they submit a request. That reduces delays and helps administrators route enquiries to the correct programme or communications team.',
                            ],
                            'image_url' => asset('images/flagships/au5.jpg'),
                        ],
                        [
                            'id' => 'public-enquiries',
                            'title' => 'Public Enquiries',
                            'intro' => 'General enquiries should be framed clearly so the platform team can route them to the appropriate focal point.',
                            'paragraphs' => [
                                'Public users should identify whether they are asking about a publication, a programme or fellowship, a news item, performance information, a country or regional report, or a technical issue with the platform. Clear subject lines and short summaries help the team move requests faster.',
                                'When a question relates to a specific page, campaign, or document, the relevant page title and web address should be included. This allows faster internal escalation and reduces repeated clarification emails.',
                            ],
                            'image_url' => asset('images/flagships/au3.jpg'),
                        ],
                        [
                            'id' => 'media-and-partnerships',
                            'title' => 'Media & Partnerships',
                            'intro' => 'Media requests, institutional collaboration proposals, and partnership outreach should be separated from routine public enquiries.',
                            'paragraphs' => [
                                'Media professionals may need interview coordination, press material, event clarification, or verification of official announcements. Partnership and institutional contacts may need a different routing path for strategic dialogue, referrals, or programme coordination.',
                                'This page gives administrators room to clarify how those categories are handled, what supporting documents should be attached, and whether a request should first be directed to an AU department, programme secretariat, or communications unit.',
                            ],
                            'image_url' => asset('images/flagships/au4.jpg'),
                        ],
                        [
                            'id' => 'office-and-access',
                            'title' => 'Office & Access Guidance',
                            'intro' => 'Not every public interaction requires a physical visit, so the page should set expectations clearly.',
                            'paragraphs' => [
                                'Where an issue can be handled digitally, the page should encourage users to share concise written details first. That reduces congestion, supports better recordkeeping, and makes it easier to route matters across public visibility, content, and programme teams.',
                                'When an enquiry must be escalated to an official AU office or institutional desk, the page can explain that referral process and clarify that platform administrators may not directly resolve all requests but will route them responsibly.',
                            ],
                            'image_url' => asset('images/flagships/au2.webp'),
                        ],
                        [
                            'id' => 'response-process',
                            'title' => 'Response Process',
                            'intro' => 'A good contact page also explains what happens after a request is submitted.',
                            'paragraphs' => [
                                'Administrators can use this space to explain review windows, acknowledgement practices, and the difference between content corrections, public communications, and programme-specific decisions. That helps manage expectations for users across the continent who may be engaging from different time zones and institutions.',
                                'The same CMS page can also publish temporary notices during major summits, campaigns, or programme calls so users know when response volumes are unusually high or when a request should be directed to an external official domain.',
                            ],
                            'image_url' => asset('images/flagships/au1.jpg'),
                        ],
                    ],
                    'timeline' => [
                        ['period' => 'Step 1', 'title' => 'Submit a Clear Request', 'text' => 'Identify the page, programme, or issue and provide concise context.', 'active' => false],
                        ['period' => 'Step 2', 'title' => 'Routing & Review', 'text' => 'The public-facing team routes the request to the right focal point or content owner.', 'active' => true],
                        ['period' => 'Step 3', 'title' => 'Follow-up', 'text' => 'Users receive a response, clarification request, or official referral path.', 'active' => false],
                    ],
                ],
                [
                    'type' => 'timeline',
                    'title' => 'How Enquiries Move',
                    'subtitle' => 'Typical flow for public requests on the platform',
                    'items' => [
                        ['period' => 'Intake', 'title' => 'Request Received', 'text' => 'The team records the request and checks the topic area.', 'active' => false],
                        ['period' => 'Routing', 'title' => 'Correct Team Identified', 'text' => 'Requests are routed to communications, programme, content, or support contacts as appropriate.', 'active' => true],
                        ['period' => 'Resolution', 'title' => 'Reply or Referral', 'text' => 'Users receive a direct answer or are guided to the correct official channel.', 'active' => false],
                    ],
                ],
            ],
        ];
    }

    protected function privacyFooterPageMeta(): array
    {
        return [
            'page_type' => 'privacy',
            'hero_title' => 'Privacy Notice',
            'hero_subtitle' => 'How the Agenda 2063 platform handles visitor information, cookies, analytics, public records, and site-use expectations.',
            'hero_bg' => '#5e1e28',
            'hero_text' => '#ffffff',
            'body_html' => '<p>This Privacy Notice explains the public-facing privacy approach for the Agenda 2063 platform. It is designed to help visitors understand what information may be processed when they browse the site, interact with campaigns, read publications, use programme links, or submit limited public information through forms and analytics-enabled pages.</p><p>The page is also designed as an editable governance reference. Administrators can refine the wording over time to reflect operational practice, legal review, security hardening, and any approved changes to external services, communications workflows, or public reporting processes.</p>',
            'info_items' => [
                ['label' => 'Scope', 'value' => 'Agenda 2063 public platform'],
                ['label' => 'Topics Covered', 'value' => 'Privacy, cookies, analytics, retention, external links, and site terms'],
                ['label' => 'Content Model', 'value' => 'Admin-editable CMS page'],
                ['label' => 'Review Priority', 'value' => 'Public transparency and responsible data handling'],
            ],
            'components' => [
                [
                    'type' => 'about_page',
                    'title' => 'Privacy Notice',
                    'hero' => [
                        'label' => 'Privacy & Data',
                        'title' => 'Privacy Notice',
                        'subtitle' => 'Platform privacy, cookies, and site-use guidance',
                        'images' => [
                            asset('images/flagships/au4.jpg'),
                            asset('images/flagships/au1.jpg'),
                            asset('images/flagships/au5.jpg'),
                        ],
                    ],
                    'sections' => [
                        [
                            'id' => 'overview',
                            'title' => 'Overview',
                            'intro' => 'This notice explains the platform privacy posture in clear public language.',
                            'paragraphs' => [
                                'Visitors use the site to read news, access knowledge resources, browse programme pages, follow external official links, and interact with limited public features such as campaign signups or quizzes. The privacy notice should therefore explain the difference between passive browsing data, voluntary submissions, and content generated by administrators.',
                                'Because the platform serves a continental audience, the notice should be written clearly and updated regularly so users understand how their interactions are handled, what is stored, and when a request may be routed to another official domain or service.',
                            ],
                            'image_url' => asset('images/flagships/au5.jpg'),
                        ],
                        [
                            'id' => 'collection',
                            'title' => 'Information We May Process',
                            'intro' => 'The platform may process a limited set of user-provided and technical information.',
                            'paragraphs' => [
                                'This can include public-form submissions, analytics events, language preferences, device and browser data needed for security or service improvement, and operational logs used to protect the platform from abuse or service disruption.',
                                'The page should clarify that sensitive or special-category information is not requested through routine public engagement features unless a clearly identified official process states otherwise, and any such collection must be governed through explicit instructions and review.',
                            ],
                            'image_url' => asset('images/flagships/au3.jpg'),
                        ],
                        [
                            'id' => 'use',
                            'title' => 'How Information Is Used',
                            'intro' => 'Processing should remain tied to legitimate platform operations, security, and public communication purposes.',
                            'paragraphs' => [
                                'Typical uses include publishing and improving public content, supporting moderated campaign or quiz participation, maintaining service integrity, measuring high-level usage patterns, and responding to enquiries routed through the site or associated public visibility workflows.',
                                'Administrators can also use this section to explain that public information may be retained for audit, review, or service continuity reasons where necessary, while still applying minimisation and security principles.',
                            ],
                            'image_url' => asset('images/flagships/au4.jpg'),
                        ],
                        [
                            'id' => 'cookies',
                            'title' => 'Cookies & Analytics',
                            'intro' => 'Cookies and analytics features should be explained plainly and tied to service function, insight, and security.',
                            'paragraphs' => [
                                'The site may rely on functional cookies for session or language continuity and may use analytics tooling to understand page usage, engagement trends, and abuse signals. The notice should explain that these tools support service quality, visibility planning, and platform security rather than intrusive personal profiling.',
                                'Where visitors are taken to a different official domain, those services may apply their own cookie and privacy practices. The platform therefore uses a redirect notice before certain off-domain links so visitors understand when they are leaving this environment.',
                            ],
                            'image_url' => asset('images/flagships/au2.webp'),
                        ],
                        [
                            'id' => 'rights',
                            'title' => 'Access, Corrections & Retention',
                            'intro' => 'Users should know how to seek clarification, corrections, or records-related support.',
                            'paragraphs' => [
                                'This section can explain how visitors may request clarification about public-form submissions, ask for correction of information they voluntarily provided, or seek direction on where a rights-related request should be addressed within the responsible institutional structure.',
                                'Retention language should also explain that records are kept only as long as needed for public communication, audit, legal, administrative, or security purposes, after which they should be archived or removed in line with approved policy and operational needs.',
                            ],
                            'image_url' => asset('images/flagships/au1.jpg'),
                        ],
                        [
                            'id' => 'terms',
                            'title' => 'Site Terms',
                            'intro' => 'The privacy page can also carry core public site-use expectations in one place.',
                            'paragraphs' => [
                                'Users should rely on the platform for official public information, avoid misuse of interactive features, and refrain from actions that would interfere with service integrity, access control, content accuracy, or other users’ safe access to the site.',
                                'Administrators may revise this section over time to reflect legal review, security practice, content governance, and official operational updates affecting acceptable use, external linking, and access to downloadable materials.',
                            ],
                            'image_url' => asset('images/flagships/au4.jpg'),
                        ],
                    ],
                    'timeline' => [
                        ['period' => 'Collect', 'title' => 'Limited Data Intake', 'text' => 'Only the information needed for service, security, or public interaction is processed.', 'active' => false],
                        ['period' => 'Protect', 'title' => 'Safeguards Applied', 'text' => 'Security controls and operational review protect the platform and its users.', 'active' => true],
                        ['period' => 'Review', 'title' => 'Policies Updated', 'text' => 'The notice can be updated when platform practice or governance requirements change.', 'active' => false],
                    ],
                ],
                [
                    'type' => 'timeline',
                    'title' => 'Privacy Lifecycle',
                    'subtitle' => 'A simple view of collection, protection, and review',
                    'items' => [
                        ['period' => 'Collection', 'title' => 'Data Is Minimized', 'text' => 'Public inputs and service data are kept proportionate to the feature in use.', 'active' => false],
                        ['period' => 'Security', 'title' => 'Safeguards Operate', 'text' => 'Operational and technical controls protect access, records, and system integrity.', 'active' => true],
                        ['period' => 'Governance', 'title' => 'Notice Is Reviewed', 'text' => 'The page is maintained as an editable governance reference for the platform.', 'active' => false],
                    ],
                ],
            ],
        ];
    }

    protected function programmePageMeta(array $programme): array
    {
        return [
            'page_type' => 'programme',
            'hero_title' => $programme['label'],
            'hero_subtitle' => $programme['subtitle'],
            'hero_bg' => '#5e1e28',
            'hero_text' => '#ffffff',
            'cta_label' => 'Apply Now',
            'cta_url' => $programme['apply_url'],
            'body_html' => $programme['body_html'],
            'components' => [
                [
                    'type' => 'about_page',
                    'title' => $programme['label'],
                    'hero' => [
                        'label' => 'Programmes & Fellowships',
                        'title' => $programme['label'],
                        'subtitle' => $programme['subtitle'],
                        'images' => [
                            asset('images/flagships/au1.jpg'),
                            asset('images/flagships/au4.jpg'),
                            asset('images/flagships/au5.jpg'),
                        ],
                    ],
                    'sections' => $programme['sections'],
                    'moonshots' => [],
                    'timeline' => $programme['timeline'],
                ],
                [
                    'type' => 'timeline',
                    'title' => 'Programme Journey',
                    'subtitle' => 'Key stages for the current programme cycle',
                    'items' => $programme['timeline'],
                ],
            ],
        ];
    }
}
