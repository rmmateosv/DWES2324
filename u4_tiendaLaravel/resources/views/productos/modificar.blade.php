@extends('plantilla/plantilla')

@section('titulo','MODIFICAR PRODUCTO '.$p->nombre)

@section('contenido')
    <form action="{{route('actualizarP',$p->id)}}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="id" class="form-label">Id</label>
            <input type="text" class="form-control" name="id" id="id" value="{{$p->id}}" disabled="disabled">
            
        </div>
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" class="form-control" name="nombre" id="nombre" 
            placeholder="Nombre" value="{{$p->nombre}}">
            @error('nombre')            
            <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="desc" class="form-label">Descripción</label>
            <input type="text" class="form-control" name="desc" id="desc" 
                 placeholder="Descripción" value="{{$p->descripcion}}">
            @error('desc')            
                <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="precio" class="form-label">Precio</label>
            <input type="number" class="form-control" name="precio" id="precio" step="0.01"
            value="{{$p->precio}}">
            @error('precio')            
            <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="stock" class="form-label">Stock</label>
            <input type="number" class="form-control" name="stock" id="stock" value="{{$p->stock}}">
            @error('stock')            
            <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="imagen" class="form-label">Imagen</label>
            <img src="{{asset('storage/'.$p->img)}}" width="50px"/>
            <input type="file" class="form-control" name="imagen" id="imagen">
        </div>
        <div class="mb-3">
            <button type="submit" class="btn btn-outline-success">Modificar</button>
            <a href="{{route('productos')}}" class="btn btn-outline-success">Cancelar</a>
        </div>
    </form>
@endsection

    
