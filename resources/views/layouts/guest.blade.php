<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" 
      @if(session('dark_mode', false) || (request()->cookie('dark_mode') == 'true')) class="dark" @endif>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'SplitAjah' }}</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">

    <style>
        :root {
            --splitajah: #4361ee;
            --splitajah-light: #eef2ff;
        }
        
        /* Base Styles */
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #e4edf9 100%);
            min-height: 100vh;
            padding-top: 2rem;
            padding-bottom: 2rem;
            color: #1e293b;
        }
        
        html.dark body {
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%);
            color: #e2e8f0;
        }
        
        /* Auth Card Styles */
        .auth-card {
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(67, 97, 238, 0.15);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            background: white;
            color: #1e293b;
        }
        
        html.dark .auth-card {
            background: #1e1e2d;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.4);
            color: #e2e8f0;
        }
        
        .auth-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(67, 97, 238, 0.25);
        }
        
        /* Button Styles */
        .btn-splitajah {
            background-color: var(--splitajah);
            border-color: var(--splitajah);
            color: white;
        }
        
        .btn-splitajah:hover {
            background-color: #3a56d4;
            border-color: #3a56d4;
            color: white;
        }
        
        .btn-primary {
            background-color: var(--splitajah);
            border-color: var(--splitajah);
        }
        
        .btn-primary:hover {
            background-color: #3a56d4;
            border-color: #3a56d4;
        }
        
        /* Form Styles */
        .form-label {
            font-weight: 600;
            color: #4361ee;
        }
        
        html.dark .form-label {
            color: #7abaff;
        }
        
        .form-control, .form-select {
            background-color: white;
            color: #1e293b;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
        }
        
        html.dark .form-control, 
        html.dark .form-select {
            background-color: #334155;
            color: #e2e8f0;
            border: 1px solid #475569;
        }
        
        .form-control:focus, 
        .form-select:focus {
            background-color: white;
            color: #1e293b;
            border-color: var(--splitajah);
            box-shadow: 0 0 0 0.2rem rgba(67, 97, 238, 0.25);
        }
        
        html.dark .form-control:focus, 
        html.dark .form-select:focus {
            background-color: #334155;
            color: #e2e8f0;
            border-color: #7abaff;
            box-shadow: 0 0 0 0.2rem rgba(122, 186, 255, 0.25);
        }
        
        /* Logo Styles */
        .logo {
            font-weight: 700;
            background: linear-gradient(45deg, #4361ee, #3a0ca3);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            font-size: 2.2rem;
        }
        
        html.dark .logo {
            background: linear-gradient(45deg, #7abaff, #a3d9ff);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        
        /* Footer Text Styles */
        .footer-text {
            color: #6c757d;
        }
        
        html.dark .footer-text {
            color: #a0aec0;
        }
        
        /* Link Styles */
        a {
            color: var(--splitajah);
            text-decoration: none;
        }
        
        html.dark a {
            color: #7abaff;
        }
        
        a:hover {
            text-decoration: underline;
        }
        
        /* Alert Styles */
        .alert {
            border: none;
            border-radius: 8px;
        }
        
        .alert-info {
            background-color: #dbeafe;
            color: #0c4a6e;
            border: 1px solid #7dd3fc;
        }
        
        html.dark .alert-info {
            background-color: #082f49;
            color: #e0f2fe;
            border: 1px solid #0284c7;
        }
        
        .alert-danger {
            background-color: #fee2e2;
            color: #7f1d1d;
            border: 1px solid #fca5a5;
        }
        
        html.dark .alert-danger {
            background-color: #7f1d1d;
            color: #fee2e2;
            border: 1px solid #f87171;
        }
        
        /* Input Group Styles */
        .input-group-text {
            background-color: white;
            color: #1e293b;
            border: 1px solid #e2e8f0;
        }
        
        html.dark .input-group-text {
            background-color: #334155;
            color: #e2e8f0;
            border: 1px solid #475569;
        }
        
        /* HR Styles */
        hr {
            border-color: #e2e8f0;
            opacity: 1;
        }
        
        html.dark hr {
            border-color: #475569;
        }
        
        /* Smooth transitions */
        * {
            transition: background-color 0.2s ease, color 0.2s ease, border-color 0.2s ease;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5">
                <div class="auth-card p-4 p-md-5 bg-white">
                    @yield('content')
                </div>

                <div class="text-center mt-4 footer-text">
                    &copy; {{ date('Y') }} SplitAjah. {{ __('All rights reserved.') }}
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS (only needed for dropdowns, etc. - optional for auth) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Dark mode toggle -->
    <script>
        // Respect system preference on first visit
        if (!localStorage.getItem('dark_mode') && window.matchMedia('(prefers-color-scheme: dark)').matches) {
            document.documentElement.classList.add('dark');
            localStorage.setItem('dark_mode', 'true');
        } else if (localStorage.getItem('dark_mode') === 'true') {
            document.documentElement.classList.add('dark');
        }
    </script>
</body>
</html>