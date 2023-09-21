<?php
//DEfinición de array asociativo
$persona = array('Nombre'=>'Ana','Edad'=>23,'Estatura'=>1.73);

//Mostrar array
echo "<h1>Array persona con función vardump</h1>";
var_dump($persona);

//Acceder al array como si fuera un array escalar
echo "<h1>Acceder a la posición 0 de un array Asociatvo</h1>";
$persona[0];

//Acceder por nombre a los elementos de un array asociativo
echo "<p>";
echo "<h1>Acceder a cada elemento por su clave</h1>";
echo "Nombre:".$persona['Nombre']."<br/>Edad".$persona['Edad'].
     "<br/>Estatura".$persona['Estatura'];
echo "</p>";

//Mostrar el array con foreach
echo "<h1>Mostrar array personas con foreach</h1>";
foreach($persona as $valor){
    echo $valor." ";
}

//Mostrar el array con foreach mostrando los índices
echo "<h1>Mostrar array con foreach mostrando los clave</h1>";
foreach($persona as $indice=>$valor){
    echo "Clave: $indice Valor:$valor <br/>";
}


//Crear un array asociativo vacío
$mascota = array();

//Asignar valores al array mascota
$mascota['nombre']='Tobby';
$mascota['tipo']='Perro';
$mascota['nombrePropietario']='Ana';

echo "<h1>Mostrar macotas con vardump</h1>";
var_dump($mascota);

//Mostrar el array con foreach mostrando las claves
echo "<h1>Mostrar array con foreach mostrando las claves</h1>";
foreach($mascota as $clave=>$valor){
    echo "Clave: $clave Valor:$valor <br/>";
}

//Crear uno nuevo elementos en array mascotas
$mascota['edad']=5;
echo "<h1>Mostrar macotas con vardump</h1>";
var_dump($mascota);

//Mezclar array asociativo y escalar
//Crear un elemento sin especificar la clave
echo "<h1>Mostrar array mascota con posiciones asociativas y escalares</h1>";
$mascota[]=1234;
var_dump($mascota);













?>