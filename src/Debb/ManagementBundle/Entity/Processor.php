<?php

namespace Debb\ManagementBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Processor
 *
 * @ORM\Table()
 * @ORM\Entity()
 */
class Processor extends Base
{

	/**
	 * @var integer
	 *
	 * @ORM\Column(name="cores", type="integer", nullable=true)
	 */
	private $cores;

	/**
	 * @var integer
	 *
	 * @ORM\Column(name="max_frequency", type="integer", nullable=true)
	 */
	private $maxFrequency;

	/**
	 * @var decimal
	 *
	 * @ORM\Column(name="max_power", type="decimal", nullable=true)
	 */
	private $maxPower;

	/**
	 * @var integer
	 *
	 * @ORM\Column(name="max_clock_speed", type="integer", nullable=true)
	 */
	private $maxClockSpeed;

	/**
	 * Set cores
	 *
	 * @param integer $cores
	 * @return Processor
	 */
	public function setCores($cores)
	{
		$this->cores = $cores;

		return $this;
	}

	/**
	 * Get cores
	 *
	 * @return integer 
	 */
	public function getCores()
	{
		return $this->cores;
	}

	/**
	 * Set maxFrequency
	 *
	 * @param integer $maxFrequency
	 * @return Processor
	 */
	public function setMaxFrequency($maxFrequency)
	{
		$this->maxFrequency = $maxFrequency;

		return $this;
	}

	/**
	 * Get maxFrequency
	 *
	 * @return integer 
	 */
	public function getMaxFrequency()
	{
		return $this->maxFrequency;
	}

	/**
	 * Set maxPower
	 *
	 * @param \double $maxPower
	 * @return Processor
	 */
	public function setMaxPower($maxPower)
	{
		$this->maxPower = $maxPower;

		return $this;
	}

	/**
	 * Get maxPower
	 *
	 * @return decimal 
	 */
	public function getMaxPower()
	{
		return $this->maxPower;
	}

	/**
	 * Set maxClockSpeed
	 *
	 * @param integer $maxClockSpeed
	 * @return Processor
	 */
	public function setMaxClockSpeed($maxClockSpeed)
	{
		$this->maxClockSpeed = $maxClockSpeed;

		return $this;
	}

	/**
	 * Get maxClockSpeed
	 *
	 * @return decimal 
	 */
	public function getMaxClockSpeed()
	{
		return $this->maxClockSpeed;
	}

	/**
	 * Returns a array for later converting
	 * 
	 * @return array the array for later converting
	 */
	public function getDebbXmlArray()
	{
		$array = parent::getDebbXmlArray();
		if ($this->getCores() != null)
		{
			$array['Cores'] = $this->getCores();
		}
		if ($this->getMaxFrequency() != null)
		{
			$array['MaxFrequency'] = $this->getMaxFrequency();
		}
		if ($this->getMaxPower() != null)
		{
			$array['MaxPower'] = $this->getMaxPower();
		}
		if ($this->getMaxClockSpeed() != null)
		{
			$array['MaxClockSpeed'] = $this->getMaxClockSpeed();
		}
		return $array;
	}

}