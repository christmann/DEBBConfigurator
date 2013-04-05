<?php

namespace Debb\ManagementBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * RackToRoom
 *
 * @ORM\Table()
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
	 * @ORM\ManyToOne(targetEntity="Debb\ConfigBundle\Entity\Room")
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
		$this->posX = $posX;

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
		$this->posY = $posY;

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

}