<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <title>Planetas</title>
</head>
<body>
    <h1>PLANETAS DEL SISTEMA SOLAR (con arrays) </h1>
    <table border="1">
        <tr>
            <?php
                $planetas = array('Mercurio', 'Venus', 'Tierra','Marte','Júpiter','Saturno',
                                'Urano','Neptuno');
                foreach($planetas as $valor){
                    echo '<td>'.$valor.'</td>';
                }       
            ?>
        </tr>
    </table>
    <h2>Nº de planetas:<?php echo sizeof($planetas); ?></h2>
</body>
</html>