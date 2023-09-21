<?php
//DEfinición de array escalar
$persona = array("Ana",23,1.73);

//Mostrar array
echo "<h1>Array persona con función vardump</h1>";
var_dump($persona);

//Acceder por posición a los elementos de un array
echo "<p>";
echo "Elemenos de persona:".$persona[0].",$persona[1]".','.$persona[2];
echo "</p>";

//Mostrar el array con foreach
echo "<h1>Mostrar array con foreach</h1>";
foreach($persona as $valor){
    echo $valor." ";
}

//Mostrar el array con foreach mostrando los índices
echo "<h1>Mostrar array con foreach mostrando los índices</h1>";
foreach($persona as $indice=>$valor){
    echo "Índice: $indice Valor:$valor <br/>";
}

//Crear un array vacío
$mascota = array();

//Asignar valores al array mascota
$mascota[10]='Tobby';
$mascota[100]='Perro';
$mascota[200]='Ana';

echo "<h1>Mostrar macotas con vardump</h1>";
var_dump($mascota);

//Mostrar el array con foreach mostrando los índices
echo "<h1>Mostrar array con foreach mostrando los índices</h1>";
foreach($mascota as $indice=>$valor){
    echo "Índice: $indice Valor:$valor <br/>";
}

//Crear uno nuevo elementos en array mascotas, sin especificar el índice
$mascota[]=5;
echo "<h1>Mostrar macotas con vardump</h1>";
var_dump($mascota);

//Acceder a un elemento cuyo índice no existe
echo "<h1>Mostrar macotas[0]</h1>";
echo "$mascota[0]";

?>