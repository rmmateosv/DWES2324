<?php
require_once "jugador.php";
class Modelo{
    private string $nombreFich="jugadores.txt";

    public function __construct()
    {
        
    }

    public function insertarJugador(Jugador $j){

        try{
            $f = fopen($this->nombreFich,'a+');
        fwrite($f,$j->getNumJ().';'.$j->getNombre().';'.$j->getFecha().';'.$j->getCat().';'.$j->getTipoC().';'.
              $j->getCompe().';'.$j->getEquip().PHP_EOL);
        
        }
        catch (Throwable $t){
            echo $t->getMessage();
        }
        finally{
            if($f!=null){
                fclose($f);
            }
        }
    }

    public function obtenerJugadores(){
        $resultado = array();
        try{
            if(file_exists($this->nombreFich)){
                $datos = file($this->nombreFich);
                foreach($datos as $d){
                    $linea = explode(';',$d);
                    $j = new Jugador($linea[0],$linea[1],$linea[2],$linea[3],
                    $linea[4],$linea[5],$linea[6]);
                    $resultado[]=$j;
                }
            }
            
        }
        catch (Throwable $t){
            echo $t->getMessage();
        }
        return $resultado;
    }
}
?>