@props([
    'src',
    'alt' => '',
    'rounded' => true,
    'aspect' => 'auto' // video, square, 4-3, auto
])

@php
    $aspectClass = match($aspect) {
        'video' => 'ratio ratio-16x9',
        'square' => 'ratio ratio-1x1',
        '4-3' => 'ratio ratio-4x3',
        default => ''
    };
    
    $imgClass = "img-fluid " . ($rounded ? 'rounded-3' : '') . " " . ($attributes->get('class') ?? '');
@endphp

@if($aspect !== 'auto')
    <div class="{{ $aspectClass }} glass-card p-1 overflow-hidden" style="border-radius: 16px;">
        <img src="{{ $src }}" alt="{{ $alt }}" class="{{ $imgClass }} object-fit-cover w-100 h-100" style="border-radius: 12px;" />
    </div>
@else
    <div class="glass-card p-1 d-inline-block overflow-hidden" style="border-radius: 16px;">
        <img src="{{ $src }}" alt="{{ $alt }}" class="{{ $imgClass }}" style="border-radius: 12px; max-width: 100%; height: auto;" />
    </div>
@endif
