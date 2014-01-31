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

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * PStateLoadPowerUsage
 *
 * @ORM\Table(name="pstate_load_power_usage")
 * @ORM\Entity()
 * @author Patrick Bußmann <patrick.bussmann@christmann.info>
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
     * @ORM\Column(name="l_load", type="float")
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
	 * Duplicate this entity
	 */
	public function __clone()
	{
		if ($this->getId() > 0)
		{
			$this->id = null;

			$this->setPstate(clone $this->getPstate());
		}
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