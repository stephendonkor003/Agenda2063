<?php

namespace App\Console\Commands;

use App\Mail\AspirationDailyMail;
use App\Models\CampaignSignup;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendDailyAspirationBroadcast extends Command
{
    protected $signature   = 'aspirations:daily-broadcast';
    protected $description = 'Send the daily Agenda 2063 aspiration spotlight email to all campaign subscribers';

    /** Full content for all 7 aspirations */
    public static function aspirations(): array
    {
        return [
            // ── Aspiration 1 ──────────────────────────────────────────────
            [
                'number'    => 1,
                'label'     => 'Aspiration 1',
                'title'     => "A Prosperous Africa",
                'subtitle'  => "Inclusive Growth & Sustainable Development",
                'image'     => asset('images/flagships/Aspiration1.png'),
                'color'     => '#1d6a2e',
                'accent'    => '#22c55e',
                'tagline'   => "Building an Africa free from poverty, where every citizen shares in the continent's prosperity.",
                'body'      => [
                    "Agenda 2063's first aspiration envisions a prosperous Africa based on inclusive growth and sustainable development — an Africa that has eradicated poverty and improved the livelihoods of all its people.",
                    "This aspiration calls for structural economic transformation: industrialisation, value addition, diversification away from commodity dependence, and the creation of decent jobs for Africa's rapidly growing and youthful workforce.",
                ],
                'quote'     => "A prosperous Africa is within our reach — but only if every African citizen is part of the growth story, not just a spectator.",
                'quote_src' => "Agenda 2063 Framework Document",
                'goals'     => [
                    ['title' => 'Industrialisation & Manufacturing',  'progress' => 29, 'text' => 'Transforming Africa into a value-adding manufacturing hub'],
                    ['title' => 'Energy Access for All',              'progress' => 52, 'text' => 'Universal access to clean, reliable, affordable energy'],
                    ['title' => 'Food Security & Agriculture',        'progress' => 35, 'text' => 'Ending hunger through sustainable agricultural transformation'],
                    ['title' => 'Digital Economy & Connectivity',     'progress' => 41, 'text' => '100% broadband connectivity across the continent'],
                ],
                'facts'     => [
                    'Africa hosts the world\'s largest free trade area by number of participating countries (AfCFTA — 54 member states).',
                    'The continent has the fastest-growing middle class globally, projected to reach 1.1 billion consumers by 2060.',
                    'Africa holds 60% of the world\'s uncultivated arable land, making it critical to global food security.',
                ],
                'flagships' => ['African Continental Free Trade Area (AfCFTA)', 'African Commodities Strategy', 'Pan-African E-Network'],
            ],

            // ── Aspiration 2 ──────────────────────────────────────────────
            [
                'number'    => 2,
                'label'     => 'Aspiration 2',
                'title'     => "An Integrated Continent",
                'subtitle'  => "Pan-Africanism & Africa's Renaissance",
                'image'     => asset('images/flagships/Aspiration2.png'),
                'color'     => '#1e40af',
                'accent'    => '#3b82f6',
                'tagline'   => "One Africa — politically united, economically integrated, and free for all its people to move and thrive.",
                'body'      => [
                    "Aspiration 2 envisions an integrated continent, politically united and grounded in the ideals of Pan-Africanism and the vision of Africa's Renaissance. It imagines an Africa where borders do not limit the movement of people, goods, and services.",
                    "This aspiration is brought to life through flagship initiatives such as the African Continental Free Trade Area (AfCFTA), the Integrated High-Speed Train Network, the Single African Air Transport Market (SAATM), and the African Passport — bold steps toward building a truly borderless Africa.",
                ],
                'quote'     => "Unity is not the absence of difference, but the presence of a shared purpose. Africa's strength lies in its togetherness.",
                'quote_src' => "African Union Commission",
                'goals'     => [
                    ['title' => 'Continental Free Trade (AfCFTA)',    'progress' => 61, 'text' => 'Operational free trade covering 1.3 billion people and $3.4 trillion GDP'],
                    ['title' => 'Free Movement of People',            'progress' => 38, 'text' => 'African Passport and visa-free access across member states'],
                    ['title' => 'Regional Infrastructure Networks',   'progress' => 33, 'text' => 'High-speed rail, road corridors, and energy interconnections'],
                    ['title' => 'Digital Connectivity',               'progress' => 41, 'text' => 'Integrated digital infrastructure spanning the continent'],
                ],
                'facts'     => [
                    'The AfCFTA is the world\'s largest free trade area by geographic coverage, encompassing all 54 AU member states.',
                    'Intra-African trade stands at approximately 16% of total African trade — Agenda 2063 targets raising this to over 50% by 2063.',
                    'SAATM, the Single African Air Transport Market, aims to open Africa\'s skies and reduce air travel costs by up to 35%.',
                ],
                'flagships' => ['Integrated High-Speed Train Network', 'African Continental Free Trade Area (AfCFTA)', 'Single African Air Transport Market (SAATM)'],
            ],

            // ── Aspiration 3 ──────────────────────────────────────────────
            [
                'number'    => 3,
                'label'     => 'Aspiration 3',
                'title'     => "Good Governance",
                'subtitle'  => "Democracy, Human Rights & the Rule of Law",
                'image'     => asset('images/flagships/Aspiration3.png'),
                'color'     => '#7c2d12',
                'accent'    => '#f97316',
                'tagline'   => "An Africa governed with integrity, where citizens' rights are protected and institutions serve the people.",
                'body'      => [
                    "Aspiration 3 calls for an Africa of good governance, democracy, respect for human rights, justice, and the rule of law. It envisions institutions that are accountable, transparent, and responsive to the needs of citizens at every level — continental, national, and local.",
                    "The aspiration recognises that no sustained development is possible without strong institutions. It champions gender equality in governance, independent judiciaries, free press, and participatory democracy as foundational pillars of the Africa We Want.",
                ],
                'quote'     => "Good governance is not an abstract principle — it is the bedrock upon which Africa's transformation must rest.",
                'quote_src' => "AU Heads of State Declaration, 2013",
                'goals'     => [
                    ['title' => 'Democratic Governance',              'progress' => 54, 'text' => 'Free, fair and credible elections across all member states'],
                    ['title' => 'Gender Equality in Leadership',      'progress' => 56, 'text' => 'Women\'s participation in governance at all levels'],
                    ['title' => 'Rule of Law & Accountability',       'progress' => 47, 'text' => 'Independent judiciary, anti-corruption frameworks'],
                    ['title' => 'Citizen Participation',              'progress' => 42, 'text' => 'Inclusive governance mechanisms engaging all Africans'],
                ],
                'facts'     => [
                    'Africa\'s Africa Peer Review Mechanism (APRM) is a unique continental governance self-assessment framework, now with 43 member states.',
                    'The number of democratic elections on the continent has increased significantly since 2000, reflecting a growing culture of democratic governance.',
                    'The AU\'s African Governance Architecture (AGA) provides a comprehensive framework for promoting democracy and human rights.',
                ],
                'flagships' => ['African Governance Architecture (AGA)', 'Africa Peer Review Mechanism (APRM)', 'African Court on Human and Peoples\' Rights'],
            ],

            // ── Aspiration 4 ──────────────────────────────────────────────
            [
                'number'    => 4,
                'label'     => 'Aspiration 4',
                'title'     => "A Peaceful & Secure Africa",
                'subtitle'  => "Silencing the Guns, Choosing Dialogue",
                'image'     => asset('images/flagships/Aspiration4.png'),
                'color'     => '#1e3a5f',
                'accent'    => '#0ea5e9',
                'tagline'   => "A continent free from conflict and violence, where dialogue and diplomacy prevail over arms.",
                'body'      => [
                    "Aspiration 4 envisions a peaceful and secure Africa — a continent free from conflict, terrorism, and violence, where disputes are resolved through dialogue rather than guns. Under the AU's 'Silencing the Guns' initiative, Africa has committed to ending all wars and civil conflicts by 2030.",
                    "Peace is recognised not merely as the absence of war, but as positive peace: security, justice, opportunity, and freedom. The aspiration includes fighting cross-border crime, terrorism, human trafficking, and illicit financial flows — threats that undermine development and stability across the continent.",
                ],
                'quote'     => "No development can take root in the soil of conflict. Peace is not a luxury — it is Africa's most urgent and essential investment.",
                'quote_src' => "AU Silencing the Guns Initiative",
                'goals'     => [
                    ['title' => 'Silencing the Guns by 2030',         'progress' => 43, 'text' => 'Ending all armed conflicts across AU member states'],
                    ['title' => 'Youth Empowerment for Peace',        'progress' => 48, 'text' => 'Engaging youth as agents of peace and stability'],
                    ['title' => 'Counter-Terrorism Frameworks',       'progress' => 38, 'text' => 'Continental mechanisms to combat violent extremism'],
                    ['title' => 'Post-Conflict Reconstruction',       'progress' => 31, 'text' => 'Rebuilding societies after conflict with sustainable institutions'],
                ],
                'facts'     => [
                    'The African Peace and Security Architecture (APSA) coordinates AU, RECs, and national efforts to prevent and manage conflict.',
                    'Africa hosts over 20 UN peacekeeping operations globally, with African troops providing the backbone of continental peace missions.',
                    'Economic losses from conflict in Africa are estimated at up to $100 billion per year — resources that could otherwise fund development.',
                ],
                'flagships' => ['African Peace and Security Architecture (APSA)', 'Silencing the Guns Initiative', 'Post-Conflict Reconstruction Framework'],
            ],

            // ── Aspiration 5 ──────────────────────────────────────────────
            [
                'number'    => 5,
                'label'     => 'Aspiration 5',
                'title'     => "A Strong Cultural Identity",
                'subtitle'  => "Heritage, Shared Values & African Ethics",
                'image'     => asset('images/flagships/Aspiration5.png'),
                'color'     => '#4c1d95',
                'accent'    => '#8b5cf6',
                'tagline'   => "An Africa that celebrates its heritage, speaks its languages, and builds its future on its own values.",
                'body'      => [
                    "Aspiration 5 envisions an Africa with a strong cultural identity, a common heritage, shared values, and a sense of ethics that is uniquely African. It calls for the protection, promotion, and nurturing of the rich cultural diversity that is one of the continent's greatest strengths.",
                    "This aspiration embraces African languages, arts, music, literature, and intellectual traditions as foundations of development — not relics of the past. It challenges the continent to lead a genuine cultural renaissance that draws on its heritage to shape a confident, proud, and purposeful African identity.",
                ],
                'quote'     => "Africa's culture is not a relic of our past — it is the living foundation of our future, the compass that guides the Africa We Want.",
                'quote_src' => "Agenda 2063 Cultural Renaissance Vision",
                'goals'     => [
                    ['title' => 'African Languages & Education',      'progress' => 36, 'text' => 'Teaching and learning in African languages across all levels'],
                    ['title' => 'Cultural Heritage Preservation',     'progress' => 49, 'text' => 'Protecting tangible and intangible African cultural heritage'],
                    ['title' => 'Creative Economy Development',       'progress' => 33, 'text' => 'Africa\'s arts, music and creative industries as economic drivers'],
                    ['title' => 'Pan-African Values & Identity',      'progress' => 44, 'text' => 'Shared values of Ubuntu, solidarity and mutual respect'],
                ],
                'facts'     => [
                    'Africa is home to over 2,000 languages — more than any other continent — representing unparalleled human cultural diversity.',
                    'Africa\'s creative industries have the potential to contribute over $500 billion to GDP by 2030, according to UNESCO.',
                    'The AU has designated 2023 as the Year of AfCFTA Implementation for Cultural and Creative Industries, recognising culture as an economic pillar.',
                ],
                'flagships' => ['Pan-African Virtual and E-University', 'African Cultural Renaissance Programme', 'Grand Inga Dam (cultural economic linkage)'],
            ],

            // ── Aspiration 6 ──────────────────────────────────────────────
            [
                'number'    => 6,
                'label'     => 'Aspiration 6',
                'title'     => "People-Driven Development",
                'subtitle'  => "Empowering Women, Youth & All Africans",
                'image'     => asset('images/flagships/Aspiration6.png'),
                'color'     => '#7f1d1d',
                'accent'    => '#ec4899',
                'tagline'   => "Africa's greatest asset is its people — especially the 420 million young Africans who will lead the continent's future.",
                'body'      => [
                    "Aspiration 6 envisions an Africa whose development is people-driven, relying on the full potential of African people — especially its women and youth. It is an Africa where no one is left behind, where children and families are nurtured, and where every citizen has a role in the continent's transformation.",
                    "This aspiration calls for gender equality, quality education, universal healthcare, and meaningful youth participation in decision-making. It recognises that Africa's demographic dividend — its young, growing, and increasingly educated population — is its most transformative resource.",
                ],
                'quote'     => "Africa's greatest resource is not its minerals or its land — it is its people. Empower them and the continent transforms itself.",
                'quote_src' => "AU Gender, Peace and Security Programme",
                'goals'     => [
                    ['title' => 'Gender Equality & Women\'s Rights',  'progress' => 56, 'text' => 'Full equality for women in all spheres of political and economic life'],
                    ['title' => 'Youth Empowerment',                  'progress' => 48, 'text' => 'Skills, jobs, and leadership opportunities for Africa\'s youth'],
                    ['title' => 'Education Revolution',               'progress' => 45, 'text' => '100% school completion with quality learning outcomes'],
                    ['title' => 'Universal Healthcare',               'progress' => 38, 'text' => 'Quality and affordable healthcare for every African'],
                ],
                'facts'     => [
                    'Over 60% of Africa\'s population is under 25, making it the world\'s youngest continent by median age.',
                    'Women-led businesses in Africa grow at 5× the rate of men-led businesses when given equal access to capital and markets.',
                    'Africa must create over 20 million new jobs per year by 2035 to absorb its growing youth population into the workforce.',
                ],
                'flagships' => ['African Women\'s Decade Implementation', 'Youth Employment Initiative', 'Pan-African Virtual and E-University'],
            ],

            // ── Aspiration 7 ──────────────────────────────────────────────
            [
                'number'    => 7,
                'label'     => 'Aspiration 7',
                'title'     => "Africa as a Global Player",
                'subtitle'  => "A Strong, United & Influential Global Partner",
                'image'     => asset('images/flagships/Aspiration7.png'),
                'color'     => '#064e3b',
                'accent'    => '#10b981',
                'tagline'   => "Africa is not seeking charity on the world stage — it is claiming its rightful place as an architect of the global order.",
                'body'      => [
                    "Aspiration 7 envisions Africa as a strong, united, resilient, and influential global player and partner. It sees a continent that shapes global rules and institutions — from the United Nations to the G20, from climate negotiations to international trade — rather than simply accepting decisions made by others.",
                    "This aspiration demands that Africa speak with one voice on the world stage. It calls for strengthening multilateral institutions, reforming global governance to reflect Africa's weight, accelerating South-South cooperation, and ensuring that Africa's 1.4 billion people are represented fairly in all international forums.",
                ],
                'quote'     => "Africa does not seek to be a spectator in the global arena — we are claiming our place as architects of the world order, on our own terms.",
                'quote_src' => "AU Agenda 2063 Global Partnership Framework",
                'goals'     => [
                    ['title' => 'Global Governance Reform',           'progress' => 39, 'text' => 'Africa\'s full representation at the UN Security Council and G20'],
                    ['title' => 'South-South Cooperation',            'progress' => 51, 'text' => 'Deepening partnerships with Global South nations'],
                    ['title' => 'Climate Leadership',                 'progress' => 44, 'text' => 'Africa leading global climate finance and adaptation negotiations'],
                    ['title' => 'Digital Sovereignty',                'progress' => 37, 'text' => 'Africa owning its data infrastructure and digital standards'],
                ],
                'facts'     => [
                    'Africa joined the G20 as a permanent member in 2023, a landmark recognition of the continent\'s growing global influence.',
                    'African countries collectively hold approximately 28% of votes in the United Nations General Assembly.',
                    'The AU\'s Common African Position (CAP) has been a decisive force in major global negotiations, from Paris Agreement to WTO reforms.',
                ],
                'flagships' => ['African Space Agency', 'Pan-African E-Network', 'African Continental Free Trade Area (AfCFTA)'],
            ],
        ];
    }

    public function handle(): int
    {
        // Rotate through the 7 aspirations — one per day, cyclically
        $aspirations = self::aspirations();
        $index       = (now()->dayOfYear - 1) % 7;
        $aspiration  = $aspirations[$index];

        $subscribers = CampaignSignup::whereNotNull('email')
            ->where('newsletter', true)
            ->get();

        if ($subscribers->isEmpty()) {
            $this->warn('No newsletter subscribers found — broadcast not sent.');
            return self::SUCCESS;
        }

        foreach ($subscribers as $subscriber) {
            Mail::to($subscriber->email, trim("{$subscriber->first_name} {$subscriber->last_name}"))
                ->send(new AspirationDailyMail($aspiration, $subscriber));
        }

        $this->info(
            "Daily aspiration broadcast sent: Aspiration {$aspiration['number']} — {$aspiration['title']} " .
            "→ {$subscribers->count()} subscriber(s)."
        );

        return self::SUCCESS;
    }
}
