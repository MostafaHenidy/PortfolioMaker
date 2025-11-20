@extends('customAuth.master')
@section('title', 'Join Us Today')
@section('subtitle', 'Create your account to get started')
@section('content')
    <div class="card auth-card shadow" id="registerView">
        <div class="card-body p-4 p-md-5">
            <h2 class="card-title text-center mb-4">Create Account</h2>
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="mb-3">
                    <label for="regName" class="form-label">Full Name</label>
                    <input type="text" class="form-control" name="name" id="regName" placeholder="John Doe" required>
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />

                </div>
                <div class="mb-3">
                    <label for="regEmail" class="form-label">Email Address</label>
                    <input type="email" class="form-control" name="email" id="regEmail" placeholder="name@example.com" required>
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />

                </div>
                <div class="mb-3 form-group">
                    <label for="regPassword" class="form-label">Password</label>
                    <input type="password" class="form-control" name="password" id="regPassword" placeholder="••••••••" required>
                    <span class="password-toggle" id="regPasswordToggle"><i class="bi bi-eye"></i></span>
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />

                </div>
                <div class="mb-3 form-group">
                    <label for="confirmPassword" class="form-label">Confirm Password</label>
                    <input type="password" class="form-control" name="password_confirmation" id="confirmPassword" placeholder="••••••••" required>
                    <span class="password-toggle" id="confirmPasswordToggle"><i class="bi bi-eye"></i></span>
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />

                </div>

                <div class="d-grid mb-3">
                    <button type="submit" class="btn btn-primary btn-lg">Create Account</button>
                </div>
                <div class="text-center auth-links">
                    <a href="{{ route('login') }}" id="loginLink2">Already have an account?</a>
                </div>
            </form>
        </div>
    </div>


@endsection
