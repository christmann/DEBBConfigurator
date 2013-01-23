<?php

namespace Debb\ConfigBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Dimensions
 *
 * @ORM\MappedSuperclass
 */
class Dimensions extends \Debb\ManagementBundle\Entity\Base
{

	/**
	 * @var float
	 *
	 * @ORM\Column(name="sizeX", type="float", nullable=true)
	 */
	private $sizeX;

	/**
	 * @var float
	 *
	 * @ORM\Column(name="sizeY", type="float", nullable=true)
	 */
	private $sizeY;

	/**
	 * @var float
	 *
	 * @ORM\Column(name="sizeZ", type="float", nullable=true)
	 */
	private $sizeZ;

	/**
	 * @var float
	 *
	 * @ORM\Column(name="spaceLeft", type="float", nullable=true)
	 */
	private $spaceLeft;

	/**
	 * @var float
	 *
	 * @ORM\Column(name="spaceRight", type="float", nullable=true)
	 */
	private $spaceRight;

	/**
	 * @var float
	 *
	 * @ORM\Column(name="spaceTop", type="float", nullable=true)
	 */
	private $spaceTop;

	/**
	 * @var float
	 *
	 * @ORM\Column(name="spaceBottom", type="float", nullable=true)
	 */
	private $spaceBottom;

	/**
	 * @var float
	 *
	 * @ORM\Column(name="spaceFront", type="float", nullable=true)
	 */
	private $spaceFront;

	/**
	 * @var float
	 *
	 * @ORM\Column(name="spaceBehind", type="float", nullable=true)
	 */
	private $spaceBehind;

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
		return $this->sizeX;
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
		return $this->sizeY;
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
		return $this->sizeZ;
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
		return $this->spaceLeft;
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
		return $this->spaceRight;
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
		return $this->spaceTop;
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
		return $this->spaceBottom;
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
		return $this->spaceFront;
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
		return $this->spaceBehind;
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
			return
				($this->getSizeX() + $this->getSpaceLeft() + $this->getSpaceRight())
				* ($this->getSizeY() + $this->getSpaceTop() + $this->getSpaceBottom())
				* ($this->getSizeZ() + $this->getSpaceFront() + $this->getSpaceBehind());
		}
		return $this->getSizeX() * $this->getSizeY() * $this->getSizeZ();
	}

}