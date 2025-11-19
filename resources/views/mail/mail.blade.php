<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Message Received - PortfolioMaker</title>
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
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            background-color: var(--light-bg);
            color: #333;
            line-height: 1.6;
        }

        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: white;
            border-radius: 1.5rem;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        /* Hero Section */
        .email-hero {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 2.5rem 2rem;
            text-align: center;
            border-radius: 0 0 2rem 2rem;
        }

        .email-hero h1 {
            font-weight: 700;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin-bottom: 0.5rem;
        }

        .email-hero p {
            opacity: 0.9;
            max-width: 80%;
            margin: 0 auto;
        }

        /* Content Section */
        .email-content {
            padding: 2rem;
        }

        .email-card {
            background-color: white;
            border-radius: var(--border-radius);
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            border: 1px solid #e9ecef;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .email-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.08) !important;
        }

        .message-details {
            background-color: #f8f9fa;
            border-radius: var(--border-radius);
            padding: 1.5rem;
            margin: 1.5rem 0;
        }

        .message-field {
            margin-bottom: 1rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid #e9ecef;
        }

        .message-field:last-child {
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 0;
        }

        .field-label {
            font-weight: 600;
            color: #495057;
            margin-bottom: 0.25rem;
        }

        .field-value {
            color: #212529;
        }

        /* Buttons */
        .btn {
            display: inline-block;
            background-color: var(--primary-color);
            color: white;
            text-decoration: none;
            padding: 0.75rem 1.5rem;
            border-radius: var(--border-radius);
            font-weight: 500;
            transition: all 0.3s ease;
            text-align: center;
            border: none;
            cursor: pointer;
        }

        .btn:hover {
            background-color: #0b5ed7;
            transform: translateY(-2px);
            box-shadow: 0 8px 16px rgba(13, 110, 253, 0.3);
        }

        .btn-lg {
            padding: 0.875rem 1.75rem;
            font-size: 1.025rem;
        }

        .btn-success {
            background-color: var(--success-color);
        }

        .btn-success:hover {
            background-color: #157347;
        }

        .btn-outline {
            background-color: transparent;
            border: 1px solid var(--primary-color);
            color: var(--primary-color);
        }

        .btn-outline:hover {
            background-color: var(--primary-color);
            color: white;
        }

        /* Alerts */
        .alert {
            border-radius: var(--border-radius);
            border: none;
            padding: 1rem;
            margin-bottom: 1.5rem;
        }

        .alert-info {
            background-color: #cfe2ff;
            color: #084298;
        }

        /* Footer */
        .email-footer {
            background-color: #f8f9fa;
            padding: 1.5rem 2rem;
            text-align: center;
            border-top: 1px solid #e9ecef;
            color: #6c757d;
            font-size: 0.875rem;
        }

        .email-footer a {
            color: var(--primary-color);
            text-decoration: none;
        }

        /* Responsive */
        @media (max-width: 480px) {
            .email-container {
                border-radius: 0;
            }

            .email-hero {
                padding: 2rem 1.5rem;
                border-radius: 0;
            }

            .email-content {
                padding: 1.5rem;
            }

            .email-hero p {
                max-width: 100%;
            }

            .button-group {
                flex-direction: column;
            }

            .button-group .btn {
                width: 100%;
                margin-bottom: 0.5rem;
            }
        }

        .button-group {
            display: flex;
            gap: 0.75rem;
            justify-content: center;
            margin-top: 1.5rem;
        }
    </style>
</head>

<body>
    <div class="email-container">
        <!-- Hero Section -->
        <div class="email-hero">
            <h1>New Message Received</h1>
            <p>{{ $formData['name'] }} has sent you a message through your portfolio contact form.</p>
        </div>

        <!-- Content Section -->
        <div class="email-content">
            <div class="alert alert-info">
                <strong>Heads up!</strong> You've received a new message from a visitor to your portfolio website.
            </div>

            <div class="email-card">
                <h2 style="margin-bottom: 1rem;">Message Details</h2>

                <div class="message-details">
                    <div class="message-field">
                        <div class="field-label">From</div>
                        <div class="field-value">{{ $formData['name'] }}</div>
                    </div>

                    <div class="message-field">
                        <div class="field-label">Email</div>
                        <div class="field-value">{{ $formData['email'] }}</div>
                    </div>
                    <div class="message-field">
                        <div class="field-label">Message</div>
                        <div class="field-value">
                            <p>{{ nl2br(e($formData['message'])) }}.</p>
                            <p>Looking forward to hearing from you!</p>
                        </div>
                    </div>

                    <div class="message-field">
                        <div class="field-label">Received</div>
                        <div class="field-value">{{ now()->toFormattedDateString() }} at {{ now() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div class="email-footer">
            <p>© 2025 PortfolioMaker. All rights reserved.</p>
            {{-- <p style="margin-top: 0.5rem;">
                <a href="#">Email Preferences</a> |
                <a href="#">Privacy Policy</a> |
                <a href="#">Contact Support</a>
            </p> --}}
        </div>
    </div>
</body>

</html>
