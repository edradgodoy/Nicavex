<x-layouts.web>
    <!-- Section Hero -->
    <section id="hero" class="container py-5">
        <div class="row align-items-center">
            <!-- Texto del Hero -->
            <div class="col-lg-6 mb-5 mb-lg-0">
                <span class="badge badge-neon px-3 py-2 mb-3 text-uppercase">
                    <i class="bi bi-stars"></i> {{ __('i18n') ? 'Nuevo Lanzamiento' : 'New Release' }}
                </span>
                <h1 class="display-3 font-weight-bold text-primary-custom mb-3" style="font-weight: 800; line-height: 1.1;">
                    {{ __('Welcome to SaaS Ganadero') }}
                </h1>
                <p class="lead text-secondary-custom fs-4 mb-4">
                    {{ __('SaaS Ganadero Subtitle') }}
                </p>
                <div class="d-flex gap-3 flex-wrap">
                    <x-ganado.button style="primary" size="lg" href="{{ route('register') }}" icon="bi bi-arrow-right-circle">
                        {{ __('Get Started') }}
                    </x-ganado.button>
                    <x-ganado.button style="neutral" size="lg" href="#features" icon="bi bi-info-circle">
                        {{ __('Features') }}
                    </x-ganado.button>
                </div>
            </div>

            <!-- Visual Mockup Glassmorphic -->
            <div class="col-lg-6">
                <div class="position-relative">
                    <!-- Decoración de fondo gradiente suave -->
                    <div class="position-absolute bg-primary rounded-circle filter-blur" style="width: 250px; height: 250px; top: -50px; left: -50px; filter: blur(80px); opacity: 0.15; z-index: -1;"></div>
                    <div class="position-absolute bg-success rounded-circle filter-blur" style="width: 250px; height: 250px; bottom: -50px; right: -50px; filter: blur(80px); opacity: 0.12; z-index: -1;"></div>

                    <x-ganado.card class="p-4 overflow-hidden border border-light border-opacity-10 shadow-lg">
                        <div class="d-flex align-items-center justify-content-between mb-4 border-bottom border-light border-opacity-10 pb-3">
                            <div class="d-flex align-items-center gap-2">
                                <span class="badge bg-success badge-neon" style="width: 12px; height: 12px; border-radius: 50%; padding: 0;"></span>
                                <span class="small fw-semibold text-primary-custom">Live GPS Map</span>
                            </div>
                            <span class="badge bg-light text-dark py-1 px-2 border border-light border-opacity-10 small rounded-pill">12 Active Collars</span>
                        </div>
                        
                        <!-- Simulación del Mapa de Geolocalización -->
                        <div class="rounded-3 bg-secondary-light position-relative p-5 text-center d-flex align-items-center justify-content-center flex-column" style="height: 250px; border: 1px dashed var(--color-primary-300);">
                            <!-- Círculos de Radar -->
                            <div class="position-absolute border border-primary border-opacity-25 rounded-circle" style="width: 200px; height: 200px;"></div>
                            <div class="position-absolute border border-primary border-opacity-25 rounded-circle" style="width: 100px; height: 100px;"></div>
                            
                            <!-- Pines Simulados -->
                            <div class="position-absolute badge-neon p-2 rounded-circle" style="top: 25%; left: 35%; border: 3px solid var(--bg-body);"><i class="bi bi-cow text-dark"></i></div>
                            <div class="position-absolute badge-neon p-2 rounded-circle" style="bottom: 30%; right: 28%; border: 3px solid var(--bg-body);"><i class="bi bi-cow text-dark"></i></div>
                            
                            <div class="mt-3 position-relative">
                                <h6 class="m-0 text-primary-custom">Finca San Rafael</h6>
                                <small class="text-secondary-custom">Juigalpa, Chontales</small>
                            </div>
                        </div>

                        <!-- Stats inferiores de mockup -->
                        <div class="row g-3 mt-3 pt-3 border-top border-light border-opacity-10 text-center">
                            <div class="col-4">
                                <h5 class="text-primary-custom m-0 fw-bold">98.5%</h5>
                                <small class="text-muted-custom">Verificación</small>
                            </div>
                            <div class="col-4">
                                <h5 class="text-primary-custom m-0 fw-bold">450kg</h5>
                                <small class="text-muted-custom">Peso Promedio</small>
                            </div>
                            <div class="col-4">
                                <h5 class="text-primary-custom m-0 fw-bold">100%</h5>
                                <small class="text-muted-custom">Salud Ok</small>
                            </div>
                        </div>
                    </x-ganado.card>
                </div>
            </div>
        </div>
    </section>

    <!-- Section Features -->
    <section id="features" class="container py-5 my-5">
        <div class="text-center mb-5">
            <h2 class="display-5 text-primary-custom font-weight-bold mb-3" style="font-weight: 800;">
                {{ __('i18n') ? 'Gestión Inteligente' : 'Intelligent Management' }}
            </h2>
            <p class="lead text-secondary-custom col-lg-7 mx-auto">
                {{ __('i18n') ? 'Monitorea cada aspecto de tu hato ganadero desde cualquier dispositivo con herramientas intuitivas de control.' : 'Monitor every aspect of your livestock herd from any device with intuitive control tools.' }}
            </p>
        </div>

        <x-ganado.grid cols="3" gap="4">
            <!-- Card Feature 1 -->
            <div class="col d-flex">
                <x-ganado.card title="Rastreo Satelital" subtitle="Geolocalización GPS" icon="bi bi-geo-alt-fill" class="h-100 w-100 flex-fill mb-0 d-flex flex-column">
                    <p class="text-secondary-custom">
                        {{ __('i18n') ? 'Ubicación en tiempo real de cada animal con cercas virtuales y alertas de comportamiento inusual por GPS.' : 'Real-time location of each animal with geofences and GPS alerts for unusual behavior.' }}
                    </p>
                </x-ganado.card>
            </div>

            <!-- Card Feature 2 -->
            <div class="col d-flex">
                <x-ganado.card title="Origen Verificado" subtitle="Seguridad y Validez" icon="bi bi-shield-check" class="h-100 w-100 flex-fill mb-0 d-flex flex-column">
                    <p class="text-secondary-custom">
                        {{ __('i18n') ? 'Verificación estricta del origen y trazabilidad del animal para garantizar transacciones libres de riesgos o ilegalidad.' : 'Strict verification of origin and traceability to guarantee transactions free of risk or illegality.' }}
                    </p>
                </x-ganado.card>
            </div>

            <!-- Card Feature 3 -->
            <div class="col d-flex">
                <x-ganado.card title="Control de Salud" subtitle="Pesos y Vacunas" icon="bi bi-heart-pulse-fill" class="h-100 w-100 flex-fill mb-0 d-flex flex-column">
                    <p class="text-secondary-custom">
                        {{ __('i18n') ? 'Historial veterinario de vacunación, incrementos de peso y registros sanitarios con reportes exportables automáticos.' : 'Veterinary vaccination records, weight gains, and sanitary logs with automatic exportable reports.' }}
                    </p>
                </x-ganado.card>
            </div>
        </x-ganado.grid>
    </section>

    <!-- Section Pricing -->
    <section id="pricing" class="container py-5 my-5">
        <div class="text-center mb-5">
            <h2 class="display-5 text-primary-custom font-weight-bold mb-3" style="font-weight: 800;">
                {{ __('Pricing') }}
            </h2>
            <p class="lead text-secondary-custom col-lg-7 mx-auto">
                {{ __('i18n') ? 'Escoge el plan idóneo para el tamaño y requerimientos de tu producción agropecuaria.' : 'Choose the ideal plan for the size and requirements of your agricultural production.' }}
            </p>
        </div>

        <x-ganado.grid cols="3" gap="5" class="px-lg-4">
            <!-- Plan Pequeño -->
            <div class="col d-flex">
                <x-ganado.card class="text-center p-4 border border-light border-opacity-10 h-100 w-100 flex-fill mb-0 d-flex flex-column justify-content-between">
                    <div>
                        <h4 class="text-primary-custom font-weight-bold">Familiar</h4>
                        <h1 class="display-4 text-primary-custom my-3" style="font-weight: 800;">$19<span class="fs-6 text-muted-custom">/mo</span></h1>
                        <p class="text-secondary-custom">Hasta 50 cabezas de ganado</p>
                        <hr class="border-light border-opacity-10">
                        <ul class="list-unstyled text-secondary-custom text-start mb-4 px-3">
                            <li class="mb-2"><i class="bi bi-check2 text-success me-2"></i> Inventario Básico</li>
                            <li class="mb-2"><i class="bi bi-check2 text-success me-2"></i> Soporte por Email</li>
                            <li class="mb-2 text-muted-custom text-decoration-line-through"><i class="bi bi-x text-danger me-2"></i> GPS en Vivo</li>
                        </ul>
                    </div>
                    <x-ganado.button style="neutral" class="w-100" href="{{ route('register') }}">
                        {{ __('Get Started') }}
                    </x-ganado.button>
                </x-ganado.card>
            </div>

            <!-- Plan Premium -->
            <div class="col d-flex">
                <x-ganado.card class="text-center p-4 border border-primary border-opacity-25 h-100 w-100 flex-fill mb-0 d-flex flex-column justify-content-between" style="box-shadow: 0 12px 32px rgba(31, 159, 220, 0.15) !important;">
                    <div>
                        <span class="badge badge-neon mb-3 py-2 px-3 text-uppercase">Popular</span>
                        <h4 class="text-primary-custom font-weight-bold">Hacienda</h4>
                        <h1 class="display-4 text-primary-custom my-3" style="font-weight: 800;">$49<span class="fs-6 text-muted-custom">/mo</span></h1>
                        <p class="text-secondary-custom">Hasta 250 cabezas de ganado</p>
                        <hr class="border-light border-opacity-10">
                        <ul class="list-unstyled text-secondary-custom text-start mb-4 px-3">
                            <li class="mb-2"><i class="bi bi-check2 text-success me-2"></i> Inventario Completo</li>
                            <li class="mb-2"><i class="bi bi-check2 text-success me-2"></i> GPS en Vivo (10 Collares)</li>
                            <li class="mb-2"><i class="bi bi-check2 text-success me-2"></i> Soporte 24/7</li>
                        </ul>
                    </div>
                    <x-ganado.button style="primary" class="w-100" href="{{ route('register') }}">
                        {{ __('Get Started') }}
                    </x-ganado.button>
                </x-ganado.card>
            </div>

            <!-- Plan Enterprise -->
            <div class="col d-flex">
                <x-ganado.card class="text-center p-4 border border-light border-opacity-10 h-100 w-100 flex-fill mb-0 d-flex flex-column justify-content-between">
                    <div>
                        <h4 class="text-primary-custom font-weight-bold">Corporación</h4>
                        <h1 class="display-4 text-primary-custom my-3" style="font-weight: 800;">$99<span class="fs-6 text-muted-custom">/mo</span></h1>
                        <p class="text-secondary-custom">Cabezas ilimitadas</p>
                        <hr class="border-light border-opacity-10">
                        <ul class="list-unstyled text-secondary-custom text-start mb-4 px-3">
                            <li class="mb-2"><i class="bi bi-check2 text-success me-2"></i> Todo el inventario</li>
                            <li class="mb-2"><i class="bi bi-check2 text-success me-2"></i> GPS Ilimitado</li>
                            <li class="mb-2"><i class="bi bi-check2 text-success me-2"></i> API Acceso Directo</li>
                        </ul>
                    </div>
                    <x-ganado.button style="neutral" class="w-100" href="{{ route('register') }}">
                        {{ __('Get Started') }}
                    </x-ganado.button>
                </x-ganado.card>
            </div>
        </x-ganado.grid>
    </section>
</x-layouts.web>
