@extends('layouts.admin')

@section('title', 'Goals Tracking')
@section('page-title', 'Goals Tracking')

@section('content')

    <!-- Page Header -->
    <div class="page-header-banner">
        <div class="page-header-text">
            <h1><i class="fa-solid fa-bullseye"></i> Goals Tracking</h1>
            <p>Track progress across Agenda 2063's 7 aspirations and 20 goals.</p>
        </div>
        <div class="page-header-actions">
            <select class="filter-select">
                <option>All Aspirations</option>
                <option>Aspiration 1 - Prosperity</option>
                <option>Aspiration 2 - Integration</option>
                <option>Aspiration 3 - Governance</option>
                <option>Aspiration 4 - Peace</option>
                <option>Aspiration 5 - Identity</option>
                <option>Aspiration 6 - People-Driven</option>
                <option>Aspiration 7 - Global Player</option>
            </select>
            <button class="btn-primary-admin"><i class="fa-solid fa-pen"></i> Update Goals</button>
        </div>
    </div>

    <!-- Overall Progress -->
    <div class="goals-overview">
        <div class="goals-overview-card">
            <div class="overview-ring">
                <svg viewBox="0 0 120 120">
                    <circle cx="60" cy="60" r="52" stroke="var(--border-color)" stroke-width="10" fill="none"/>
                    <circle cx="60" cy="60" r="52" stroke="#822b39" stroke-width="10" fill="none"
                            stroke-dasharray="327" stroke-dashoffset="131" stroke-linecap="round"
                            transform="rotate(-90, 60, 60)"/>
                </svg>
                <span class="ring-value">60%</span>
            </div>
            <div class="overview-info">
                <h3>Overall Progress</h3>
                <p>Average completion across all 7 aspirations and 20 goals of Agenda 2063.</p>
            </div>
        </div>
        <div class="overview-stats-row">
            <div class="overview-stat">
                <span class="overview-stat-num on-track">12</span>
                <span class="overview-stat-label">On Track</span>
            </div>
            <div class="overview-stat">
                <span class="overview-stat-num at-risk">5</span>
                <span class="overview-stat-label">At Risk</span>
            </div>
            <div class="overview-stat">
                <span class="overview-stat-num off-track">3</span>
                <span class="overview-stat-label">Off Track</span>
            </div>
        </div>
    </div>

    <!-- Goals List -->
    <div class="goals-list">

        <!-- Aspiration 1 -->
        <div class="aspiration-group">
            <div class="aspiration-header">
                <div class="aspiration-number">1</div>
                <div>
                    <h3>A Prosperous Africa</h3>
                    <p>Based on inclusive growth and sustainable development</p>
                </div>
                <span class="aspiration-avg">65%</span>
            </div>
            <div class="goals-items">
                <div class="goal-item">
                    <div class="goal-info">
                        <span class="goal-number">Goal 1</span>
                        <span class="goal-title">A high standard of living, quality of life and well-being for all citizens</span>
                    </div>
                    <div class="goal-progress-wrap">
                        <div class="goal-bar"><div class="goal-fill" style="width: 58%;"></div></div>
                        <span class="goal-pct">58%</span>
                    </div>
                    <span class="goal-status at-risk">At Risk</span>
                    <button class="action-icon-btn" title="Edit"><i class="fa-solid fa-pen"></i></button>
                </div>
                <div class="goal-item">
                    <div class="goal-info">
                        <span class="goal-number">Goal 2</span>
                        <span class="goal-title">Well educated citizens and skills revolution underpinned by science, technology and innovation</span>
                    </div>
                    <div class="goal-progress-wrap">
                        <div class="goal-bar"><div class="goal-fill" style="width: 62%;"></div></div>
                        <span class="goal-pct">62%</span>
                    </div>
                    <span class="goal-status on-track">On Track</span>
                    <button class="action-icon-btn" title="Edit"><i class="fa-solid fa-pen"></i></button>
                </div>
                <div class="goal-item">
                    <div class="goal-info">
                        <span class="goal-number">Goal 3</span>
                        <span class="goal-title">Healthy and well-nourished citizens</span>
                    </div>
                    <div class="goal-progress-wrap">
                        <div class="goal-bar"><div class="goal-fill" style="width: 55%;"></div></div>
                        <span class="goal-pct">55%</span>
                    </div>
                    <span class="goal-status at-risk">At Risk</span>
                    <button class="action-icon-btn" title="Edit"><i class="fa-solid fa-pen"></i></button>
                </div>
                <div class="goal-item">
                    <div class="goal-info">
                        <span class="goal-number">Goal 4</span>
                        <span class="goal-title">Transformed economies and job creation</span>
                    </div>
                    <div class="goal-progress-wrap">
                        <div class="goal-bar"><div class="goal-fill" style="width: 48%;"></div></div>
                        <span class="goal-pct">48%</span>
                    </div>
                    <span class="goal-status off-track">Off Track</span>
                    <button class="action-icon-btn" title="Edit"><i class="fa-solid fa-pen"></i></button>
                </div>
                <div class="goal-item">
                    <div class="goal-info">
                        <span class="goal-number">Goal 5</span>
                        <span class="goal-title">Modern agriculture for increased productivity and production</span>
                    </div>
                    <div class="goal-progress-wrap">
                        <div class="goal-bar"><div class="goal-fill" style="width: 70%;"></div></div>
                        <span class="goal-pct">70%</span>
                    </div>
                    <span class="goal-status on-track">On Track</span>
                    <button class="action-icon-btn" title="Edit"><i class="fa-solid fa-pen"></i></button>
                </div>
            </div>
        </div>

        <!-- Aspiration 2 -->
        <div class="aspiration-group">
            <div class="aspiration-header">
                <div class="aspiration-number">2</div>
                <div>
                    <h3>An Integrated Continent</h3>
                    <p>Politically united based on the ideals of Pan-Africanism</p>
                </div>
                <span class="aspiration-avg">62%</span>
            </div>
            <div class="goals-items">
                <div class="goal-item">
                    <div class="goal-info">
                        <span class="goal-number">Goal 6</span>
                        <span class="goal-title">Blue/ocean economy for accelerated economic growth</span>
                    </div>
                    <div class="goal-progress-wrap">
                        <div class="goal-bar"><div class="goal-fill" style="width: 45%;"></div></div>
                        <span class="goal-pct">45%</span>
                    </div>
                    <span class="goal-status off-track">Off Track</span>
                    <button class="action-icon-btn" title="Edit"><i class="fa-solid fa-pen"></i></button>
                </div>
                <div class="goal-item">
                    <div class="goal-info">
                        <span class="goal-number">Goal 7</span>
                        <span class="goal-title">Environmentally sustainable climate resilient economies</span>
                    </div>
                    <div class="goal-progress-wrap">
                        <div class="goal-bar"><div class="goal-fill" style="width: 52%;"></div></div>
                        <span class="goal-pct">52%</span>
                    </div>
                    <span class="goal-status at-risk">At Risk</span>
                    <button class="action-icon-btn" title="Edit"><i class="fa-solid fa-pen"></i></button>
                </div>
                <div class="goal-item">
                    <div class="goal-info">
                        <span class="goal-number">Goal 8</span>
                        <span class="goal-title">United Africa (Federal or Confederate)</span>
                    </div>
                    <div class="goal-progress-wrap">
                        <div class="goal-bar"><div class="goal-fill" style="width: 68%;"></div></div>
                        <span class="goal-pct">68%</span>
                    </div>
                    <span class="goal-status on-track">On Track</span>
                    <button class="action-icon-btn" title="Edit"><i class="fa-solid fa-pen"></i></button>
                </div>
                <div class="goal-item">
                    <div class="goal-info">
                        <span class="goal-number">Goal 9</span>
                        <span class="goal-title">Continental financial and monetary institutions established</span>
                    </div>
                    <div class="goal-progress-wrap">
                        <div class="goal-bar"><div class="goal-fill" style="width: 72%;"></div></div>
                        <span class="goal-pct">72%</span>
                    </div>
                    <span class="goal-status on-track">On Track</span>
                    <button class="action-icon-btn" title="Edit"><i class="fa-solid fa-pen"></i></button>
                </div>
                <div class="goal-item">
                    <div class="goal-info">
                        <span class="goal-number">Goal 10</span>
                        <span class="goal-title">World-class infrastructure criss-crosses Africa</span>
                    </div>
                    <div class="goal-progress-wrap">
                        <div class="goal-bar"><div class="goal-fill" style="width: 40%;"></div></div>
                        <span class="goal-pct">40%</span>
                    </div>
                    <span class="goal-status off-track">Off Track</span>
                    <button class="action-icon-btn" title="Edit"><i class="fa-solid fa-pen"></i></button>
                </div>
            </div>
        </div>

        <!-- Aspiration 3 -->
        <div class="aspiration-group">
            <div class="aspiration-header">
                <div class="aspiration-number">3</div>
                <div>
                    <h3>Good Governance & Democracy</h3>
                    <p>Respect for human rights, justice and the rule of law</p>
                </div>
                <span class="aspiration-avg">71%</span>
            </div>
            <div class="goals-items">
                <div class="goal-item">
                    <div class="goal-info">
                        <span class="goal-number">Goal 11</span>
                        <span class="goal-title">Democratic values, practices, universal principles of human rights upheld</span>
                    </div>
                    <div class="goal-progress-wrap">
                        <div class="goal-bar"><div class="goal-fill" style="width: 74%;"></div></div>
                        <span class="goal-pct">74%</span>
                    </div>
                    <span class="goal-status on-track">On Track</span>
                    <button class="action-icon-btn" title="Edit"><i class="fa-solid fa-pen"></i></button>
                </div>
                <div class="goal-item">
                    <div class="goal-info">
                        <span class="goal-number">Goal 12</span>
                        <span class="goal-title">Capable institutions and transformative leadership in place</span>
                    </div>
                    <div class="goal-progress-wrap">
                        <div class="goal-bar"><div class="goal-fill" style="width: 68%;"></div></div>
                        <span class="goal-pct">68%</span>
                    </div>
                    <span class="goal-status on-track">On Track</span>
                    <button class="action-icon-btn" title="Edit"><i class="fa-solid fa-pen"></i></button>
                </div>
            </div>
        </div>

    </div>

@endsection
