@extends('layouts.admin')

@section('title', 'Publications')
@section('page-title', 'Publications')

@section('content')

    <!-- Page Header -->
    <div class="page-header-banner">
        <div class="page-header-text">
            <h1><i class="fa-solid fa-file-alt"></i> Publications</h1>
            <p>Manage reports, policy briefs, research papers, and official publications.</p>
        </div>
        <div class="page-header-actions">
            <button class="btn-outline-admin"><i class="fa-solid fa-file-export"></i> Export List</button>
            <button class="btn-primary-admin"><i class="fa-solid fa-plus"></i> Add Publication</button>
        </div>
    </div>

    <!-- Tabs -->
    <div class="admin-tabs">
        <button class="admin-tab active">All Publications <span class="tab-count">38</span></button>
        <button class="admin-tab">Reports <span class="tab-count">14</span></button>
        <button class="admin-tab">Policy Briefs <span class="tab-count">10</span></button>
        <button class="admin-tab">Research Papers <span class="tab-count">8</span></button>
        <button class="admin-tab">Communiques <span class="tab-count">6</span></button>
    </div>

    <!-- Toolbar -->
    <div class="admin-toolbar">
        <div class="toolbar-search">
            <i class="fa-solid fa-search"></i>
            <input type="text" placeholder="Search publications...">
        </div>
        <div class="toolbar-filters">
            <select class="filter-select">
                <option>All Years</option>
                <option>2026</option>
                <option>2025</option>
                <option>2024</option>
                <option>2023</option>
            </select>
            <select class="filter-select">
                <option>All Languages</option>
                <option>English</option>
                <option>French</option>
                <option>Arabic</option>
                <option>Portuguese</option>
            </select>
        </div>
    </div>

    <!-- Publications Table -->
    <div class="admin-table-card">
        <table class="admin-table">
            <thead>
                <tr>
                    <th><input type="checkbox" class="table-check-all"></th>
                    <th>Publication</th>
                    <th>Type</th>
                    <th>Language</th>
                    <th>Year</th>
                    <th>Downloads</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><input type="checkbox" class="table-check"></td>
                    <td>
                        <div class="table-title-cell">
                            <div class="doc-icon pdf"><i class="fa-solid fa-file-pdf"></i></div>
                            <div>
                                <span class="table-title">Agenda 2063: The Africa We Want - Popular Version</span>
                                <span class="table-subtitle">Official summary document for public dissemination</span>
                            </div>
                        </div>
                    </td>
                    <td><span class="category-badge blue">Report</span></td>
                    <td>English</td>
                    <td>2025</td>
                    <td>4,521</td>
                    <td>
                        <div class="table-actions">
                            <button class="action-icon-btn" title="Edit"><i class="fa-solid fa-pen"></i></button>
                            <button class="action-icon-btn" title="Download"><i class="fa-solid fa-download"></i></button>
                            <button class="action-icon-btn danger" title="Delete"><i class="fa-solid fa-trash"></i></button>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td><input type="checkbox" class="table-check"></td>
                    <td>
                        <div class="table-title-cell">
                            <div class="doc-icon pdf"><i class="fa-solid fa-file-pdf"></i></div>
                            <div>
                                <span class="table-title">AfCFTA Trade Policy Brief - Q4 2025</span>
                                <span class="table-subtitle">Quarterly analysis of continental trade patterns</span>
                            </div>
                        </div>
                    </td>
                    <td><span class="category-badge green">Policy Brief</span></td>
                    <td>English, French</td>
                    <td>2025</td>
                    <td>1,890</td>
                    <td>
                        <div class="table-actions">
                            <button class="action-icon-btn" title="Edit"><i class="fa-solid fa-pen"></i></button>
                            <button class="action-icon-btn" title="Download"><i class="fa-solid fa-download"></i></button>
                            <button class="action-icon-btn danger" title="Delete"><i class="fa-solid fa-trash"></i></button>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td><input type="checkbox" class="table-check"></td>
                    <td>
                        <div class="table-title-cell">
                            <div class="doc-icon word"><i class="fa-solid fa-file-word"></i></div>
                            <div>
                                <span class="table-title">Digital Transformation Strategy for Africa</span>
                                <span class="table-subtitle">Research paper on ICT adoption and digital governance</span>
                            </div>
                        </div>
                    </td>
                    <td><span class="category-badge gold">Research</span></td>
                    <td>English</td>
                    <td>2025</td>
                    <td>892</td>
                    <td>
                        <div class="table-actions">
                            <button class="action-icon-btn" title="Edit"><i class="fa-solid fa-pen"></i></button>
                            <button class="action-icon-btn" title="Download"><i class="fa-solid fa-download"></i></button>
                            <button class="action-icon-btn danger" title="Delete"><i class="fa-solid fa-trash"></i></button>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td><input type="checkbox" class="table-check"></td>
                    <td>
                        <div class="table-title-cell">
                            <div class="doc-icon pdf"><i class="fa-solid fa-file-pdf"></i></div>
                            <div>
                                <span class="table-title">AU Assembly Decision on Agenda 2063 - Jan 2026</span>
                                <span class="table-subtitle">Official communique from the 38th AU Summit</span>
                            </div>
                        </div>
                    </td>
                    <td><span class="category-badge maroon">Communique</span></td>
                    <td>All AU Languages</td>
                    <td>2026</td>
                    <td>2,104</td>
                    <td>
                        <div class="table-actions">
                            <button class="action-icon-btn" title="Edit"><i class="fa-solid fa-pen"></i></button>
                            <button class="action-icon-btn" title="Download"><i class="fa-solid fa-download"></i></button>
                            <button class="action-icon-btn danger" title="Delete"><i class="fa-solid fa-trash"></i></button>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>

        <div class="table-pagination">
            <span class="pagination-info">Showing 1-4 of 38 publications</span>
            <div class="pagination-controls">
                <button class="pagination-btn" disabled><i class="fa-solid fa-chevron-left"></i></button>
                <button class="pagination-btn active">1</button>
                <button class="pagination-btn">2</button>
                <button class="pagination-btn">3</button>
                <button class="pagination-btn">...</button>
                <button class="pagination-btn">8</button>
                <button class="pagination-btn"><i class="fa-solid fa-chevron-right"></i></button>
            </div>
        </div>
    </div>

@endsection
