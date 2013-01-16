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
	 * @ORM\OneToMany(targetEntity="Debb\ManagementBundle\Entity\Component", mappedBy="node")
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
	 * Returns the name of this node for the table view or selections
	 * 
	 * @return string the name of this node
	 */
	public function __toString()
	{
		return '[' . $this->getId() . '] ' . $this->getTitle();
	}

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->components = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add components
     *
     * @param \Debb\ManagementBundle\Entity\Component $components
     * @return Node
     */
    public function addComponent(\Debb\ManagementBundle\Entity\Component $component)
    {
		$component->setNode($this);
        $this->components[] = $component;
    
        return $this;
    }
    
    /**
     * Set components
     *
     * @param \Debb\ManagementBundle\Entity\Component[] $components
     * @return Node
     */
    public function setComponents($components)
    {
        $this->components[] = $components;

		foreach($this->components as $component)
		{
			$component->setNode($this);
		}
    
        return $this;
    }

    /**
     * Remove components
     *
     * @param \Debb\ManagementBundle\Entity\Component $components
     */
    public function removeComponent(\Debb\ManagementBundle\Entity\Component $components)
    {
        $this->components->removeElement($components);
    }

    /**
     * Get components
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getComponents()
    {
        return $this->components;
    }
}