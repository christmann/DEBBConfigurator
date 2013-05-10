<?php

namespace Debb\ConfigBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use \Debb\ManagementBundle\Entity\Component;

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
	 * @var integer
	 *
	 * @ORM\Column(name="type", type="integer", nullable=true)
	 */
	private $type;

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
		$array['Node']['MaxPower'] = 1.0;
		$array['Node']['Type'] = 'Node';
		$array['Node']['Transform'] = 'Transform';
		$array['Node']['Reference'] = array('Type' => 'VRML', 'Location' => './object/' . ($this->getVrmlFile() != null ? $this->getVrmlFile()->getName() : $this->getName()) . '.wrl');
		$array['Node']['Heatsink'] = array();
		$array['Node']['Connector'] = array('ConnectorType' => 'x', 'Label' => 'y');
		$array['Node']['Baseboard'] = array();
		$rest = array(); // Processor's after - MaxPower, CoolingDevice, PowerSupply, Sensor, Storage, SecondaryComponent, Baseboard -
		$firstAllowedWasInserted = false;
		foreach ($this->getComponents() as $component)
		{
			if ($component->getAmount() >= 1 && $component->getType() != Component::TYPE_NOTHING && $component->getType() != Component::TYPE_COOLING_DEVICE && $component->getType() != Component::TYPE_MAINBOARD)
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

	/**
	 * Set type
	 *
	 * @param int $type
	 */
	public function setType($type)
	{
		$this->type = $type;
	}

	/**
	 * Get type
	 *
	 * @return int
	 */
	public function getType()
	{
		return $this->type;
	}

	/**
	 * Get all types
	 *
	 * @return array
	 */
	public static function getTypes()
	{
		return array(0 => 'COMexpress Typ 2', 1 => 'COMexpress Typ 6', 2 => 'Apalis');
	}
}