<?php

namespace Debb\ManagementBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * PStateLoadPowerUsage
 *
 * @ORM\Table(name="pstate_load_power_usage")
 * @ORM\Entity
 */
class PStateLoadPowerUsage
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
     * @ORM\Column(name="lLoad", type="float")
     */
    private $lLoad;

    /**
	 * Replaces PowerUsageMin/Max and allows specifying PowerUsage for specific loads.
	 *
     * @var float
     *
	 * @Assert\NotNull()
     * @ORM\Column(name="powerUsage", type="float")
     */
    private $powerUsage;

	/**
	 * @var \Debb\ManagementBundle\Entity\PState
	 *
	 * @ORM\ManyToOne(targetEntity="Debb\ManagementBundle\Entity\PState", inversedBy="loadPowerUsages")
	 */
	private $pstate;

	/**
	 * Returns a array for later converting
	 *
	 * @return array the array for later converting
	 */
	public function getDebbXmlArray()
	{
		$array = array();
		$array['Load'] = $this->getLLoad();
		$array['PowerUsage'] = $this->getPowerUsage();
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
     * Set lLoad
     *
     * @param float $lLoad
     * @return PStateLoadPowerUsage
     */
    public function setLLoad($lLoad)
    {
        $this->lLoad = $lLoad;
    
        return $this;
    }

    /**
     * Get lLoad
     *
     * @return float 
     */
    public function getLLoad()
    {
        return (float) $this->lLoad;
    }

    /**
     * Set powerUsage
     *
     * @param float $powerUsage
     * @return PStateLoadPowerUsage
     */
    public function setPowerUsage($powerUsage)
    {
        $this->powerUsage = $powerUsage;
    
        return $this;
    }

    /**
     * Get powerUsage
     *
     * @return float 
     */
    public function getPowerUsage()
    {
        return (float) $this->powerUsage;
    }

    /**
     * Set pstate
     *
     * @param \Debb\ManagementBundle\Entity\PState $pstate
     * @return PStateLoadPowerUsage
     */
    public function setPstate(\Debb\ManagementBundle\Entity\PState $pstate = null)
    {
        $this->pstate = $pstate;
    
        return $this;
    }

    /**
     * Get pstate
     *
     * @return \Debb\ManagementBundle\Entity\PState 
     */
    public function getPstate()
    {
        return $this->pstate;
    }
}