<?php
require_once '../Modelo.php';
$bd = new Modelo();
if($bd->getConexion()==null){
    $mensaje = array('e','Error, no hay conexión con la bd');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <title>Taller - Gestión de Piezas</title>
</head>
<body>
    <header>
        <?php
            require_once '../menu.php';
        ?>
    </header>
    <section>
        <!-- Crear Pieza -->
    </section>
    <section>
        <!-- Comunicar mensajes -->
        <?php
        if(isset($mensaje)){
            if($mensaje[0]=='e')
                echo '<h3 class="text-danger">'.$mensaje[1].'</h3>';
            else
                echo '<h3 class="text-success">'.$mensaje[1].'</h3>';
        }
        ?>
    </section>
    <section>
        <!-- Mostrar piezas y dar opción a modificar y borrar -->
        <?php
            if($bd->getConexion()!=null){
                //Obtener piezas
                $piezas = $bd->obtenerPiezas();
            }
        ?>
    </section>
    <footer>

    </footer>
</body>
</html>