@extends('layouts.guest')

@section('content')
<div class="text-center mb-4">
    <div class="logo">SplitAjah</div>
    <p class="text-muted mt-2">{{ __('Reset your password') }}</p>
</div>

<form method="POST" action="{{ route('password.store') }}">
    @csrf
    <input type="hidden" name="token" value="{{ $token }}">

    <div class="mb-3">
        <label for="email" class="form-label">{{ __('Email') }}</label>
        <div class="input-group">
            <span class="input-group-text"><i class="bi bi-envelope"></i></span>
            <input id="email" type="email" name="email" value="{{ old('email', $email) }}" required
                   class="form-control @error('email', 'default') is-invalid @enderror"
                   placeholder="{{ __('Enter your email') }}">
        </div>
        @error('email')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="password" class="form-label">{{ __('New Password') }}</label>
        <div class="input-group">
            <span class="input-group-text"><i class="bi bi-shield-lock"></i></span>
            <input id="password" type="password" name="password" required
                   class="form-control @error('password', 'default') is-invalid @enderror"
                   placeholder="{{ __('Create new password') }}">
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
                   placeholder="{{ __('Confirm new password') }}">
        </div>
    </div>

    <div class="d-grid gap-2 mb-3">
        <button type="submit" class="btn btn-splitajah btn-lg">
            <i class="bi bi-key me-2"></i>{{ __('Reset Password') }}
        </button>
    </div>

    <div class="text-center">
        <a href="{{ route('login') }}" class="text-decoration-none">
            <i class="bi bi-arrow-left me-1"></i>{{ __('Back to login') }}
        </a>
    </div>
</form>
@endsection