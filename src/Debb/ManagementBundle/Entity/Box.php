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
 * Box
 *
 * @ORM\Table(name="box")
 * @ORM\Entity(repositoryClass="Debb\ManagementBundle\Repository\BaseRepository")
 * @author Patrick Bußmann <patrick.bussmann@christmann.info>
 */
class Box extends \Debb\ConfigBundle\Entity\Dimensions
{
	/**
	 * @var Image
	 *
	 * @ORM\ManyToOne(targetEntity="Debb\ManagementBundle\Entity\File", cascade={"all"})
	 */
	private $image;

	/**
	 * @var integer
	 *
	 * @ORM\Column(name="slots", type="integer")
	 */
	private $slots;

	/**
	 * Duplicate this entity
	 */
	public function __clone()
	{
		if ($this->getId() > 0)
		{
			parent::__clone();

			if($this->getImage() !== null)
			{
				$this->image = clone $this->image;
			}
		}
	}

	/**
	 * Set slots
	 *
	 * @param integer $slots
	 * @return Box
	 */
	public function setSlots($slots)
	{
		$this->slots = $slots;

		return $this;
	}

	/**
	 * Get slots
	 *
	 * @return integer 
	 */
	public function getSlots()
	{
		return $this->slots;
	}

	/**
	 * Set image
	 *
	 * @param \Debb\ManagementBundle\Entity\File $image
	 * @return Box
	 */
	public function setImage(\Debb\ManagementBundle\Entity\File $image = null)
	{
		$this->image = $image;

		return $this;
	}

	/**
	 * Get image
	 *
	 * @return \Debb\ManagementBundle\Entity\File 
	 */
	public function getImage()
	{
		return $this->image;
	}

	/**
	 * Returns a array for later converting
	 * 
	 * @return array the array for later converting
	 */
	public function getDebbXmlArray()
	{
		$array = parent::getDebbXmlArray();
		if ($this->getSlots() !== null)
		{
			$array['Slots'] = $this->getSlots();
		}
		return $array;
	}

}