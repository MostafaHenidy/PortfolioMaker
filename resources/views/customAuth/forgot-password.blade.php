@extends('customAuth.master')
@section('title', 'Reset Password')
@section('subTitle', 'Recover access to your account')
@section('content')
    <div class="card auth-card shadow " id="forgotPasswordView">
        <div class="card-body p-4 p-md-5">
            <h2 class="card-title text-center mb-4">Reset Password</h2>
            <p class="text-muted text-center mb-4">
                Enter your email address and we'll send you a link to reset your password.
            </p>
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('password.email') }}">
                @csrf
                <div class="mb-3">
                    <label for="forgotEmail" class="form-label">Email Address</label>
                    <input type="email" class="form-control" name="email" id="forgotEmail" placeholder="name@example.com" required>
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>
                <div class="d-grid mb-3">
                    <button type="submit" class="btn btn-primary btn-lg">Send Reset Link</button>
                </div>
                <div class="text-center auth-links">
                    <a href="{{ route('login') }}" id="backToLoginLink">Back to login</a>
                </div>
            </form>
        </div>
    </div>
@endsection
