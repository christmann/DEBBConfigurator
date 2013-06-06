<?php

namespace Debb\ManagementBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Base entity for manufacturer, product and model
 * 
 * @ORM\MappedSuperclass
 */
class Base
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
	 * @ORM\Column(name="manufacturer", type="string", length=255, nullable=true)
	 */
	private $manufacturer;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="product", type="string", length=255, nullable=true)
	 */
	private $product;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="model", type="string", length=255, nullable=true)
	 */
	private $model;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="hostname", type="string", length=255, nullable=true)
	 */
	private $hostname;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="componentid", type="string", length=255, nullable=true)
	 */
	private $componentId;

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
	 * Set manufacturer
	 *
	 * @param string $manufacturer
	 * @return Bas
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
	 * @return Bas
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
	 * Set model
	 *
	 * @param string $model
	 * @return Bas
	 */
	public function setModel($model)
	{
		$this->model = $model;

		return $this;
	}

	/**
	 * Get model
	 *
	 * @return string 
	 */
	public function getModel()
	{
		return $this->model;
	}

	/**
	 * Returns the name of the product
	 * 
	 * @return string the name of the product
	 */
	public function __toString()
	{
		return $this->getName();
	}

	/**
	 * Returns the name
	 * 
	 * @return string the name
	 */
	public function getName()
	{
		$res = array();
		if($this->getManufacturer() != null)
		{
			$res[] = $this->getManufacturer();
		}
		if($this->getProduct() != null)
		{
			$res[] = $this->getProduct();
		}
		if($this->getModel() != null)
		{
			$res[] = $this->getModel();
		}
		if(in_array(get_class($this), array('Debb\ManagementBundle\Entity\Memory', 'Debb\ManagementBundle\Entity\Storage')))
		{
			if($this->getCapacity() != null)
			{
				$res[] = '(' . $this->getCapacity() . ' MB)';
			}
		}
		return substr(implode(' ', $res), 0, 60);
	}

	/**
	 * Sets the component id
	 *
	 * @param string $componentId
	 */
	public function setComponentId($componentId)
	{
		$this->componentId = $componentId;
	}

	/**
	 * Get the component id - if to short use the unique id
	 * 
	 * @return string the component id
	 */
	public function getComponentId()
	{
		if($this->componentId == null)
		{
			$name = preg_replace('#[^\d\w]#', '', $this->getName());
			while(strlen($name) < 5)
			{
				$name .= substr(sha1($this->getId()), strlen($name), 5 - strlen($name));
				$name = preg_replace('#[^\d\w]#', '', $name);
			}
			$this->setComponentId($name . '_' . $this->getId());
		}
		return $this->componentId;
	}

	/**
	 * Returns a array for later converting
	 * 
	 * @return array the array for later converting
	 */
	public function getDebbXmlArray()
	{
		$array = array(
			'ComponentId' => $this->getComponentId()
		);
		if ($this->getManufacturer() != null)
		{
			$array['Manufacturer'] = $this->getManufacturer();
		}
		if ($this->getProduct() != null)
		{
			$array['Product'] = $this->getProduct();
		}
		return $array;
	}

	/**
	 * function definition to convert array to xml
	 * 
	 * @author http://stackoverflow.com/a/5965940/1979651
	 * @param array $array the array which you would convert to xml
	 * @param SimpleXMLElement $element the SimpleXMLElement for adding childs
	 */
	public static function array_to_xml(Array $array, \SimpleXMLElement &$element)
	{
		foreach ($array as $key => $value)
		{
			if (is_array($value))
			{
				if (!is_numeric($key))
				{
					$subnode = $element->addChild($key);
					self::array_to_xml($value, $subnode);
				}
				else
				{
					self::array_to_xml($value, $element);
				}
			}
			else
			{
				$element->addChild($key, htmlentities($value));
			}
		}
	}

	/**
	 * Set hostname
	 *
	 * @param string $hostname
	 * @return Base
	 */
	public function setHostname($hostname)
	{
		$this->hostname = $hostname;

		return $this;
	}

	/**
	 * Get hostname
	 *
	 * @return string 
	 */
	public function getHostname()
	{
		return $this->hostname;
	}

    /**
     * @Assert\True(message = "You have to fill in one of these fields: Manufacturer, Product or Model")
     */
    public function isThisCorrect()
    {
        return !empty($this->manufacturer) || !empty($this->product) || !empty($this->model);
    }

    /**
     * Duplicate this entity
     */
    public function __clone()
    {
        $this->id = null;
        return $this;
    }

}