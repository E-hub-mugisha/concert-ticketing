@extends('layouts.auth')

@section('title', 'Reset Password')
@section('subtitle', 'Create a new password for your account.')

@section('content')
<form method="POST" action="{{ route('password.update') }}">
    @csrf

    <!-- Hidden token field -->
    <input type="hidden" name="token" value="{{ $token }}">

    <div class="mb-3">
        <label for="email" class="form-label">Email address</label>
        <input id="email" type="email" name="email" class="form-control" value="{{ old('email', request('email')) }}" required autofocus>
    </div>

    <div class="mb-3">
        <label for="password" class="form-label">New Password</label>
        <input id="password" type="password" name="password" class="form-control" required>
    </div>

    <div class="mb-3">
        <label for="password_confirmation" class="form-label">Confirm Password</label>
        <input id="password_confirmation" type="password" name="password_confirmation" class="form-control" required>
    </div>

    <button type="submit" class="btn btn-primary w-100">
        <i class="bi bi-shield-lock"></i> Reset Password
    </button>
</form>
@endsection

@section('auth-links')
<p>
    <a href="{{ route('login') }}" class="text-primary text-decoration-none">
        Back to Login
    </a>
</p>
@endsection
