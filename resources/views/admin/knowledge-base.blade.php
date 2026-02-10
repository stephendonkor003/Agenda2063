@extends('layouts.admin')

@section('title', 'Knowledge Base')
@section('page-title', 'Knowledge Base')

@section('content')

    <!-- Page Header -->
    <div class="page-header-banner">
        <div class="page-header-text">
            <h1><i class="fa-solid fa-book-open"></i> Knowledge Base</h1>
            <p>Manage documents, publications, and downloadable resources.</p>
        </div>
        <div class="page-header-actions">
            <button class="btn-outline-admin"><i class="fa-solid fa-folder-plus"></i> New Category</button>
            <button class="btn-primary-admin"><i class="fa-solid fa-upload"></i> Upload Document</button>
        </div>
    </div>

    <!-- Stats Row -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon blue"><i class="fa-solid fa-file-alt"></i></div>
            <div class="stat-details">
                <span class="stat-number">46</span>
                <span class="stat-label">Total Documents</span>
            </div>
            <div class="stat-trend up"><i class="fa-solid fa-arrow-up"></i> 6</div>
        </div>
        <div class="stat-card">
            <div class="stat-icon green"><i class="fa-solid fa-folder"></i></div>
            <div class="stat-details">
                <span class="stat-number">11</span>
                <span class="stat-label">Categories</span>
            </div>
            <div class="stat-trend up"><i class="fa-solid fa-arrow-up"></i> 2</div>
        </div>
        <div class="stat-card">
            <div class="stat-icon gold"><i class="fa-solid fa-download"></i></div>
            <div class="stat-details">
                <span class="stat-number">8,432</span>
                <span class="stat-label">Total Downloads</span>
            </div>
            <div class="stat-trend up"><i class="fa-solid fa-arrow-up"></i> 18%</div>
        </div>
        <div class="stat-card">
            <div class="stat-icon maroon"><i class="fa-solid fa-hard-drive"></i></div>
            <div class="stat-details">
                <span class="stat-number">2.4 GB</span>
                <span class="stat-label">Storage Used</span>
            </div>
            <div class="stat-trend down"><i class="fa-solid fa-arrow-down"></i> 12%</div>
        </div>
    </div>

    <!-- Search & Filter -->
    <div class="admin-toolbar">
        <div class="toolbar-search">
            <i class="fa-solid fa-search"></i>
            <input type="text" placeholder="Search documents...">
        </div>
        <div class="toolbar-filters">
            <select class="filter-select">
                <option>All Categories</option>
                <option>Strategic Frameworks</option>
                <option>Implementation Plans</option>
                <option>Progress Reports</option>
                <option>Flagship Projects</option>
                <option>Governance & Policy</option>
                <option>Peace & Security</option>
                <option>Economic Development</option>
                <option>Social Development</option>
                <option>Science & Technology</option>
                <option>Environment & Climate</option>
                <option>Regional Integration</option>
            </select>
            <select class="filter-select">
                <option>All Types</option>
                <option>PDF</option>
                <option>Word Document</option>
                <option>Excel</option>
                <option>Presentation</option>
            </select>
        </div>
    </div>

    <!-- Documents Table -->
    <div class="admin-table-card">
        <table class="admin-table">
            <thead>
                <tr>
                    <th><input type="checkbox" class="table-check-all"></th>
                    <th>Document</th>
                    <th>Category</th>
                    <th>Type</th>
                    <th>Size</th>
                    <th>Downloads</th>
                    <th>Uploaded</th>
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
                                <span class="table-title">Agenda 2063 Framework Document</span>
                                <span class="table-subtitle">The Africa We Want - Full Text</span>
                            </div>
                        </div>
                    </td>
                    <td><span class="category-badge blue">Strategic Frameworks</span></td>
                    <td>PDF</td>
                    <td>4.2 MB</td>
                    <td>2,341</td>
                    <td>Jan 15, 2025</td>
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
                                <span class="table-title">First Ten-Year Implementation Plan</span>
                                <span class="table-subtitle">2014-2023 Implementation Roadmap</span>
                            </div>
                        </div>
                    </td>
                    <td><span class="category-badge green">Implementation Plans</span></td>
                    <td>Word</td>
                    <td>2.8 MB</td>
                    <td>1,456</td>
                    <td>Mar 20, 2024</td>
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
                                <span class="table-title">Second Continental Report on Agenda 2063</span>
                                <span class="table-subtitle">Biennial progress assessment</span>
                            </div>
                        </div>
                    </td>
                    <td><span class="category-badge gold">Progress Reports</span></td>
                    <td>PDF</td>
                    <td>6.1 MB</td>
                    <td>987</td>
                    <td>Jun 10, 2025</td>
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
                                <span class="table-title">AfCFTA Protocol on Trade in Goods</span>
                                <span class="table-subtitle">Legal and regulatory framework</span>
                            </div>
                        </div>
                    </td>
                    <td><span class="category-badge maroon">Economic Development</span></td>
                    <td>PDF</td>
                    <td>3.5 MB</td>
                    <td>1,102</td>
                    <td>Aug 22, 2025</td>
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
                                <span class="table-title">African Governance Architecture Framework</span>
                                <span class="table-subtitle">Governance standards and guidelines</span>
                            </div>
                        </div>
                    </td>
                    <td><span class="category-badge blue">Governance & Policy</span></td>
                    <td>Word</td>
                    <td>1.9 MB</td>
                    <td>654</td>
                    <td>Nov 05, 2025</td>
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
            <span class="pagination-info">Showing 1-5 of 46 documents</span>
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
