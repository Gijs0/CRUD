<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <!-- Custom Auth Pages CSS - Bootstrap Theme -->
    <style>
        :root {
            --primary-color: #2c3e50;
            --secondary-color: #e74c3c;
            --accent-color: #3498db;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif !important;
            background-color: #f8f9fa !important;
        }

        .auth-container {
            min-height: 100vh !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            background-color: #f8f9fa !important;
            padding: 2rem !important;
        }

        .auth-form-container {
            background: white !important;
            padding: 2.5rem !important;
            border-radius: 0.375rem !important;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1) !important;
            width: 100% !important;
            max-width: 450px !important;
            border: none !important;
        }

        .auth-header {
            margin-bottom: 2rem !important;
            text-align: center !important;
        }

        .auth-title {
            font-size: 2rem !important;
            font-weight: bold !important;
            text-align: center !important;
            margin-bottom: 0.5rem !important;
            color: var(--primary-color) !important;
        }

        .auth-subtitle {
            text-align: center !important;
            color: #6c757d !important;
            margin-bottom: 0 !important;
            font-size: 1rem !important;
        }

        .auth-form {
            margin-top: 2rem !important;
        }

        .form-field {
            margin-bottom: 1.5rem !important;
        }

        .form-label {
            display: block !important;
            font-size: 0.875rem !important;
            font-weight: 500 !important;
            color: #212529 !important;
            margin-bottom: 0.5rem !important;
        }

        .form-input {
            width: 100% !important;
            padding: 0.75rem 1rem !important;
            border: 1px solid #dee2e6 !important;
            border-radius: 0.375rem !important;
            font-size: 1rem !important;
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out !important;
            background-color: #ffffff !important;
        }

        .form-input:focus {
            border-color: var(--accent-color) !important;
            outline: none !important;
            box-shadow: 0 0 0 0.2rem rgba(52, 152, 219, 0.25) !important;
        }

        .form-input.error {
            border-color: var(--secondary-color) !important;
        }

        .input-error {
            color: var(--secondary-color) !important;
            font-size: 0.875rem !important;
            margin-top: 0.25rem !important;
        }

        .session-status {
            background-color: #d1edff !important;
            border: 1px solid #bee5eb !important;
            color: #0c5460 !important;
            padding: 0.75rem 1rem !important;
            border-radius: 0.375rem !important;
            margin-bottom: 1rem !important;
            font-size: 0.875rem !important;
        }

        .auth-options {
            display: flex !important;
            justify-content: space-between !important;
            align-items: center !important;
            margin: 1.5rem 0 !important;
        }

        .remember-me {
            display: flex !important;
            align-items: center !important;
        }

        .remember-checkbox {
            margin-right: 0.5rem !important;
            accent-color: var(--accent-color) !important;
        }

        .remember-label {
            font-size: 0.875rem !important;
            color: #212529 !important;
            cursor: pointer !important;
        }

        .forgot-password a {
            color: var(--accent-color) !important;
            text-decoration: none !important;
            font-size: 0.875rem !important;
            font-weight: 500 !important;
        }

        .forgot-password a:hover {
            color: #2980b9 !important;
            text-decoration: underline !important;
        }

        .primary-button {
            width: 100% !important;
            background-color: var(--accent-color) !important;
            border-color: var(--accent-color) !important;
            color: white !important;
            padding: 0.875rem 1rem !important;
            border: 1px solid transparent !important;
            border-radius: 0.375rem !important;
            font-size: 1rem !important;
            font-weight: 400 !important;
            cursor: pointer !important;
            margin: 1.5rem 0 !important;
            transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            gap: 0.5rem !important;
        }

        .primary-button:hover {
            background-color: #2980b9 !important;
            border-color: #2980b9 !important;
            color: white !important;
        }

        .button-icon {
            width: 1.25rem !important;
            height: 1.25rem !important;
        }

        .auth-link {
            text-align: center !important;
            margin-top: 1.5rem !important;
        }

        .auth-link-text {
            color: #6c757d !important;
            font-size: 0.875rem !important;
        }

        .auth-link a {
            color: var(--accent-color) !important;
            text-decoration: none !important;
            font-weight: 500 !important;
            margin-left: 0.25rem !important;
        }

        .auth-link a:hover {
            color: #2980b9 !important;
            text-decoration: underline !important;
        }

        .password-requirements {
            background-color: #f8f9fa !important;
            border: 1px solid #dee2e6 !important;
            border-radius: 0.375rem !important;
            padding: 1rem !important;
            margin: 1.5rem 0 !important;
        }

        .password-requirements-title {
            font-size: 0.875rem !important;
            font-weight: 600 !important;
            color: #212529 !important;
            margin-bottom: 0.5rem !important;
        }

        .password-requirements-list {
            margin: 0 !important;
            padding-left: 1.25rem !important;
            font-size: 0.875rem !important;
            color: #6c757d !important;
        }

        .password-requirements-list li {
            margin-bottom: 0.25rem !important;
        }

        .terms-privacy {
            text-align: center !important;
            margin-top: 1.5rem !important;
            font-size: 0.75rem !important;
            color: #6c757d !important;
        }

        .terms-privacy a {
            color: var(--accent-color) !important;
            text-decoration: none !important;
        }

        .terms-privacy a:hover {
            text-decoration: underline !important;
        }

        /* Navbar Brand Link */
        .auth-brand {
            text-align: center !important;
            margin-bottom: 2rem !important;
        }

        .auth-brand a {
            color: var(--primary-color) !important;
            text-decoration: none !important;
            font-size: 1.5rem !important;
            font-weight: bold !important;
        }

        .auth-brand a:hover {
            color: var(--accent-color) !important;
        }

        /* Responsive Design */
        @media (max-width: 640px) {
            .auth-container {
                padding: 1rem !important;
            }
            
            .auth-form-container {
                padding: 1.5rem !important;
                margin: 0.5rem !important;
            }
            
            .auth-title {
                font-size: 1.5rem !important;
            }
            
            .auth-options {
                flex-direction: column !important;
                gap: 1rem !important;
                align-items: stretch !important;
            }
        }
    </style>
</head>
<body>
    {{ $slot }}
    
    <!-- Bootstrap JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>