<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        //Si la cookie está definida mostramos los valores
        //de numAccesos y FechaUA
        if(isset($_COOKIE['numAccesos'])){
            $numAccesos = $_COOKIE['numAccesos'];
            $fechaUA = $_COOKIE['fechaUA'];
        }
        else{
            $numAccesos=1;
            $fechaUA="";
        }
    ?>
        <div>
            <h2>Nº de accesos:<?php echo $numAccesos;?></h2>
            <h2>Fecha Último Acceso:<?php echo $fechaUA;?></h2>
        </div>
    <?php
        //Creamos/Modificamos la cookie Fecha de caducidad en un año
        setcookie("numAccesos",$numAccesos+1,time()+(365*24*60*60));
        setcookie("fechaUA",date('d/m/Y'),time()+(365*24*60*60));
    ?>
</body>
</html>