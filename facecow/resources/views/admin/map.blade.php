<x-layouts.admin>
    <x-slot name="header">
        {{ __('Geolocation Map') }}
    </x-slot>

    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />

    <!-- Main Container Grid -->
    <div class="row g-4">
        <!-- Mapa Satelital -->
        <div class="col-lg-9 col-md-8">
            <x-ganado.card title="{{ __('Monitorea tu ganado en tiempo real') }}" subtitle="{{ __('Visualiza la localización activa del hato mediante collares satelitales GPS.') }}" icon="bi bi-compass" class="h-100 p-3">
                <!-- Leaflet Map Container -->
                <div id="map" class="rounded-3 shadow-inner" style="height: 500px; border: 1px solid var(--border-color); z-index: 1;"></div>
            </x-ganado.card>
        </div>

        <!-- Sidebar del mapa -->
        <div class="col-lg-3 col-md-4">
            <x-ganado.card title="{{ __('Active Collars') }}" subtitle="{{ __('Lista de localizadores activos') }}" icon="bi bi-broadcast-pin" class="h-100 p-3">
                <div class="d-flex flex-column gap-2 overflow-y-auto" style="max-height: 440px; padding-right: 5px;" id="cattle-list-container">
                    @foreach($cattles as $cattle)
                        <div class="glass-card p-3 d-flex align-items-center justify-content-between border border-light border-opacity-10 cursor-pointer hover-effect" 
                             style="border-radius: 12px; transition: all 0.2s;"
                             onclick="zoomToCattle({{ $cattle->latitude }}, {{ $cattle->longitude }}, '{{ $cattle->arete }}')">
                            <div>
                                <h6 class="m-0 text-primary-custom" style="font-weight: 700;">{{ $cattle->arete }}</h6>
                                <small class="text-secondary-custom d-block">{{ $cattle->breed }}</small>
                                <small class="text-muted-custom" style="font-size: 0.75rem;">GPS: {{ round($cattle->latitude, 4) }}, {{ round($cattle->longitude, 4) }}</small>
                            </div>
                            <div>
                                @if($cattle->health_status === 'Excelente' || $cattle->health_status === 'Bueno')
                                    <span class="badge bg-success" style="border-radius: 50%; width: 10px; height: 10px; padding: 0; display: inline-block;"></span>
                                @else
                                    <span class="badge bg-warning" style="border-radius: 50%; width: 10px; height: 10px; padding: 0; display: inline-block;"></span>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </x-ganado.card>
        </div>
    </div>

    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    
    <script>
        let map;
        let markers = {};

        document.addEventListener('DOMContentLoaded', () => {
            // Inicializar mapa centrado en Nicaragua
            map = L.map('map').setView([12.1150, -86.2362], 10);

            // Cargar capa del mapa (voyager tiles claros de CartoDB)
            const isDarkMode = document.documentElement.getAttribute('data-mode') === 'dark';
            const lightTiles = 'https://{s}.basemaps.cartocdn.com/rastertiles/voyager/{z}/{x}/{y}{r}.png';
            const darkTiles = 'https://{s}.basemaps.cartocdn.com/dark_all/{z}/{x}/{y}{r}.png';

            const tileLayer = L.tileLayer(isDarkMode ? darkTiles : lightTiles, {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors &copy; <a href="https://carto.com/attributions">CARTO</a>',
                subdomains: 'abcd',
                maxZoom: 20
            }).addTo(map);

            // Observar cambios en el tema para cambiar las baldosas del mapa
            const observer = new MutationObserver((mutations) => {
                mutations.forEach((mutation) => {
                    if (mutation.attributeName === 'data-mode') {
                        const newDark = document.documentElement.getAttribute('data-mode') === 'dark';
                        tileLayer.setUrl(newDark ? darkTiles : lightTiles);
                    }
                });
            });
            observer.observe(document.documentElement, { attributes: true });

            // Cargar pines de ganado
            const cattleData = @json($cattles);
            
            // Iconos personalizados con colores de la paleta
            const greenIcon = L.divIcon({
                className: 'custom-div-icon',
                html: '<div style="background-color: #02f202; width: 18px; height: 18px; border-radius: 50%; border: 3px solid white; box-shadow: 0 0 12px #02f202;"></div>',
                iconSize: [18, 18],
                iconAnchor: [9, 9]
            });

            const warningIcon = L.divIcon({
                className: 'custom-div-icon',
                html: '<div style="background-color: #f59e0b; width: 18px; height: 18px; border-radius: 50%; border: 3px solid white; box-shadow: 0 0 12px #f59e0b;"></div>',
                iconSize: [18, 18],
                iconAnchor: [9, 9]
            });

            cattleData.forEach(cattle => {
                const isHealthy = cattle.health_status === 'Excelente' || cattle.health_status === 'Bueno';
                const marker = L.marker([cattle.latitude, cattle.longitude], {
                    icon: isHealthy ? greenIcon : warningIcon
                }).addTo(map);

                const popupContent = `
                    <div style="font-family: 'Outfit', sans-serif;">
                        <h6 style="font-weight: 700; margin: 0 0 5px 0; color: #10506e;">${cattle.arete}</h6>
                        <p style="margin: 0; font-size: 0.85rem;"><strong>Raza:</strong> ${cattle.breed}</p>
                        <p style="margin: 0; font-size: 0.85rem;"><strong>Salud:</strong> ${cattle.health_status}</p>
                        <p style="margin: 0; font-size: 0.85rem;"><strong>Origen:</strong> ${cattle.origin}</p>
                    </div>
                `;
                marker.bindPopup(popupContent);
                markers[cattle.arete] = marker;
            });
            
            // Si hay marcadores, ajustar la vista del mapa para contenerlos a todos
            if (cattleData.length > 0) {
                const group = new L.featureGroup(cattleData.map(c => L.marker([c.latitude, c.longitude])));
                map.fitBounds(group.getBounds().pad(0.1));
            }
        });

        // Zoom suave al hacer clic en la barra lateral
        function zoomToCattle(lat, lng, arete) {
            if (map && markers[arete]) {
                map.setView([lat, lng], 15, { animate: true, duration: 1 });
                markers[arete].openPopup();
            }
        }
    </script>
    
    <style>
        .hover-effect:hover {
            transform: scale(1.02);
            background: rgba(31, 159, 220, 0.15) !important;
        }
        .cursor-pointer {
            cursor: pointer;
        }
    </style>
</x-layouts.admin>
