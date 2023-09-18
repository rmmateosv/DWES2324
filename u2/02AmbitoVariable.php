<?php
echo '<h1>VARIABLES LOCALES Y GLOBALES</h1>';
//Declara variable $mascota como global
$mascota = 'Tobby';

//Declara función mostrarMascota
function mostrarMascota(){
    //Definir variable $mascota como local a la función
    $mascota = 'Laia';
    echo '<br/>El valor de la varible $mascota local es:'.$mascota;
    
    //Mostrar la variable global mascota
    global $mascota;
    echo '<br/>El valor de la varible $mascota global es:'.$mascota;
}

// Llamar a al función
mostrarMascota();

echo '<h1>VARIABLES PREDEFINIDAS</h1>';
//Mostrar los tres primeros valores de $_SERVER
echo '<br/>Nombre del servidor de $_SERVER:'.$_SERVER['SERVER_NAME'];
echo '<br/>Puerto de escucha de $_SERVER:'.$_SERVER['SERVER_PORT'];
echo '<br/>Software de $_SERVER:'.$_SERVER['SERVER_SOFTWARE'];

//Mostrar todo el arry $_SERVER
echo '<br/>Contenido de array $_SERVER:';
//var_dump($_SERVER);


// Variables estáticas
echo '<h1>VARIABLES ESTÁTICAS</h1>';
//Declara función que incremente dos contadores, uno estático y otro no
function contadores(){
    $contador1 = 1;
    static $contador2 = 1;

    //Incrementar contadores
    $contador1++;
    $contador2++;

    //Mostrar Contadores
    echo '<br/>El contador1 vale:'.$contador1.' y el contador2 vale:'.$contador2;
}

//Lamar a fucnión contadores
contadores();
contadores();
contadores();

// Variables de variables
echo '<h1>VARIABLES DE VARIABLES</h1>';
$precio=134.78;
$importe='precio';

echo '<br/>El valor de $precio es:'.$precio;
echo '<br/>El valor de importe es:'.$importe. 'y su tipo es '.gettype($importe);
echo '<br/>El valor del valor de $importe es:'
      .$$importe. 'y su tipo es '.gettype($$importe);

echo '<h1>DEFINICIÓN DE CONSTANTES DE USUARIO</h1>';  
const PI=3.14;
define('IVA',0.21);
echo '<br/>Valor de PI:'.PI;    
echo '<br/>Valor de IVA:'.IVA;

echo '<h1>CONSTANTES PREDEFINIDAS</h1>'; 
echo '<br/>Versión de PHP'.PHP_VERSION;
?>