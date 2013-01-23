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
	 * @var integer
	 *
	 * @ORM\ManyToOne(targetEntity="Debb\ManagementBundle\Entity\Mainboard", cascade={"all"})
	 */
	private $mainboard;

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
	 * Set mainboard
	 *
	 * @param Debb\ManagementBundle\Entity\Mainboard $mainboard
	 * @return Node
	 */
	public function setMainboard(\Debb\ManagementBundle\Entity\Mainboard $mainboard)
	{
		$this->mainboard = $mainboard;

		return $this;
	}

	/**
	 * Get mainboard
	 *
	 * @return Debb\ManagementBundle\Entity\Mainboard 
	 */
	public function getMainboard()
	{
		return $this->mainboard;
	}

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
	public function getXmlArray()
	{
		$array['node'] = parent::getXmlArray();
		if ($this->getMainboard() != null)
		{
			$array['node']['Mainboard'] = $this->getMainboard()->getXmlArray();
		}
		foreach($this->getComponents() as $component)
		{
			$array['node'][] = $component->getXmlArray();
		}
		return $array;
	}

}