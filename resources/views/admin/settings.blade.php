@extends('layouts.admin')

@section('title', 'Settings')
@section('page-title', 'Settings')

@section('content')

    <!-- Page Header -->
    <div class="page-header-banner">
        <div class="page-header-text">
            <h1><i class="fa-solid fa-cog"></i> Settings</h1>
            <p>Configure platform settings, preferences, and system options.</p>
        </div>
    </div>

    <!-- Settings Layout -->
    <div class="settings-layout">

        <!-- Settings Navigation -->
        <div class="settings-nav">
            <button class="settings-nav-item active" data-section="general">
                <i class="fa-solid fa-sliders"></i> General
            </button>
            <button class="settings-nav-item" data-section="appearance">
                <i class="fa-solid fa-palette"></i> Appearance
            </button>
            <button class="settings-nav-item" data-section="email">
                <i class="fa-solid fa-envelope"></i> Email
            </button>
            <button class="settings-nav-item" data-section="security">
                <i class="fa-solid fa-shield-halved"></i> Security
            </button>
            <button class="settings-nav-item" data-section="backup">
                <i class="fa-solid fa-database"></i> Backup & Data
            </button>
        </div>

        <!-- Settings Content -->
        <div class="settings-content">

            <!-- General Settings -->
            <div class="settings-section active" id="section-general">
                <div class="settings-card">
                    <div class="settings-card-header">
                        <h3>General Settings</h3>
                        <p>Configure basic platform information and defaults.</p>
                    </div>
                    <div class="settings-card-body">
                        <div class="settings-field">
                            <label>Platform Name</label>
                            <input type="text" class="settings-input" value="Agenda 2063 Knowledge Platform">
                        </div>
                        <div class="settings-field">
                            <label>Platform Description</label>
                            <textarea class="settings-textarea" rows="3">The official knowledge and monitoring platform for the African Union's Agenda 2063 - The Africa We Want.</textarea>
                        </div>
                        <div class="settings-field">
                            <label>Contact Email</label>
                            <input type="email" class="settings-input" value="info@agenda2063.africa">
                        </div>
                        <div class="settings-row">
                            <div class="settings-field">
                                <label>Default Language</label>
                                <select class="settings-select">
                                    <option selected>English</option>
                                    <option>French</option>
                                    <option>Arabic</option>
                                    <option>Portuguese</option>
                                </select>
                            </div>
                            <div class="settings-field">
                                <label>Timezone</label>
                                <select class="settings-select">
                                    <option selected>Africa/Addis_Ababa (UTC+3)</option>
                                    <option>Africa/Lagos (UTC+1)</option>
                                    <option>Africa/Nairobi (UTC+3)</option>
                                    <option>Africa/Johannesburg (UTC+2)</option>
                                </select>
                            </div>
                        </div>
                        <div class="settings-field">
                            <label>Items Per Page</label>
                            <select class="settings-select" style="max-width: 200px;">
                                <option>10</option>
                                <option selected>25</option>
                                <option>50</option>
                                <option>100</option>
                            </select>
                        </div>
                    </div>
                    <div class="settings-card-footer">
                        <button class="btn-primary-admin"><i class="fa-solid fa-save"></i> Save Changes</button>
                    </div>
                </div>
            </div>

            <!-- Appearance Settings -->
            <div class="settings-section" id="section-appearance">
                <div class="settings-card">
                    <div class="settings-card-header">
                        <h3>Appearance</h3>
                        <p>Customize the look and feel of the admin panel and public site.</p>
                    </div>
                    <div class="settings-card-body">
                        <div class="settings-field">
                            <label>Admin Theme</label>
                            <div class="theme-options">
                                <label class="theme-option active">
                                    <input type="radio" name="theme" value="light" checked>
                                    <div class="theme-preview light">
                                        <div class="tp-sidebar"></div>
                                        <div class="tp-content"></div>
                                    </div>
                                    <span>Light</span>
                                </label>
                                <label class="theme-option">
                                    <input type="radio" name="theme" value="dark">
                                    <div class="theme-preview dark">
                                        <div class="tp-sidebar"></div>
                                        <div class="tp-content"></div>
                                    </div>
                                    <span>Dark</span>
                                </label>
                            </div>
                        </div>
                        <div class="settings-field">
                            <label>Primary Color</label>
                            <div class="color-options">
                                <label class="color-option active" style="--c: #822b39;"><input type="radio" name="color" checked></label>
                                <label class="color-option" style="--c: #3498db;"><input type="radio" name="color"></label>
                                <label class="color-option" style="--c: #2ecc71;"><input type="radio" name="color"></label>
                                <label class="color-option" style="--c: #9b59b6;"><input type="radio" name="color"></label>
                                <label class="color-option" style="--c: #e67e22;"><input type="radio" name="color"></label>
                            </div>
                        </div>
                        <div class="settings-toggle-row">
                            <div>
                                <label>Sidebar Compact Mode</label>
                                <p class="settings-hint">Show only icons in the sidebar navigation.</p>
                            </div>
                            <label class="toggle-switch">
                                <input type="checkbox">
                                <span class="toggle-slider"></span>
                            </label>
                        </div>
                        <div class="settings-toggle-row">
                            <div>
                                <label>Animations</label>
                                <p class="settings-hint">Enable smooth transitions and hover effects.</p>
                            </div>
                            <label class="toggle-switch">
                                <input type="checkbox" checked>
                                <span class="toggle-slider"></span>
                            </label>
                        </div>
                    </div>
                    <div class="settings-card-footer">
                        <button class="btn-primary-admin"><i class="fa-solid fa-save"></i> Save Changes</button>
                    </div>
                </div>
            </div>

            <!-- Email Settings -->
            <div class="settings-section" id="section-email">
                <div class="settings-card">
                    <div class="settings-card-header">
                        <h3>Email Configuration</h3>
                        <p>Configure SMTP and email notification settings.</p>
                    </div>
                    <div class="settings-card-body">
                        <div class="settings-row">
                            <div class="settings-field">
                                <label>SMTP Host</label>
                                <input type="text" class="settings-input" value="smtp.agenda2063.africa">
                            </div>
                            <div class="settings-field">
                                <label>SMTP Port</label>
                                <input type="text" class="settings-input" value="587">
                            </div>
                        </div>
                        <div class="settings-row">
                            <div class="settings-field">
                                <label>SMTP Username</label>
                                <input type="text" class="settings-input" value="noreply@agenda2063.africa">
                            </div>
                            <div class="settings-field">
                                <label>SMTP Password</label>
                                <input type="password" class="settings-input" value="••••••••">
                            </div>
                        </div>
                        <div class="settings-field">
                            <label>Encryption</label>
                            <select class="settings-select" style="max-width: 200px;">
                                <option>TLS</option>
                                <option>SSL</option>
                                <option>None</option>
                            </select>
                        </div>
                        <div class="settings-toggle-row">
                            <div>
                                <label>Email Notifications</label>
                                <p class="settings-hint">Send email alerts for new articles, user sign-ups, and reports.</p>
                            </div>
                            <label class="toggle-switch">
                                <input type="checkbox" checked>
                                <span class="toggle-slider"></span>
                            </label>
                        </div>
                    </div>
                    <div class="settings-card-footer">
                        <button class="btn-outline-admin"><i class="fa-solid fa-paper-plane"></i> Send Test Email</button>
                        <button class="btn-primary-admin"><i class="fa-solid fa-save"></i> Save Changes</button>
                    </div>
                </div>
            </div>

            <!-- Security Settings -->
            <div class="settings-section" id="section-security">
                <div class="settings-card">
                    <div class="settings-card-header">
                        <h3>Security</h3>
                        <p>Manage authentication and security policies.</p>
                    </div>
                    <div class="settings-card-body">
                        <div class="settings-toggle-row">
                            <div>
                                <label>Two-Factor Authentication</label>
                                <p class="settings-hint">Require 2FA for all admin users.</p>
                            </div>
                            <label class="toggle-switch">
                                <input type="checkbox">
                                <span class="toggle-slider"></span>
                            </label>
                        </div>
                        <div class="settings-toggle-row">
                            <div>
                                <label>Force Password Reset</label>
                                <p class="settings-hint">Require password change every 90 days.</p>
                            </div>
                            <label class="toggle-switch">
                                <input type="checkbox" checked>
                                <span class="toggle-slider"></span>
                            </label>
                        </div>
                        <div class="settings-field">
                            <label>Session Timeout (minutes)</label>
                            <input type="number" class="settings-input" value="60" style="max-width: 200px;">
                        </div>
                        <div class="settings-field">
                            <label>Max Login Attempts</label>
                            <input type="number" class="settings-input" value="5" style="max-width: 200px;">
                        </div>
                        <div class="settings-toggle-row">
                            <div>
                                <label>IP Whitelisting</label>
                                <p class="settings-hint">Restrict admin access to specific IP addresses.</p>
                            </div>
                            <label class="toggle-switch">
                                <input type="checkbox">
                                <span class="toggle-slider"></span>
                            </label>
                        </div>
                    </div>
                    <div class="settings-card-footer">
                        <button class="btn-primary-admin"><i class="fa-solid fa-save"></i> Save Changes</button>
                    </div>
                </div>
            </div>

            <!-- Backup Settings -->
            <div class="settings-section" id="section-backup">
                <div class="settings-card">
                    <div class="settings-card-header">
                        <h3>Backup & Data</h3>
                        <p>Database backup and data export settings.</p>
                    </div>
                    <div class="settings-card-body">
                        <div class="settings-toggle-row">
                            <div>
                                <label>Automatic Backups</label>
                                <p class="settings-hint">Schedule daily automatic database backups.</p>
                            </div>
                            <label class="toggle-switch">
                                <input type="checkbox" checked>
                                <span class="toggle-slider"></span>
                            </label>
                        </div>
                        <div class="settings-field">
                            <label>Backup Frequency</label>
                            <select class="settings-select" style="max-width: 250px;">
                                <option selected>Daily at 2:00 AM</option>
                                <option>Every 12 hours</option>
                                <option>Weekly (Sunday)</option>
                                <option>Monthly (1st)</option>
                            </select>
                        </div>
                        <div class="settings-field">
                            <label>Retention Period</label>
                            <select class="settings-select" style="max-width: 250px;">
                                <option>7 days</option>
                                <option selected>30 days</option>
                                <option>90 days</option>
                                <option>1 year</option>
                            </select>
                        </div>

                        <div class="backup-actions">
                            <h4>Manual Actions</h4>
                            <div class="backup-btns">
                                <button class="btn-outline-admin"><i class="fa-solid fa-database"></i> Backup Now</button>
                                <button class="btn-outline-admin"><i class="fa-solid fa-file-export"></i> Export Data (CSV)</button>
                                <button class="btn-outline-admin"><i class="fa-solid fa-file-code"></i> Export Data (JSON)</button>
                            </div>
                        </div>

                        <div class="backup-history">
                            <h4>Recent Backups</h4>
                            <div class="backup-list">
                                <div class="backup-item">
                                    <i class="fa-solid fa-check-circle" style="color: #2ecc71;"></i>
                                    <div>
                                        <span>backup_2026-02-09_0200.sql</span>
                                        <span class="backup-meta">245 MB - Auto backup</span>
                                    </div>
                                    <button class="action-icon-btn" title="Download"><i class="fa-solid fa-download"></i></button>
                                </div>
                                <div class="backup-item">
                                    <i class="fa-solid fa-check-circle" style="color: #2ecc71;"></i>
                                    <div>
                                        <span>backup_2026-02-08_0200.sql</span>
                                        <span class="backup-meta">244 MB - Auto backup</span>
                                    </div>
                                    <button class="action-icon-btn" title="Download"><i class="fa-solid fa-download"></i></button>
                                </div>
                                <div class="backup-item">
                                    <i class="fa-solid fa-check-circle" style="color: #2ecc71;"></i>
                                    <div>
                                        <span>backup_2026-02-07_0200.sql</span>
                                        <span class="backup-meta">243 MB - Auto backup</span>
                                    </div>
                                    <button class="action-icon-btn" title="Download"><i class="fa-solid fa-download"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Settings tab navigation
    document.querySelectorAll('.settings-nav-item').forEach(btn => {
        btn.addEventListener('click', function() {
            document.querySelectorAll('.settings-nav-item').forEach(b => b.classList.remove('active'));
            document.querySelectorAll('.settings-section').forEach(s => s.classList.remove('active'));
            this.classList.add('active');
            document.getElementById('section-' + this.dataset.section).classList.add('active');
        });
    });
});
</script>
@endpush
