<?php

namespace Debb\ManagementBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Box
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Box extends \Debb\ConfigBundle\Entity\Dimensions
{

    /**
     * @var Image
     *
	 * @ORM\ManyToOne(targetEntity="Debb\ManagementBundle\Entity\File", cascade={"all"})
     */
    private $image;

	/**
	 * @var integer
	 *
	 * @ORM\Column(name="slots", type="integer")
	 */
	private $slots;

}
