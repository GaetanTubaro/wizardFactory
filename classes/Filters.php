<?php
class Filters
{
    protected int $level;
    protected string $stats;

    public function __construct()
    {
        if (!empty($_POST['level'])) {
            $this->setLevel($_POST['level']);
        }
        if (!empty($_POST['stats'])) {
            $this->setStats($_POST['stats']);
        }
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
}
