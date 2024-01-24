@extends('plantilla/plantilla')

@section('titulo','CLIENTES')


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
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($clientes as $c)
                <tr>
                    <td>{{$c->id}}</td>
                    <td>{{$c->nombre}}</td>
                    <td>{{$c->direccion}}</td>
                    <td>{{$c->telefono}}</td>
                    <td>{{$c->email}}</td>                    
                    <td>
                        <a class="btn btn-outline-success" href="{{route('modificarC',$c->id)}}">
                            Modificar</a>
                        <form action="{{route('borrarC',$c->id)}}" method="POST">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="btn btn-outline-danger">Borrar</button>
                        </form>

                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection

    
