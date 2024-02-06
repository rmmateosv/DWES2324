@extends('plantilla/plantilla')

@section('titulo','PRODUCTOS')



@section('contenido')
    <table class="table table-striped">
        <thead class="table-info">
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Nombre</th>
                <th scope="col">Descripción</th>
                <th scope="col">Precio</th>
                <th scope="col">Stock</th>
                <th scope="col">Foto</th>
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
                    <td><img src="{{asset('storage/'.$p->img)}}" width="50px"/></td>    
                    <td>
                    <form action="{{route('aCarrito')}}" method="post">
                        @csrf
                        <button type="submit" class="btn btn-outline-success" 
                        name="carrito" value="{{$p->id}}">Carrito</button>
                    </form>                  
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection

    
