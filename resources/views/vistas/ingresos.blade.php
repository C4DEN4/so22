<x-app-layout>
    @include('head')
    @include('sc')

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1 class="text-center">Ingresos</h1>
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <button type="button" class="btn btn-success mb-3" data-bs-toggle="modal"
                        data-bs-target="#createIngresoModal">
                        <i class="fas fa-plus"></i> Registrar Ingreso
                    </button>

                    {{-- Modal Crear ingreso (ID cambiado a createIngresoModal) --}}
                    <div class="modal fade" id="createIngresoModal" tabindex="-1" aria-labelledby="createIngresoModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="createIngresoModalLabel">Registrar Ingreso</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" action="{{ route('ingresos.store') }}">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="personas_cedula" class="form-label">Cédula</label>
                                            <input type="number" name="personas_cedula" class="form-control" placeholder="Ingrese número de cédula (debe estar registrado en Personas)" required value="{{ old('personas_cedula') }}">
                                        </div>
                                        <div class="mb-3">
                                            <label for="area_id" class="form-label">Área de Destino</label>
                                            <select name="area_id" class="form-control" required>
                                                @foreach($areas as $area)
                                                    <option value="{{ $area->id }}" {{ old('area_id') == $area->id ? 'selected' : '' }}>{{ $area->nombre }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="observaciones" class="form-label">Observaciones (Opcional)</label>
                                            <textarea name="observaciones" class="form-control" rows="3">{{ old('observaciones') }}</textarea>
                                        </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                                    <button type="submit" class="btn btn-primary">Guardar Ingreso</button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    {{-- Tabla de Ingresos --}}
                    <table id="example" class="display">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Cédula</th>
                                <th>Área Actual</th>
                                <th>Estado</th>
                                <th>Fecha de Ingreso</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($ingresos as $ingreso)
                                <tr>
                                    <td>{{ $ingreso->persona->nombre }} {{ $ingreso->persona->apellido }}</td>
                                    <td>{{ $ingreso->persona->cedula }}</td>
                                    <td>{{ $ingreso->area->nombre }}</td>
                                    <td>
                                        @if($ingreso->estado == 'ingreso')
                                            <span class="badge text-bg-success">Activo</span>
                                        @else
                                            <span class="badge text-bg-secondary">Terminado</span>
                                        @endif
                                    </td>
                                    <td>{{ $ingreso->created_at->format('Y-m-d H:i') }}</td>
                                    <td>
                                        @if($ingreso->estado == 'ingreso')
                                            <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#editIngresoModal{{ $ingreso->id }}">
                                                Editar Área
                                            </button>
                                            
                                            <form action="{{ route('ingresos.checkout', $ingreso->id) }}" method="POST" style="display:inline;"
                                                onsubmit="return confirm('¿Confirma la salida de {{ $ingreso->persona->nombre }}?');">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="btn btn-danger btn-sm">Salida</button>
                                            </form>
                                        @else
                                            <span class="text-muted">Finalizado</span>
                                        @endif
                                    </td>
                                </tr>
                                
                                {{-- Modal de Edición de Área (Solo si el ingreso está activo) --}}
                                @if($ingreso->estado == 'ingreso')
                                <div class="modal fade" id="editIngresoModal{{ $ingreso->id }}" tabindex="-1" aria-labelledby="editIngresoModalLabel{{ $ingreso->id }}"
                                    aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="editIngresoModalLabel{{ $ingreso->id }}">Editar Área para {{ $ingreso->persona->nombre }}</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form method="POST" action="{{ route('ingresos.update', $ingreso->id) }}">
                                                    @csrf
                                                    @method('PATCH')
                                                    <div class="mb-3">
                                                        <label for="new_area_id" class="form-label">Nueva Área de Destino</label>
                                                        <select name="area_id" class="form-control" required>
                                                            @foreach($areas as $area)
                                                                <option value="{{ $area->id }}" {{ $ingreso->area_id == $area->id ? 'selected' : '' }}>
                                                                    {{ $area->nombre }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                                                <button type="submit" class="btn btn-primary">Actualizar Área</button>
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
    @if ($errors->any() && old('personas_cedula'))
        <script>
            var createModal = new bootstrap.Modal(document.getElementById('createIngresoModal'));
            createModal.show();
        </script>
    @endif
</x-app-layout>