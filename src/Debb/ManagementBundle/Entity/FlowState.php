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
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * FlowState
 *
 * FlowStateType describes any kind of flow (air, liquid, power, ...) and assumes that for maintaining the flow a certain power usage is necessary.
 * For power supply units only the power which is used for creating/transforming the power flow is counted as PowerUsage,
 * but not the power provided. So adding all PowerUsages will show the overall consumption.
 *
 * @ORM\Table(name="flow_state")
 * @ORM\Entity()
 * @author Patrick Bußmann <patrick.bussmann@christmann.info>
 */
class FlowState
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
	 * @var string
	 * @Assert\NotNull()
	 * @ORM\Column(name="state", type="string", length=255)
	 */
	private $state;

    /**
     * @var float
     *
     * @ORM\Column(name="flow", type="decimal", precision=18, scale=9, nullable=true)
     */
    private $flow;

    /**
     * @var float
     *
     * @ORM\Column(name="power_usage", type="decimal", precision=18, scale=9, nullable=true)
     */
    private $powerUsage;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="description", type="string", length=255, nullable=true)
	 */
	private $description;

	/**
	 * @var float|null
	 *
	 * @ORM\Column(name="efficiency", type="decimal", precision=18, scale=9, nullable=true)
	 */
	private $efficiency;

	/**
	 * @var \Debb\ManagementBundle\Entity\FlowProfile
	 *
	 * @Assert\NotNull()
	 * @ORM\ManyToOne(targetEntity="Debb\ManagementBundle\Entity\FlowProfile", inversedBy="flowStates")
	 */
	private $flowProfile;

	/**
	 * Returns a array for later converting
	 *
	 * @return array the array for later converting
	 */
	public function getDebbXmlArray($state = 0)
	{
		$array = array();
		$array['State'] = $this->getState() !== null ? $this->getState() : $state;
		if ($this->getFlow() !== null)
		{
			$array['Flow'] = DecimalTransformer::convert($this->getFlow());
		}
		if ($this->getPowerUsage() !== null)
		{
			$array['PowerUsage'] = DecimalTransformer::convert($this->getPowerUsage());
		}
		if ($this->getDescription() !== null)
		{
			$array['Description'] = $this->getDescription();
		}
		if ($this->getEfficiency() !== null)
		{
			$array['Efficiency'] = $this->getEfficiency();
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
	 * Duplicate this entity
	 */
	public function __clone()
	{
		if ($this->getId() > 0)
		{
			$this->id = null;

			$this->flowProfile = null;
		}
	}

    /**
     * Set state
     *
     * @param string $state
     * @return FlowState
     */
    public function setState($state)
    {
        $this->state = $state;
    
        return $this;
    }

    /**
     * Get state
     *
     * @return string 
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * Set flow
     *
     * @param float $flow
     * @return FlowState
     */
    public function setFlow($flow)
    {
        $this->flow = $flow;
    
        return $this;
    }

    /**
     * Get flow
     *
     * @return float 
     */
    public function getFlow()
    {
        return $this->flow;
    }

    /**
     * Set powerUsage
     *
     * @param float $powerUsage
     * @return FlowState
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
        return $this->powerUsage;
    }

    /**
     * Set flowProfile
     *
     * @param \Debb\ManagementBundle\Entity\FlowProfile $flowProfile
     * @return FlowState
     */
    public function setFlowProfile(\Debb\ManagementBundle\Entity\FlowProfile $flowProfile = null)
    {
        $this->flowProfile = $flowProfile;
    
        return $this;
    }

    /**
     * Get flowProfile
     *
     * @return \Debb\ManagementBundle\Entity\FlowProfile 
     */
    public function getFlowProfile()
    {
        return $this->flowProfile;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return FlowState
     */
    public function setDescription($description)
    {
        $this->description = $description;
    
        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set efficiency
     *
     * @param float $efficiency
     * @return FlowState
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
}