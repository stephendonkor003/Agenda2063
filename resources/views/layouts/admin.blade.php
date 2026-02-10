<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Dashboard') - Agenda 2063</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    @stack('styles')
</head>
<body class="admin-body">

    <!-- Sidebar -->
    <aside class="admin-sidebar" id="adminSidebar">
        <div class="sidebar-brand">
            <div class="brand-icon">
                <i class="fa-solid fa-globe-africa"></i>
            </div>
            <div class="brand-text">
                <h3>Agenda 2063</h3>
                <span>Admin Panel</span>
            </div>
            <button class="sidebar-close" id="sidebarClose">
                <i class="fa-solid fa-times"></i>
            </button>
        </div>

        <nav class="sidebar-nav">
            <div class="nav-section">
                <span class="nav-label">Main</span>
                <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="fa-solid fa-gauge-high"></i>
                    <span>Dashboard</span>
                </a>
                <a href="{{ route('admin.analytics') }}" class="nav-link {{ request()->routeIs('admin.analytics') ? 'active' : '' }}">
                    <i class="fa-solid fa-chart-bar"></i>
                    <span>Analytics</span>
                </a>
            </div>

            <div class="nav-section">
                <span class="nav-label">Content</span>
                <a href="{{ route('admin.news') }}" class="nav-link {{ request()->routeIs('admin.news') ? 'active' : '' }}">
                    <i class="fa-solid fa-newspaper"></i>
                    <span>News & Events</span>
                    <span class="nav-badge">12</span>
                </a>
                <a href="{{ route('admin.knowledge-base') }}" class="nav-link {{ request()->routeIs('admin.knowledge-base') ? 'active' : '' }}">
                    <i class="fa-solid fa-book-open"></i>
                    <span>Knowledge Base</span>
                </a>
                <a href="{{ route('admin.flagship-projects') }}" class="nav-link {{ request()->routeIs('admin.flagship-projects') ? 'active' : '' }}">
                    <i class="fa-solid fa-rocket"></i>
                    <span>Flagship Projects</span>
                </a>
                <a href="{{ route('admin.publications') }}" class="nav-link {{ request()->routeIs('admin.publications') ? 'active' : '' }}">
                    <i class="fa-solid fa-file-alt"></i>
                    <span>Publications</span>
                </a>
            </div>

            <div class="nav-section">
                <span class="nav-label">Performance</span>
                <a href="{{ route('admin.regional-data') }}" class="nav-link {{ request()->routeIs('admin.regional-data') ? 'active' : '' }}">
                    <i class="fa-solid fa-map-marked-alt"></i>
                    <span>Regional Data</span>
                </a>
                <a href="{{ route('admin.goals-tracking') }}" class="nav-link {{ request()->routeIs('admin.goals-tracking') ? 'active' : '' }}">
                    <i class="fa-solid fa-bullseye"></i>
                    <span>Goals Tracking</span>
                </a>
                <a href="{{ route('admin.country-reports') }}" class="nav-link {{ request()->routeIs('admin.country-reports') ? 'active' : '' }}">
                    <i class="fa-solid fa-flag"></i>
                    <span>Country Reports</span>
                </a>
            </div>

            <div class="nav-section">
                <span class="nav-label">System</span>
                <a href="{{ route('admin.users') }}" class="nav-link {{ request()->routeIs('admin.users') ? 'active' : '' }}">
                    <i class="fa-solid fa-users"></i>
                    <span>Users</span>
                </a>
                <a href="{{ route('admin.settings') }}" class="nav-link {{ request()->routeIs('admin.settings') ? 'active' : '' }}">
                    <i class="fa-solid fa-cog"></i>
                    <span>Settings</span>
                </a>
            </div>
        </nav>

        <div class="sidebar-footer">
            <div class="sidebar-user">
                <div class="user-avatar">
                    <i class="fa-solid fa-user"></i>
                </div>
                <div class="user-info">
                    <span class="user-name">Admin User</span>
                    <span class="user-role">Super Admin</span>
                </div>
            </div>
        </div>
    </aside>

    <!-- Main Content Area -->
    <div class="admin-main" id="adminMain">

        <!-- Top Header -->
        <header class="admin-header" id="adminHeader">
            <div class="header-left">
                <button class="sidebar-toggle" id="sidebarToggle">
                    <i class="fa-solid fa-bars"></i>
                </button>
                <div class="header-breadcrumb">
                    <span>Admin</span>
                    <i class="fa-solid fa-chevron-right"></i>
                    <span class="current">@yield('page-title', 'Dashboard')</span>
                </div>
            </div>

            <div class="header-right">
                <!-- Theme Toggle -->
                <button class="theme-toggle" id="themeToggle" title="Toggle Dark/Light Mode">
                    <i class="fa-solid fa-moon" id="themeIcon"></i>
                </button>

                <!-- Notifications -->
                <button class="header-btn notification-btn" id="notifBtn">
                    <i class="fa-solid fa-bell"></i>
                    <span class="notif-dot"></span>
                </button>

                <!-- Profile Dropdown -->
                <div class="header-profile" id="profileDropdown">
                    <button class="profile-trigger">
                        <div class="profile-avatar">
                            <i class="fa-solid fa-user"></i>
                        </div>
                        <span class="profile-name">Admin</span>
                        <i class="fa-solid fa-chevron-down"></i>
                    </button>
                    <div class="profile-menu">
                        <a href="#"><i class="fa-solid fa-user-circle"></i> My Profile</a>
                        <a href="#"><i class="fa-solid fa-cog"></i> Settings</a>
                        <div class="menu-divider"></div>
                        <a href="{{ route('login') }}" class="logout-link"><i class="fa-solid fa-sign-out-alt"></i> Logout</a>
                    </div>
                </div>
            </div>
        </header>

        <!-- Page Content -->
        <main class="admin-content">
            @yield('content')
        </main>

        <!-- Footer -->
        <footer class="admin-footer">
            <div class="footer-left">
                <p>&copy; {{ date('Y') }} Agenda 2063 - African Union Commission. All rights reserved.</p>
            </div>
            <div class="footer-right">
                <span>Version 1.0</span>
            </div>
        </footer>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const sidebar = document.getElementById('adminSidebar');
        const mainContent = document.getElementById('adminMain');
        const sidebarToggle = document.getElementById('sidebarToggle');
        const sidebarClose = document.getElementById('sidebarClose');
        const themeToggle = document.getElementById('themeToggle');
        const themeIcon = document.getElementById('themeIcon');
        const html = document.documentElement;
        const profileDropdown = document.getElementById('profileDropdown');

        // Sidebar toggle
        sidebarToggle.addEventListener('click', function() {
            sidebar.classList.toggle('collapsed');
            mainContent.classList.toggle('expanded');
        });

        sidebarClose.addEventListener('click', function() {
            sidebar.classList.add('collapsed');
            mainContent.classList.add('expanded');
        });

        // Theme toggle
        const savedTheme = localStorage.getItem('admin-theme') || 'light';
        html.setAttribute('data-theme', savedTheme);
        updateThemeIcon(savedTheme);

        themeToggle.addEventListener('click', function() {
            const current = html.getAttribute('data-theme');
            const next = current === 'light' ? 'dark' : 'light';
            html.setAttribute('data-theme', next);
            localStorage.setItem('admin-theme', next);
            updateThemeIcon(next);
        });

        function updateThemeIcon(theme) {
            themeIcon.className = theme === 'dark' ? 'fa-solid fa-sun' : 'fa-solid fa-moon';
        }

        // Profile dropdown
        profileDropdown.querySelector('.profile-trigger').addEventListener('click', function(e) {
            e.stopPropagation();
            profileDropdown.classList.toggle('open');
        });

        document.addEventListener('click', function() {
            profileDropdown.classList.remove('open');
        });

        // Mobile sidebar overlay close
        document.addEventListener('click', function(e) {
            if (window.innerWidth <= 968 && !sidebar.contains(e.target) && !sidebarToggle.contains(e.target)) {
                sidebar.classList.add('collapsed');
            }
        });
    });
    </script>
    @stack('scripts')
</body>
</html>
