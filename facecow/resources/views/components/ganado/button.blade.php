@props([
    'style' => 'primary', // primary, secondary, neutral, danger, success, warning, info
    'type' => 'button',
    'size' => 'md',      // sm, md, lg
    'outline' => false,
    'icon' => null,
    'href' => null
])

@php
    // Generar clases CSS según el estilo y tamaño
    $styleClass = match($style) {
        'primary' => 'btn-ganado-primary',
        'secondary' => 'btn-ganado-secondary',
        'neutral' => 'btn-ganado-neutral',
        'danger' => 'btn-ganado-danger',
        'success' => 'btn-ganado-secondary', // Montaña es verde / success
        'warning' => 'btn-warning text-dark',
        'info' => 'btn-info text-white',
        default => 'btn-ganado-primary'
    };

    $sizeClass = match($size) {
        'sm' => 'btn-sm py-1 px-3 fs-7',
        'lg' => 'btn-lg py-3 px-5 fs-5',
        default => 'py-2 px-4'
    };

    $classes = "btn-ganado {$styleClass} {$sizeClass} " . ($attributes->get('class') ?? '');
@endphp

@if($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>
        @if($icon)
            <i class="{{ $icon }}"></i>
        @endif
        <span>{{ $slot }}</span>
    </a>
@else
    <button type="{{ $type }}" {{ $attributes->merge(['class' => $classes]) }}>
        @if($icon)
            <i class="{{ $icon }}"></i>
        @endif
        <span>{{ $slot }}</span>
    </button>
@endif
