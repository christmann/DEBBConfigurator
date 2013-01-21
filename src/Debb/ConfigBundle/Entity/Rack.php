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
	 * @ORM\OneToMany(targetEntity="Debb\ManagementBundle\Entity\NodeToNodegroup", cascade={"persist"}, mappedBy="rack", orphanRemoval=true)
	 */
	private $nodeGroups;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->nodeGroups = new \Doctrine\Common\Collections\ArrayCollection();
    }
}