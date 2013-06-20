<?php

namespace Debb\ManagementBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Mainboard
 *
 * @ORM\Table(name="mainboard")
 * @ORM\Entity()
 */
class Mainboard extends Base
{

	/**
	 * @var string
	 *
	 * @ORM\Column(name="description", type="string", length=255, nullable=true)
	 */
	private $description;

	/**
	 * @var integer
	 *
	 * @ORM\Column(name="socket", type="string", length=255)
	 */
	private $socket;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="connections", type="text", nullable=true)
	 */
	private $connections;

	/**
	 * Set description
	 *
	 * @param string $description
	 * @return Mainboard
	 */
	public function setDescription($description)
	{
		$this->description = $description;

		return $this;
	}

	/**
	 * Get description
	 *
	 * @return string 
	 */
	public function getDescription()
	{
		return $this->description;
	}

	/**
	 * Set socket
	 *
	 * @param integer $socket
	 * @return Mainboard
	 */
	public function setSocket($socket)
	{
		$this->socket = $socket;

		return $this;
	}

	/**
	 * Get socket
	 *
	 * @return integer 
	 */
	public function getSocket()
	{
		return $this->socket;
	}

	/**
	 * Set connections
	 *
	 * @param string $connections
	 * @return Mainboard
	 */
	public function setConnections($connections)
	{
		$this->connections = $connections;

		return $this;
	}

	/**
	 * Get connections
	 *
	 * @return string 
	 */
	public function getConnections()
	{
		return $this->connections;
	}

	/**
	 * Returns a array for later converting
	 * 
	 * @return array the array for later converting
	 */
	public function getXmlArray()
	{
		$array = parent::getDebbXmlArray();
		if ($this->getDescription() != null)
		{
			$array['Description'] = $this->getDescription();
		}
		if ($this->getSocket() != null)
		{
			$array['Socket'] = $this->getSocket();
		}
		if ($this->getConnections() != null)
		{
			$array['Connections'] = $this->getConnections();
		}
		return $array;
	}

}
