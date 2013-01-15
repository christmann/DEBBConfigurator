<?php

namespace Debb\ManagementBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Mainboard
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Debb\ManagementBundle\Entity\MainboardRepository")
 */
class Mainboard extends Base
{

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;

    /**
     * @var integer
     *
     * @ORM\Column(name="socket", type="integer")
     */
    private $socket;

    /**
     * @var string
     *
     * @ORM\Column(name="connections", type="text")
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
}
