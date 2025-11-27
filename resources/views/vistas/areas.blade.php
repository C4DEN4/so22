<x-app-layout>
    @include('head')
    @include('sc')

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1 class="text-center">Registro áreas</h1>

                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Close"></button>
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

                    <button type="button" class="btn btn-success" data-bs-toggle="modal"
                        data-bs-target="#createAreaModal">
                        <i class="fas fa-plus"></i> Crear Área
                    </button>

                    <div class="modal fade" id="createAreaModal" tabindex="-1" aria-labelledby="createAreaModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="createAreaModalLabel">Registrar área</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" action="{{ route('areas.store') }}">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="nombre_create" class="form-label">Nombre</label>
                                            <input type="text" name="nombre" class="form-control"
                                                placeholder="Ingrese nombre del área" required
                                                value="{{ old('nombre') }}">
                                        </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger"
                                        data-bs-dismiss="modal">Cerrar</button>
                                    <button type="submit" class="btn btn-primary">Guardar</button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <table id="example" class="display">
                        <thead>
                            <tr >
                                <th class="text-center">Nombre</th>
                                <th class="text-center">Acciones</th>
                            </tr> 
                        </thead>
                        <tbody>
                            @foreach ($areas as $area)
                                <tr class="text-center">
                                    <td>{{ $area->nombre }}</td>
                                    <td>
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#editAreaModal{{ $area->id }}">
                                            Editar
                                        </button>
                                        {{-- Eliminar --}}
                                        <form action="{{ route('area.destroy', $area->id) }}" method="POST"
                                            style="display:inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">
                                                Eliminar
                                            </button>
                                        </form>
                                    </td>
                                </tr>

                                <div class="modal fade" id="editAreaModal{{ $area->id }}" tabindex="-1"
                                    aria-labelledby="editAreaModalLabel{{ $area->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5"
                                                    id="editAreaModalLabel{{ $area->id }}">Editar área:
                                                    {{ $area->nombre }}</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form method="POST" action="{{ route('areas.update', $area) }}">
                                                    @csrf
                                                    @method('PATCH') <div class="mb-3">
                                                        <label for="nombre_edit{{ $area->id }}"
                                                            class="form-label">Nombre</label>
                                                        <input type="text" name="nombre" class="form-control"
                                                            value="{{ $area->nombre }}" required>
                                                    </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger"
                                                    data-bs-dismiss="modal">Cerrar</button>
                                                <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @if ($errors->any() && session('open_create_modal'))
        <script>
            var createModal = new bootstrap.Modal(document.getElementById('createAreaModal'));
            createModal.show();
        </script>
    @endif
</x-app-layout>
