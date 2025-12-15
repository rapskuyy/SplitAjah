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
        
        /* Base Styles */
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8fafc;
            color: #1e293b;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        
        html.dark body {
            background-color: #0f172a;
            color: #e2e8f0;
        }
        
        /* Navbar Styles */
        .navbar {
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            background: linear-gradient(135deg, var(--splitajah), #4338ca);
        }
        
        html.dark .navbar {
            background: linear-gradient(135deg, #3a3a6e, #2d2d5a);
            box-shadow: 0 2px 15px rgba(0,0,0,0.3);
        }
        
        .navbar-brand, .nav-link {
            color: white !important;
        }
        
        /* Card Styles */
        .card {
            border-radius: 16px;
            box-shadow: 0 6px 16px rgba(0,0,0,0.08);
            border: none;
            background: white;
            color: #1e293b;
        }
        
        html.dark .card {
            background: #1e293b;
            box-shadow: 0 6px 16px rgba(0,0,0,0.3);
            color: #e2e8f0;
            border: 1px solid #334155;
        }
        
        .card-body {
            color: inherit;
        }
        
        .card-header {
            background-color: #f1f5f9;
            color: #1e293b;
            border-color: #e2e8f0;
        }
        
        html.dark .card-header {
            background-color: #334155;
            color: #e2e8f0;
            border-color: #475569;
        }
        
        .card-footer {
            background-color: #f1f5f9;
            color: #64748b;
            border-color: #e2e8f0;
        }
        
        html.dark .card-footer {
            background-color: #334155;
            color: #cbd5e1;
            border-color: #475569;
        }
        
        /* Footer Styles */
        .footer {
            padding: 1.5rem 0;
            background-color: #f1f5f9;
            color: #64748b;
        }
        
        html.dark .footer {
            background-color: #0f172a;
            color: #94a3b8;
        }
        
        /* Language Badge Styles */
        .language-badge {
            font-size: 0.75rem;
            padding: 0.25rem 0.5rem;
            border-radius: 6px;
            background: rgba(255,255,255,0.15);
            color: white;
            transition: all 0.2s ease;
        }
        
        .language-badge.active {
            background: white;
            color: var(--splitajah);
        }
        
        html.dark .language-badge.active {
            background: #334155;
            color: #a5b4fc;
        }
        
        /* Alert Styles */
        .alert {
            border: none;
            border-radius: 8px;
        }
        
        .alert-success {
            background-color: #dbeafe;
            color: #0c4a6e;
            border: 1px solid #7dd3fc;
        }
        
        html.dark .alert-success {
            background-color: #164e63;
            color: #cffafe;
            border: 1px solid #06b6d4;
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
        
        .alert-warning {
            background-color: #fef08a;
            color: #713f12;
            border: 1px solid #facc15;
        }
        
        html.dark .alert-warning {
            background-color: #422006;
            color: #fef08a;
            border: 1px solid #ca8a04;
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
        
        /* Button Styles */
        .btn-primary {
            background-color: var(--splitajah);
            border-color: var(--splitajah);
        }
        
        .btn-primary:hover, .btn-primary:focus {
            background-color: #4338ca;
            border-color: #4338ca;
        }
        
        .btn-outline-primary {
            color: var(--splitajah);
            border-color: var(--splitajah);
        }
        
        .btn-outline-primary:hover {
            background-color: var(--splitajah);
            border-color: var(--splitajah);
            color: white;
        }
        
        html.dark .btn-outline-primary {
            color: #a5b4fc;
            border-color: #a5b4fc;
        }
        
        html.dark .btn-outline-primary:hover {
            background-color: #a5b4fc;
            border-color: #a5b4fc;
            color: #0f172a;
        }
        
        /* Form Input Styles */
        .form-control, .form-select {
            background-color: white;
            color: #1e293b;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
        }
        
        html.dark .form-control, 
        html.dark .form-select {
            background-color: #1e293b;
            color: #e2e8f0;
            border: 1px solid #475569;
        }
        
        .form-control:focus, 
        .form-select:focus {
            background-color: white;
            color: #1e293b;
            border-color: var(--splitajah);
            box-shadow: 0 0 0 0.2rem rgba(79, 70, 229, 0.25);
        }
        
        html.dark .form-control:focus, 
        html.dark .form-select:focus {
            background-color: #1e293b;
            color: #e2e8f0;
            border-color: #a5b4fc;
            box-shadow: 0 0 0 0.2rem rgba(165, 180, 252, 0.25);
        }
        
        /* Label Styles */
        .form-label {
            color: #1e293b;
            font-weight: 500;
        }
        
        html.dark .form-label {
            color: #e2e8f0;
        }
        
        /* Text Muted Styles */
        .text-muted {
            color: #64748b !important;
        }
        
        html.dark .text-muted {
            color: #94a3b8 !important;
        }
        
        /* Dropdown Styles */
        .dropdown-menu {
            background-color: white;
            border: 1px solid #e2e8f0;
        }
        
        html.dark .dropdown-menu {
            background-color: #1e293b;
            border: 1px solid #475569;
        }
        
        .dropdown-item {
            color: #1e293b;
        }
        
        html.dark .dropdown-item {
            color: #e2e8f0;
        }
        
        .dropdown-item:hover, 
        .dropdown-item:focus {
            background-color: #f1f5f9;
            color: #1e293b;
        }
        
        html.dark .dropdown-item:hover, 
        html.dark .dropdown-item:focus {
            background-color: #334155;
            color: #e2e8f0;
        }
        
        .dropdown-divider {
            border-color: #e2e8f0;
        }
        
        html.dark .dropdown-divider {
            border-color: #475569;
        }
        
        /* Badge Styles */
        .badge {
            border-radius: 8px;
            font-weight: 500;
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
        
        /* List Group Styles */
        .list-group-item {
            background-color: white;
            color: #1e293b;
            border-color: #e2e8f0;
        }
        
        html.dark .list-group-item {
            background-color: #334155;
            color: #e2e8f0;
            border-color: #475569;
        }
        
        .list-group-item.active {
            background-color: var(--splitajah);
            border-color: var(--splitajah);
        }
        
        /* Input Group Styles */
        .input-group-text {
            background-color: #f1f5f9;
            color: #1e293b;
            border: 1px solid #e2e8f0;
        }
        
        html.dark .input-group-text {
            background-color: #334155;
            color: #e2e8f0;
            border: 1px solid #475569;
        }
        
        /* Tooltip Styles */
        .tooltip-inner {
            background-color: #1e293b;
            color: white;
        }
        
        html.dark .tooltip-inner {
            background-color: #64748b;
        }
        
        /* Modal Styles */
        .modal-content {
            background-color: white;
            color: #1e293b;
        }
        
        html.dark .modal-content {
            background-color: #1e293b;
            color: #e2e8f0;
        }
        
        .modal-header {
            background-color: white;
            color: #1e293b;
            border-color: #e2e8f0;
        }
        
        html.dark .modal-header {
            background-color: #334155;
            color: #e2e8f0;
            border-color: #475569;
        }
        
        .modal-footer {
            background-color: #f1f5f9;
            border-color: #e2e8f0;
        }
        
        html.dark .modal-footer {
            background-color: #334155;
            border-color: #475569;
        }
        
        /* Pagination Styles */
        .pagination {
            background-color: white;
        }
        
        html.dark .pagination {
            background-color: transparent;
        }
        
        .page-link {
            background-color: white;
            color: var(--splitajah);
            border: 1px solid #e2e8f0;
        }
        
        html.dark .page-link {
            background-color: #334155;
            color: #a5b4fc;
            border: 1px solid #475569;
        }
        
        .page-link:hover {
            background-color: var(--splitajah);
            color: white;
            border-color: var(--splitajah);
        }
        
        html.dark .page-link:hover {
            background-color: #4f46e5;
        }
        
        .page-item.active .page-link {
            background-color: var(--splitajah);
            border-color: var(--splitajah);
        }
        
        /* Placeholder Styles */
        .form-control::placeholder {
            color: #94a3b8;
        }
        
        html.dark .form-control::placeholder {
            color: #64748b;
        }
        
        /* Text Selection Styles */
        ::selection {
            background-color: var(--splitajah);
            color: white;
        }
        
        html.dark ::selection {
            background-color: #a5b4fc;
            color: #1e293b;
        }
        
        /* Invalid Feedback Styles */
        .invalid-feedback {
            color: #dc2626;
        }
        
        html.dark .invalid-feedback {
            color: #f87171;
        }
        
        .is-invalid {
            border-color: #dc2626 !important;
        }
        
        html.dark .is-invalid {
            border-color: #f87171 !important;
        }
        
        /* Breadcrumb Styles */
        .breadcrumb {
            background-color: #f1f5f9;
        }
        
        html.dark .breadcrumb {
            background-color: #334155;
        }
        
        .breadcrumb a {
            color: var(--splitajah);
        }
        
        html.dark .breadcrumb a {
            color: #a5b4fc;
        }
        
        /* Progress Bar Styles */
        .progress {
            background-color: #e2e8f0;
        }
        
        html.dark .progress {
            background-color: #334155;
        }
        
        .progress-bar {
            background-color: var(--splitajah);
        }
        
        /* Accordion Styles */
        .accordion-button {
            background-color: white;
            color: #1e293b;
        }
        
        html.dark .accordion-button {
            background-color: #334155;
            color: #e2e8f0;
        }
        
        .accordion-button:focus {
            background-color: var(--splitajah);
            color: white;
            border-color: var(--splitajah);
            box-shadow: none;
        }
        
        .accordion-body {
            background-color: white;
            color: #1e293b;
        }
        
        html.dark .accordion-body {
            background-color: #1e293b;
            color: #e2e8f0;
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