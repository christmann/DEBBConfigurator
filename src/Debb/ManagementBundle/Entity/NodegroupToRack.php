<?php

namespace Debb\ManagementBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * NodegroupToRack
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class NodegroupToRack extends Connector
{

	/**
	 * @var NodeGroup
	 *
	 * @ORM\OneToOne(targetEntity="Debb\ConfigBundle\Entity\NodeGroup")
	 */
	private $nodegroup;

	/**
	 * @var NodeGroup
	 *
	 * @ORM\OneToOne(targetEntity="Debb\ConfigBundle\Entity\Rack")
	 */
	private $rack;

}