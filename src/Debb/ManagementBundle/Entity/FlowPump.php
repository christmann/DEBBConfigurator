<?php
/**
 * DEBBConfigurator - A configurator for DEBB component and PLMXML files
 * Copyright (C) 2013-2014 christmann informationstechnik + medien GmbH & Co. KG
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Library General Public
 * License as published by the Free Software Foundation; either
 * version 2 of the License, or (at your option) any later version.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
 * Library General Public License for more details.
 *
 * You should have received a copy of the GNU Library General Public
 * License along with this library; if not, write to the
 * Free Software Foundation, Inc., 51 Franklin St, Fifth Floor,
 * Boston, MA  02110-1301, USA.
 */

namespace Debb\ManagementBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * FlowPump
 *
 * FlowPump includes all devices "moving" air or liquid like fans, water pumps etc.
 *
 * @ORM\Table(name="flow_pump")
 * @ORM\Entity(repositoryClass="Debb\ManagementBundle\Repository\BaseRepository")
 * @author Patrick Bußmann <patrick.bussmann@christmann.info>
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
	 * @var string
	 *
	 * @Assert\Choice(callback={"Debb\ConfigBundle\Form\RackType", "getFlowDirections"}, message="Choose a valid flow direction.")
	 * @ORM\Column(name="flow_direction", type="string", length=2, nullable=true)
	 */
	private $flowDirection;

	/**
	 * Returns a array for later converting
	 *
	 * @return array the array for later converting
	 */
	public function getDebbXmlArray()
	{
		$array[$this->getDebbLevel()] = parent::getDebbXmlArray();
		if ($this->getMaxRPM() !== null)
		{
			$array[$this->getDebbLevel()]['MaxRPM'] = $this->getMaxRPM();
		}
		if ($this->getEfficiency() !== null)
		{
			$array[$this->getDebbLevel()]['Efficiency'] = $this->getEfficiency();
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
    }

	/**
	 * Duplicate this entity
	 */
	public function __clone()
	{
		if ($this->getId() > 0)
		{
			parent::__clone();

			$flowPumpToChassiss = new ArrayCollection();
			foreach($this->getFlowPumpToChassis() as $flowPumpToChassis)
			{
				$flowPumpToChassiss->add(clone $flowPumpToChassis);
			}
			$this->setFlowPumpToChassis($flowPumpToChassiss);

			$flowPumpToRooms = new ArrayCollection();
			foreach($this->getFlowPumpToRooms() as $flowPumpToRoom)
			{
				$flowPumpToRooms->add(clone $flowPumpToRoom);
			}
			$this->setFlowPumpToRoom($flowPumpToRooms);
		}
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
    public function addFlowPumpToChassis(\Debb\ManagementBundle\Entity\FlowPumpToChassis $flowPumpToChassis)
    {
        $this->flowPumpToChassis[] = $flowPumpToChassis;
    
        return $this;
    }

    /**
     * Remove flowPumpToChassis
     *
     * @param \Debb\ManagementBundle\Entity\FlowPumpToChassis $flowPumpToChassis
     */
    public function removeFlowPumpToChassis(\Debb\ManagementBundle\Entity\FlowPumpToChassis $flowPumpToChassis)
    {
        $this->flowPumpToChassis->removeElement($flowPumpToChassis);
    }

	/**
	 * Set flowPumpToChassis
	 *
	 * @param \Debb\ManagementBundle\Entity\FlowPumpToChassis[] $flowPumpToChassis
	 * @return FlowPump
	 */
	public function setFlowPumpToChassis($flowPumpToChassis)
	{
		$this->flowPumpToChassis = $flowPumpToChassis;

		foreach ($this->flowPumpToChassis as $flowPumpToChassis)
		{
			$flowPumpToChassis->setFlowPump($this);
		}

		return $this;
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
	 * Set flowPumpToRooms
	 *
	 * @param \Debb\ManagementBundle\Entity\FlowPumpToRoom[] $flowPumpToRooms
	 * @return FlowPump
	 */
	public function setFlowPumpToRoom($flowPumpToRooms)
	{
		$this->flowPumpToRooms = $flowPumpToRooms;

		foreach ($this->flowPumpToChassis as $flowPumpToRooms)
		{
			$flowPumpToRooms->setFlowPump($this);
		}

		return $this;
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
	 * Get the parents
	 *
	 * @return FlowPumpToChassis[]|FlowPumpToRoom[]|array
	 */
	public function getParents()
	{
		return array_merge($this->getFlowPumpToChassis()->toArray(), $this->getFlowPumpToRooms()->toArray());
	}

	/**
	 * Set flowDirection
	 *
	 * @param string $flowDirection
	 * @return FlowPump
	 */
	public function setFlowDirection($flowDirection)
	{
		$this->flowDirection = $flowDirection;

		return $this;
	}

	/**
	 * Get flowDirection
	 *
	 * @return string
	 */
	public function getFlowDirection()
	{
		return $this->flowDirection;
	}
}