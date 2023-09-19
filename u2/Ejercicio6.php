<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    $n1 = rand(0,10);
    $n2 = rand(0,10);
    echo '<p style="color:blue">
    Número 1: '.$n1.
    '<br/>Número 2: '.$n2.'</p>';
    if(is_int($n1) and is_int($n2)){
        if($n2==0){
            echo '<p style="color:red">Error, división por 0</p>';
        }
        else{
            echo '<p style="color:green">La suma de '.$n1.'+'.$n2.' es '.$n1+$n2.'</p>';
            echo '<p style="color:green">La resta de '.$n1.'-'.$n2.' es '.$n1-$n2.'</p>';
            echo '<p style="color:green">La multiplicación de '.$n1.'*'.$n2.' es '.$n1*$n2.'</p>';
            echo '<p style="color:green">La división de '.$n1.'/'.$n2.' es '.$n1/$n2.'</p>';
            echo '<p style="color:green">El resto de '.$n1.'%'.$n2.' es '.$n1%$n2.'</p>';
            echo '<p style="color:green">La potencia de '.$n1.'**'.$n2.' es '.$n1**$n2.'</p>';
        }
    }
    else{
        echo '<p style="color:red">Error, los números no son enteros</p>';
    }
    ?>
</body>
</html>