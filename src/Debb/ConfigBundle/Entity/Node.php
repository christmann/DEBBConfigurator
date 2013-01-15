<?php

namespace Debb\ConfigBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Node
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Node
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
	 * @var string
	 *
	 * @ORM\Column(name="product", type="string", length=255)
	 */
	private $product;

	/**
	 * @var integer
	 *
	 * @ORM\ManyToOne(targetEntity="Debb\ManagementBundle\Entity\Mainboard", cascade={"all"})
	 */
	private $mainboard;

	/**
	 * @var array
	 *
	 * @ORM\Column(name="components", type="array")
	 */
	private $components;

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
	 * @return Node
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
	 * @return Node
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
	 * Set product
	 *
	 * @param string $product
	 * @return Node
	 */
	public function setProduct($product)
	{
		$this->product = $product;

		return $this;
	}

	/**
	 * Get product
	 *
	 * @return string 
	 */
	public function getProduct()
	{
		return $this->product;
	}

	/**
	 * Set mainboard
	 *
	 * @param Debb\ManagementBundle\Entity\Mainboard $mainboard
	 * @return Node
	 */
	public function setMainboard(\Debb\ManagementBundle\Entity\Mainboard $mainboard)
	{
		$this->mainboard = $mainboard;

		return $this;
	}

	/**
	 * Get mainboard
	 *
	 * @return Debb\ManagementBundle\Entity\Mainboard 
	 */
	public function getMainboard()
	{
		return $this->mainboard;
	}

	/**
	 * Set components
	 *
	 * @param array $components
	 * @return Node
	 */
	public function setComponents($components)
	{
		$this->components = $components;

		return $this;
	}

	/**
	 * Get components
	 *
	 * @return array 
	 */
	public function getComponents()
	{
		return $this->components;
	}

	public function __toString()
	{
		return '[' . $this->getId() . '] ' . $this->getProduct();
	}

}
