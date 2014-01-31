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

/**
 * NodeToChassis
 *
 * @ORM\Table(name="chassis_typ_specification")
 * @ORM\Entity()
 * @author Patrick Bußmann <patrick.bussmann@christmann.info>
 */
class ChassisTypSpecification extends ConnectorExtended
{
	/**
	 * @var \Debb\ManagementBundle\Entity\Chassis
	 *
	 * @ORM\ManyToOne(targetEntity="Debb\ManagementBundle\Entity\Chassis", inversedBy="typspecification")
	 * @ORM\JoinColumn(name="chassis_id", referencedColumnName="id", onDelete="cascade")
	 */
	private $chassis;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="typ", type="string", length=4, nullable=true)
	 */
	private $typ;

    /**
     * Set chassis
     *
     * @param \Debb\ManagementBundle\Entity\Chassis $chassis
     * @return ChassisTypSpecification
     */
    public function setChassis(\Debb\ManagementBundle\Entity\Chassis $chassis = null)
    {
        $this->chassis = $chassis;
    
        return $this;
    }

    /**
     * Get chassis
     *
     * @return \Debb\ManagementBundle\Entity\Chassis 
     */
    public function getChassis()
    {
        return $this->chassis;
    }

    /**
     * Set typ
     *
     * @param string $typ
     * @return ChassisTypSpecification
     */
    public function setTyp($typ)
    {
        $this->typ = $typ;
    
        return $this;
    }

    /**
     * Get typ
     *
     * @return string 
     */
    public function getTyp()
    {
        return $this->typ;
    }

	/**
	 * Convert this ChassisTypSpecification into (json) array
	 *
	 * @param bool $json should the return value be a array or a json string
	 * @return array|string the ChassisTypSpecification as json string or as array
	 */
	public function asArray($json = false)
	{
		$array = array(
			'posX' => $this->getPosX(),
			'posY' => $this->getPosY(),
			'rotation' => $this->getRotation(),
			'typ' => $this->getTyp()
		);
		return $json ? json_encode($array) : $array;
	}

	/**
	 * @return Chassis
	 */
	public function getHigherElement()
	{
		return $this->getChassis();
	}

	/**
	 * @return string
	 */
	function __toString()
	{
		return (string) $this->getChassis();
	}
}