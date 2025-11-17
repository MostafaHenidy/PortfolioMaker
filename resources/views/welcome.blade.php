<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles / Scripts -->
    {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
    <link rel="stylesheet" href="{{ asset('front-assets/css/style.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    @livewireStyles
</head>

<body class="bg-light">
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
        <div class="container-lg">
            <a class="navbar-brand fw-bold text-primary" href="#">
                <i class="fas fa-file-pdf"></i> PDF Share
            </a>
            @if (auth()->user())
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button class="btn btn-outline-primary btn-sm ms-auto">Logout</button>
                </form>
            @else
                <div>
                    <a href="{{ route('login') }}" class="btn btn-outline-primary btn-sm ms-auto">Login</a>
                    <a href="{{ route('register') }}" class="btn btn-outline-secondary btn-sm ms-auto">Register</a>
                </div>
            @endif
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section py-5 text-center">
        <div class="container-lg">
            <h1 class="display-5 fw-bold text-dark mb-3">Build your own protfolio Instantly</h1>
            <p class="lead text-muted mb-0">Upload your PDF, get a shareable link and QR code in seconds</p>
        </div>
    </section>

    <!-- Main Content -->
    <section class="py-5">
        <div class="container-lg">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="card shadow-lg border-0 rounded-4 upload-card">
                        <!-- Upload Section -->
                        <livewire:upload-document />

                        <!-- Success Section -->
                        {{-- <div class="card-body p-4 p-md-5 d-none" id="successSection">
                            <h3 class="card-title mb-4 text-center fw-bold text-success">
                                <i class="fas fa-check-circle"></i> Upload Successful!
                            </h3>

                            <!-- File Info -->
                            <div class="alert alert-light border mb-4">
                                <p class="mb-1 text-muted small">File Name</p>
                                <p class="fw-semibold mb-0" id="successFileName"></p>
                            </div>

                            <!-- Shareable Link -->
                            <div class="mb-4">
                                <p class="text-muted small mb-2">Shareable Link</p>
                                <div class="input-group mb-2">
                                    <input type="text" class="form-control" id="shareLink" readonly>
                                    <button class="btn btn-outline-primary" type="button" id="copyBtn">
                                        <i class="fas fa-copy"></i> Copy
                                    </button>
                                </div>
                                <div id="copySuccess" class="alert alert-success d-none py-2 small mb-0">
                                    <i class="fas fa-check"></i> Copied to clipboard!
                                </div>
                            </div>

                            <!-- QR Code -->
                            <div class="text-center mb-4">
                                <p class="text-muted small mb-2">QR Code</p>
                                <div class="qr-container">
                                    <img id="qrCode" src="/placeholder.svg" alt="QR Code"
                                        class="img-fluid rounded-2">
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="d-grid gap-2 d-md-flex">
                                <button class="btn btn-primary flex-md-grow-1" id="downloadPdfBtn">
                                    <i class="fas fa-download"></i> Download PDF
                                </button>
                                <button class="btn btn-outline-primary flex-md-grow-1" id="downloadQrBtn">
                                    <i class="fas fa-image"></i> Download QR
                                </button>
                            </div>

                            <!-- New Upload Button -->
                            <button class="btn btn-light w-100 mt-3" id="newUploadBtn">
                                <i class="fas fa-plus"></i> Upload Another
                            </button>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-white border-top py-4 mt-5">
        <div class="container-lg text-center text-muted small">
            <p class="mb-0">&copy; 2025 PDF Share. All rights reserved.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous">
    </script>
    @livewireScripts


</body>

</html>
