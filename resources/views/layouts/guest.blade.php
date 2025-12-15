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
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #e4edf9 100%);
            min-height: 100vh;
            padding-top: 2rem;
            padding-bottom: 2rem;
        }
        .dark body {
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%);
        }
        .auth-card {
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(67, 97, 238, 0.15);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .dark .auth-card {
            background: #1e1e2d;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.4);
        }
        .auth-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(67, 97, 238, 0.25);
        }
        .btn-splitajah {
            background-color: var(--splitajah);
            border-color: var(--splitajah);
        }
        .btn-splitajah:hover {
            background-color: #3a56d4;
            border-color: #3a56d4;
        }
        .form-label {
            font-weight: 600;
            color: #4361ee;
        }
        .dark .form-label {
            color: #7abaff;
        }
        .logo {
            font-weight: 700;
            background: linear-gradient(45deg, #4361ee, #3a0ca3);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            font-size: 2.2rem;
        }
        .dark .logo {
            background: linear-gradient(45deg, #7abaff, #a3d9ff);
            -webkit-text-fill-color: transparent;
        }
        .footer-text {
            color: #6c757d;
        }
        .dark .footer-text {
            color: #a0aec0;
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