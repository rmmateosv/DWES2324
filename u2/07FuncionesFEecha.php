<?php
    // Mostrar fecha actual con formato
    echo "<p>Hoy es: ".date('d/m/Y H:i')."</p>";
     // Mostrar fecha actual con formato pero usando la función time
     // que devuelve el instante actual
    echo "<p>Hoy es: ".date('d/m/Y H:i',time())."</p>";
    //Mostrar lo que devuelve la función time
    //Nº de segundos de 01/01/1970 hasta ahora
    echo '<p>Retorno de la función time:'.time();
    //Convertir una fecha a nº y mostrarla
    echo "<p>Ayer fue:".date('d/m/Y H:i',strtotime('2023-09-21'))."</p>";
    //Sumar 1 día (representado en segundos 24*60*60) a la momento actual(time())
    echo "<p>Mañana es:".date('d/m/Y H:i',time()+(24*60*60))."</p>";
?>