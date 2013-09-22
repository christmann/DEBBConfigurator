<?php

namespace Debb\ManagementBundle\Entity;

use Debb\ConfigBundle\Entity\Dimensions;
use Doctrine\ORM\Mapping as ORM;

/**
 * DEBBSimple
 *
 * SimpleType describes all distinct devices for CAD, so where Transform and id/name are necessary.
 * On the other side the memory or CPU are nor relevant for that.
 *
 * @ORM\Table(name="debb_simple")
 * @ORM\Entity(repositoryClass="Debb\ManagementBundle\Repository\BaseRepository")
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="typ", type="string")
 */
class DEBBSimple extends Dimensions
{
    /**
     * The Transform tag is necessary for all part which are located within a Component i.e. fans within a RECS or sensors or for the "root object of a DEBB it is not used.
     * For all parts at a fixed position within the DEBB (fans, sensors, etc.) this is the transform matrix relative to the DEBB origin.
     * For DEBBComponents this is the relative position of the connector to the DEBB's origin.
     * By "adding" the relative transforms the resulting transform can be directly used for PLMXML.
     *
     * @var string
     *
     * @ORM\Column(name="transform", type="string", length=255, nullable=true)
     */
    private $transform;

    /**
     * @var \Debb\ManagementBundle\Entity\File[]
     *
     * @ORM\ManyToMany(targetEntity="Debb\ManagementBundle\Entity\File", cascade={"all"}, orphanRemoval=true)
     */
    private $references;

	/**
	 * Returns a array for later converting
	 *
	 * @return array the array for later converting
	 */
	public function getDebbXmlArray()
	{
		$array = parent::getDebbXmlArray();
		if ($this->getTransform() !== null)
		{
			$array['Transform'] = $this->getTransform();
		}
		foreach($this->getReferences() as $reference)
		{
			$array[] = array(array('Reference' => array('Type' => $reference->getFileEnding(), 'Location' => './object/' . $reference->getId() . '_' . $reference->getName())));
		}
		return $array;
	}
    
    /**
     * Set transform
     *
     * @param string $transform
     * @return DEBBSimple
     */
    public function setTransform($transform)
    {
        $this->transform = $transform;
    
        return $this;
    }

    /**
     * Get transform
     *
     * @return string 
     */
    public function getTransform()
    {
        return $this->transform;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->references = new \Doctrine\Common\Collections\ArrayCollection();
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
}