<x-layouts.admin>
    <x-slot name="header">
        {{ __('Dashboard') }}
    </x-slot>

    <!-- Stats Grid -->
    <x-ganado.grid cols="4" gap="3" class="mb-4">
        <!-- Stat Card 1 -->
        <x-ganado.card class="border border-light border-opacity-10 h-100">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <span class="text-secondary-custom d-block mb-1">{{ __('Total Cattle') }}</span>
                    <h2 class="text-primary-custom m-0" style="font-weight: 800;">{{ $totalCattle }}</h2>
                </div>
                <div class="p-3 bg-primary-light rounded-circle" style="background: rgba(31, 159, 220, 0.1);">
                    <i class="bi bi-cow text-primary fs-3"></i>
                </div>
            </div>
        </x-ganado.card>

        <!-- Stat Card 2 -->
        <x-ganado.card class="border border-light border-opacity-10 h-100">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <span class="text-secondary-custom d-block mb-1">{{ __('Active Trackers') }}</span>
                    <h2 class="text-primary-custom m-0" style="font-weight: 800;">{{ $activeGPS }}</h2>
                </div>
                <div class="p-3 bg-info-light rounded-circle" style="background: rgba(0, 176, 232, 0.1);">
                    <i class="bi bi-geo-alt-fill text-info fs-3"></i>
                </div>
            </div>
        </x-ganado.card>

        <!-- Stat Card 3 -->
        <x-ganado.card class="border border-light border-opacity-10 h-100">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <span class="text-secondary-custom d-block mb-1">{{ __('Pending Health Checks') }}</span>
                    <h2 class="text-primary-custom m-0" style="font-weight: 800;">{{ $pendingChecks }}</h2>
                </div>
                <div class="p-3 bg-danger-light rounded-circle" style="background: rgba(220, 38, 38, 0.1);">
                    <i class="bi bi-heart-pulse-fill text-danger fs-3"></i>
                </div>
            </div>
        </x-ganado.card>

        <!-- Stat Card 4 -->
        <x-ganado.card class="border border-light border-opacity-10 h-100">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <span class="text-secondary-custom d-block mb-1">{{ __('Verified Origin Transactions') }}</span>
                    <h2 class="text-primary-custom m-0" style="font-weight: 800;">{{ $verifiedPercent }}%</h2>
                </div>
                <div class="p-3 bg-secondary-light rounded-circle" style="background: rgba(10, 107, 10, 0.1);">
                    <i class="bi bi-shield-check text-success fs-3"></i>
                </div>
            </div>
        </x-ganado.card>
    </x-ganado.grid>

    <div class="row g-4">
        <!-- Mapa GPS rápido -->
        <div class="col-lg-6">
            <x-ganado.card title="{{ __('Geolocation Map') }}" subtitle="{{ __('Fincas activas y monitoreo satelital') }}" icon="bi bi-map-fill" class="h-100">
                <div class="rounded-3 bg-secondary-light position-relative p-5 text-center d-flex align-items-center justify-content-center flex-column" style="height: 300px; border: 1px dashed var(--color-primary-300);">
                    <!-- Círculos de Radar -->
                    <div class="position-absolute border border-primary border-opacity-25 rounded-circle" style="width: 250px; height: 250px;"></div>
                    <div class="position-absolute border border-primary border-opacity-25 rounded-circle" style="width: 150px; height: 150px;"></div>
                    
                    <!-- Pines Simulados -->
                    <div class="position-absolute badge-neon p-2 rounded-circle" style="top: 30%; left: 40%; border: 3px solid var(--bg-body);"><i class="bi bi-cow text-dark"></i></div>
                    <div class="position-absolute badge-neon p-2 rounded-circle" style="bottom: 35%; right: 30%; border: 3px solid var(--bg-body);"><i class="bi bi-cow text-dark"></i></div>
                    
                    <div class="position-relative mt-3">
                        <x-ganado.button style="primary" size="sm" href="{{ route('admin.map') }}" icon="bi bi-fullscreen">
                            {{ __('Ver Mapa Completo') ? 'Ver Mapa Completo' : 'View Full Map' }}
                        </x-ganado.button>
                    </div>
                </div>
            </x-ganado.card>
        </div>

        <!-- Historial reciente -->
        <div class="col-lg-6">
            <x-ganado.card title="{{ __('Recent Cattle Activity') }}" subtitle="{{ __('Últimas incorporaciones al hato') }}" icon="bi bi-activity" class="h-100">
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead>
                            <tr>
                                <th>{{ __('Arete/Tag ID') }}</th>
                                <th>{{ __('Breed') }}</th>
                                <th>{{ __('Health Status') }}</th>
                                <th>{{ __('Origin') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentCattle as $cattle)
                                <tr>
                                    <td><strong>{{ $cattle->arete }}</strong></td>
                                    <td>{{ $cattle->breed }}</td>
                                    <td>
                                        @php
                                            $badgeClass = match($cattle->health_status) {
                                                'Excelente' => 'bg-success text-white',
                                                'Bueno' => 'bg-info text-white',
                                                'En Tratamiento' => 'bg-warning text-dark',
                                                'Crítico' => 'bg-danger text-white',
                                                default => 'bg-secondary text-white'
                                            };
                                        @endphp
                                        <span class="badge {{ $badgeClass }}">{{ $cattle->health_status }}</span>
                                    </td>
                                    <td>
                                        @if($cattle->origin === 'verificado')
                                            <span class="badge badge-neon text-dark">
                                                <i class="bi bi-shield-fill-check"></i> {{ __('Verified') }}
                                            </span>
                                        @else
                                            <span class="badge bg-danger bg-opacity-10 text-danger border border-danger border-opacity-25">
                                                <i class="bi bi-shield-fill-x"></i> {{ __('Unverified') }}
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center text-secondary-custom py-4">
                                        {{ __('No hay registros disponibles.') }}
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </x-ganado.card>
        </div>
    </div>
</x-layouts.admin>
