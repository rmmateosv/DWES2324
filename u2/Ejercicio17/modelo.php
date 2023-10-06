<?php
    require_once 'ClaseCita.php';

    class Modelo{
        private string $nombreFichero="citas.txt";

        function __construct()
        {
            
        }

        function crearCita(Cita $c){
            $resultado = false;
            $f=null;
            try {
                //Abrir fichero para añadir
                $f = fopen($this->nombreFichero,"a+");
                //Añadir cita
                fwrite($f,$c->getFecha().";".
                          $c->getHora().";".
                          $c->getNombreC().";".
                          $c->getTipoServicio().PHP_EOL);
                $resultado=true;
            } catch (\Throwable $th) {
                echo $th->getMessage();
            }
            finally{
                //Cerrar fichero
                if($f!=null){
                    fclose($f);
                }
            }
            return $resultado;
        }
        public function obtenerCitas(){
            $resultado = array();

            if(file_exists($this->nombreFichero)){
                $datos=file($this->nombreFichero);
                //Convertimos cada línea del fichero en un objeto Cita
                foreach($datos as $linea){
                    $campos=explode(';',$linea);
                    $cita = new Cita($campos[0],$campos[1],$campos[2],$campos[3]);
                    $resultado[]=$cita;
                }
            }
            return $resultado;
        }

    }
?>