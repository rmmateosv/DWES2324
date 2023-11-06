<?php
class Usuario
{
    private int $id;
    private string $dni;
    private string $nombre;
    private string $perfil;



    public function __construct(int $id, string $dni, string $nombre, string $perfil)
    {
        $this->id = $id;
        $this->dni = $dni;
        $this->nombre = $nombre;
        $this->perfil = $perfil;
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
     * Get the value of dni
     */
    public function getDni()
    {
        return $this->dni;
    }

    /**
     * Set the value of dni
     *
     * @return  self
     */
    public function setDni($dni)
    {
        $this->dni = $dni;

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

    /**
     * Get the value of perfil
     */
    public function getPerfil()
    {
        return $this->perfil;
    }

    /**
     * Set the value of perfil
     *
     * @return  self
     */
    public function setPerfil($perfil)
    {
        $this->perfil = $perfil;

        return $this;
    }
}
