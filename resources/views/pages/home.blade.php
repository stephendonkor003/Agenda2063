@extends('layouts.public')

@section('title', 'Agenda 2063 - The Africa We Want')

@section('content')

    <!-- Hero Section -->
    <section class="hero" id="heroSection">
        <div class="hero-wrapper">
            <!-- Set 1 -->
            <div class="hero-slide active" data-slide="0">
                <div class="hero-card active" data-index="0">
                    <div class="hero-bg" style="background-image: url('https://agenda2063.africa/assets/banner1.jpeg');"></div>
                    <div class="hero-content">
                        <h3>Goals</h3>
                        <p>Empowering youth and innovation for a better tomorrow.</p>
                        <div class="circle-number">20</div>
                    </div>
                </div>
                <div class="hero-card" data-index="1">
                    <div class="hero-bg" style="background-image: url('https://agenda2063.africa/assets/news4.png');"></div>
                    <div class="hero-content">
                        <h3>Aspirations</h3>
                        <p>Fostering peace, integration, and cooperation.</p>
                        <div class="circle-number">7</div>
                    </div>
                </div>
                <div class="hero-card" data-index="2">
                    <div class="hero-bg" style="background-image: url('https://agenda2063.africa/assets/news3.png');"></div>
                    <div class="hero-content">
                        <h3>Flagship Projects</h3>
                        <p>Driving green growth and climate resilience.</p>
                        <div class="circle-number">15</div>
                    </div>
                </div>
            </div>

            <!-- Set 2 -->
            <div class="hero-slide" data-slide="1">
                <div class="hero-card active" data-index="3">
                    <div class="hero-bg" style="background-image: url('https://agenda2063.africa/assets/Aspiration1.png');"></div>
                    <div class="hero-content">
                        <h3>Economic Growth</h3>
                        <p>Building a prosperous Africa based on inclusive growth.</p>
                        <div class="circle-number">1</div>
                    </div>
                </div>
                <div class="hero-card" data-index="4">
                    <div class="hero-bg" style="background-image: url('https://agenda2063.africa/assets/Aspiration2.png');"></div>
                    <div class="hero-content">
                        <h3>Integration</h3>
                        <p>An integrated continent, politically united.</p>
                        <div class="circle-number">2</div>
                    </div>
                </div>
                <div class="hero-card" data-index="5">
                    <div class="hero-bg" style="background-image: url('https://agenda2063.africa/assets/Aspiration3.png');"></div>
                    <div class="hero-content">
                        <h3>Governance</h3>
                        <p>Good governance, democracy, and human rights.</p>
                        <div class="circle-number">3</div>
                    </div>
                </div>
            </div>

            <!-- Set 3 -->
            <div class="hero-slide" data-slide="2">
                <div class="hero-card active" data-index="6">
                    <div class="hero-bg" style="background-image: url('https://agenda2063.africa/assets/Aspiration4.png');"></div>
                    <div class="hero-content">
                        <h3>Peace & Security</h3>
                        <p>A peaceful and secure Africa.</p>
                        <div class="circle-number">4</div>
                    </div>
                </div>
                <div class="hero-card" data-index="7">
                    <div class="hero-bg" style="background-image: url('https://agenda2063.africa/assets/Aspiration5.png');"></div>
                    <div class="hero-content">
                        <h3>Culture</h3>
                        <p>Strong cultural identity and common heritage.</p>
                        <div class="circle-number">5</div>
                    </div>
                </div>
                <div class="hero-card" data-index="8">
                    <div class="hero-bg" style="background-image: url('https://agenda2063.africa/assets/Aspiration6.png');"></div>
                    <div class="hero-content">
                        <h3>People-Driven</h3>
                        <p>Development relying on the potential of African people.</p>
                        <div class="circle-number">6</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="hero-indicators">
            <div class="hero-indicator active" data-slide="0"></div>
            <div class="hero-indicator" data-slide="1"></div>
            <div class="hero-indicator" data-slide="2"></div>
        </div>
    </section>

    <!-- Press Release Bar -->
    <div class="press-release-bar">
        <span class="press-label">PRESS RELEASE:</span>
        <div class="press-content-wrapper">
            <a href="{{ url('/news/detail') }}" id="pressReleaseLink" class="press-link">African Union launches 2024 Agenda 2063 Continental Progress Report at Addis Ababa Summit</a>
        </div>
    </div>

    <!-- Aspirations Section -->
    <section class="content-section aspirations-section">
        <div class="section-header">
            <h2>Aspirations</h2>
            <a href="#" class="read-more">Read More</a>
        </div>
        <div class="aspirations-grid">
            <!-- Aspiration 1 -->
            <div class="aspiration-card">
                <div class="aspiration-card-inner">
                    <div class="aspiration-card-front">
                        <div class="card-bg" style="background-image: url('https://agenda2063.africa/assets/Aspiration1.png');"></div>
                        <div class="card-content">
                            <h3>Africa's Economic Growth</h3>
                            <p><i class="fa-solid fa-chart-line"></i> Aspiration 1</p>
                        </div>
                    </div>
                    <div class="aspiration-card-back">
                        <h3>A Prosperous Africa</h3>
                        <p>A prosperous Africa based on inclusive growth and sustainable development, eradicating poverty and creating opportunities for all.</p>
                        <a href="{{ url('/about#goals') }}" class="view-aspiration-btn">View Aspiration <i class="fa-solid fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>

            <!-- Aspiration 2 -->
            <div class="aspiration-card">
                <div class="aspiration-card-inner">
                    <div class="aspiration-card-front">
                        <div class="card-bg" style="background-image: url('https://agenda2063.africa/assets/Aspiration2.png');"></div>
                        <div class="card-content">
                            <h3>Integrated Continent</h3>
                            <p><i class="fa-solid fa-link"></i> Aspiration 2</p>
                        </div>
                    </div>
                    <div class="aspiration-card-back">
                        <h3>Political Unity</h3>
                        <p>An integrated continent, politically united and based on the ideals of Pan-Africanism and the vision of Africa's Renaissance.</p>
                        <a href="{{ url('/about#goals') }}" class="view-aspiration-btn">View Aspiration <i class="fa-solid fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>

            <!-- Aspiration 3 -->
            <div class="aspiration-card">
                <div class="aspiration-card-inner">
                    <div class="aspiration-card-front">
                        <div class="card-bg" style="background-image: url('https://agenda2063.africa/assets/Aspiration3.png');"></div>
                        <div class="card-content">
                            <h3>Good Governance</h3>
                            <p><i class="fa-solid fa-scale-balanced"></i> Aspiration 3</p>
                        </div>
                    </div>
                    <div class="aspiration-card-back">
                        <h3>Rule of Law</h3>
                        <p>An Africa of good governance, democracy, respect for human rights, justice and the rule of law.</p>
                        <a href="{{ url('/about#goals') }}" class="view-aspiration-btn">View Aspiration <i class="fa-solid fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>

            <!-- Aspiration 4 -->
            <div class="aspiration-card">
                <div class="aspiration-card-inner">
                    <div class="aspiration-card-front">
                        <div class="card-bg" style="background-image: url('https://agenda2063.africa/assets/Aspiration4.png');"></div>
                        <div class="card-content">
                            <h3>Peace & Security</h3>
                            <p><i class="fa-solid fa-shield-halved"></i> Aspiration 4</p>
                        </div>
                    </div>
                    <div class="aspiration-card-back">
                        <h3>A Peaceful Africa</h3>
                        <p>A peaceful and secure Africa, free from conflict and violence, where dialogue prevails over guns.</p>
                        <a href="{{ url('/about#goals') }}" class="view-aspiration-btn">View Aspiration <i class="fa-solid fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>

            <!-- Aspiration 5 -->
            <div class="aspiration-card">
                <div class="aspiration-card-inner">
                    <div class="aspiration-card-front">
                        <div class="card-bg" style="background-image: url('https://agenda2063.africa/assets/Aspiration5.png');"></div>
                        <div class="card-content">
                            <h3>Cultural Renaissance</h3>
                            <p><i class="fa-solid fa-masks-theater"></i> Aspiration 5</p>
                        </div>
                    </div>
                    <div class="aspiration-card-back">
                        <h3>Strong Identity</h3>
                        <p>An Africa with a strong cultural identity, common heritage, shared values and ethics.</p>
                        <a href="{{ url('/about#goals') }}" class="view-aspiration-btn">View Aspiration <i class="fa-solid fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>

            <!-- Aspiration 6 -->
            <div class="aspiration-card">
                <div class="aspiration-card-inner">
                    <div class="aspiration-card-front">
                        <div class="card-bg" style="background-image: url('https://agenda2063.africa/assets/Aspiration6.png');"></div>
                        <div class="card-content">
                            <h3>People-Driven</h3>
                            <p><i class="fa-solid fa-users"></i> Aspiration 6</p>
                        </div>
                    </div>
                    <div class="aspiration-card-back">
                        <h3>Youth & Women</h3>
                        <p>An Africa whose development is people-driven, relying on the potential of African people, especially its women and youth.</p>
                        <a href="{{ url('/about#goals') }}" class="view-aspiration-btn">View Aspiration <i class="fa-solid fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>

            <!-- Aspiration 7 -->
            <div class="aspiration-card">
                <div class="aspiration-card-inner">
                    <div class="aspiration-card-front">
                        <div class="card-bg" style="background-image: url('https://agenda2063.africa/assets/Aspiration7.png');"></div>
                        <div class="card-content">
                            <h3>Global Player</h3>
                            <p><i class="fa-solid fa-globe"></i> Aspiration 7</p>
                        </div>
                    </div>
                    <div class="aspiration-card-back">
                        <h3>Influential Partner</h3>
                        <p>Africa as a strong, united, resilient and influential global player and partner.</p>
                        <a href="{{ url('/about#goals') }}" class="view-aspiration-btn">View Aspiration <i class="fa-solid fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Flagship Projects Section -->
    <section class="content-section flagship-section">
        <div class="section-header">
            <h2>Flagship Projects</h2>
            <a href="#" class="see-all">See All</a>
        </div>
        <div class="flagship-grid">
            <!-- Project 1 -->
            <div class="flagship-card">
                <div class="card-bg" style="background-image: url('https://agenda2063.africa/assets/flagship-1.jpg');"></div>
                <div class="card-content">
                    <div class="card-text-wrapper">
                        <h3>INTEGRATED HIGH SPEED TRAIN NETWORK</h3>
                        <small>Connecting African Capitals and Commercial Centres</small>
                        <div class="card-hidden-content">
                            <p>Aims to connect all African capitals and commercial centres through a high-speed train network.</p>
                            <a href="{{ url('/about#flagship') }}" class="view-project-btn">View Project <i class="fa-solid fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Project 2 -->
            <div class="flagship-card">
                <div class="card-bg" style="background-image: url('https://agenda2063.africa/assets/flagship-2.jpg');"></div>
                <div class="card-content">
                    <div class="card-text-wrapper">
                        <h3>AFRICAN COMMODITIES STRATEGY</h3>
                        <small>Transforming Africa's Commodities Sector</small>
                        <div class="card-hidden-content">
                            <p>Developing a continental commodities strategy to enable African countries to add value.</p>
                            <a href="{{ url('/about#flagship') }}" class="view-project-btn">View Project <i class="fa-solid fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Project 3 -->
            <div class="flagship-card">
                <div class="card-bg" style="background-image: url('https://agenda2063.africa/assets/flagship-3.jpg');"></div>
                <div class="card-content">
                    <div class="card-text-wrapper">
                        <h3>AFRICAN CONTINENTAL FREE TRADE AREA (AFCFTA)</h3>
                        <small>Boosting Intra-African Trade</small>
                        <div class="card-hidden-content">
                            <p>Accelerates intra-African trade and strengthens Africa's position in the global market.</p>
                            <a href="{{ url('/about#flagship') }}" class="view-project-btn">View Project <i class="fa-solid fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
