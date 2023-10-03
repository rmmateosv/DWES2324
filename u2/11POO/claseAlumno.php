<?php
class Alumno{
    private int $numExp;
    private string $nombre;
    private int $fechaN;

    function __construct(int $numExp,string $nombre,int $fechaN)
    {
        $this->numExp=$numExp;
        $this->nombre =$nombre;
        $this->fechaN= $fechaN;

    }
    function mostrar(){
        echo 'Alumno:'.$this->numExp.' Fecha Nacimiento:'.
                        date('d/m/Y',$this->fechaN).
                        ' Nombre:'.$this->nombre;
    }
    function __destruct()
    {
        echo '<p>Alumno '.$this->nombre.' dado de baja</p>';
    }
}
?>