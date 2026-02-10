<!-- Navigation -->
<nav class="main-nav" id="mainNav">
    <ul>
        <li><a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Home</a></li>

        <!-- ABOUT -->
        <li class="has-dropdown">
            <a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'active' : '' }}">About <i class="fa-solid fa-caret-down"></i></a>
            <div class="mega-dropdown">
                <div class="dropdown-column first-column">
                    <h4>About Agenda 2063</h4>
                    <ul class="submenu-grid">
                        <li><a href="#" data-submenu="overview">Overview</a></li>
                        <li><a href="#" data-submenu="vision">Vision & Mission</a></li>
                        <li><a href="#" data-submenu="history">History</a></li>
                        <li><a href="#" data-submenu="framework">Framework</a></li>
                        <li><a href="#" data-submenu="partners">Partners</a></li>
                        <li><a href="#" data-submenu="leadership">Leadership</a></li>
                        <li><a href="#" data-submenu="aspirations">The 7 Aspirations</a></li>
                        <li><a href="#" data-submenu="goals">Goals & Targets</a></li>
                        <li><a href="#" data-submenu="member-states">Member States</a></li>
                        <li><a href="#" data-submenu="au-organs">AU Organs</a></li>
                        <li><a href="#" data-submenu="achievements">Key Achievements</a></li>
                        <li><a href="#" data-submenu="ten-year-plans">10-Year Plans</a></li>
                    </ul>
                </div>
                <div class="dropdown-column second-column">
                    <h4 class="submenu-title">Overview</h4>
                    <p class="submenu-description">Agenda 2063 is Africa's blueprint and master plan for transforming the continent into a global powerhouse of the future.</p>
                    <ul class="submenu-details">
                        <li>
                            <a href="#">
                                <div class="submenu-item-content">
                                    <i class="fa-solid fa-globe-africa"></i>
                                    <div class="submenu-item-text">
                                        <span class="submenu-item-name">What is Agenda 2063?</span>
                                        <span class="submenu-item-desc">A strategic framework for socio-economic transformation of the continent over 50 years</span>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <div class="submenu-item-content">
                                    <i class="fa-solid fa-star"></i>
                                    <div class="submenu-item-text">
                                        <span class="submenu-item-name">The 7 Aspirations</span>
                                        <span class="submenu-item-desc">The seven aspirations that reflect the desire for shared prosperity and well-being</span>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <div class="submenu-item-content">
                                    <i class="fa-solid fa-bullseye"></i>
                                    <div class="submenu-item-text">
                                        <span class="submenu-item-name">Goals & Priority Areas</span>
                                        <span class="submenu-item-desc">20 goals and 39 priority areas driving Africa's transformation agenda</span>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <div class="submenu-item-content">
                                    <i class="fa-solid fa-tasks"></i>
                                    <div class="submenu-item-text">
                                        <span class="submenu-item-name">Implementation Plan</span>
                                        <span class="submenu-item-desc">Broken into 10-year implementation plans with clear targets and milestones</span>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <div class="submenu-item-content">
                                    <i class="fa-solid fa-timeline"></i>
                                    <div class="submenu-item-text">
                                        <span class="submenu-item-name">Timeline & Milestones</span>
                                        <span class="submenu-item-desc">Key milestones from 2013 adoption through the 2063 vision horizon</span>
                                    </div>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="dropdown-column third-column">
                    <div class="feature-card">
                        <img src="https://agenda2063.africa/assets/banner1.jpeg" alt="Featured" class="feature-image">
                        <h5>Discover Agenda 2063</h5>
                        <p>Africa's blueprint for an integrated, prosperous and peaceful continent driven by its own citizens.</p>
                        <a href="{{ route('about') }}" class="read-more-btn">Read More</a>
                    </div>
                </div>
            </div>
        </li>

        <!-- PERFORMANCE -->
        <li class="has-dropdown">
            <a href="{{ route('performance') }}" class="{{ request()->routeIs('performance') ? 'active' : '' }}">Performance <i class="fa-solid fa-caret-down"></i></a>
            <div class="mega-dropdown">
                <div class="dropdown-column first-column">
                    <h4>Performance Tracking</h4>
                    <ul class="submenu-grid">
                        <li><a href="#" data-submenu="reports">Annual Reports</a></li>
                        <li><a href="#" data-submenu="indicators">Key Indicators</a></li>
                        <li><a href="#" data-submenu="progress">Progress Dashboard</a></li>
                        <li><a href="#" data-submenu="evaluation">Evaluation Framework</a></li>
                        <li><a href="#" data-submenu="data">Data & Statistics</a></li>
                        <li><a href="#" data-submenu="benchmarks">Benchmarks</a></li>
                        <li><a href="#" data-submenu="scorecards">Score Cards</a></li>
                        <li><a href="#" data-submenu="country-profiles">Country Profiles</a></li>
                        <li><a href="#" data-submenu="regional-analysis">Regional Analysis</a></li>
                        <li><a href="#" data-submenu="sdg-alignment">SDG Alignment</a></li>
                        <li><a href="#" data-submenu="impact-stories">Impact Stories</a></li>
                        <li><a href="#" data-submenu="methodology">Methodology</a></li>
                    </ul>
                </div>
                <div class="dropdown-column second-column">
                    <h4 class="submenu-title">Annual Reports</h4>
                    <p class="submenu-description">Comprehensive annual and biennial reports tracking Africa's progress toward Agenda 2063 goals.</p>
                    <ul class="submenu-details">
                        <li>
                            <a href="#">
                                <div class="submenu-item-content">
                                    <i class="fa-solid fa-file-alt"></i>
                                    <div class="submenu-item-text">
                                        <span class="submenu-item-name">2024 Continental Report</span>
                                        <span class="submenu-item-desc">Latest biennial report on Agenda 2063 implementation across all member states</span>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <div class="submenu-item-content">
                                    <i class="fa-solid fa-file-lines"></i>
                                    <div class="submenu-item-text">
                                        <span class="submenu-item-name">2023 Mid-Year Review</span>
                                        <span class="submenu-item-desc">Mid-year assessment of goal progress and policy implementation updates</span>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <div class="submenu-item-content">
                                    <i class="fa-solid fa-book-open"></i>
                                    <div class="submenu-item-text">
                                        <span class="submenu-item-name">First Ten-Year Review</span>
                                        <span class="submenu-item-desc">Comprehensive review of 2014-2023 decade achievements and lessons learned</span>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <div class="submenu-item-content">
                                    <i class="fa-solid fa-map"></i>
                                    <div class="submenu-item-text">
                                        <span class="submenu-item-name">Regional Performance Reports</span>
                                        <span class="submenu-item-desc">Detailed reports from each Regional Economic Community on their progress</span>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <div class="submenu-item-content">
                                    <i class="fa-solid fa-layer-group"></i>
                                    <div class="submenu-item-text">
                                        <span class="submenu-item-name">Thematic Reports</span>
                                        <span class="submenu-item-desc">Sector-specific reports on education, health, infrastructure, peace, and trade</span>
                                    </div>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="dropdown-column third-column">
                    <div class="feature-card">
                        <img src="https://agenda2063.africa/assets/news4.png" alt="Performance" class="feature-image">
                        <h5>Track Our Progress</h5>
                        <p>Monitor the implementation and achievements of Agenda 2063 across all 55 member states.</p>
                        <a href="{{ route('performance') }}" class="read-more-btn">Read More</a>
                    </div>
                </div>
            </div>
        </li>

        <!-- NEWS & EVENTS -->
        <li class="has-dropdown">
            <a href="{{ route('news') }}" class="{{ request()->routeIs('news*') ? 'active' : '' }}">News & Events <i class="fa-solid fa-caret-down"></i></a>
            <div class="mega-dropdown">
                <div class="dropdown-column first-column">
                    <h4>Latest Updates</h4>
                    <ul class="submenu-grid">
                        <li><a href="#" data-submenu="news">Latest News</a></li>
                        <li><a href="#" data-submenu="press">Press Releases</a></li>
                        <li><a href="#" data-submenu="events">Upcoming Events</a></li>
                        <li><a href="#" data-submenu="conferences">Conferences</a></li>
                        <li><a href="#" data-submenu="media">Media Gallery</a></li>
                        <li><a href="#" data-submenu="archive">Archive</a></li>
                        <li><a href="#" data-submenu="interviews">Interviews</a></li>
                        <li><a href="#" data-submenu="newsletters">Newsletters</a></li>
                        <li><a href="#" data-submenu="blogs">Blogs & Opinion</a></li>
                        <li><a href="#" data-submenu="webinars">Webinars</a></li>
                        <li><a href="#" data-submenu="event-calendar">Event Calendar</a></li>
                        <li><a href="#" data-submenu="social-hub">Social Media Hub</a></li>
                    </ul>
                </div>
                <div class="dropdown-column second-column">
                    <h4 class="submenu-title">Latest News</h4>
                    <p class="submenu-description">Stay updated with the latest developments, achievements, and stories from across the continent.</p>
                    <ul class="submenu-details">
                        <li>
                            <a href="#">
                                <div class="submenu-item-content">
                                    <i class="fa-solid fa-bolt"></i>
                                    <div class="submenu-item-text">
                                        <span class="submenu-item-name">Breaking News</span>
                                        <span class="submenu-item-desc">Real-time updates on major AU decisions, summits, and continental developments</span>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <div class="submenu-item-content">
                                    <i class="fa-solid fa-newspaper"></i>
                                    <div class="submenu-item-text">
                                        <span class="submenu-item-name">Featured Stories</span>
                                        <span class="submenu-item-desc">In-depth articles on key Agenda 2063 initiatives and their impact on Africa</span>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <div class="submenu-item-content">
                                    <i class="fa-solid fa-earth-africa"></i>
                                    <div class="submenu-item-text">
                                        <span class="submenu-item-name">Regional Updates</span>
                                        <span class="submenu-item-desc">News from all five African regions: North, South, East, West, and Central</span>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <div class="submenu-item-content">
                                    <i class="fa-solid fa-flag"></i>
                                    <div class="submenu-item-text">
                                        <span class="submenu-item-name">Member State Highlights</span>
                                        <span class="submenu-item-desc">Country-level news on national implementation and development achievements</span>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <div class="submenu-item-content">
                                    <i class="fa-solid fa-pen-fancy"></i>
                                    <div class="submenu-item-text">
                                        <span class="submenu-item-name">Opinion & Analysis</span>
                                        <span class="submenu-item-desc">Expert commentary, editorials, and analytical pieces on African development</span>
                                    </div>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="dropdown-column third-column">
                    <div class="feature-card">
                        <img src="https://agenda2063.africa/assets/news3.png" alt="News" class="feature-image">
                        <h5>Stay Informed</h5>
                        <p>Get the latest news, press releases, and event coverage from the African Union.</p>
                        <a href="{{ route('news') }}" class="read-more-btn">Read More</a>
                    </div>
                </div>
            </div>
        </li>

        <!-- KNOWLEDGE BASE -->
        <li class="has-dropdown">
            <a href="{{ route('knowledge-base') }}" class="{{ request()->routeIs('knowledge-base') ? 'active' : '' }}">Knowledge Base <i class="fa-solid fa-caret-down"></i></a>
            <div class="mega-dropdown">
                <div class="dropdown-column first-column">
                    <h4>Resources</h4>
                    <ul class="submenu-grid">
                        <li><a href="#" data-submenu="documents">Documents</a></li>
                        <li><a href="#" data-submenu="publications">Publications</a></li>
                        <li><a href="#" data-submenu="research">Research Papers</a></li>
                        <li><a href="#" data-submenu="policies">Policy Briefs</a></li>
                        <li><a href="#" data-submenu="library">Digital Library</a></li>
                        <li><a href="#" data-submenu="tools">Tools & Guides</a></li>
                        <li><a href="#" data-submenu="datasets">Open Datasets</a></li>
                        <li><a href="#" data-submenu="infographics">Infographics</a></li>
                        <li><a href="#" data-submenu="e-learning">E-Learning</a></li>
                        <li><a href="#" data-submenu="case-studies">Case Studies</a></li>
                        <li><a href="#" data-submenu="glossary">Glossary & FAQ</a></li>
                        <li><a href="#" data-submenu="multimedia">Multimedia</a></li>
                    </ul>
                </div>
                <div class="dropdown-column second-column">
                    <h4 class="submenu-title">Documents</h4>
                    <p class="submenu-description">Official AU documents, treaties, protocols, and legal instruments governing continental affairs.</p>
                    <ul class="submenu-details">
                        <li>
                            <a href="#">
                                <div class="submenu-item-content">
                                    <i class="fa-solid fa-file-contract"></i>
                                    <div class="submenu-item-text">
                                        <span class="submenu-item-name">AU Constitutive Act</span>
                                        <span class="submenu-item-desc">The founding legal document establishing the African Union and its organs</span>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <div class="submenu-item-content">
                                    <i class="fa-solid fa-file-shield"></i>
                                    <div class="submenu-item-text">
                                        <span class="submenu-item-name">Treaties & Protocols</span>
                                        <span class="submenu-item-desc">Continental treaties on trade, movement of persons, peace, and governance</span>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <div class="submenu-item-content">
                                    <i class="fa-solid fa-stamp"></i>
                                    <div class="submenu-item-text">
                                        <span class="submenu-item-name">Decisions & Declarations</span>
                                        <span class="submenu-item-desc">Assembly and Executive Council decisions and summit declarations</span>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <div class="submenu-item-content">
                                    <i class="fa-solid fa-file-lines"></i>
                                    <div class="submenu-item-text">
                                        <span class="submenu-item-name">Policy Documents</span>
                                        <span class="submenu-item-desc">Continental policy frameworks on key sectors and development priorities</span>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <div class="submenu-item-content">
                                    <i class="fa-solid fa-file-code"></i>
                                    <div class="submenu-item-text">
                                        <span class="submenu-item-name">Technical Papers</span>
                                        <span class="submenu-item-desc">Expert technical papers supporting policy formulation and implementation</span>
                                    </div>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="dropdown-column third-column">
                    <div class="feature-card">
                        <img src="https://agenda2063.africa/assets/Aspiration1.png" alt="Knowledge" class="feature-image">
                        <h5>Access Resources</h5>
                        <p>Explore official documents, research publications, and policy frameworks for the continent.</p>
                        <a href="{{ route('knowledge-base') }}" class="read-more-btn">Read More</a>
                    </div>
                </div>
            </div>
        </li>

        <!-- FLAGSHIP PROJECTS -->
        <li class="has-dropdown">
            <a href="{{ route('flagship-projects') }}" class="{{ request()->routeIs('flagship-projects') ? 'active' : '' }}">Flagship Projects <i class="fa-solid fa-caret-down"></i></a>
            <div class="mega-dropdown">
                <div class="dropdown-column first-column">
                    <h4>Major Initiatives</h4>
                    <ul class="submenu-grid">
                        <li><a href="#" data-submenu="afcfta">AfCFTA</a></li>
                        <li><a href="#" data-submenu="train">High-Speed Train</a></li>
                        <li><a href="#" data-submenu="commodities">Commodities Strategy</a></li>
                        <li><a href="#" data-submenu="aviation">Single Air Market</a></li>
                        <li><a href="#" data-submenu="passport">African Passport</a></li>
                        <li><a href="#" data-submenu="university">Pan-African University</a></li>
                        <li><a href="#" data-submenu="silencing-guns">Silencing the Guns</a></li>
                        <li><a href="#" data-submenu="grand-museum">Grand African Museum</a></li>
                        <li><a href="#" data-submenu="cyber-security">Cyber Security</a></li>
                        <li><a href="#" data-submenu="outer-space">Outer Space Agency</a></li>
                        <li><a href="#" data-submenu="financial-institutions">Financial Institutions</a></li>
                        <li><a href="#" data-submenu="e-network">Pan-African E-Network</a></li>
                    </ul>
                </div>
                <div class="dropdown-column second-column">
                    <h4 class="submenu-title">African Continental Free Trade Area (AfCFTA)</h4>
                    <p class="submenu-description">The world's largest free trade area by number of countries, creating a single market of 1.3 billion people.</p>
                    <ul class="submenu-details">
                        <li>
                            <a href="#">
                                <div class="submenu-item-content">
                                    <i class="fa-solid fa-store"></i>
                                    <div class="submenu-item-text">
                                        <span class="submenu-item-name">About AfCFTA</span>
                                        <span class="submenu-item-desc">Creating a single continental market for goods and services with free movement</span>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <div class="submenu-item-content">
                                    <i class="fa-solid fa-file-contract"></i>
                                    <div class="submenu-item-text">
                                        <span class="submenu-item-name">Trade Protocols</span>
                                        <span class="submenu-item-desc">Protocols on trade in goods, services, investment, IP, and competition policy</span>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <div class="submenu-item-content">
                                    <i class="fa-solid fa-gauge"></i>
                                    <div class="submenu-item-text">
                                        <span class="submenu-item-name">Implementation Dashboard</span>
                                        <span class="submenu-item-desc">Real-time tracking of ratification status and trading commencement per country</span>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <div class="submenu-item-content">
                                    <i class="fa-solid fa-chart-line"></i>
                                    <div class="submenu-item-text">
                                        <span class="submenu-item-name">Economic Impact</span>
                                        <span class="submenu-item-desc">Projected $450B increase in intra-African trade and 30M lifted from poverty</span>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <div class="submenu-item-content">
                                    <i class="fa-solid fa-building-flag"></i>
                                    <div class="submenu-item-text">
                                        <span class="submenu-item-name">AfCFTA Secretariat</span>
                                        <span class="submenu-item-desc">Based in Accra, Ghana - coordinating implementation across all member states</span>
                                    </div>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="dropdown-column third-column">
                    <div class="feature-card">
                        <img src="https://agenda2063.africa/assets/Aspiration1.png" alt="Projects" class="feature-image">
                        <h5>Flagship Projects</h5>
                        <p>12 key projects and initiatives driving Africa's continental transformation and integration.</p>
                        <a href="{{ route('flagship-projects') }}" class="read-more-btn">Read More</a>
                    </div>
                </div>
            </div>
        </li>

        <!-- CONTINENTAL FRAMEWORKS -->
        <li class="has-dropdown">
            <a href="{{ route('continental-frameworks') }}" class="{{ request()->routeIs('continental-frameworks') ? 'active' : '' }}">Continental Frameworks <i class="fa-solid fa-caret-down"></i></a>
            <div class="mega-dropdown">
                <div class="dropdown-column first-column">
                    <h4>Frameworks & Policies</h4>
                    <ul class="submenu-grid">
                        <li><a href="#" data-submenu="governance">Governance</a></li>
                        <li><a href="#" data-submenu="economic">Economic Integration</a></li>
                        <li><a href="#" data-submenu="peace">Peace & Security</a></li>
                        <li><a href="#" data-submenu="social">Social Development</a></li>
                        <li><a href="#" data-submenu="environment">Environment</a></li>
                        <li><a href="#" data-submenu="culture">Culture & Heritage</a></li>
                        <li><a href="#" data-submenu="infrastructure">Infrastructure</a></li>
                        <li><a href="#" data-submenu="digital">Digital Transformation</a></li>
                        <li><a href="#" data-submenu="youth-framework">Youth Framework</a></li>
                        <li><a href="#" data-submenu="gender">Gender Equality</a></li>
                        <li><a href="#" data-submenu="health">Health & Wellbeing</a></li>
                        <li><a href="#" data-submenu="migration">Migration & Mobility</a></li>
                    </ul>
                </div>
                <div class="dropdown-column second-column">
                    <h4 class="submenu-title">Governance Framework</h4>
                    <p class="submenu-description">Strengthening democratic governance, rule of law, and human rights across the continent.</p>
                    <ul class="submenu-details">
                        <li>
                            <a href="#">
                                <div class="submenu-item-content">
                                    <i class="fa-solid fa-landmark-dome"></i>
                                    <div class="submenu-item-text">
                                        <span class="submenu-item-name">African Governance Architecture</span>
                                        <span class="submenu-item-desc">Continental framework for promoting good governance and democratic values</span>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <div class="submenu-item-content">
                                    <i class="fa-solid fa-scroll"></i>
                                    <div class="submenu-item-text">
                                        <span class="submenu-item-name">African Charter on Democracy</span>
                                        <span class="submenu-item-desc">Binding charter on elections, governance, and democratic transitions</span>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <div class="submenu-item-content">
                                    <i class="fa-solid fa-clipboard-question"></i>
                                    <div class="submenu-item-text">
                                        <span class="submenu-item-name">African Peer Review Mechanism</span>
                                        <span class="submenu-item-desc">Voluntary self-assessment mechanism for governance and economic management</span>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <div class="submenu-item-content">
                                    <i class="fa-solid fa-gavel"></i>
                                    <div class="submenu-item-text">
                                        <span class="submenu-item-name">Anti-Corruption Framework</span>
                                        <span class="submenu-item-desc">AU Convention on Preventing and Combating Corruption across member states</span>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <div class="submenu-item-content">
                                    <i class="fa-solid fa-scale-balanced"></i>
                                    <div class="submenu-item-text">
                                        <span class="submenu-item-name">African Court & Human Rights</span>
                                        <span class="submenu-item-desc">Continental judicial and human rights institutions protecting citizen rights</span>
                                    </div>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="dropdown-column third-column">
                    <div class="feature-card">
                        <img src="https://agenda2063.africa/assets/Aspiration4.png" alt="Frameworks" class="feature-image">
                        <h5>Continental Frameworks</h5>
                        <p>Explore the governance, economic, and social frameworks guiding Africa's transformation.</p>
                        <a href="{{ route('continental-frameworks') }}" class="read-more-btn">Read More</a>
                    </div>
                </div>
            </div>
        </li>

        <li><a href="#">Download App</a></li>
    </ul>
</nav>
