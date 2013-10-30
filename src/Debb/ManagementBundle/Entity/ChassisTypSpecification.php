<?php

namespace Debb\ManagementBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * NodeToChassis
 *
 * @ORM\Table(name="chassis_typ_specification")
 * @ORM\Entity
 */
class ChassisTypSpecification extends ConnectorExtended
{
	/**
	 * @var \Debb\ManagementBundle\Entity\Chassis
	 *
	 * @ORM\ManyToOne(targetEntity="Debb\ManagementBundle\Entity\Chassis", inversedBy="typspecification")
	 * @ORM\JoinColumn(name="chassis_id", referencedColumnName="id", onDelete="cascade")
	 */
	private $chassis;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="typ", type="string", length=4, nullable=true)
	 */
	private $typ;

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

	/**
	 * @return string
	 */
	function __toString()
	{
		return (string) $this->getChassis();
	}
}