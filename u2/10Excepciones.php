<?php

function dividir($a, $b){
    return $a/$b;
}

$num1=10;
$num2=0;
//Se produce excepción y no la capturamos - La ejecución para
// echo 'Resultado:'.dividir($num1,$num2);

try{
    echo 'Resultado:'.dividir($num1,$num2);
}
catch (Throwable $e){
    //Capturamos excepción con clase Throwable
    echo 'Error:'.$e->getMessage();
}
echo '<br/>La ejecución continua';
//Capturar con Error
try{
    echo 'Resultado:'.dividir($num1,$num2);
}
catch (Error $e){
    //Capturamos excepción con clase Throwable
    echo '<br/>Error:'.$e->getMessage();
}
echo '<br/>La ejecución continua';

function dividirConExcepcion($a, $b){
    //Comprueba que los tipos de datos son enteros
    //y si no lanza una excepción de tipo Exception
    if(!is_int($a) or !is_int(($b))){
        throw new Exception('Excepción tipos de datos incorrecto');
    }
    return $a/$b;
}

//Capturar las dos exepciones con Throwable
$num1 = 'a';
try{
    echo '<br/>Resultado:'.dividirConExcepcion($num1,$num2);
}
catch (Throwable $e){
    //Capturamos excepción con clase Throwable
    echo '<br/>Error:'.$e->getMessage();
}

//Capturar las dos exepciones con Throwable
try{
    echo '<br/>Resultado:'.dividirConExcepcion($num1,$num2);
}
catch (Error | Exception $e ){
    //Capturamos excepción con clase Throwable
    echo '<br/>Error:'.$e->getMessage();
}

echo '<br/>La ejecución continua';
?>