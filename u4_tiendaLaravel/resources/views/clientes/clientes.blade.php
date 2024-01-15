@extends('plantilla/plantilla')

@section('titulo','CLIENTES')

@section('mensaje')
<div class="container">
    <h5 class="text-danger">Espacio para mensaje</h3> 
</div>
    
@endsection

@section('contenido')
    
    <a class="btn btn-outline-success" href="{{route('crearCliente')}}">Nuevo</a>

    <table class="table table-striped">
        <thead class="table-info">
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Nombre</th>
                <th scope="col">Dirección</th>
                <th scope="col">Teléfono</th>
                <th scope="col">Email</th>
            </tr>
        </thead>
    </table>
@endsection

    
