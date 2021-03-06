<?php

class Character
{
    protected string $name;
    protected ?int $id;
    protected int $hpMax = 100;
    protected int $currentHp = 100;
    protected int $mpMax = 50;
    protected int $currentMp = 50;
    protected int $initiative = 5;
    protected int $strength = 10;
    protected int $dexterity = 10;
    protected int $constitution = 10;
    protected int $intelligence = 10;
    protected int $wisdom = 10;
    protected int $luck = 10;
    protected ?int $id_user;
    protected ?int $id_game;
    protected string $img = "src/blank-avatar.png";

    public function __construct(array $arr = [])
    {
        if (!empty($arr)) {
            if (isset($arr['name']) && isset($arr['hpMax']) && isset($arr['mpMax']) && isset($arr['init']) && isset($arr['strength']) && isset($arr['dexterity']) && isset($arr['constitution']) && isset($arr['intelligence']) && isset($arr['wisdom']) && isset($arr['luck']) && isset($_SESSION['id'])) {
                $this->setName($arr['name']);
                $this->setHpMax(intval($arr['hpMax']));
                $this->setMpMax(intval($arr['mpMax']));
                if (isset($arr['currentHp'])) {
                    $this->setCurrentHp(intval($arr['currentHp']));
                } else {
                    $this->setCurrentHp(intval($arr['hpMax']));
                }
                if (isset($arr['currentMp'])) {
                    $this->setCurrentMp(intval($arr['currentMp']));
                } else {
                    $this->setCurrentMp(intval($arr['mpMax']));
                }
                $this->setInit(intval($arr['init']));
                $this->setStrength(intval($arr['strength']));
                $this->setDexterity(intval($arr['dexterity']));
                $this->setConstitution(intval($arr['constitution']));
                $this->setIntelligence(intval($arr['intelligence']));
                $this->setWisdom(intval($arr['wisdom']));
                $this->setLuck(intval($arr['luck']));
                $this->setId_user($_SESSION['id']);
            }
            if (isset($arr['id'])) {
                $this->setId($arr['id']);
            }
        }
    }
    public function validateInt(): array
    {
        $errors = [];
        if (!is_numeric($this->getHpMax()) || $this->getHpMax() < 0) {
            $errors['hpMax'] = "Point de vie invalide";
        }
        if (!is_numeric($this->getMpMax()) || $this->getMpMax() < 0) {
            $errors['mpMax'] = "Point de mana invalide";
        }
        if ($this->getInit() > 10 || $this->getInit() <= 0 || !is_numeric($this->getInit())) {
            $errors['init'] = "Initiative invalide";
        }
        if (!isAGoodNumber($this->getStrength())) {
            $errors['strength'] = "Force invalide";
        }
        if (!isAGoodNumber($this->getDexterity())) {
            $errors['dexterity'] = "Dext??rit?? invalide";
        }
        if (!isAGoodNumber($this->getConstitution())) {
            $errors['constitution'] = "Constitution invalide";
        }
        if (!isAGoodNumber($this->getIntelligence())) {
            $errors['intelligence'] = "Int??lligence invalide";
        }
        if (!isAGoodNumber($this->getWisdom())) {
            $errors['wisdom'] = "Sagesse invalide";
        }
        if (!isAGoodNumber($this->getLuck())) {
            $errors['luck'] = "Chance invalide";
        }
        if (!($this->getHpMax() >= $this->getCurrentHp())) {
            $errors['currentHp'] = "Point de vie actuel invalide";
        }
        if (!($this->getMpMax() >= $this->getCurrentMp())) {
            $errors['currentMp'] = "Point de mana actuel invalide";
        }
        if (!isAString($this->getName())) {
            $errors['name'] = "Nom invalide";
        }
        return $errors;
    }
    public function validateCount(): array
    {
        $errorCount = [];
        if (!($this->getInit() + $this->getStrength() + $this->getDexterity() + $this->getConstitution() + $this->getIntelligence() + $this->getWisdom() + $this->getLuck() >= 60)) {
            $errorCount['moins'] = "Vous devez remplir les statistiques avec plus de 60 points";
        }
        if (!($this->getInit() + $this->getStrength() + $this->getDexterity() + $this->getConstitution() + $this->getIntelligence() + $this->getWisdom() + $this->getLuck() <= 80)) {
            $errorCount['plus'] = "Vous devez remplir les statistiques avec moins de 80 points";
        }
        return $errorCount;
    }
    public function checkImg($value)
    {
        if (isset($value) && isAString($value)) {
            $this->setImg($value);
        }
    }
    public function linkCharGame(PDO $connection, $idCharac, $idGame): bool
    {
        $this->setId_game($idGame);
        $request = 'INSERT INTO `game_character` (id_charac, id_game) VALUES (' . $idCharac . ', ' . $this->getId_game() . ')';
        $addGameCharac = $connection->exec($request);
        if ($addGameCharac == false) {
            return false;
        } else {
            return true;
        }
    }
    public function insertChar($connection): bool
    {
        $request = "INSERT INTO `character_sheets` (`name`,`hpMax`,`currentHp`,`mpMax`,`currentMp`,`initiative`,`strength`,`dexterity`,`constitution`,`intelligence`,`wisdom`,`luck`,`img`) VALUES ('" . $this->getName() . "'," . $this->getHpMax() . "," . $this->getCurrentHp() . "," . $this->getMpMax() . "," . $this->getCurrentMp() . "," . $this->getInit() . "," . $this->getStrength() . "," . $this->getDexterity() . "," . $this->getConstitution() . "," . $this->getIntelligence() . "," . $this->getWisdom() . "," . $this->getLuck() . ",'" . $this->getImg() . "')";
        $insertChar = $connection->exec($request);
        if ($insertChar == false) {
            return false;
        } else {
            return true;
        }
    }
    public function updateChar($connection, $id_character)
    {
        $request = "UPDATE `character_sheets` SET name = '" . $this->getName() . "', currentHp = " . $this->getCurrentHp() . ", currentMp = " . $this->getCurrentMp() . ", hpMax = " . $this->getHpMax() . ", initiative = " . $this->getInit() . ", strength = " . $this->getStrength() . ", dexterity = " . $this->getDexterity() . ", mpMax = " . $this->getMpMax() . ", constitution = " . $this->getConstitution() . ", intelligence = " . $this->getIntelligence() . ", wisdom = " . $this->getWisdom() . ", luck = " . $this->getLuck() . ", img = '" . $this->getImg() . "' WHERE id =" . $id_character;
        $updateChar = $connection->exec($request);
        if ($updateChar == false) {
            return false;
        } else {
            return true;
        }
    }
    public function deleteChar($connection): bool
    {
        $firstRequest = 'DELETE FROM game_character WHERE id_charac =' . $this->getId();
        $deleteLinkChar = $connection->exec($firstRequest);
        $thirdRequest = 'UPDATE equipments SET id_charac = null WHERE id_charac =' . $this->getId();
        $fourthRequest = 'UPDATE skills SET id_charac = null WHERE id_charac =' . $this->getId();
        $connection->exec($thirdRequest);
        $connection->exec($fourthRequest);
        if ($deleteLinkChar == false || $deleteLinkChar == 0) {
            return false;
        } else {
            $secondRequest = 'DELETE FROM character_sheets WHERE id=' . $this->getId();
            $deleteChar = $connection->exec($secondRequest);
            if ($deleteChar == false || $deleteChar == 0) {
                return false;
            } else {
                return true;
            }
        }
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

    /**
     * Get the value of init
     */
    public function getInit()
    {
        return $this->initiative;
    }

    /**
     * Set the value of init
     *
     * @return  self
     */
    public function setInit($init)
    {
        $this->initiative = $init;

        return $this;
    }

    /**
     * Get the value of charPost
     */
    public function getCharPost()
    {
        return $this->charPost;
    }

    /**
     * Set the value of charPost
     *
     * @return  self
     */
    public function setCharPost($charPost)
    {
        $this->charPost = $charPost;

        return $this;
    }

    /**
     * Get the value of id_user
     */
    public function getId_user()
    {
        return $this->id_user;
    }

    /**
     * Set the value of id_user
     *
     * @return  self
     */
    public function setId_user($id_user)
    {
        $this->id_user = $id_user;

        return $this;
    }

    /**
     * Get the value of id_game
     */
    public function getId_game()
    {
        return $this->id_game;
    }

    /**
     * Set the value of id_game
     *
     * @return  self
     */
    public function setId_game($id_game)
    {
        $this->id_game = $id_game;

        return $this;
    }
}
