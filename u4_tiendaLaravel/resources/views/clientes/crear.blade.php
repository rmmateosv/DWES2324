@extends('plantilla/plantilla')

@section('titulo','CREAR CLIENTE')


@section('contenido')
    <form action="{{route('insertarCliente')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="nombre" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" placeholder="email@email.com">
        </div>
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="nombre" placeholder="Nombre">
        </div>
        <div class="mb-3">
            <label for="desc" class="form-label">Dirección</label>
            <input type="text" class="form-control" id="desc" placeholder="Descripción">
        </div>
        <div class="mb-3">
            <label for="desc" class="form-label">Teléfono</label>
            <input type="text" class="form-control" id="desc" placeholder="611111111">
        </div>
        <div class="mb-3">
            <button type="submit" class="btn btn-outline-success">Crear</button>
            <a href="{{route('productos')}}" class="btn btn-outline-success">Cancelar</a>
        </div>
    </form>
@endsection

    
