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
 * Memory
 *
 * @ORM\Table(name="memory")
 * @ORM\Entity(repositoryClass="Debb\ManagementBundle\Repository\BaseRepository")
 * @author Patrick Bußmann <patrick.bussmann@christmann.info>
 */
class Memory extends Base
{
	/**
	 * Size of Capacity in MB
	 *
	 * @var integer
	 *
	 * @Assert\NotBlank()
	 * @ORM\Column(name="capacity", type="integer")
	 */
	private $capacity;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="interface", type="string", length=255, nullable=true)
	 */
	private $interface;

	/**
	 * Components
	 *
	 * @ORM\OneToMany(targetEntity="Debb\ManagementBundle\Entity\Component", cascade={"persist"}, mappedBy="memory", orphanRemoval=true)
	 *
	 * @var \Debb\ManagementBundle\Entity\Component[]
	 */
	private $components;

	/**
	 * Set capacity
	 *
	 * @param integer $capacity
	 * @return Memory
	 */
	public function setCapacity($capacity)
	{
		$this->capacity = $capacity;

		return $this;
	}

	/**
	 * Get capacity
	 *
	 * @return integer 
	 */
	public function getCapacity()
	{
		return $this->capacity;
	}

	/**
	 * Set interface
	 *
	 * @param string $interface
	 * @return Memory
	 */
	public function setInterface($interface)
	{
		$this->interface = $interface;

		return $this;
	}

	/**
	 * Get interface
	 *
	 * @return string
	 */
	public function getInterface()
	{
		return $this->interface;
	}

	/**
	 * Returns a array for later converting
	 * 
	 * @return array the array for later converting
	 */
	public function getDebbXmlArray()
	{
		$array = parent::getDebbXmlArray();
		$array['Capacity'] = (int) $this->getCapacity();
		if ($this->getInterface() !== null)
		{
			$array['Interface'] = $this->getInterface();
		}
		return $array;
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