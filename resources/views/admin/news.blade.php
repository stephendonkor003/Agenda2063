@extends('layouts.admin')

@section('title', 'News & Events')
@section('page-title', 'News & Events')

@section('content')

    <!-- Page Header -->
    <div class="page-header-banner">
        <div class="page-header-text">
            <h1><i class="fa-solid fa-newspaper"></i> News & Events</h1>
            <p>Manage articles, press releases, and upcoming events.</p>
        </div>
        <div class="page-header-actions">
            <button class="btn-outline-admin"><i class="fa-solid fa-filter"></i> Filter</button>
            <button class="btn-primary-admin"><i class="fa-solid fa-plus"></i> New Article</button>
        </div>
    </div>

    <!-- Tabs -->
    <div class="admin-tabs">
        <button class="admin-tab active" data-tab="articles">Articles <span class="tab-count">24</span></button>
        <button class="admin-tab" data-tab="events">Events <span class="tab-count">8</span></button>
        <button class="admin-tab" data-tab="press">Press Releases <span class="tab-count">12</span></button>
        <button class="admin-tab" data-tab="drafts">Drafts <span class="tab-count">5</span></button>
    </div>

    <!-- Search & Filter Bar -->
    <div class="admin-toolbar">
        <div class="toolbar-search">
            <i class="fa-solid fa-search"></i>
            <input type="text" placeholder="Search articles, events...">
        </div>
        <div class="toolbar-filters">
            <select class="filter-select">
                <option>All Categories</option>
                <option>Trade & Economy</option>
                <option>Peace & Security</option>
                <option>Infrastructure</option>
                <option>Governance</option>
            </select>
            <select class="filter-select">
                <option>All Status</option>
                <option>Published</option>
                <option>Draft</option>
                <option>Scheduled</option>
            </select>
        </div>
    </div>

    <!-- Articles Table -->
    <div class="admin-table-card">
        <table class="admin-table">
            <thead>
                <tr>
                    <th><input type="checkbox" class="table-check-all"></th>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Author</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th>Views</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><input type="checkbox" class="table-check"></td>
                    <td>
                        <div class="table-title-cell">
                            <span class="table-title">AfCFTA Trade Report 2025 Released</span>
                            <span class="table-subtitle">/news/afcfta-trade-report-2025</span>
                        </div>
                    </td>
                    <td><span class="category-badge blue">Trade & Economy</span></td>
                    <td>John Mensah</td>
                    <td><span class="status-badge published">Published</span></td>
                    <td>Feb 7, 2026</td>
                    <td>1,245</td>
                    <td>
                        <div class="table-actions">
                            <button class="action-icon-btn" title="Edit"><i class="fa-solid fa-pen"></i></button>
                            <button class="action-icon-btn" title="View"><i class="fa-solid fa-eye"></i></button>
                            <button class="action-icon-btn danger" title="Delete"><i class="fa-solid fa-trash"></i></button>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td><input type="checkbox" class="table-check"></td>
                    <td>
                        <div class="table-title-cell">
                            <span class="table-title">AU Summit 2026: Key Outcomes</span>
                            <span class="table-subtitle">/news/au-summit-2026-outcomes</span>
                        </div>
                    </td>
                    <td><span class="category-badge gold">Governance</span></td>
                    <td>Amina Diallo</td>
                    <td><span class="status-badge published">Published</span></td>
                    <td>Feb 5, 2026</td>
                    <td>2,089</td>
                    <td>
                        <div class="table-actions">
                            <button class="action-icon-btn" title="Edit"><i class="fa-solid fa-pen"></i></button>
                            <button class="action-icon-btn" title="View"><i class="fa-solid fa-eye"></i></button>
                            <button class="action-icon-btn danger" title="Delete"><i class="fa-solid fa-trash"></i></button>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td><input type="checkbox" class="table-check"></td>
                    <td>
                        <div class="table-title-cell">
                            <span class="table-title">SAATM Expansion: New Routes Announced</span>
                            <span class="table-subtitle">/news/saatm-new-routes</span>
                        </div>
                    </td>
                    <td><span class="category-badge green">Infrastructure</span></td>
                    <td>Kwame Asante</td>
                    <td><span class="status-badge draft">Draft</span></td>
                    <td>Feb 3, 2026</td>
                    <td>--</td>
                    <td>
                        <div class="table-actions">
                            <button class="action-icon-btn" title="Edit"><i class="fa-solid fa-pen"></i></button>
                            <button class="action-icon-btn" title="View"><i class="fa-solid fa-eye"></i></button>
                            <button class="action-icon-btn danger" title="Delete"><i class="fa-solid fa-trash"></i></button>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td><input type="checkbox" class="table-check"></td>
                    <td>
                        <div class="table-title-cell">
                            <span class="table-title">Continental Peace & Security Update - Q1</span>
                            <span class="table-subtitle">/news/peace-security-q1</span>
                        </div>
                    </td>
                    <td><span class="category-badge maroon">Peace & Security</span></td>
                    <td>Fatima Osei</td>
                    <td><span class="status-badge scheduled">Scheduled</span></td>
                    <td>Feb 15, 2026</td>
                    <td>--</td>
                    <td>
                        <div class="table-actions">
                            <button class="action-icon-btn" title="Edit"><i class="fa-solid fa-pen"></i></button>
                            <button class="action-icon-btn" title="View"><i class="fa-solid fa-eye"></i></button>
                            <button class="action-icon-btn danger" title="Delete"><i class="fa-solid fa-trash"></i></button>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td><input type="checkbox" class="table-check"></td>
                    <td>
                        <div class="table-title-cell">
                            <span class="table-title">Youth Employment Initiative Launches Across ECOWAS</span>
                            <span class="table-subtitle">/news/youth-employment-ecowas</span>
                        </div>
                    </td>
                    <td><span class="category-badge blue">Trade & Economy</span></td>
                    <td>Daniel Kimathi</td>
                    <td><span class="status-badge published">Published</span></td>
                    <td>Jan 30, 2026</td>
                    <td>978</td>
                    <td>
                        <div class="table-actions">
                            <button class="action-icon-btn" title="Edit"><i class="fa-solid fa-pen"></i></button>
                            <button class="action-icon-btn" title="View"><i class="fa-solid fa-eye"></i></button>
                            <button class="action-icon-btn danger" title="Delete"><i class="fa-solid fa-trash"></i></button>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>

        <!-- Pagination -->
        <div class="table-pagination">
            <span class="pagination-info">Showing 1-5 of 24 articles</span>
            <div class="pagination-controls">
                <button class="pagination-btn" disabled><i class="fa-solid fa-chevron-left"></i></button>
                <button class="pagination-btn active">1</button>
                <button class="pagination-btn">2</button>
                <button class="pagination-btn">3</button>
                <button class="pagination-btn">5</button>
                <button class="pagination-btn"><i class="fa-solid fa-chevron-right"></i></button>
            </div>
        </div>
    </div>

@endsection
