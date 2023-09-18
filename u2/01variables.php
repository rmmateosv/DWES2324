<?php

//Declaración de variables de diferentes tipos
$nombre = 'Rosa';
$edad = 18;
$estatura = 1.60;
$esAlumno = true;

//Mostrar el valor de las variables
echo 'Nombre:'.$nombre; //Con el . concatenamos
echo "<br/>Edad: $edad"; //Dentro de " podemos usar las variables y se sustiuyen por su valor
echo '<br/>Estatura:'.$estatura;
echo '<br/>Es alumno:'.$esAlumno;

echo '<table border="1">';
echo '<tr><th>Variable</th><th>Tipo</th></tr>';
echo '<tr><td>Nombre</td><td>'.gettype($nombre).'</td></tr>';
echo '<tr><td>Edad</td><td>'.gettype($edad).'</td></tr>';
echo '<tr><td>Estatura</td><td>'.gettype($estatura).'</td></tr>';
echo '<tr><td>Es Alumno</td><td>'.gettype($esAlumno).'</td></tr>';
echo '</table>';
?>