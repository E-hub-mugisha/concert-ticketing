@extends('layouts.auth')

@section('title', 'Register')
@section('subtitle', 'Create your account in seconds.')

@section('content')
<form action="{{ route('register') }}" method="POST">
    @csrf

    <div class="mb-3">
        <label class="form-label">Full Name</label>
        <input type="text" name="name" class="form-control" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Email</label>
        <input type="email" name="email" class="form-control" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Password</label>
        <input type="password" name="password" class="form-control" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Confirm Password</label>
        <input type="password" name="password_confirmation" class="form-control" required>
    </div>

    <button type="submit" class="btn btn-primary w-100">Create Account</button>
</form>
@endsection

@section('auth-links')
<p>Already have an account? <a href="{{ route('login') }}" class="text-primary text-decoration-none">Sign in</a></p>
@endsection
