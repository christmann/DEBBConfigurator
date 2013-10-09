<?php

namespace Debb\ConfigBundle\Entity;

use Debb\ManagementBundle\Entity\Baseboard;
use Debb\ManagementBundle\Entity\Heatsink;
use Debb\ManagementBundle\Entity\Memory;
use Debb\ManagementBundle\Entity\Processor;
use Doctrine\ORM\Mapping as ORM;
use \Debb\ManagementBundle\Entity\Component;
use Doctrine\ORM\PersistentCollection;

/**
 * Node
 *
 * @ORM\Table(name="node")
 * @ORM\Entity(repositoryClass="Debb\ManagementBundle\Repository\BaseRepository")
 */
class Node extends Dimensions
{
	/**
	 * @var \Debb\ManagementBundle\Entity\Component[]
	 *
	 * @ORM\OneToMany(targetEntity="Debb\ManagementBundle\Entity\Component", mappedBy="node", cascade={"persist"}, orphanRemoval=true)
	 */
	private $components;

	/**
	 * @var Image
	 *
	 * @ORM\ManyToOne(targetEntity="Debb\ManagementBundle\Entity\File", cascade={"remove"})
	 */
	private $image;

	/**
	 * @var \Debb\ManagementBundle\Entity\File[]
	 *
	 * @ORM\ManyToMany(targetEntity="Debb\ManagementBundle\Entity\File", cascade={"all"}, orphanRemoval=true)
	 */
	private $references;

	/**
	 * Node groups
	 *
	 * @ORM\OneToMany(targetEntity="Debb\ManagementBundle\Entity\NodeToNodegroup", cascade={"persist"}, mappedBy="node", orphanRemoval=true)
	 *
	 * @var \Debb\ManagementBundle\Entity\NodeToNodegroup[]
	 */
	private $nodeGroups;

	/**
	 * @var bool true if the type is locked or false if not
	 */
	private $isTypeLocked = false;

	/**
	 * Constructor
	 */
	public function __construct()
	{
		$this->components = new \Doctrine\Common\Collections\ArrayCollection();
		$this->references = new \Doctrine\Common\Collections\ArrayCollection();
		$this->nodeGroups = new \Doctrine\Common\Collections\ArrayCollection();
	}

	/**
	 * Add components
	 *
	 * @param \Debb\ManagementBundle\Entity\Component $component
	 * @internal param \Debb\ManagementBundle\Entity\Component $components
	 * @return Node
	 */
	public function addComponent(\Debb\ManagementBundle\Entity\Component $component)
	{
		$component->setNode($this);
		$this->components[] = $component;

		return $this;
	}

	/**
	 * Set components
	 *
	 * @param \Debb\ManagementBundle\Entity\Component[] $components
	 * @return Node
	 */
	public function setComponents($components)
	{
		$this->components = $components;

		foreach ($this->components as $component)
		{
			$component->setNode($this);
		}

		return $this;
	}

	/**
	 * Remove components
	 *
	 * @param \Debb\ManagementBundle\Entity\Component $components
	 */
	public function removeComponent(\Debb\ManagementBundle\Entity\Component $components)
	{
		$this->components->removeElement($components);
	}

	/**
	 * Get components
	 *
	 * @return \Debb\ManagementBundle\Entity\Component[]|PersistentCollection
	 */
	public function getComponents($specific = false)
	{
		if($specific !== false)
		{
			$components = array_filter($this->components->toArray(), function($obj) use($specific) { return $obj instanceof Component && $obj->getType() === $specific; } );
			return $components;
		}
		return $this->components;
	}

	/**
	 * Set image
	 *
	 * @param \Debb\ManagementBundle\Entity\File $image
	 * @return Node
	 */
	public function setImage(\Debb\ManagementBundle\Entity\File $image = null)
	{
		$this->image = $image;

		return $this;
	}

	/**
	 * Get image
	 *
	 * @return \Debb\ManagementBundle\Entity\File 
	 */
	public function getImage()
	{
		return $this->image;
	}

	/**
	 * Returns a array for later converting
	 * 
	 * @return array the array for later converting
	 */
	public function getDebbXmlArray()
	{
		$array['Node'] = parent::getDebbXmlArray();
		foreach($this->getReferences() as $reference)
		{
			$array['Node'][] = array(array('Reference' => array('Type' => $reference->getFileEnding(), 'Location' => './object/' . $reference->getId() . '_' . $reference->getName())));
		}
		$array['Node'][] = array(array('Connector' => array(
			'ConnectorType' => ($this->getType() == 'CXP2' ? 'COMExpress Type 2' : ($this->getType() == 'CPX6' ? 'COMExpress Type 6' : $this->getType())),
			'Label' => 'COMExpress',
			'Transform' => 'Transform'
		)));

		$baseboards = $this->getComponents(Component::TYPE_BASEBOARD);
		$processors = $this->getComponents(Component::TYPE_PROCESSOR);
		$memories = $this->getComponents(Component::TYPE_MEMORY);

		if(!count($baseboards) || reset($baseboards)->getAmount() < 1)
		{
			$comp = new Component();
			$comp->setAmount(1);
			$comp->setBaseboard(new Baseboard());
			$baseboards[] = $comp;
		}

		if(!count($processors) || reset($processors)->getAmount() < 1)
		{
			$comp = new Component();
			$comp->setAmount(1);
			$comp->setProcessor(new Processor());
			$processors[] = $comp;
		}

		if(!count($memories) || reset($memories)->getAmount() < 1)
		{
			$comp = new Component();
			$comp->setAmount(1);
			$comp->setMemory(new Memory());
			$memories[] = $comp;
		}

		foreach (array_merge(
					 $baseboards,
					 $processors,
					 $memories
				 ) as $component)
		{
			if ($component->getAmount() >= 1 && $component->getType() != Component::TYPE_NOTHING)
			{
				$array['Node'][] = $component->getDebbXmlArray();
			}
		}

		return $array;
	}

	/**
	 * Add references
	 *
	 * @param \Debb\ManagementBundle\Entity\File $references
	 * @return DEBBSimple
	 */
	public function addReference(\Debb\ManagementBundle\Entity\File $references)
	{
		$this->references[] = $references;

		return $this;
	}

	/**
	 * Remove references
	 *
	 * @param \Debb\ManagementBundle\Entity\File $references
	 */
	public function removeReference($reference)
	{
		$this->references->removeElement($reference);
	}

	/**
	 * Get references
	 *
	 * @return \Debb\ManagementBundle\Entity\File[]
	 */
	public function getReferences()
	{
		return $this->references->getValues();
	}

	/**
	 * @return bool lock the type
	 */
	public function lockType()
	{
		$this->isTypeLocked = true;
		return $this->isTypeLocked;
	}

	/**
	 * @return boolean
	 */
	public function isTypeLocked()
	{
		return $this->isTypeLocked;
	}

	/**
	 * @return \Debb\ManagementBundle\Entity\Heatsink[]
	 */
	public function getChildrens()
	{
		$childrens = array();
		foreach($this->getComponents() as $component)
		{
			if($component->getActive() instanceof Heatsink)
			{
				for($x = 0; $x < $component->getAmount(); $x++)
				{
					$childrens[] = array($component, $this);
				}
			}
		}
		return $childrens;
	}

	/**
	 * @return string the debb level
	 */
	public function getDebbLevel()
	{
		return 'Node';
	}

    /**
     * Add nodeGroups
     *
     * @param \Debb\ManagementBundle\Entity\NodeToNodegroup $nodeGroups
     * @return Node
     */
    public function addNodeGroup(\Debb\ManagementBundle\Entity\NodeToNodegroup $nodeGroups)
    {
        $this->nodeGroups[] = $nodeGroups;
    
        return $this;
    }

    /**
     * Remove nodeGroups
     *
     * @param \Debb\ManagementBundle\Entity\NodeToNodegroup $nodeGroups
     */
    public function removeNodeGroup(\Debb\ManagementBundle\Entity\NodeToNodegroup $nodeGroups)
    {
        $this->nodeGroups->removeElement($nodeGroups);
    }

    /**
     * Get nodeGroups
     *
     * @return \Debb\ManagementBundle\Entity\NodeToNodegroup[]
     */
    public function getNodeGroups()
    {
        return $this->nodeGroups;
    }

	/**
	 * Get the parents
	 *
	 * @return \Debb\ManagementBundle\Entity\NodeToNodegroup[]
	 */
	public function getParents()
	{
		return $this->getNodeGroups();
	}
}