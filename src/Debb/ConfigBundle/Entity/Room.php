<?php

namespace Debb\ConfigBundle\Entity;

use Debb\ConfigBundle\Controller\XMLController;
use Debb\ManagementBundle\DataTransformer\DecimalTransformer;
use Debb\ManagementBundle\Entity\CoolingDevice;
use Debb\ManagementBundle\Entity\DEBBComponent;
use Debb\ManagementBundle\Entity\DEBBSimple;
use Debb\ManagementBundle\Entity\FlowPump;
use Debb\ManagementBundle\Entity\FlowPumpToRoom;
use Debb\ManagementBundle\Entity\RackToRoom;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Room
 *
 * @ORM\Table(name="room")
 * @ORM\Entity(repositoryClass="Debb\ManagementBundle\Repository\BaseRepository")
 */
class Room extends DEBBComponent
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
	 * @var \Debb\ManagementBundle\Entity\CoolingDevice[]
	 *
	 * @ORM\ManyToMany(targetEntity="Debb\ManagementBundle\Entity\CoolingDevice", cascade={"persist"})
	 */
	private $coolingDevices;

	/**
	 * Constructor
	 */
	public function __construct()
	{
		$this->racks = new \Doctrine\Common\Collections\ArrayCollection();
		$this->flowPumps = new \Doctrine\Common\Collections\ArrayCollection();
		$this->references = new \Doctrine\Common\Collections\ArrayCollection();
		$this->coolingDevices = new \Doctrine\Common\Collections\ArrayCollection();
		$this->isCorrect = true; // ignore the base function!
	}

	/**
	 * Wake up this room - Ignore the base "isThisCorrect" function!
	 */
	function __wakeup()
	{
		$this->isCorrect = true; // ignore the base function!
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
		/** @var $rack RackToRoom */
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
		/** @var $flowPump FlowPumpToRoom */
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
	 * Get the inlets of this room
	 *
	 * @param bool $useOutletsInstead should this function return outlets instead of inlets?
	 * @return \Debb\ManagementBundle\Entity\FlowPump[]
	 */
	public function getInlets($useOutletsInstead = false)
	{
		$array = array();
		foreach($this->getFlowPumps() as $flowPumpToRoom)
		{
			/** @var $flowPump FlowPump */
			$flowPump = $flowPumpToRoom->getFlowPump();
			if($flowPump != null)
			{
				if($flowPump !== null && $flowPump->isInlet() == !$useOutletsInstead)
				{
					$array[] = $flowPump->getDebbXmlArray();
				}
			}
		}
		return $array;
	}

	/**
	 * Get the outlets of this node group
	 *
	 * @return \Debb\ManagementBundle\Entity\FlowPump[]
	 */
	public function getOutlets()
	{
		return $this->getInlets(true);
	}

	/**
	 * Returns a array for later converting
	 * 
	 * @return array the array for later converting
	 */
	public function getDebbXmlArray()
	{
		$array['Room'] = parent::getDebbXmlArray();
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
		foreach($this->getCoolingDevices() as $coolingDevice)
		{
			$childrens[] = $coolingDevice;
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

	/**
	 * @Assert\True(message = "You have to fill in one of these fields: Name or building")
	 */
	public function isThisRoomCorrect()
	{
		return !empty($this->name) || !empty($this->building);
	}

    /**
     * Add coolingDevices
     *
     * @param \Debb\ManagementBundle\Entity\CoolingDevice $coolingDevices
     * @return Room
     */
    public function addCoolingDevice(\Debb\ManagementBundle\Entity\CoolingDevice $coolingDevices)
    {
        $this->coolingDevices[] = $coolingDevices;
    
        return $this;
    }

    /**
     * Remove coolingDevices
     *
     * @param \Debb\ManagementBundle\Entity\CoolingDevice $coolingDevices
     */
    public function removeCoolingDevice(\Debb\ManagementBundle\Entity\CoolingDevice $coolingDevices)
    {
        $this->coolingDevices->removeElement($coolingDevices);
    }

    /**
     * Get coolingDevices
     *
     * @return \Debb\ManagementBundle\Entity\CoolingDevice[]
     */
    public function getCoolingDevices()
    {
        return $this->coolingDevices;
    }

	/**
	 * @return float
	 */
	public function getRealCostsEur($inclSelf = true)
	{
		$costs = 0;

		// Count racks
		foreach($this->getRacks() as $rackToRoom)
		{
			if($rackToRoom instanceof RackToRoom && $rackToRoom->getRack() instanceof Rack)
			{
				$costs += $rackToRoom->getRack()->getRealCostsEur();
			}
		}

		// Count cooling devices
		foreach($this->getCoolingDevices() as $coolingDevice)
		{
			if($coolingDevice instanceof CoolingDevice)
			{
				$costs += $coolingDevice->getRealCostsEur();
			}
		}

		// Count flow pumps
		foreach($this->getFlowPumps() as $flowPump)
		{
			if($flowPump instanceof FlowPumpToRoom && $flowPump->getFlowPump() instanceof FlowPump)
			{
				$costs += $flowPump->getFlowPump()->getRealCostsEur();
			}
		}

		// Count self
		if($inclSelf)
		{
			$costs += parent::getRealCostsEur();
		}

		return DecimalTransformer::convert($costs);
	}

	/**
	 * @return float
	 */
	public function getRealCostsEnv($inclSelf = true)
	{
		$costs = 0;

		// Count racks
		foreach($this->getRacks() as $rackToRoom)
		{
			if($rackToRoom instanceof RackToRoom && $rackToRoom->getRack() instanceof Rack)
			{
				$costs += $rackToRoom->getRack()->getRealCostsEnv();
			}
		}

		// Count cooling devices
		foreach($this->getCoolingDevices() as $coolingDevice)
		{
			if($coolingDevice instanceof CoolingDevice)
			{
				$costs += $coolingDevice->getRealCostsEnv();
			}
		}

		// Count flow pumps
		foreach($this->getFlowPumps() as $flowPump)
		{
			if($flowPump instanceof FlowPumpToRoom && $flowPump->getFlowPump() instanceof FlowPump)
			{
				$costs += $flowPump->getFlowPump()->getRealCostsEnv();
			}
		}

		// Count self
		if($inclSelf)
		{
			$costs += parent::getRealCostsEnv();
		}

		return DecimalTransformer::convert($costs);
	}

	/**
	 * Get the costs array for xml
	 *
	 * @return array
	 */
	public function getCostsXml()
	{
		$costs = parent::getCostsXml();

		// Count racks
		foreach($this->getRacks() as $rackToRoom)
		{
			if($rackToRoom instanceof RackToRoom && $rackToRoom->getRack() instanceof Rack)
			{
				$costs[] = array(XMLController::get_real_class($rackToRoom->getRack()) => $rackToRoom->getRack()->getCostsXml());
			}
		}

		// Count cooling devices
		foreach($this->getCoolingDevices() as $coolingDevice)
		{
			if($coolingDevice instanceof CoolingDevice)
			{
				$costs[] = array(XMLController::get_real_class($coolingDevice) => $coolingDevice->getCostsXml());
			}
		}

		// Count flow pumps
		foreach($this->getFlowPumps() as $flowPump)
		{
			if($flowPump instanceof FlowPumpToRoom && $flowPump->getFlowPump() instanceof FlowPump)
			{
				$costs[] = array($flowPump->getFlowPump()->getDebbLevel() => $flowPump->getFlowPump()->getCostsXml());
			}
		}

		return $costs;
	}
}