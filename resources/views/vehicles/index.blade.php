@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mb-3">
        <div class="col">
            <h1>Listado de Vehículos</h1>
        </div>
        <div class="col text-end">
            <a href="{{ route('vehicles.create') }}" class="btn btn-primary">Registrar Nuevo Vehículo</a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Placa</th>
                            <th>Marca</th>
                            <th>Modelo</th>
                            <th>Año</th>
                            <th>Cliente</th>
                            <th>DNI Cliente</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($vehicles as $vehicle)
                            <tr>
                                <td>{{ $vehicle->placa }}</td>
                                <td>{{ $vehicle->marca }}</td>
                                <td>{{ $vehicle->modelo }}</td>
                                <td>{{ $vehicle->ano }}</td>
                                <td>{{ $vehicle->customer->nombres }} {{ $vehicle->customer->apellidos }}</td>
                                <td>{{ $vehicle->customer->DNI }}</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('vehicles.edit', $vehicle) }}" 
                                           class="btn btn-warning btn-sm">Editar</a>
                                        <form action="{{ route('vehicles.destroy', $vehicle) }}" 
                                              method="POST" 
                                              style="display: inline-block;"
                                              onsubmit="return confirm('¿Está seguro de eliminar este vehículo?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @include('surveys.survey-modal')

</div>


@endsection