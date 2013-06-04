<?php

namespace Debb\ManagementBundle\Entity;

use Debb\ConfigBundle\Entity\Dimensions;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Chassis
 *
 * @ORM\Table(name="chassis")
 * @ORM\Entity
 */
class Chassis extends Dimensions
{
    /**
     * @var Image
     *
     * @ORM\ManyToOne(targetEntity="Debb\ManagementBundle\Entity\File", cascade={"persist"})
     */
    private $image;

    /**
     * @var integer
     *
     * @ORM\Column(name="slots_x", type="integer")
     */
    private $slotsX;

    /**
     * @var integer
     *
     * @ORM\Column(name="slots_y", type="integer")
     */
    private $slotsY;

    /**
     * @var integer
     *
     * @ORM\Column(name="he_size", type="integer")
     */
    private $heSize;

	/**
	 * Field specification - typ
	 *
	 * @var array
	 *
	 * @ORM\Column(name="typspecification", type="array", nullable=true)
	 */
	private $typspecification;

	/**
	 * @var boolean
	 *
	 * @ORM\Column(name="frontview", type="boolean", nullable=true)
	 */
	private $frontview;

	/**
     * Set image
     *
     * @param string $image
     * @return Chassis
     */
    public function setImage($image)
    {
        $this->image = $image;
    
        return $this;
    }

    /**
     * Get image
     *
     * @return string 
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set slotsX
     *
     * @param integer $slotsX
     * @return Chassis
     */
    public function setSlotsX($slotsX)
    {
        $this->slotsX = $slotsX;
    
        return $this;
    }

    /**
     * Get slotsX
     *
     * @return integer 
     */
    public function getSlotsX()
    {
        return $this->slotsX;
    }

    /**
     * Set slotsY
     *
     * @param integer $slotsY
     * @return Chassis
     */
    public function setSlotsY($slotsY)
    {
        $this->slotsY = $slotsY;
    
        return $this;
    }

    /**
     * Get slotsY
     *
     * @return integer 
     */
    public function getSlotsY()
    {
        return $this->slotsY;
    }

    /**
     * Set heSize
     *
     * @param integer $heSize
     * @return Chassis
     */
    public function setHeSize($heSize)
    {
        $this->heSize = $heSize;
    
        return $this;
    }

    /**
     * Get heSize
     *
     * @return integer 
     */
    public function getHeSize()
    {
        return $this->heSize;
    }

    /**
     * Set typspecification
     *
     * @param array $typspecification
     * @return Chassis
     */
    public function setTypspecification($typspecification)
    {
        $this->typspecification = $typspecification;
    
        return $this;
    }

    /**
     * Get typspecification
     *
     * @return array 
     */
    public function getTypspecification()
    {
		if(is_array($this->typspecification))
		{
			reset($this->typspecification);
			if(key($this->typspecification) != 0)
			{
				ksort($this->typspecification);
			}
		}
        return $this->typspecification;
    }

    /**
     * Set frontview
     *
     * @param boolean $frontview
     * @return Chassis
     */
    public function setFrontView($frontview)
    {
        $this->frontview = $frontview;
    
        return $this;
    }

    /**
     * Is frontview?
     *
     * @return boolean
     */
    public function isFrontView()
    {
        return $this->frontview != null && $this->frontview == 1;
    }
}
