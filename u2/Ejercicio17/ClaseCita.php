<?php
class Cita{
    private int $fecha;
    private int $hora;
    private string $nombreC;
    private int $tipoServicio;

    public function __construct($fecha,$hora,$nombreC,$tipoServicio){
        $this->fecha=$fecha;
        $this->hora=$hora;
        $this->nombreC=$nombreC;
        $this->tipoServicio=$tipoServicio;
    }
    

    /**
     * Get the value of fecha
     */ 
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Set the value of fecha
     *
     * @return  self
     */ 
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;

        return $this;
    }

    /**
     * Get the value of hora
     */ 
    public function getHora()
    {
        return $this->hora;
    }

    /**
     * Set the value of hora
     *
     * @return  self
     */ 
    public function setHora($hora)
    {
        $this->hora = $hora;

        return $this;
    }

    /**
     * Get the value of nombreC
     */ 
    public function getNombreC()
    {
        return $this->nombreC;
    }

    /**
     * Set the value of nombreC
     *
     * @return  self
     */ 
    public function setNombreC($nombreC)
    {
        $this->nombreC = $nombreC;

        return $this;
    }

    /**
     * Get the value of tipoServicio
     */ 
    public function getTipoServicio()
    {
        return $this->tipoServicio;
    }

    /**
     * Set the value of tipoServicio
     *
     * @return  self
     */ 
    public function setTipoServicio($tipoServicio)
    {
        $this->tipoServicio = $tipoServicio;

        return $this;
    }
}
?>