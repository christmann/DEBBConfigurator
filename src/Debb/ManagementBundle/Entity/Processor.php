<?php

namespace Debb\ManagementBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Processor
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Debb\ManagementBundle\Entity\ProcessorRepository")
 */
class Processor extends Base
{
    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var integer
     *
     * @ORM\Column(name="cores", type="integer")
     */
    private $cores;

    /**
     * @var integer
     *
     * @ORM\Column(name="max_frequency", type="integer")
     */
    private $maxFrequency;


    /**
     * Set title
     *
     * @param string $title
     * @return Processor
     */
    public function setTitle($title)
    {
        $this->title = $title;
    
        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
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
     * Set maxFrequency
     *
     * @param integer $maxFrequency
     * @return Processor
     */
    public function setMaxFrequency($maxFrequency)
    {
        $this->maxFrequency = $maxFrequency;
    
        return $this;
    }

    /**
     * Get maxFrequency
     *
     * @return integer 
     */
    public function getMaxFrequency()
    {
        return $this->maxFrequency;
    }
}