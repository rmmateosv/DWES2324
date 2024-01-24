@extends('plantilla/plantilla')

@section('titulo','CREAR CLIENTE')


@section('contenido')
    <form action="{{route('actualizarC',$c->id)}}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="id" class="form-label">Email</label>
            <input type="id" class="form-control" name="id" id="id" 
            value="{{$c->id}}" disabled="disabled">
            <label for="nombre" class="form-label">Email</label>
            <input type="email" class="form-control" name="email" id="email" 
            value="{{$c->email}}" placeholder="email@email.com">
            @error('email')            
            <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" class="form-control" name="nombre" 
            id="nombre" placeholder="Nombre" value="{{$c->nombre}}">
            @error('nombre')            
            <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="desc" class="form-label">Dirección</label>
            <input type="text" class="form-control" name="direccion" id="direccion" 
            value="{{$c->direccion}}">
            @error('direccion')            
            <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="desc" class="form-label">Teléfono</label>
            <input type="text" class="form-control" name="telefono" id="telefono" 
            placeholder="611111111" value="{{$c->telefono}}">
            @error('telefono')            
            <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
        <div class="mb-3">
            <button type="submit" class="btn btn-outline-success">Modificar</button>
            <a href="{{route('productos')}}" class="btn btn-outline-success">Cancelar</a>
        </div>
    </form>
@endsection

    
