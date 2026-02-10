@extends('layouts.admin')

@section('title', 'Country Reports')
@section('page-title', 'Country Reports')

@section('content')

    <!-- Page Header -->
    <div class="page-header-banner">
        <div class="page-header-text">
            <h1><i class="fa-solid fa-flag"></i> Country Reports</h1>
            <p>View and manage individual country performance reports for Agenda 2063.</p>
        </div>
        <div class="page-header-actions">
            <button class="btn-outline-admin"><i class="fa-solid fa-download"></i> Export All</button>
            <button class="btn-primary-admin"><i class="fa-solid fa-plus"></i> Add Report</button>
        </div>
    </div>

    <!-- Search & Filter -->
    <div class="admin-toolbar">
        <div class="toolbar-search">
            <i class="fa-solid fa-search"></i>
            <input type="text" placeholder="Search by country name...">
        </div>
        <div class="toolbar-filters">
            <select class="filter-select">
                <option>All Regions</option>
                <option>North Africa</option>
                <option>West Africa</option>
                <option>Central Africa</option>
                <option>East Africa</option>
                <option>Southern Africa</option>
            </select>
            <select class="filter-select">
                <option>All Years</option>
                <option>2026</option>
                <option>2025</option>
                <option>2024</option>
            </select>
            <select class="filter-select">
                <option>All Status</option>
                <option>Submitted</option>
                <option>Under Review</option>
                <option>Pending</option>
            </select>
        </div>
    </div>

    <!-- Countries Table -->
    <div class="admin-table-card">
        <table class="admin-table">
            <thead>
                <tr>
                    <th><input type="checkbox" class="table-check-all"></th>
                    <th>Country</th>
                    <th>Region</th>
                    <th>Overall Score</th>
                    <th>Report Year</th>
                    <th>Status</th>
                    <th>Last Updated</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><input type="checkbox" class="table-check"></td>
                    <td>
                        <div class="country-cell">
                            <span class="country-flag">🇳🇬</span>
                            <span class="table-title">Nigeria</span>
                        </div>
                    </td>
                    <td>West Africa</td>
                    <td>
                        <div class="score-cell">
                            <div class="mini-bar"><div class="mini-fill" style="width: 62%; background: #f39c12;"></div></div>
                            <span>62%</span>
                        </div>
                    </td>
                    <td>2025</td>
                    <td><span class="status-badge published">Submitted</span></td>
                    <td>Jan 20, 2026</td>
                    <td>
                        <div class="table-actions">
                            <button class="action-icon-btn" title="View Report"><i class="fa-solid fa-eye"></i></button>
                            <button class="action-icon-btn" title="Edit"><i class="fa-solid fa-pen"></i></button>
                            <button class="action-icon-btn" title="Download"><i class="fa-solid fa-download"></i></button>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td><input type="checkbox" class="table-check"></td>
                    <td>
                        <div class="country-cell">
                            <span class="country-flag">🇰🇪</span>
                            <span class="table-title">Kenya</span>
                        </div>
                    </td>
                    <td>East Africa</td>
                    <td>
                        <div class="score-cell">
                            <div class="mini-bar"><div class="mini-fill" style="width: 74%; background: #2ecc71;"></div></div>
                            <span>74%</span>
                        </div>
                    </td>
                    <td>2025</td>
                    <td><span class="status-badge published">Submitted</span></td>
                    <td>Jan 18, 2026</td>
                    <td>
                        <div class="table-actions">
                            <button class="action-icon-btn" title="View Report"><i class="fa-solid fa-eye"></i></button>
                            <button class="action-icon-btn" title="Edit"><i class="fa-solid fa-pen"></i></button>
                            <button class="action-icon-btn" title="Download"><i class="fa-solid fa-download"></i></button>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td><input type="checkbox" class="table-check"></td>
                    <td>
                        <div class="country-cell">
                            <span class="country-flag">🇿🇦</span>
                            <span class="table-title">South Africa</span>
                        </div>
                    </td>
                    <td>Southern Africa</td>
                    <td>
                        <div class="score-cell">
                            <div class="mini-bar"><div class="mini-fill" style="width: 69%; background: #2ecc71;"></div></div>
                            <span>69%</span>
                        </div>
                    </td>
                    <td>2025</td>
                    <td><span class="status-badge scheduled">Under Review</span></td>
                    <td>Feb 02, 2026</td>
                    <td>
                        <div class="table-actions">
                            <button class="action-icon-btn" title="View Report"><i class="fa-solid fa-eye"></i></button>
                            <button class="action-icon-btn" title="Edit"><i class="fa-solid fa-pen"></i></button>
                            <button class="action-icon-btn" title="Download"><i class="fa-solid fa-download"></i></button>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td><input type="checkbox" class="table-check"></td>
                    <td>
                        <div class="country-cell">
                            <span class="country-flag">🇪🇹</span>
                            <span class="table-title">Ethiopia</span>
                        </div>
                    </td>
                    <td>East Africa</td>
                    <td>
                        <div class="score-cell">
                            <div class="mini-bar"><div class="mini-fill" style="width: 58%; background: #f39c12;"></div></div>
                            <span>58%</span>
                        </div>
                    </td>
                    <td>2025</td>
                    <td><span class="status-badge published">Submitted</span></td>
                    <td>Dec 15, 2025</td>
                    <td>
                        <div class="table-actions">
                            <button class="action-icon-btn" title="View Report"><i class="fa-solid fa-eye"></i></button>
                            <button class="action-icon-btn" title="Edit"><i class="fa-solid fa-pen"></i></button>
                            <button class="action-icon-btn" title="Download"><i class="fa-solid fa-download"></i></button>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td><input type="checkbox" class="table-check"></td>
                    <td>
                        <div class="country-cell">
                            <span class="country-flag">🇬🇭</span>
                            <span class="table-title">Ghana</span>
                        </div>
                    </td>
                    <td>West Africa</td>
                    <td>
                        <div class="score-cell">
                            <div class="mini-bar"><div class="mini-fill" style="width: 71%; background: #2ecc71;"></div></div>
                            <span>71%</span>
                        </div>
                    </td>
                    <td>2025</td>
                    <td><span class="status-badge published">Submitted</span></td>
                    <td>Jan 10, 2026</td>
                    <td>
                        <div class="table-actions">
                            <button class="action-icon-btn" title="View Report"><i class="fa-solid fa-eye"></i></button>
                            <button class="action-icon-btn" title="Edit"><i class="fa-solid fa-pen"></i></button>
                            <button class="action-icon-btn" title="Download"><i class="fa-solid fa-download"></i></button>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td><input type="checkbox" class="table-check"></td>
                    <td>
                        <div class="country-cell">
                            <span class="country-flag">🇪🇬</span>
                            <span class="table-title">Egypt</span>
                        </div>
                    </td>
                    <td>North Africa</td>
                    <td>
                        <div class="score-cell">
                            <div class="mini-bar"><div class="mini-fill" style="width: 66%; background: #2ecc71;"></div></div>
                            <span>66%</span>
                        </div>
                    </td>
                    <td>2025</td>
                    <td><span class="status-badge draft">Pending</span></td>
                    <td>Nov 28, 2025</td>
                    <td>
                        <div class="table-actions">
                            <button class="action-icon-btn" title="View Report"><i class="fa-solid fa-eye"></i></button>
                            <button class="action-icon-btn" title="Edit"><i class="fa-solid fa-pen"></i></button>
                            <button class="action-icon-btn" title="Download"><i class="fa-solid fa-download"></i></button>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>

        <div class="table-pagination">
            <span class="pagination-info">Showing 1-6 of 55 countries</span>
            <div class="pagination-controls">
                <button class="pagination-btn" disabled><i class="fa-solid fa-chevron-left"></i></button>
                <button class="pagination-btn active">1</button>
                <button class="pagination-btn">2</button>
                <button class="pagination-btn">3</button>
                <button class="pagination-btn">...</button>
                <button class="pagination-btn">10</button>
                <button class="pagination-btn"><i class="fa-solid fa-chevron-right"></i></button>
            </div>
        </div>
    </div>

@endsection
