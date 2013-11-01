<?php

namespace Debb\ManagementBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Connector for two things
 *
 * @ORM\MappedSuperclass
 */
class Connector
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
     * @ORM\Column(name="field", type="integer", nullable=true)
     */
    private $field;

	/**
	 * @var integer
	 *
	 * @ORM\Column(name="posx", type="integer", nullable=true)
	 */
	private $posX;

	/**
	 * @var integer
	 *
	 * @ORM\Column(name="posy", type="integer", nullable=true)
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
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set field (x = 0, y = 0 - first field = 0, next field (x = 10, y = 0) = 1, next/third field (x = 0, y = 10) = 2, ...
	 *
	 * 6 7 8
	 * 3 4 5
	 * 0 1 2
     *
     * @param integer $field
     * @return Connector
     */
    public function setField($field)
    {
        $this->field = $field;
    
        return $this;
    }

    /**
     * Get field (x = 0, y = 0 - first field = 0, next field (x = 0, y = 10) = 1, next/third field (x = 10, y = 0) = 2, ...
     *
     * @return integer 
     */
    public function getField()
    {
        return $this->field;
    }

	/**
	 * Set posX
	 *
	 * @param integer $posX
	 * @return FlowPumpToChassis
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
	 * @return FlowPumpToChassis
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
	 * @return FlowPumpToChassis
	 */
	public function setPosZ($posZ)
	{
		if($posZ < 0)
		{
			$posZ = 0;
		}
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
	 * @return FlowPumpToChassis
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
