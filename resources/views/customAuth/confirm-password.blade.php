@extends('customAuth.master')
@section('content')
    <div class="card auth-card shadow d-none" id="confirmPasswordView">
        <div class="card-body p-4 p-md-5">
            <h2 class="card-title text-center mb-4">Confirm Password</h2>
            <p class="text-muted text-center mb-4">
                This is a secure area of the application. Please confirm your password before
                continuing.
            </p>
            <form id="confirmPasswordForm">
                <div class="mb-3 form-group">
                    <label for="confirmPasswordField" class="form-label">Password</label>
                    <input type="password" class="form-control" id="confirmPasswordField" placeholder="••••••••" required>
                    <span class="password-toggle" id="confirmPasswordFieldToggle">👁️</span>
                </div>
                <div class="d-grid mb-3">
                    <button type="submit" class="btn btn-primary btn-lg">Confirm Password</button>
                </div>
            </form>
        </div>
    </div>
@endsection
