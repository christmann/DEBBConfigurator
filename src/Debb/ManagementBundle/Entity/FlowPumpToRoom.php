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
class FlowPumpToRoom extends Connector
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

	/**
	 * Set posX
	 *
	 * @param integer $posX
	 * @return FlowPumpToRoom
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
	 * @return FlowPumpToRoom
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
	 * @return FlowPumpToRoom
	 */
	public function setPosZ($posZ)
	{
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
     * @return FlowPumpToRoom
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