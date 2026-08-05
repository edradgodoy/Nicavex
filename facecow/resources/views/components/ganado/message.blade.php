@props([
    'style' => 'info', // success, warning, danger, info
    'dismissible' => true,
    'icon' => null
])

@php
    // Definir estilos de alertas glassmorphic semánticos
    $themeClasses = match($style) {
        'success' => 'border-success text-success bg-success-light',
        'danger' => 'border-danger text-danger bg-danger-light',
        'warning' => 'border-warning text-warning bg-warning-light',
        'info' => 'border-info text-info bg-info-light',
        default => 'border-info text-info bg-info-light'
    };

    $defaultIcon = match($style) {
        'success' => 'bi bi-check-circle-fill',
        'danger' => 'bi bi-exclamation-octagon-fill',
        'warning' => 'bi bi-exclamation-triangle-fill',
        'info' => 'bi bi-info-circle-fill',
        default => 'bi bi-info-circle-fill'
    };

    $classes = "alert glass-card border border-opacity-25 d-flex align-items-center gap-3 p-3 mb-4 {$themeClasses} " . ($attributes->get('class') ?? '');
@endphp

<div {{ $attributes->merge(['class' => $classes]) }} role="alert" style="backdrop-filter: blur(10px); -webkit-backdrop-filter: blur(10px);">
    <i class="{{ $icon ?? $defaultIcon }} fs-4"></i>
    
    <div class="flex-grow-1">
        {{ $slot }}
    </div>

    @if($dismissible)
        <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close" style="filter: var(--bs-color-scheme-dark-filter, none);"></button>
    @endif
</div>
