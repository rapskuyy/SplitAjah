<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"
      @if(session('dark_mode', false) || (request()->cookie('dark_mode') == 'true')) class="dark" @endif>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SplitAjah</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Google Font: Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --splitajah: #4f46e5;
        }
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8fafc;
            color: #1e293b;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        .dark body {
            background-color: #0f172a;
            color: #e2e8f0;
        }
        .navbar {
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            background: linear-gradient(135deg, var(--splitajah), #4338ca);
        }
        .dark .navbar {
            background: linear-gradient(135deg, #3a3a6e, #2d2d5a);
            box-shadow: 0 2px 15px rgba(0,0,0,0.3);
        }
        .navbar-brand, .nav-link {
            color: white !important;
        }
        .card {
            border-radius: 16px;
            box-shadow: 0 6px 16px rgba(0,0,0,0.08);
            border: none;
            background: white;
        }
        .dark .card {
            background: #1e293b;
            box-shadow: 0 6px 16px rgba(0,0,0,0.3);
        }
        .footer {
            padding: 1.5rem 0;
            background-color: #f1f5f9;
            color: #64748b;
        }
        .dark .footer {
            background-color: #0f172a;
            color: #94a3b8;
        }
        .language-badge {
            font-size: 0.75rem;
            padding: 0.25rem 0.5rem;
            border-radius: 6px;
            background: rgba(255,255,255,0.15);
            color: white;
        }
        .language-badge.active {
            background: white;
            color: var(--splitajah);
        }
        .dark .language-badge.active {
            background: #334155;
            color: #a5b4fc;
        }
    </style>
</head>
<body>
    @auth
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="{{ route('dashboard') }}">
                <i class="bi bi-currency-exchange me-2"></i>
                SplitAjah
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav align-items-center">
                    <!-- Language Switcher -->
                    <li class="nav-item d-flex align-items-center me-3">
                        <a href="{{ route('lang.switch', 'en') }}" 
                           class="language-badge text-decoration-none {{ app()->getLocale() == 'en' ? 'active' : '' }}">
                            EN
                        </a>
                        <span class="mx-1 text-white">/</span>
                        <a href="{{ route('lang.switch', 'id') }}" 
                           class="language-badge text-decoration-none {{ app()->getLocale() == 'id' ? 'active' : '' }}">
                            ID
                        </a>
                    </li>

                    <!-- Dark Mode Toggle -->
                    <li class="nav-item me-3">
                        <button id="darkModeToggle" class="btn btn-outline-light btn-sm">
                            <i class="bi bi-moon-stars"></i>
                        </button>
                    </li>

                    <!-- User Dropdown -->
                    <li class="nav-item dropdown ms-3">
                        <a class="nav-link dropdown-toggle text-white" href="#" role="button" 
                           id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false" 
                           style="text-decoration: none; display: flex; align-items: center;">
                            <i class="bi bi-person-circle me-1"></i>
                            <span>{{ Auth::user()->name }}</span>
                        </a>
                        
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item">
                                        <i class="bi bi-box-arrow-right me-2"></i>{{ __('Log Out') }}
                                    </button>
                                </form>
                            </li>
                        </ul>   
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    @endauth

    <!-- Main Content -->
    <main class="flex-grow py-4 py-md-5">
        <div class="container">
            @yield('content')
        </div>
    </main>

    <!-- Footer -->
    <footer class="footer mt-auto">
        <div class="container text-center">
            &copy; {{ date('Y') }} SplitAjah. {{ __('All rights reserved.') }}
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Dark Mode Logic -->
    <script>
        // Initialize dark mode
        const isDarkMode = localStorage.getItem('dark_mode') === 'true' || 
                          (!localStorage.getItem('dark_mode') && window.matchMedia('(prefers-color-scheme: dark)').matches);
        if (isDarkMode) {
            document.documentElement.classList.add('dark');
        }
        localStorage.setItem('dark_mode', isDarkMode);

        // Toggle dark mode
        document.getElementById('darkModeToggle').addEventListener('click', () => {
            const isDark = document.documentElement.classList.toggle('dark');
            localStorage.setItem('dark_mode', isDark);
            document.getElementById('darkModeToggle').innerHTML = 
                isDark ? '<i class="bi bi-sun-fill"></i>' : '<i class="bi bi-moon-stars"></i>';
        });

        // Set initial icon
        document.getElementById('darkModeToggle').innerHTML = 
            isDarkMode ? '<i class="bi bi-sun-fill"></i>' : '<i class="bi bi-moon-stars"></i>';
    </script>
</body>
</html>