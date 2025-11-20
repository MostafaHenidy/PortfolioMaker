<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Authentication | PortfolioMaker</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #0d6efd;
            --success-color: #198754;
            --danger-color: #dc3545;
            --light-bg: #f8f9fa;
            --border-radius: 0.75rem;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto,
                "Helvetica Neue", Arial, sans-serif;
            background-color: var(--light-bg);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        main,
        section {
            flex: 1;
        }

        /* Hero Section */
        .hero-section {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            margin-bottom: 2rem;
            border-radius: 0 0 2rem 2rem;
        }

        .hero-section h1 {
            font-weight: 700;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        /* Auth Cards */
        .auth-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            max-width: 500px;
            margin: 0 auto;
        }

        .auth-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.12) !important;
        }

        /* Buttons */
        .btn {
            border-radius: var(--border-radius);
            font-weight: 500;
            transition: all 0.3s ease;
            padding: 0.75rem 1.5rem;
        }

        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .btn-primary:hover {
            background-color: #0b5ed7;
            border-color: #0b5ed7;
            transform: translateY(-2px);
            box-shadow: 0 8px 16px rgba(13, 110, 253, 0.3);
        }

        .btn-lg {
            padding: 0.875rem 1.75rem;
            font-size: 1.025rem;
        }

        /* Cards & Alerts */
        .card {
            border-radius: 1.5rem;
        }

        .alert {
            border-radius: var(--border-radius);
            border: none;
        }

        .alert-info {
            background-color: #cfe2ff;
            color: #084298;
        }

        .alert-success {
            background-color: #d1e7dd;
            color: #0f5132;
        }

        .alert-danger {
            background-color: #f8d7da;
            color: #842029;
        }

        /* Form Controls */
        .form-control {
            border-radius: var(--border-radius);
            padding: 0.75rem 1rem;
            border: 1px solid #ced4da;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
        }

        /* Input Group */
        .input-group .form-control {
            border-radius: var(--border-radius) 0 0 var(--border-radius);
        }

        .input-group .btn {
            border-radius: 0 var(--border-radius) var(--border-radius) 0;
        }

        /* Spinners */
        .spinner-border {
            width: 3rem;
            height: 3rem;
            border-width: 0.3em;
        }

        /* Cursor */
        .cursor-pointer {
            cursor: pointer;
        }

        /* Responsive Adjustments */
        @media (max-width: 768px) {
            .hero-section h1 {
                font-size: 2rem;
            }

            .card-body {
                padding: 1.5rem !important;
            }

            .auth-card {
                margin: 0 1rem;
            }
        }

        @media (max-width: 480px) {
            .navbar-brand {
                font-size: 1.2rem;
            }

            .hero-section h1 {
                font-size: 1.5rem;
            }

            .display-5 {
                font-size: 2rem;
            }

            .card {
                margin: 0 1rem;
            }

            .input-group {
                flex-direction: column;
            }

            .input-group .form-control,
            .input-group .btn {
                border-radius: var(--border-radius);
            }

            .btn-group-vertical .btn {
                width: 100%;
                margin-bottom: 0.5rem;
            }
        }

        /* Animations */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .fade-in {
            animation: fadeIn 0.3s ease-in-out;
        }

        /* Scrollbar Styling */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        ::-webkit-scrollbar-thumb {
            background: #888;
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #555;
        }

        /* Auth specific styles */
        .password-toggle {
            cursor: pointer;
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            z-index: 10;
        }

        .form-group {
            position: relative;
        }

        .auth-links a {
            text-decoration: none;
            font-weight: 500;
        }

        .auth-links a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand text-primary fw-bold" href="{{ url('/') }}">
                PortfolioMaker
            </a>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section py-5">
        <div class="container text-center py-4">
            <h1 class="display-5 fw-bold mb-3" id="pageTitle">@yield('title')</h1>
            <p class="lead" id="pageSubtitle">@yield('subTitle')</p>
        </div>
    </section>

    <!-- Main Content - Dynamic Views -->
    <main class="container mb-5">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <!-- Alert Container -->
                <div id="alertContainer"></div>
                <!-- Dynamic Content -->
                <div id="authContent">
                    @yield('content')
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-white py-4 mt-auto">
        <div class="container text-center">
            <p class="text-muted mb-0">&copy; 2025 PortfolioMaker. All rights reserved.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Toggle password visibility
        function togglePasswordVisibility(inputId, toggleId) {
            const passwordInput = document.getElementById(inputId);
            const toggleIcon = document.getElementById(toggleId);

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.innerHTML = '<i class="bi bi-eye-slash"></i>';
            } else {
                passwordInput.type = 'password';
                toggleIcon.innerHTML = '<i class="bi bi-eye"></i>';
            }
        }

        // Setup password toggles
        passwordToggles.forEach(toggle => {
            toggle.addEventListener('click', function() {
                const inputId = this.id.replace('Toggle', '');
                togglePasswordVisibility(inputId, this.id);
            });
        });
    </script>
</body>

</html>
