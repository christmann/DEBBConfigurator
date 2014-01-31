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
 * DebbConnector
 *
 * @ORM\Table(name="debbconnector")
 * @ORM\Entity(repositoryClass="Debb\ManagementBundle\Repository\BaseRepository")
 * @author Patrick Bußmann <patrick.bussmann@christmann.info>
 */
class DebbConnector extends DEBBComplex
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
     * @ORM\Column(name="number", type="integer")
     */
    private $number;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     * @ORM\Column(name="connector_type", type="string", length=255)
     */
    private $connectorType;

	/**
	 * @var string
	 *
	 * @Assert\NotBlank()
	 * @ORM\Column(name="con_label", type="string", length=255)
	 */
	private $conLabel;

	/**
	 * The transform element contains relative position and rotations.
	 * It might be the same transform syntax than in PLMXML but depend on our needs.
	 *
	 * @var string
	 *
	 * @ORM\Column(name="transform", type="string", length=255, nullable=true)
	 */
	private $transform;

	/**
	 * Size as space separated string with max XYZ sizes
	 *
	 * @var string
	 *
	 * @ORM\Column(name="avail_space", type="string", length=255, nullable=true)
	 */
	private $availSpace;

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
     * Set number
     *
     * @param integer $number
     * @return DebbConnector
     */
    public function setNumber($number)
    {
        $this->number = $number;
    
        return $this;
    }

    /**
     * Get number
     *
     * @return integer 
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * Set connectorType
     *
     * @param string $connectorType
     * @return DebbConnector
     */
    public function setConnectorType($connectorType)
    {
        $this->connectorType = $connectorType;
    
        return $this;
    }

    /**
     * Get connectorType
     *
     * @return string 
     */
    public function getConnectorType()
    {
        return $this->connectorType;
    }

    /**
     * Set conLabel
     *
     * @param string $conLabel
     * @return DebbConnector
     */
    public function setConLabel($conLabel)
    {
        $this->conLabel = $conLabel;
    
        return $this;
    }

    /**
     * Get conLabel
     *
     * @return string 
     */
    public function getConLabel()
    {
        return $this->conLabel;
    }

    /**
     * Set transform
     *
     * @param string $transform
     * @return DebbConnector
     */
    public function setTransform($transform)
    {
        $this->transform = $transform;
    
        return $this;
    }

    /**
     * Get transform
     *
     * @return string 
     */
    public function getTransform()
    {
        return $this->transform;
    }

    /**
     * Set availSpace
     *
     * @param string $availSpace
     * @return DebbConnector
     */
    public function setAvailSpace($availSpace)
    {
        $this->availSpace = $availSpace;
    
        return $this;
    }

    /**
     * Get availSpace
     *
     * @return string 
     */
    public function getAvailSpace()
    {
        return $this->availSpace;
    }
}