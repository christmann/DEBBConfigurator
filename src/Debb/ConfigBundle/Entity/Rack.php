<?php

/**
 * Manufacturer
 * Product
 * Model
 */

namespace Debb\ConfigBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Rack
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Rack extends Dimensions
{

	/**
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
	 * Constructor
	 */
	public function __construct()
	{
		$this->nodeGroups = new \Doctrine\Common\Collections\ArrayCollection();
	}

	/**
	 * Add nodeGroups
	 *
	 * @param \Debb\ManagementBundle\Entity\NodegroupToRack $nodeGroups
	 * @return Rack
	 */
	public function addNodeGroup(\Debb\ManagementBundle\Entity\NodegroupToRack $nodeGroups)
	{
		$nodeGroups->setRack($this);
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
	 * @return \Doctrine\Common\Collections\Collection 
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
		return $array;
	}

}