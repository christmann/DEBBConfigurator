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

use Debb\ManagementBundle\DataTransformer\DecimalTransformer;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * PowerSupply
 *
 * @ORM\Table(name="powersupply")
 * @ORM\Entity(repositoryClass="Debb\ManagementBundle\Repository\BaseRepository")
 * @author Patrick Bußmann <patrick.bussmann@christmann.info>
 */
class PowerSupply extends Base /* extends DEBBComplexType */
{
	/**
	 * @var string
	 *
	 * @Assert\Choice(callback={"Debb\ManagementBundle\Form\PowerSupplyType", "getClasses"}, message="Choose a valid class.")
	 * @ORM\Column(name="class", type="string", length=15)
	 */
	private $class;

	/**
	 * maximum output power of the PowerSupply metered in miliWatt
	 *
	 * @var float
	 *
	 * @Assert\NotBlank()
	 * @ORM\Column(name="total_output_power", type="decimal", precision=18, scale=9)
	 */
	private $totalOutputPower;

	/**
	 * @var integer
	 *
	 * @Assert\NotBlank()
	 * @ORM\Column(name="efficiency", type="integer")
	 */
	private $efficiency;

	/**
	 * @var integer
	 *
	 * @ORM\ManyToOne(targetEntity="Debb\ManagementBundle\Entity\FlowProfile")
	 */
	private $powerProfile;

	/**
	 * Components
	 *
	 * @ORM\OneToMany(targetEntity="Debb\ManagementBundle\Entity\Component", cascade={"persist"}, mappedBy="powersupply", orphanRemoval=true)
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
		if ($this->getClass() !== null)
		{
			$array['Class'] = $this->getClass();
		}
		if ($this->getTotalOutputPower() !== null)
		{
			$array['TotalOutputPower'] = DecimalTransformer::convert($this->getTotalOutputPower());
		}
		if ($this->getEfficiency() !== null)
		{
			$array['Efficiency'] = $this->getEfficiency();
		}
		if ($this->getPowerProfile() !== null)
		{
			$array['PowerProfile'] = $this->getPowerProfile()->getDebbXmlArray();
		}
		return $array;
	}

    /**
     * Set class
     *
     * @param string $class
     * @return PowerSupply
     */
    public function setClass($class)
    {
        $this->class = $class;
    
        return $this;
    }

    /**
     * Get class
     *
     * @return string 
     */
    public function getClass()
    {
        return $this->class;
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

    /**
     * Set powerProfile
     *
     * @param \Debb\ManagementBundle\Entity\FlowProfile $powerProfile
     * @return PowerSupply
     */
    public function setPowerProfile(\Debb\ManagementBundle\Entity\FlowProfile $powerProfile = null)
    {
        $this->powerProfile = $powerProfile;
    
        return $this;
    }

    /**
     * Get powerProfile
     *
     * @return \Debb\ManagementBundle\Entity\FlowProfile 
     */
    public function getPowerProfile()
    {
        return $this->powerProfile;
    }

	/**
	 * Constructor
	 */
	public function __construct()
	{
		$this->components = new \Doctrine\Common\Collections\ArrayCollection();
	}

	/**
	 * Duplicate this entity
	 */
	public function __clone()
	{
		if ($this->getId() > 0)
		{
			parent::__clone();

			$this->components = new ArrayCollection();
		}
	}

	/**
	 * Add components
	 *
	 * @param \Debb\ManagementBundle\Entity\Component $components
	 * @return Heatsink
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
	 * @return Component[]
	 */
	public function getComponents()
	{
		return $this->components;
	}

	/**
	 * Get the parents
	 *
	 * @return Component[]
	 */
	public function getParents()
	{
		return $this->getComponents();
	}
}