@extends('layouts.admin')

@section('title', 'My Profile')
@section('page-title', 'My Profile')

@section('content')
    <div class="page-header-banner">
        <div class="page-header-text">
            <h1><i class="fa-solid fa-user-circle"></i> My Profile</h1>
            <p>Update your account information and password.</p>
        </div>
    </div>

    @if(session('status'))
        <div class="alert success">
            <div class="alert-icon"><i class="fa-solid fa-check-circle"></i></div>
            <div class="alert-body">{{ session('status') }}</div>
        </div>
    @endif

    <div class="settings-layout">
        <div class="settings-content" style="width:100%">
            <div class="settings-card">
                <div class="settings-card-header">
                    <h3>Profile Details</h3>
                    <p>Basic information used across the admin panel.</p>
                </div>
                <div class="settings-card-body">
                    <form method="POST" action="{{ route('admin.profile.update') }}">
                        @csrf
                        @method('PUT')

                        <div class="settings-field">
                            <label for="name">Full Name</label>
                            <input id="name" name="name" type="text" class="settings-input" value="{{ old('name', $user->name) }}" required>
                            @error('name')
                                <span class="field-error">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="settings-field">
                            <label for="email">Email</label>
                            <input id="email" name="email" type="email" class="settings-input" value="{{ old('email', $user->email) }}" required>
                            @error('email')
                                <span class="field-error">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="settings-field">
                            <label class="checkbox">
                                <input type="checkbox" name="two_factor_enabled" value="1" {{ old('two_factor_enabled', $user->two_factor_enabled) ? 'checked' : '' }}>
                                <span>Require a verification code at login (email 2FA)</span>
                            </label>
                            <p class="hint">A 6-digit code will be emailed whenever you sign in.</p>
                        </div>

                        <div class="settings-card-footer" style="padding-left:0">
                            <button class="btn-primary-admin" type="submit"><i class="fa-solid fa-save"></i> Save Profile</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="settings-card">
                <div class="settings-card-header">
                    <h3>Password</h3>
                    <p>Use a strong, unique password to secure your account.</p>
                </div>
                <div class="settings-card-body">
                    <form method="POST" action="{{ route('admin.profile.password') }}">
                        @csrf
                        @method('PUT')

                        <div class="settings-field">
                            <label for="current_password">Current Password</label>
                            <input id="current_password" name="current_password" type="password" class="settings-input" required>
                            @error('current_password')
                                <span class="field-error">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="settings-row">
                            <div class="settings-field">
                                <label for="password">New Password</label>
                                <input id="password" name="password" type="password" class="settings-input" required>
                                @error('password')
                                    <span class="field-error">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="settings-field">
                                <label for="password_confirmation">Confirm Password</label>
                                <input id="password_confirmation" name="password_confirmation" type="password" class="settings-input" required>
                            </div>
                        </div>

                        <div class="settings-card-footer" style="padding-left:0">
                            <button class="btn-primary-admin" type="submit"><i class="fa-solid fa-key"></i> Update Password</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
