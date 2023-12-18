<?php
require_once 'Modelo.php';

$bd = new Modelo();
if ($bd->getConexion() == null) {
    $mensaje = "Error, no hay conexión con la bd";
} else {
    session_start();
    if (isset($_POST['selTienda'])) {
        //Almacenar tienda en sesión
        $tienda = $bd->obtenerTienda($_POST['tienda']);
        if ($tienda != null)
            $_SESSION['tienda'] = $tienda;
        else
            $mensaje = 'Error, tienda seleccionada no existe';
    } elseif (isset($_POST['cambiar'])) {
        session_destroy();
        header('location:mcDaw.php');
    } elseif (isset($_POST['agregar'])) {
        if ($_POST['cantidad'] <= 0) {
            $mensaje = 'Error, cantidad debe ser mayor que 0';
        } else {
            //Obtener todos los datos del producto seleccionado
            $producto = $bd->obtenerProducto($_POST['producto']);
            if ($producto != null) {
                //Añadir a cesta
                $proCesta = new ProductoEnCesta($producto,$_POST['cantidad']);
                if(isset)
                []=$proCesta;
            }
            else{
                $mensaje = 'Error, producto no existe';
            }
        }
    }
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
    <div>
        <h1 style='color:red;'><?php echo isset($mensaje) ? $mensaje : ""; ?></h1>
    </div>
    <form action="mcDaw.php" method="post">
        <?php

        if (!isset($_SESSION['tienda'])) {
        ?>
            <div>
                <h1 style='color:blue;'>Tienda</h1>
                <label for="tienda">Tienda</label><br />
                <select name="tienda">
                    <?php
                    $tiendas = $bd->obtenerTiendas();
                    foreach ($tiendas as $t) {
                        echo '<option value="' . $t->getCodigo() . '">' . $t->getNombre() . '</option>';
                    }
                    ?>
                </select>
                <button type="submit" name="selTienda">Seleccionar tienda</button>
            </div>
        <?php
        } else {
        ?>
            <div>
                <h1 style='color:blue;'>Añade productos a la cesta</h1>
                <?php
                $t = $_SESSION['tienda'];
                ?>
                <h2 style='color:green;'>Datos Tienda:
                    <?php echo $t->getNombre(), '-', $t->getTelefono(); ?>
                    <button type="submit" name="cambiar">Cambiar Tienda</button>
                </h2>
                <table>
                    <tr>
                        <td><label for="producto">Producto</label><br /></td>
                        <td><label for="cantidad">Cantidad</label><br /></td>
                        <td>Añadir a la cesta</td>
                    </tr>
                    <tr>
                        <td>
                            <select id="producto" name="producto">
                                <?php
                                $productos = $bd->obtenerProductos();
                                foreach ($productos as $p) {
                                    echo '<option value="' . $p->getCodigo() . '">' . $p->getNombre() .
                                        '-' . $p->getPrecio() . '</option>';
                                }
                                ?>
                            </select>
                        </td>
                        <td><input id="cantidad" type="number" name="cantidad" value="1" /></td>
                        <td><button type="submit" name="agregar">+</button></td>
                    </tr>
                </table>
            </div>
            <div>
                <h1 style='color:blue;'>Contenido de la cesta</h1>
                <table border="1" rules="all" width="25%">
                    <tr>
                        <td><b>Producto</b></td>
                        <td><b>Cantidad</b></td>
                        <td><b>Precio</b></td>
                    </tr>

                </table>
                <button type="submit" name="crearPedido">Crear Pedido</button>
            </div>
        <?php
        }
        ?>
    </form>
</body>

</html>