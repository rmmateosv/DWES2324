<?php
include '08f1.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        //Mostrar una variable definida en f1.php
        echo $texto;
        //Incluir código de f2.php (muestra un texto)
        require '08f2.php';

        //Se permite llamarlo más de una vez
        require '08f2.php';

        //Genera un warning
        include '08f3.php';
        //Genera un error
        require '08f3.php';
    ?>
</body>
</html>