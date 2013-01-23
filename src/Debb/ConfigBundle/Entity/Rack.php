<?php

namespace Debb\ConfigBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Rack
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Rack extends \Debb\ManagementBundle\Entity\Base
{

	/**
	 * @ORM\OneToMany(targetEntity="Debb\ManagementBundle\Entity\NodegroupToRack", cascade={"persist"}, mappedBy="rack", orphanRemoval=true)
	 */
	private $nodeGroups;

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
	 * Returns a array for later converting
	 * 
	 * @return array the array for later converting
	 */
	public function getXmlArray()
	{
		$array['Rack'] = parent::getXmlArray();
		foreach ($this->getNodeGroups() as $nodegroup)
		{
			if ($nodegroup->getNodegroup() != null)
			{
				$array['Rack'][] = $nodegroup->getNodegroup()->getXmlArray();
			}
		}
		return $array;
	}

}