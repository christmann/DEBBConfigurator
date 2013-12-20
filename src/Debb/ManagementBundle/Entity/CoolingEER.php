<?php

namespace Debb\ManagementBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * CoolingEER
 *
 * @ORM\Table(name="cooling_eer")
 * @ORM\Entity(repositoryClass="Debb\ManagementBundle\Repository\BaseRepository")
 */
class CoolingEER
{
    /**
	 * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
	 * Water temperature entering the chiller
	 *
     * @var float
     *
	 * @Assert\NotNull()
     * @ORM\Column(name="lwt", type="float")
     */
    private $lWT;

    /**
	 * Air temperature entering the condenser
	 *
     * @var float
     *
	 * @Assert\NotNull()
     * @ORM\Column(name="cwt", type="float")
     */
    private $cWT;

    /**
     * @var integer
     *
	 * @Assert\NotNull()
     * @ORM\Column(name="capacity", type="integer")
     */
    private $capacity;

    /**
     * @var integer
     *
	 * @Assert\NotNull()
     * @ORM\Column(name="power_usage", type="integer")
     */
    private $powerUsage;

    /**
     * @var float
     *
	 * @Assert\NotNull()
     * @ORM\Column(name="eer", type="float")
     */
    private $eER;

	/**
	 * @var User
	 *
	 * @ORM\ManyToOne(targetEntity="CoolEmAll\UserBundle\Entity\User")
	 */
	private $user;

	/**
	 * @var \Debb\ManagementBundle\Entity\CoolingDevice
	 *
	 * @ORM\ManyToOne(targetEntity="Debb\ManagementBundle\Entity\CoolingDevice", inversedBy="energyEfficiencyRatio")
	 */
	private $coolingDevice;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return (int) $this->id;
    }

    /**
     * Set lWT
     *
     * @param float $lWT
     * @return CoolingEER
     */
    public function setLWT($lWT)
    {
        $this->lWT = $lWT;
    
        return $this;
    }

    /**
     * Get lWT
     *
     * @return float 
     */
    public function getLWT()
    {
        return (float) $this->lWT;
    }

    /**
     * Set cWT
     *
     * @param float $cWT
     * @return CoolingEER
     */
    public function setCWT($cWT)
    {
        $this->cWT = $cWT;
    
        return $this;
    }

    /**
     * Get cWT
     *
     * @return float 
     */
    public function getCWT()
    {
        return (float) $this->cWT;
    }

    /**
     * Set capacity
     *
     * @param integer $capacity
     * @return CoolingEER
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
        return (int) $this->capacity;
    }

    /**
     * Set powerUsage
     *
     * @param integer $powerUsage
     * @return CoolingEER
     */
    public function setPowerUsage($powerUsage)
    {
        $this->powerUsage = $powerUsage;
    
        return $this;
    }

    /**
     * Get powerUsage
     *
     * @return integer 
     */
    public function getPowerUsage()
    {
        return (int) $this->powerUsage;
    }

    /**
     * Set eER
     *
     * @param float $eER
     * @return CoolingEER
     */
    public function setEER($eER)
    {
        $this->eER = $eER;
    
        return $this;
    }

    /**
     * Get eER
     *
     * @return float 
     */
    public function getEER()
    {
        return (float) $this->eER;
    }

    /**
     * Set user
     *
     * @param \CoolEmAll\UserBundle\Entity\User $user
     * @return CoolingEER
     */
    public function setUser(\CoolEmAll\UserBundle\Entity\User $user = null)
    {
        $this->user = $user;
    
        return $this;
    }

    /**
     * Get user
     *
     * @return \CoolEmAll\UserBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }

	/**
	 * Returns a array for later converting
	 *
	 * @return array the array for later converting
	 */
	public function getDebbXmlArray()
	{
		$array = array();
		$array['LWT'] = $this->getLWT() !== null ? $this->getLWT() : 0;
		$array['CWT'] = $this->getCWT() !== null ? $this->getCWT() : 0;
		$array['Capacity'] = $this->getCapacity() !== null ? $this->getCapacity() : 0;
		$array['PowerUsage'] = $this->getPowerUsage() !== null ? $this->getPowerUsage() : 0;
		$array['EER'] = $this->getEER() !== null ? $this->getEER() : 0;
		return array('Item' => $array);
	}

    /**
     * Set coolingDevice
     *
     * @param \Debb\ManagementBundle\Entity\CoolingDevice $coolingDevice
     * @return CoolingEER
     */
    public function setCoolingDevice(\Debb\ManagementBundle\Entity\CoolingDevice $coolingDevice = null)
    {
        $this->coolingDevice = $coolingDevice;
    
        return $this;
    }

    /**
     * Get coolingDevice
     *
     * @return \Debb\ManagementBundle\Entity\CoolingDevice 
     */
    public function getCoolingDevice()
    {
        return $this->coolingDevice;
    }
}