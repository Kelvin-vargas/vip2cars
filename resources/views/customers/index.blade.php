@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Lista de Clientes</h1>
    <a href="{{ route('customers.create') }}" class="btn btn-primary">Crear Cliente</a>
    <table class="table mt-3">
        <thead>
            <tr>
                <th>Nombres</th>
                <th>Apellidos</th>
                <th>Nro. Documento</th>
                <th>Correo</th>
                <th>Teléfono</th>
                <th>Direccion</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($customers as $customer)
            <tr>
                <td>{{ $customer->nombres }}</td>
                <td>{{ $customer->apellidos }}</td>
                <td>{{ $customer->DNI }}</td>
                <td>{{ $customer->email }}</td>
                <td>{{ $customer->celular }}</td>
                <td>{{ $customer->direccion }}</td>
                <td>
                    <a href="{{ route('customers.edit', $customer) }}" class="btn btn-warning">Editar</a>
                    <form action="{{ route('customers.destroy', $customer) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" class="text-center">No hay clientes disponibles.</td>
            </tr>
            @endempty
        </tbody>
    </table>

    @include('surveys.survey-modal')

</div>


@endsection