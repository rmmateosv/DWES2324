<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio11</title>
</head>
<body>
    <h1>EJERCICIO11- ÁLVARO PACHÓN</h1>
    <?php
    
    $array=array();
    
    for($i=0;$i<10;$i++){
        $array[$i]=$i**2;
    }
    foreach($array as $x=>$numeros){
        echo 'x='.$x.' y='.$numeros.'<br>';
    }
    ?>  
</body>
</html>