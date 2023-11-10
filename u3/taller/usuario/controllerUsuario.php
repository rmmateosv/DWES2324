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
        ($_SESSION['usuario']->getPerfil() != 'A')
    ) {
        header('location:../usuario/login.php');
    }
    session_write_close();
    //Botón crear
    if (isset($_POST['crear'])) {
        if (empty($_POST['dni']) or empty($_POST['nombre']) or empty($_POST['perfil'])) {
            $mensaje = array('e', 'Debe rellenar todos los campos');
        } else {
            //Chequear que no existe el dni
            $u = $bd->obtenerUsuarioDni($_POST['dni']);
            if ($u == null) {
                //Se puede crear
                $u = new Usuario(0, $_POST['dni'], $_POST['nombre'], $_POST['perfil']);
                if ($bd->crearUsuario($u)) {
                    $mensaje = array('i', 'Usuario ' . $u->getId() . ' creado');
                } else {
                    $mensaje = array('e', 'Error al crear el usuario');
                }
            } else {
                $mensaje = array('e', 'Ya existe un usuario con ese dni');
            }
        }
    } elseif (isset($_POST['update'])) {
        //Chequear campos vacíos, que exista el usuario y que se si se cambia el dni
        //el nuevo valor no exista en la bd
        if (empty($_POST['dni']) or empty($_POST['nombre']) or empty($_POST['perfil'])) {
            $mensaje = array('e', 'Debe rellenar todos los campos');
        } else {
            $u = $bd->obtenerUsuarioId($_POST['update']);
            if ($u != null) {
                //Chequear que si se modifica el dni no existe el nuevo
                if ($_POST['dni'] != $u->getDni()) {
                    if ($bd->obtenerUsuarioDni($_POST['dni']) != null) {
                        $existeDNI = true;
                        $mensaje = array('e', 'Error, dni ya existe');
                    }
                }
                if (!isset($existeDNI)) {
                    //Cambiar datos del usuario por los del formulario
                    //Todos menos el id
                    $u->setDni($_POST['dni']);
                    $u->setNombre($_POST['nombre']);
                    $u->setPerfil($_POST['perfil']);
                    if ($bd->modificarUsuario($u)) {
                        $mensaje = array('i', 'Usuario Modificado');
                    } else {
                        $mensaje = array('e', 'Error al modficar el usuario');
                    }
                }
            } else {
                $mensaje = array('e', 'Error, no existe el usuario');
            }
        }
    } elseif (isset($_POST['borrar'])) {
        //Chequear que el usuario existe
        $u = $bd->obtenerUsuarioId($_POST['borrar']);
        if ($u != null) {
            //Chquear que no hay reparaciones creadas por él
            if ($bd->existenReparacionesUsuario($u->getId())) {
                $mensaje = array(
                    'e',
                    'No se puede borrar el usuario porque hay reparaciones creadas por el usuairo'
                );
            } else {
                if ($bd->borrarUsuario($u->getId())) {
                    $mensaje = array(
                        'i',
                        'Usuario borrado'
                    );
                } else {
                    $mensaje = array(
                        'e',
                        'Error al borrar el usuario'
                    );
                }
            }
        } else {
            $mensaje = array('e', 'No existe el usuario');
        }
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
    <title>Taller - Gestión de Usuarios</title>
</head>

<body>
    <header>
        <?php
        require_once '../menu.php';
        ?>
        <h3 style="text-align: center;">GESTIÓN DE USUARIOS</h3>
    </header>
    <section>
        <!-- Crear Pieza -->
        <?php include_once 'crearUsuario.php' ?>
    </section>
    <section>
        <!-- Comunicar mensajes -->
        <?php include_once '../verMensaje.php' ?>
    </section>
    <section>
        <!-- Visulzar Piezas -->
        <?php include_once 'listarUsuarios.php' ?>
    </section>
    <footer>

    </footer>
</body>

</html>