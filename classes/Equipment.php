<?php

class Equipment
{
    protected int $id;
    protected string $name;
    protected int $damages;
    protected int $range_area;
    protected int $id_charac;

    public function checkData() : array
    {
        $errors = [];
        if ($this->damages < 0) {
            $errors['damages'] = 'Dégâts invalides.';
        }
        if ($this->range_area > 5 || $this->range_area < 0) {
            $errors['range'] = 'Portée invalide.';
        }
        return $errors;
    }

    /**
     * Get the value of owner
     */
    public function getOwner()
    {
        return $this->id_charac;
    }

    /**
     * Set the value of owner
     *
     * @return  self
     */
    public function setOwner($owner)
    {
        $this->id_charac = $owner;

        return $this;
    }

    /**
     * Get the value of range
     */
    public function getRange()
    {
        return $this->range_area;
    }

    /**
     * Set the value of range
     *
     * @return  self
     */
    public function setRange($range)
    {
        $this->range_area = $range;

        return $this;
    }

    /**
     * Get the value of damages
     */
    public function getDamages()
    {
        return $this->damages;
    }

    /**
     * Set the value of damages
     *
     * @return  self
     */
    public function setDamages($damages)
    {
        $this->damages = $damages;

        return $this;
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
