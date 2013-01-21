<?php

namespace Debb\ManagementBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * NodeToNodegroup
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class NodeToNodegroup extends Connector
{
    /**
     * @var Node
     *
	 * @ORM\OneToOne(targetEntity="Debb\ConfigBundle\Entity\Node")
     */
    private $node;

    /**
     * @var NodeGroup
     *
	 * @ORM\OneToOne(targetEntity="Debb\ConfigBundle\Entity\NodeGroup")
     */
    private $nodeGroup;

    /**
     * Set node
     *
     * @param \Debb\ConfigBundle\Entity\Node $node
     * @return NodeToNodegroup
     */
    public function setNode(\Debb\ConfigBundle\Entity\Node $node = null)
    {
        $this->node = $node;
    
        return $this;
    }

    /**
     * Get node
     *
     * @return \Debb\ConfigBundle\Entity\Node 
     */
    public function getNode()
    {
        return $this->node;
    }

    /**
     * Set nodeGroup
     *
     * @param \Debb\ConfigBundle\Entity\NodeGroup $nodeGroup
     * @return NodeToNodegroup
     */
    public function setNodeGroup(\Debb\ConfigBundle\Entity\NodeGroup $nodeGroup = null)
    {
        $this->nodeGroup = $nodeGroup;
    
        return $this;
    }

    /**
     * Get nodeGroup
     *
     * @return \Debb\ConfigBundle\Entity\NodeGroup 
     */
    public function getNodeGroup()
    {
        return $this->nodeGroup;
    }
}