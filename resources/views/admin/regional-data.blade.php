@extends('layouts.admin')

@section('title', 'Regional Data')
@section('page-title', 'Regional Data')

@section('content')

    <!-- Page Header -->
    <div class="page-header-banner">
        <div class="page-header-text">
            <h1><i class="fa-solid fa-map-marked-alt"></i> Regional Data</h1>
            <p>Monitor and manage performance data across Africa's Regional Economic Communities.</p>
        </div>
        <div class="page-header-actions">
            <select class="filter-select" id="yearSelect">
                <option>2026</option>
                <option>2025</option>
                <option>2024</option>
            </select>
            <button class="btn-primary-admin"><i class="fa-solid fa-sync"></i> Update Data</button>
        </div>
    </div>

    <!-- Regional Cards Grid -->
    <div class="regional-grid">

        <div class="regional-card">
            <div class="regional-card-header" style="border-left: 4px solid #3498db;">
                <div>
                    <h3>ECOWAS</h3>
                    <p>Economic Community of West African States</p>
                </div>
                <div class="regional-score" style="color: #3498db;">68%</div>
            </div>
            <div class="regional-card-body">
                <div class="regional-indicators">
                    <div class="indicator-row">
                        <span>Trade Integration</span>
                        <div class="indicator-bar"><div class="indicator-fill" style="width: 72%; background: #3498db;"></div></div>
                        <span>72%</span>
                    </div>
                    <div class="indicator-row">
                        <span>Infrastructure</span>
                        <div class="indicator-bar"><div class="indicator-fill" style="width: 58%; background: #3498db;"></div></div>
                        <span>58%</span>
                    </div>
                    <div class="indicator-row">
                        <span>Governance</span>
                        <div class="indicator-bar"><div class="indicator-fill" style="width: 75%; background: #3498db;"></div></div>
                        <span>75%</span>
                    </div>
                    <div class="indicator-row">
                        <span>Social Development</span>
                        <div class="indicator-bar"><div class="indicator-fill" style="width: 64%; background: #3498db;"></div></div>
                        <span>64%</span>
                    </div>
                </div>
                <div class="regional-meta">
                    <span>15 Member States</span>
                    <div class="regional-actions">
                        <button class="action-icon-btn" title="Edit"><i class="fa-solid fa-pen"></i></button>
                        <button class="action-icon-btn" title="Full Report"><i class="fa-solid fa-file-alt"></i></button>
                    </div>
                </div>
            </div>
        </div>

        <div class="regional-card">
            <div class="regional-card-header" style="border-left: 4px solid #9b59b6;">
                <div>
                    <h3>SADC</h3>
                    <p>Southern African Development Community</p>
                </div>
                <div class="regional-score" style="color: #9b59b6;">54%</div>
            </div>
            <div class="regional-card-body">
                <div class="regional-indicators">
                    <div class="indicator-row">
                        <span>Trade Integration</span>
                        <div class="indicator-bar"><div class="indicator-fill" style="width: 60%; background: #9b59b6;"></div></div>
                        <span>60%</span>
                    </div>
                    <div class="indicator-row">
                        <span>Infrastructure</span>
                        <div class="indicator-bar"><div class="indicator-fill" style="width: 48%; background: #9b59b6;"></div></div>
                        <span>48%</span>
                    </div>
                    <div class="indicator-row">
                        <span>Governance</span>
                        <div class="indicator-bar"><div class="indicator-fill" style="width: 62%; background: #9b59b6;"></div></div>
                        <span>62%</span>
                    </div>
                    <div class="indicator-row">
                        <span>Social Development</span>
                        <div class="indicator-bar"><div class="indicator-fill" style="width: 46%; background: #9b59b6;"></div></div>
                        <span>46%</span>
                    </div>
                </div>
                <div class="regional-meta">
                    <span>16 Member States</span>
                    <div class="regional-actions">
                        <button class="action-icon-btn" title="Edit"><i class="fa-solid fa-pen"></i></button>
                        <button class="action-icon-btn" title="Full Report"><i class="fa-solid fa-file-alt"></i></button>
                    </div>
                </div>
            </div>
        </div>

        <div class="regional-card">
            <div class="regional-card-header" style="border-left: 4px solid #f39c12;">
                <div>
                    <h3>EAC</h3>
                    <p>East African Community</p>
                </div>
                <div class="regional-score" style="color: #f39c12;">72%</div>
            </div>
            <div class="regional-card-body">
                <div class="regional-indicators">
                    <div class="indicator-row">
                        <span>Trade Integration</span>
                        <div class="indicator-bar"><div class="indicator-fill" style="width: 78%; background: #f39c12;"></div></div>
                        <span>78%</span>
                    </div>
                    <div class="indicator-row">
                        <span>Infrastructure</span>
                        <div class="indicator-bar"><div class="indicator-fill" style="width: 65%; background: #f39c12;"></div></div>
                        <span>65%</span>
                    </div>
                    <div class="indicator-row">
                        <span>Governance</span>
                        <div class="indicator-bar"><div class="indicator-fill" style="width: 80%; background: #f39c12;"></div></div>
                        <span>80%</span>
                    </div>
                    <div class="indicator-row">
                        <span>Social Development</span>
                        <div class="indicator-bar"><div class="indicator-fill" style="width: 66%; background: #f39c12;"></div></div>
                        <span>66%</span>
                    </div>
                </div>
                <div class="regional-meta">
                    <span>8 Member States</span>
                    <div class="regional-actions">
                        <button class="action-icon-btn" title="Edit"><i class="fa-solid fa-pen"></i></button>
                        <button class="action-icon-btn" title="Full Report"><i class="fa-solid fa-file-alt"></i></button>
                    </div>
                </div>
            </div>
        </div>

        <div class="regional-card">
            <div class="regional-card-header" style="border-left: 4px solid #2ecc71;">
                <div>
                    <h3>ECCAS</h3>
                    <p>Economic Community of Central African States</p>
                </div>
                <div class="regional-score" style="color: #2ecc71;">41%</div>
            </div>
            <div class="regional-card-body">
                <div class="regional-indicators">
                    <div class="indicator-row">
                        <span>Trade Integration</span>
                        <div class="indicator-bar"><div class="indicator-fill" style="width: 38%; background: #2ecc71;"></div></div>
                        <span>38%</span>
                    </div>
                    <div class="indicator-row">
                        <span>Infrastructure</span>
                        <div class="indicator-bar"><div class="indicator-fill" style="width: 32%; background: #2ecc71;"></div></div>
                        <span>32%</span>
                    </div>
                    <div class="indicator-row">
                        <span>Governance</span>
                        <div class="indicator-bar"><div class="indicator-fill" style="width: 50%; background: #2ecc71;"></div></div>
                        <span>50%</span>
                    </div>
                    <div class="indicator-row">
                        <span>Social Development</span>
                        <div class="indicator-bar"><div class="indicator-fill" style="width: 42%; background: #2ecc71;"></div></div>
                        <span>42%</span>
                    </div>
                </div>
                <div class="regional-meta">
                    <span>11 Member States</span>
                    <div class="regional-actions">
                        <button class="action-icon-btn" title="Edit"><i class="fa-solid fa-pen"></i></button>
                        <button class="action-icon-btn" title="Full Report"><i class="fa-solid fa-file-alt"></i></button>
                    </div>
                </div>
            </div>
        </div>

        <div class="regional-card">
            <div class="regional-card-header" style="border-left: 4px solid #e74c3c;">
                <div>
                    <h3>COMESA</h3>
                    <p>Common Market for Eastern and Southern Africa</p>
                </div>
                <div class="regional-score" style="color: #e74c3c;">59%</div>
            </div>
            <div class="regional-card-body">
                <div class="regional-indicators">
                    <div class="indicator-row">
                        <span>Trade Integration</span>
                        <div class="indicator-bar"><div class="indicator-fill" style="width: 65%; background: #e74c3c;"></div></div>
                        <span>65%</span>
                    </div>
                    <div class="indicator-row">
                        <span>Infrastructure</span>
                        <div class="indicator-bar"><div class="indicator-fill" style="width: 52%; background: #e74c3c;"></div></div>
                        <span>52%</span>
                    </div>
                    <div class="indicator-row">
                        <span>Governance</span>
                        <div class="indicator-bar"><div class="indicator-fill" style="width: 66%; background: #e74c3c;"></div></div>
                        <span>66%</span>
                    </div>
                    <div class="indicator-row">
                        <span>Social Development</span>
                        <div class="indicator-bar"><div class="indicator-fill" style="width: 54%; background: #e74c3c;"></div></div>
                        <span>54%</span>
                    </div>
                </div>
                <div class="regional-meta">
                    <span>21 Member States</span>
                    <div class="regional-actions">
                        <button class="action-icon-btn" title="Edit"><i class="fa-solid fa-pen"></i></button>
                        <button class="action-icon-btn" title="Full Report"><i class="fa-solid fa-file-alt"></i></button>
                    </div>
                </div>
            </div>
        </div>

        <div class="regional-card">
            <div class="regional-card-header" style="border-left: 4px solid #1abc9c;">
                <div>
                    <h3>AMU / UMA</h3>
                    <p>Arab Maghreb Union</p>
                </div>
                <div class="regional-score" style="color: #1abc9c;">47%</div>
            </div>
            <div class="regional-card-body">
                <div class="regional-indicators">
                    <div class="indicator-row">
                        <span>Trade Integration</span>
                        <div class="indicator-bar"><div class="indicator-fill" style="width: 42%; background: #1abc9c;"></div></div>
                        <span>42%</span>
                    </div>
                    <div class="indicator-row">
                        <span>Infrastructure</span>
                        <div class="indicator-bar"><div class="indicator-fill" style="width: 55%; background: #1abc9c;"></div></div>
                        <span>55%</span>
                    </div>
                    <div class="indicator-row">
                        <span>Governance</span>
                        <div class="indicator-bar"><div class="indicator-fill" style="width: 48%; background: #1abc9c;"></div></div>
                        <span>48%</span>
                    </div>
                    <div class="indicator-row">
                        <span>Social Development</span>
                        <div class="indicator-bar"><div class="indicator-fill" style="width: 44%; background: #1abc9c;"></div></div>
                        <span>44%</span>
                    </div>
                </div>
                <div class="regional-meta">
                    <span>5 Member States</span>
                    <div class="regional-actions">
                        <button class="action-icon-btn" title="Edit"><i class="fa-solid fa-pen"></i></button>
                        <button class="action-icon-btn" title="Full Report"><i class="fa-solid fa-file-alt"></i></button>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection
