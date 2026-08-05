@props([
    'cols' => '3', // 1, 2, 3, 4
    'gap' => '3'   // spacing gap
])

@php
    $rowColsClass = match($cols) {
        '1' => 'row-cols-1',
        '2' => 'row-cols-1 row-cols-md-2',
        '3' => 'row-cols-1 row-cols-md-3',
        '4' => 'row-cols-1 row-cols-sm-2 row-cols-md-4',
        default => 'row-cols-1 row-cols-md-3'
    };
    
    $gapClass = "g-{$gap}";
    
    $classes = "row {$rowColsClass} {$gapClass} " . ($attributes->get('class') ?? '');
@endphp

<div {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</div>
