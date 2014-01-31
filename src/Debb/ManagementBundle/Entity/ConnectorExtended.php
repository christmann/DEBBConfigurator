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
 * Connector-Extended for custom position x/y/z
 *
 * @ORM\MappedSuperclass
 * @author Patrick Bußmann <patrick.bussmann@christmann.info>
 */
class ConnectorExtended extends Connector
{
	/**
	 * @var float
	 *
	 * @ORM\Column(name="custom_pos_x", type="decimal", precision=18, scale=9, nullable=true)
	 */
	private $customPosX;

	/**
	 * @var float
	 *
	 * @ORM\Column(name="custom_pos_y", type="decimal", precision=18, scale=9, nullable=true)
	 */
	private $customPosY;

	/**
	 * @var float
	 *
	 * @ORM\Column(name="custom_pos_z", type="decimal", precision=18, scale=9, nullable=true)
	 */
	private $customPosZ;

    /**
     * Set customPosX
     *
     * @param float $customPosX
     * @return ConnectorExtended
     */
    public function setCustomPosX($customPosX)
    {
        $this->customPosX = $customPosX ?: null;
    
        return $this;
    }

    /**
     * Get customPosX
     *
     * @return float 
     */
    public function getCustomPosX()
    {
        return $this->customPosX;
    }

    /**
     * Set customPosY
     *
     * @param float $customPosY
     * @return ConnectorExtended
     */
    public function setCustomPosY($customPosY)
    {
        $this->customPosY = $customPosY ?: null;
    
        return $this;
    }

    /**
     * Get customPosY
     *
     * @return float 
     */
    public function getCustomPosY()
    {
        return $this->customPosY;
    }

    /**
     * Set customPosZ
     *
     * @param float $customPosZ
     * @return ConnectorExtended
     */
    public function setCustomPosZ($customPosZ)
    {
        $this->customPosZ = $customPosZ ?: null;
    
        return $this;
    }

    /**
     * Get customPosZ
     *
     * @return float 
     */
    public function getCustomPosZ()
    {
        return $this->customPosZ;
    }
}