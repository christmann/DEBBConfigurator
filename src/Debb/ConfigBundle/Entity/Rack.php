<?php

namespace Debb\ConfigBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Rack
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Rack extends \Debb\ManagementBundle\Entity\Base
{
	/**
	 * @ORM\ManyToMany(targetEntity="NodeGroup", cascade={"persist"})
	 */
	private $nodeGroups;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->nodeGroups = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add nodeGroups
     *
     * @param \Debb\ConfigBundle\Entity\NodeGroup $nodeGroups
     * @return Rack
     */
    public function addNodeGroup(\Debb\ConfigBundle\Entity\NodeGroup $nodeGroups)
    {
        $this->nodeGroups[] = $nodeGroups;
    
        return $this;
    }

    /**
     * Remove nodeGroups
     *
     * @param \Debb\ConfigBundle\Entity\NodeGroup $nodeGroups
     */
    public function removeNodeGroup(\Debb\ConfigBundle\Entity\NodeGroup $nodeGroups)
    {
        $this->nodeGroups->removeElement($nodeGroups);
    }

    /**
     * Get nodeGroups
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getNodeGroups()
    {
        return $this->nodeGroups;
    }
}