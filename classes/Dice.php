<?php

class Dice
{
    protected int $sides;
    protected int $id_game;
    protected int $id_charac;
    protected array $results;
    const AVAILABLE_SIDES = [2, 4, 6, 8, 10, 12, 20, 100];

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
}
