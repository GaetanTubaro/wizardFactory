<?php
class Character
{
    protected string $name;
    protected int $id;
    protected int $hpMax;
    protected int $currentHp;
    protected int $mpMax;
    protected int $currentMp;
    protected int $strength;
    protected int $dexterity;
    protected int $constitution;
    protected int $intelligence;
    protected int $wisdom;
    protected int $luck;
    protected string $img;

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

    /**
     * Get the value of hpMax
     */
    public function getHpMax()
    {
        return $this->hpMax;
    }

    /**
     * Set the value of hpMax
     *
     * @return  self
     */
    public function setHpMax($hpMax)
    {
        $this->hpMax = $hpMax;

        return $this;
    }

    /**
     * Get the value of currentHp
     */
    public function getCurrentHp()
    {
        return $this->currentHp;
    }

    /**
     * Set the value of currentHp
     *
     * @return  self
     */
    public function setCurrentHp($currentHp)
    {
        $this->currentHp = $currentHp;

        return $this;
    }

    /**
     * Get the value of mpMax
     */
    public function getMpMax()
    {
        return $this->mpMax;
    }

    /**
     * Set the value of mpMax
     *
     * @return  self
     */
    public function setMpMax($mpMax)
    {
        $this->mpMax = $mpMax;

        return $this;
    }

    /**
     * Get the value of currentMp
     */
    public function getCurrentMp()
    {
        return $this->currentMp;
    }

    /**
     * Set the value of currentMp
     *
     * @return  self
     */
    public function setCurrentMp($currentMp)
    {
        $this->currentMp = $currentMp;

        return $this;
    }

    /**
     * Get the value of strength
     */
    public function getStrength()
    {
        return $this->strength;
    }

    /**
     * Set the value of strength
     *
     * @return  self
     */
    public function setStrength($strength)
    {
        $this->strength = $strength;

        return $this;
    }

    /**
     * Get the value of dexterity
     */
    public function getDexterity()
    {
        return $this->dexterity;
    }

    /**
     * Set the value of dexterity
     *
     * @return  self
     */
    public function setDexterity($dexterity)
    {
        $this->dexterity = $dexterity;

        return $this;
    }

    /**
     * Get the value of constitution
     */
    public function getConstitution()
    {
        return $this->constitution;
    }

    /**
     * Set the value of constitution
     *
     * @return  self
     */
    public function setConstitution($constitution)
    {
        $this->constitution = $constitution;

        return $this;
    }

    /**
     * Get the value of inteligence
     */
    public function getIntelligence()
    {
        return $this->intelligence;
    }

    /**
     * Set the value of inteligence
     *
     * @return  self
     */
    public function setIntelligence($intelligence)
    {
        $this->intelligence = $intelligence;

        return $this;
    }

    /**
     * Get the value of wisdom
     */
    public function getWisdom()
    {
        return $this->wisdom;
    }

    /**
     * Set the value of wisdom
     *
     * @return  self
     */
    public function setWisdom($wisdom)
    {
        $this->wisdom = $wisdom;

        return $this;
    }

    /**
     * Get the value of luck
     */
    public function getLuck()
    {
        return $this->luck;
    }

    /**
     * Set the value of luck
     *
     * @return  self
     */
    public function setLuck($luck)
    {
        $this->luck = $luck;

        return $this;
    }

    /**
     * Get the value of img
     */
    public function getImg()
    {
        return $this->img;
    }

    /**
     * Set the value of img
     *
     * @return  self
     */
    public function setImg($img)
    {
        $this->img = $img;

        return $this;
    }
}
