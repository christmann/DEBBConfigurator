<?php
/**
 * DEBBConfigurator - A configurator for DEBB component and PLMXML files
 * Copyright (C) 2013-2014 christmann informationstechnik + medien GmbH & Co. KG
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Library General Public
 * License as published by the Free Software Foundation; either
 * version 2 of the License, or (at your option) any later version.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
 * Library General Public License for more details.
 *
 * You should have received a copy of the GNU Library General Public
 * License along with this library; if not, write to the
 * Free Software Foundation, Inc., 51 Franklin St, Fifth Floor,
 * Boston, MA  02110-1301, USA.
 */

namespace Debb\ManagementBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * NodeToNodegroup
 *
 * @ORM\Table(name="nodetonodegroup")
 * @ORM\Entity()
 * @author Patrick Bußmann <patrick.bussmann@christmann.info>
 */
class NodeToNodegroup extends Connector
{

	/**
	 * @var Node
	 *
	 * @ORM\ManyToOne(targetEntity="Debb\ConfigBundle\Entity\Node", inversedBy="nodeGroups")
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
		if(preg_match('#^(getPos(X|Y|Z)|getRotation)$#i', $name) && $this->getNodeGroup() != null)
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

	function __toString()
	{
		return (string) $this->getNodeGroup();
	}

	/**
	 * @return \Debb\ConfigBundle\Entity\NodeGroup
	 */
	public function getHigherElement()
	{
		return $this->getNodeGroup();
	}
}