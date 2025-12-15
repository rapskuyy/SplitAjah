@extends('layouts.guest-bootstrap')

@section('content')
<div class="text-center mb-4">
    <div class="logo">SplitOptions</div>
    <p class="text-muted mt-2">{{ __('Forgot your password?') }}</p>
    <p class="small text-muted">{{ __('Enter your email to receive a password reset link') }}</p>
</div>

<form method="POST" action="{{ route('password.email') }}">
    @csrf

    <div class="mb-4">
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

    <div class="d-grid gap-2 mb-3">
        <button type="submit" class="btn btn-splitajah btn-lg">
            <i class="bi bi-send me-2"></i>{{ __('Send Reset Link') }}
        </button>
    </div>

    <div class="text-center">
        <a href="{{ route('login') }}" class="text-decoration-none">
            <i class="bi bi-arrow-left me-1"></i>{{ __('Back to login') }}
        </a>
    </div>
</form>
@endsection