<?php

namespace Debb\ManagementBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Box
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Box extends \Debb\ConfigBundle\Entity\Dimensions
{

	/**
	 * @var Image
	 *
	 * @ORM\ManyToOne(targetEntity="Debb\ManagementBundle\Entity\File", cascade={"all"})
	 */
	private $image;

	/**
	 * @var integer
	 *
	 * @ORM\Column(name="slots", type="integer")
	 */
	private $slots;

	/**
	 * Set slots
	 *
	 * @param integer $slots
	 * @return Box
	 */
	public function setSlots($slots)
	{
		$this->slots = $slots;

		return $this;
	}

	/**
	 * Get slots
	 *
	 * @return integer 
	 */
	public function getSlots()
	{
		return $this->slots;
	}

	/**
	 * Set image
	 *
	 * @param \Debb\ManagementBundle\Entity\File $image
	 * @return Box
	 */
	public function setImage(\Debb\ManagementBundle\Entity\File $image = null)
	{
		$this->image = $image;

		return $this;
	}

	/**
	 * Get image
	 *
	 * @return \Debb\ManagementBundle\Entity\File 
	 */
	public function getImage()
	{
		return $this->image;
	}

	/**
	 * Returns a array for later converting
	 * 
	 * @return array the array for later converting
	 */
	public function getDebbXmlArray()
	{
		$array = parent::getDebbXmlArray();
		if ($this->getSlots() != null)
		{
			$array['Slots'] = $this->getSlots();
		}
		return $array;
	}

}