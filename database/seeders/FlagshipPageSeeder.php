<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\NavigationLink;

class FlagshipPageSeeder extends Seeder
{
    public function run(): void
    {
        $local = asset('images/flagships/placeholder.svg');
        $flagships = [
            [
                'title'=>'INTEGRATED HIGH SPEED TRAIN NETWORK',
                'subtitle'=>'Connecting African Capitals and Commercial Centres',
                'image_url'=>$local,
                'paragraphs'=>[
                    'The Integrated High Speed Train Network is the anchor mobility project that knits together Africa’s capitals and commercial hubs with modern rail. It targets predictable sub‑10‑hour journeys between major cities, slashing logistics costs, unlocking new tourism corridors, and enabling time‑sensitive trade in perishables and manufactured goods.',
                    'Standard gauge tracks, unified signalling, and interoperable rolling stock create a single continental rail market. The project bundles local steel procurement, skills transfer for rail engineers, and regional maintenance hubs so that African firms own more of the value chain instead of importing every component.',
                    'Station areas are planned as transit‑oriented development zones with mixed housing, warehousing, and SME stalls to ensure the network spreads jobs beyond the right‑of‑way. Border post simplification and one‑stop customs are paired with the rail build to eliminate friction that would erode the speed gains.',
                    'The network complements road and air corridors for resilience. It is designed with climate‑smart embankments, solar‑powered stations, and regenerative braking to cut emissions, proving large infrastructure can be a climate solution while catalysing regional integration.',
                    'Blended finance models crowd in pension funds and sovereign wealth funds alongside multilateral lenders, reducing sovereign borrowing pressures. Local currency windows protect project cashflows from FX shocks, while community shareholdings keep citizens invested in protecting the asset.',
                    'A pan‑African rail academy underpins the talent pipeline for operations, signalling, cybersecurity, and rolling‑stock maintenance, ensuring the network is reliable decades after ribbon‑cutting and not dependent on imported expertise.',
                ],
                'tags'=>['transport','infrastructure','mobility'],
                'link'=>url('/news?flagship=train'),
            ],
            [
                'title'=>'AFRICAN COMMODITIES STRATEGY',
                'subtitle'=>"Transforming Africa's Commodities Sector",
                'image_url'=>$local,
                'paragraphs'=>[
                    'The African Commodities Strategy shifts the continent from raw‑material exporter to value‑adding powerhouse. It prioritises beneficiation of minerals, agro‑processing of cocoa, coffee, tea and cotton, and petrochemical upgrading that keeps more dollars circulating locally.',
                    'Common standards, quality labs, and warehousing receipt systems reduce rejection rates and price discounts African exporters face. Regional value chains are mapped so processing plants are placed where energy, water, and labour advantages converge while staying close to farming communities.',
                    'Price‑risk tools, floor‑price arrangements, and pooled insurance protect smallholders and cooperatives from volatility. Governments commit to smart tariffs and export‑tax rebates that encourage semi‑finished exports instead of unprocessed raw exports.',
                    'The strategy embeds green production requirements—renewable energy use, water recycling, and traceability—so African goods qualify for low‑carbon markets. It is backed by SME financing windows to help cooperatives upgrade equipment and meet certification faster.',
                    'Regional commodity exchanges publish transparent prices and standard contracts, giving farmers better bargaining power and buyers reliable quality guarantees. This information parity reduces predatory middle‑man behaviour and increases farmer incomes.',
                    'Women‑ and youth‑led cooperatives receive targeted technical assistance, packaging design support, and export readiness coaching, broadening who benefits from value addition instead of reinforcing legacy inequalities.',
                ],
                'tags'=>['commodities','trade','value-add'],
                'link'=>url('/news?flagship=commodities'),
            ],
            [
                'title'=>'AFRICAN CONTINENTAL FREE TRADE AREA (AFCFTA)',
                'subtitle'=>'Boosting Intra-African Trade',
                'image_url'=>$local,
                'paragraphs'=>[
                    'AfCFTA establishes the world’s largest single market by country count, covering goods, services, investment, and digital trade. Tariff schedules are being phased down while rules of origin are simplified so SMEs can actually claim preferences.',
                    'Customs modernisation—e‑seals, electronic single windows, and harmonised sanitary standards—reduces clearance times and spoilage for cross‑border agri‑trade. Mutual recognition of professional qualifications starts to free up services trade in engineering, legal, and health.',
                    'Industrialisation is embedded: sectors such as automotive, pharmaceuticals, textiles, and green tech have dedicated value‑chain programmes that connect suppliers in multiple regions to meet volume requirements for both African and export markets.',
                    'Startups benefit from larger addressable markets and interoperable mobile payments. Combined with logistics reforms, AfCFTA lowers market‑entry friction for innovators and anchors Africa’s bargaining power in global trade negotiations.',
                    'Dispute‑resolution panels and a trade observatory give firms and civil society a channel to flag non‑tariff barriers quickly, keeping momentum and trust in the agreement. Data dashboards make progress visible to the public.',
                    'Targeted adjustment funds help the most vulnerable sectors and countries transition, financing re‑skilling, factory retooling, and temporary revenue smoothing while new opportunities come online.',
                ],
                'tags'=>['trade','afcfta','integration'],
                'link'=>url('/news?flagship=afcfta'),
            ],
            [
                'title'=>'SINGLE AFRICAN AIR TRANSPORT MARKET',
                'subtitle'=>'Seamless Air Connectivity',
                'image_url'=>$local,
                'paragraphs'=>[
                    'SAATM opens African skies by granting fifth‑freedom rights to eligible carriers, allowing multi‑stop intra‑African routes that make air travel affordable and frequent. Lower slot costs and transparent fees target a tangible drop in ticket prices.',
                    'It expands cargo connectivity for horticulture, pharmaceuticals, and e‑commerce parcels, pairing with cold‑chain investments at secondary airports so value‑added agriculture can reliably reach markets within 24–48 hours.',
                    'The programme harmonises safety oversight, training standards, and maintenance approvals, reducing duplication and improving safety culture. Shared simulator centres and joint procurement lower costs for airlines while boosting pilot and technician pipelines.',
                    'Environmental performance is built in: newer, fuel‑efficient fleets, sustainable aviation fuel pilots, and carbon‑accounting dashboards prepare African aviation for tightening global regulations without slowing growth.',
                    'Airport economic zones are being upgraded with logistics parks, bonded warehouses, and SME export centres so aviation growth directly feeds manufacturing and agri‑processing employment.',
                    'Passenger rights charters, multilingual customer support, and accessibility standards ensure inclusivity, while gender‑balance targets in airline leadership widen participation in the sector.',
                ],
                'tags'=>['aviation','connectivity','saatm'],
                'link'=>url('/news?flagship=saatm'),
            ],
            [
                'title'=>'PAN-AFRICAN E-NETWORK',
                'subtitle'=>'Digital Backbone',
                'image_url'=>$local,
                'paragraphs'=>[
                    'The Pan‑African E‑Network is the continent’s shared digital backbone, interlinking universities, hospitals, research centres, and public institutions with high‑capacity fibre and satellite where fibre is not yet viable.',
                    'It powers telemedicine consultations, virtual diagnostics, and shared specialist rosters so rural clinics can access expertise in real time. For education, it enables live lectures, research repositories, and academic exchanges without travel costs.',
                    'The backbone is paired with regional cloud nodes to advance data sovereignty and reduce latency for African apps. Open‑access principles and fair wholesale pricing are mandated to drive down retail internet prices for citizens and startups.',
                    'Cybersecurity operations centres and training tracks are embedded so that connectivity gains are matched with resilience. Energy‑efficient data centres and solar backup keep services running in areas with unstable grids.',
                    'Universal service funds are refocused to co‑finance last‑mile links to schools, clinics, and innovation hubs, ensuring the backbone translates into real access for citizens, not just inter‑capital pipes.',
                    'Local content creation grants encourage culturally relevant platforms in local languages, growing demand for the network while preserving heritage and boosting creative industries.',
                ],
                'tags'=>['digital','broadband','innovation'],
                'link'=>url('/news?flagship=enetwork'),
            ],
            [
                'title'=>'AFRICAN VIRTUAL AND E-UNIVERSITY',
                'subtitle'=>'Accessible Quality Education',
                'image_url'=>$local,
                'paragraphs'=>[
                    'The African Virtual and E‑University democratizes higher education with accredited online degrees, diplomas, and micro‑credentials accessible across member states regardless of location or income bracket.',
                    'Shared content libraries, virtual labs, and co‑teaching agreements bridge faculty shortages in specialised fields such as AI, climate science, advanced manufacturing, and public health. Courses are offered in multiple AU languages to widen reach.',
                    'Curricula are co‑designed with industry to keep skills aligned to labour‑market needs, with heavy emphasis on STEM, climate adaptation, creative industries, and entrepreneurship. Assessment uses secure proctoring plus project‑based evaluation.',
                    'Scholarship pools, zero‑rating of educational traffic, and device‑financing schemes remove access barriers. Lifelong learning tracks let working professionals reskill without leaving jobs, creating a continuous talent pipeline for Africa’s digital and green transitions.',
                    'Student support includes mentorship circles, career services, and mental‑health resources delivered through the platform to reduce drop‑out rates and improve learning outcomes at scale.',
                    'Mutual recognition of credentials across member states is pursued so graduates can work anywhere on the continent without re‑licensing, reinforcing labour mobility and regional integration.',
                ],
                'tags'=>['education','edtech','skills'],
                'link'=>url('/news?flagship=evu'),
            ],
        ];

        $component = [
            'type' => 'flagship_page',
            'title' => 'Flagship Projects',
            'subtitle' => 'Transformative initiatives accelerating integration',
            'hero_image' => $flagships[0]['image_url'],
            'items' => $flagships,
        ];

        NavigationLink::updateOrCreate(
            ['url' => '/flagship-projects', 'location' => 'header'],
            [
                'label' => 'Flagship Projects',
                'position' => 3,
                'open_in_new_tab' => false,
                'is_active' => true,
                'locale' => app()->getLocale(),
                'page_meta' => [
                    'components' => [$component],
                    'flagship_items' => $flagships,
                ],
            ]
        );
    }
}
