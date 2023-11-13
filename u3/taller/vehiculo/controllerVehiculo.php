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
    session_write_close();
    //Botón crear
    if (isset($_POST['crear'])) {
        if (
            empty($_POST['propietario']) or empty($_POST['matricula']) or
            empty($_POST['color'])
        ) {
            $mensaje = array('e', 'Debe rellenar todos los campos');
        } else {
            //Comprobar que no existe otro vehículo con la misma matrícula

        }
    } elseif (isset($_POST['insertP'])) {
        if (empty($_POST['dni']) or empty($_POST['telefono']) or empty($_POST['nombre'])) {
            $mensaje = array('e', 'Debe rellenar todos los campos');
        } else {
            //Comprobar que no hay otro propietario con el mismo dni
            $p = $bd->obtenerPropietario($_POST['dni']);
            if ($p == null) {
                //Crear propietario
                $p = new Propietario(
                    0,
                    $_POST['dni'],
                    $_POST['nombre'],
                    $_POST['telefono'],
                    $_POST['email']
                );
                if ($bd->crearPropietario($p)) {
                    $mensaje = array('i', 'Propietario creado con código:' . $p->getId());
                } else {
                    $mensaje = array('e', 'Se ha producido un error al crear el propietario');
                }
            } else {
                $mensaje = array('e', 'Error, ya existe propietario con ese dni');
            }
        }
    } elseif (isset($_POST['update'])) {
    } elseif (isset($_POST['borrar'])) {
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <title>Taller - Gestión de Vehículos</title>
</head>

<body>
    <header>
        <?php
        require_once '../menu.php';
        ?>
        <h3 style="text-align: center;">GESTIÓN DE VEHÍCULOS</h3>
    </header>
    <section>
        <!-- Crear Vehúculo -->
        <?php include_once 'crearVehiculo.php' ?>
    </section>
    <section>
        <!-- Comunicar mensajes -->
        <?php include_once '../verMensaje.php' ?>
    </section>
    <section>
        <!-- Seleccionar / Visulizar datos de vehículo -->
        <?php include_once 'datosVehiculo.php' ?>
    </section>
    <section>
        <!-- Seleccionar / Visulizar datos de reparaciones -->
        <?php include_once 'datosReparaciones.php' ?>
    </section>
    <footer>

    </footer>
</body>

</html>