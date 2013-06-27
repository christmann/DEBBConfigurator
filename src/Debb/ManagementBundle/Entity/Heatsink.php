<?php

namespace Debb\ManagementBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Heatsink
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Heatsink extends Base
{
	/**
	 * @var VRML
	 *
	 * @ORM\ManyToOne(targetEntity="Debb\ManagementBundle\Entity\File", cascade={"all"})
	 */
	private $vrmlFile;

	/**
	 * @var STL
	 *
	 * @ORM\ManyToOne(targetEntity="Debb\ManagementBundle\Entity\File", cascade={"all"})
	 */
	private $stlFile;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="type", type="string", length=4, nullable=true)
	 */
	private $type;

    /**
     * Set type
     *
     * @param string $type
     * @return Heatsink
     */
    public function setType($type)
    {
        $this->type = $type;
    
        return $this;
    }

    /**
     * Get type
     *
     * @return string 
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set vrmlFile
     *
     * @param \Debb\ManagementBundle\Entity\File $vrmlFile
     * @return Heatsink
     */
    public function setVrmlFile(\Debb\ManagementBundle\Entity\File $vrmlFile = null)
    {
        $this->vrmlFile = $vrmlFile;
    
        return $this;
    }

    /**
     * Get vrmlFile
     *
     * @return \Debb\ManagementBundle\Entity\File 
     */
    public function getVrmlFile()
    {
        return $this->vrmlFile;
    }

    /**
     * Set stlFile
     *
     * @param \Debb\ManagementBundle\Entity\File $stlFile
     * @return Heatsink
     */
    public function setStlFile(\Debb\ManagementBundle\Entity\File $stlFile = null)
    {
        $this->stlFile = $stlFile;
    
        return $this;
    }

    /**
     * Get stlFile
     *
     * @return \Debb\ManagementBundle\Entity\File 
     */
    public function getStlFile()
    {
        return $this->stlFile;
    }
}