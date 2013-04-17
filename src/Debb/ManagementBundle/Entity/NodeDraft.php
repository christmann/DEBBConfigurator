<?php

namespace Debb\ManagementBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * NodeDraft
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class NodeDraft extends Base
{
    /**
     * @var Image
     *
     * @ORM\ManyToOne(targetEntity="Debb\ManagementBundle\Entity\File", cascade={"all"})
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
     * Set image
     *
     * @param string $image
     * @return NodeDraft
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
     * @return NodeDraft
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
     * @return NodeDraft
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
     * @return NodeDraft
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
}