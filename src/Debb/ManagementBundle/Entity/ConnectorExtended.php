<?php

namespace Debb\ManagementBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Connector-Extended for custom position x/y/z
 *
 * @ORM\MappedSuperclass
 */
class ConnectorExtended extends Connector
{
	/**
	 * @var float
	 *
	 * @ORM\Column(name="custom_pos_x", type="decimal", precision=18, scale=9, nullable=true)
	 */
	private $customPosX;

	/**
	 * @var float
	 *
	 * @ORM\Column(name="custom_pos_y", type="decimal", precision=18, scale=9, nullable=true)
	 */
	private $customPosY;

	/**
	 * @var float
	 *
	 * @ORM\Column(name="custom_pos_z", type="decimal", precision=18, scale=9, nullable=true)
	 */
	private $customPosZ;

    /**
     * Set customPosX
     *
     * @param float $customPosX
     * @return ConnectorExtended
     */
    public function setCustomPosX($customPosX)
    {
        $this->customPosX = $customPosX ?: null;
    
        return $this;
    }

    /**
     * Get customPosX
     *
     * @return float 
     */
    public function getCustomPosX()
    {
        return $this->customPosX;
    }

    /**
     * Set customPosY
     *
     * @param float $customPosY
     * @return ConnectorExtended
     */
    public function setCustomPosY($customPosY)
    {
        $this->customPosY = $customPosY ?: null;
    
        return $this;
    }

    /**
     * Get customPosY
     *
     * @return float 
     */
    public function getCustomPosY()
    {
        return $this->customPosY;
    }

    /**
     * Set customPosZ
     *
     * @param float $customPosZ
     * @return ConnectorExtended
     */
    public function setCustomPosZ($customPosZ)
    {
        $this->customPosZ = $customPosZ ?: null;
    
        return $this;
    }

    /**
     * Get customPosZ
     *
     * @return float 
     */
    public function getCustomPosZ()
    {
        return $this->customPosZ;
    }
}