@extends('layouts.auth')

@section('title', 'Login')
@section('subtitle', 'Welcome back! Please log in to your account.')

@section('content')
<form action="{{ route('login') }}" method="POST">
    @csrf

    <div class="mb-3">
        <label for="email" class="form-label">Email address</label>
        <input id="email" type="email" name="email" class="form-control" required autofocus>
    </div>

    <div class="mb-3">
        <label for="password" class="form-label d-flex justify-content-between">
            <span>Password</span>
            <a href="{{ route('password.request') }}" class="small text-decoration-none">Forgot?</a>
        </label>
        <input id="password" type="password" name="password" class="form-control" required>
    </div>

    <div class="form-check mb-3">
        <input type="checkbox" name="remember" class="form-check-input" id="remember">
        <label class="form-check-label" for="remember">Remember me</label>
    </div>

    <button type="submit" class="btn btn-primary w-100">Sign In</button>
</form>
@endsection

@section('auth-links')
<p>Don't have an account? <a href="{{ route('register') }}" class="text-primary text-decoration-none">Sign up</a></p>
@endsection
