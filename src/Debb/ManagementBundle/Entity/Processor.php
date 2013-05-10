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
		$array['MaxPower'] = $this->getMaxPower() != null ? $this->getMaxPower() : 0;
		$array['MaxClockSpeed'] = $this->getMaxClockSpeed() != null ? $this->getMaxClockSpeed() : 0;
		$array['Cores'] = $this->getCores() != null ? $this->getCores() : 0;
		$array['PState'] = array('State' => 0, 'Frequency' => 0, 'Voltage' => 0, 'PowerUsageMin' => 0, 'PowerUsageMax' => 0);
		$array['CState'] = array('State' => 0, 'PowerUsage' => 0.0);
		$array['TDP'] = 0.0;
		return $array;
	}

}