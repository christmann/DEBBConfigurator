<?php

namespace Debb\ManagementBundle\Entity;

use Debb\ManagementBundle\DataTransformer\DecimalTransformer;
use Doctrine\Common\Collections\ArrayCollection;
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
	 * Maximum Clockfrequency of CPU in MHz
	 *
	 * @var integer
	 *
	 * @Assert\NotNull()
	 * @ORM\Column(name="max_clock_speed", type="integer")
	 */
	private $maxClockSpeed;

	/**
	 * @var integer
	 *
	 * @ORM\Column(name="vcores_per_core", type="integer", nullable=true)
	 */
	private $virtualCoresPerCore;

	/**
	 * @var integer
	 *
	 * @ORM\Column(name="cores", type="integer", nullable=true)
	 */
	private $cores;

	/**
	 * @var \Debb\ManagementBundle\Entity\PState[]
	 *
	 * @ORM\OneToMany(targetEntity="Debb\ManagementBundle\Entity\PState", mappedBy="processor", cascade={"all"}, orphanRemoval=true)
	 */
	private $pStates;

	/**
	 * @var \Debb\ManagementBundle\Entity\CState[]
	 *
	 * @ORM\OneToMany(targetEntity="Debb\ManagementBundle\Entity\CState", mappedBy="processor", cascade={"all"}, orphanRemoval=true)
	 */
	private $cStates;

	/**
	 * @var float
	 *
	 * @ORM\Column(name="tdp", type="decimal", precision=18, scale=9, nullable=true)
	 */
	private $tdp;

	/**
	 * Components
	 *
	 * @ORM\OneToMany(targetEntity="Debb\ManagementBundle\Entity\Component", cascade={"persist"}, mappedBy="processor", orphanRemoval=true)
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
		$array = parent::getDebbXmlArray();
		$array['MaxClockSpeed'] = (int) $this->getMaxClockSpeed();
		if($this->getCores() !== null)
		{
			$array['Cores'] = $this->getCores();
		}
		$x = 1;
		foreach($this->getPStates() as $pState)
		{
			$array[] = array(array('PState' => $pState->getDebbXmlArray($x++)));
		}
		$x = 1;
		foreach($this->getCStates() as $cState)
		{
			$array[] = array(array('CState' => $cState->getDebbXmlArray($x++)));
		}
		if($this->getTDP() !== null)
		{
			$array['TDP'] = DecimalTransformer::convert($this->getTDP());
		}
		return $array;
	}

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->pStates = new \Doctrine\Common\Collections\ArrayCollection();
        $this->cStates = new \Doctrine\Common\Collections\ArrayCollection();
		$this->components = new \Doctrine\Common\Collections\ArrayCollection();
    }

	/**
	 * Duplicate this entity
	 */
	public function __clone()
	{
		if ($this->getId() > 0)
		{
			parent::__clone();

			$this->components = new ArrayCollection();

			$pStates = new ArrayCollection();
			foreach($this->getPStates() as $pState)
			{
				$pStates->add(clone $pState);
			}
			$this->setPState($pStates);

			$cStates = new ArrayCollection();
			foreach($this->getPStates() as $cState)
			{
				$cStates->add(clone $cState);
			}
			$this->setPState($cStates);
		}
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
     * @return integer 
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
     * Add pStates
     *
     * @param \Debb\ManagementBundle\Entity\PState $pStates
     * @return Processor
     */
    public function addPState($pStates)
    {
		if($pStates instanceof \Debb\ManagementBundle\Entity\PState)
		{
			$this->pStates[] = $pStates;
			$pStates->setProcessor($this);
		}
    
        return $this;
    }

    /**
     * Remove pStates
     *
     * @param \Debb\ManagementBundle\Entity\PState $pStates
     */
    public function removePState(\Debb\ManagementBundle\Entity\PState $pStates)
    {
	    $pStates->setProcessor();
        $this->pStates->removeElement($pStates);
    }

	/**
	 * Set pStates
	 *
	 * @param \Debb\ManagementBundle\Entity\PState[] $pStates
	 * @return Processor
	 */
	public function setPState($pStates)
	{
		$this->pStates = $pStates;

		foreach($this->pStates as $pState)
		{
			$pState->setProcessor($this);
		}

		return $this;
	}

    /**
     * Get pStates
     *
     * @return \Debb\ManagementBundle\Entity\PState[]
     */
    public function getPStates()
    {
        return $this->pStates;
    }

	/**
	 * Add cStates
	 *
	 * @param \Debb\ManagementBundle\Entity\CState $cStates
	 * @return Processor
	 */
	public function addCState($cStates)
	{
		if($cStates instanceof \Debb\ManagementBundle\Entity\CState)
		{
			$this->cStates[] = $cStates;
			$cStates->setProcessor($this);
		}

		return $this;
	}

	/**
	 * Remove cStates
	 *
	 * @param \Debb\ManagementBundle\Entity\CState $cStates
	 */
	public function removeCState(\Debb\ManagementBundle\Entity\CState $cStates)
	{
		$cStates->setProcessor();
		$this->cStates->removeElement($cStates);
	}

	/**
	 * Set cStates
	 *
	 * @param \Debb\ManagementBundle\Entity\CState[] $cStates
	 * @return Processor
	 */
	public function setCState($cStates)
	{
		$this->cStates = $cStates;

		foreach($this->cStates as $cState)
		{
			$cState->setProcessor($this);
		}

		return $this;
	}

	/**
	 * Get cStates
	 *
	 * @return \Debb\ManagementBundle\Entity\CState[]
	 */
	public function getCStates()
	{
		return $this->cStates;
	}

	/**
	 * Set tdp
	 *
	 * @param float $tdp
	 * @return Processor
	 */
	public function setTdp($tdp)
	{
		$this->tdp = $tdp;

		return $this;
	}

	/**
	 * Get tdp
	 *
	 * @return float
	 */
	public function getTdp()
	{
		return $this->tdp;
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
     * Set virtualCoresPerCore
     *
     * @param integer $virtualCoresPerCore
     * @return Processor
     */
    public function setVirtualCoresPerCore($virtualCoresPerCore)
    {
        $this->virtualCoresPerCore = $virtualCoresPerCore;
    
        return $this;
    }

    /**
     * Get virtualCoresPerCore
     *
     * @return integer 
     */
    public function getVirtualCoresPerCore()
    {
        return $this->virtualCoresPerCore;
    }
}