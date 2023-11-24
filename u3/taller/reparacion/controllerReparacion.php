<?php
require_once '../Modelo.php';
$bd = new Modelo();
if ($bd->getConexion() == null) {
    $mensaje = array('e', 'Error, no hay conexión con la bd');
} else {
    //Chequear el perfile del usuario
    session_start();
    if (
        isset($_SESSION['usuario']) and
        ($_SESSION['usuario']->getPerfil() == 'C')
    ) {
        header('location:../usuario/login.php');
    }
    if(!isset($_SESSION['reparacion'])){
        header('location:../vehiculo/controllerVehiculo.php');
    }

    //Botón crear
    if (isset($_POST['crear'])) {
        //Crear Pieza en reparación

    } 
    elseif(isset($_POST['update'])){
       //Modificar pieza en reparación
    }
    elseif (isset($_POST['borrar'])) {
         //Borrar pieza en reparación
    } 
    session_write_close();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <title>Taller - Gestión de Reparación</title>
</head>

<body>
    <header>
        <?php
        require_once '../menu.php';
        ?>
        <h3 style="text-align: center;">GESTIÓN DE REPARACIÓN</h3>
    </header>
    <section>
        <!--Datos de la reparación -->
        <?php 
        $r = $bd->obtenerReparacion($_SESSION['reparacion']);
        include_once 'infoReparacion.php' ?>
    </section>
    <section>
        <!-- Crear Vehúculo -->
        <?php include_once 'crearPiezaR.php' ?>
    </section>
    <section>
        <!-- Comunicar mensajes -->
        <?php include_once '../verMensaje.php' ?>
    </section>
    <section>
        <!-- Seleccionar / Visulizar datos de vehículo -->
        <?php include_once 'datosPieza.php' ?>
    </section>
    
    <footer>

    </footer>
</body>

</html>