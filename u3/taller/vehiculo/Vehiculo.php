<?php
class Vehiculo
{
    private int $codigo, $propietario;
    private string $matricula, $color;

    function __construct($codigo, $propietario, $matricula, $color)
    {
        $this->codigo = $codigo;
        $this->propietario = $propietario;
        if ($matricula == null) {
            $matricula = "";
        }
        $this->matricula = $matricula;
        if ($color == null) {
            $color = "";
        }
        $this->color = $color;
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
     * Get the value of propietario
     */
    public function getPropietario()
    {
        return $this->propietario;
    }

    /**
     * Set the value of propietario
     *
     * @return  self
     */
    public function setPropietario($propietario)
    {
        $this->propietario = $propietario;

        return $this;
    }

    /**
     * Get the value of matricula
     */
    public function getMatricula()
    {
        return $this->matricula;
    }

    /**
     * Set the value of matricula
     *
     * @return  self
     */
    public function setMatricula($matricula)
    {
        $this->matricula = $matricula;

        return $this;
    }

    /**
     * Get the value of color
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * Set the value of color
     *
     * @return  self
     */
    public function setColor($color)
    {
        $this->color = $color;

        return $this;
    }
}
