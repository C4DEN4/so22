<x-app-layout>
    @include('head')
    @include('sc')

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <table id="example" class="display">
                        <h1 class="text-center">Ingresos</h1>
                        <button type="button" class="btn btn-success" data-bs-toggle="modal"
                            data-bs-target="#exampleModal">
                            <i class="fas fa-plus"></i>
                        </button>

                        {{-- Modal Crear ingreso --}}
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            {{-- Nodal ingreso --}}
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Registrar Ingresos</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>

                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="cedulapersona" class="form-label">Cédula</label>
                                            <input type="number" class="form-control"
                                                placeholder="Ingrese número de cédula" id="cedulapersona">
                                        </div>

                                        <div class="mb-3">
                                            <label for="areas">Área</label>
                                            <select class="form-select" id="areas" aria-label="Default select example">
                                                <option selected>Seleccione area</option>
                                                <option value="1">One</option>                                              
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="cedulapersona" class="form-label">Motivo</label>
                                            <input type="number" class="form-control"
                                                placeholder="Ingrese número de cédula" id="cedulapersona">
                                        </div>

                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger"
                                            data-bs-dismiss="modal">Cerrar</button>
                                        <button type="button" class="btn btn-primary">Guardar</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <thead>
                            <tr>
                                <th>Fecha</th>
                                <th>Cédula</th>
                                <th>Nombre</th>
                                <th>Apellido</th>
                                <th>Área</th>
                                <th>Observaciones</th>
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
                                <td></td>
                            </tr>
                        </tbody>
                        
                    </table>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
