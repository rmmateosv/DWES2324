<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>PRÉSTAMOS</h1>
    <a href="{{route('rutaCrear')}}">+Nuevo</a>
    <table>
        <tr>
            <th>Id</th>
            <th>Fecha Préstamo</th>
            <th>Título Libro</th>
            <th>Cliente</th>
            <th>Fecha Devolución</th>
            <th>Acciones</th>
        </tr>
        @foreach ($prestamos as $p)
        <tr>
            <th>{{$p->id}}</th>
            <th>{{date('d/m/Y',$p->fecha)}}</th>
            <th>{{$p->libro_id}}</th>
            <th>{{$p->nombreCliente}}</th>
            <th>{{$p->fechaDevolucion}}</th>
            <th>Acciones</th>
        </tr>
        @endforeach
    </table>
</body>
</html>