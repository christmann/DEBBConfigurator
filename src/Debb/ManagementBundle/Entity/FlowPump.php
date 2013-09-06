<?php

namespace Debb\ManagementBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * FlowPump
 *
 * FlowPump includes all devices "moving" air or liquid like fans, water pumps etc.
 *
 * @ORM\Table(name="flow_pump")
 * @ORM\Entity(repositoryClass="Debb\ManagementBundle\Repository\BaseRepository")
 */
class FlowPump extends DEBBSimple
{
    /**
     * @var integer|null
     *
     * @ORM\Column(name="maxrpm", type="integer", nullable=true)
     */
    private $maxRPM;

	/**
	 * @var float|null
	 *
	 * @ORM\Column(name="efficiency", type="float", nullable=true)
	 */
	private $efficiency;

	/**
	 * Returns a array for later converting
	 *
	 * @return array the array for later converting
	 */
	public function getDebbXmlArray()
	{
		$array = parent::getDebbXmlArray();
		if ($this->getMaxRPM() !== null)
		{
			$array['MaxRPM'] = $this->getMaxRPM();
		}
		if ($this->getEfficiency() !== null)
		{
			$array['Efficiency'] = $this->getEfficiency();
		}
		return $array;
	}

    /**
     * Set maxRPM
     *
     * @param integer $maxRPM
     * @return FlowPump
     */
    public function setMaxRPM($maxRPM)
    {
        $this->maxRPM = $maxRPM;
    
        return $this;
    }

    /**
     * Get maxRPM
     *
     * @return integer 
     */
    public function getMaxRPM()
    {
        return $this->maxRPM;
    }

    /**
     * Set efficiency
     *
     * @param float $efficiency
     * @return FlowPump
     */
    public function setEfficiency($efficiency)
    {
        $this->efficiency = $efficiency;
    
        return $this;
    }

    /**
     * Get efficiency
     *
     * @return float 
     */
    public function getEfficiency()
    {
        return $this->efficiency;
    }
}