@extends('layouts.guest')

@section('content')
<div class="text-center mb-4">
    <div class="logo">SplitAjah</div>
    <p class="text-muted mt-2">{{ __('Sign in to your account') }}</p>
</div>

<form method="POST" action="{{ route('login') }}">
    @csrf

    <div class="mb-3">
        <label for="email" class="form-label">{{ __('Email') }}</label>
        <div class="input-group">
            <span class="input-group-text"><i class="bi bi-envelope"></i></span>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                   class="form-control @error('email', 'default') is-invalid @enderror"
                   placeholder="{{ __('Enter your email') }}">
        </div>
        @error('email')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-4">
        <label for="password" class="form-label">{{ __('Password') }}</label>
        <div class="input-group">
            <span class="input-group-text"><i class="bi bi-lock"></i></span>
            <input id="password" type="password" name="password" required
                   class="form-control @error('password', 'default') is-invalid @enderror"
                   placeholder="{{ __('Enter your password') }}">
        </div>
        @error('password')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3 form-check">
        <input id="remember_me" type="checkbox" name="remember" class="form-check-input">
        <label for="remember_me" class="form-check-label">{{ __('Remember me') }}</label>
    </div>

    <div class="d-grid gap-2 mb-3">
        <button type="submit" class="btn btn-splitajah btn-lg">
            <i class="bi bi-box-arrow-in-right me-2"></i>{{ __('Log in') }}
        </button>
    </div>

    <div class="text-center">
        <a href="{{ route('password.request') }}" class="text-decoration-none">
            <small>{{ __('Forgot your password?') }}</small>
        </a>
    </div>

    <div class "text-center mt-3">
        <p class="mb-0">{{ __("Don't have an account?") }}</p>
        <a href="{{ route('register') }}" class="btn btn-outline-primary mt-2">
            <i class="bi bi-person-plus me-1"></i>{{ __('Register') }}
        </a>
    </div>
</form>
@endsection