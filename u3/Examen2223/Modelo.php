<?php
require_once 'Empleado.php';

class Modelo{
    private string $url='mysql:host=localhost;port=3306;dbname=mensajes';
    private string $us = 'root';
    private string $ps = '';

    private $conexion=null;

    function __construct()
    {
        try{
            $this->conexion = new PDO($this->url,$this->us,$this->ps);
        }catch(PDOException $e){
            echo $e->getMessage();
        }
    }
    function obtenerEmpleado(int $us){
        $resultado = null;
        try{
            $consulta = $this->conexion->prepare(
                'SELECT * from empleado where idEmp = ?');
            $params=array($us);
            if($consulta->execute()){
                if($fila=$consulta->fetch()){
                    $resultado = new Empleado($fila['idEmp'],
                    $fila['dni'],$fila['nombreEmp'],
                    $fila['fechaNac'],$fila['departamento'],
                    $fila['cambiarPs']);
                }
            }
        }catch(PDOException $e){
            echo $e->getMessage();
        }
        return $resultado;
    }
    function login(int $us, string $ps){
        $resultado = 0;
        try{
            //Ejecutar fucnión almacenada en bd
            $consulta = $this->conexion->prepare('select login(?,?)');
            $params = array($us,$ps);
            if($consulta->execute($params)){
                if($fila=$consulta->fetch()){
                    //devolver lo que devuelve login
                    return $fila[0];
                }
            }
        }catch(PDOException $e){
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
     */
    public function setConexion($conexion): self
    {
        $this->conexion = $conexion;

        return $this;
    }
}
?>