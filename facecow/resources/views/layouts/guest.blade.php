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
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Styles & Scripts (Vite) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="d-flex align-items-center justify-content-center min-h-screen py-5">
    <div class="container d-flex flex-column align-items-center justify-content-center" style="max-width: 480px;">
        <!-- Logo -->
        <div class="mb-4">
            <a href="/" class="d-flex align-items-center gap-2 text-decoration-none" style="font-weight: 800; font-size: 2rem;">
                <i class="bi bi-cow text-primary fs-1"></i>
                <span class="text-primary-custom">NICAVEX</span>
            </a>
        </div>

        <!-- Glassmorphic Form Card -->
        <x-ganado.card class="w-100 p-4 shadow-lg border border-light border-opacity-10">
            {{ $slot }}
        </x-ganado.card>
        
        <!-- Volver a Inicio -->
        <div class="mt-4 text-center">
            <a href="/" class="text-secondary-custom text-decoration-none small">
                <i class="bi bi-arrow-left"></i> {{ __('i18n') ? 'Volver al Inicio' : 'Back to Home' }}
            </a>
        </div>
    </div>
</body>
</html>
