<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Two-Factor Verification - Agenda 2063 Admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>
<body>
<div class="login-wrapper">
    <div class="login-branding">
        <div class="branding-overlay"></div>
        <div class="branding-content">
            <div class="brand-logo"><i class="fa-solid fa-shield-halved"></i></div>
            <h1>Security Check</h1>
            <div class="brand-divider"></div>
            <p>We emailed you a 6-digit code.</p>
        </div>
    </div>
    <div class="login-form-panel">
        <div class="login-form-container">
            <div class="login-header">
                <div class="login-icon"><i class="fa-solid fa-lock"></i></div>
                <h2>Enter Verification Code</h2>
                <p>Check your inbox and enter the 6-digit code to continue.</p>
            </div>

            @if(session('status'))
                <div class="login-alert success">
                    <i class="fa-solid fa-circle-check"></i>
                    <span>{{ session('status') }}</span>
                </div>
            @endif

            @if($errors->any())
                <div class="login-alert error">
                    <i class="fa-solid fa-circle-exclamation"></i>
                    <span>{{ $errors->first() }}</span>
                </div>
            @endif

            <form method="POST" action="{{ route('login.2fa.verify') }}" class="login-form">
                @csrf
                <div class="form-group">
                    <label for="code">6-digit code</label>
                    <div class="input-wrapper">
                        <i class="fa-solid fa-hashtag"></i>
                        <input type="text" id="code" name="code" pattern="[0-9]{6}" maxlength="6" inputmode="numeric" required autofocus>
                    </div>
                </div>
                <button type="submit" class="login-btn">
                    <span class="btn-text">Verify & Continue</span>
                    <i class="fa-solid fa-arrow-right btn-arrow"></i>
                </button>
            </form>

            <div class="login-footer">
                <a href="{{ route('login') }}"><i class="fa-solid fa-arrow-left"></i> Back to login</a>
            </div>
        </div>
    </div>
</div>
</body>
</html>
