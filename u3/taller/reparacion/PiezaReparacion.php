<?php
require_once 'Reparacion.php';
require_once '../pieza/Pieza.php';
class PiezaReparacion{
    private Reparacion $r;
    private Pieza $p;
    private int $cantidad;
    private float $precio;

    function __construct($r,$p,$cantidad,$precio)
    {
        $this->r=$r;
        $this->p=$p;
        $this->cantidad=$cantidad;
        $this->precio=$precio;
    }
    


    /**
     * Get the value of r
     *
     * @return Reparacion
     */
    public function getR(): Reparacion
    {
        return $this->r;
    }

    /**
     * Set the value of r
     *
     * @param Reparacion $r
     *
     * @return self
     */
    public function setR(Reparacion $r): self
    {
        $this->r = $r;

        return $this;
    }

    /**
     * Get the value of p
     *
     * @return Pieza
     */
    public function getP(): Pieza
    {
        return $this->p;
    }

    /**
     * Set the value of p
     *
     * @param Pieza $p
     *
     * @return self
     */
    public function setP(Pieza $p): self
    {
        $this->p = $p;

        return $this;
    }

    /**
     * Get the value of cantidad
     *
     * @return int
     */
    public function getCantidad(): int
    {
        return $this->cantidad;
    }

    /**
     * Set the value of cantidad
     *
     * @param int $cantidad
     *
     * @return self
     */
    public function setCantidad(int $cantidad): self
    {
        $this->cantidad = $cantidad;

        return $this;
    }

    /**
     * Get the value of precio
     *
     * @return float
     */
    public function getPrecio(): float
    {
        return $this->precio;
    }

    /**
     * Set the value of precio
     *
     * @param float $precio
     *
     * @return self
     */
    public function setPrecio(float $precio): self
    {
        $this->precio = $precio;

        return $this;
    }
}
?>