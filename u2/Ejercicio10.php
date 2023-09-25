<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio10</title>
    <style>
        table{
            
            border-collapse: collapse;
            
        }
        td{
            border: 1px solid black;
            background-color: aquamarine;
            padding: 5px;
            width: 50px;
        }
    </style>
    
</head>
<body>
    <h1>EJERCICIO 10 - ÁLVARO PACHÓN</h1>
    <?php
    $array1 = array('Cougar','Ford','',2500,'V6',182);

    $array2 = array();
    $array2['Modelo']='Cougar';
    $array2['Marca']='Ford';
    $array2['fecha']='';
    $array2['CC']=2500;
    $array2['Motor']='V6';
    $array2['Potencia']=182;
    ?>
    <table>
    <?php
        echo '$array1: ArrayEscalar - Número de elementos: '.sizeof($array1);
        echo '<tr>';
     foreach($array1 as $indice=>$valor){
        
        echo '<td>'.$indice.'<br/>'.$valor.'</td>';
     }
        echo '</tr>';
    ?>
    </table>
    <table>
     <?php
        echo '<br>$array2: ArrayEscalar - Número de elementos: '.sizeof($array2);
        echo '<tr>';
     foreach($array2 as $indice=>$valor){
        
        echo '<td>'.$indice.'<br/>'.$valor.'</td>';
     }
        echo '</tr>';
    ?>
    </table>

</body>
</html>