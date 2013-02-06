<?php

namespace Debb\ConfigBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Node
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Node extends Dimensions
{

	/**
	 * @var array
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
	 * @var VRML
	 *
	 * @ORM\ManyToOne(targetEntity="Debb\ManagementBundle\Entity\File", cascade={"all"})
	 */
	private $vrmlFile;

	/**
	 * @var STL
	 *
	 * @ORM\ManyToOne(targetEntity="Debb\ManagementBundle\Entity\File", cascade={"all"})
	 */
	private $stlFile;

	/**
	 * Returns the name of this node for the table view or selections
	 * 
	 * @return string the name of this node
	 */
	public function __toString()
	{
		return '[' . $this->getId() . '] ' . $this->getProduct();
	}

	/**
	 * Constructor
	 */
	public function __construct()
	{
		$this->components = new \Doctrine\Common\Collections\ArrayCollection();
	}

	/**
	 * Add components
	 *
	 * @param \Debb\ManagementBundle\Entity\Component $components
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
	 * @return \Doctrine\Common\Collections\Collection 
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
		foreach ($this->getComponents() as $component)
		{
			if ($component->getAmount() >= 1 && $component->getType() != \Debb\ManagementBundle\Entity\Component::TYPE_NOTHING)
			{
				$array['Node'][] = $component->getDebbXmlArray();
			}
		}
		return $array;
	}

	/**
	 * Set vrmlFile
	 *
	 * @param \Debb\ManagementBundle\Entity\File $vrmlFile
	 * @return Node
	 */
	public function setVrmlFile(\Debb\ManagementBundle\Entity\File $vrmlFile = null)
	{
		$this->vrmlFile = $vrmlFile;

		return $this;
	}

	/**
	 * Get vrmlFile
	 *
	 * @return \Debb\ManagementBundle\Entity\File 
	 */
	public function getVrmlFile()
	{
		return $this->vrmlFile;
	}

	/**
	 * Set stlFile
	 *
	 * @param \Debb\ManagementBundle\Entity\File $stlFile
	 * @return Node
	 */
	public function setStlFile(\Debb\ManagementBundle\Entity\File $stlFile = null)
	{
		$this->stlFile = $stlFile;

		return $this;
	}

	/**
	 * Get stlFile
	 *
	 * @return \Debb\ManagementBundle\Entity\File 
	 */
	public function getStlFile()
	{
		return $this->stlFile;
	}

}