<?php

class Game
{
    protected int $id;
    protected string $name;
    protected int $id_mj;



    public function validateMj(): bool
    {
        return $this->getId_mj() == $_SESSION['id'];
    }
    /**
     * Get the value of name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of id_mj
     */
    public function getId_mj()
    {
        return $this->id_mj;
    }

    /**
     * Set the value of id_mj
     *
     * @return  self
     */
    public function setId_mj($id_mj)
    {
        $this->id_mj = $id_mj;

        return $this;
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
}
