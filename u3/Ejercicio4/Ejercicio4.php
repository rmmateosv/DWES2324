<?php
require_once 'Evento.php';

//VEr si está defindo el array de eventos en la cookie
if(isset($_COOKIE['cEventos'])){
    $eventos=unserialize($_COOKIE['cEventos']);
}
else{
    //Creamos el array vacío
    $eventos=[];
}
if(isset($_POST['crear'])){
    //Chequear que lo datos están rellenos
    if(!empty($_POST['fecha']) and !empty($_POST['hora']) and !empty($_POST['asunto'])){
        $e = new Evento($_POST['fecha'],$_POST['hora'],$_POST['asunto']);
        //Añadimos el evento al array
        $eventos[]=$e;
        //Actualizar/Crear la cookie (fecha caducidad de un mes)
        setcookie('cEventos',serialize($eventos),time()+(30*24*60*60));
    }
    else{
        $mensaje = "Error, rellena todos los campos";
    }
}
if(isset($_POST['borrar'])){
    //Borrar del array el elemento cuya posición está en $post de borrar
    unset($eventos[$_POST['borrar']]);
    //Reindexar array
    array_values(($eventos));
    //Actualizar la cookie
    setcookie('cEventos',serialize($eventos),time()+(30*24*60*60));
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>CALENDARIO DE EVENTOS</h1>
    <?php
        if(isset($mensaje)){
            echo '<h3 style="color:red;">'.$mensaje.'</h3>';
        }
    ?>
    <form action="" method="post">
        <table>
            <tr>
                <th>Fecha</th>
                <th>Hora</th>
                <th>Asunto</th>
                <th>Acción</th>
            </tr>
            <?php 
            foreach($eventos as $clave=>$e){
                echo '<tr>';
                echo '<td>'.$e->getFecha().'</td>';
                echo '<td>'.$e->getHora().'</td>';
                echo '<td>'.$e->getAsunto().'</td>';
                echo '<td><button type="submit" name="borrar" value="'.$clave.'">Borrar</button></td>';
                echo '</tr>';
            }
            ?>
            <tr>
                <td><input type="date" name="fecha" value="<?php echo date('Y-m-d');?>"/></td>
                <td><input type="time" name="hora" value="<?php echo date('H:i');?>"/></td>
                <td><input type="text" name="asunto" placeholder="Asunto"/></td>
                <td><input type="submit" name="crear" value="Añadir"/></td>
            </tr>
        </table>
    </form>
</body>
</html>