<x-app-layout>
    @include('head')
    @include('sc')

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1 class="text-center">Registra personas</h1>
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
                                    <li>{{ 'Cédula ya registrada, no es posible actualizar.' }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <button type="button" class="btn btn-success" data-bs-toggle="modal"
                        data-bs-target="#createPersonaModal">
                        <i class="fas fa-plus"></i> Crear Persona
                    </button>

                    {{-- Modal Crear Persona (ID cambiado a createPersonaModal) --}}
                    <div class="modal fade" id="createPersonaModal" tabindex="-1" aria-labelledby="createPersonaModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="createPersonaModalLabel">Registrar Persona</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" action="{{ route('personas.store') }}">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="cedula" class="form-label">Cédula</label>
                                            <input type="number" name="cedula" class="form-control" placeholder="Ingrese número de cédula" required value="{{ old('cedula') }}">
                                        </div>
                                        <div class="mb-3">
                                            <label for="nombre" class="form-label">Nombre</label>
                                            <input type="text" name="nombre" class="form-control" placeholder="Ingrese nombre" required value="{{ old('nombre') }}">
                                        </div>
                                        <div class="mb-3">
                                            <label for="apellido" class="form-label">Apellido</label>
                                            <input type="text" name="apellido" class="form-control" placeholder="Ingrese apellido" required value="{{ old('apellido') }}">
                                        </div>
                                        <div class="mb-3">
                                            <label for="correo" class="form-label">Correo</label>
                                            <input type="email" name="correo" class="form-control" placeholder="Ingrese correo" required value="{{ old('correo') }}">
                                        </div>
                                        <div class="mb-3">
                                            <label for="telefono" class="form-label">Teléfono</label>
                                            <input type="number" name="telefono" class="form-control" placeholder="Ingrese teléfono" required value="{{ old('telefono') }}">
                                        </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                                    <button type="submit" class="btn btn-primary">Guardar</button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>

                   
                    <table id="example" class="display">
                        <thead>
                            <tr> 
                                <th class="text-center">Nombre</th>
                                <th class="text-center">Apellidos</th>
                                <th class="text-center">Cédula</th>
                                <th class="text-center">Correo</th>
                                <th class="text-center">Teléfono</th>
                                <th class="text-center">Acciones</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($personas as $persona)
                                <tr>
                                  
                                    <td class="text-center">{{ $persona->nombre }} </td>
                                    <td class="text-center">{{ $persona->apellido }} </td>
                                    <td class="text-center">{{ $persona->cedula }}</td>
                                    <td class="text-center">{{ $persona->correo }}</td>
                                    <td class="text-center">{{ $persona->numero }}</td>
                                    <td>
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#editPersonaModal{{ $persona->cedula }}">
                                            Editar
                                        </button>
                                        
                                       
                                         <form action="{{ route('personas.destroy', $persona->cedula) }}" method="POST"
                                            style="display:inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">
                                                Eliminar
                                            </button>
                                        </form>
                                             
                                      
                                    </td>
                                </tr>

                                {{-- Modal de Edición --}}
                                <div class="modal fade" id="editPersonaModal{{ $persona->cedula }}" tabindex="-1" aria-labelledby="editPersonaModalLabel{{ $persona->cedula }}"
                                    aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="editPersonaModalLabel{{ $persona->cedula }}">Editar Persona: {{ $persona->cedula }}</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form method="POST" action="{{ route('personas.update', $persona->cedula) }}">
                                                    @csrf
                                                    @method('PATCH')
                                                    <div class="mb-3">
                                                        <label for="cedula_edit" class="form-label">Cédula</label>
                                                        <input type="number" name="cedula"required class="form-control" value="{{ $persona->cedula }}" >
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="nombre_edit" class="form-label">Nombre</label>
                                                        <input type="text" name="nombre" class="form-control" value="{{ $persona->nombre }}" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="apellido_edit" class="form-label">Apellido</label>
                                                        <input type="text" name="apellido" class="form-control" value="{{ $persona->apellido }}" required>
                                                    </div>
                                                    <div class="mb-3">
                                            <label for="correo_edit" class="form-label">Correo</label>
                                            <input type="email" name="correo" class="form-control" placeholder="Ingrese correo" required value="{{ $persona->correo }}">
                                        </div>
                                                    <div class="mb-3">
                                                        <label for="telefono_edit" class="form-label">Teléfono</label>
                                                        <input type="number" required name="telefono" class="form-control" value="{{ $persona->numero }}">
                                                    </div>
                                                    
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
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
    @if ($errors->any() && old('cedula'))
        <script>
            var createModal = new bootstrap.Modal(document.getElementById('createPersonaModal'));
            createModal.show();
        </script>
    @endif
</x-app-layout>