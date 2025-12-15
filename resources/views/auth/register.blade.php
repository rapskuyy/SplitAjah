@extends('layouts.guest')

@section('content')
<div class="text-center mb-4">
    <div class="logo">SplitAjah</div>
    <p class="text-muted mt-2">{{ __('Create your account') }}</p>
</div>

<form method="POST" action="{{ route('register') }}">
    @csrf

    <div class="mb-3">
        <label for="name" class="form-label">{{ __('Name') }}</label>
        <div class="input-group">
            <span class="input-group-text"><i class="bi bi-person"></i></span>
            <input id="name" type="text" name="name" value="{{ old('name') }}" required
                   class="form-control @error('name', 'default') is-invalid @enderror"
                   placeholder="{{ __('Enter your name') }}">
        </div>
        @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="email" class="form-label">{{ __('Email') }}</label>
        <div class="input-group">
            <span class="input-group-text"><i class="bi bi-envelope"></i></span>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required
                   class="form-control @error('email', 'default') is-invalid @enderror"
                   placeholder="{{ __('Enter your email') }}">
        </div>
        @error('email')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="password" class="form-label">{{ __('Password') }}</label>
        <div class="input-group">
            <span class="input-group-text"><i class="bi bi-shield-lock"></i></span>
            <input id="password" type="password" name="password" required
                   class="form-control @error('password', 'default') is-invalid @enderror"
                   placeholder="{{ __('Create a password') }}">
        </div>
        @error('password')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-4">
        <label for="password_confirmation" class="form-label">{{ __('Confirm Password') }}</label>
        <div class="input-group">
            <span class="input-group-text"><i class="bi bi-shield-lock-fill"></i></span>
            <input id="password_confirmation" type="password" name="password_confirmation" required
                   class="form-control"
                   placeholder="{{ __('Confirm your password') }}">
        </div>
    </div>

    <div class="d-grid gap-2 mb-3">
        <button type="submit" class="btn btn-splitajah btn-lg">
            <i class="bi bi-person-check me-2"></i>{{ __('Register') }}
        </button>
    </div>

    <div class="text-center">
        <p class="mb-0">{{ __('Already have an account?') }}</p>
        <a href="{{ route('login') }}" class="btn btn-outline-primary mt-2">
            <i class="bi bi-box-arrow-in-right me-1"></i>{{ __('Log in') }}
        </a>
    </div>
</form>
@endsection