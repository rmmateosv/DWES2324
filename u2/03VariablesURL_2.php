<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
   $codigo = $_GET['asig'];
   $nombre = $_GET['nombre'];

   echo '<h1>Se ha seleccionado la asignatura '.$codigo.'-'.$nombre.'</h1>';
   ?>
</body>
</html>