<x-layouts.admin>
    <x-slot name="header">
        {{ __('Cattle Inventory') }}
    </x-slot>

    <!-- Header Actions Card -->
    <x-ganado.card class="border border-light border-opacity-10 mb-4">
        <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
            <div>
                <h4 class="text-primary-custom m-0" style="font-weight: 700;">{{ __('Inventario de Hato') ? 'Inventario de Hato' : 'Livestock Herd Inventory' }}</h4>
                <small class="text-secondary-custom">{{ __('Administra, registra y controla la trazabilidad de tus reses.') ? 'Administra, registra y controla la trazabilidad de tus reses.' : 'Manage, register and track the traceability of your cattle.' }}</small>
            </div>
            
            <x-ganado.button style="primary" icon="bi bi-plus-circle" onclick="openAddModal()">
                {{ __('Add Cattle') }}
            </x-ganado.button>
        </div>
    </x-ganado.card>

    <!-- DataTable Card -->
    <x-ganado.card class="border border-light border-opacity-10 p-4">
        <div class="table-responsive">
            <table id="cattle-table" class="table table-hover align-middle w-100">
                <thead>
                    <tr>
                        <th>{{ __('Arete/Tag ID') }}</th>
                        <th>{{ __('Breed') }}</th>
                        <th>{{ __('Weight') }} (kg)</th>
                        <th>{{ __('Health Status') }}</th>
                        <th>{{ __('Origin') }}</th>
                        <th class="text-end">{{ __('Actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cattles as $cattle)
                        <tr>
                            <td><strong>{{ $cattle->arete }}</strong></td>
                            <td>{{ $cattle->breed }}</td>
                            <td>{{ number_format($cattle->weight, 2) }} kg</td>
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
                            <td class="text-end">
                                <div class="d-inline-flex gap-2">
                                    <x-ganado.button 
                                        style="neutral" 
                                        size="sm" 
                                        icon="bi bi-pencil" 
                                        onclick="openEditModal({{ json_encode($cattle) }})"
                                    />
                                    
                                    <form id="delete-form-{{ $cattle->id }}" action="{{ route('admin.cattle.destroy', $cattle->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <x-ganado.button 
                                            style="danger" 
                                            size="sm" 
                                            icon="bi bi-trash" 
                                            onclick="confirmDelete({{ $cattle->id }})"
                                        />
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </x-ganado.card>

    <!-- Glassmorphic Bootstrap Modal for Add/Edit -->
    <div class="modal fade" id="cattleModal" tabindex="-1" aria-labelledby="cattleModalLabel" aria-hidden="true" style="backdrop-filter: blur(10px);">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content glass-card p-2 border border-light border-opacity-10 shadow-lg">
                <div class="modal-header border-bottom border-light border-opacity-10 pb-3">
                    <h5 class="modal-title text-primary-custom" id="cattleModalLabel" style="font-weight: 700;">{{ __('Add Cattle') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="filter: var(--bs-color-scheme-dark-filter, none);"></button>
                </div>
                <form id="cattle-form" method="POST" action="">
                    @csrf
                    <div id="method-container"></div> <!-- Se llena con PUT dinámicamente si es edición -->

                    <div class="modal-body py-4">
                        <x-ganado.input 
                            name="arete" 
                            label="{{ __('Arete/Tag ID') }}" 
                            placeholder="FC-123456" 
                            required 
                        />
                        
                        <x-ganado.input 
                            name="breed" 
                            label="{{ __('Breed') }}" 
                            type="select" 
                            placeholder="{{ __('Selecciona la raza') ? 'Selecciona la raza' : 'Select breed' }}" 
                            required
                            :options="[
                                'Brahman' => 'Brahman',
                                'Nelore' => 'Nelore',
                                'Angus' => 'Angus',
                                'Holstein' => 'Holstein',
                                'Pardo Suizo' => 'Pardo Suizo',
                                'Simmental' => 'Simmental',
                                'Gyr' => 'Gyr'
                            ]"
                        />

                        <x-ganado.input 
                            name="weight" 
                            label="{{ __('Weight') }} (kg)" 
                            type="number" 
                            step="0.01" 
                            placeholder="450.00" 
                            required 
                        />

                        <x-ganado.input 
                            name="health_status" 
                            label="{{ __('Health Status') }}" 
                            type="select" 
                            placeholder="{{ __('Selecciona estado') ? 'Selecciona estado' : 'Select health' }}" 
                            required
                            :options="[
                                'Excelente' => 'Excelente',
                                'Bueno' => 'Bueno',
                                'En Tratamiento' => 'En Tratamiento',
                                'Crítico' => 'Crítico'
                            ]"
                        />

                        <x-ganado.input 
                            name="origin" 
                            label="{{ __('Origin') }}" 
                            type="select" 
                            placeholder="{{ __('Selecciona origen') ? 'Selecciona origen' : 'Select origin' }}" 
                            required
                            :options="[
                                'verificado' => __('Verified'),
                                'no verificado' => __('Unverified')
                            ]"
                        />
                    </div>
                    
                    <div class="modal-footer border-top border-light border-opacity-10 pt-3">
                        <x-ganado.button style="neutral" data-bs-dismiss="modal">
                            {{ __('Cancel') }}
                        </x-ganado.button>
                        <x-ganado.button style="primary" type="submit" id="submit-btn">
                            {{ __('Save') }}
                        </x-ganado.button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- DataTables & SweetAlert JS setup -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Inicializar DataTable
            const lang = document.documentElement.lang;
            const table = new DataTable('#cattle-table', {
                responsive: true,
                language: lang === 'es' ? {
                    url: 'https://cdn.datatables.net/plug-ins/1.13.7/i18n/es-ES.json'
                } : {}
            });
        });

        // Modal triggers
        let modalEl;
        let bsModal;

        function getModal() {
            if (!bsModal) {
                modalEl = document.getElementById('cattleModal');
                bsModal = new bootstrap.Modal(modalEl);
            }
            return bsModal;
        }

        function openAddModal() {
            const modal = getModal();
            document.getElementById('cattleModalLabel').textContent = "{{ __('Add Cattle') }}";
            document.getElementById('cattle-form').action = "{{ route('admin.cattle.store') }}";
            document.getElementById('method-container').innerHTML = '';
            
            // Limpiar formulario
            document.getElementById('arete').value = '';
            document.getElementById('breed').value = '';
            document.getElementById('weight').value = '';
            document.getElementById('health_status').value = '';
            document.getElementById('origin').value = '';
            
            modal.show();
        }

        function openEditModal(cattle) {
            const modal = getModal();
            document.getElementById('cattleModalLabel').textContent = "{{ __('Edit Cattle') }}";
            document.getElementById('cattle-form').action = "{{ url('admin/cattle') }}/" + cattle.id;
            document.getElementById('method-container').innerHTML = '<input type="hidden" name="_method" value="PUT">';
            
            // Rellenar formulario
            document.getElementById('arete').value = cattle.arete;
            document.getElementById('breed').value = cattle.breed;
            document.getElementById('weight').value = cattle.weight;
            document.getElementById('health_status').value = cattle.health_status;
            document.getElementById('origin').value = cattle.origin;
            
            modal.show();
        }

        // Confirmación de eliminación con SweetAlert
        function confirmDelete(id) {
            event.preventDefault();
            Swal.fire({
                title: "{{ __('Confirm Delete') }}",
                text: "{{ __('Delete Warning') }}",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc2626', // Danger
                cancelButtonColor: '#545559',  // Neutral
                confirmButtonText: "{{ __('Save') ? 'Sí, eliminar' : 'Yes, delete' }}",
                cancelButtonText: "{{ __('Cancel') }}"
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + id).submit();
                }
            });
        }
    </script>
</x-layouts.admin>
