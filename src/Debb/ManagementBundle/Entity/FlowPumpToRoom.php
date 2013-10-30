<?php

namespace Debb\ManagementBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * FlowPumpToRoom
 *
 * @ORM\Table(name="flowpumptoroom")
 * @ORM\Entity
 */
class FlowPumpToRoom extends ConnectorExtended
{

	/**
	 * @var FlowPump
	 *
	 * @ORM\ManyToOne(targetEntity="Debb\ManagementBundle\Entity\FlowPump", inversedBy="flowPumpToRooms")
	 * @ORM\JoinColumn(name="flowpump_id", referencedColumnName="id", onDelete="cascade")
	 */
	private $flowPump;

	/**
	 * @var Room
	 *
	 * @ORM\ManyToOne(targetEntity="Debb\ConfigBundle\Entity\Room", inversedBy="flowPumps")
	 * @ORM\JoinColumn(name="room_id", referencedColumnName="id", onDelete="cascade")
	 */
	private $room;

	/**
	 * Set flowPump
	 *
	 * @param \Debb\ManagementBundle\Entity\FlowPump $flowPump
	 * @return FlowPumpToRoom
	 */
	public function setFlowPump(FlowPump $flowPump = null)
	{
		$this->flowPump = $flowPump;

		return $this;
	}

	/**
	 * Get flowPump
	 *
	 * @return \Debb\ManagementBundle\Entity\FlowPump
	 */
	public function getFlowPump()
	{
		return $this->flowPump;
	}

	/**
	 * Set room
	 *
	 * @param \Debb\ConfigBundle\Entity\Room $room
	 * @return FlowPumpToRoom
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

	function __toString()
	{
		return (string) $this->getRoom();
	}

	/**
	 * @return \Debb\ConfigBundle\Entity\Room
	 */
	public function getHigherElement()
	{
		return $this->getRoom();
	}
}