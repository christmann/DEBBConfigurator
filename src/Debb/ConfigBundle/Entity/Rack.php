<?php

/**
 * Manufacturer
 * Product
 * Model
 */

namespace Debb\ConfigBundle\Entity;

use Debb\ManagementBundle\Entity\NodegroupToRack;
use Debb\ManagementBundle\Entity\RackToRoom;
use Doctrine\ORM\Mapping as ORM;

/**
 * Rack
 *
 * @ORM\Table(name="rack")
 * @ORM\Entity(repositoryClass="Debb\ManagementBundle\Repository\BaseRepository")
 */
class Rack extends Dimensions
{
	/**
	 * @var \Debb\ManagementBundle\Entity\NodeGroupToRack[]
	 *
	 * @ORM\OneToMany(targetEntity="Debb\ManagementBundle\Entity\NodegroupToRack", cascade={"persist"}, mappedBy="rack", orphanRemoval=true)
	 */
	private $nodeGroups;

	/**
	 * @var integer
	 *
	 * @ORM\Column(name="nodegroupsize", type="integer", nullable=true)
	 */
	private $nodeGroupSize;

	/**
	 * @var \Debb\ManagementBundle\Entity\File[]
	 *
	 * @ORM\ManyToMany(targetEntity="Debb\ManagementBundle\Entity\File", cascade={"all"}, orphanRemoval=true)
	 */
	private $references;

	/**
	 * Rooms
	 *
	 * @ORM\OneToMany(targetEntity="Debb\ManagementBundle\Entity\RackToRoom", mappedBy="rack")
	 *
	 * @var RackToRoom[]
	 */
	private $rooms;

	/**
	 * Constructor
	 */
	public function __construct()
	{
		$this->nodeGroups = new \Doctrine\Common\Collections\ArrayCollection();
		$this->nodeGroups[] = new NodegroupToRack();
		$this->references = new \Doctrine\Common\Collections\ArrayCollection();
		$this->rooms = new \Doctrine\Common\Collections\ArrayCollection();
	}

	/**
	 * Add nodeGroups
	 *
	 * @param \Debb\ManagementBundle\Entity\NodegroupToRack $nodeGroups
	 * @return Rack
	 */
	public function addNodeGroup(\Debb\ManagementBundle\Entity\NodegroupToRack $nodeGroups, $setRack = true)
	{
		if($setRack)
		{
			$nodeGroups->setRack($this);
		}
		$this->nodeGroups[] = $nodeGroups;

		return $this;
	}

	/**
	 * Set node groups
	 *
	 * @param \Debb\ManagementBundle\Entity\NodegroupToRack[] $nodeGroups
	 * @return Rack
	 */
	public function setNodeGroups($nodeGroups)
	{
		$this->nodeGroups = $nodeGroups;

		foreach ($this->nodeGroups as $nodeGroup)
		{
			$nodeGroup->setRack($this);
		}

		return $this;
	}

	/**
	 * Remove nodeGroups
	 *
	 * @param \Debb\ManagementBundle\Entity\NodegroupToRack $nodeGroups
	 */
	public function removeNodeGroup(\Debb\ManagementBundle\Entity\NodegroupToRack $nodeGroups)
	{
		$this->nodeGroups->removeElement($nodeGroups);
	}

	/**
	 * Get nodeGroups
	 *
	 * @return \Debb\ManagementBundle\Entity\NodeGroupToRack[]
	 */
	public function getNodeGroups()
	{
		return $this->nodeGroups;
	}

	/**
	 * Get the next free field in node group array
	 * 
	 * @return int the next free field in node group array
	 */
	public function getFreeNodeGroup()
	{
		$ids = array();
		foreach ($this->getNodeGroups() as $nodeGroup)
		{
			$ids[] = $nodeGroup->getField();
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

	/**
	 * Set nodeGroupSize
	 *
	 * @param integer $nodeGroupSize
	 * @return Rack
	 */
	public function setNodeGroupSize($nodeGroupSize)
	{
		$this->nodeGroupSize = $nodeGroupSize;

		return $this;
	}

	/**
	 * Get nodeGroupSize
	 *
	 * @return integer 
	 */
	public function getNodeGroupSize()
	{
		return (int) $this->nodeGroupSize;
	}

	/**
	 * Returns a array for later converting
	 * 
	 * @return array the array for later converting
	 */
	public function getDebbXmlArray()
	{
		$array['Rack'] = parent::getDebbXmlArray();
		if($this->getHostname() != null)
		{
			$array['Rack']['hostname'] = $this->getHostname();
		}
		foreach($this->getReferences() as $reference)
		{
			$array['Rack'][] = array(array('Reference' => array('Type' => $reference->getFileEnding(), 'Location' => './object/' . $reference->getId() . '_' . $reference->getName())));
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
	 * @return \Debb\ConfigBundle\Entity\NodeGroup[]
	 */
	public function getChildrens()
	{
		$childrens = array();
		foreach($this->getNodeGroups() as $nodeGroupToRack)
		{
			if($nodeGroupToRack->getNodegroup() != null)
			{
				$childrens[] = array($nodeGroupToRack->getNodegroup(), $nodeGroupToRack);
			}
		}
		return $childrens;
	}

	/**
	 * @return string the debb level
	 */
	public function getDebbLevel()
	{
		return 'Rack';
	}

    /**
     * Add rooms
     *
     * @param \Debb\ManagementBundle\Entity\RackToRoom $rooms
     * @return Rack
     */
    public function addRoom(\Debb\ManagementBundle\Entity\RackToRoom $rooms)
    {
        $this->rooms[] = $rooms;
    
        return $this;
    }

    /**
     * Remove rooms
     *
     * @param \Debb\ManagementBundle\Entity\RackToRoom $rooms
     */
    public function removeRoom(\Debb\ManagementBundle\Entity\RackToRoom $rooms)
    {
        $this->rooms->removeElement($rooms);
    }

    /**
     * Get rooms
     *
     * @return RackToRoom[]
     */
    public function getRooms()
    {
        return $this->rooms;
    }

	/**
	 * Get the parents
	 *
	 * @return RackToRoom[]
	 */
	public function getParents()
	{
		return $this->getRooms();
	}
}