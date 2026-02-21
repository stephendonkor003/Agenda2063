@extends('layouts.admin')

@section('title', 'Settings')
@section('page-title', 'Settings')

@section('content')

    <div class="page-header-banner">
        <div class="page-header-text">
            <h1><i class="fa-solid fa-cog"></i> Settings</h1>
            <p>Configure platform settings, preferences, and system options.</p>
        </div>
    </div>

    @if(session('status'))
        <div class="alert success">
            <div class="alert-icon"><i class="fa-solid fa-check-circle"></i></div>
            <div class="alert-body">{{ session('status') }}</div>
        </div>
    @endif

    @if ($errors->any())
        <div class="alert error">
            <div class="alert-icon"><i class="fa-solid fa-triangle-exclamation"></i></div>
            <div class="alert-body">Please fix the highlighted fields.</div>
        </div>
    @endif

    <form class="settings-layout" method="POST" action="{{ route('admin.settings.update') }}">
        @csrf
        @method('PUT')

        <div class="settings-nav">
        <button class="settings-nav-item active" type="button" data-section="general">
            <i class="fa-solid fa-sliders"></i> General
        </button>
        <button class="settings-nav-item" type="button" data-section="appearance">
            <i class="fa-solid fa-palette"></i> Appearance
            </button>
            <button class="settings-nav-item" type="button" data-section="email">
                <i class="fa-solid fa-envelope"></i> Email
            </button>
            <button class="settings-nav-item" type="button" data-section="security">
                <i class="fa-solid fa-shield-halved"></i> Security
            </button>
            <button class="settings-nav-item" type="button" data-section="backup">
                <i class="fa-solid fa-database"></i> Backup & Data
            </button>
        </div>

        <div class="settings-content">

            <div class="settings-section active" id="section-general">
                <div class="settings-card">
                    <div class="settings-card-header">
                        <h3>General Settings</h3>
                        <p>Configure basic platform information and defaults.</p>
                    </div>
                    <div class="settings-card-body">
                        <div class="settings-field">
                            <label>Platform Name</label>
                            <input type="text" name="platform_name" class="settings-input" value="{{ old('platform_name', $settings['platform_name']) }}" required>
                            @error('platform_name')<span class="field-error">{{ $message }}</span>@enderror
                        </div>
                        <div class="settings-field">
                            <label>Platform Description</label>
                            <textarea name="platform_description" class="settings-textarea" rows="3">{{ old('platform_description', $settings['platform_description']) }}</textarea>
                            @error('platform_description')<span class="field-error">{{ $message }}</span>@enderror
                        </div>
                        <div class="settings-field">
                            <label>Contact Email</label>
                            <input type="email" name="contact_email" class="settings-input" value="{{ old('contact_email', $settings['contact_email']) }}" required>
                            @error('contact_email')<span class="field-error">{{ $message }}</span>@enderror
                        </div>
                        <div class="settings-row">
                            <div class="settings-field">
                                <label>Default Language</label>
                                <select name="default_language" class="settings-select">
                                    @foreach(['English','French','Arabic','Portuguese'] as $lang)
                                        <option value="{{ $lang }}" @selected(old('default_language', $settings['default_language']) === $lang)>{{ $lang }}</option>
                                    @endforeach
                                </select>
                                @error('default_language')<span class="field-error">{{ $message }}</span>@enderror
                            </div>
                            <div class="settings-field">
                                <label>Timezone</label>
                                <select name="timezone" class="settings-select">
                                    <option value="Africa/Addis_Ababa" @selected(old('timezone', $settings['timezone']) === 'Africa/Addis_Ababa')>Africa/Addis_Ababa (UTC+3)</option>
                                    <option value="Africa/Lagos" @selected(old('timezone', $settings['timezone']) === 'Africa/Lagos')>Africa/Lagos (UTC+1)</option>
                                    <option value="Africa/Nairobi" @selected(old('timezone', $settings['timezone']) === 'Africa/Nairobi')>Africa/Nairobi (UTC+3)</option>
                                    <option value="Africa/Johannesburg" @selected(old('timezone', $settings['timezone']) === 'Africa/Johannesburg')>Africa/Johannesburg (UTC+2)</option>
                                </select>
                                @error('timezone')<span class="field-error">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="settings-field">
                            <label>Items Per Page</label>
                            <select name="items_per_page" class="settings-select" style="max-width: 200px;">
                                @foreach([10,25,50,100] as $perPage)
                                    <option value="{{ $perPage }}" @selected((int) old('items_per_page', $settings['items_per_page']) === $perPage)>{{ $perPage }}</option>
                                @endforeach
                            </select>
                            @error('items_per_page')<span class="field-error">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="settings-card-footer">
                        <button class="btn-primary-admin" type="submit"><i class="fa-solid fa-save"></i> Save Changes</button>
                    </div>
                </div>
            </div>

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
                    <label class="theme-option {{ old('admin_theme', $settings['admin_theme']) === 'light' ? 'active' : '' }}">
                        <input type="radio" name="admin_theme" value="light" {{ old('admin_theme', $settings['admin_theme']) === 'light' ? 'checked' : '' }}>
                        <div class="theme-preview light">
                                        <div class="tp-sidebar"></div>
                                        <div class="tp-content"></div>
                                    </div>
                                    <span>Light</span>
                                </label>
                                <label class="theme-option {{ old('admin_theme', $settings['admin_theme']) === 'dark' ? 'active' : '' }}">
                                    <input type="radio" name="admin_theme" value="dark" {{ old('admin_theme', $settings['admin_theme']) === 'dark' ? 'checked' : '' }}>
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
                    @foreach(['#822b39','#3498db','#2ecc71','#9b59b6','#e67e22'] as $color)
                        <label class="color-option {{ old('primary_color', $settings['primary_color']) === $color ? 'active' : '' }}" style="--c: {{ $color }};">
                            <input type="radio" name="primary_color" value="{{ $color }}" {{ old('primary_color', $settings['primary_color']) === $color ? 'checked' : '' }}>
                        </label>
                    @endforeach
                </div>
                <div class="settings-field" style="margin-top:10px;">
                    <label for="primary_color_custom">Custom Hex</label>
                    <input type="text" id="primary_color_custom" name="primary_color"
                           value="{{ old('primary_color', $settings['primary_color']) }}"
                           class="settings-input" placeholder="#822b39">
                </div>
            </div>
            <div class="settings-toggle-row">
                <input type="hidden" name="sidebar_compact" value="0">
                <div>
                    <label>Sidebar Compact Mode</label>
                                <p class="settings-hint">Show only icons in the sidebar navigation.</p>
                            </div>
                            <label class="toggle-switch">
                                <input type="checkbox" name="sidebar_compact" value="1" {{ old('sidebar_compact', $settings['sidebar_compact']) ? 'checked' : '' }}>
                                <span class="toggle-slider"></span>
                            </label>
                        </div>
            <div class="settings-toggle-row">
                <input type="hidden" name="animations" value="0">
                <div>
                    <label>Animations</label>
                    <p class="settings-hint">Enable smooth transitions and hover effects.</p>
                </div>
                <label class="toggle-switch">
                    <input type="checkbox" name="animations" value="1" {{ old('animations', $settings['animations']) ? 'checked' : '' }}>
                    <span class="toggle-slider"></span>
                </label>
            </div>
            <div class="settings-toggle-row">
                <div>
                    <label>Preview</label>
                    <p class="settings-hint">See how your theme and primary color look.</p>
                </div>
                <div class="theme-preview-card">
                    <div class="preview-sidebar"></div>
                    <div class="preview-content">
                        <div class="preview-bar" style="background: var(--admin-primary);"></div>
                        <div class="preview-lines">
                            <span></span><span></span><span></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="settings-card-footer">
            <button class="btn-primary-admin" type="submit"><i class="fa-solid fa-save"></i> Save Changes</button>
        </div>
    </div>
            </div>

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
                                <input type="text" name="smtp_host" class="settings-input" value="{{ old('smtp_host', $settings['smtp_host']) }}">
                            </div>
                            <div class="settings-field">
                                <label>SMTP Port</label>
                                <input type="text" name="smtp_port" class="settings-input" value="{{ old('smtp_port', $settings['smtp_port']) }}">
                            </div>
                        </div>
                        <div class="settings-row">
                            <div class="settings-field">
                                <label>SMTP Username</label>
                                <input type="text" name="smtp_username" class="settings-input" value="{{ old('smtp_username', $settings['smtp_username']) }}">
                            </div>
                            <div class="settings-field">
                                <label>SMTP Password</label>
                                <input type="password" name="smtp_password" class="settings-input" placeholder="{{ $settings['smtp_password'] ? '********' : '' }}">
                            </div>
                        </div>
                        <div class="settings-field">
                            <label>Encryption</label>
                            <select name="smtp_encryption" class="settings-select" style="max-width: 200px;">
                                @foreach(['TLS','SSL','None'] as $option)
                                    <option value="{{ $option }}" @selected(old('smtp_encryption', $settings['smtp_encryption']) === $option)>{{ $option }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="settings-toggle-row">
                            <input type="hidden" name="email_notifications" value="0">
                            <div>
                                <label>Email Notifications</label>
                                <p class="settings-hint">Send email alerts for new articles, user sign-ups, and reports.</p>
                            </div>
                            <label class="toggle-switch">
                                <input type="checkbox" name="email_notifications" value="1" {{ old('email_notifications', $settings['email_notifications']) ? 'checked' : '' }}>
                                <span class="toggle-slider"></span>
                            </label>
                        </div>
                    </div>
                    <div class="settings-card-footer">
                        <button class="btn-primary-admin" type="submit"><i class="fa-solid fa-save"></i> Save Changes</button>
                    </div>
                </div>
            </div>

            <div class="settings-section" id="section-security">
                <div class="settings-card">
                    <div class="settings-card-header">
                        <h3>Security</h3>
                        <p>Manage authentication and security policies.</p>
                    </div>
                    <div class="settings-card-body">
                        <div class="settings-toggle-row">
                            <input type="hidden" name="two_factor" value="0">
                            <div>
                                <label>Two-Factor Authentication</label>
                                <p class="settings-hint">Require 2FA for all admin users.</p>
                            </div>
                            <label class="toggle-switch">
                                <input type="checkbox" name="two_factor" value="1" {{ old('two_factor', $settings['two_factor']) ? 'checked' : '' }}>
                                <span class="toggle-slider"></span>
                            </label>
                        </div>
                        <div class="settings-toggle-row">
                            <input type="hidden" name="force_password_reset" value="0">
                            <div>
                                <label>Force Password Reset</label>
                                <p class="settings-hint">Require password change every 90 days.</p>
                            </div>
                            <label class="toggle-switch">
                                <input type="checkbox" name="force_password_reset" value="1" {{ old('force_password_reset', $settings['force_password_reset']) ? 'checked' : '' }}>
                                <span class="toggle-slider"></span>
                            </label>
                        </div>
                        <div class="settings-field">
                            <label>Session Timeout (minutes)</label>
                            <input type="number" name="session_timeout" class="settings-input" value="{{ old('session_timeout', $settings['session_timeout']) }}" style="max-width: 200px;">
                            @error('session_timeout')<span class="field-error">{{ $message }}</span>@enderror
                        </div>
                        <div class="settings-field">
                            <label>Max Login Attempts</label>
                            <input type="number" name="max_login_attempts" class="settings-input" value="{{ old('max_login_attempts', $settings['max_login_attempts']) }}" style="max-width: 200px;">
                            @error('max_login_attempts')<span class="field-error">{{ $message }}</span>@enderror
                        </div>
                        <div class="settings-field">
                            <label>Lockout Duration (minutes)</label>
                            <input type="number" name="lockout_minutes" class="settings-input" value="{{ old('lockout_minutes', $settings['lockout_minutes']) }}" style="max-width: 200px;">
                            @error('lockout_minutes')<span class="field-error">{{ $message }}</span>@enderror
                        </div>
                        <div class="settings-toggle-row">
                            <input type="hidden" name="ip_whitelist_enabled" value="0">
                            <div>
                                <label>IP Whitelisting</label>
                                <p class="settings-hint">Restrict admin access to specific IP addresses.</p>
                            </div>
                            <label class="toggle-switch">
                                <input type="checkbox" name="ip_whitelist_enabled" value="1" {{ old('ip_whitelist_enabled', $settings['ip_whitelist_enabled']) ? 'checked' : '' }}>
                                <span class="toggle-slider"></span>
                            </label>
                        </div>
                    </div>
                    <div class="settings-card-footer">
                        <button class="btn-primary-admin" type="submit"><i class="fa-solid fa-save"></i> Save Changes</button>
                    </div>
                </div>
            </div>

            <div class="settings-section" id="section-backup">
                <div class="settings-card">
                    <div class="settings-card-header">
                        <h3>Backup & Data</h3>
                        <p>Database backup and data export settings.</p>
                    </div>
                    <div class="settings-card-body">
                        <div class="settings-toggle-row">
                            <input type="hidden" name="auto_backups" value="0">
                            <div>
                                <label>Automatic Backups</label>
                                <p class="settings-hint">Schedule daily automatic database backups.</p>
                            </div>
                            <label class="toggle-switch">
                                <input type="checkbox" name="auto_backups" value="1" {{ old('auto_backups', $settings['auto_backups']) ? 'checked' : '' }}>
                                <span class="toggle-slider"></span>
                            </label>
                        </div>
                        <div class="settings-field">
                            <label>Backup Frequency</label>
                            <select name="backup_frequency" class="settings-select" style="max-width: 250px;">
                                <option value="">-- Select --</option>
                                <option value="12h" @selected(old('backup_frequency', $settings['backup_frequency']) === '12h')>Every 12 hours</option>
                                <option value="daily" @selected(old('backup_frequency', $settings['backup_frequency']) === 'daily')>Daily at 2:00 AM</option>
                                <option value="weekly" @selected(old('backup_frequency', $settings['backup_frequency']) === 'weekly')>Weekly (Sunday)</option>
                                <option value="monthly" @selected(old('backup_frequency', $settings['backup_frequency']) === 'monthly')>Monthly (1st)</option>
                            </select>
                        </div>
                        <div class="settings-field">
                            <label>Retention Period</label>
                            <select name="retention_period" class="settings-select" style="max-width: 250px;">
                                <option value="">-- Select --</option>
                                <option value="7d" @selected(old('retention_period', $settings['retention_period']) === '7d')>7 days</option>
                                <option value="30d" @selected(old('retention_period', $settings['retention_period']) === '30d')>30 days</option>
                                <option value="90d" @selected(old('retention_period', $settings['retention_period']) === '90d')>90 days</option>
                                <option value="180d" @selected(old('retention_period', $settings['retention_period']) === '180d')>180 days</option>
                                <option value="365d" @selected(old('retention_period', $settings['retention_period']) === '365d')>1 year</option>
                            </select>
                        </div>
                        <div class="settings-field">
                            <label>Backup Location</label>
                            <select name="backup_location" class="settings-select" style="max-width: 250px;">
                                <option value="">-- Select --</option>
                                @foreach(['local','s3','gcs','sftp'] as $loc)
                                    <option value="{{ $loc }}" @selected(old('backup_location', $settings['backup_location']) === $loc)>{{ strtoupper($loc) }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="backup-actions">
                            <h4>Manual Actions</h4>
                            <div class="backup-btns">
                                <button class="btn-outline-admin" type="button" disabled title="Not implemented yet"><i class="fa-solid fa-database"></i> Backup Now</button>
                                <button class="btn-outline-admin" type="button" disabled title="Not implemented yet"><i class="fa-solid fa-file-export"></i> Export Data (CSV)</button>
                                <button class="btn-outline-admin" type="button" disabled title="Not implemented yet"><i class="fa-solid fa-file-code"></i> Export Data (JSON)</button>
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
                                    <button class="action-icon-btn" type="button" title="Download" disabled><i class="fa-solid fa-download"></i></button>
                                </div>
                                <div class="backup-item">
                                    <i class="fa-solid fa-check-circle" style="color: #2ecc71;"></i>
                                    <div>
                                        <span>backup_2026-02-08_0200.sql</span>
                                        <span class="backup-meta">244 MB - Auto backup</span>
                                    </div>
                                    <button class="action-icon-btn" type="button" title="Download" disabled><i class="fa-solid fa-download"></i></button>
                                </div>
                                <div class="backup-item">
                                    <i class="fa-solid fa-check-circle" style="color: #2ecc71;"></i>
                                    <div>
                                        <span>backup_2026-02-07_0200.sql</span>
                                        <span class="backup-meta">243 MB - Auto backup</span>
                                    </div>
                                    <button class="action-icon-btn" type="button" title="Download" disabled><i class="fa-solid fa-download"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </form>

@endsection

@push('styles')
<style>
.theme-preview-card {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 12px;
    border: 1px solid #e5e7eb;
    border-radius: 12px;
    background: var(--card-bg, #fff);
    box-shadow: 0 6px 16px rgba(0,0,0,0.05);
}
.theme-preview-card .preview-sidebar {
    width: 42px;
    height: 48px;
    border-radius: 10px;
    background: linear-gradient(180deg, #111827, #374151);
}
.theme-preview-card .preview-content {
    flex: 1;
}
.theme-preview-card .preview-bar {
    height: 8px;
    border-radius: 999px;
    margin-bottom: 6px;
}
.theme-preview-card .preview-lines span {
    display: block;
    height: 6px;
    border-radius: 999px;
    background: #e5e7eb;
    margin-bottom: 4px;
}
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.settings-nav-item').forEach(btn => {
        btn.addEventListener('click', function() {
            document.querySelectorAll('.settings-nav-item').forEach(b => b.classList.remove('active'));
            document.querySelectorAll('.settings-section').forEach(s => s.classList.remove('active'));
            this.classList.add('active');
            document.getElementById('section-' + this.dataset.section).classList.add('active');
            localStorage.setItem('settings-active-tab', this.dataset.section);
        });
    });

    const savedTab = localStorage.getItem('settings-active-tab');
    if (savedTab) {
        const btn = document.querySelector(`.settings-nav-item[data-section="${savedTab}"]`);
        if (btn) btn.click();
    }

    // Sync swatches with custom hex
    const customInput = document.getElementById('primary_color_custom');
    const colorRadios = document.querySelectorAll('input[name="primary_color"]');
    colorRadios.forEach(r => {
        r.addEventListener('change', () => customInput.value = r.value);
    });
    customInput.addEventListener('input', () => {
        colorRadios.forEach(r => r.checked = false);
    });

    // Live theme/appearance preview
    const root = document.documentElement;
    const body = document.body;
    const themeRadios = document.querySelectorAll('input[name="admin_theme"]');
    themeRadios.forEach(r => {
        r.addEventListener('change', () => {
            root.setAttribute('data-theme', r.value);
            localStorage.setItem('admin-theme', r.value);
        });
    });

    const applyPrimary = (val) => {
        if (!val) return;
        root.style.setProperty('--admin-primary', val);
        const previewBar = document.querySelector('.theme-preview-card .preview-bar');
        if (previewBar) previewBar.style.background = val;
    };
    applyPrimary(customInput.value);
    customInput.addEventListener('input', () => applyPrimary(customInput.value));
    colorRadios.forEach(r => r.addEventListener('change', () => applyPrimary(r.value)));

    const compactToggle = document.querySelector('input[name="sidebar_compact"]');
    if (compactToggle) {
        const setCompact = (on) => body.classList.toggle('sidebar-compact', on);
        setCompact(compactToggle.checked);
        compactToggle.addEventListener('change', () => setCompact(compactToggle.checked));
    }

    const animToggle = document.querySelector('input[name="animations"]');
    if (animToggle) {
        const setAnim = (on) => body.classList.toggle('no-anim', !on);
        setAnim(animToggle.checked);
        animToggle.addEventListener('change', () => setAnim(animToggle.checked));
    }
});
</script>
@endpush
