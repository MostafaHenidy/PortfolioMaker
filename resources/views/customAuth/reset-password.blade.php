@extends('customAuth.master')
@section('title', 'Create New Password')
@section('subTitle', 'Choose a new password for your account')
@section('content')
    <div class="card auth-card shadow" id="resetPasswordView">
        <div class="card-body p-4 p-md-5">
            <h2 class="card-title text-center mb-4">Create New Password</h2>
            <form method="POST" action="{{ route('password.store') }}">
                @csrf
                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <div class="mb-3 form-group">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com"
                        required>
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>
                <div class="mb-3 form-group">
                    <label for="newPassword" class="form-label">New Password</label>
                    <input type="password" name="password" class="form-control" id="newPassword" placeholder="••••••••" required>
                    <span class="password-toggle" id="newPasswordToggle">👁️</span>
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />

                </div>
                <div class="mb-3 form-group">
                    <label for="confirmNewPassword" class="form-label">Confirm New Password</label>
                    <input type="password" class="form-control" name="password_confirmation" id="confirmNewPassword" placeholder="••••••••" required>
                    <span class="password-toggle" id="confirmNewPasswordToggle">👁️</span>
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>
                <div class="d-grid mb-3">
                    <button type="submit" class="btn btn-primary btn-lg">Reset Password</button>
                </div>
                <div class="text-center auth-links">
                    <a href="{{ route('login') }}" id="backToLoginLink2">Back to login</a>
                </div>
            </form>
        </div>
    </div>


@endsection
