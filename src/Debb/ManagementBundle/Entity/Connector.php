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
 * Connector for two things
 *
 * @ORM\MappedSuperclass
 * @author Patrick Bußmann <patrick.bussmann@christmann.info>
 */
class Connector
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
     * @var integer
     *
     * @ORM\Column(name="field", type="integer", nullable=true)
     */
    private $field;

	/**
	 * @var integer
	 *
	 * @ORM\Column(name="posx", type="integer", nullable=true)
	 */
	private $posX;

	/**
	 * @var integer
	 *
	 * @ORM\Column(name="posy", type="integer", nullable=true)
	 */
	private $posY;

	/**
	 * @var integer
	 *
	 * @ORM\Column(name="posz", type="integer", nullable=true)
	 */
	private $posZ;

	/**
	 * @var float
	 *
	 * @ORM\Column(name="rotation", type="float", nullable=true)
	 */
	private $rotation;

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
		}
	}

    /**
     * Set field (x = 0, y = 0 - first field = 0, next field (x = 10, y = 0) = 1, next/third field (x = 0, y = 10) = 2, ...
	 *
	 * 6 7 8
	 * 3 4 5
	 * 0 1 2
     *
     * @param integer $field
     * @return Connector
     */
    public function setField($field)
    {
        $this->field = $field;
    
        return $this;
    }

    /**
     * Get field (x = 0, y = 0 - first field = 0, next field (x = 0, y = 10) = 1, next/third field (x = 10, y = 0) = 2, ...
     *
     * @return integer 
     */
    public function getField()
    {
        return $this->field;
    }

	/**
	 * Set posX
	 *
	 * @param integer $posX
	 * @return FlowPumpToChassis
	 */
	public function setPosX($posX)
	{
		if($posX < 0)
		{
			$posX = 0;
		}
		$this->posX = round($posX / 10) * 10;

		return $this;
	}

	/**
	 * Get posX
	 *
	 * @return integer
	 */
	public function getPosX()
	{
		return (int) $this->posX;
	}

	/**
	 * Set posY
	 *
	 * @param integer $posY
	 * @return FlowPumpToChassis
	 */
	public function setPosY($posY)
	{
		if($posY < 0)
		{
			$posY = 0;
		}
		$this->posY = round($posY / 10) * 10;

		return $this;
	}

	/**
	 * Get posY
	 *
	 * @return integer
	 */
	public function getPosY()
	{
		return (int) $this->posY;
	}

	/**
	 * Set posZ
	 *
	 * @param integer $posZ
	 * @return FlowPumpToChassis
	 */
	public function setPosZ($posZ)
	{
		if($posZ < 0)
		{
			$posZ = 0;
		}
		$this->posZ = round($posZ);

		return $this;
	}

	/**
	 * Get posZ
	 *
	 * @return integer
	 */
	public function getPosZ()
	{
		return (int) $this->posZ;
	}

	/**
	 * Set rotation
	 *
	 * @param float $rotation
	 * @return FlowPumpToChassis
	 */
	public function setRotation($rotation)
	{
		$this->rotation = $rotation;

		return $this;
	}

	/**
	 * Get rotation
	 *
	 * @return float
	 */
	public function getRotation()
	{
		return (float) $this->rotation;
	}
}
