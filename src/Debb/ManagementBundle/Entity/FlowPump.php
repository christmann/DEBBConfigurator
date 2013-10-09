<?php

namespace Debb\ManagementBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * FlowPump
 *
 * FlowPump includes all devices "moving" air or liquid like fans, water pumps etc.
 *
 * @ORM\Table(name="flow_pump")
 * @ORM\Entity(repositoryClass="Debb\ManagementBundle\Repository\BaseRepository")
 */
class FlowPump extends DEBBSimple
{
    /**
     * @var integer|null
     *
     * @ORM\Column(name="maxrpm", type="integer", nullable=true)
     */
    private $maxRPM;

	/**
	 * @var float|null
	 *
	 * @ORM\Column(name="efficiency", type="float", nullable=true)
	 */
	private $efficiency;

	/**
	 * @var boolean
	 *
	 * @ORM\Column(name="inlet", type="boolean")
	 */
	private $inlet = false;

	/**
	 * Flow pump to chassis
	 *
	 * @ORM\OneToMany(targetEntity="Debb\ManagementBundle\Entity\FlowPumpToChassis", cascade={"persist"}, mappedBy="flowPump", orphanRemoval=true)
	 *
	 * @var \Debb\ManagementBundle\Entity\FlowPumpToChassis[]
	 */
	private $flowPumpToChassis;

	/**
	 * Flow pump to room
	 *
	 * @ORM\OneToMany(targetEntity="Debb\ManagementBundle\Entity\FlowPumpToRoom", cascade={"persist"}, mappedBy="flowPump", orphanRemoval=true)
	 *
	 * @var \Debb\ManagementBundle\Entity\FlowPumpToRoom[]
	 */
	private $flowPumpToRooms;

	/**
	 * Components
	 *
	 * @ORM\OneToMany(targetEntity="Debb\ManagementBundle\Entity\Component", cascade={"persist"}, mappedBy="heatsink", orphanRemoval=true)
	 *
	 * @var \Debb\ManagementBundle\Entity\Component[]
	 */
	private $components;

	/**
	 * Returns a array for later converting
	 *
	 * @return array the array for later converting
	 */
	public function getDebbXmlArray()
	{
		$array = parent::getDebbXmlArray();
		if ($this->getMaxRPM() !== null)
		{
			$array['MaxRPM'] = $this->getMaxRPM();
		}
		if ($this->getEfficiency() !== null)
		{
			$array['Efficiency'] = $this->getEfficiency();
		}
		return $array;
	}

    /**
     * Set maxRPM
     *
     * @param integer $maxRPM
     * @return FlowPump
     */
    public function setMaxRPM($maxRPM)
    {
        $this->maxRPM = $maxRPM;
    
        return $this;
    }

    /**
     * Get maxRPM
     *
     * @return integer 
     */
    public function getMaxRPM()
    {
        return $this->maxRPM;
    }

    /**
     * Set efficiency
     *
     * @param float $efficiency
     * @return FlowPump
     */
    public function setEfficiency($efficiency)
    {
        $this->efficiency = $efficiency;
    
        return $this;
    }

    /**
     * Get efficiency
     *
     * @return float 
     */
    public function getEfficiency()
    {
        return $this->efficiency;
    }

	/**
	 * Set inlet
	 *
	 * @param boolean $inlet
	 * @return FlowPump
	 */
	public function setInlet($inlet)
	{
		$this->inlet = $inlet;

		return $this;
	}

	/**
	 * Get inlet
	 *
	 * @return boolean
	 */
	public function isInlet()
	{
		return $this->inlet;
	}

	/**
	 * @return string the name of this flow pump
	 */
	function __toString()
	{
		return parent::__toString() . ' - ' . $this->getDebbLevel();
	}

	/**
	 * @return string the debb level
	 */
	public function getDebbLevel()
	{
		return $this->isInlet() ? 'Inlet' : 'Outlet';
	}
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->flowPumpToChassis = new \Doctrine\Common\Collections\ArrayCollection();
        $this->flowPumpToRooms = new \Doctrine\Common\Collections\ArrayCollection();
        $this->components = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Get inlet
     *
     * @return boolean 
     */
    public function getInlet()
    {
        return $this->inlet;
    }

    /**
     * Add flowPumpToChassis
     *
     * @param \Debb\ManagementBundle\Entity\FlowPumpToChassis $flowPumpToChassis
     * @return FlowPump
     */
    public function addFlowPumpToChassi(\Debb\ManagementBundle\Entity\FlowPumpToChassis $flowPumpToChassis)
    {
        $this->flowPumpToChassis[] = $flowPumpToChassis;
    
        return $this;
    }

    /**
     * Remove flowPumpToChassis
     *
     * @param \Debb\ManagementBundle\Entity\FlowPumpToChassis $flowPumpToChassis
     */
    public function removeFlowPumpToChassi(\Debb\ManagementBundle\Entity\FlowPumpToChassis $flowPumpToChassis)
    {
        $this->flowPumpToChassis->removeElement($flowPumpToChassis);
    }

    /**
     * Get flowPumpToChassis
     *
     * @return \Debb\ManagementBundle\Entity\FlowPumpToChassis[]
     */
    public function getFlowPumpToChassis()
    {
        return $this->flowPumpToChassis;
    }

    /**
     * Add flowPumpToRooms
     *
     * @param \Debb\ManagementBundle\Entity\FlowPumpToRoom $flowPumpToRooms
     * @return FlowPump
     */
    public function addFlowPumpToRoom(\Debb\ManagementBundle\Entity\FlowPumpToRoom $flowPumpToRooms)
    {
        $this->flowPumpToRooms[] = $flowPumpToRooms;
    
        return $this;
    }

    /**
     * Remove flowPumpToRooms
     *
     * @param \Debb\ManagementBundle\Entity\FlowPumpToRoom $flowPumpToRooms
     */
    public function removeFlowPumpToRoom(\Debb\ManagementBundle\Entity\FlowPumpToRoom $flowPumpToRooms)
    {
        $this->flowPumpToRooms->removeElement($flowPumpToRooms);
    }

    /**
     * Get flowPumpToRooms
     *
     * @return \Debb\ManagementBundle\Entity\FlowPumpToRoom[]
     */
    public function getFlowPumpToRooms()
    {
        return $this->flowPumpToRooms;
    }

    /**
     * Add components
     *
     * @param \Debb\ManagementBundle\Entity\Component $components
     * @return FlowPump
     */
    public function addComponent(\Debb\ManagementBundle\Entity\Component $components)
    {
        $this->components[] = $components;
    
        return $this;
    }

    /**
     * Remove components
     *
     * @param \Debb\ManagementBundle\Entity\Component $components
     */
    public function removeComponent(\Debb\ManagementBundle\Entity\Component $components)
    {
        $this->components->removeElement($components);
    }

    /**
     * Get components
     *
     * @return \Debb\ManagementBundle\Entity\Component[]
     */
    public function getComponents()
    {
        return $this->components;
    }

	/**
	 * Get the parents
	 *
	 * @return FlowPumpToChassis[]|FlowPumpToRoom[]|array
	 */
	public function getParents()
	{
		return array_merge($this->getFlowPumpToChassis()->toArray(), $this->getFlowPumpToRooms()->toArray());
	}
}