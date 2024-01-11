@extends('plantilla/plantilla')

@section('titulo','PRODUCTOS')

@section('mensaje')
    <h5 class="text-danger">Espacio para mensaje</h3> 
@endsection

@section('contenido')
    <a class="btn btn-outline-success" href="{{route('crearProducto')}}">Crear Producto</a>

    <table class="table table-striped">
        <thead class="table-info">
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Nombre</th>
                <th scope="col">Descripción</th>
                <th scope="col">Precio</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
    </table>
@endsection

    
