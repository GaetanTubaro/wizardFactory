<?php

class Game
{
    protected int $id;
    protected string $name;
    protected int $id_mj;

    public function deleteTable($connection)
    {
        $searchSkills = $connection->prepare('SELECT * FROM game_skill INNER JOIN skills ON skills.id = game_skill.id_skill WHERE id_game =' . $this->getId());
        $searchSkills->execute();
        $skills = $searchSkills->fetchAll(PDO::FETCH_CLASS, Skill::class);
        foreach ($skills as $skill) {
            $skill->deleteSkill($connection);
        }
        $searchEquipments = $connection->prepare('SELECT * FROM game_equipment INNER JOIN equipments ON equipments.id = game_equipment.id_equipment WHERE id_game =' . $this->getId());
        $searchEquipments->execute();
        $equipments = $searchEquipments->fetchAll(PDO::FETCH_CLASS, Equipment::class);
        foreach ($equipments as $equipment) {
            $equipment->deleteEquipment($connection);
        }
        $searchCharacters = $connection->prepare('SELECT * FROM game_character INNER JOIN character_sheets ON character_sheets.id = game_character.id_charac WHERE id_game =' . $this->getId());
        $searchCharacters->execute();
        $characters = $searchCharacters->fetchAll(PDO::FETCH_CLASS, Character::class);
        foreach ($characters as $character) {
            $character->deleteChar($connection);
        }
        $deleteGame = $connection->prepare('DELETE FROM games WHERE id = ' . $_GET['game']);
        $deleteGame->execute();
    }

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
