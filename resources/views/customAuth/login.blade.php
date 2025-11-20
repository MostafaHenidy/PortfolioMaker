@extends('customAuth.master')
@section('title', 'Welcome Back')
@section('subTitle', 'Sign in to your account to continue')
@section('content')
    <div class="card auth-card shadow fade-in" id="loginView">
        
        <div class="card-body p-4 p-md-5">
            <h2 class="card-title text-center mb-4">Sign In</h2>
            <x-auth-session-status class="mb-4" :status="session('status')" />
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label">Email Address</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com"
                        required>
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />

                </div>
                <div class="mb-3 form-group">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="••••••••"
                        required>
                    <span class="password-toggle" id="passwordToggle"><i class="bi bi-eye"></i></span>
                </div>
                <x-input-error :messages="$errors->get('password')" class="mt-2" />

                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" name="remember" id="remember">
                    <label class="form-check-label" for="remember">Remember me</label>
                </div>
                <div class="d-grid mb-3">
                    <button type="submit" class="btn btn-primary btn-lg">Sign In</button>
                </div>
                <div class="text-center auth-links">
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" id="forgotPasswordLink">Forgot your password?</a>
                    @endif
                    <span class="mx-2">•</span>
                    <a href="{{ route('register') }}" id="registerLink2">Don't have an account?</a>
                </div>
            </form>
        </div>
    </div>
@endsection
