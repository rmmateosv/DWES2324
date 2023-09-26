<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        echo '<h1>TRATAMIENTO DE FORMULARIO EJERCICIO 14</h1>';
        //Chequear que todos los campos se han rellenado
        if( empty($_POST['nombre']) or empty($_POST['apellidos']) or 
            empty($_POST['ps']) or empty($_POST['fechaN']) or
            empty($_POST['foto']) or empty($_POST['comentario']) 
            or !isset($_POST['aficc'])){

            echo '<h3 style="color:red;">Debes rellenar todos los campos</h3>';
        }
    ?>
</body>
</html>