<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-mode="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Nicavex') }}</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Styles & Scripts (Vite) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <!-- Navbar Glassmorphic -->
    <nav class="navbar navbar-expand-lg fixed-top glass-card py-3 px-4 mx-3 my-3" style="border-radius: 20px; z-index: 1030;">
        <div class="container-fluid">
            <!-- Brand Logo -->
            <a class="navbar-brand d-flex align-items-center gap-2 font-weight-bold" href="{{ url('/') }}" style="font-weight: 800; font-size: 1.4rem;">
                <i class="bi bi-cow text-primary fs-3"></i>
                <span class="text-primary-custom">NICAVEX</span>
            </a>

            <!-- Toggle mobile -->
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Links collapse -->
            <div class="collapse navbar-collapse" id="navbarContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4 gap-2">
                    <li class="nav-item">
                        <a class="nav-link text-secondary-custom active" href="#hero">{{ __('Home') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-secondary-custom" href="#features">{{ __('Features') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-secondary-custom" href="#pricing">{{ __('Pricing') }}</a>
                    </li>
                </ul>

                <!-- Acciones derecha (i18n, Modo, Auth) -->
                <div class="d-flex align-items-center gap-3 flex-wrap">
                    
                    <!-- Language selector dropdown -->
                    <div class="dropdown">
                        <button class="btn btn-link nav-link dropdown-toggle text-secondary-custom d-flex align-items-center gap-2" type="button" id="langDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-translate"></i>
                            <span class="text-uppercase">{{ app()->getLocale() }}</span>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end glass-card p-2 border border-light border-opacity-10" aria-labelledby="langDropdown" style="border-radius: 12px;">
                            <li>
                                <a class="dropdown-item rounded-2 text-secondary-custom py-2 {{ app()->getLocale() === 'es' ? 'bg-primary text-white' : '' }}" href="{{ url('locale/es') }}">
                                    Español (ES)
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item rounded-2 text-secondary-custom py-2 {{ app()->getLocale() === 'en' ? 'bg-primary text-white' : '' }}" href="{{ url('locale/en') }}">
                                    English (EN)
                                </a>
                            </li>
                        </ul>
                    </div>

                    <!-- Dark Mode Toggle Button -->
                    <button class="btn btn-ganado-neutral p-2 d-flex align-items-center justify-content-center" id="theme-toggle" style="border-radius: 50%; width: 42px; height: 42px;">
                        <i class="bi bi-moon-stars-fill text-primary" id="theme-toggle-icon"></i>
                    </button>

                    <!-- Auth buttons -->
                    @auth
                        <x-ganado.button style="secondary" href="{{ route('dashboard') }}" icon="bi bi-speedometer2">
                            {{ __('Dashboard') }}
                        </x-ganado.button>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-link text-primary-custom text-decoration-none fw-semibold">
                            {{ __('Login') }}
                        </a>
                        <x-ganado.button style="primary" href="{{ route('register') }}" icon="bi bi-person-plus">
                            {{ __('Register') }}
                        </x-ganado.button>
                    @endauth

                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content wrapper -->
    <div style="padding-top: 110px;">
        {{ $slot }}
    </div>

    <!-- Footer Glassmorphic Panel -->
    <footer class="container my-5">
        <div class="glass-card p-5 border border-light border-opacity-10 shadow-lg" style="border-radius: 24px;">
            <div class="row g-4 align-items-center">
                <!-- Branding -->
                <div class="col-lg-5 text-center text-lg-start">
                    <div class="d-inline-flex align-items-center gap-2 mb-3">
                        <i class="bi bi-cow text-primary fs-2"></i>
                        <span class="text-primary-custom font-weight-bold" style="font-weight: 800; font-size: 1.6rem; letter-spacing: 1px;">NICAVEX</span>
                    </div>
                    <p class="text-secondary-custom mb-0 mx-auto mx-lg-0" style="max-width: 380px; font-size: 0.95rem; line-height: 1.6;">
                        {{ __('SaaS Ganadero Subtitle') }}
                    </p>
                </div>
                
                <!-- Quick links -->
                <div class="col-lg-3 text-center col-md-6">
                    <h6 class="text-primary-custom mb-3 text-uppercase font-weight-bold" style="font-size: 0.85rem; letter-spacing: 1.5px;">{{ __('i18n') ? 'Plataforma' : 'Platform' }}</h6>
                    <div class="d-flex flex-column gap-2">
                        <a href="#hero" class="text-secondary-custom text-decoration-none small hover-primary">{{ __('Home') }}</a>
                        <a href="#features" class="text-secondary-custom text-decoration-none small hover-primary">{{ __('Features') }}</a>
                        <a href="#pricing" class="text-secondary-custom text-decoration-none small hover-primary">{{ __('Pricing') }}</a>
                    </div>
                </div>

                <!-- Contact & Socials -->
                <div class="col-lg-4 text-center text-lg-end col-md-6">
                    <h6 class="text-primary-custom mb-3 text-uppercase font-weight-bold" style="font-size: 0.85rem; letter-spacing: 1.5px;">{{ __('Contact') }}</h6>
                    <p class="text-secondary-custom mb-1 small"><i class="bi bi-envelope-fill text-primary me-2"></i>info@nicavex.com</p>
                    <p class="text-secondary-custom mb-3 small"><i class="bi bi-telephone-fill text-primary me-2"></i>+505 8888-8888</p>
                    
                    <div class="d-flex justify-content-center justify-content-lg-end gap-3 mt-2">
                        <a href="#" class="btn btn-ganado-neutral p-0 d-flex align-items-center justify-content-center" style="border-radius: 50%; width: 36px; height: 36px;"><i class="bi bi-facebook fs-6 text-primary"></i></a>
                        <a href="#" class="btn btn-ganado-neutral p-0 d-flex align-items-center justify-content-center" style="border-radius: 50%; width: 36px; height: 36px;"><i class="bi bi-twitter-x fs-6 text-primary"></i></a>
                        <a href="#" class="btn btn-ganado-neutral p-0 d-flex align-items-center justify-content-center" style="border-radius: 50%; width: 36px; height: 36px;"><i class="bi bi-instagram fs-6 text-primary"></i></a>
                    </div>
                </div>
            </div>
            
            <hr class="border-light border-opacity-10 my-4">
            
            <div class="d-flex flex-column flex-md-row align-items-center justify-content-between gap-3 text-secondary-custom small">
                <div>
                    &copy; {{ date('Y') }} Nicavex. Todos los derechos reservados.
                </div>
                <div class="d-flex gap-3">
                    <a href="#" class="text-secondary-custom text-decoration-none small hover-primary">{{ __('i18n') ? 'Términos' : 'Terms' }}</a>
                    <a href="#" class="text-secondary-custom text-decoration-none small hover-primary">{{ __('i18n') ? 'Privacidad' : 'Privacy' }}</a>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>
