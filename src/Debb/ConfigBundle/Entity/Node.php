<?php
/**
 * DEBBConfigurator - A configurator for DEBB component and PLMXML files
 * Copyright (C) 2013-2014 christmann informationstechnik + medien GmbH & Co. KG
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Library General Public
 * License as published by the Free Software Foundation; either
 * version 2 of the License, or (at your option) any later version.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
 * Library General Public License for more details.
 *
 * You should have received a copy of the GNU Library General Public
 * License along with this library; if not, write to the
 * Free Software Foundation, Inc., 51 Franklin St, Fifth Floor,
 * Boston, MA  02110-1301, USA.
 */

namespace Debb\ConfigBundle\Entity;

use Debb\ConfigBundle\Controller\XMLController;
use Debb\ManagementBundle\DataTransformer\DecimalTransformer;
use Debb\ManagementBundle\Entity\Base;
use Debb\ManagementBundle\Entity\Baseboard;
use Debb\ManagementBundle\Entity\DEBBComponent;
use Debb\ManagementBundle\Entity\DEBBSimple;
use Debb\ManagementBundle\Entity\Heatsink;
use Debb\ManagementBundle\Entity\Memory;
use Debb\ManagementBundle\Entity\Processor;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use \Debb\ManagementBundle\Entity\Component;
use Doctrine\ORM\PersistentCollection;

/**
 * Node
 *
 * @ORM\Table(name="node")
 * @ORM\Entity(repositoryClass="Debb\ManagementBundle\Repository\BaseRepository")
 * @author Patrick Bußmann <patrick.bussmann@christmann.info>
 */
class Node extends DEBBComponent
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
	 * @var \Debb\ManagementBundle\Entity\Network[]
	 *
	 * @ORM\ManyToMany(targetEntity="Debb\ManagementBundle\Entity\Network", cascade={"persist"})
	 */
	private $networks;

	/**
	 * Constructor
	 */
	public function __construct()
	{
		$this->components = new \Doctrine\Common\Collections\ArrayCollection();
		$this->references = new \Doctrine\Common\Collections\ArrayCollection();
		$this->nodeGroups = new \Doctrine\Common\Collections\ArrayCollection();
		$this->networks = new \Doctrine\Common\Collections\ArrayCollection();
	}

	/**
	 * Duplicate this entity
	 */
	public function __clone()
	{
		if ($this->getId() > 0)
		{
			parent::__clone();

			if($this->getImage() !== null)
			{
				$this->image = clone $this->image;
			}

			$components = new ArrayCollection();
			foreach($this->getComponents() as $component)
			{
				$components->add(clone $component);
			}
			$this->setComponents($components);

			$references = new ArrayCollection();
			foreach($this->getReferences() as $reference)
			{
				$references->add(clone $reference);
			}
			$this->references = $references;

			$networks = new ArrayCollection();
			foreach($this->getNetworks() as $network)
			{
				$networks->add($network);
			}
			$this->networks = $networks;

			$this->setNodeGroup(new ArrayCollection());
		}
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
	 * @return \Debb\ManagementBundle\Entity\Component[]|PersistentCollection
	 */
	public function getHeatsinks()
	{
		return $this->getComponents(Component::TYPE_HEATSINK);
	}

	/**
	 * Returns a array for later converting
	 * 
	 * @return array the array for later converting
	 */
	public function getDebbXmlArray()
	{
		$array['Node'] = parent::getDebbXmlArray();
		$array['Node'][] = array(array('Connector' => array(
			'ConnectorType' => ($this->getType() == 'CXP2' ? 'COMExpress Type 2' : ($this->getType() == 'CPX6' ? 'COMExpress Type 6' : $this->getType())),
			'Label' => 'COMExpress'
		)));

		$baseboards = $this->getComponents(Component::TYPE_BASEBOARD);
		$processors = $this->getComponents(Component::TYPE_PROCESSOR);
		$memories = $this->getComponents(Component::TYPE_MEMORY);

		if(count($baseboards) > 1 || reset($baseboards)->getAmount() != 1)
		{
			$baseboards = array(reset($baseboards)->setAmount(1));
		}
		if (count($baseboards) < 1 || !(reset($baseboards)->getActive() instanceof Baseboard))
		{
			$comp = new Component();
			$comp->setAmount(1);
			$comp->setBaseboard(new Baseboard());
			$baseboards = array($comp);
		}

		foreach (array_merge(
					 $baseboards,
					 $processors,
					 $memories
				 ) as $component)
		{
			/** @var $component Component */
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
	 * @return Node
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
	 * Set nodeGroups
	 *
	 * @param \Debb\ManagementBundle\Entity\NodeToNodegroup[] $nodeGroups
	 * @return Node
	 */
	public function setNodeGroup($nodeGroups)
	{
		$this->nodeGroups = $nodeGroups;

		foreach($this->nodeGroups as $nodeGroup)
		{
			$nodeGroup->setNode($this);
		}

		return $this;
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

	/*
	 * {@inheritdoc}
	 */
	public function setType($type)
	{
		return $this->isTypeLocked() ? $this : parent::setType($type);
	}

    /**
     * Add networks
     *
     * @param \Debb\ManagementBundle\Entity\Network $networks
     * @return Node
     */
    public function addNetwork(\Debb\ManagementBundle\Entity\Network $networks)
    {
        $this->networks[] = $networks;
    
        return $this;
    }

    /**
     * Remove networks
     *
     * @param \Debb\ManagementBundle\Entity\Network $networks
     */
    public function removeNetwork(\Debb\ManagementBundle\Entity\Network $networks)
    {
        $this->networks->removeElement($networks);
    }

    /**
     * Get networks
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getNetworks()
    {
        return $this->networks;
    }

	/**
	 * @return float
	 */
	public function getRealCostsEur($inclSelf = true)
	{
		$costs = 0;

		// Count components
		foreach($this->getComponents() as $component)
		{
			if($component !== null && $component->getActive() instanceof Base)
			{
				$costs += $component->getActive()->getRealCostsEur() * $component->getAmount();
			}
		}

		// Count self
		if($inclSelf)
		{
			$costs += parent::getRealCostsEur();
		}

		return DecimalTransformer::convert($costs);
	}

	/**
	 * @return float
	 */
	public function getRealCostsEnv($inclSelf = true)
	{
		$costs = 0;

		// Count components
		foreach($this->getComponents() as $component)
		{
			if($component !== null && $component->getActive() instanceof Base)
			{
				$costs += $component->getActive()->getRealCostsEnv() * $component->getAmount();
			}
		}

		// Count self
		if($inclSelf)
		{
			$costs += parent::getRealCostsEnv();
		}

		return DecimalTransformer::convert($costs);
	}

	/**
	 * Get the costs array for xml
	 *
	 * @return array
	 */
	public function getCostsXml()
	{
		$costs = parent::getCostsXml();

		// Count components
		foreach($this->getComponents() as $component)
		{
			if($component !== null && $component->getActive() instanceof Base)
			{
				$xml = $component->getActive()->getCostsXml();
				if($component->getAmount() > 1)
				{
					$xml['Amount'] = $component->getAmount();
				}
				$costs[] = array(XMLController::get_real_class($component->getActive()) => $xml);
			}
		}

		return $costs;
	}
}