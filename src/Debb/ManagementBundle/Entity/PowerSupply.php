<?php

namespace Debb\ManagementBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * PowerSupply
 *
 * @ORM\Table(name="powersupply")
 * @ORM\Entity(repositoryClass="Debb\ManagementBundle\Repository\BaseRepository")
 */
class PowerSupply extends Base
{

	/**
	 * @var float
	 *
	 * @ORM\Column(name="TotalOutputPower", type="decimal", nullable=true)
	 */
	private $totalOutputPower;

	/**
	 * @var integer
	 *
	 * @ORM\Column(name="Efficiency", type="integer", nullable=true)
	 */
	private $efficiency;

	/**
	 * Set totalOutputPower
	 *
	 * @param float $totalOutputPower
	 * @return PowerSupply
	 */
	public function setTotalOutputPower($totalOutputPower)
	{
		$this->totalOutputPower = $totalOutputPower;

		return $this;
	}

	/**
	 * Get totalOutputPower
	 *
	 * @return float 
	 */
	public function getTotalOutputPower()
	{
		return $this->totalOutputPower;
	}

	/**
	 * Set efficiency
	 *
	 * @param integer $efficiency
	 * @return PowerSupply
	 */
	public function setEfficiency($efficiency)
	{
		$this->efficiency = $efficiency;

		return $this;
	}

	/**
	 * Get efficiency
	 *
	 * @return integer 
	 */
	public function getEfficiency()
	{
		return $this->efficiency;
	}

	/**
	 * Returns a array for later converting
	 * 
	 * @return array the array for later converting
	 */
	public function getDebbXmlArray()
	{
		$array = parent::getDebbXmlArray();
		if ($this->getTotalOutputPower() != null)
		{
			$array['TotalOutputPower'] = $this->getTotalOutputPower();
		}
		if ($this->getEfficiency() != null)
		{
			$array['Efficiency'] = $this->getEfficiency();
		}
		return $array;
	}

}