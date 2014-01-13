<?php

namespace Debb\ManagementBundle\Entity;

use Debb\ManagementBundle\DataTransformer\DecimalTransformer;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * CoolingDevice
 *
 * @ORM\Table(name="coolingdevice")
 * @ORM\Entity(repositoryClass="Debb\ManagementBundle\Repository\BaseRepository")
 */
class CoolingDevice extends DEBBComplex
{
	/**
	 * @var string
	 *
	 * The cooling device should contain all functional sections of the
	 * cooling from heat exchanger chiller, dry cooler etc. The combination of
	 * such functional elements result in a specific class of cooling device so
	 * from the class the order of following functional elements can be
	 * deduced directly. Only CRAH and free cooling are currently used
	 *
	 * @Assert\Choice(callback={"Debb\ManagementBundle\Form\CoolingDeviceType", "getClasses"}, message="Choose a valid class.")
	 * @ORM\Column(name="class", type="string", length=255)
	 */
	private $class;

	/**
	 * @var float
	 *
	 * @ORM\Column(name="fan_efficiency", type="decimal", precision=18, scale=9, nullable=true)
	 */
	private $fanEfficiency;

	/**
	 * @var float
	 *
	 * @ORM\Column(name="cooling_coil_efficiency", type="decimal", precision=18, scale=9, nullable=true)
	 */
	private $coolingCoilEfficiency;

	/**
	 * @var float
	 *
	 * @ORM\Column(name="delta_th_ex", type="decimal", precision=18, scale=9, nullable=true)
	 */
	private $deltaThEx;

	/**
	 * @var float
	 *
	 * @ORM\Column(name="max_cooling_capacity", type="decimal", precision=18, scale=9, nullable=true)
	 */
	private $maxCoolingCapacity;

	/**
	 * @var float
	 *
	 * @ORM\Column(name="cooling_capacity_rated", type="decimal", precision=18, scale=9, nullable=true)
	 */
	private $coolingCapacityRated;

	/**
	 * @var float
	 *
	 * @ORM\Column(name="eerrated", type="decimal", precision=18, scale=9, nullable=true)
	 */
	private $eERRated;

	/**
	 * @var \Debb\ManagementBundle\Entity\CoolingEER
	 *
	 * @ORM\OneToMany(targetEntity="Debb\ManagementBundle\Entity\CoolingEER", mappedBy="coolingDevice", cascade={"all"}, orphanRemoval=true)
	 */
	private $energyEfficiencyRatio;

	/**
	 * @var float
	 *
	 * @ORM\Column(name="delta_th_dry_cooler", type="decimal", precision=18, scale=9, nullable=true)
	 */
	private $deltaThDryCooler;

	/**
	 * @var float
	 *
	 * @ORM\Column(name="dry_cooler_efficiency", type="decimal", precision=18, scale=9, nullable=true)
	 */
	private $dryCoolerEfficiency;

	/**
	 * Components
	 *
	 * @ORM\OneToMany(targetEntity="Debb\ManagementBundle\Entity\Component", cascade={"persist"}, mappedBy="coolingDevice", orphanRemoval=true)
	 *
	 * @var \Debb\ManagementBundle\Entity\Component[]
	 */
	private $components;

	/**
	 * Constructor
	 */
	function __construct()
	{
		$this->energyEfficiencyRatio = new \Doctrine\Common\Collections\ArrayCollection();
		$this->components = new \Doctrine\Common\Collections\ArrayCollection();
	}

	/**
	 * Returns a array for later converting
	 * 
	 * @return array the array for later converting
	 */
	public function getDebbXmlArray()
	{
		$array = parent::getDebbXmlArray();
		$array['Class'] = $this->getClass();

		/**
		 * CRAH
		 */
//		if(strtolower($this->getClass()) == 'CRAH')
		if($this->getFanEfficiency() !== null && $this->getCoolingCoilEfficiency() !== null && $this->getDeltaThEx() !== null)
		{
			$array['CRAH'] = array(
				'FanEfficiency' => $this->getFanEfficiency(),
				'CoolingCoilEfficiency' => $this->getCoolingCoilEfficiency(),
				'DeltaThEx' => $this->getDeltaThEx()
			);
		}

		/**
		 * Chiller
		 */
//		if(strtolower($this->getClass()) == 'Chiller')
		if($this->getCoolingCapacityRated() !== null && $this->getEERRated() !== null)
		{
			$chiller = array();
			if($this->getMaxCoolingCapacity() !== null)
			{
				$chiller['MaxCoolingCapacity'] = $this->getMaxCoolingCapacity();
			}

			$chiller['CoolingCapacityRated'] = $this->getCoolingCapacityRated();
			$chiller['EERRated'] = $this->getEERRated();

			if ($this->getEnergyEfficiencyRatio() !== null && count($this->getEnergyEfficiencyRatio()) > 0)
			{
				$chiller['EnergyEfficiencyRatio'] = array();
				foreach($this->getEnergyEfficiencyRatio() as $eer)
				{
					$chiller['EnergyEfficiencyRatio'][] = array($eer->getDebbXmlArray());
				}
			}

			$array['Chiller'] = $chiller;
		}

		/**
		 * DryCooler
		 */
//		if(strtolower($this->getClass()) == 'DryCooler')
		if($this->getDeltaThDryCooler() !== null && $this->getDryCoolerEfficiency() !== null)
		{
			$array['DryCooler'] = array(
				'DeltaThDryCooler' => $this->getDeltaThDryCooler(),
				'DryCoolerEfficiency' => $this->getDryCoolerEfficiency()
			);
		}
		return $array;
	}

    /**
     * Set class
     *
     * @param string $class
     * @return CoolingDevice
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
        return (string) $this->class;
    }

    /**
     * Add energyEfficiencyRatio
     *
     * @param \Debb\ManagementBundle\Entity\CoolingEER $energyEfficiencyRatio
     * @return CoolingDevice
     */
    public function addEnergyEfficiencyRatio($energyEfficiencyRatio)
    {
		if($energyEfficiencyRatio instanceof \Debb\ManagementBundle\Entity\CoolingEER)
		{
			$this->energyEfficiencyRatio[] = $energyEfficiencyRatio;
			$energyEfficiencyRatio->setCoolingDevice($this);
		}

        return $this;
    }

    /**
     * Remove energyEfficiencyRatio
     *
     * @param \Debb\ManagementBundle\Entity\CoolingEER $energyEfficiencyRatio
     */
    public function removeEnergyEfficiencyRatio(\Debb\ManagementBundle\Entity\CoolingEER $energyEfficiencyRatio)
    {
		$energyEfficiencyRatio->setCoolingDevice();
        $this->energyEfficiencyRatio->removeElement($energyEfficiencyRatio);
    }

    /**
     * Get energyEfficiencyRatio
     *
     * @return \Debb\ManagementBundle\Entity\CoolingEER[]
     */
    public function getEnergyEfficiencyRatio()
    {
        return $this->energyEfficiencyRatio;
    }

	/**
	 * Add components
	 *
	 * @param \Debb\ManagementBundle\Entity\Component $components
	 * @return Heatsink
	 */
	public function addComponent(\Debb\ManagementBundle\Entity\Component $components)
	{
		$this->components[] = $components;

		return $this;
	}

	/**
	 * Remove components
	 *
	 * @param \Debb\ManagementBundle\Entity\Component $components
	 */
	public function removeComponent(\Debb\ManagementBundle\Entity\Component $components)
	{
		$this->components->removeElement($components);
	}

	/**
	 * Get components
	 *
	 * @return Component[]
	 */
	public function getComponents()
	{
		return $this->components;
	}

	/**
	 * Get the parents
	 *
	 * @return Component[]
	 */
	public function getParents()
	{
		return $this->getComponents();
	}

    /**
     * Set fanEfficiency
     *
     * @param float $fanEfficiency
     * @return CoolingDevice
     */
    public function setFanEfficiency($fanEfficiency)
    {
        $this->fanEfficiency = $fanEfficiency;
    
        return $this;
    }

    /**
     * Get fanEfficiency
     *
     * @return float 
     */
    public function getFanEfficiency()
    {
        return DecimalTransformer::convert($this->fanEfficiency, false);
    }

    /**
     * Set coolingCoilEfficiency
     *
     * @param float $coolingCoilEfficiency
     * @return CoolingDevice
     */
    public function setCoolingCoilEfficiency($coolingCoilEfficiency)
    {
        $this->coolingCoilEfficiency = $coolingCoilEfficiency;
    
        return $this;
    }

    /**
     * Get coolingCoilEfficiency
     *
     * @return float 
     */
    public function getCoolingCoilEfficiency()
    {
        return DecimalTransformer::convert($this->coolingCoilEfficiency, false);
    }

    /**
     * Set deltaThEx
     *
     * @param float $deltaThEx
     * @return CoolingDevice
     */
    public function setDeltaThEx($deltaThEx)
    {
        $this->deltaThEx = $deltaThEx;
    
        return $this;
    }

    /**
     * Get deltaThEx
     *
     * @return float 
     */
    public function getDeltaThEx()
    {
        return DecimalTransformer::convert($this->deltaThEx, false);
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
        return DecimalTransformer::convert($this->maxCoolingCapacity, false);
    }

    /**
     * Set coolingCapacityRated
     *
     * @param float $coolingCapacityRated
     * @return CoolingDevice
     */
    public function setCoolingCapacityRated($coolingCapacityRated)
    {
        $this->coolingCapacityRated = $coolingCapacityRated;
    
        return $this;
    }

    /**
     * Get coolingCapacityRated
     *
     * @return float 
     */
    public function getCoolingCapacityRated()
    {
        return DecimalTransformer::convert($this->coolingCapacityRated, false);
    }

    /**
     * Set eERRated
     *
     * @param float $eERRated
     * @return CoolingDevice
     */
    public function setEERRated($eERRated)
    {
        $this->eERRated = $eERRated;
    
        return $this;
    }

    /**
     * Get eERRated
     *
     * @return float 
     */
    public function getEERRated()
    {
        return DecimalTransformer::convert($this->eERRated, false);
    }

    /**
     * Set deltaThDryCooler
     *
     * @param float $deltaThDryCooler
     * @return CoolingDevice
     */
    public function setDeltaThDryCooler($deltaThDryCooler)
    {
        $this->deltaThDryCooler = $deltaThDryCooler;
    
        return $this;
    }

    /**
     * Get deltaThDryCooler
     *
     * @return float 
     */
    public function getDeltaThDryCooler()
    {
        return DecimalTransformer::convert($this->deltaThDryCooler, false);
    }

    /**
     * Set dryCoolerEfficiency
     *
     * @param float $dryCoolerEfficiency
     * @return CoolingDevice
     */
    public function setDryCoolerEfficiency($dryCoolerEfficiency)
    {
        $this->dryCoolerEfficiency = $dryCoolerEfficiency;
    
        return $this;
    }

    /**
     * Get dryCoolerEfficiency
     *
     * @return float 
     */
    public function getDryCoolerEfficiency()
    {
        return DecimalTransformer::convert($this->dryCoolerEfficiency, false);
    }
}