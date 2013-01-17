<?php

namespace Debb\ManagementBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Memory
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Memory extends Base
{

    /**
     * @var float
     *
     * @ORM\Column(name="MaxPower", type="float")
     */
    private $maxPower;

    /**
     * @var integer
     *
     * @ORM\Column(name="Capacity", type="integer")
     */
    private $capacity;


    /**
     * Set maxPower
     *
     * @param float $maxPower
     * @return Memory
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
     * Set capacity
     *
     * @param integer $capacity
     * @return Memory
     */
    public function setCapacity($capacity)
    {
        $this->capacity = $capacity;
    
        return $this;
    }

    /**
     * Get capacity
     *
     * @return integer 
     */
    public function getCapacity()
    {
        return $this->capacity;
    }
}