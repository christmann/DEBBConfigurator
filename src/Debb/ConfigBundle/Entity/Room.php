<?php

namespace Debb\ConfigBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Room
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Room extends Dimensions
{

	/**
	 * @ORM\OneToMany(targetEntity="Debb\ManagementBundle\Entity\RackToRoom", cascade={"persist"}, mappedBy="room", orphanRemoval=true)
	 */
	private $racks;

	/**
	 * Constructor
	 */
	public function __construct()
	{
		$this->racks = new \Doctrine\Common\Collections\ArrayCollection();
	}

	/**
	 * Add racks
	 *
	 * @param \Debb\ManagementBundle\Entity\RackToRoom $racks
	 * @return Room
	 */
	public function addRack(\Debb\ManagementBundle\Entity\RackToRoom $racks)
	{
		$racks->setRoom($this);
		$this->racks[] = $racks;

		return $this;
	}

	/**
	 * Set racks
	 *
	 * @param \Debb\ManagementBundle\Entity\RackToRoom[] $racks
	 * @return Room
	 */
	public function setRacks($racks)
	{
		$this->racks = $racks;

		foreach ($this->racks as $rack)
		{
			$rack->setRoom($this);
		}

		return $this;
	}

	/**
	 * Remove racks
	 *
	 * @param \Debb\ManagementBundle\Entity\RackToRoom $racks
	 */
	public function removeRack(\Debb\ManagementBundle\Entity\RackToRoom $racks)
	{
		$this->racks->removeElement($racks);
	}

	/**
	 * Get racks
	 *
	 * @return \Doctrine\Common\Collections\Collection 
	 */
	public function getRacks()
	{
		return $this->racks;
	}

	/**
	 * Sort racks (unused) (reverse)
	 */
	public function sortRacks()
	{
		$ordered = new \Doctrine\Common\Collections\ArrayCollection();
		for ($i = $this->racks->count() - 1; $i >= 0; $i--)
		{
			$ordered->add($this->racks[$i]);
		}
		$this->racks = $ordered;

		$x = 0;
		foreach ($this->racks as $rack)
		{
			$rack->setField($x);
			$x++;
		}
	}

	/**
	 * Get the next free field in rack array
	 * 
	 * @return int the next free field in rack array
	 */
	public function getFreeRack()
	{
		$ids = array();
		foreach ($this->getRacks() as $rack)
		{
			$ids[] = $rack->getField();
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
	public function getDebbXmlArray()
	{
		$array['Room'] = parent::getDebbXmlArray();
		return $array;
	}

}