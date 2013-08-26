<?php

namespace Debb\ConfigBundle\Entity;

use Debb\ManagementBundle\Entity\Heatsink;
use Doctrine\ORM\Mapping as ORM;
use \Debb\ManagementBundle\Entity\Component;

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
	 * @ORM\ManyToOne(targetEntity="Debb\ManagementBundle\Entity\File", cascade={"all"})
	 */
	private $image;

	/**
	 * @var \Debb\ManagementBundle\Entity\File[]
	 *
	 * @ORM\ManyToMany(targetEntity="Debb\ManagementBundle\Entity\File", cascade={"all"}, orphanRemoval=true)
	 */
	private $references;

	/**
	 * Returns the name of this node for the table view or selections
	 * 
	 * @return string the name of this node
	 */

	/**
	 * Constructor
	 */
	public function __construct()
	{
		$this->components = new \Doctrine\Common\Collections\ArrayCollection();
		$this->references = new \Doctrine\Common\Collections\ArrayCollection();
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
	 * @return \Debb\ManagementBundle\Entity\Component[]
	 */
	public function getComponents()
	{
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
			$array['Node'][] = array(array('Reference' => array('Type' => $reference->getFileEnding(), 'Location' => './object/' . $reference->getName())));
		}
		// todo: use dynamic connector instead:
		$array['Node']['Connector'] = array(
			'ConnectorType' => ($this->getType() == 'CXP2' ? 'COMExpress Type 2' : ($this->getType() == 'CPX6' ? 'COMExpress Type 6' : 'Apalis')),
			'Label' => 'COMExpress',
			'Transform' => 'Transform'
		);
		$rest = array();
		$firstAllowedWasInserted = false;
		foreach ($this->getComponents() as $component)
		{
			if ($component->getAmount() >= 1 && $component->getType() != Component::TYPE_NOTHING && $component->getType() != Component::TYPE_COOLING_DEVICE)
			{
				if(!in_array($component->getType(), array(Component::TYPE_PROCESSOR, Component::TYPE_MEMORY)) && !$firstAllowedWasInserted)
				{
					$rest[] = $component->getDebbXmlArray();
				}
				else
				{
					$firstAllowedWasInserted = true;
					$array['Node'][] = $component->getDebbXmlArray();
				}
			}
		}
		if(count($rest) > 0 && count(array_filter($array['Node'], function($x) { return gettype($x) == 'array'; } )) < 1)
		{
			$array['Node'][] = array(array('Baseboard' => array()));
		}
		if(count($rest) > 0)
		{
			foreach($rest as $componentXml)
			{
				$array['Node'][] = $componentXml;
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
					$childrens[] = array($component->getActive(), $component);
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
}