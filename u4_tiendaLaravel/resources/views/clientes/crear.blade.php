@extends('plantilla/plantilla')

@section('titulo','CREAR CLIENTE')


@section('contenido')
    <form action="{{route('insertarCliente')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" name="email" id="email" 
            value="{{old('email')}}" placeholder="email@email.com">
            @error('email')            
            <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" class="form-control" name="nombre" id="nombre" 
            placeholder="Nombre" value="{{old('nombre')}}">
            @error('nombre')            
            <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="desc" class="form-label">Dirección</label>
            <input type="text" class="form-control" name="direccion" id="direccion" 
            placeholder="C\ Palmerass, 5, 10300, Navalmoral de la Mata" 
            value="{{old('dirección')}}">
            @error('direccion')            
            <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="desc" class="form-label">Teléfono</label>
            <input type="text" class="form-control" name="telefono" id="telefono" 
            placeholder="611111111" value="{{old('telefono')}}">
            @error('telefono')            
            <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
        <div class="mb-3">
            <button type="submit" class="btn btn-outline-success">Crear</button>
            <a href="{{route('productos')}}" class="btn btn-outline-success">Cancelar</a>
        </div>
    </form>
@endsection

    
