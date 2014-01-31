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

namespace Debb\ConfigBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Dimensions
 *
 * @ORM\MappedSuperclass
 * @author Patrick Bußmann <patrick.bussmann@christmann.info>
 */
class Dimensions extends \Debb\ManagementBundle\Entity\Base
{
	/**
	 * @var float
	 *
	 * @ORM\Column(name="sizeX", type="float", nullable=true)
	 */
	private $sizeX = 0;

	/**
	 * @var float
	 *
	 * @ORM\Column(name="sizeY", type="float", nullable=true)
	 */
	private $sizeY = 0;

	/**
	 * @var float
	 *
	 * @ORM\Column(name="sizeZ", type="float", nullable=true)
	 */
	private $sizeZ = 0;

	/**
	 * @var float
	 *
	 * @ORM\Column(name="spaceLeft", type="float", nullable=true)
	 */
	private $spaceLeft = 0;

	/**
	 * @var float
	 *
	 * @ORM\Column(name="spaceRight", type="float", nullable=true)
	 */
	private $spaceRight = 0;

	/**
	 * @var float
	 *
	 * @ORM\Column(name="spaceTop", type="float", nullable=true)
	 */
	private $spaceTop = 0;

	/**
	 * @var float
	 *
	 * @ORM\Column(name="spaceBottom", type="float", nullable=true)
	 */
	private $spaceBottom = 0;

	/**
	 * @var float
	 *
	 * @ORM\Column(name="spaceFront", type="float", nullable=true)
	 */
	private $spaceFront = 0;

	/**
	 * @var float
	 *
	 * @ORM\Column(name="spaceBehind", type="float", nullable=true)
	 */
	private $spaceBehind = 0;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="mesh_resolution", type="string", length=30, nullable=true)
	 */
	private $meshResolution;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="location_in_mesh", type="string", length=60, nullable=true)
	 */
	private $locationInMesh;

	/**
	 * Set sizeX
	 *
	 * @param float $sizeX
	 * @return Dimensions
	 */
	public function setSizeX($sizeX)
	{
		$this->sizeX = $sizeX;

		return $this;
	}

	/**
	 * Get sizeX
	 *
	 * @return float 
	 */
	public function getSizeX()
	{
		return (float) $this->sizeX;
	}

	/**
	 * Set sizeY
	 *
	 * @param float $sizeY
	 * @return Dimensions
	 */
	public function setSizeY($sizeY)
	{
		$this->sizeY = $sizeY;

		return $this;
	}

	/**
	 * Get sizeY
	 *
	 * @return float 
	 */
	public function getSizeY()
	{
		return (float) $this->sizeY;
	}

	/**
	 * Set sizeZ
	 *
	 * @param float $sizeZ
	 * @return Dimensions
	 */
	public function setSizeZ($sizeZ)
	{
		$this->sizeZ = $sizeZ;

		return $this;
	}

	/**
	 * Get sizeZ
	 *
	 * @return float 
	 */
	public function getSizeZ()
	{
		return (float) $this->sizeZ;
	}

	/**
	 * Set spaceLeft
	 *
	 * @param float $spaceLeft
	 * @return Dimensions
	 */
	public function setSpaceLeft($spaceLeft)
	{
		$this->spaceLeft = $spaceLeft;

		return $this;
	}

	/**
	 * Get spaceLeft
	 *
	 * @return float 
	 */
	public function getSpaceLeft()
	{
		return (float) $this->spaceLeft;
	}

	/**
	 * Set spaceRight
	 *
	 * @param float $spaceRight
	 * @return Dimensions
	 */
	public function setSpaceRight($spaceRight)
	{
		$this->spaceRight = $spaceRight;

		return $this;
	}

	/**
	 * Get spaceRight
	 *
	 * @return float 
	 */
	public function getSpaceRight()
	{
		return (float) $this->spaceRight;
	}

	/**
	 * Set spaceTop
	 *
	 * @param float $spaceTop
	 * @return Dimensions
	 */
	public function setSpaceTop($spaceTop)
	{
		$this->spaceTop = $spaceTop;

		return $this;
	}

	/**
	 * Get spaceTop
	 *
	 * @return float 
	 */
	public function getSpaceTop()
	{
		return (float) $this->spaceTop;
	}

	/**
	 * Set spaceBottom
	 *
	 * @param float $spaceBottom
	 * @return Dimensions
	 */
	public function setSpaceBottom($spaceBottom)
	{
		$this->spaceBottom = $spaceBottom;

		return $this;
	}

	/**
	 * Get spaceBottom
	 *
	 * @return float 
	 */
	public function getSpaceBottom()
	{
		return (float) $this->spaceBottom;
	}

	/**
	 * Set spaceFront
	 *
	 * @param float $spaceFront
	 * @return Dimensions
	 */
	public function setSpaceFront($spaceFront)
	{
		$this->spaceFront = $spaceFront;

		return $this;
	}

	/**
	 * Get spaceFront
	 *
	 * @return float 
	 */
	public function getSpaceFront()
	{
		return (float) $this->spaceFront;
	}

	/**
	 * Set spaceBehind
	 *
	 * @param float $spaceBehind
	 * @return Dimensions
	 */
	public function setSpaceBehind($spaceBehind)
	{
		$this->spaceBehind = $spaceBehind;

		return $this;
	}

	/**
	 * Get spaceBehind
	 *
	 * @return float 
	 */
	public function getSpaceBehind()
	{
		return (float) $this->spaceBehind;
	}

	/**
	 * Set MeshResolution
	 *
	 * @param string $meshResolution
	 * @return Dimensions
	 */
	public function setMeshResolution($meshResolution)
	{
		$this->meshResolution = $meshResolution;

		return $this;
	}

	/**
	 * Get MeshResolution
	 *
	 * @return string|null
	 */
	public function getMeshResolution()
	{
		return $this->meshResolution;
	}

	/**
	 * Check if mesh resolution is correct
	 *
	 * @Assert\True(message = "Please use a mesh resolution like 3 3 3 or 1 2 3.")
	 */
	public function isMeshResolutionLegal()
	{
		return $this->meshResolution === null || preg_match('#^(\d+[ ]{0,1}){3}$#i', $this->meshResolution) === 1;
	}

	/**
	 * Set locationInMesh
	 *
	 * @param string $locationInMesh
	 * @return Dimensions
	 */
	public function setLocationInMesh($locationInMesh)
	{
		$this->locationInMesh = $locationInMesh;

		return $this;
	}

	/**
	 * Get locationInMesh
	 *
	 * @return string|null
	 */
	public function getLocationInMesh()
	{
		return $this->locationInMesh;
	}

	/**
	 * Check if location in mesh is correct
	 *
	 * @Assert\True(message = "Please use a location in mesh like 3 -3 3 or 3.3 3.3 -3.3")
	 */
	public function isLocationInMeshLegal()
	{
		return $this->locationInMesh === null || preg_match('#^([-]{0,1}\d+(\.\d+){0,1}[ ]{0,1}){3}$#i', $this->locationInMesh) === 1;
	}

	/**
	 * Get complete x size with space
	 * 
	 * @return float complete x size with space
	 */
	public function getFullX()
	{
		return $this->getSizeX() + $this->getSpaceLeft() + $this->getSpaceRight();
	}

	/**
	 * Get complete y size with space
	 * 
	 * @return float complete y size with space
	 */
	public function getFullY()
	{
		return $this->getSizeY() + $this->getSpaceTop() + $this->getSpaceBottom();
	}

	/**
	 * Get complete z size with space
	 * 
	 * @return float complete z size with space
	 */
	public function getFullZ()
	{
		return $this->getSizeZ() + $this->getSpaceFront() + $this->getSpaceBehind();
	}

	/**
	 * Get volume
	 * 
	 * @return float volume
	 */
	public function getVolume($incSpace = false)
	{
		if ($incSpace)
		{
			$ret = ($this->getSizeX() + $this->getSpaceLeft() + $this->getSpaceRight())
					* ($this->getSizeY() + $this->getSpaceTop() + $this->getSpaceBottom())
					* ($this->getSizeZ() + $this->getSpaceFront() + $this->getSpaceBehind());
		}
		else
		{
			$ret = $this->getSizeX() * $this->getSizeY() * $this->getSizeZ();
		}
		return (float) $ret;
	}
}