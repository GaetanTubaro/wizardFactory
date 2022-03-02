<?php
class Filters
{
    protected ?int $level = null;
    protected ?string $stats = null;
    protected ?int $dMax = null;
    protected ?int $dMin = null;
    protected ?int $pMax = null;
    protected ?int $pMin = null;

    public function __construct()
    {
        if (isset($_POST['level'])) {
            $this->setLevel(intval($_POST['level']));
        }
        if (isset($_POST['stats'])) {
            $this->setStats($_POST['stats']);
        }
        if (isset($_POST['dMax'])) {
            $this->setDMax(intval($_POST['dMax']));
        }
        if (isset($_POST['dMin'])) {
            $this->setDMin(intval($_POST['dMin']));
        }
        if (isset($_POST['pMax'])) {
            $this->setPMax(intval($_POST['pMax']));
        }
        if (isset($_POST['pMin'])) {
            $this->setPMin(intval($_POST['pMin']));
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
