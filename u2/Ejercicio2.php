<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        $entero = 3;
        $decimal = 12.65;
        $cadena = 'Ejercicio 2';
        $booleano = true;
        // Mostrar tipo y valor
        echo 'La variable $entero es de tipo <b>'.gettype($entero).
              '</b> y su valor es '.$entero+'10';
        echo '<br/>La variable $decimal es de tipo <b>'.gettype($decimal).
        '</b> y su valor es '.$decimal;
        echo '<br/>La variable $cadena es de tipo <b>'.gettype($cadena).
              '</b> y su valor es '.$cadena;
        echo '<br/>La variable $booelano es de tipo <b>'.gettype($booleano).
        '</b> y su valor es '.$booleano;

    ?>
</body>
</html>