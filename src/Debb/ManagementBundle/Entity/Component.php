<?php

namespace Debb\ManagementBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Component
 *
 * @ORM\Table(name="component")
 * @ORM\Entity()
 */
class Component
{
	/* Define types always in DebbConfigBundle Controller NodeController.php */
	/* Define types always in DebbConfigBundle Resources public js node.js */
	/* Define types always in DebbConfigBundle Resources translations messages.*.yml */
	/* Define types always in DebbManagementBundle Form ComponentType.php */

	/**
	 * [Type] Nothing
	 *
	 * @var int
	 */

	const TYPE_NOTHING = 0;

	/**
	 * [Type] Mainboard
	 *
	 * @var int
	 */
	const TYPE_MAINBOARD = 1;

	/**
	 * [Type] Processor
	 *
	 * @var int
	 */
	const TYPE_PROCESSOR = 2;

	/**
	 * [Type] Cooling Device
	 *
	 * @var int
	 */
	const TYPE_COOLING_DEVICE = 3;

	/**
	 * [Type] Memory
	 *
	 * @var int
	 */
	const TYPE_MEMORY = 4;

	/**
	 * [Type] Power Supply
	 *
	 * @var int
	 */
	const TYPE_POWER_SUPPLY = 5;

	/**
	 * [Type] Storage
	 *
	 * @var int
	 */
	const TYPE_STORAGE = 6;

	/**
	 * [Type] Heatsink
	 *
	 * @var int
	 */
	const TYPE_HEATSINK = 7;

	/**
	 * @var integer
	 *
	 * @ORM\Column(name="id", type="integer")
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	private $id;

	/**
	 * @var integer
	 *
	 * @ORM\Column(name="type", type="integer")
	 */
	private $type = self::TYPE_NOTHING;

	/**
	 * @var integer
	 *
	 * @ORM\Column(name="amount", type="integer", nullable=true)
	 */
	private $amount;

	/**
	 * @var Debb\ConfigBundle\Entity\Node
	 *
	 * @ORM\ManyToOne(targetEntity="Debb\ConfigBundle\Entity\Node", inversedBy="components")
	 */
	private $node;

	/**
	 * @var Debb\ManagementBundle\Entity\Processor
	 * 
	 * @ORM\ManyToOne(targetEntity="Processor")
	 * @ORM\JoinColumn(name="processor_id", referencedColumnName="id", onDelete="cascade")
	 */
	private $processor;

	/**
	 * @var Debb\ManagementBundle\Entity\Mainboard
	 * 
	 * @ORM\ManyToOne(targetEntity="Mainboard")
	 * @ORM\JoinColumn(name="mainboard_id", referencedColumnName="id", onDelete="cascade")
	 */
	private $mainboard;

	/**
	 * @var Debb\ManagementBundle\Entity\CoolingDevice
	 * 
	 * @ORM\ManyToOne(targetEntity="CoolingDevice")
	 * @ORM\JoinColumn(name="coolingdevice_id", referencedColumnName="id", onDelete="cascade")
	 */
	private $coolingDevice;

	/**
	 * @var Debb\ManagementBundle\Entity\Memory
	 * 
	 * @ORM\ManyToOne(targetEntity="Memory")
	 * @ORM\JoinColumn(name="memory_id", referencedColumnName="id", onDelete="cascade")
	 */
	private $memory;

	/**
	 * @var Debb\ManagementBundle\Entity\PowerSupply
	 * 
	 * @ORM\ManyToOne(targetEntity="PowerSupply")
	 * @ORM\JoinColumn(name="powersupply_id", referencedColumnName="id", onDelete="cascade")
	 */
	private $powersupply;

	/**
	 * @var Debb\ManagementBundle\Entity\Storage
	 * 
	 * @ORM\ManyToOne(targetEntity="Storage")
	 * @ORM\JoinColumn(name="storage_id", referencedColumnName="id", onDelete="cascade")
	 */
	private $storage;

	/**
	 * @var Debb\ManagementBundle\Entity\Heatsink
	 *
	 * @ORM\ManyToOne(targetEntity="Heatsink")
	 * @ORM\JoinColumn(name="heatsink_id", referencedColumnName="id", onDelete="cascade")
	 */
	private $heatsink;

	/**
	 * Get id
	 *
	 * @return integer 
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * Set type
	 *
	 * @param integer $type
	 * @return Component
	 */
	public function setType($type)
	{
		$this->type = $type;

		return $this;
	}

	/**
	 * Get type
	 *
	 * @return integer 
	 */
	public function getType()
	{
		return $this->type;
	}

	/**
	 * Set node
	 *
	 * @param \Debb\ConfigBundle\Entity\Node $node
	 * @return Component
	 */
	public function setNode(\Debb\ConfigBundle\Entity\Node $node = null)
	{
		$this->node = $node;

		return $this;
	}

	/**
	 * Get node
	 *
	 * @return \Debb\ConfigBundle\Entity\Node 
	 */
	public function getNode()
	{
		return $this->node;
	}

	/**
	 * Set processor
	 *
	 * @param \Debb\ManagementBundle\Entity\Processor $processor
	 * @return Component
	 */
	public function setProcessor(\Debb\ManagementBundle\Entity\Processor $processor = null)
	{
		$this->processor = $processor;
		if($this->processor != null)
		{
			$this->setType(self::TYPE_PROCESSOR);
		}

		return $this;
	}

	/**
	 * Get processor
	 *
	 * @return \Debb\ManagementBundle\Entity\Processor 
	 */
	public function getProcessor()
	{
		return $this->processor;
	}

	/**
	 * Set mainboard
	 *
	 * @param \Debb\ManagementBundle\Entity\Mainboard $mainboard
	 * @return Component
	 */
	public function setMainboard(\Debb\ManagementBundle\Entity\Mainboard $mainboard = null)
	{
		$this->mainboard = $mainboard;
		if($this->mainboard != null)
		{
			$this->setType(self::TYPE_MAINBOARD);
		}

		return $this;
	}

	/**
	 * Get mainboard
	 *
	 * @return \Debb\ManagementBundle\Entity\Mainboard 
	 */
	public function getMainboard()
	{
		return $this->mainboard;
	}

	/**
	 * Set coolingDevice
	 *
	 * @param \Debb\ManagementBundle\Entity\CoolingDevice $coolingDevice
	 * @return Component
	 */
	public function setCoolingDevice(\Debb\ManagementBundle\Entity\CoolingDevice $coolingDevice = null)
	{
		$this->coolingDevice = $coolingDevice;
		if($this->coolingDevice != null)
		{
			$this->setType(self::TYPE_COOLING_DEVICE);
		}

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

	/**
	 * Set memory
	 *
	 * @param \Debb\ManagementBundle\Entity\Memory $memory
	 * @return Component
	 */
	public function setMemory(\Debb\ManagementBundle\Entity\Memory $memory = null)
	{
		$this->memory = $memory;
		if($this->memory != null)
		{
			$this->setType(self::TYPE_MEMORY);
		}

		return $this;
	}

	/**
	 * Get memory
	 *
	 * @return \Debb\ManagementBundle\Entity\Memory 
	 */
	public function getMemory()
	{
		return $this->memory;
	}

	/**
	 * Set powersupply
	 *
	 * @param \Debb\ManagementBundle\Entity\PowerSupply $powersupply
	 * @return Component
	 */
	public function setPowersupply(\Debb\ManagementBundle\Entity\PowerSupply $powersupply = null)
	{
		$this->powersupply = $powersupply;
		if($this->powersupply != null)
		{
			$this->setType(self::TYPE_POWER_SUPPLY);
		}

		return $this;
	}

	/**
	 * Get powersupply
	 *
	 * @return \Debb\ManagementBundle\Entity\PowerSupply 
	 */
	public function getPowersupply()
	{
		return $this->powersupply;
	}

	/**
	 * Set storage
	 *
	 * @param \Debb\ManagementBundle\Entity\Storage $storage
	 * @return Component
	 */
	public function setStorage(\Debb\ManagementBundle\Entity\Storage $storage = null)
	{
		$this->storage = $storage;
		if($this->storage != null)
		{
			$this->setType(self::TYPE_STORAGE);
		}

		return $this;
	}

	/**
	 * Get storage
	 *
	 * @return \Debb\ManagementBundle\Entity\Storage 
	 */
	public function getStorage()
	{
		return $this->storage;
	}

	/**
	 * Set heatsink
	 *
	 * @param \Debb\ManagementBundle\Entity\Heatsink $heatsink
	 * @return Component
	 */
	public function setHeatsink(\Debb\ManagementBundle\Entity\Heatsink $heatsink = null)
	{
		$this->heatsink = $heatsink;
		if($this->heatsink != null)
		{
			$this->setType(self::TYPE_HEATSINK);
		}

		return $this;
	}

	/**
	 * Get heatsink
	 *
	 * @return \Debb\ManagementBundle\Entity\Heatsink
	 */
	public function getHeatsink()
	{
		return $this->storage;
	}

	/**
	 * Set amount
	 *
	 * @param integer $amount
	 * @return Component
	 */
	public function setAmount($amount)
	{
		$this->amount = $amount;

		return $this;
	}

	/**
	 * Get amount
	 *
	 * @return integer 
	 */
	public function getAmount()
	{
		return $this->amount;
	}

	/**
	 * Get the active element
	 * 
	 * null|Class of the type - the active type class
	 */
	public function getActive()
	{
		if($this->getAmount() < 1)
		{
			return null;
		}
		if($this->getType() == $this::TYPE_MAINBOARD)
		{
			return $this->getMainboard();
		}
		else if($this->getType() == $this::TYPE_PROCESSOR)
		{
			return $this->getProcessor();
		}
		else if($this->getType() == $this::TYPE_COOLING_DEVICE)
		{
			return $this->getCoolingDevice();
		}
		else if($this->getType() == $this::TYPE_MEMORY)
		{
			return $this->getMemory();
		}
		else if($this->getType() == $this::TYPE_POWER_SUPPLY)
		{
			return $this->getPowersupply();
		}
		else if($this->getType() == $this::TYPE_STORAGE)
		{
			return $this->getStorage();
		}
		else if($this->getType() == $this::TYPE_HEATSINK)
		{
			return $this->getHeatsink();
		}
		return null;
	}

	/**
	 * Returns a array for later converting
	 * 
	 * @return array the array for later converting
	 */
	public function getDebbXmlArray()
	{
		$array = array();
		for($x = 0; $x < $this->getAmount(); $x++)
		{
			if($this->getType() == $this::TYPE_MAINBOARD && $this->getMainboard() != null)
			{
				$array[]['Mainboard'] = $this->getMainboard()->getDebbXmlArray();
			}
			else if($this->getType() == $this::TYPE_PROCESSOR && $this->getProcessor() != null)
			{
				$array[]['Processor'] = $this->getProcessor()->getDebbXmlArray();
			}
			else if($this->getType() == $this::TYPE_COOLING_DEVICE && $this->getCoolingDevice() != null)
			{
				$array[]['CoolingDevice'] = $this->getCoolingDevice()->getDebbXmlArray();
			}
			else if($this->getType() == $this::TYPE_MEMORY && $this->getMemory() != null)
			{
				$array[]['Memory'] = $this->getMemory()->getDebbXmlArray();
			}
			else if($this->getType() == $this::TYPE_POWER_SUPPLY && $this->getPowersupply() != null)
			{
				$array[]['PowerSupply'] = $this->getPowersupply()->getDebbXmlArray();
			}
			else if($this->getType() == $this::TYPE_STORAGE && $this->getStorage() != null)
			{
				$array[]['Storage'] = $this->getStorage()->getDebbXmlArray();
			}
			else if($this->getType() == $this::TYPE_HEATSINK && $this->getHeatsink() != null)
			{
				$array[]['Heatsink'] = $this->getHeatsink()->getDebbXmlArray();
			}
		}
		return $array;
	}

}