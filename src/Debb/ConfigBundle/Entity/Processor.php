<?php

namespace Debb\ConfigBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Processor
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Debb\ConfigBundle\Entity\ProcessorRepository")
 */
class Processor
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="manufacturer", type="string", length=255)
     */
    private $manufacturer;

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
     * @var string
     *
     * @ORM\Column(name="picture", type="string", length=255)
     */
    private $picture;


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
     * Set manufacturer
     *
     * @param string $manufacturer
     * @return Processor
     */
    public function setManufacturer($manufacturer)
    {
        $this->manufacturer = $manufacturer;
    
        return $this;
    }

    /**
     * Get manufacturer
     *
     * @return string 
     */
    public function getManufacturer()
    {
        return $this->manufacturer;
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

    /**
     * Set picture
     *
     * @param string $picture
     * @return Processor
     */
    public function setPicture($picture)
    {
        $this->picture = $picture;
    
        return $this;
    }

    /**
     * Get picture
     *
     * @return string 
     */
    public function getPicture()
    {
        return $this->picture;
    }
}
