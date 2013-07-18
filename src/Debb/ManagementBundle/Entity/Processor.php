<?php

namespace Debb\ManagementBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Processor
 *
 * @ORM\Table(name="processor")
 * @ORM\Entity(repositoryClass="Debb\ManagementBundle\Repository\BaseRepository")
 */
class Processor extends Base
{

	/**
	 * @var integer
	 *
	 * @ORM\Column(name="max_clock_speed", type="integer", nullable=true)
	 */
	private $maxClockSpeed;

	/**
	 * @var integer
	 *
	 * @ORM\Column(name="cores", type="integer", nullable=true)
	 */
	private $cores;

	/**
	 * @var decimal
	 *
	 * @ORM\Column(name="tdp", type="decimal", nullable=true)
	 */
	private $tdp;

	/**
	 * @var decimal
	 *
	 * @ORM\Column(name="mintemp", type="decimal", nullable=true)
	 */
	private $mintemp;

	/**
	 * @var decimal
	 *
	 * @ORM\Column(name="maxtemp", type="decimal", nullable=true)
	 */
	private $maxtemp;

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
	 * Set TDP
	 *
	 * @param \double $tdp
	 * @return Processor
	 */
	public function setTDP($tdp)
	{
		$this->tdp = $tdp;

		return $this;
	}

	/**
	 * Get TDP
	 *
	 * @return decimal
	 */
	public function getTDP()
	{
		return $this->tdp;
	}

	/**
	 * Returns a array for later converting
	 * 
	 * @return array the array for later converting
	 */
	public function getDebbXmlArray()
	{
		$array = parent::getDebbXmlArray();
		if($this->getMaxClockSpeed() != null)
		{
			$array['MaxClockSpeed'] = $this->getMaxClockSpeed();
		}
		if($this->getCores() != null)
		{
			$array['Cores'] = $this->getCores();
		}
		if($this->getTDP() != null)
		{
			$array['TDP'] = $this->getTDP();
		}
		return $array;
	}

    /**
     * Set mintemp
     *
     * @param float $mintemp
     * @return Processor
     */
    public function setMintemp($mintemp)
    {
        $this->mintemp = $mintemp;
    
        return $this;
    }

    /**
     * Get mintemp
     *
     * @return float 
     */
    public function getMintemp()
    {
        return $this->mintemp;
    }

    /**
     * Set maxtemp
     *
     * @param float $maxtemp
     * @return Processor
     */
    public function setMaxtemp($maxtemp)
    {
        $this->maxtemp = $maxtemp;
    
        return $this;
    }

    /**
     * Get maxtemp
     *
     * @return float 
     */
    public function getMaxtemp()
    {
        return $this->maxtemp;
    }
}