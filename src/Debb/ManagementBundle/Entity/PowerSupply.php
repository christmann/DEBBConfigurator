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
class PowerSupply extends Base /* extends DEBBComplexType */
{
	/**
	 * @var string
	 *
	 * @Assert\Choice(callback={"Debb\ManagementBundle\Form\PowerSupplyType", "getClasses"}, message="Choose a valid class.")
	 * @ORM\Column(name="class", type="string", length=15)
	 */
	private $class;

	/**
	 * maximum output power of the PowerSupply metered in miliWatt
	 *
	 * @var float
	 *
	 * @Assert\NotBlank()
	 * @ORM\Column(name="total_output_power", type="decimal")
	 */
	private $totalOutputPower;

	/**
	 * @var integer
	 *
	 * @Assert\NotBlank()
	 * @ORM\Column(name="efficiency", type="integer")
	 */
	private $efficiency;

	/**
	 * @var integer
	 *
	 * @Assert\NotBlank()
	 * @ORM\ManyToOne(targetEntity="Debb\ManagementBundle\Entity\FlowProfile")
	 */
	private $powerProfile;

	/**
	 * Returns a array for later converting
	 * 
	 * @return array the array for later converting
	 */
	public function getDebbXmlArray()
	{
		$array = parent::getDebbXmlArray();
		if ($this->getClass() != null)
		{
			$array['Class'] = $this->getClass();
		}
		if ($this->getTotalOutputPower() != null)
		{
			$array['TotalOutputPower'] = $this->getTotalOutputPower();
		}
		if ($this->getEfficiency() != null)
		{
			$array['Efficiency'] = $this->getEfficiency();
		}
		if ($this->getPowerProfile() != null)
		{
			$array['PowerProfile'] = $this->getPowerProfile()->get;
		}
		return $array;
	}

    /**
     * Set class
     *
     * @param string $class
     * @return PowerSupply
     */
    public function setClass($class)
    {
        $this->class = $class;
    
        return $this;
    }

    /**
     * Get class
     *
     * @return string 
     */
    public function getClass()
    {
        return $this->class;
    }

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
     * Set powerProfile
     *
     * @param \Debb\ManagementBundle\Entity\FlowProfile $powerProfile
     * @return PowerSupply
     */
    public function setPowerProfile(\Debb\ManagementBundle\Entity\FlowProfile $powerProfile = null)
    {
        $this->powerProfile = $powerProfile;
    
        return $this;
    }

    /**
     * Get powerProfile
     *
     * @return \Debb\ManagementBundle\Entity\FlowProfile 
     */
    public function getPowerProfile()
    {
        return $this->powerProfile;
    }
}