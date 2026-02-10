<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login - Agenda 2063 Admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>
<body>

    <div class="login-wrapper">
        <!-- Left Panel - Branding -->
        <div class="login-branding">
            <div class="branding-overlay"></div>
            <div class="branding-content">
                <div class="brand-logo">
                    <i class="fa-solid fa-globe-africa"></i>
                </div>
                <h1>Agenda 2063</h1>
                <div class="brand-divider"></div>
                <p>The Africa We Want</p>
                <div class="brand-features">
                    <div class="brand-feature">
                        <i class="fa-solid fa-chart-line"></i>
                        <span>Track continental progress</span>
                    </div>
                    <div class="brand-feature">
                        <i class="fa-solid fa-file-alt"></i>
                        <span>Manage reports & publications</span>
                    </div>
                    <div class="brand-feature">
                        <i class="fa-solid fa-users-cog"></i>
                        <span>Administer platform content</span>
                    </div>
                </div>
            </div>
            <div class="branding-footer">
                <p>African Union Commission</p>
            </div>
        </div>

        <!-- Right Panel - Login Form -->
        <div class="login-form-panel">
            <div class="login-form-container">
                <div class="login-header">
                    <div class="login-icon">
                        <i class="fa-solid fa-lock"></i>
                    </div>
                    <h2>Welcome Back</h2>
                    <p>Sign in to access the admin dashboard</p>
                </div>

                @if(session('error'))
                    <div class="login-alert error">
                        <i class="fa-solid fa-circle-exclamation"></i>
                        <span>{{ session('error') }}</span>
                    </div>
                @endif

                <form method="POST" action="{{ route('login.submit') }}" class="login-form" id="loginForm">
                    @csrf

                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <div class="input-wrapper">
                            <i class="fa-solid fa-envelope"></i>
                            <input type="email" id="email" name="email" placeholder="admin@agenda2063.africa" value="{{ old('email') }}" required autofocus>
                        </div>
                        @error('email')
                            <span class="field-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <div class="input-wrapper">
                            <i class="fa-solid fa-key"></i>
                            <input type="password" id="password" name="password" placeholder="Enter your password" required>
                            <button type="button" class="toggle-password" id="togglePassword">
                                <i class="fa-solid fa-eye"></i>
                            </button>
                        </div>
                        @error('password')
                            <span class="field-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-options">
                        <label class="remember-me">
                            <input type="checkbox" name="remember">
                            <span class="checkmark"></span>
                            <span>Remember me</span>
                        </label>
                        <a href="#" class="forgot-link">Forgot password?</a>
                    </div>

                    <button type="submit" class="login-btn" id="loginBtn">
                        <span class="btn-text">Sign In</span>
                        <span class="btn-loader" style="display: none;">
                            <i class="fa-solid fa-spinner fa-spin"></i>
                        </span>
                        <i class="fa-solid fa-arrow-right btn-arrow"></i>
                    </button>
                </form>

                <div class="login-footer">
                    <a href="{{ route('home') }}"><i class="fa-solid fa-arrow-left"></i> Back to Website</a>
                </div>
            </div>
        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Toggle password visibility
        const toggleBtn = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('password');
        toggleBtn.addEventListener('click', function() {
            const type = passwordInput.type === 'password' ? 'text' : 'password';
            passwordInput.type = type;
            this.querySelector('i').classList.toggle('fa-eye');
            this.querySelector('i').classList.toggle('fa-eye-slash');
        });

        // Loading state on submit
        const form = document.getElementById('loginForm');
        const btn = document.getElementById('loginBtn');
        form.addEventListener('submit', function() {
            btn.querySelector('.btn-text').style.display = 'none';
            btn.querySelector('.btn-arrow').style.display = 'none';
            btn.querySelector('.btn-loader').style.display = 'inline-flex';
            btn.disabled = true;
        });
    });
    </script>
</body>
</html>
