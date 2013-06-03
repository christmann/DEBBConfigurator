<?php

namespace Debb\ManagementBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Storage
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Storage extends Base
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
	 * @var string
	 *
	 * @ORM\Column(name="Interface", type="string", length=255, nullable=true)
	 */
	private $interface;

	/**
	 * Set maxPower
	 *
	 * @param float $maxPower
	 * @return Storage
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
	 * @return Storage
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
	 * Set interface
	 *
	 * @param string $interface
	 * @return Storage
	 */
	public function setInterface($interface)
	{
		$this->interface = $interface;

		return $this;
	}

	/**
	 * Get interface
	 *
	 * @return string 
	 */
	public function getInterface()
	{
		return $this->interface;
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
		if ($this->getInterface() != null)
		{
			$array['Interface'] = $this->getInterface();
		}
		return $array;
	}

}