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

                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="cedulapersona" class="form-label">Cédula</label>
                                            <input type="number" class="form-control"
                                                placeholder="Ingrese número de cédula" id="cedulapersona">
                                        </div>
                                        <div class="mb-3">
                                            <label for="nombrepersona" class="form-label">Nombre</label>
                                            <input type="text" class="form-control" placeholder="Ingrese nombre"
                                                id="nombrepersona">
                                        </div>
                                        <div class="mb-3">
                                            <label for="apellidopersona" class="form-label">Apellido</label>
                                            <input type="text" class="form-control" placeholder="Ingrese apellidoa"
                                                id="apellidopersona">
                                        </div>
                                        <div class="mb-3">
                                            <label for="telefonopersona" class="form-label">Teléfono</label>
                                            <input type="text" class="form-control"
                                                placeholder="Ingrese número de teléfono" id="telefonopersona">
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
                        {{-- Modal Personas --}}

                        <thead> 
                            <tr>
                                <th>Name</th>
                                <th>Position</th>
                                <th>Office</th>
                                <th>Age</th>
                                <th>Start date</th>
                                <th>Salary</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Donna Snider</td>
                                <td>Customer Support</td>
                                <td>New York</td>
                                <td>27</td>
                                <td>2011-01-25</td>
                                <td>$112,000</td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Name</th>
                                <th>Position</th>
                                <th>Office</th>
                                <th>Age</th>
                                <th>Start date</th>
                                <th>Salary</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
