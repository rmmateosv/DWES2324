<?php
require_once 'Tienda.php';
require_once 'Producto.php';
require_once 'ProductoEnCesta.php';
class Modelo
{
    private $url = "mysql:host=localhost;port=3307;dbname=mcDaw";
    private $us = "root";
    private $ps = "root";
    private $conexion = null;

    function __construct()
    {
        try {
            $this->conexion = new PDO($this->url, $this->us, $this->ps);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    function obtenerInfoPedido($codigoPedido)
    {
        $resultado = array();
        try {
            $consulta =
                $this->conexion->prepare('call datosPedido(?)');
            $params = array($codigoPedido);
            if ($consulta->execute($params)) {
                if ($fila = $consulta->fetch()) {
                    $resultado[] = $fila['numProd'];
                    $resultado[] = $fila['total'];
                }
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $resultado;
    }
    function crearPedido($tienda, $cesta)
    {
        $resultado = 0;
        try {
            //Iniciar transacción
            $this->conexion->beginTransaction();
            //Crear pedidio
            $consulta = $this->conexion->prepare(
                'INSERT into pedido values(default,curdate(),?)'
            );
            $params = array($tienda->getCodigo());
            if ($consulta->execute($params)) {
                //REcuperar el id del pedido generado
                $idP = $this->conexion->lastInsertId();
                //Inserts de productos en cesta
                $linea = 0;
                foreach ($cesta as $pc) {
                    $consulta = $this->conexion->prepare(
                        'INSERT into detalle values(?,?,?,?,?)'
                    );
                    $params = array(
                        ++$linea, $idP, $pc->getProducto()->getCodigo(),
                        $pc->getCantidad(), $pc->getProducto()->getPrecio()
                    );
                    if (!$consulta->execute($params)) {
                        $this->conexion->rollBack();
                        return 0;
                    }
                }
                $this->conexion->commit();
                $resultado = $idP;
            } else {
                $this->conexion->rollBack();
            }
        } catch (PDOException $e) {
            $this->conexion->rollBack();
            echo $e->getMessage();
        }
        return $resultado;
    }
    function obtenerProducto($codigo)
    {
        $resultado = null;
        try {
            $consulta = $this->conexion->prepare("select * from producto where codigo = ?");
            $params = array($codigo);
            if ($consulta->execute($params)) {
                if ($fila = $consulta->fetch()) {
                    $resultado = new Producto($fila['codigo'], $fila['nombre'], $fila['precio']);
                }
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $resultado;
    }
    function obtenerProductos()
    {
        $resultado = array();
        try {
            $consulta = $this->conexion->query("select * from producto");
            if ($consulta->execute()) {
                while ($fila = $consulta->fetch()) {
                    $resultado[] = new Producto($fila['codigo'], $fila['nombre'], $fila['precio']);
                }
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $resultado;
    }

    function obtenerTienda($codigo)
    {
        $resultado = null;
        try {
            $consulta = $this->conexion->prepare("select * from tienda where codigo = ?");
            $params = array($codigo);
            if ($consulta->execute($params)) {
                if ($fila = $consulta->fetch()) {
                    $resultado = new Tienda($fila['codigo'], $fila['nombre'], $fila['telefono']);
                }
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $resultado;
    }
    function obtenerTiendas()
    {
        $resultado = array();
        try {
            $consulta = $this->conexion->query("select * from tienda");
            if ($consulta->execute()) {
                while ($fila = $consulta->fetch()) {
                    $tienda = new Tienda($fila['codigo'], $fila['nombre'], $fila['telefono']);
                    $resultado[] = $tienda;
                }
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $resultado;
    }

    /**
     * Get the value of conexion
     */
    public function getConexion()
    {
        return $this->conexion;
    }

    /**
     * Set the value of conexion
     *
     * @return  self
     */
    public function setConexion($conexion)
    {
        $this->conexion = $conexion;

        return $this;
    }
}
