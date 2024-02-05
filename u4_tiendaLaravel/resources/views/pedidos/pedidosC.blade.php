@extends('plantilla/plantilla')

@section('titulo','PEDIDOS de '.Auth::user()->name)



@section('contenido')
    <a class="btn btn-outline-success" href="{{route('crearProducto')}}">Nuevo</a>

    <table class="table table-striped">
        <thead class="table-info">
            <tr>
                <th scope="col">Id</th>
                
            </tr>
        </thead>
        <tbody>
            @foreach ($pedidos as $p)
                <tr>
                    <td>{{$p->id}}</td>                    
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection

    
