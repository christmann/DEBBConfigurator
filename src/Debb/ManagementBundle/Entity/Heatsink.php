<?php

namespace Debb\ManagementBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Heatsink
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Debb\ManagementBundle\Repository\BaseRepository")
 */
class Heatsink extends Base
{
	/**
	 * @var VRML
	 *
	 * @ORM\ManyToOne(targetEntity="Debb\ManagementBundle\Entity\File", cascade={"all"})
	 */
	private $vrmlFile;

	/**
	 * @var STL
	 *
	 * @ORM\ManyToOne(targetEntity="Debb\ManagementBundle\Entity\File", cascade={"all"})
	 */
	private $stlFile;

	/**
	 * @var float
	 *
	 * @ORM\Column(name="transfer_rate", type="float", nullable=true)
	 */
	private $transferRate;

    /**
     * Set vrmlFile
     *
     * @param \Debb\ManagementBundle\Entity\File $vrmlFile
     * @return Heatsink
     */
    public function setVrmlFile(\Debb\ManagementBundle\Entity\File $vrmlFile = null)
    {
        $this->vrmlFile = $vrmlFile;
    
        return $this;
    }

    /**
     * Get vrmlFile
     *
     * @return \Debb\ManagementBundle\Entity\File 
     */
    public function getVrmlFile()
    {
        return $this->vrmlFile;
    }

    /**
     * Set stlFile
     *
     * @param \Debb\ManagementBundle\Entity\File $stlFile
     * @return Heatsink
     */
    public function setStlFile(\Debb\ManagementBundle\Entity\File $stlFile = null)
    {
        $this->stlFile = $stlFile;
    
        return $this;
    }

    /**
     * Get stlFile
     *
     * @return \Debb\ManagementBundle\Entity\File 
     */
    public function getStlFile()
    {
        return $this->stlFile;
    }

	/**
	 * Returns a array for later converting
	 *
	 * @return array the array for later converting
	 */
	public function getDebbXmlArray()
	{
		$array = parent::getDebbXmlArray();
		$array['Transform'] = '1 0 0 0 0 1 0 0 0 0 1 0 0 0 0 1'; // missing example ...
		if($this->getStlFile() != null)
		{
			$array[] = array(array('Reference' => array('Type' => 'STL', 'Location' => './object/' . $this->getStlFile()->getName())));
		}
		if($this->getVrmlFile() != null)
		{
			$array[] = array(array('Reference' => array('Type' => 'VRML', 'Location' => './object/' . $this->getVrmlFile()->getName())));
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
}