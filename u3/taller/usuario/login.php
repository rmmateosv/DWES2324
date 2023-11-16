<?php
require_once '../Modelo.php';
session_start();
$bd = new Modelo();
//Chequear que hay conexión a la bd
if ($bd->getConexion() == null) {
    $mensaje = array('e', 'Error, no hay conexión con la BD');
} else {
    if (isset($_POST['login'])) {
        //Chequear que vienen rellenos us y ps
        if (empty($_POST['us']) or empty($_POST['ps'])) {
            $mensaje = array('e', 'Debes rellenar usuario y contraseña');
        } else {
            //Comprobar que us y ps son correctos=>Hacer Login
            $usuario = $bd->obtenerUsuario($_POST['us'], $_POST['ps']);
            if ($usuario == null) {
                $mensaje = array('e', 'Error, usuario y contraseña incorrectos');
            } else {
                //Guardar el usuario en la sesión y redirigir a la página
                //que queramos que sea la de entrada ¡¡CAMBIAR!!                
                $_SESSION['usuario'] = $usuario;
                header('location:../pieza/controllerPieza.php');
            }
        }
    } elseif (isset($_GET['accion']) and $_GET['accion'] == 'cerrar') {
        session_unset();
        session_destroy();
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <style>
        body {
            text-align: center;
        }
    </style>
</head>

<body>
    <h1>Taller Augustóbriga</h1>
    <div class="container-md mt-5 p-5 border w-25">
        <!-- Login -->
        <h1>Login</h1>
        <form action="#" method="post">
            <label>Usuario</label><br />
            <input type="text" name="us" placeholder="Usuario" required="required" /><br />
            <label>Contraseña</label><br />
            <input type="password" name="ps" placeholder="cotraseña" required="required" /><br /><br />
            <input type="submit" name="login" value="Entrar" class="btn btn-outline-dark" />
            <input type="reset" name="limpiar" value="Cancelar" class="btn btn-outline-dark" />
        </form>
    </div>
    <?php
    if (isset($mensaje)) {
        echo '<div class="container p-5 my-5 border">';
        if ($mensaje[0] == 'e')
            echo '<h4 class="text-danger">' . $mensaje[1] . '</h4>';
        else
            echo '<h4 class="text-success">' . $mensaje[1] . '</h4>';
        echo '</div>';
    }
    ?>

</body>

</html>