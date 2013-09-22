<?php

namespace Debb\ConfigBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Room
 *
 * @ORM\Table(name="room")
 * @ORM\Entity(repositoryClass="Debb\ManagementBundle\Repository\BaseRepository")
 */
class Room extends Dimensions
{
	/**
	 * @var \Debb\ManagementBundle\Entity\RackToRoom[]
	 *
	 * @ORM\OneToMany(targetEntity="Debb\ManagementBundle\Entity\RackToRoom", cascade={"persist"}, mappedBy="room", orphanRemoval=true)
	 */
	private $racks;

	/**
	 * @var \Debb\ManagementBundle\Entity\FlowPumpToRoom[]
	 *
	 * @ORM\OneToMany(targetEntity="Debb\ManagementBundle\Entity\FlowPumpToRoom", cascade={"persist"}, mappedBy="room", orphanRemoval=true)
	 */
	private $flowPumps;

    /**
     * @var string
     *
     * @ORM\Column(name="building", type="string", length=255, nullable=true)
     */
    private $building;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=true)
     */
    private $name;

	/**
	 * @var \Debb\ManagementBundle\Entity\File[]
	 *
	 * @ORM\ManyToMany(targetEntity="Debb\ManagementBundle\Entity\File", cascade={"all"}, orphanRemoval=true)
	 */
	private $references;

	/**
	 * Constructor
	 */
	public function __construct()
	{
		$this->racks = new \Doctrine\Common\Collections\ArrayCollection();
		$this->flowPumps = new \Doctrine\Common\Collections\ArrayCollection();
		$this->references = new \Doctrine\Common\Collections\ArrayCollection();
	}

	/**
	 * Add racks
	 *
	 * @param \Debb\ManagementBundle\Entity\RackToRoom $racks
	 * @return Room
	 */
	public function addRack(\Debb\ManagementBundle\Entity\RackToRoom $racks)
	{
		$racks->setRoom($this);
		$this->racks[] = $racks;

		return $this;
	}

	/**
	 * Set racks
	 *
	 * @param \Debb\ManagementBundle\Entity\RackToRoom[] $racks
	 * @return Room
	 */
	public function setRacks($racks)
	{
		$this->racks = $racks;

		foreach ($this->racks as $rack)
		{
			$rack->setRoom($this);
		}

		return $this;
	}

	/**
	 * Remove racks
	 *
	 * @param \Debb\ManagementBundle\Entity\RackToRoom $racks
	 */
	public function removeRack(\Debb\ManagementBundle\Entity\RackToRoom $racks)
	{
		$this->racks->removeElement($racks);
	}

	/**
	 * Get racks
	 *
	 * @return \Debb\ManagementBundle\Entity\RackToRoom[]
	 */
	public function getRacks()
	{
		return $this->racks;
	}

	/**
	 * Sort racks (unused) (reverse)
	 */
	public function sortRacks()
	{
		$ordered = new \Doctrine\Common\Collections\ArrayCollection();
		for ($i = $this->racks->count() - 1; $i >= 0; $i--)
		{
			$ordered->add($this->racks[$i]);
		}
		$this->racks = $ordered;

		$x = 0;
		foreach ($this->racks as $rack)
		{
			$rack->setField($x);
			$x++;
		}
	}

	/**
	 * Get the next free field in rack array
	 *
	 * @return int the next free field in rack array
	 */
	public function getFreeRack()
	{
		$ids = array();
		foreach ($this->getRacks() as $rack)
		{
			$ids[] = $rack->getField();
		}
		ksort($ids);

		$res = 0;
		foreach ($ids as $id)
		{
			if ($id == $res)
			{
				$res++;
			}
		}
		return $res;
	}

	/**
	 * Add flowPump
	 *
	 * @param \Debb\ManagementBundle\Entity\RackToRoom $flowPump
	 * @return Room
	 */
	public function addFlowPump(\Debb\ManagementBundle\Entity\FlowPumpToRoom $flowPump)
	{
		$flowPump->setRoom($this);
		$this->flowPumps[] = $flowPump;

		return $this;
	}

	/**
	 * Set flowPumps
	 *
	 * @param \Debb\ManagementBundle\Entity\FlowPumpToRoom[] $flowPumps
	 * @return Room
	 */
	public function setFlowPumps($flowPumps)
	{
		$this->flowPumps = $flowPumps;

		foreach ($this->flowPumps as $flowPump)
		{
			$flowPump->setRoom($this);
		}

		return $this;
	}

	/**
	 * Remove flowPump
	 *
	 * @param \Debb\ManagementBundle\Entity\RackToRoom $flowPump
	 */
	public function removeFlowPump(\Debb\ManagementBundle\Entity\FlowPumpToRoom $flowPump)
	{
		$this->flowPumps->removeElement($flowPump);
	}

	/**
	 * Get flowPumps
	 *
	 * @return \Debb\ManagementBundle\Entity\FlowPumpToRoom[]
	 */
	public function getFlowPumps()
	{
		return $this->flowPumps;
	}

	/**
	 * Sort flowPumps (unused) (reverse)
	 */
	public function sortFlowPumps()
	{
		$ordered = new \Doctrine\Common\Collections\ArrayCollection();
		for ($i = $this->flowPumps->count() - 1; $i >= 0; $i--)
		{
			$ordered->add($this->flowPumps[$i]);
		}
		$this->flowPumps = $ordered;

		$x = 0;
		foreach ($this->flowPumps as $flowPump)
		{
			$flowPump->setField($x);
			$x++;
		}
	}

	/**
	 * Get the next free field in flowPump array
	 *
	 * @return int the next free field in flowPump array
	 */
	public function getFreeFlowPump()
	{
		$ids = array();
		foreach ($this->getFlowPumps() as $flowPump)
		{
			$ids[] = $flowPump->getField();
		}
		ksort($ids);

		$res = 0;
		foreach ($ids as $id)
		{
			if ($id == $res)
			{
				$res++;
			}
		}
		return $res;
	}

	/**
	 * Returns a array for later converting
	 * 
	 * @return array the array for later converting
	 */
	public function getDebbXmlArray()
	{
		$array['Room'] = parent::getDebbXmlArray();
		foreach($this->getReferences() as $reference)
		{
			$array['Room'][] = array(array('Reference' => array('Type' => $reference->getFileEnding(), 'Location' => './object/' . $reference->getId() . '_' . $reference->getName())));
		}
		return $array;
	}

    /**
     * Set building
     *
     * @param string $building
     * @return Room
     */
    public function setBuilding($building)
    {
        $this->building = $building;
        $this->setProductByNameAndBuilding();
    
        return $this;
    }

    /**
     * Get building
     *
     * @return string 
     */
    public function getBuilding()
    {
        return $this->building;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Room
     */
    public function setName($name)
    {
        $this->name = $name;
        $this->setProductByNameAndBuilding();
    
        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Sets the product to the name and the building
     */
    public function setProductByNameAndBuilding()
    {
        $name = array();
        if($this->getBuilding() != null)
        {
            $name[] = $this->getBuilding();
        }
        if($this->getName() != null)
        {
            $name[] = $this->getName();
        }
        $this->setProduct(implode(' - ', $name));
    }

	/**
	 * Add references
	 *
	 * @param \Debb\ManagementBundle\Entity\File $references
	 * @return DEBBSimple
	 */
	public function addReference(\Debb\ManagementBundle\Entity\File $references)
	{
		$this->references[] = $references;

		return $this;
	}

	/**
	 * Remove references
	 *
	 * @param \Debb\ManagementBundle\Entity\File $references
	 */
	public function removeReference($reference)
	{
		$this->references->removeElement($reference);
	}

	/**
	 * Get references
	 *
	 * @return \Debb\ManagementBundle\Entity\File[]
	 */
	public function getReferences()
	{
		return $this->references->getValues();
	}

	/**
	 * @return array
	 */
	public function getChildrens()
	{
		$childrens = array();
		foreach($this->getRacks() as $rackToRoom)
		{
			if($rackToRoom->getRack() != null)
			{
				$childrens[] = array($rackToRoom->getRack(), $rackToRoom);
			}
		}
		foreach($this->getFlowPumps() as $flowPumpToRoom)
		{
			if($flowPumpToRoom->getFlowPump() != null)
			{
				$childrens[] = array($flowPumpToRoom->getFlowPump(), $flowPumpToRoom);
			}
		}
		return $childrens;
	}

	/**
	 * @return string the debb level
	 */
	public function getDebbLevel()
	{
		return 'Room';
	}
}
