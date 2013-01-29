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
	 * @ORM\Column(name="cores", type="integer")
	 */
	private $cores;

	/**
	 * @var integer
	 *
	 * @ORM\Column(name="max_frequency", type="integer")
	 */
	private $maxFrequency;

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
		return $array;
	}

}