@extends('layouts.admin')

@section('title', 'Users')
@section('page-title', 'Users')

@section('content')

    <!-- Page Header -->
    <div class="page-header-banner">
        <div class="page-header-text">
            <h1><i class="fa-solid fa-users"></i> User Management</h1>
            <p>Manage admin users, roles, and access permissions.</p>
        </div>
        <div class="page-header-actions">
            <button class="btn-outline-admin"><i class="fa-solid fa-file-export"></i> Export</button>
            <button class="btn-primary-admin"><i class="fa-solid fa-user-plus"></i> Add User</button>
        </div>
    </div>

    <!-- Stats -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon blue"><i class="fa-solid fa-users"></i></div>
            <div class="stat-details">
                <span class="stat-number">18</span>
                <span class="stat-label">Total Users</span>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon green"><i class="fa-solid fa-user-check"></i></div>
            <div class="stat-details">
                <span class="stat-number">14</span>
                <span class="stat-label">Active Users</span>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon gold"><i class="fa-solid fa-user-shield"></i></div>
            <div class="stat-details">
                <span class="stat-number">3</span>
                <span class="stat-label">Super Admins</span>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon maroon"><i class="fa-solid fa-user-clock"></i></div>
            <div class="stat-details">
                <span class="stat-number">4</span>
                <span class="stat-label">Inactive Users</span>
            </div>
        </div>
    </div>

    <!-- Toolbar -->
    <div class="admin-toolbar">
        <div class="toolbar-search">
            <i class="fa-solid fa-search"></i>
            <input type="text" placeholder="Search users by name or email...">
        </div>
        <div class="toolbar-filters">
            <select class="filter-select">
                <option>All Roles</option>
                <option>Super Admin</option>
                <option>Admin</option>
                <option>Editor</option>
                <option>Viewer</option>
            </select>
            <select class="filter-select">
                <option>All Status</option>
                <option>Active</option>
                <option>Inactive</option>
                <option>Suspended</option>
            </select>
        </div>
    </div>

    <!-- Users Table -->
    <div class="admin-table-card">
        <table class="admin-table">
            <thead>
                <tr>
                    <th><input type="checkbox" class="table-check-all"></th>
                    <th>User</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th>Last Login</th>
                    <th>Created</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><input type="checkbox" class="table-check"></td>
                    <td>
                        <div class="user-cell">
                            <div class="user-cell-avatar" style="background: linear-gradient(135deg, #822b39, #991b35);">
                                <span>AM</span>
                            </div>
                            <div>
                                <span class="table-title">Admin Master</span>
                                <span class="table-subtitle">admin@agenda2063.africa</span>
                            </div>
                        </div>
                    </td>
                    <td><span class="role-badge super-admin">Super Admin</span></td>
                    <td><span class="status-badge published">Active</span></td>
                    <td>Today, 09:15 AM</td>
                    <td>Jan 01, 2024</td>
                    <td>
                        <div class="table-actions">
                            <button class="action-icon-btn" title="Edit"><i class="fa-solid fa-pen"></i></button>
                            <button class="action-icon-btn" title="Permissions"><i class="fa-solid fa-shield"></i></button>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td><input type="checkbox" class="table-check"></td>
                    <td>
                        <div class="user-cell">
                            <div class="user-cell-avatar" style="background: linear-gradient(135deg, #3498db, #2980b9);">
                                <span>JM</span>
                            </div>
                            <div>
                                <span class="table-title">John Mensah</span>
                                <span class="table-subtitle">j.mensah@agenda2063.africa</span>
                            </div>
                        </div>
                    </td>
                    <td><span class="role-badge admin">Admin</span></td>
                    <td><span class="status-badge published">Active</span></td>
                    <td>Today, 11:30 AM</td>
                    <td>Mar 15, 2024</td>
                    <td>
                        <div class="table-actions">
                            <button class="action-icon-btn" title="Edit"><i class="fa-solid fa-pen"></i></button>
                            <button class="action-icon-btn" title="Permissions"><i class="fa-solid fa-shield"></i></button>
                            <button class="action-icon-btn danger" title="Deactivate"><i class="fa-solid fa-ban"></i></button>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td><input type="checkbox" class="table-check"></td>
                    <td>
                        <div class="user-cell">
                            <div class="user-cell-avatar" style="background: linear-gradient(135deg, #2ecc71, #27ae60);">
                                <span>AD</span>
                            </div>
                            <div>
                                <span class="table-title">Amina Diallo</span>
                                <span class="table-subtitle">a.diallo@agenda2063.africa</span>
                            </div>
                        </div>
                    </td>
                    <td><span class="role-badge editor">Editor</span></td>
                    <td><span class="status-badge published">Active</span></td>
                    <td>Yesterday, 04:22 PM</td>
                    <td>Jun 20, 2024</td>
                    <td>
                        <div class="table-actions">
                            <button class="action-icon-btn" title="Edit"><i class="fa-solid fa-pen"></i></button>
                            <button class="action-icon-btn" title="Permissions"><i class="fa-solid fa-shield"></i></button>
                            <button class="action-icon-btn danger" title="Deactivate"><i class="fa-solid fa-ban"></i></button>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td><input type="checkbox" class="table-check"></td>
                    <td>
                        <div class="user-cell">
                            <div class="user-cell-avatar" style="background: linear-gradient(135deg, #f39c12, #e67e22);">
                                <span>KA</span>
                            </div>
                            <div>
                                <span class="table-title">Kwame Asante</span>
                                <span class="table-subtitle">k.asante@agenda2063.africa</span>
                            </div>
                        </div>
                    </td>
                    <td><span class="role-badge editor">Editor</span></td>
                    <td><span class="status-badge draft">Inactive</span></td>
                    <td>Jan 05, 2026</td>
                    <td>Sep 10, 2024</td>
                    <td>
                        <div class="table-actions">
                            <button class="action-icon-btn" title="Edit"><i class="fa-solid fa-pen"></i></button>
                            <button class="action-icon-btn" title="Activate"><i class="fa-solid fa-check"></i></button>
                            <button class="action-icon-btn danger" title="Delete"><i class="fa-solid fa-trash"></i></button>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td><input type="checkbox" class="table-check"></td>
                    <td>
                        <div class="user-cell">
                            <div class="user-cell-avatar" style="background: linear-gradient(135deg, #9b59b6, #8e44ad);">
                                <span>FO</span>
                            </div>
                            <div>
                                <span class="table-title">Fatima Osei</span>
                                <span class="table-subtitle">f.osei@agenda2063.africa</span>
                            </div>
                        </div>
                    </td>
                    <td><span class="role-badge viewer">Viewer</span></td>
                    <td><span class="status-badge published">Active</span></td>
                    <td>Feb 06, 2026</td>
                    <td>Nov 01, 2024</td>
                    <td>
                        <div class="table-actions">
                            <button class="action-icon-btn" title="Edit"><i class="fa-solid fa-pen"></i></button>
                            <button class="action-icon-btn" title="Permissions"><i class="fa-solid fa-shield"></i></button>
                            <button class="action-icon-btn danger" title="Deactivate"><i class="fa-solid fa-ban"></i></button>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>

        <div class="table-pagination">
            <span class="pagination-info">Showing 1-5 of 18 users</span>
            <div class="pagination-controls">
                <button class="pagination-btn" disabled><i class="fa-solid fa-chevron-left"></i></button>
                <button class="pagination-btn active">1</button>
                <button class="pagination-btn">2</button>
                <button class="pagination-btn">3</button>
                <button class="pagination-btn">4</button>
                <button class="pagination-btn"><i class="fa-solid fa-chevron-right"></i></button>
            </div>
        </div>
    </div>

@endsection
