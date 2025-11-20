@extends('customAuth.master')
@section('content')
    <div class="card auth-card shadow d-none" id="verifyEmailView">
        <div class="card-body p-4 p-md-5 text-center">
            <div class="mb-4">
                <svg width="80" height="80" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M22 6C22 4.9 21.1 4 20 4H4C2.9 4 2 4.9 2 6V18C2 19.1 2.9 20 4 20H20C21.1 20 22 19.1 22 18V6ZM20 6L12 11L4 6H20ZM20 18H4V8L12 13L20 8V18Z"
                        fill="#667eea" />
                </svg>
            </div>
            <h2 class="card-title mb-3">Verify Your Email Address</h2>
            <p class="text-muted mb-4">
                We've sent a verification link to <strong id="userEmail">user@example.com</strong>.
                Please check your email and click the link to verify your account.
            </p>
            <div class="alert alert-info mb-4">
                If you didn't receive the email, click the button below to resend.
            </div>
            <div class="d-grid mb-3">
                <button type="button" class="btn btn-primary btn-lg" id="resendVerificationBtn">Resend
                    Verification Email</button>
            </div>
            <div class="text-center auth-links">
                <a href="#" id="logoutLink">Logout</a>
            </div>
        </div>
    </div>
@endsection
