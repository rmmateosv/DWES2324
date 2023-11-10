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
        ($_SESSION['usuario']->getPerfil() != 'A' and $_SESSION['usuario']->getPerfil() != 'M')
    ) {
        header('location:../usuario/login.php');
    }
    //Cerrar sesión
    session_write_close();
    //Botón crear
    if (isset($_POST['crear'])) {
        //Comprobar que todos los campos están rellenos
        if (
            empty($_POST['codigo']) or empty($_POST['clase']) or empty($_POST['desc'])
            or empty($_POST['precio']) or empty($_POST['stock'])
        ) {
            $mensaje = array('e', 'Debes relleanar todos los campos');
        } else {
            //Comprobar que no existe una pieza con el mismo código
            $p = $bd->obtenerPieza($_POST['codigo']);
            if ($p == null) {
                //La pieza no existe, se puede crear
                //Insertar en la BD la pieza
                $p = new Pieza();
                $p->setCodigo($_POST['codigo']);
                $p->setClase($_POST['clase']);
                $p->setDescripcion($_POST['desc']);
                $p->setPrecio($_POST['precio']);
                $p->setStock($_POST['stock']);
                if ($bd->insertarPieza($p)) {
                    $mensaje = array('i', 'Pieza creada');
                } else {
                    $mensaje = array('e', 'Error al crear la pieza');
                }
            } else {
                $mensaje = array('e', 'Pieza ya existe:' . $p->getCodigo() . ' ' . $p->getDescripcion());
            }
        }
    } elseif (isset($_POST['update'])) {
        //Modificar Pieza
        //Comprobar que todos los campos están rellenos
        if (
            empty($_POST['codigo']) or empty($_POST['clase']) or empty($_POST['desc'])
            or empty($_POST['precio']) or empty($_POST['stock'])
        ) {
            $mensaje = array('e', 'Debes relleanar todos los campos');
        } else {
            //Comprobar que no existe una pieza con el mismo código
            $p = $bd->obtenerPieza($_POST['codigo']);
            if ($p == null or $p->getCodigo() == $_POST['update']) {
                $p = new Pieza();
                $p->setCodigo($_POST['codigo']);
                $p->setClase($_POST['clase']);
                $p->setDescripcion($_POST['desc']);
                $p->setPrecio($_POST['precio']);
                $p->setStock($_POST['stock']);
                if ($bd->modificarPieza($p, $_POST['update'])) {
                    $mensaje = array('i', 'Pieza modificada');
                } else {
                    $mensaje = array('e', 'Error al modificar la pieza');
                }
            } else {
                $mensaje = array('e', 'Ya existe una pieza con códgio ' . $_POST['codigo']);
            }
        }
    } elseif (isset($_POST['borrar'])) {
        //Chequear que la pieza exista
        $p = $bd->obtenerPieza($_POST['borrar']);
        if ($p != null) {
            //Comprobar que se puede borrar (si no se ha usado en ninguna reparación)
            if ($bd->existenReparacionesPieza($p->getCodigo())) {
                $mensaje = array('e', 'No se puede borrar la pieza porque ya se ha usado en reparaciones');
            } else {
                //Borrar la pieza
                if ($bd->borrarPieza($p->getCodigo())) {
                    $mensaje = array('i', 'Pieza Borrada');
                } else {
                    $mensaje = array('e', 'Se ha producido un error al borrar la pieza');
                }
            }
        } else {
            $mensaje = array('e', 'Error, la pieza no existe');
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
    <title>Taller - Gestión de Piezas</title>
</head>

<body>
    <header>
        <?php
        require_once '../menu.php';
        ?>
        <h3 style="text-align: center;">GESTIÓN DE PIEZAS</h3>
    </header>
    <section>
        <!-- Crear Pieza -->
        <?php include_once 'crearPieza.php' ?>
    </section>
    <section>
        <!-- Comunicar mensajes -->
        <?php include_once '../verMensaje.php' ?>
    </section>
    <section>
        <!-- Visulzar Piezas -->
        <?php include_once 'listarPiezas.php' ?>
    </section>
    <footer>

    </footer>
</body>

</html>