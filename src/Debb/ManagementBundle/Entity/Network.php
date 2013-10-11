<?php

namespace Debb\ManagementBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Network
 *
 * @ORM\Table(name="network")
 * @ORM\Entity(repositoryClass="Debb\ManagementBundle\Repository\BaseRepository")
 */
class Network extends Base
{
    /**
     * Physical Interface description like fibre, twisted pair, etc.
     *
     * @var string
     *
     * @ORM\Column(name="interface", type="string", length=255, nullable=true)
     */
    private $interface;

    /**
     * 10GE, IB QDR etc.
     *
     * @var string
     *
     * @ORM\Column(name="technology", type="string", length=30, nullable=true)
     */
    private $technology;

    /**
     * Bandwidth as number in bit/s
     *
     * @var integer
     *
     * @ORM\Column(name="max_bandwidth", type="integer", nullable=true)
     */
    private $maxBandwidth;

	/**
	 * Components
	 *
	 * @ORM\OneToMany(targetEntity="Debb\ManagementBundle\Entity\Component", cascade={"persist"}, mappedBy="network", orphanRemoval=true)
	 *
	 * @var \Debb\ManagementBundle\Entity\Component[]
	 */
	private $components;

	/**
	 * Returns a array for later converting
	 *
	 * @return array the array for later converting
	 */
	public function getDebbXmlArray()
	{
		$array = array();
		if($this->getInterface() !== null)
		{
			$array['Interface'] = $this->getInterface();
		}
		if($this->getTechnology() !== null)
		{
			$array['Technology'] = $this->getTechnology();
		}
		if($this->getMaxBandwidth() !== null)
		{
			$array['MaxBandwidth'] = $this->getMaxBandwidth();
		}
		return $array;
	}

    /**
     * Set interface
     *
     * @param string $interface
     * @return Network
     */
    public function setInterface($interface)
    {
        $this->interface = $interface;
    
        return $this;
    }

    /**
     * Get interface
     *
     * @return string 
     */
    public function getInterface()
    {
        return $this->interface;
    }

    /**
     * Set technology
     *
     * @param string $technology
     * @return Network
     */
    public function setTechnology($technology)
    {
        $this->technology = $technology;
    
        return $this;
    }

    /**
     * Get technology
     *
     * @return string 
     */
    public function getTechnology()
    {
        return $this->technology;
    }

    /**
     * Set maxBandwidth
     *
     * @param integer $maxBandwidth
     * @return Network
     */
    public function setMaxBandwidth($maxBandwidth)
    {
        $this->maxBandwidth = $maxBandwidth;
    
        return $this;
    }

    /**
     * Get maxBandwidth
     *
     * @return integer 
     */
    public function getMaxBandwidth()
    {
        return $this->maxBandwidth;
    }

	/**
	 * Constructor
	 */
	public function __construct()
	{
		$this->components = new \Doctrine\Common\Collections\ArrayCollection();
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
}
