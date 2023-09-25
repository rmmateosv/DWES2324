<?php
    function precio_conIva_1(){
        global $precio;

        return $precio*1.21;
    }
?>
<h1>Función con variable globar</h1>
<?php
    $precio=10;
    $precio_iva = precio_conIva_1();
    echo "El precio con IVA es:$precio_iva";

?>
<h1>FUCNIONES CON PARÁMETROS POR VALOR</h1>
<?php
function precio_conIva_2($importe){
    $importe = $importe*1.21;
    echo "<p>Valor de importe dentro de la función:$importe</p>";
}
$imp1=10;
precio_conIva_2($imp1);

echo "<p>Valor de importe después de llamar a la función:$imp1</p>";
?>

<h1>FUCNIONES CON PARÁMETROS POR REFERENCIA</h1>
<?php
function precio_conIva_3(&$importe){
    $importe = $importe*1.21;
    echo "<p>Valor de importe dentro de la función:$importe</p>";
}
$imp2=10;
precio_conIva_3($imp2);

echo "<p>Valor de importe después de llamar a la función:$imp2</p>";
?>