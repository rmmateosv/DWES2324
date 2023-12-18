<?php
class Reparacion{
    private int $id, $coche;
    private string $fecha;
    private float $tiempo;
    private bool $pagado;
    private float $precioH;
    private int $usuario;
    private float $importeTotal;

    function __construct($id, $coche,$fecha,$tiempo,$pagado,$usuario,$precioH,$importeTotal){
        //Quitar nulos
        if($precioH==null){
            $precioH=0;
        }
        if($tiempo==null){
            $tiempo=0;
        }
        $this->id=$id; 
        $this->coche=$coche;
        $this->fecha=$fecha;
        $this->tiempo=$tiempo;
        $this->pagado=$pagado;
        $this->precioH=$precioH;
        $this->usuario=$usuario;
        $this->importeTotal=$importeTotal;
    }

    

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of coche
     */ 
    public function getCoche()
    {
        return $this->coche;
    }

    /**
     * Set the value of coche
     *
     * @return  self
     */ 
    public function setCoche($coche)
    {
        $this->coche = $coche;

        return $this;
    }

    /**
     * Get the value of tiempo
     */ 
    public function getTiempo()
    {
        return $this->tiempo;
    }

    /**
     * Set the value of tiempo
     *
     * @return  self
     */ 
    public function setTiempo($tiempo)
    {
        $this->tiempo = $tiempo;

        return $this;
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
     * Get the value of pagado
     */ 
    public function getPagado()
    {
        return $this->pagado;
    }

    /**
     * Set the value of pagado
     *
     * @return  self
     */ 
    public function setPagado($pagado)
    {
        $this->pagado = $pagado;

        return $this;
    }

    /**
     * Get the value of precioH
     */ 
    public function getPrecioH()
    {
        return $this->precioH;
    }

    /**
     * Set the value of precioH
     *
     * @return  self
     */ 
    public function setPrecioH($precioH)
    {
        $this->precioH = $precioH;

        return $this;
    }

    /**
     * Get the value of usuario
     */ 
    public function getUsuario()
    {
        return $this->usuario;
    }

    /**
     * Set the value of usuario
     *
     * @return  self
     */ 
    public function setUsuario($usuario)
    {
        $this->usuario = $usuario;

        return $this;
    }

    /**
     * Get the value of importeTotal
     *
     * @return float
     */
    public function getImporteTotal(): float
    {
        return $this->importeTotal;
    }

    /**
     * Set the value of importeTotal
     *
     * @param float $importeTotal
     *
     * @return self
     */
    public function setImporteTotal(float $importeTotal): self
    {
        $this->importeTotal = $importeTotal;

        return $this;
    }
}

?>
