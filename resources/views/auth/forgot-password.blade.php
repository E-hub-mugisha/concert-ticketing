@extends('layouts.auth')

@section('title', 'Forgot Password')
@section('subtitle', 'Reset your password in just a few clicks.')

@section('content')
@if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif

<form method="POST" action="{{ route('password.email') }}">
    @csrf

    <div class="mb-3">
        <label for="email" class="form-label">Email address</label>
        <input id="email" type="email" name="email" class="form-control" required autofocus>
    </div>

    <button type="submit" class="btn btn-primary w-100">
        <i class="bi bi-envelope"></i> Send Password Reset Link
    </button>
</form>
@endsection

@section('auth-links')
<p>Remembered your password? 
    <a href="{{ route('login') }}" class="text-primary text-decoration-none">Back to Login</a>
</p>
@endsection
