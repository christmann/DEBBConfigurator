<?php

namespace Debb\ConfigBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * NodeGroup
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class NodeGroup extends \Debb\ManagementBundle\Entity\Base
{
	/**
	 * @ORM\OneToMany(targetEntity="Debb\ManagementBundle\Entity\NodeToNodegroup", cascade={"persist"}, mappedBy="nodeGroup", orphanRemoval=true)
	 */
	private $nodes;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->nodes = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add nodes
     *
     * @param \Debb\ConfigBundle\Entity\Node $nodes
     * @return NodeGroup
     */
    public function addNode(\Debb\ConfigBundle\Entity\Node $nodes)
    {
        $this->nodes[] = $nodes;
    
        return $this;
    }

    /**
     * Remove nodes
     *
     * @param \Debb\ConfigBundle\Entity\Node $nodes
     */
    public function removeNode(\Debb\ConfigBundle\Entity\Node $nodes)
    {
        $this->nodes->removeElement($nodes);
    }

    /**
     * Get nodes
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getNodes()
    {
        return $this->nodes;
    }
}