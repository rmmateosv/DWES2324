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

    //Botón crear
    if (isset($_POST['crear'])) {
        if (
            empty($_POST['propietario']) or empty($_POST['matricula']) or
            empty($_POST['color'])
        ) {
            $mensaje = array('e', 'Debe rellenar todos los campos');
        } else {
            //Comprobar que no existe otro vehículo con la misma matrícula
            $v = $bd->obtenerVehiculo($_POST['matricula']);
            if ($v == null) {
                //Crear Vehículo
                $v = new Vehiculo(0, $_POST['propietario'], $_POST['matricula'], $_POST['color']);
                if ($bd->crearVehiculo($v)) {
                    $mensaje = array('i', 'Vehículo Creado');
                } else {
                    $mensaje = array('e', 'Se ha producido un error al crear el vehículo');
                }
            } else {
                $mensaje = array('e', 'Error, ya existe un vehículo con esa matrícula');
            }
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
    } elseif (isset($_POST['mostrarV'])) {
        //Crear una variable de sesión con el propietario
        $_SESSION['propietario'] = $_POST['propietario'];
        //Limpiamos el vehículo seleccionado de la sesión
        unset($_SESSION['vehiculo']);
        unset($_SESSION['reparacion']);
    } elseif (isset($_POST["mostrarR"])) {
        $_SESSION['vehiculo'] = $_POST['mostrarR'];
    } 
    elseif (isset($_POST["datosR"])) {
        $_SESSION['reparacion'] = $_POST['datosR'];
        header('location:../reparacion/controllerReparacion.php');
    } 
    elseif(isset($_POST['updateR'])){
        if($bd->modificarReparacion($_POST['updateR'],
                 $_POST['horas'],(isset($_POST['pagado'])?true:false),$_POST['precioH'])){
            $mensaje = array('i', 'Reparación modificada');
        }        
        else{
            $mensaje = array('e', 'Error al modificar la reparación');
        }
    }
    elseif (isset($_POST['borrar'])) {
    } elseif (isset($_POST['crearR'])) {
        //Crear reparación para vehículo en $_SESSION
        $r = new Reparacion(
            0,
            $_SESSION['vehiculo'],
            time(),
            0,
            false,
            $_SESSION['usuario']->getId(),
            0
        );
        if ($bd->crearReparacion($r)) {
            $mensaje = array('i', 'Reparación creada con código ' . $r->getId());
        } else {
            $mensaje = array('e', 'Se ha producido un error al crear la reparación');
        }
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
        <?php include_once 'datosVehiculos.php' ?>
    </section>
    <section>
        <!-- Seleccionar / Visulizar datos de reparaciones -->
        <?php include_once '../reparacion/datosReparaciones.php' ?>
    </section>
    <footer>

    </footer>
</body>

</html>