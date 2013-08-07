<?php

namespace Debb\ManagementBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * NodeToNodegroup
 *
 * @ORM\Table(name="nodetonodegroup")
 * @ORM\Entity
 */
class NodeToNodegroup extends Connector
{

	/**
	 * @var Node
	 *
	 * @ORM\ManyToOne(targetEntity="Debb\ConfigBundle\Entity\Node")
	 * @ORM\JoinColumn(name="node_id", referencedColumnName="id", onDelete="cascade")
	 */
	private $node;

	/**
	 * @var NodeGroup
	 *
	 * @ORM\ManyToOne(targetEntity="Debb\ConfigBundle\Entity\NodeGroup", inversedBy="nodes")
	 * @ORM\JoinColumn(name="nodegroup_id", referencedColumnName="id", onDelete="cascade")
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

	/**
	 * Getter for undefined functions
	 *
	 * @param $name the name of function
	 * @param $arguments the arguments of function
	 *
	 * @return null|mixed the return value of the function
	 */
	function __call($name, $arguments)
	{
		/**
		 * getPosX, getPosY, getPosZ and getRotation
		 */
		if(preg_match('#^(getPos(X|Y|Z)|getRotation)$#i', $name))
		{
			$draft = $this->getNodeGroup()->getDraft();
			if($draft)
			{
				$typSpecs = $draft->getTypspecification(false);
				/** @var $typSpec ChassisTypSpecification */
				$typSpec = array_key_exists($this->getField(), $typSpecs) ? $typSpecs[$this->getField()] : null;
				if($typSpec && method_exists($typSpec, $name))
				{
					return $typSpec->$name();
				}
			}
		}
		return null;
	}
}