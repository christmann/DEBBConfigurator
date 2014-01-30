<?php

namespace Debb\ManagementBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Heatsink
 *
 * A heatsink is any type of device transfering heat betweeen two neighbour gas, fluids or solids like
 * heat exchanger in colling deviced transfering heat from one cooling circuit to
 * another (i.e. air/liquid or liquid/liquid) cpu cooler transfering heta from the cpu to the air
 * or liquid (solid/air or liquid)
 *
 * @ORM\Table(name="heatsink")
 * @ORM\Entity(repositoryClass="Debb\ManagementBundle\Repository\BaseRepository")
 */
class Heatsink extends DEBBSimple
{
	/**
	 * Also called efficiency
	 *
	 * @var float
	 *
	 * @ORM\Column(name="transfer_rate", type="float", nullable=true)
	 */
	private $transferRate;

	/**
	 * Components
	 *
	 * @ORM\OneToMany(targetEntity="Debb\ManagementBundle\Entity\Component", cascade={"persist"}, mappedBy="heatsink", orphanRemoval=true)
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
		if($this->getTransferRate() !== null)
		{
			$array['TransferRate'] = $this->getTransferRate();
		}
		return $array;
	}

    /**
     * Set transferRate
     *
     * @param float $transferRate
     * @return Heatsink
     */
    public function setTransferRate($transferRate)
    {
        $this->transferRate = $transferRate;
    
        return $this;
    }

    /**
     * Get transferRate
     *
     * @return float 
     */
    public function getTransferRate()
    {
        return $this->transferRate;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
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
		}
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