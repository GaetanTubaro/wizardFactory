<?php

class Skill
{
    const POSSIBLE_STATS = ['Force','Dextérité','Constitution','Sagesse','Intelligence','Chance'];

    protected ?int $id;
    protected string $name;
    protected string $stats;
    protected int $level;
    protected ?int $id_charac = null;

    public function __construct(array $infos = [])
    {
        if (isset($infos['skill_name']) && isset($infos['skill_level']) && isset($infos['skill_stat'])) {
            $this->setName($infos['skill_name'])
            ->setLevel($infos['skill_level'])
            ->setStats($infos['skill_stat']);
        }
        if (isset($infos['id_character'])) {
            $this->setOwner($infos['id_character']);
        }
        if (isset($infos['id_skill'])) {
            $this->setId($infos['id_skill']);
        }
    }

    public function addSkill(PDO $connection) : bool
    {
        if ($this->getOwner() == null) {
            $owner = "null";
        } else {
            $owner = $this->getOwner();
        }
        $sql = 'INSERT INTO skills (name, stats, level, id_charac) VALUES ("' . $this->getName() . '","' . $this->getStats() . '",' . $this->getLevel() . ',' . $owner . ')';
        $addSkill = $connection->exec($sql);
        $this->setId($connection->lastInsertId());
        if (null != $this->getOwner()) {
            $sql = $connection->prepare('SELECT id_game FROM game_character WHERE id_charac = ' . $this->getOwner());
            $sql->execute();
            $id_game = $sql->fetch(PDO::FETCH_ASSOC);
            $sql = 'INSERT INTO game_skill (id_skill, id_game) VALUES (' . $this->getId() . ', ' . $id_game['id_game'] . ')';
            $connection->exec($sql);
        }
        if ($addSkill == false || $addSkill == 0) {
            return false;
        } else {
            return true;
        }
    }

    public function changeSkill(PDO $connection) : bool
    {
        $sql = 'UPDATE skills SET name = "' . $this->getName() . '", level = ' . $this->getLevel() . ', stats = "' . $this->getStats() . '" WHERE id =' . $this->getId();
        $changeSkill = $connection->exec($sql);
        if ($changeSkill == false || $changeSkill == 0) {
            return false;
        } else {
            return true;
        }
    }

    public function deleteSkill(PDO $connection) : bool
    {
        $sql = 'DELETE FROM game_skill WHERE id_skill=' . $this->getId();
        $deleteSkill = $connection->exec($sql);
        $sql = 'DELETE FROM skills WHERE id=' . $this->getId();
        $deleteSkill = $connection->exec($sql);
        if ($deleteSkill == false || $deleteSkill == 0) {
            return false;
        } else {
            return true;
        }
    }

    public function checkData() : array
    {
        $errors = [];
        if (!in_array($this->stats, Skill::POSSIBLE_STATS)) {
            $errors['stat'] = 'Statistique liée invalide.';
        }
        if ($this->level > 5 || $this->level < 0) {
            $errors['level'] = 'Niveau invalide.';
        }
        return $errors;
    }

    /**
     * Get the value of stats
     */
    public function getStats()
    {
        return $this->stats;
    }

    /**
     * Set the value of stats
     *
     * @return  self
     */
    public function setStats($stats)
    {
        $this->stats = $stats;

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
     * Get the value of level
     */
    public function getLevel()
    {
        return $this->level;
    }

    /**
     * Set the value of level
     *
     * @return  self
     */
    public function setLevel($level)
    {
        $this->level = $level;

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
