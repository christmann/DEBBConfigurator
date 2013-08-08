<?php

namespace Debb\ManagementBundle\Entity;

use Debb\ConfigBundle\Entity\Dimensions;
use Debb\ConfigBundle\Entity\NodeGroup;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Chassis
 *
 * @ORM\Table(name="chassis")
 * @ORM\Entity(repositoryClass="Debb\ManagementBundle\Repository\BaseRepository")
 */
class Chassis extends Dimensions
{
    /**
     * @var Image
     *
     * @ORM\ManyToOne(targetEntity="Debb\ManagementBundle\Entity\File", cascade={"persist"})
     */
    private $image;

    /**
     * @var integer
     *
     * @ORM\Column(name="he_size", type="integer")
     */
    private $heSize;

    /**
     * Field specification - typ
     *
     * @var \Debb\ManagementBundle\Entity\ChassisTypSpecification[]
     *
     * @ORM\OneToMany(targetEntity="Debb\ManagementBundle\Entity\ChassisTypSpecification", cascade={"persist"}, mappedBy="chassis", orphanRemoval=true)
     */
    private $typspecification;

    /**
     * @var boolean
     *
     * @ORM\Column(name="frontview", type="boolean", nullable=true)
     */
    private $frontview;

    /**
     * Node Groups
     *
     * @ORM\OneToMany(targetEntity="Debb\ConfigBundle\Entity\NodeGroup", mappedBy="draft")
     *
     * @var ArrayCollection|NodeGroup[]
     */
    private $nodeGroups;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->nodeGroups = new ArrayCollection();
    }

    /**
     * Set image
     *
     * @param string $image
     *
     * @return Chassis
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set heSize
     *
     * @param integer $heSize
     *
     * @return Chassis
     */
    public function setHeSize($heSize)
    {
        $this->heSize = $heSize;

        return $this;
    }

    /**
     * Get heSize
     *
     * @return integer
     */
    public function getHeSize()
    {
        return $this->heSize;
    }

    /**
     * Set frontview
     *
     * @param boolean $frontview
     *
     * @return Chassis
     */
    public function setFrontview($frontview)
    {
        $this->frontview = $frontview;

        return $this;
    }

    /**
     * Is frontview?
     *
     * @return boolean
     */
    public function isFrontView()
    {
        return $this->frontview != null && $this->frontview == 1;
    }

    /**
     * Get frontview
     *
     * @return boolean
     */
    public function getFrontview()
    {
        return $this->frontview;
    }

    /**
     * Add nodeGroups
     *
     * @param NodeGroup $nodeGroups
     *
     * @return Chassis
     */
    public function addNodeGroup(NodeGroup $nodeGroups)
    {
        $this->nodeGroups[] = $nodeGroups;

        return $this;
    }

    /**
     * Remove nodeGroups
     *
     * @param NodeGroup $nodeGroups
     */
    public function removeNodeGroup(NodeGroup $nodeGroups)
    {
        $this->nodeGroups->removeElement($nodeGroups);
    }

    /**
     * Get nodeGroups
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getNodeGroups()
    {
        return $this->nodeGroups;
    }

    /**
     * Add typspecification
     *
     * @param \Debb\ManagementBundle\Entity\ChassisTypSpecification $typspecification
     * @return Chassis
     */
    public function addTypspecification(\Debb\ManagementBundle\Entity\ChassisTypSpecification $typspecification)
    {
	    $typspecification->setChassis($this);
        $this->typspecification[] = $typspecification;
    
        return $this;
    }

    /**
     * Set typspecification
     *
     * @param \Debb\ManagementBundle\Entity\ChassisTypSpecification[] $typspecification
     * @return Chassis
     */
    public function setTypspecification($typspecification)
    {
	    $this->typspecification = $typspecification;

	    foreach ($this->typspecification as $typspecification)
	    {
		    $typspecification->setChassis($this);
	    }

        return $this;
    }

    /**
     * Remove typspecification
     *
     * @param \Debb\ManagementBundle\Entity\ChassisTypSpecification $typspecification
     */
    public function removeTypspecification(\Debb\ManagementBundle\Entity\ChassisTypSpecification $typspecification)
    {
        $this->typspecification->removeElement($typspecification);
    }

    /**
     * Get typspecification
     *
     * @return \Debb\ManagementBundle\Entity\ChassisTypSpecification[]
     */
    public function getTypspecification($asArray = false)
    {
	    if($asArray)
	    {
		    $array = array();
		    foreach($this->getTypspecification(false) as $typSpec)
		    {
			    $array[] = $typSpec->asArray();
		    }
		    return $array;
	    }
        return $this->typspecification;
    }

	/**
	 * @inheritdoc
	 */
	public function getSizeX()
	{
		if(parent::getSizeX() < 10)
		{
			return 900;
		}
		return parent::getSizeX();
	}

	/**
	 * @inheritdoc
	 */
	public function getSizeY()
	{
		if(parent::getSizeY() < 10)
		{
			return 600;
		}
		return parent::getSizeY();
	}
}