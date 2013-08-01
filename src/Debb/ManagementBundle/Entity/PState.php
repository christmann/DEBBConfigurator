<?php

namespace Debb\ManagementBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * PState
 *
 * @ORM\Table(name="pstate")
 * @ORM\Entity
 */
class PState
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var integer
     *
     * @Assert\NotNull()
     * @ORM\Column(name="state", type="integer")
     */
    private $state;

    /**
     * @var float
     *
     * @Assert\NotNull()
     * @ORM\Column(name="frequency", type="decimal")
     */
    private $frequency;

    /**
     * @var float
     *
     * @Assert\NotNull()
     * @ORM\Column(name="voltage", type="decimal")
     */
    private $voltage;

    /**
     * @var float
     *
     * @Assert\NotNull()
     * @ORM\Column(name="power_usage_min", type="decimal")
     */
    private $powerUsageMin;

    /**
     * @var float
     *
     * @Assert\NotNull()
     * @ORM\Column(name="power_usage_max", type="decimal")
     */
    private $powerUsageMax;

	/**
	 * @var \Debb\ManagementBundle\Entity\Processor
	 *
	 * @ORM\ManyToOne(targetEntity="Debb\ManagementBundle\Entity\Processor", inversedBy="pStates")
	 */
	private $processor;

	/**
	 * Returns a array for later converting
	 *
	 * @return array the array for later converting
	 */
	public function getDebbXmlArray()
	{
		$array = array();
		if($this->getState() != null)
		{
			$array['State'] = $this->getState();
		}
		if($this->getFrequency() != null)
		{
			$array['Frequency'] = $this->getFrequency();
		}
		if($this->getVoltage() != null)
		{
			$array['Voltage'] = $this->getVoltage();
		}
		if($this->getPowerUsageMin() != null)
		{
			$array['PowerUsageMin'] = $this->getPowerUsageMin();
		}
		if($this->getPowerUsageMax() != null)
		{
			$array['PowerUsageMax'] = $this->getPowerUsageMax();
		}
		return $array;
	}

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set state
     *
     * @param integer $state
     * @return PState
     */
    public function setState($state)
    {
        $this->state = $state;
    
        return $this;
    }

    /**
     * Get state
     *
     * @return integer 
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * Set frequency
     *
     * @param float $frequency
     * @return PState
     */
    public function setFrequency($frequency)
    {
        $this->frequency = $frequency;
    
        return $this;
    }

    /**
     * Get frequency
     *
     * @return float 
     */
    public function getFrequency()
    {
        return $this->frequency;
    }

    /**
     * Set voltage
     *
     * @param float $voltage
     * @return PState
     */
    public function setVoltage($voltage)
    {
        $this->voltage = $voltage;
    
        return $this;
    }

    /**
     * Get voltage
     *
     * @return float 
     */
    public function getVoltage()
    {
        return $this->voltage;
    }

    /**
     * Set powerUsageMin
     *
     * @param float $powerUsageMin
     * @return PState
     */
    public function setPowerUsageMin($powerUsageMin)
    {
        $this->powerUsageMin = $powerUsageMin;
    
        return $this;
    }

    /**
     * Get powerUsageMin
     *
     * @return float 
     */
    public function getPowerUsageMin()
    {
        return $this->powerUsageMin;
    }

    /**
     * Set powerUsageMax
     *
     * @param float $powerUsageMax
     * @return PState
     */
    public function setPowerUsageMax($powerUsageMax)
    {
        $this->powerUsageMax = $powerUsageMax;
    
        return $this;
    }

    /**
     * Get powerUsageMax
     *
     * @return float 
     */
    public function getPowerUsageMax()
    {
        return $this->powerUsageMax;
    }

    /**
     * Set processor
     *
     * @param \Debb\ManagementBundle\Entity\Processor $processor
     * @return PState
     */
    public function setProcessor(\Debb\ManagementBundle\Entity\Processor $processor = null)
    {
        $this->processor = $processor;
    
        return $this;
    }

    /**
     * Get processor
     *
     * @return \Debb\ManagementBundle\Entity\Processor 
     */
    public function getProcessor()
    {
        return $this->processor;
    }
}