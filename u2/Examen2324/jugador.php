<?php
class Jugador{
    private int $numJ;
    private String $nombre;
    private String $fecha;
    private String $cat, $tipoC, $compe, $equip;

        
    public function  __construct( $numJ,$nombre, $fecha,$cat, $tipoC, $compe, $equip)
    {
        
        $this->numJ=$numJ;
        $this->nombre=$nombre;
        $this->fecha=$fecha;
        $this->cat=$cat;
        $this->tipoC=$tipoC; 
        $this->compe=$compe;
        $this->equip=$equip;
        
    } 
    /**
     * Get the value of numJ
     */ 
    public function getNumJ()
    {
        return $this->numJ;
    }

    /**
     * Set the value of numJ
     *
     * @return  self
     */ 
    public function setNumJ($numJ)
    {
        $this->numJ = $numJ;

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
     * Get the value of equip
     */ 
    public function getEquip()
    {
        return $this->equip;
    }

    /**
     * Set the value of equip
     *
     * @return  self
     */ 
    public function setEquip($equip)
    {
        $this->equip = $equip;

        return $this;
    }

    /**
     * Get the value of compe
     */ 
    public function getCompe()
    {
        return $this->compe;
    }

    /**
     * Set the value of compe
     *
     * @return  self
     */ 
    public function setCompe($compe)
    {
        $this->compe = $compe;

        return $this;
    }

    /**
     * Get the value of tipoC
     */ 
    public function getTipoC()
    {
        return $this->tipoC;
    }

    /**
     * Set the value of tipoC
     *
     * @return  self
     */ 
    public function setTipoC($tipoC)
    {
        $this->tipoC = $tipoC;

        return $this;
    }

    /**
     * Get the value of cat
     */ 
    public function getCat()
    {
        return $this->cat;
    }

    /**
     * Set the value of cat
     *
     * @return  self
     */ 
    public function setCat($cat)
    {
        $this->cat = $cat;

        return $this;
    }

    /**
     * Get the value of nombre
     */ 
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set the value of nombre
     *
     * @return  self
     */ 
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }
}
?>