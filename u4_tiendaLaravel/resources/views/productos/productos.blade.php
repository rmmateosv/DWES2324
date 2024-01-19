@extends('plantilla/plantilla')

@section('titulo','PRODUCTOS')



@section('contenido')
    <a class="btn btn-outline-success" href="{{route('crearProducto')}}">Nuevo</a>

    <table class="table table-striped">
        <thead class="table-info">
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Nombre</th>
                <th scope="col">Descripción</th>
                <th scope="col">Precio</th>
                <th scope="col">Stock</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($productos as $p)
                <tr>
                    <td>{{$p->id}}</td>
                    <td>{{$p->nombre}}</td>
                    <td>{{$p->descripcion}}</td>
                    <td>{{$p->precio}}</td>
                    <td>{{$p->stock}}</td>
                    
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection

    
