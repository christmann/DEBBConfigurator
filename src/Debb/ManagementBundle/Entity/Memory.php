<?php

namespace Debb\ManagementBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Memory
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Memory extends Base
{

	/**
	 * @var float
	 *
	 * @ORM\Column(name="MaxPower", type="float", nullable=true)
	 */
	private $maxPower;

	/**
	 * @var integer
	 *
	 * @ORM\Column(name="Capacity", type="integer", nullable=true)
	 */
	private $capacity;

	/**
	 * Set maxPower
	 *
	 * @param float $maxPower
	 * @return Memory
	 */
	public function setMaxPower($maxPower)
	{
		$this->maxPower = $maxPower;

		return $this;
	}

	/**
	 * Get maxPower
	 *
	 * @return float 
	 */
	public function getMaxPower()
	{
		return $this->maxPower;
	}

	/**
	 * Set capacity
	 *
	 * @param integer $capacity
	 * @return Memory
	 */
	public function setCapacity($capacity)
	{
		$this->capacity = $capacity;

		return $this;
	}

	/**
	 * Get capacity
	 *
	 * @return integer 
	 */
	public function getCapacity()
	{
		return $this->capacity;
	}

	/**
	 * Returns a array for later converting
	 * 
	 * @return array the array for later converting
	 */
	public function getDebbXmlArray()
	{
		$array = parent::getDebbXmlArray();
		if ($this->getMaxPower() != null)
		{
			$array['MaxPower'] = $this->getMaxPower();
		}
		if ($this->getCapacity() != null)
		{
			$array['Capacity'] = $this->getCapacity();
		}
		return $array;
	}

}