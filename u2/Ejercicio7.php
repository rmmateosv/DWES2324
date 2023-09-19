<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        $n1 = rand(1,10);
        $n2 = rand(1,10);
        $n3 = rand(1,10);
        echo "Números generados $n1, $n2, $n3";
        //Odenar los dos primeros números        
        if($n1>$n2){
            $primero=$n2;
            $segundo=$n1;
            $tercero=$n3;            
        }        
        else{            
            $primero=$n1;
            $segundo=$n2;
            $tercero=$n3; 
        }
        //Ordenar segundo y tercero
        if($segundo>$tercero)
        {
            $aux=$segundo;
            $segundo=$tercero;
            $tercero=$aux;
        }
        //Ordernar primero y segundo
        if($segundo<$primero){
            $aux=$primero;
            $primero=$segundo;
            $segundo=$aux;
        }
        echo "<br/>Números ordenados $primero, $segundo, $tercero";
    ?>
</body>
</html>