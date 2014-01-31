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

namespace Debb\ManagementBundle\Entity;

use Debb\ConfigBundle\Entity\Dimensions;
use Debb\ConfigBundle\Entity\NodeGroup;
use Debb\ManagementBundle\DataTransformer\DecimalTransformer;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Chassis
 *
 * @ORM\Table(name="chassis")
 * @ORM\Entity(repositoryClass="Debb\ManagementBundle\Repository\BaseRepository")
 * @author Patrick Bußmann <patrick.bussmann@christmann.info>
 */
class Chassis extends Dimensions
{
    /**
     * @var Image
     *
     * @ORM\ManyToOne(targetEntity="Debb\ManagementBundle\Entity\File", cascade={"persist"})
     */
    private $image;

    /**
     * @var integer
     *
     * @ORM\Column(name="he_size", type="integer")
     */
    private $heSize;

    /**
     * Field specification - typ
     *
     * @var \Debb\ManagementBundle\Entity\ChassisTypSpecification[]
     *
     * @ORM\OneToMany(targetEntity="Debb\ManagementBundle\Entity\ChassisTypSpecification", cascade={"persist"}, mappedBy="chassis", orphanRemoval=true)
     */
    private $typspecification;

    /**
     * @var boolean
     *
     * @ORM\Column(name="frontview", type="boolean", nullable=true)
     */
    private $frontview;

    /**
     * Node Groups
     *
     * @ORM\OneToMany(targetEntity="Debb\ConfigBundle\Entity\NodeGroup", mappedBy="draft")
     *
     * @var ArrayCollection|NodeGroup[]
     */
    private $nodeGroups;

	/**
	 * @var \Debb\ManagementBundle\Entity\File[]
	 *
	 * @ORM\ManyToMany(targetEntity="Debb\ManagementBundle\Entity\File", cascade={"all"}, orphanRemoval=true)
	 */
	private $references;

	/**
	 * @var \Debb\ManagementBundle\Entity\FlowPumpToRoom[]
	 *
	 * @ORM\OneToMany(targetEntity="Debb\ManagementBundle\Entity\FlowPumpToChassis", cascade={"persist"}, mappedBy="chassis", orphanRemoval=true)
	 */
	private $flowPumps;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->nodeGroups = new ArrayCollection();
	    $this->references = new ArrayCollection();
    }

    /**
     * Set image
     *
     * @param string $image
     *
     * @return Chassis
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set heSize
     *
     * @param integer $heSize
     *
     * @return Chassis
     */
    public function setHeSize($heSize)
    {
        $this->heSize = $heSize;

        return $this;
    }

    /**
     * Get heSize
     *
     * @return integer
     */
    public function getHeSize()
    {
        return $this->heSize;
    }

    /**
     * Set frontview
     *
     * @param boolean $frontview
     *
     * @return Chassis
     */
    public function setFrontview($frontview)
    {
        $this->frontview = $frontview;

        return $this;
    }

    /**
     * Is frontview?
     *
     * @return boolean
     */
    public function isFrontView()
    {
        return $this->frontview != null && $this->frontview == 1;
    }

    /**
     * Get frontview
     *
     * @return boolean
     */
    public function getFrontview()
    {
        return $this->frontview;
    }

    /**
     * Add nodeGroups
     *
     * @param NodeGroup $nodeGroups
     *
     * @return Chassis
     */
    public function addNodeGroup(NodeGroup $nodeGroups)
    {
        $this->nodeGroups[] = $nodeGroups;

        return $this;
    }

    /**
     * Remove nodeGroups
     *
     * @param NodeGroup $nodeGroups
     */
    public function removeNodeGroup(NodeGroup $nodeGroups)
    {
        $this->nodeGroups->removeElement($nodeGroups);
    }

    /**
     * Get nodeGroups
     *
     * @return NodeGroup[]
     */
    public function getNodeGroups()
    {
        return $this->nodeGroups;
    }

	/**
	 * Get the parents
	 *
	 * @return NodeGroup[]
	 */
	public function getParents()
	{
		return $this->getNodeGroups();
	}

    /**
     * Add typspecification
     *
     * @param \Debb\ManagementBundle\Entity\ChassisTypSpecification $typspecification
     * @return Chassis
     */
    public function addTypspecification(\Debb\ManagementBundle\Entity\ChassisTypSpecification $typspecification)
    {
	    $typspecification->setChassis($this);
        $this->typspecification[] = $typspecification;
    
        return $this;
    }

    /**
     * Set typspecification
     *
     * @param \Debb\ManagementBundle\Entity\ChassisTypSpecification[] $typspecification
     * @return Chassis
     */
    public function setTypspecification($typspecification)
    {
	    $this->typspecification = $typspecification;

	    foreach ($this->typspecification as $typspecification)
	    {
		    $typspecification->setChassis($this);
	    }

        return $this;
    }

    /**
     * Remove typspecification
     *
     * @param \Debb\ManagementBundle\Entity\ChassisTypSpecification $typspecification
     */
    public function removeTypspecification(\Debb\ManagementBundle\Entity\ChassisTypSpecification $typspecification)
    {
        $this->typspecification->removeElement($typspecification);
    }

    /**
     * Get typspecification
     *
     * @return \Debb\ManagementBundle\Entity\ChassisTypSpecification[]
     */
    public function getTypspecification($asArray = false)
    {
	    if($asArray)
	    {
		    $array = array();
		    foreach($this->getTypspecification(false) as $typSpec)
		    {
			    $array[] = $typSpec->asArray();
		    }
		    return $array;
	    }
        return $this->typspecification;
    }

	/**
	 * @inheritdoc
	 */
	public function getSizeX()
	{
		if(parent::getSizeX() < 10)
		{
			return 900;
		}
		return parent::getSizeX();
	}

	/**
	 * @inheritdoc
	 */
	public function getSizeY()
	{
		if(parent::getSizeY() < 10)
		{
			return 600;
		}
		return parent::getSizeY();
	}

	/**
	 * Add references
	 *
	 * @param \Debb\ManagementBundle\Entity\File $references
	 * @return Chassis
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
	 * Add flowPump
	 *
	 * @param \Debb\ManagementBundle\Entity\RackToChassis $flowPump
	 * @return Chassis
	 */
	public function addFlowPump(\Debb\ManagementBundle\Entity\FlowPumpToChassis $flowPump)
	{
		$flowPump->setChassis($this);
		$this->flowPumps[] = $flowPump;

		return $this;
	}

	/**
	 * Set flowPumps
	 *
	 * @param \Debb\ManagementBundle\Entity\FlowPumpToChassis[] $flowPumps
	 * @return Chassis
	 */
	public function setFlowPumps($flowPumps)
	{
		$this->flowPumps = $flowPumps;

		foreach ($this->flowPumps as $flowPump)
		{
			$flowPump->setChassis($this);
		}

		return $this;
	}

	/**
	 * Remove flowPump
	 *
	 * @param \Debb\ManagementBundle\Entity\RackToChassis $flowPump
	 */
	public function removeFlowPump(\Debb\ManagementBundle\Entity\FlowPumpToChassis $flowPump)
	{
		$this->flowPumps->removeElement($flowPump);
	}

	/**
	 * Get flowPumps
	 *
	 * @return \Debb\ManagementBundle\Entity\FlowPumpToChassis[]
	 */
	public function getFlowPumps()
	{
		return $this->flowPumps;
	}

	/**
	 * Sort flowPumps (unused) (reverse)
	 */
	public function sortFlowPumps()
	{
		$ordered = new \Doctrine\Common\Collections\ArrayCollection();
		for ($i = $this->flowPumps->count() - 1; $i >= 0; $i--)
		{
			$ordered->add($this->flowPumps[$i]);
		}
		$this->flowPumps = $ordered;

		$x = 0;
		foreach ($this->flowPumps as $flowPump)
		{
			$flowPump->setField($x);
			$x++;
		}
	}

	/**
	 * Get the next free field in flowPump array
	 *
	 * @return int the next free field in flowPump array
	 */
	public function getFreeFlowPump()
	{
		$ids = array();
		foreach ($this->getFlowPumps() as $flowPump)
		{
			$ids[] = $flowPump->getField();
		}
		ksort($ids);

		$res = 0;
		foreach ($ids as $id)
		{
			if ($id == $res)
			{
				$res++;
			}
		}
		return $res;
	}

	public function __clone()
	{
		if ($this->getId() > 0)
		{
			parent::__clone();

			if($this->getImage() != null)
			{
				$this->image = clone $this->image;
			}

			$references = new ArrayCollection();
			foreach($this->references as $reference)
			{
				$references->add(clone $reference);
			}
			$this->references = $references;

			$flowPumps = new ArrayCollection();
			foreach($this->flowPumps as $flowPump)
			{
				$flowPumps->add(clone $flowPump);
			}
			$this->setFlowPumps($flowPumps);

			$typSpecifications = new ArrayCollection();
			foreach($this->typspecification as $typSpecification)
			{
				$typSpecifications->add(clone $typSpecification);
			}
			$this->setTypspecification($typSpecifications);
		}
	}

	/**
	 * @return float
	 */
	public function getRealCostsEur($inclSelf = true)
	{
		$costs = 0;

		// Count flow pumps
		foreach($this->getFlowPumps() as $flowPump)
		{
			if($flowPump instanceof FlowPumpToChassis && $flowPump->getFlowPump() instanceof FlowPump)
			{
				$costs += $flowPump->getFlowPump()->getRealCostsEur();
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

		// Count flow pumps
		foreach($this->getFlowPumps() as $flowPump)
		{
			if($flowPump instanceof FlowPumpToChassis && $flowPump->getFlowPump() instanceof FlowPump)
			{
				$costs += $flowPump->getFlowPump()->getRealCostsEnv();
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

		// Count flow pumps
		foreach($this->getFlowPumps() as $flowPump)
		{
			if($flowPump instanceof FlowPumpToChassis && $flowPump->getFlowPump() instanceof FlowPump)
			{
				$costs[] = array($flowPump->getFlowPump()->getDebbLevel() => $flowPump->getFlowPump()->getCostsXml());
			}
		}

		return $costs;
	}
}