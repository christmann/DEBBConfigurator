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
 * DEBBComplex
 *
 * DEBBComplexType described the more complex parts in comparison to DEBBPhysicalElementsType like power supplies, cooling devices, etc.
 *
 * @ORM\Table(name="debbcomplex")
 * @ORM\Entity(repositoryClass="Debb\ManagementBundle\Repository\BaseRepository")
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="typ", type="string")
 * @author Patrick Bußmann <patrick.bussmann@christmann.info>
 */
class DEBBComplex extends DEBBSimple
{
	/**
	 * @var \Debb\ManagementBundle\Entity\FlowPump[]
	 *
	 * @ORM\ManyToMany(targetEntity="Debb\ManagementBundle\Entity\FlowPump")
	 * @ORM\JoinTable(name="debbcomplex_inlet",
	 *   joinColumns={@ORM\JoinColumn(name="debbcomplex", referencedColumnName="id")},
	 *   inverseJoinColumns={@ORM\JoinColumn(name="inlet", referencedColumnName="id")}
	 * )
	 */
	private $inlets;

	/**
	 * @var \Debb\ManagementBundle\Entity\FlowPump[]
	 *
	 * @ORM\ManyToMany(targetEntity="Debb\ManagementBundle\Entity\FlowPump")
	 * @ORM\JoinTable(name="debbcomplex_outlet",
	 *   joinColumns={@ORM\JoinColumn(name="debbcomplex", referencedColumnName="id")},
	 *   inverseJoinColumns={@ORM\JoinColumn(name="outlet", referencedColumnName="id")}
	 * )
	 */
	private $outlets;

	/**
	 * @var \Debb\ManagementBundle\Entity\Heatsink[]
	 *
	 * @ORM\ManyToMany(targetEntity="Debb\ManagementBundle\Entity\Heatsink")
	 * @ORM\JoinTable(name="debbcomplex_heatsink",
	 *   joinColumns={@ORM\JoinColumn(name="debbcomplex", referencedColumnName="id")},
	 *   inverseJoinColumns={@ORM\JoinColumn(name="heatsink", referencedColumnName="id")}
	 * )
	 */
	private $heatsinks;

	/**
	 * var \Debb\ManagementBundle\Entity\Sensor[]
	 *
	 * @ORM\ManyToMany(targetEntity="Debb\ManagementBundle\Entity\Sensor")
	 * @ORM\JoinTable(name="debbcomplex_sensor",
	 *   joinColumns={@ORM\JoinColumn(name="debbcomplex", referencedColumnName="id")},
	 *   inverseJoinColumns={@ORM\JoinColumn(name="sensor", referencedColumnName="id")}
	 * )
	 */
	private $sensors;

	/**
	 * @var \Debb\ManagementBundle\Entity\Network[]
	 *
	 * @ORM\ManyToMany(targetEntity="Debb\ManagementBundle\Entity\Network")
	 * @ORM\JoinTable(name="debbcomplex_network",
	 *   joinColumns={@ORM\JoinColumn(name="debbcomplex", referencedColumnName="id")},
	 *   inverseJoinColumns={@ORM\JoinColumn(name="network", referencedColumnName="id")}
	 * )
	 */
	private $networks;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->inlets = new \Doctrine\Common\Collections\ArrayCollection();
        $this->outlets = new \Doctrine\Common\Collections\ArrayCollection();
        $this->heatsinks = new \Doctrine\Common\Collections\ArrayCollection();
        $this->sensors = new \Doctrine\Common\Collections\ArrayCollection();
        $this->networks = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add inlets
     *
     * @param \Debb\ManagementBundle\Entity\FlowPump $inlets
     * @return DEBBComplex
     */
    public function addInlet(\Debb\ManagementBundle\Entity\FlowPump $inlets)
    {
        $this->inlets[] = $inlets;
    
        return $this;
    }

    /**
     * Remove inlets
     *
     * @param \Debb\ManagementBundle\Entity\FlowPump $inlets
     */
    public function removeInlet(\Debb\ManagementBundle\Entity\FlowPump $inlets)
    {
        $this->inlets->removeElement($inlets);
    }

    /**
     * Get inlets
     *
     * @return \Debb\ManagementBundle\Entity\FlowPump[]
     */
    public function getInlets()
    {
        return $this->inlets;
    }

    /**
     * Add outlets
     *
     * @param \Debb\ManagementBundle\Entity\FlowPump $outlets
     * @return DEBBComplex
     */
    public function addOutlet(\Debb\ManagementBundle\Entity\FlowPump $outlets)
    {
        $this->outlets[] = $outlets;
    
        return $this;
    }

    /**
     * Remove outlets
     *
     * @param \Debb\ManagementBundle\Entity\FlowPump $outlets
     */
    public function removeOutlet(\Debb\ManagementBundle\Entity\FlowPump $outlets)
    {
        $this->outlets->removeElement($outlets);
    }

    /**
     * Get outlets
     *
     * @return \Debb\ManagementBundle\Entity\FlowPump[]
     */
    public function getOutlets()
    {
        return $this->outlets;
    }

    /**
     * Add heatsinks
     *
     * @param \Debb\ManagementBundle\Entity\Heatsink $heatsinks
     * @return DEBBComplex
     */
    public function addHeatsink(\Debb\ManagementBundle\Entity\Heatsink $heatsinks)
    {
        $this->heatsinks[] = $heatsinks;
    
        return $this;
    }

    /**
     * Remove heatsinks
     *
     * @param \Debb\ManagementBundle\Entity\Heatsink $heatsinks
     */
    public function removeHeatsink(\Debb\ManagementBundle\Entity\Heatsink $heatsinks)
    {
        $this->heatsinks->removeElement($heatsinks);
    }

    /**
     * Get heatsinks
     *
     * @return \Debb\ManagementBundle\Entity\Heatsink[]
     */
    public function getHeatsinks()
    {
        return $this->heatsinks;
    }

    /**
     * Add sensors
     *
     * @param \Debb\ManagementBundle\Entity\Sensor $sensors
     * @return DEBBComplex
     */
    public function addSensor(\Debb\ManagementBundle\Entity\Sensor $sensors)
    {
        $this->sensors[] = $sensors;
    
        return $this;
    }

    /**
     * Remove sensors
     *
     * @param \Debb\ManagementBundle\Entity\Sensor $sensors
     */
    public function removeSensor(\Debb\ManagementBundle\Entity\Sensor $sensors)
    {
        $this->sensors->removeElement($sensors);
    }

    /**
     * Get sensors
     *
     * @return \Debb\ManagementBundle\Entity\Sensor[]
     */
    public function getSensors()
    {
        return $this->sensors;
    }

    /**
     * Add networks
     *
     * @param \Debb\ManagementBundle\Entity\Network $networks
     * @return DEBBComplex
     */
    public function addNetwork(\Debb\ManagementBundle\Entity\Network $networks)
    {
        $this->networks[] = $networks;
    
        return $this;
    }

    /**
     * Remove networks
     *
     * @param \Debb\ManagementBundle\Entity\Network $networks
     */
    public function removeNetwork(\Debb\ManagementBundle\Entity\Network $networks)
    {
        $this->networks->removeElement($networks);
    }

    /**
     * Get networks
     *
     * @return \Debb\ManagementBundle\Entity\Network[]
     */
    public function getNetworks()
    {
        return $this->networks;
    }
}