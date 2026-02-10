@extends('layouts.public')

@section('title', 'About - Agenda 2063')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/about.css') }}">
@endpush

@section('content')

    <!-- Page Navigation Breadcrumb -->
    <nav class="page-breadcrumb" aria-label="Breadcrumb">
        <div class="breadcrumb-container">
            <ol class="breadcrumb-list">
                <li class="breadcrumb-item">
                    <a href="{{ route('home') }}"><i class="fa-solid fa-house"></i><span>Home</span></a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    <span>About Agenda 2063</span>
                </li>
            </ol>
        </div>
    </nav>

    <!-- Page Hero Banner with Rotating Background -->
    <section class="page-hero" id="pageHero">
        <div class="page-hero-bg active" style="background-image: url('https://agenda2063.africa/assets/banner1.jpeg');"></div>
        <div class="page-hero-bg" style="background-image: url('https://agenda2063.africa/assets/news4.png');"></div>
        <div class="page-hero-bg" style="background-image: url('https://agenda2063.africa/assets/news3.png');"></div>
        <div class="page-hero-bg" style="background-image: url('https://agenda2063.africa/assets/Aspiration1.png');"></div>
        <div class="page-hero-content">
            <span class="hero-label">The Africa We Want</span>
            <h1>About Agenda 2063</h1>
            <div class="hero-divider"></div>
            <p>Africa's Blueprint for Transformation into the Global Powerhouse of the Future</p>
        </div>
    </section>

    <!-- About Content Section -->
    <section class="about-content">
        <div class="content-wrapper">
            <!-- Main Content with Sidebar -->
            <div class="about-main-layout">
                <!-- Left Sidebar Navigation -->
                <aside class="about-sidebar">
                    <nav class="sidebar-nav">
                        <a href="#overview" class="sidebar-link active">
                            <span class="link-text">Overview</span>
                        </a>
                        <a href="#goals" class="sidebar-link">
                            <span class="link-text">Goals & Priority Areas of Agenda 2063</span>
                        </a>
                        <a href="#implementation" class="sidebar-link">
                            <span class="link-text">The First-Ten Year Implementation Plan</span>
                        </a>
                        <a href="#flagship" class="sidebar-link">
                            <span class="link-text">Flagship Projects of Agenda 2063</span>
                        </a>
                        <a href="#national" class="sidebar-link">
                            <span class="link-text">National & RECs Development Priorities</span>
                        </a>
                        <a href="#frameworks" class="sidebar-link">
                            <span class="link-text">Continental Frameworks</span>
                        </a>
                        <a href="#outcomes" class="sidebar-link">
                            <span class="link-text">Key Transformational Outcomes of Agenda 2063</span>
                        </a>
                    </nav>
                </aside>

                <!-- Main Content Area -->
                <div class="about-main-content">
                    <!-- Introduction Section -->
                    <section id="overview" class="content-block active" data-section="overview">
                        <h2>About the Africa We Want</h2>
                        <p class="intro-text">
                            AGENDA 2063 is Africa's blueprint and master plan for transforming Africa into the global
                            powerhouse of the future. It is the continent's strategic framework that aims to deliver on its
                            goal for inclusive and sustainable development and is a concrete manifestation of the
                            pan-African drive for unity, self-determination, freedom, progress and collective prosperity
                            pursued under Pan-Africanism and African Renaissance.
                        </p>

                        <div class="genesis-content">
                            <p>
                                The genesis of Agenda 2063 was the realisation by African leaders that there was a need to
                                refocus and reprioritise Africa's agenda from the struggle against apartheid and the
                                attainment of political independence for the continent which had been the focus of The
                                Organisation of African Unity (OAU), the precursor of the African Union; and instead to
                                prioritise inclusive social and economic development, continental and regional integration,
                                democratic governance and peace and security amongst other issues aimed at repositioning
                                Africa to becoming a dominant player in the global arena.
                            </p>
                            <p>
                                As an affirmation of their commitment to support Africa's new path for attaining inclusive
                                and sustainable economic growth and development African heads of state and government signed
                                the 50th Anniversary Solemn Declaration during the Golden Jubilee celebrations of the
                                formation of the OAU /AU in May 2013. The declaration marked the re-dedication of Africa
                                towards the attainment of the Pan African Vision of An integrated, prosperous and peaceful
                                Africa, driven by its own citizens, representing a dynamic force in the international arena
                                and Agenda 2063 is the concrete manifestation of how the continent intends to achieve this
                                vision within a 50 year period from 2013 to 2063. The Africa of the future was captured in a
                                letter presented by the former Chairperson of the African Union Commission, Dr. Nkosazana
                                Dlaminin Zuma.
                            </p>
                        </div>
                    </section>

                    <!-- Goals Section -->
                    <section id="goals" class="content-block" data-section="goals">
                        <h2>Goals & Priority Areas of Agenda 2063</h2>
                        <p class="intro-text">
                            Agenda 2063 has identified 20 goals and priority areas that will guide Africa's transformation
                            over the next 50 years. These goals are designed to address the continent's most pressing
                            challenges while capitalizing on its vast opportunities.
                        </p>

                        <div class="genesis-content">
                            <p>
                                The goals encompass economic prosperity, infrastructure development, education and skills
                                development, health and nutrition, agricultural transformation, modern and livable habitats,
                                environmentally sustainable climate-resilient economies, united Africa through federal or
                                confederate governance, world-class infrastructure, quality education and skills revolution,
                                healthy and well-nourished citizens, transformed economies and job creation, modern
                                agriculture for increased production and productivity, blue/ocean economy, and African
                                cultural renaissance.
                            </p>
                            <p>
                                Each goal is supported by specific targets and indicators that allow for monitoring and
                                evaluation of progress. The goals are interconnected and mutually reinforcing, ensuring a
                                holistic approach to Africa's development. Implementation is coordinated at continental,
                                regional, and national levels to ensure alignment and maximize impact.
                            </p>
                        </div>
                    </section>

                    <!-- Implementation Section -->
                    <section id="implementation" class="content-block" data-section="implementation">
                        <h2>The First Ten-Year Implementation Plan</h2>
                        <p class="intro-text">
                            The First Ten-Year Implementation Plan (2014-2023) set the foundation for achieving Agenda
                            2063's vision. It focused on key priority areas and flagship projects that would catalyze
                            Africa's transformation and set the continent on a path to prosperity.
                        </p>

                        <div class="genesis-content">
                            <p>
                                The plan emphasized structural economic transformation and inclusive growth, science,
                                technology and innovation, people-centered development, environmental sustainability, peace
                                and security, and finance and partnerships. It established clear milestones, targets, and
                                indicators to track progress and ensure accountability.
                            </p>
                            <p>
                                During this period, significant progress was made in establishing the African Continental
                                Free Trade Area, advancing infrastructure projects, improving governance systems, and
                                strengthening regional integration. The lessons learned from the first ten-year plan are now
                                informing the second implementation phase (2024-2033), which aims to accelerate progress and
                                address remaining challenges.
                            </p>
                        </div>
                    </section>

                    <!-- Flagship Projects Section -->
                    <section id="flagship" class="content-block" data-section="flagship">
                        <h2>Flagship Projects of Agenda 2063</h2>
                        <p class="intro-text">
                            The flagship projects are transformative initiatives designed to accelerate Africa's economic
                            growth and development. These projects address critical infrastructure gaps, promote regional
                            integration, and position Africa as a competitive player in the global economy.
                        </p>

                        <div class="genesis-content">
                            <p>
                                Key flagship projects include the Integrated High-Speed Train Network connecting all African
                                capitals and commercial centers, the African Continental Free Trade Area (AfCFTA) creating a
                                single market for goods and services, the African Commodities Strategy for value addition
                                and beneficiation, the Single African Air Transport Market (SAATM) for seamless air
                                connectivity, the African Passport and free movement of people, the Pan-African E-Network
                                for digital connectivity, and the Pan-African Virtual and E-University for accessible
                                quality education.
                            </p>
                            <p>
                                These projects are at various stages of implementation, with some already showing tangible
                                results. The AfCFTA, for instance, has been operationalized and is facilitating increased
                                intra-African trade. The projects are designed to be mutually reinforcing, creating
                                synergies that amplify their collective impact on Africa's development trajectory.
                            </p>
                        </div>
                    </section>

                    <!-- National & RECs Section -->
                    <section id="national" class="content-block" data-section="national">
                        <h2>National & RECs Development Priorities</h2>
                        <p class="intro-text">
                            The successful implementation of Agenda 2063 requires strong coordination between continental,
                            regional, and national levels. Regional Economic Communities (RECs) and member states play a
                            crucial role in translating continental aspirations into national development plans and
                            programs.
                        </p>

                        <div class="genesis-content">
                            <p>
                                Each member state has aligned its national development plans with Agenda 2063 priorities,
                                ensuring coherence and synergy. RECs serve as building blocks for continental integration,
                                facilitating regional cooperation on trade, infrastructure, peace and security, and other
                                priority areas. This multi-level governance approach ensures that Agenda 2063 is not just a
                                continental vision but a practical roadmap implemented at all levels.
                            </p>
                            <p>
                                Regular monitoring and reporting mechanisms have been established to track progress at
                                national and regional levels. Best practices are shared across countries and regions,
                                fostering learning and innovation. This collaborative approach strengthens ownership and
                                accountability, ensuring that all stakeholders are committed to achieving the Africa we
                                want.
                            </p>
                        </div>
                    </section>

                    <!-- Continental Frameworks Section -->
                    <section id="frameworks" class="content-block" data-section="frameworks">
                        <h2>Continental Frameworks</h2>
                        <p class="intro-text">
                            Agenda 2063 is supported by various continental frameworks and policies that provide guidance on
                            specific thematic areas. These frameworks ensure coordinated action across the continent and
                            provide standards and benchmarks for implementation.
                        </p>

                        <div class="genesis-content">
                            <p>
                                Key frameworks include the African Governance Architecture (AGA) promoting democratic
                                governance and human rights, the African Peace and Security Architecture (APSA) for conflict
                                prevention and resolution, the Programme for Infrastructure Development in Africa (PIDA) for
                                continental infrastructure connectivity, the Comprehensive Africa Agriculture Development
                                Programme (CAADP) for agricultural transformation, and the Science, Technology and
                                Innovation Strategy for Africa (STISA-2024) for innovation-driven development.
                            </p>
                            <p>
                                These frameworks are regularly reviewed and updated to reflect emerging challenges and
                                opportunities. They provide a common language and approach for addressing continental
                                priorities, facilitating cooperation and resource mobilization. Member states and RECs use
                                these frameworks to guide policy development and program implementation at national and
                                regional levels.
                            </p>
                        </div>
                    </section>

                    <!-- Outcomes Section -->
                    <section id="outcomes" class="content-block" data-section="outcomes">
                        <h2>Key Transformational Outcomes of Agenda 2063</h2>
                        <p class="intro-text">
                            Agenda 2063 envisions specific transformational outcomes that will fundamentally change Africa's
                            trajectory. These outcomes represent the tangible results that Africans should experience as the
                            agenda is implemented over the coming decades.
                        </p>

                        <div class="genesis-content">
                            <p>
                                Expected outcomes include a prosperous Africa with high standards of living and quality of
                                life for all citizens, an integrated continent with seamless movement of people, goods, and
                                services, a peaceful and secure Africa free from conflicts and violence, a democratic Africa
                                with good governance and respect for human rights, an Africa with a strong cultural identity
                                and heritage, an Africa that is a strong and influential global player, and an Africa where
                                development is people-driven and unleashes the potential of women and youth.
                            </p>
                            <p>
                                These outcomes are measured through specific indicators and targets that allow for tracking
                                progress over time. Regular assessments are conducted to evaluate achievements, identify
                                gaps, and adjust strategies as needed. The ultimate measure of success will be the lived
                                experiences of African citizens who should see tangible improvements in their daily lives as
                                Agenda 2063 is implemented.
                            </p>
                        </div>
                    </section>
                </div>

                <!-- Right Sidebar - Dynamic Content -->
                <aside class="chairperson-sidebar">
                    <div class="chairperson-card" data-card="overview">
                        <h3>Chairperson's Message</h3>
                        <div class="chairperson-image-wrapper">
                            <img src="https://agenda2063.africa/assets/Aspiration1.png" alt="H.E. Mahmoud Ali Youssouf"
                                class="chairperson-image">
                        </div>
                        <h4>H.E. Mahmoud Ali Youssouf</h4>
                        <p class="chairperson-title">Chairperson of the African Union Commission</p>
                        <blockquote class="chairperson-quote">
                            <i class="fa-solid fa-quote-left quote-icon"></i>
                            <p>Agenda 2063 represents our collective vision for a prosperous, integrated, and peaceful
                                Africa. Together, we are building the Africa we want.</p>
                        </blockquote>
                        <button class="read-more-arrow">
                            <i class="fa-solid fa-arrow-right"></i>
                        </button>
                    </div>

                    <div class="chairperson-card" data-card="goals" style="display: none;">
                        <h3>Priority Goals</h3>
                        <div class="chairperson-image-wrapper">
                            <img src="https://agenda2063.africa/assets/Aspiration2.png" alt="Goals"
                                class="chairperson-image">
                        </div>
                        <h4>20 Goals for Transformation</h4>
                        <p class="chairperson-title">Comprehensive Development Framework</p>
                        <blockquote class="chairperson-quote">
                            <i class="fa-solid fa-bullseye quote-icon"></i>
                            <p>Our 20 goals cover every aspect of Africa's development - from economic prosperity to social
                                inclusion, from infrastructure to innovation, ensuring no one is left behind.</p>
                        </blockquote>
                        <button class="read-more-arrow">
                            <i class="fa-solid fa-arrow-right"></i>
                        </button>
                    </div>

                    <div class="chairperson-card" data-card="implementation" style="display: none;">
                        <h3>Implementation Progress</h3>
                        <div class="chairperson-image-wrapper">
                            <img src="https://agenda2063.africa/assets/news4.png" alt="Implementation"
                                class="chairperson-image">
                        </div>
                        <h4>First Decade Achievements</h4>
                        <p class="chairperson-title">2014-2023 Implementation Plan</p>
                        <blockquote class="chairperson-quote">
                            <i class="fa-solid fa-chart-line quote-icon"></i>
                            <p>The first ten years have laid a strong foundation. We've made significant progress in trade
                                integration, infrastructure development, and regional cooperation.</p>
                        </blockquote>
                        <button class="read-more-arrow">
                            <i class="fa-solid fa-arrow-right"></i>
                        </button>
                    </div>

                    <div class="chairperson-card" data-card="flagship" style="display: none;">
                        <h3>Flagship Projects</h3>
                        <div class="chairperson-image-wrapper">
                            <img src="https://agenda2063.africa/assets/flagship-1.jpg" alt="Flagship Projects"
                                class="chairperson-image">
                        </div>
                        <h4>Transformative Initiatives</h4>
                        <p class="chairperson-title">Game-Changing Projects</p>
                        <blockquote class="chairperson-quote">
                            <i class="fa-solid fa-rocket quote-icon"></i>
                            <p>Our flagship projects are catalyzing Africa's transformation - from the AfCFTA creating a
                                single market to high-speed rail connecting our cities.</p>
                        </blockquote>
                        <button class="read-more-arrow">
                            <i class="fa-solid fa-arrow-right"></i>
                        </button>
                    </div>

                    <div class="chairperson-card" data-card="national" style="display: none;">
                        <h3>National Integration</h3>
                        <div class="chairperson-image-wrapper">
                            <img src="https://agenda2063.africa/assets/Aspiration3.png" alt="National Integration"
                                class="chairperson-image">
                        </div>
                        <h4>Country-Level Implementation</h4>
                        <p class="chairperson-title">Localized Development Plans</p>
                        <blockquote class="chairperson-quote">
                            <i class="fa-solid fa-flag quote-icon"></i>
                            <p>Every member state has aligned their national plans with Agenda 2063, ensuring continental
                                vision translates into local action and impact.</p>
                        </blockquote>
                        <button class="read-more-arrow">
                            <i class="fa-solid fa-arrow-right"></i>
                        </button>
                    </div>

                    <div class="chairperson-card" data-card="frameworks" style="display: none;">
                        <h3>Continental Frameworks</h3>
                        <div class="chairperson-image-wrapper">
                            <img src="https://agenda2063.africa/assets/Aspiration4.png" alt="Frameworks"
                                class="chairperson-image">
                        </div>
                        <h4>Guiding Policies</h4>
                        <p class="chairperson-title">Strategic Policy Frameworks</p>
                        <blockquote class="chairperson-quote">
                            <i class="fa-solid fa-book quote-icon"></i>
                            <p>Our continental frameworks provide the roadmap for coordinated action across sectors - from
                                governance to agriculture, from peace to innovation.</p>
                        </blockquote>
                        <button class="read-more-arrow">
                            <i class="fa-solid fa-arrow-right"></i>
                        </button>
                    </div>

                    <div class="chairperson-card" data-card="outcomes" style="display: none;">
                        <h3>Expected Outcomes</h3>
                        <div class="chairperson-image-wrapper">
                            <img src="https://agenda2063.africa/assets/Aspiration7.png" alt="Outcomes"
                                class="chairperson-image">
                        </div>
                        <h4>Transformational Results</h4>
                        <p class="chairperson-title">The Africa We Want by 2063</p>
                        <blockquote class="chairperson-quote">
                            <i class="fa-solid fa-trophy quote-icon"></i>
                            <p>By 2063, Africa will be prosperous, integrated, peaceful, and influential - a continent where
                                every citizen enjoys dignity, opportunity, and prosperity.</p>
                        </blockquote>
                        <button class="read-more-arrow">
                            <i class="fa-solid fa-arrow-right"></i>
                        </button>
                    </div>
                </aside>
            </div>

            <!-- Moon Shots Section -->
            <div class="moonshots-section">
                <div class="section-header-center">
                    <h2>Africa's Moon Shots</h2>
                    <p class="section-subtitle">Ambitious goals that will transform Africa by 2063</p>
                </div>

                <div class="moonshots-grid">
                    <!-- Moon Shot 1 -->
                    <div class="moonshot-card">
                        <div class="moonshot-number">01</div>
                        <div class="moonshot-icon">
                            <i class="fa-solid fa-graduation-cap"></i>
                        </div>
                        <h4>Education Revolution</h4>
                        <p>100% of African children will complete primary and secondary education with quality learning
                            outcomes</p>
                        <div class="moonshot-progress">
                            <div class="progress-bar">
                                <div class="progress-fill" style="width: 45%;"></div>
                            </div>
                            <span class="progress-label">45% Progress</span>
                        </div>
                    </div>

                    <!-- Moon Shot 2 -->
                    <div class="moonshot-card">
                        <div class="moonshot-number">02</div>
                        <div class="moonshot-icon">
                            <i class="fa-solid fa-heart-pulse"></i>
                        </div>
                        <h4>Universal Healthcare</h4>
                        <p>All Africans will have access to quality and affordable healthcare services</p>
                        <div class="moonshot-progress">
                            <div class="progress-bar">
                                <div class="progress-fill" style="width: 38%;"></div>
                            </div>
                            <span class="progress-label">38% Progress</span>
                        </div>
                    </div>

                    <!-- Moon Shot 3 -->
                    <div class="moonshot-card">
                        <div class="moonshot-number">03</div>
                        <div class="moonshot-icon">
                            <i class="fa-solid fa-bolt"></i>
                        </div>
                        <h4>Energy Access</h4>
                        <p>Universal access to clean, reliable, and affordable energy for all African households</p>
                        <div class="moonshot-progress">
                            <div class="progress-bar">
                                <div class="progress-fill" style="width: 52%;"></div>
                            </div>
                            <span class="progress-label">52% Progress</span>
                        </div>
                    </div>

                    <!-- Moon Shot 4 -->
                    <div class="moonshot-card">
                        <div class="moonshot-number">04</div>
                        <div class="moonshot-icon">
                            <i class="fa-solid fa-wifi"></i>
                        </div>
                        <h4>Digital Connectivity</h4>
                        <p>100% broadband connectivity across Africa with affordable internet access for all</p>
                        <div class="moonshot-progress">
                            <div class="progress-bar">
                                <div class="progress-fill" style="width: 41%;"></div>
                            </div>
                            <span class="progress-label">41% Progress</span>
                        </div>
                    </div>

                    <!-- Moon Shot 5 -->
                    <div class="moonshot-card">
                        <div class="moonshot-number">05</div>
                        <div class="moonshot-icon">
                            <i class="fa-solid fa-utensils"></i>
                        </div>
                        <h4>Food Security</h4>
                        <p>End hunger and ensure food security through sustainable agriculture and nutrition</p>
                        <div class="moonshot-progress">
                            <div class="progress-bar">
                                <div class="progress-fill" style="width: 35%;"></div>
                            </div>
                            <span class="progress-label">35% Progress</span>
                        </div>
                    </div>

                    <!-- Moon Shot 6 -->
                    <div class="moonshot-card">
                        <div class="moonshot-number">06</div>
                        <div class="moonshot-icon">
                            <i class="fa-solid fa-industry"></i>
                        </div>
                        <h4>Industrialization</h4>
                        <p>Transform Africa into a manufacturing hub with value-added production across all sectors</p>
                        <div class="moonshot-progress">
                            <div class="progress-bar">
                                <div class="progress-fill" style="width: 29%;"></div>
                            </div>
                            <span class="progress-label">29% Progress</span>
                        </div>
                    </div>

                    <!-- Moon Shot 7 -->
                    <div class="moonshot-card">
                        <div class="moonshot-number">07</div>
                        <div class="moonshot-icon">
                            <i class="fa-solid fa-leaf"></i>
                        </div>
                        <h4>Climate Resilience</h4>
                        <p>Build climate-resilient economies and communities with sustainable environmental practices</p>
                        <div class="moonshot-progress">
                            <div class="progress-bar">
                                <div class="progress-fill" style="width: 44%;"></div>
                            </div>
                            <span class="progress-label">44% Progress</span>
                        </div>
                    </div>

                    <!-- Moon Shot 8 -->
                    <div class="moonshot-card">
                        <div class="moonshot-number">08</div>
                        <div class="moonshot-icon">
                            <i class="fa-solid fa-users"></i>
                        </div>
                        <h4>Youth Empowerment</h4>
                        <p>Empower African youth with skills, opportunities, and leadership for the future</p>
                        <div class="moonshot-progress">
                            <div class="progress-bar">
                                <div class="progress-fill" style="width: 48%;"></div>
                            </div>
                            <span class="progress-label">48% Progress</span>
                        </div>
                    </div>

                    <!-- Moon Shot 9 -->
                    <div class="moonshot-card">
                        <div class="moonshot-number">09</div>
                        <div class="moonshot-icon">
                            <i class="fa-solid fa-venus-mars"></i>
                        </div>
                        <h4>Gender Equality</h4>
                        <p>Achieve full gender equality and women's empowerment in all spheres of life</p>
                        <div class="moonshot-progress">
                            <div class="progress-bar">
                                <div class="progress-fill" style="width: 56%;"></div>
                            </div>
                            <span class="progress-label">56% Progress</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Timeline Section -->
            <div class="timeline-section">
                <div class="section-header-center">
                    <h2>Our Journey to 2063</h2>
                    <p class="section-subtitle">Key milestones in Africa's transformation</p>
                </div>

                <div class="timeline">
                    <div class="timeline-item" data-period="2013">
                        <div class="timeline-marker"></div>
                        <div class="timeline-content">
                            <span class="timeline-year">2013</span>
                            <h4>Agenda 2063 Adopted</h4>
                            <p>African Union Heads of State and Government adopted Agenda 2063 as Africa's development
                                blueprint</p>
                        </div>
                    </div>

                    <div class="timeline-item" data-period="2014-2023">
                        <div class="timeline-marker"></div>
                        <div class="timeline-content">
                            <span class="timeline-year">2014-2023</span>
                            <h4>First Ten-Year Plan</h4>
                            <p>Implementation of the first 10-year plan with focus on flagship projects and priority areas
                            </p>
                        </div>
                    </div>

                    <div class="timeline-item active" data-period="2024-2033">
                        <div class="timeline-marker"></div>
                        <div class="timeline-content">
                            <span class="timeline-year">2024-2033</span>
                            <h4>Second Ten-Year Plan</h4>
                            <p>Accelerating implementation with enhanced focus on industrialization and integration</p>
                        </div>
                    </div>

                    <div class="timeline-item" data-period="2034-2043">
                        <div class="timeline-marker"></div>
                        <div class="timeline-content">
                            <span class="timeline-year">2034-2043</span>
                            <h4>Third Ten-Year Plan</h4>
                            <p>Consolidating gains and scaling up successful initiatives across the continent</p>
                        </div>
                    </div>

                    <div class="timeline-item" data-period="2044-2053">
                        <div class="timeline-marker"></div>
                        <div class="timeline-content">
                            <span class="timeline-year">2044-2053</span>
                            <h4>Fourth Ten-Year Plan</h4>
                            <p>Advancing towards full realization of Agenda 2063 aspirations and goals</p>
                        </div>
                    </div>

                    <div class="timeline-item" data-period="2054-2063">
                        <div class="timeline-marker"></div>
                        <div class="timeline-content">
                            <span class="timeline-year">2054-2063</span>
                            <h4>Final Ten-Year Plan</h4>
                            <p>Achieving the vision of a prosperous, integrated, and peaceful Africa</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Timeline Modal -->
            <div class="timeline-modal-overlay" id="timelineModalOverlay">
                <div class="timeline-modal" id="timelineModal">
                    <button class="close-timeline-modal" id="closeTimelineModal">
                        <i class="fa-solid fa-times"></i>
                    </button>

                    <div class="timeline-modal-header" id="timelineModalHeader">
                        <!-- Dynamic content will be inserted here -->
                    </div>

                    <div class="timeline-modal-body" id="timelineModalBody">
                        <!-- Dynamic content will be inserted here -->
                    </div>

                    <div class="timeline-modal-footer">
                        <p class="modal-footer-text">Click to explore more about Africa's transformation journey</p>
                        <div class="modal-footer-buttons">
                            <button class="modal-btn secondary">
                                <i class="fa-solid fa-download"></i> Download Report
                            </button>
                            <button class="modal-btn primary">
                                <i class="fa-solid fa-arrow-right"></i> Learn More
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Call to Action -->
            <div class="cta-section">
                <div class="cta-content">
                    <h2>Join the Movement</h2>
                    <p>Be part of Africa's transformation. Together, we can build the Africa we want.</p>
                    <div class="cta-buttons">
                        <a href="#" class="cta-btn primary"><i class="fa-solid fa-hands-helping"></i> Get
                            Involved</a>
                        <a href="#" class="cta-btn secondary"><i class="fa-solid fa-download"></i> Download
                            Resources</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Subscription Popup Overlay -->
    <div class="subscription-overlay" id="subscriptionOverlay">
        <div class="subscription-modal">
            <button class="close-subscription" id="closeSubscription">
                <i class="fa-solid fa-times"></i>
            </button>

            <div class="subscription-header">
                <div class="subscription-icon">
                    <i class="fa-solid fa-envelope-open-text"></i>
                </div>
                <h3>Stay Updated on Africa's Transformation</h3>
                <p class="subscription-reason">Subscribe to receive exclusive updates on Agenda 2063 progress, flagship
                    projects, success stories, and opportunities to contribute to Africa's development journey.</p>
            </div>

            <form class="subscription-form" id="subscriptionForm">
                <div class="form-group">
                    <label for="subEmail">Email Address *</label>
                    <input type="email" id="subEmail" name="email" placeholder="Enter your email" required>
                </div>

                <div class="form-group">
                    <label for="subName">Full Name *</label>
                    <input type="text" id="subName" name="name" placeholder="Enter your full name" required>
                </div>

                <div class="form-group">
                    <label for="subCountry">Country</label>
                    <select id="subCountry" name="country">
                        <option value="">Select your country</option>
                        <option value="algeria">Algeria</option>
                        <option value="angola">Angola</option>
                        <option value="benin">Benin</option>
                        <option value="botswana">Botswana</option>
                        <option value="burkina-faso">Burkina Faso</option>
                        <option value="cameroon">Cameroon</option>
                        <option value="egypt">Egypt</option>
                        <option value="ethiopia">Ethiopia</option>
                        <option value="ghana">Ghana</option>
                        <option value="kenya">Kenya</option>
                        <option value="morocco">Morocco</option>
                        <option value="nigeria">Nigeria</option>
                        <option value="rwanda">Rwanda</option>
                        <option value="senegal">Senegal</option>
                        <option value="south-africa">South Africa</option>
                        <option value="tanzania">Tanzania</option>
                        <option value="uganda">Uganda</option>
                        <option value="other">Other</option>
                    </select>
                </div>

                <div class="subscription-interests">
                    <label>I'm interested in: (Select all that apply)</label>
                    <div class="interest-checkboxes">
                        <label class="interest-checkbox">
                            <input type="checkbox" name="interests" value="progress-reports">
                            <span>Progress Reports</span>
                        </label>
                        <label class="interest-checkbox">
                            <input type="checkbox" name="interests" value="flagship-projects">
                            <span>Flagship Projects</span>
                        </label>
                        <label class="interest-checkbox">
                            <input type="checkbox" name="interests" value="events">
                            <span>Events & Conferences</span>
                        </label>
                        <label class="interest-checkbox">
                            <input type="checkbox" name="interests" value="opportunities">
                            <span>Opportunities</span>
                        </label>
                        <label class="interest-checkbox">
                            <input type="checkbox" name="interests" value="success-stories">
                            <span>Success Stories</span>
                        </label>
                        <label class="interest-checkbox">
                            <input type="checkbox" name="interests" value="research">
                            <span>Research & Publications</span>
                        </label>
                    </div>
                </div>

                <div class="subscription-benefits">
                    <h4>What You'll Get:</h4>
                    <ul>
                        <li><i class="fa-solid fa-check-circle"></i> Monthly progress updates on Agenda 2063 implementation
                        </li>
                        <li><i class="fa-solid fa-check-circle"></i> Early access to reports and publications</li>
                        <li><i class="fa-solid fa-check-circle"></i> Invitations to continental events and webinars</li>
                        <li><i class="fa-solid fa-check-circle"></i> Opportunities to contribute to Africa's transformation
                        </li>
                    </ul>
                </div>

                <button type="submit" class="subscribe-btn">
                    <i class="fa-solid fa-paper-plane"></i> Subscribe Now
                </button>

                <p class="subscription-privacy">
                    We respect your privacy. Unsubscribe anytime. <a href="#">Privacy Policy</a>
                </p>
            </form>
        </div>
    </div>

@endsection
