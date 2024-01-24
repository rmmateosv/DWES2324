@extends('plantilla/plantilla')

@section('titulo','CREAR PRODUCTOS')

@section('contenido')
    <form action="{{route('insertarProducto')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" class="form-control" 
            name="nombre" id="nombre" placeholder="Nombre" value="{{old('nombre')}}">
            @error('nombre')            
            <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="desc" class="form-label">Descripción</label>
            <input type="text" class="form-control" name="desc" id="desc" 
            placeholder="Descripción" value="{{old('desc')}}">
            @error('desc')            
                <span class="text-danger">Debes rellenar la descripción</span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="precio" class="form-label">Precio</label>
            <input type="number" class="form-control" name="precio" 
            id="precio" step="0.01" value="{{old('precio')}}">
        </div>
            @error('precio')            
                <span class="text-danger">{{$message}}</span>
            @enderror
        <div class="mb-3">
            <label for="stock" class="form-label">Stock</label>
            <input type="number" class="form-control" name="stock" 
            id="stock" value="{{old('stock')}}">
            @error('stock')            
             <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="imagen" class="form-label">Imagen</label>
            <input type="file" class="form-control" name="imagen" 
            id="imagen">
            @error('imagen')            
                <span class="text-danger">Debes seleccionar una imagen</span>
            @enderror
        </div>
        
        <div class="mb-3">
            <button type="submit" class="btn btn-outline-success">Crear</button>
            <a href="{{route('productos')}}" class="btn btn-outline-success">Cancelar</a>
        </div>
    </form>
@endsection

    
