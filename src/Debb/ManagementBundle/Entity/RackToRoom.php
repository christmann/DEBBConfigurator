<?php

namespace Debb\ManagementBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * RackToRoom
 *
 * @ORM\Table(name="racktoroom")
 * @ORM\Entity
 */
class RackToRoom extends Connector
{

	/**
	 * @var Rack
	 *
	 * @ORM\ManyToOne(targetEntity="Debb\ConfigBundle\Entity\Rack")
	 * @ORM\JoinColumn(name="rack_id", referencedColumnName="id", onDelete="cascade")
	 */
	private $rack;

	/**
	 * @var Room
	 *
	 * @ORM\ManyToOne(targetEntity="Debb\ConfigBundle\Entity\Room", inversedBy="racks")
	 * @ORM\JoinColumn(name="room_id", referencedColumnName="id", onDelete="cascade")
	 */
	private $room;

	/**
	 * @var integer
	 *
	 * @ORM\Column(name="posx", type="integer")
	 */
	private $posX;

	/**
	 * @var integer
	 *
	 * @ORM\Column(name="posy", type="integer")
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
	 * Set rack
	 *
	 * @param \Debb\ConfigBundle\Entity\Rack $rack
	 * @return RackToRoom
	 */
	public function setRack(\Debb\ConfigBundle\Entity\Rack $rack = null)
	{
		$this->rack = $rack;

		return $this;
	}

	/**
	 * Get rack
	 *
	 * @return \Debb\ConfigBundle\Entity\Rack 
	 */
	public function getRack()
	{
		return $this->rack;
	}

	/**
	 * Set room
	 *
	 * @param \Debb\ConfigBundle\Entity\Room $room
	 * @return RackToRoom
	 */
	public function setRoom(\Debb\ConfigBundle\Entity\Room $room = null)
	{
		$this->room = $room;

		return $this;
	}

	/**
	 * Get room
	 *
	 * @return \Debb\ConfigBundle\Entity\Room 
	 */
	public function getRoom()
	{
		return $this->room;
	}

	/**
	 * Set posX
	 *
	 * @param integer $posX
	 * @return RackToRoom
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
		return $this->posX;
	}

	/**
	 * Set posY
	 *
	 * @param integer $posY
	 * @return RackToRoom
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
		return $this->posY;
	}

	/**
	 * Set posZ
	 *
	 * @param integer $posZ
	 * @return RackToRoom
	 */
	public function setPosZ($posZ)
	{
		if($posZ < 0)
		{
			$posZ = 0;
		}
		$this->posZ = round($posZ / 10) * 10;

		return $this;
	}

	/**
	 * Get posZ
	 *
	 * @return integer
	 */
	public function getPosZ()
	{
		return $this->posZ;
	}

    /**
     * Set rotation
     *
     * @param float $rotation
     * @return RackToRoom
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