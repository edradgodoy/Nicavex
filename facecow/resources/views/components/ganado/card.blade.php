@props([
    'title' => null,
    'subtitle' => null,
    'footer' => null,
    'icon' => null
])

<div {{ $attributes->merge(['class' => 'glass-card p-4 mb-4']) }}>
    @if($title || isset($header))
        <div class="card-header-custom border-bottom border-light border-opacity-10 pb-3 mb-3 d-flex align-items-center justify-content-between">
            <div>
                @if($title)
                    <h5 class="m-0 font-weight-bold text-primary-custom d-flex align-items-center gap-2">
                        @if($icon)
                            <i class="{{ $icon }} text-primary"></i>
                        @endif
                        {{ $title }}
                    </h5>
                @endif
                @if($subtitle)
                    <small class="text-secondary-custom">{{ $subtitle }}</small>
                @endif
            </div>
            @if(isset($header))
                <div>
                    {{ $header }}
                </div>
            @endif
        </div>
    @endif

    <div class="card-body-custom">
        {{ $slot }}
    </div>

    @if($footer || isset($footerSlot))
        <div class="card-footer-custom border-top border-light border-opacity-10 pt-3 mt-3">
            @if(isset($footerSlot))
                {{ $footerSlot }}
            @else
                {{ $footer }}
            @endif
        </div>
    @endif
</div>
