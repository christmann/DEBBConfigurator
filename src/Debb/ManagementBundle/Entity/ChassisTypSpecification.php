<?php

namespace Debb\ManagementBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * NodeToChassis
 *
 * @ORM\Table(name="chassis_typ_specification")
 * @ORM\Entity
 */
class ChassisTypSpecification extends Connector
{
	/**
	 * @var \Debb\ManagementBundle\Entity\Chassis
	 *
	 * @ORM\ManyToOne(targetEntity="Debb\ManagementBundle\Entity\Chassis", inversedBy="typspecification")
	 * @ORM\JoinColumn(name="chassis_id", referencedColumnName="id", onDelete="cascade")
	 */
	private $chassis;

	/**
	 * @var integer
	 *
	 * @ORM\Column(name="posx", type="integer")
	 */
	private $posX = 0;

	/**
	 * @var integer
	 *
	 * @ORM\Column(name="posy", type="integer")
	 */
	private $posY = 0;

	/**
	 * @var float
	 *
	 * @ORM\Column(name="posz", type="float", nullable=true)
	 */
	private $posZ = 0;

	/**
	 * @var float
	 *
	 * @ORM\Column(name="rotation", type="float", nullable=true)
	 */
	private $rotation = 0;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="typ", type="string", length=4, nullable=true)
	 */
	private $typ;

    /**
     * Set posX
     *
     * @param integer $posX
     * @return ChassisTypSpecification
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
     * @return ChassisTypSpecification
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

    /**
     * Set posZ
     *
     * @param float $posZ
     * @return ChassisTypSpecification
     */
    public function setPosZ($posZ)
    {
        $this->posZ = $posZ;
    
        return $this;
    }

    /**
     * Get posZ
     *
     * @return float 
     */
    public function getPosZ()
    {
        return $this->posZ;
    }

    /**
     * Set rotation
     *
     * @param float $rotation
     * @return ChassisTypSpecification
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
        return $this->rotation;
    }

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
}