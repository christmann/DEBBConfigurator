<?php

namespace Debb\ManagementBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Memory
 *
 * @ORM\Table(name="memory")
 * @ORM\Entity(repositoryClass="Debb\ManagementBundle\Repository\BaseRepository")
 */
class Memory extends Base
{
	/**
	 * Size of Capacity in MB
	 *
	 * @var integer
	 *
	 * @Assert\NotBlank()
	 * @ORM\Column(name="capacity", type="integer")
	 */
	private $capacity;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="interface", type="string", length=255, nullable=true)
	 */
	private $interface;

	/**
	 * Set capacity
	 *
	 * @param integer $capacity
	 * @return Memory
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
		return $this->capacity;
	}

	/**
	 * Set interface
	 *
	 * @param string $interface
	 * @return Memory
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
	 * Returns a array for later converting
	 * 
	 * @return array the array for later converting
	 */
	public function getDebbXmlArray()
	{
		$array = parent::getDebbXmlArray();
		$array['Capacity'] = (int) $this->getCapacity();
		if ($this->getInterface() !== null)
		{
			$array['Interface'] = $this->getInterface();
		}
		return $array;
	}
}