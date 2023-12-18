<?php
class Pieza{
    private string $codigo;
    private string $clase;
    private string $descripcion;
    private float $precio;
    private int $stock;

    function __construct()
    {
        
    }
    function rellenar($codigo,$clase,$descripcion,$precio, $stock){
        $this->codigo=$codigo;
        $this->clase=$clase;
        $this->descripcion=$descripcion;
        $this->precio=$precio;
        $this->stock=$stock;
    }

    /**
     * Get the value of codigo
     */ 
    public function getCodigo()
    {
        return $this->codigo;
    }

    /**
     * Set the value of codigo
     *
     * @return  self
     */ 
    public function setCodigo($codigo)
    {
        $this->codigo = $codigo;

        return $this;
    }

    /**
     * Get the value of clase
     */ 
    public function getClase()
    {
        return $this->clase;
    }

    /**
     * Set the value of clase
     *
     * @return  self
     */ 
    public function setClase($clase)
    {
        $this->clase = $clase;

        return $this;
    }

    /**
     * Get the value of descripcion
     */ 
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set the value of descripcion
     *
     * @return  self
     */ 
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get the value of precio
     */ 
    public function getPrecio()
    {
        return $this->precio;
    }

    /**
     * Set the value of precio
     *
     * @return  self
     */ 
    public function setPrecio($precio)
    {
        $this->precio = $precio;

        return $this;
    }

    /**
     * Get the value of stock
     */ 
    public function getStock()
    {
        return $this->stock;
    }

    /**
     * Set the value of stock
     *
     * @return  self
     */ 
    public function setStock($stock)
    {
        $this->stock = $stock;

        return $this;
    }
}
?>