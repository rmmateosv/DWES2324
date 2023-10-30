<?php
require_once 'pieza/Pieza.php';

class Modelo{
    
    private $conexion;

    const URL='mysql:host=localhost;port=3307;dbname=taller';
    const USUARIO='root';
    const PS='root';

    function __construct(){
        try {
            //Establecer conexión con la BD
            $this->conexion = new PDO(Modelo::URL,Modelo::USUARIO,Modelo::PS);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        
    }

    function obtenerPiezas(){
        //Devuelve un array de objetos Pieza
        $resultado = array();
        try {
            //Ejecutamos consulta
            $datos = $this->conexion->query('select * from pieza');
            if($datos!==false){
                //Recorrer los datos para crear objetos Pieza
                while($fila=$datos->fetch()){
                    //Creamos Pieza
                    $p = new Pieza();
                    $p->setCodigo($fila['codigo']);
                    $p->setClase($fila['clase']);
                    $p->setDescripcion($fila['descripcion']);
                    $p->setPrecio($fila['precio']);
                    $p->setStock($fila['stock']);
                    //Añadir pieza al arrry resultado
                    $resultado[]=$p;
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
?>
