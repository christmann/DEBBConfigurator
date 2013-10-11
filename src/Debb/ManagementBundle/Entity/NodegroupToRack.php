<?php

namespace Debb\ManagementBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * NodegroupToRack
 *
 * @ORM\Table(name="nodegrouptorack")
 * @ORM\Entity
 */
class NodegroupToRack extends Connector
{

	/**
	 * @var NodeGroup
	 *
	 * @ORM\ManyToOne(targetEntity="Debb\ConfigBundle\Entity\NodeGroup", inversedBy="racks")
	 * @ORM\JoinColumn(name="nodegroup_id", referencedColumnName="id", onDelete="cascade")
	 */
	private $nodegroup;

	/**
	 * @var NodeGroup
	 *
	 * @ORM\ManyToOne(targetEntity="Debb\ConfigBundle\Entity\Rack", inversedBy="nodeGroups")
	 * @ORM\JoinColumn(name="rack_id", referencedColumnName="id", onDelete="cascade")
	 */
	private $rack;

	function __construct()
	{
		$this->setField((int) $this->getField());
	}

	/**
     * Set nodegroup
     *
     * @param \Debb\ConfigBundle\Entity\NodeGroup $nodegroup
     * @return NodegroupToRack
     */
    public function setNodegroup(\Debb\ConfigBundle\Entity\NodeGroup $nodegroup = null)
    {
        $this->nodegroup = $nodegroup;
    
        return $this;
    }

    /**
     * Get nodegroup
     *
     * @return \Debb\ConfigBundle\Entity\NodeGroup 
     */
    public function getNodegroup()
    {
        return $this->nodegroup;
    }

    /**
     * Set rack
     *
     * @param \Debb\ConfigBundle\Entity\Rack $rack
     * @return NodegroupToRack
     */
    public function setRack(\Debb\ConfigBundle\Entity\Rack $rack = null)
    {
        $this->rack = $rack;
    
        return $this;
    }

    /**
     * Get rack
     *
     * @return \Debb\ConfigBundle\Entity\Rack 
     */
    public function getRack()
    {
        return $this->rack;
    }

	function __toString()
	{
		return (string) $this->getRack();
	}

	/**
	 * @return \Debb\ConfigBundle\Entity\Rack
	 */
	public function getHigherElement()
	{
		return $this->getRack();
	}
}