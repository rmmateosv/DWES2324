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
