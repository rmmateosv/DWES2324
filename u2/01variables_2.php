<!-- VAmos a hacer el mismo ejercicio pero con el php dentro del html -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
//Declaración de variables de diferentes tipos
$nombre = 'Rosa';
$edad = 18;
$estatura = 1.60;
$esAlumno = true;
?>
<p>
    Nombre:<?php echo $nombre; ?>
</p>
<p>
    Edad:<?php echo $edad; ?>
</p>
<p>
    Estatura:<?php echo $estatura; ?>
</p>
<p>
    Es Alumno:<?php echo $esAlumno; ?>
</p>

<table border = "1">
    <tr>
        <th>Variable</th>
        <th>Tipo</th>
    </tr>
    <tr>
        <td>Nombre</td>
        <td><?php  echo $nombre; ?></td>
    </tr>
    <tr>
        <td>Variable</td>
        <td><?php  echo $edad; ?></td>
    </tr>
    <tr>
        <td>Variable</td>
        <td><?php  echo $estatura; ?></td>
    </tr>
    <tr>
        <td>Variable</td>
        <td><?php  echo $esAlumno; ?></td>
    </tr>
</table>

</body>
</html>


