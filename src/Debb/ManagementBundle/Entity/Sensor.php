<?php

namespace Debb\ManagementBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Sensor
 *
 * @ORM\Table(name="sensor")
 * @ORM\Entity(repositoryClass="Debb\ManagementBundle\Repository\BaseRepository")
 */
class Sensor extends DEBBSimple
{
    /**
     * @var string
     *
     * @Assert\Choice(callback={"Debb\ManagementBundle\Form\SensorType", "getClasses"}, message="Choose a valid class.")
     * @ORM\Column(name="class", type="string", length=255)
     */
    private $class;

    /**
     * Only basic units should be used. For later development other units can be used then the Factor should be added.
     *
     * @var string
     *
     * @Assert\Choice(callback={"Debb\ManagementBundle\Form\SensorType", "getUnits"}, message="Choose a valid unit.")
     * @ORM\Column(name="unit", type="string", length=255)
     */
    private $unit;

    /**
     * @var float
     *
     * @ORM\Column(name="min_value", type="float", nullable=true)
     */
    private $minValue;

    /**
     * @var float
     *
     * @ORM\Column(name="max_value", type="float", nullable=true)
     */
    private $maxValue;

    /**
     * Factor is just the multiplier between the currently used unit and the basic unit (i.e. litre to cubic meter)
     *
     * @var float
     *
     * @ORM\Column(name="factor", type="float", nullable=true)
     */
    private $factor;

    /**
     * @var float
     *
     * @ORM\Column(name="accuracy", type="float", nullable=true)
     */
    private $accuracy;

    /**
     * Input is a flag describing that a sensors is a input value for the simulation or not.
     * For example heat sources can be seen an sources without any output afterwards.
     * Other sensors migth be added for extracting results at the end of the simulation.
     *
     * @var boolean
     *
     * @Assert\NotNull()
     * @ORM\Column(name="input", type="boolean")
     */
    private $input;

    /**
     * Set class
     *
     * @param string $class
     * @return Sensor
     */
    public function setClass($class)
    {
        $this->class = $class;
    
        return $this;
    }

    /**
     * Get class
     *
     * @return string 
     */
    public function getClass()
    {
        return $this->class;
    }

    /**
     * Set unit
     *
     * @param string $unit
     * @return Sensor
     */
    public function setUnit($unit)
    {
        $this->unit = $unit;
    
        return $this;
    }

    /**
     * Get unit
     *
     * @return string 
     */
    public function getUnit()
    {
        return $this->unit;
    }

    /**
     * Set minValue
     *
     * @param float $minValue
     * @return Sensor
     */
    public function setMinValue($minValue)
    {
        $this->minValue = $minValue;
    
        return $this;
    }

    /**
     * Get minValue
     *
     * @return float 
     */
    public function getMinValue()
    {
        return $this->minValue;
    }

    /**
     * Set maxValue
     *
     * @param float $maxValue
     * @return Sensor
     */
    public function setMaxValue($maxValue)
    {
        $this->maxValue = $maxValue;
    
        return $this;
    }

    /**
     * Get maxValue
     *
     * @return float 
     */
    public function getMaxValue()
    {
        return $this->maxValue;
    }

    /**
     * Set factor
     *
     * @param float $factor
     * @return Sensor
     */
    public function setFactor($factor)
    {
        $this->factor = $factor;
    
        return $this;
    }

    /**
     * Get factor
     *
     * @return float 
     */
    public function getFactor()
    {
        return $this->factor;
    }

    /**
     * Set accuracy
     *
     * @param float $accuracy
     * @return Sensor
     */
    public function setAccuracy($accuracy)
    {
        $this->accuracy = $accuracy;
    
        return $this;
    }

    /**
     * Get accuracy
     *
     * @return float 
     */
    public function getAccuracy()
    {
        return $this->accuracy;
    }

    /**
     * Set input
     *
     * @param boolean $input
     * @return Sensor
     */
    public function setInput($input)
    {
        $this->input = $input;
    
        return $this;
    }

    /**
     * Get input
     *
     * @return boolean 
     */
    public function getInput()
    {
        return $this->input;
    }
}
