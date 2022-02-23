<?php

class Equipment
{
    protected int $id;
    protected string $name;
    protected int $damages;
    protected int $range_area;
    protected int $id_game;
    protected ?int $id_charac = null;

    public function __construct(array $infos = [])
    {
        if (isset($infos['equipment_name']) && isset($infos['equipment_damages']) && isset($infos['equipment_range']) && isset($infos['id_game'])) {
            $this->setName($_POST['equipment_name'])
            ->setDamages($_POST['equipment_damages'])
            ->setRange($_POST['equipment_range'])
            ->setId_game($infos['id_game']);
        }
        if (isset($infos['id_character'])) {
            $this->setOwner($infos['id_character']);
        }
        if (isset($infos['id_equipment'])) {
            $this->setId($infos['id_equipment']);
        }
    }

    public function addEquipment(PDO $connection) : bool
    {
        if ($this->getOwner() == null) {
            $owner = "null";
        } else {
            $owner = $this->getOwner();
        }
        $sql = 'INSERT INTO equipments (name, damages, range_area, id_charac) VALUES ("' . $this->getName() . '","' . $this->getDamages() . '",' . $this->getRange() . ',' . $owner . ')';
        $addEquipment = $connection->exec($sql);
        $this->setId($connection->lastInsertId());
        $sql = 'INSERT INTO game_equipment (id_equipment, id_game) VALUES (' . $this->getId() . ', ' . $this->getId_game() . ')';
        $connection->exec($sql);
        if ($addEquipment == false || $addEquipment == 0) {
            return false;
        } else {
            return true;
        }
    }

    public function changeEquipment(PDO $connection) : bool
    {
        $sql = 'UPDATE equipments SET name ="' . $this->getName() . '", damages =' . $this->getDamages() . ', range_area =' . $this->getRange() . ' WHERE id=' . $this->getId();
        $changeEquipment = $connection->exec($sql);
        if ($changeEquipment == false || $changeEquipment == 0) {
            return false;
        } else {
            return true;
        }
    }

    public function deleteEquipment(PDO $connection) : bool
    {
        $sql = 'DELETE FROM game_equipment WHERE id_equipment=' . $this->getId();
        $deleteSkill = $connection->exec($sql);
        $sql = 'DELETE FROM equipments WHERE id=' . $this->getId();
        $deleteEquipment = $connection->exec($sql);
        if ($deleteEquipment == false || $deleteEquipment == 0) {
            return false;
        } else {
            return true;
        }
    }

    public function checkData(): array
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
