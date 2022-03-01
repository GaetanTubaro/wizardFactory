<?php
class Filters
{
    protected int $level;
    protected string $stats;
    protected int $dMax;
    protected int $dMin;
    protected int $pMax;
    protected int $pMin;

    public function __construct()
    {
        if (!empty($_POST['level'])) {
            $this->setLevel($_POST['level']);
        }
        if (!empty($_POST['stats'])) {
            $this->setStats($_POST['stats']);
        }
        if (!empty($_POST['dMax'])) {
            $this->setDMax($_POST['dMax']);
        }
        if (!empty($_POST['dMin'])) {
            $this->setDMin($_POST['dMin']);
        }
        if (!empty($_POST['pMax'])) {
            $this->setPMax($_POST['pMax']);
        }
        if (!empty($_POST['pMin'])) {
            $this->setPMin($_POST['pMin']);
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

    /**
     * Get the value of dMax
     */
    public function getDMax()
    {
        return $this->dMax;
    }

    /**
     * Set the value of dMax
     *
     * @return  self
     */
    public function setDMax($dMax)
    {
        $this->dMax = $dMax;

        return $this;
    }

    /**
     * Get the value of dMin
     */
    public function getDMin()
    {
        return $this->dMin;
    }

    /**
     * Set the value of dMin
     *
     * @return  self
     */
    public function setDMin($dMin)
    {
        $this->dMin = $dMin;

        return $this;
    }

    /**
     * Get the value of pMax
     */
    public function getPMax()
    {
        return $this->pMax;
    }

    /**
     * Set the value of pMax
     *
     * @return  self
     */
    public function setPMax($pMax)
    {
        $this->pMax = $pMax;

        return $this;
    }

    /**
     * Get the value of pMin
     */
    public function getPMin()
    {
        return $this->pMin;
    }

    /**
     * Set the value of pMin
     *
     * @return  self
     */
    public function setPMin($pMin)
    {
        $this->pMin = $pMin;

        return $this;
    }
}
