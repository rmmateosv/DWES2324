<?php

    echo "<p>Hoy es: ".date('d/m/Y H:i')."</p>";
    echo "<p>Hoy es: ".date('d/m/Y H:i',time())."</p>";
    echo time();
    echo "<p>Ayer fue:".date('d/m/Y H:i',strtotime('2023-09-21'))."</p>";
?>