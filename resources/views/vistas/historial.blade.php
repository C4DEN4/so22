<x-app-layout>
    @include('head')
    @include('sc')

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1 class="text-center">Historial de Ingresos</h1>
                    <table id="example" class="display">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Cédula</th>
                                <th>Área</th>
                                <th>Motivo</th>
                                <th>Fecha y hora de Ingreso</th>
                                <th>Fecha y hora de salida</th>

                                <th>Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- CORRECCIÓN: Iteramos sobre $historial en lugar de $ingresos --}}
                            @foreach($historial as $ingreso)
                                <tr>
                                    <td>{{ $ingreso->persona->nombre }} {{ $ingreso->persona->apellido }}</td>
                                    <td>{{ $ingreso->persona->cedula }}</td>
                                    <td>{{ $ingreso->area->nombre }}</td>
                                    <td>{{ $ingreso->observaciones }}</td>
                                    <td>{{ $ingreso->created_at }}</td>
                                     <td>{{ $ingreso->updated_at }}</td>
                                    <td>
                                        @if ($ingreso->estado == 'ingreso')
                                            <span class="badge text-bg-success">ACTIVO</span>
                                        @else
                                            <span class="badge text-bg-secondary">TERMINADO</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>