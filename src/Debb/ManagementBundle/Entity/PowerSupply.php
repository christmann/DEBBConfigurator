<?php

namespace Debb\ManagementBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PowerSupply
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class PowerSupply extends Base
{


    /**
     * @var float
     *
     * @ORM\Column(name="MaxPower", type="float")
     */
    private $maxPower;

    /**
     * @var float
     *
     * @ORM\Column(name="TotalOutputPower", type="decimal")
     */
    private $totalOutputPower;

    /**
     * @var integer
     *
     * @ORM\Column(name="Efficiency", type="integer")
     */
    private $efficiency;


    /**
     * Set maxPower
     *
     * @param float $maxPower
     * @return PowerSupply
     */
    public function setMaxPower($maxPower)
    {
        $this->maxPower = $maxPower;
    
        return $this;
    }

    /**
     * Get maxPower
     *
     * @return float 
     */
    public function getMaxPower()
    {
        return $this->maxPower;
    }

    /**
     * Set totalOutputPower
     *
     * @param float $totalOutputPower
     * @return PowerSupply
     */
    public function setTotalOutputPower($totalOutputPower)
    {
        $this->totalOutputPower = $totalOutputPower;
    
        return $this;
    }

    /**
     * Get totalOutputPower
     *
     * @return float 
     */
    public function getTotalOutputPower()
    {
        return $this->totalOutputPower;
    }

    /**
     * Set efficiency
     *
     * @param integer $efficiency
     * @return PowerSupply
     */
    public function setEfficiency($efficiency)
    {
        $this->efficiency = $efficiency;
    
        return $this;
    }

    /**
     * Get efficiency
     *
     * @return integer 
     */
    public function getEfficiency()
    {
        return $this->efficiency;
    }
}