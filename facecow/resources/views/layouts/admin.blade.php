<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-mode="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Nicavex Admin') }}</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Styles & Scripts (Vite) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        /* Estructura específica del Admin Layout */
        .wrapper {
            display: flex;
            width: 100%;
            align-items: stretch;
        }

        #sidebar {
            min-width: 260px;
            max-width: 260px;
            min-height: 95vh;
            margin: 15px;
            border-radius: 20px;
            transition: all 0.3s;
        }

        #sidebar.active {
            margin-left: -285px;
        }

        #content {
            width: 100%;
            padding: 20px;
            min-height: 100vh;
            transition: all 0.3s;
        }

        .sidebar-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 20px;
            color: var(--text-secondary);
            text-decoration: none;
            border-radius: 12px;
            font-weight: 500;
            transition: all 0.2s ease;
        }

        .sidebar-link:hover, .sidebar-link.active {
            background: rgba(31, 159, 220, 0.15);
            color: var(--color-primary-600);
            transform: translateX(5px);
        }

        [data-mode="dark"] .sidebar-link:hover, [data-mode="dark"] .sidebar-link.active {
            background: rgba(31, 159, 220, 0.25);
            color: var(--color-primary-300);
        }

        @media (max-width: 768px) {
            #sidebar {
                margin-left: -285px;
            }
            #sidebar.active {
                margin-left: 15px;
                position: fixed;
                z-index: 999;
                height: 95vh;
            }
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <!-- Sidebar -->
        <nav id="sidebar" class="glass-card p-4 d-flex flex-column justify-content-between">
            <div>
                <!-- Brand logo -->
                <div class="d-flex align-items-center gap-2 mb-4 pb-3 border-bottom border-light border-opacity-10">
                    <i class="bi bi-cow text-primary fs-3"></i>
                    <span class="text-primary-custom" style="font-weight: 800; font-size: 1.3rem;">NICAVEX ADMIN</span>
                </div>

                <!-- Navigation links -->
                <div class="d-flex flex-column gap-2">
                    <a href="{{ route('dashboard') }}" class="sidebar-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        <i class="bi bi-grid-1x2-fill"></i>
                        <span>{{ __('Dashboard') }}</span>
                    </a>
                    <a href="{{ route('admin.cattle.index') }}" class="sidebar-link {{ request()->routeIs('admin.cattle.index') ? 'active' : '' }}">
                        <i class="bi bi-list-check"></i>
                        <span>{{ __('Cattle Inventory') }}</span>
                    </a>
                    <a href="{{ route('admin.map') }}" class="sidebar-link {{ request()->routeIs('admin.map') ? 'active' : '' }}">
                        <i class="bi bi-geo-alt-fill"></i>
                        <span>{{ __('Geolocation Map') }}</span>
                    </a>
                </div>
            </div>

            <!-- Sidebar footer / logout -->
            <div class="border-top border-light border-opacity-10 pt-3">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-100 btn btn-ganado-danger d-flex align-items-center justify-content-center gap-2" style="border-radius: 10px;">
                        <i class="bi bi-box-arrow-left"></i>
                        <span>{{ __('Log Out') ? 'Cerrar Sesión' : 'Log Out' }}</span>
                    </button>
                </form>
            </div>
        </nav>

        <!-- Page Content -->
        <div id="content">
            <!-- Header bar -->
            <div class="glass-card p-3 mb-4 d-flex align-items-center justify-content-between" style="border-radius: 16px;">
                <div class="d-flex align-items-center gap-3">
                    <button type="button" id="sidebarCollapse" class="btn btn-ganado-neutral p-2 d-flex align-items-center justify-content-center" style="border-radius: 50%; width: 40px; height: 40px;">
                        <i class="bi bi-list fs-5 text-primary"></i>
                    </button>
                    <h5 class="m-0 text-primary-custom" style="font-weight: 700;">{{ $header ?? __('Dashboard') }}</h5>
                </div>

                <!-- Right items (i18n, dark mode, user info) -->
                <div class="d-flex align-items-center gap-3">
                    <!-- Language selector -->
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

                    <!-- Theme Toggle -->
                    <button class="btn btn-ganado-neutral p-2 d-flex align-items-center justify-content-center" id="theme-toggle" style="border-radius: 50%; width: 40px; height: 40px;">
                        <i class="bi bi-moon-stars-fill text-primary" id="theme-toggle-icon"></i>
                    </button>

                    <!-- User drop down -->
                    <div class="dropdown">
                        <button class="btn btn-ganado-neutral py-2 px-3 dropdown-toggle text-secondary-custom d-flex align-items-center gap-2" type="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false" style="border-radius: 12px;">
                            <i class="bi bi-person-circle text-primary"></i>
                            <span>{{ Auth::user()->name }}</span>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end glass-card p-2 border border-light border-opacity-10" aria-labelledby="userDropdown" style="border-radius: 12px;">
                            <li>
                                <div class="px-3 py-2 text-secondary-custom border-bottom border-light border-opacity-10 mb-2">
                                    <small class="d-block text-muted-custom">{{ __('Rol: Administrador') ? 'Rol: Administrador' : 'Role: Admin' }}</small>
                                    <strong class="text-primary-custom">{{ Auth::user()->email }}</strong>
                                </div>
                            </li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger rounded-2 py-2">
                                        <i class="bi bi-box-arrow-left me-2"></i> {{ __('Log Out') ? 'Cerrar Sesión' : 'Log Out' }}
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Page Alerts -->
            @if(session('success'))
                <x-ganado.message style="success">
                    {{ session('success') }}
                </x-ganado.message>
            @endif

            <!-- Main Render Space -->
            <main>
                {{ $slot }}
            </main>
        </div>
    </div>

    <!-- Toggle sidebar behavior -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const sidebar = document.getElementById('sidebar');
            const collapseBtn = document.getElementById('sidebarCollapse');
            if (collapseBtn && sidebar) {
                collapseBtn.addEventListener('click', () => {
                    sidebar.classList.toggle('active');
                });
            }
        });
    </script>
</body>
</html>
