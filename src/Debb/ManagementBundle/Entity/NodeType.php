<?php

namespace Debb\ManagementBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * NodeType
 *
 * @ORM\Table(name="nodetype")
 * @ORM\Entity
 */
class NodeType
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var array
     *
     * @ORM\OneToMany(targetEntity="Debb\ConfigBundle\Entity\Node", mappedBy="type", cascade={"persist"}, orphanRemoval=true)
     */
    private $nodes;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=4)
     */
    private $name;


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
     * Set name
     *
     * @param string $name
     * @return NodeType
     */
    public function setName($name)
    {
        $this->name = $name;
    
        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set nodes
     *
     * @param \Debb\ConfigBundle\Entity\Node $nodes
     * @return NodeType
     */
    public function setNodes(\Debb\ConfigBundle\Entity\Node $nodes = null)
    {
        $this->nodes = $nodes;
        foreach($this->nodes as $node)
        {
            $node->setType($this);
        }
    
        return $this;
    }

    /**
     * Get nodes
     *
     * @return \Debb\ConfigBundle\Entity\Node 
     */
    public function getNodes()
    {
        return $this->nodes;
    }
}
