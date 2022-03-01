<?php

class Dice
{
    protected int $sides;
    protected int $id_game;
    protected ?int $id_charac;
    protected array $results;
    protected int $result;
    protected string $date_roll;
    public const AVAILABLE_SIDES = [2, 4, 6, 8, 10, 12, 20, 100];

    public function __construct(array $infos=[])
    {
        if (isset($infos['dice_side']) && isset($infos['id_game']) && isset($infos['result']) && isset($infos['date_roll'])) {
            $this->setSides($infos['dice_side'])
            ->setId_game($infos['id_game'])
            ->setResults($infos['result'])
            ->setDate_roll($infos['date_roll']);
        }
    }

    public function getAvailableSides()
    {
        return self::AVAILABLE_SIDES;
    }

    public function rolls($nbRoll)
    {
        $arrayRoll = [];
        for ($i = 0; $i < $nbRoll; $i++) {
            array_push($arrayRoll, rand(1, $this->getSides()));
        }
        $this->setResults($arrayRoll);
    }

    /**
     * Get the value of sides
     */
    public function getSides()
    {
        return $this->sides;
    }


    /**
     * Set the value of sides
     *
     * @return  self
     */
    public function setSides($sides)
    {
        $this->sides = $sides;

        return $this;
    }


    /**
     * Get the value of results
     */
    public function getResults()
    {
        return $this->results;
    }

    /**
     * Set the value of results
     *
     * @return  self
     */
    public function setResults($results)
    {
        $this->results = $results;

        return $this;
    }

    /**
     * Get the value of id_charac
     */
    public function getId_charac()
    {
        return $this->id_charac;
    }

    /**
     * Set the value of id_charac
     *
     * @return  self
     */
    public function setId_charac($id_charac)
    {
        $this->id_charac = $id_charac;

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

    /**
     * Get the value of result
     */
    public function getResult()
    {
        return $this->result;
    }

    /**
     * Set the value of result
     *
     * @return  self
     */
    public function setResult($result)
    {
        $this->result = $result;

        return $this;
    }

    /**
     * Get the value of date_roll
     */
    public function getDate_roll()
    {
        return $this->date_roll;
    }

    /**
     * Set the value of date_roll
     *
     * @return  self
     */
    public function setDate_roll($date_roll)
    {
        $this->date_roll = $date_roll;

        return $this;
    }
}
