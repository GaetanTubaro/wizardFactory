<?php
class Character
{
    protected string $name;
    protected ?int $id;
    protected int $hpMax = 100;
    protected int $currentHp = 100;
    protected int $mpMax = 50;
    protected int $currentMp = 50;
    protected int $strength = 10;
    protected int $dexterity = 10;
    protected int $constitution = 10;
    protected int $intelligence = 10;
    protected int $wisdom = 10;
    protected int $luck = 10;
    protected string $img = "src/blank-avatar.png";

    public function __construct(array $arr)
    {
        // if (isset($arr['img']) && filter_var($arr['img'], FILTER_CALLBACK, array('options' => 'isAString'))) {
        $this->setImg($arr['img']);
        // }
        // if (!is_string($arr['hpMax']) && is_int($arr['hpMax']) && is_numeric($arr['hpMax'])) {
        $this->setHpMax($arr['hpMax']);
        $this->setCurrentHp($arr['hpMax']);
        // }
        // if (!is_string($arr['mpMax']) && is_int($arr['mpMax']) && is_numeric($arr['mpMax'])) {
        $this->setMpMax($arr['mpMax']);
        $this->setCurrentMp($arr['mpMax']);
        // }
        // if (filter_var($arr['name'], FILTER_CALLBACK, array('options' => 'isAString'))) {
        $this->setName($arr['name']);
        // }
        // if (isAGoodNumber($arr['strength'])) {
        $this->setStrength($arr['strength']);
        // }
        // if (isAGoodNumber($arr['dexterity'])) {
        $this->setDexterity($arr['dexterity']);
        // }
        // if (isAGoodNumber($arr['constitution'])) {
        $this->setConstitution($arr['constitution']);
        // }
        // if (isAGoodNumber($arr['intelligence'])) {
        $this->setConstitution($arr['intelligence']);
        // }
        // if (isAGoodNumber($arr['wisdom'])) {
        $this->setWisdom($arr['wisdom']);
        // }
        // if (isAGoodNumber($arr['luck'])) {
        $this->setLuck($arr['luck']);
        // }
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
