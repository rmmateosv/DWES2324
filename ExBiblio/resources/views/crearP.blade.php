<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>CREAR PRÉSTAMO</h1>
    <form action="{{route('rutaInsertar')}}" method="post">
        @csrf
        <label for="fecha">Fecha</label><br/>
        @if (old('fecha')!=null)
            <input type="date" name="fecha" value="{{old('fecha')}}"/><br/>    
        @else
            <input type="date" name="fecha" value="{{date('Y-m-d')}}"/><br/>
        @endif
        
        @error('fecha')
        <div>
            Rellena Fecha
        </div>            
        @enderror
        <p/>
        <label for="libro">Libro</label><br/>
        <select name="libro" id="libro">
            @foreach ($libros as $l)
                <option id="{{$l->id}}">{{$l->titulo}}</option>
            @endforeach
        </select>
        @error('libro')
        <div>
            Rellena Libro
        </div>            
        @enderror
        <p/>
        <label for="cliente">Cliente</label><br/>
        <input type="text" name="cliente"/>
        @error('cliente')
        <div>
            Rellena Cliente
        </div>            
        @enderror
        <p/>
        <button type="submit">Crear</button>
        <button type="reset">Limpiar</button>
    </form>
</body>
</html>