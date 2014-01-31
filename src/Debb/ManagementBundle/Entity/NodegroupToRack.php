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
 * NodegroupToRack
 *
 * @ORM\Table(name="nodegrouptorack")
 * @ORM\Entity()
 * @author Patrick Bußmann <patrick.bussmann@christmann.info>
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