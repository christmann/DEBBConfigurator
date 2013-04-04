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

}