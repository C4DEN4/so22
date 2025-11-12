<x-app-layout>
    @include('head')
    @include('sc')

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <table id="example" class="display">
                        <h1 class="text-center">Personas</h1>
                        <button type="button" class="btn btn-success" data-bs-toggle="modal"
                            data-bs-target="#exampleModal">
                            <i class="fas fa-plus"></i>
                        </button>

                        {{-- Modal Crear área --}}
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            {{-- Nodal Personas --}}
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Registrar Persona</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <form action="" method="post">
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="Cédula" class="form-label">Cédula</label>
                                            <input type="number" class="form-control"
                                                placeholder="Ingrese número de cédula" id="Cédula">
                                        </div>
                                        <div class="mb-3">
                                            <label for="Nombre" class="form-label">Nombre</label>
                                            <input type="text" class="form-control" placeholder="Ingrese nombre"
                                                id="Nombre">
                                        </div>
                                        <div class="mb-3">
                                            <label for="apellido" class="form-label">Apellido</label>
                                            <input type="text"  class="form-control" placeholder="Ingrese apellidos"
                                                id="apellidopersona">
                                        </div>
                                        <div class="mb-3">
                                            <label for="correo" class="form-label">Correo</label>
                                            <input type="email" class="form-control" placeholder="Ingrese correo"
                                                id="apellidopersona">
                                        </div>
                                        <div class="mb-3">
                                            <label for="telefono" class="form-label">Teléfono</label>
                                            <input type="number" class="form-control"
                                                placeholder="Ingrese número de teléfono" id="telefono">
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger"
                                            data-bs-dismiss="modal">Cerrar</button>
                                        <button type="button" class="btn btn-primary">Guardar</button>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        {{-- Modal Personas --}}

                        <thead> 
                            <tr>
                                <th>Cédula</th>
                                <th>Nombre</th>
                                <th>Apellido</th>
                                <th>Correo</th>
                                <th>Teléfono</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        </tbody>                     
                    </table>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
