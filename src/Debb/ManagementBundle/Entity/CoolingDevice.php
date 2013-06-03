<?php

namespace Debb\ManagementBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * CoolingDevice
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class CoolingDevice extends Base
{

	/**
	 * @var float
	 *
	 * @ORM\Column(name="MaxPower", type="decimal", nullable=true)
	 */
	private $maxPower;

	/**
	 * @var float
	 *
	 * @ORM\Column(name="MaxCoolingCapacity", type="decimal", nullable=true)
	 */
	private $maxCoolingCapacity;

	/**
	 * @var float
	 *
	 * @ORM\Column(name="MaxAirThroughput", type="decimal", nullable=true)
	 */
	private $maxAirThroughput;

	/**
	 * @var float
	 *
	 * @ORM\Column(name="MaxWaterThroughput", type="decimal", nullable=true)
	 */
	private $maxWaterThroughput;

	/**
	 * Set maxPower
	 *
	 * @param float $maxPower
	 * @return CoolingDevice
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
	 * Set maxCoolingCapacity
	 *
	 * @param float $maxCoolingCapacity
	 * @return CoolingDevice
	 */
	public function setMaxCoolingCapacity($maxCoolingCapacity)
	{
		$this->maxCoolingCapacity = $maxCoolingCapacity;

		return $this;
	}

	/**
	 * Get maxCoolingCapacity
	 *
	 * @return float 
	 */
	public function getMaxCoolingCapacity()
	{
		return $this->maxCoolingCapacity;
	}

	/**
	 * Set maxAirThroughput
	 *
	 * @param float $maxAirThroughput
	 * @return CoolingDevice
	 */
	public function setMaxAirThroughput($maxAirThroughput)
	{
		$this->maxAirThroughput = $maxAirThroughput;

		return $this;
	}

	/**
	 * Get maxAirThroughput
	 *
	 * @return float 
	 */
	public function getMaxAirThroughput()
	{
		return $this->maxAirThroughput;
	}

	/**
	 * Set maxWaterThroughput
	 *
	 * @param float $maxWaterThroughput
	 * @return CoolingDevice
	 */
	public function setMaxWaterThroughput($maxWaterThroughput)
	{
		$this->maxWaterThroughput = $maxWaterThroughput;

		return $this;
	}

	/**
	 * Get maxWaterThroughput
	 *
	 * @return float 
	 */
	public function getMaxWaterThroughput()
	{
		return $this->maxWaterThroughput;
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
		if ($this->getMaxCoolingCapacity() != null)
		{
			$array['MaxCoolingCapacity'] = $this->getMaxCoolingCapacity();
		}
		if ($this->getMaxAirThroughput() != null)
		{
			$array['MaxAirThroughput'] = $this->getMaxAirThroughput();
		}
		if ($this->getMaxWaterThroughput() != null)
		{
			$array['MaxWaterThroughput'] = $this->getMaxWaterThroughput();
		}
		return $array;
	}

}