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
 * CState
 *
 * @ORM\Table(name="cstate")
 * @ORM\Entity()
 * @author Patrick Bußmann <patrick.bussmann@christmann.info>
 */
class CState
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
	 *
	 * @ORM\Column(name="name", type="string", length=255, nullable=true)
	 */
	private $name;

    /**
     * @var float
     *
     * @Assert\NotBlank()
     * @ORM\Column(name="power_usage", type="decimal", precision=18, scale=9)
     */
    private $powerUsage;

	/**
	 * @var \Debb\ManagementBundle\Entity\Processor
	 *
	 * @ORM\ManyToOne(targetEntity="Debb\ManagementBundle\Entity\Processor", inversedBy="cStates")
	 */
	private $processor;

	/**
	 * Returns a array for later converting
	 *
	 * @return array the array for later converting
	 */
	public function getDebbXmlArray($state = 0)
	{
		$array = array();
		$array['State'] = $state;
		if($this->getName() !== null)
		{
			$array['Name'] = $this->getName();
		}
		$array['PowerUsage'] = $this->getPowerUsage() !== null ? DecimalTransformer::convert($this->getPowerUsage()) : 0;
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

			$this->processor = null;
		}
	}

    /**
     * Set powerUsage
     *
     * @param float $powerUsage
     * @return CState
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
     * Set processor
     *
     * @param \Debb\ManagementBundle\Entity\Processor $processor
     * @return CState
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
     * Set name
     *
     * @param string $name
     * @return CState
     */
    public function setName($name)
    {
        $this->name = $name;
    
        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }
}