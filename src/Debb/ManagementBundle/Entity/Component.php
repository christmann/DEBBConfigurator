<?php

namespace Debb\ManagementBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Component
 *
 * @ORM\Table()
 * @ORM\Entity()
 */
class Component
{
	/**
	 * [Type] Nothing
	 *
	 * @var int
	 */
	const TYPE_NOTHING = 0;

	/**
	 * [Type] Mainboard
	 *
	 * @var int
	 */
	const TYPE_MAINBOARD = 1;

	/**
	 * [Type] Processor
	 *
	 * @var int
	 */
	const TYPE_PROCESSOR = 2;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="type", type="integer")
     */
    private $type = self::TYPE_NOTHING;

    /**
     * @var Debb\ConfigBundle\Entity\Node
     *
	 * @ORM\ManyToOne(targetEntity="Debb\ConfigBundle\Entity\Node", inversedBy="components")
     */
    private $node;

	/**
	 * @var Debb\ManagementBundle\Entity\Processor
	 * 
	 * @ORM\ManyToOne(targetEntity="Processor")
	 */
	private $processor;

	/**
	 * @var Debb\ManagementBundle\Entity\Mainboard
	 * 
	 * @ORM\ManyToOne(targetEntity="Mainboard")
	 */
	private $mainboard;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set type
     *
     * @param integer $type
     * @return Component
     */
    public function setType($type)
    {
        $this->type = $type;
    
        return $this;
    }

    /**
     * Get type
     *
     * @return integer 
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set node
     *
     * @param \Debb\ConfigBundle\Entity\Node $node
     * @return Component
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
     * Set processor
     *
     * @param \Debb\ManagementBundle\Entity\Processor $processor
     * @return Component
     */
    public function setProcessor(\Debb\ManagementBundle\Entity\Processor $processor = null)
    {
        $this->processor = $processor;
    
        return $this;
    }

    /**
     * Get processor
     *
     * @return \Debb\ManagementBundle\Entity\Processor 
     */
    public function getProcessor()
    {
        return $this->processor;
    }

    /**
     * Set mainboard
     *
     * @param \Debb\ManagementBundle\Entity\Mainboard $mainboard
     * @return Component
     */
    public function setMainboard(\Debb\ManagementBundle\Entity\Mainboard $mainboard = null)
    {
        $this->mainboard = $mainboard;
    
        return $this;
    }

    /**
     * Get mainboard
     *
     * @return \Debb\ManagementBundle\Entity\Mainboard 
     */
    public function getMainboard()
    {
        return $this->mainboard;
    }
}