<!DOCTYPE html>
@php
    use App\Models\Setting;
    $user = Auth::user();
    $uiTheme = Setting::getValue('admin_theme', 'light');
    $primaryColor = Setting::getValue('primary_color', '#822b39');
    $sidebarCompact = Setting::getValue('sidebar_compact', false);
    $animations = Setting::getValue('animations', true);
@endphp
<html lang="en" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Dashboard') - Agenda 2063</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    @include('partials.alerts')
    @stack('styles')
    <style>
        :root {
            --admin-primary: {{ $primaryColor }};
        }
        .admin-body.sidebar-compact .admin-sidebar {
            width: 78px;
        }
        .admin-body.sidebar-compact .admin-sidebar .nav-link span,
        .admin-body.sidebar-compact .brand-text,
        .admin-body.sidebar-compact .nav-label {
            display: none;
        }
        .admin-body.no-anim * {
            transition: none !important;
            animation: none !important;
        }
        .btn-primary-admin {
            background: var(--admin-primary);
            border-color: var(--admin-primary);
        }
        .btn-primary-admin:hover {
            background: color-mix(in srgb, var(--admin-primary) 85%, #000 15%);
            border-color: color-mix(in srgb, var(--admin-primary) 85%, #000 15%);
        }
        .nav-link.active,
        .nav-link:hover {
            border-left: 3px solid var(--admin-primary);
        }
        .idle-modal {
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.45);
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 1200;
        }
        .idle-modal.show { display: flex; }
        .idle-card {
            background: #fff;
            padding: 20px 24px;
            border-radius: 12px;
            box-shadow: 0 12px 32px rgba(0,0,0,0.18);
            max-width: 380px;
            width: 90%;
            text-align: center;
        }
        .idle-card h3 { margin: 0 0 8px; }
        .idle-card p { margin: 0 0 12px; color: #475569; }
        .idle-count { font-size: 28px; font-weight: 700; color: #b91c1c; margin-bottom: 12px; }
        .profile-menu { box-shadow:0 10px 24px rgba(0,0,0,0.12); border:1px solid #e5e7eb; }
        .logout-form { width:100%; }
        .logout-link { border:none; background:none; padding:10px 12px; cursor:pointer; width:100%; text-align:left; color:#b91c1c; font-weight:600; display:flex; align-items:center; gap:8px; }
    </style>
</head>

<body class="admin-body {{ $sidebarCompact ? 'sidebar-compact' : '' }} {{ $animations ? '' : 'no-anim' }}"
      data-saved-theme="{{ $uiTheme }}"
      style="--admin-primary: {{ $primaryColor }};">

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
                <a href="{{ route('admin.quiz-responses') }}" class="nav-link {{ request()->routeIs('admin.quiz-responses') ? 'active' : '' }}">
                    <i class="fa-solid fa-clipboard-question"></i>
                    <span>Quiz Responses</span>
                </a>
                <a href="{{ route('admin.campaign-subscribers') }}" class="nav-link {{ request()->routeIs('admin.campaign-subscribers') ? 'active' : '' }}">
                    <i class="fa-solid fa-users-rectangle"></i>
                    <span>Campaign Subscribers</span>
                </a>
            </div>

            <div class="nav-section">
                <span class="nav-label">System</span>
                <a href="{{ route('admin.profile') }}" class="nav-link {{ request()->routeIs('admin.profile*') ? 'active' : '' }}">
                    <i class="fa-solid fa-user-lock"></i>
                    <span>Security & Profile</span>
                </a>
                <a href="{{ route('admin.users') }}" class="nav-link {{ request()->routeIs('admin.users') ? 'active' : '' }}">
                    <i class="fa-solid fa-users"></i>
                    <span>Users</span>
                </a>
                <a href="{{ route('admin.departments') }}" class="nav-link {{ request()->routeIs('admin.departments') ? 'active' : '' }}">
                    <i class="fa-solid fa-building"></i>
                    <span>Departments</span>
                </a>
                <a href="{{ route('admin.roles') }}" class="nav-link {{ request()->routeIs('admin.roles') ? 'active' : '' }}">
                    <i class="fa-solid fa-user-shield"></i>
                    <span>Roles</span>
                </a>
                <a href="{{ route('admin.permissions') }}" class="nav-link {{ request()->routeIs('admin.permissions') ? 'active' : '' }}">
                    <i class="fa-solid fa-key"></i>
                    <span>Permissions</span>
                </a>
                <a href="{{ route('admin.public.nav') }}" class="nav-link {{ request()->routeIs('admin.public.*') ? 'active' : '' }}">
                    <i class="fa-solid fa-eye"></i>
                    <span>Public Visibility</span>
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
                    <span class="user-name">{{ $user?->name ?? 'Admin' }}</span>
                    <span class="user-role">{{ ($user?->is_admin ?? false) ? 'Super Admin' : 'User' }}</span>
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
                        <span class="profile-name">{{ $user?->name ?? 'Admin' }}</span>
                        <i class="fa-solid fa-chevron-down"></i>
                    </button>
                    <div class="profile-menu">
                        <a href="{{ route('admin.profile') }}"><i class="fa-solid fa-user-circle"></i> My Profile</a>
                        <a href="{{ route('admin.settings') }}"><i class="fa-solid fa-cog"></i> Settings</a>
                        <div class="menu-divider"></div>
                        <form method="POST" action="{{ route('logout') }}" class="logout-form">
                            @csrf
                            <button type="submit" class="logout-link">
                                <i class="fa-solid fa-right-from-bracket"></i> Logout
                            </button>
                        </form>
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

    <!-- Idle timeout modal -->
    <div id="idleModal" class="idle-modal">
        <div class="idle-card">
            <h3>Session Timeout</h3>
            <p>You will be logged out soon due to inactivity.</p>
            <div class="idle-count" id="idleCountdown">120</div>
            <button class="btn-primary-admin" onclick="document.getElementById('idleLogoutForm').submit()">Logout now</button>
        </div>
    </div>
    <form id="idleLogoutForm" method="POST" action="{{ route('logout') }}" style="display:none;">
        @csrf
    </form>

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
        const savedTheme = localStorage.getItem('admin-theme') || html.dataset.savedTheme || 'light';
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

        // Idle timeout warning (3 min warning, 5 min logout)
        const warningAt = 180000; // 3 minutes
        const logoutAt = 300000; // 5 minutes
        let warningTimer, logoutTimer;
        const idleModal = document.getElementById('idleModal');
        const idleCountdown = document.getElementById('idleCountdown');
        const logoutForm = document.getElementById('idleLogoutForm');

        const resetTimers = () => {
            clearTimeout(warningTimer);
            clearTimeout(logoutTimer);
            idleModal?.classList.remove('show');
            startTimers();
        };

        const startTimers = () => {
            warningTimer = setTimeout(() => {
                let remaining = Math.floor((logoutAt - warningAt) / 1000);
                idleModal?.classList.add('show');
                idleCountdown.textContent = remaining;
                const interval = setInterval(() => {
                    remaining--;
                    idleCountdown.textContent = remaining;
                    if (remaining <= 0) {
                        clearInterval(interval);
                    }
                }, 1000);
            }, warningAt);

            logoutTimer = setTimeout(() => {
                if (logoutForm) logoutForm.submit();
            }, logoutAt);
        };

        ['click','mousemove','keydown','scroll','touchstart'].forEach(evt => {
            document.addEventListener(evt, resetTimers, { passive: true });
        });

        startTimers();
    });
    </script>
    @stack('scripts')
</body>
</html>
