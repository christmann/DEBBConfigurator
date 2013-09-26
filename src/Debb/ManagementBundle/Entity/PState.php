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
     * @var \Debb\ManagementBundle\Entity\PStateLoadPowerUsage[]
     *
	 * @ORM\OneToMany(targetEntity="Debb\ManagementBundle\Entity\PStateLoadPowerUsage", mappedBy="pstate", cascade={"all"}, orphanRemoval=true)
     */
    private $loadPowerUsages;

	/**
	 * @var \Debb\ManagementBundle\Entity\Processor
	 *
	 * @ORM\ManyToOne(targetEntity="Debb\ManagementBundle\Entity\Processor", inversedBy="pStates")
	 */
	private $processor;

	/**
	 * Constructor
	 */
	public function __construct()
	{
		$this->loadPowerUsages = new \Doctrine\Common\Collections\ArrayCollection();
	}

	/**
	 * Returns a array for later converting
	 *
	 * @return array the array for later converting
	 */
	public function getDebbXmlArray($state = 0)
	{
		$array = array();
		$array['State'] = $state;
		if($this->getFrequency() !== null)
		{
			$array['Frequency'] = $this->getFrequency();
		}
		if($this->getVoltage() !== null)
		{
			$array['Voltage'] = $this->getVoltage();
		}
		foreach($this->getLoadPowerUsages() as $loadPowerUsage)
		{
			$array[] = array(array('LoadPowerUsage' => $loadPowerUsage->getDebbXmlArray()));
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
    
    /**
     * Add loadPowerUsages
     *
     * @param \Debb\ManagementBundle\Entity\PStateLoadPowerUsage $loadPowerUsages
     * @return PState
     */
    public function addLoadPowerUsage(\Debb\ManagementBundle\Entity\PStateLoadPowerUsage $loadPowerUsages)
    {
        $this->loadPowerUsages[] = $loadPowerUsages;
		$loadPowerUsages->setPstate($this);
    
        return $this;
    }

    /**
     * Remove loadPowerUsages
     *
     * @param \Debb\ManagementBundle\Entity\PStateLoadPowerUsage $loadPowerUsages
     */
    public function removeLoadPowerUsage(\Debb\ManagementBundle\Entity\PStateLoadPowerUsage $loadPowerUsages)
    {
		$loadPowerUsages->setPstate();
        $this->loadPowerUsages->removeElement($loadPowerUsages);
    }

    /**
     * Get loadPowerUsages
     *
     * @return \Debb\ManagementBundle\Entity\PStateLoadPowerUsage[]
     */
    public function getLoadPowerUsages()
    {
        return $this->loadPowerUsages;
    }
}