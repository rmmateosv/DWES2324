<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <table border="1">
   <?php
        for($i=0;$i<10;$i++){
            // Filas impares fondo gris
            if($i%2==1){
                echo '<tr style="background-color:gray;">';
            }
            else{
                echo '<tr>';
            }
            
            for($j=0;$j<10;$j++){
                echo '<td>';
                $prod=$i*$j;                
                echo $prod.'</td>';
            }
            echo '</tr>';
        }
   ?>
   </table>
</body>
</html>