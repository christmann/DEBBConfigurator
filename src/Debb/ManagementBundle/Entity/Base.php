<?php

namespace Debb\ManagementBundle\Entity;

use CoolEmAll\UserBundle\Entity\User;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Base entity for manufacturer, product
 *
 * Description from DEBBComponents.xsd
 * DEBBPhysicalElementType is the basic type for all physical existing parts.
 * Examples for DEBBPhysical ElementTypes but not DEBBComplexTypes (memory module, shelves, ...) which might also have a power consumption (normally static).
 * These modules are directly derived from DEBBPhysicalElementType since no additional definition is needed.
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
	 * @ORM\Column(name="componentid", type="string", length=255, nullable=true)
	 */
	private $componentId;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="label", type="string", length=255, nullable=true)
	 */
	private $label;

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
	 * @ORM\Column(name="hostname", type="string", length=255, nullable=true)
	 */
	private $hostname;

	/**
	 * @var User
	 *
	 * @ORM\ManyToOne(targetEntity="CoolEmAll\UserBundle\Entity\User")
	 */
	private $user;

	/**
	 * The type element might be used to specify a type for the module, i.e. for memory DDR/DDR2, for CPU architecture name etc..
	 * It has only informational character.
	 *
	 * @var string
	 *
	 * @ORM\Column(name="type", type="string", length=255, nullable=true)
	 */
	private $type;

	/**
	 * MaxPowerUsage is the theoretical limit of power consumption and may used for designing.
	 *
	 * @var float
	 *
	 * @ORM\Column(name="max_power", type="float", nullable=true)
	 */
	private $maxPower;

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
	 * Returns the name of the product
	 * 
	 * @return string the name of the product
	 */
	public function __toString()
	{
		return $this->getFullName();
	}

	/**
	 * Returns the name
	 * 
	 * @return string the name
	 */
	public function getFullName()
	{
		$res = array();
		if($this->getManufacturer() !== null)
		{
			$res[] = $this->getManufacturer();
		}
		if($this->getProduct() !== null)
		{
			$res[] = $this->getProduct();
		}
		if(in_array(get_class($this), array('Debb\ManagementBundle\Entity\Memory', 'Debb\ManagementBundle\Entity\Storage')))
		{
			if($this->getCapacity() !== null)
			{
				$res[] = '(' . $this->getCapacity() . ' MB)';
			}
		}
		return implode(' ', $res);
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
		if($this->componentId == null || strlen($this->componentId) < 2)
		{
			$name = preg_replace('#[^\d\w]#', '', $this->getFullName());
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
		$array = array();
		if ($this->getComponentId() != null)
		{
			$array['ComponentId'] = $this->getComponentId();
		}
		if ($this->getLabel() != null)
		{
			$array['Label'] = $this->getLabel();
		}
		if ($this->getManufacturer() != null)
		{
			$array['Manufacturer'] = $this->getManufacturer();
		}
		if ($this->getProduct() != null)
		{
			$array['Product'] = $this->getProduct();
		}
		if ($this->getMaxPower() != null)
		{
			$array['MaxPower'] = $this->getMaxPower();
		}
		/**
		 * <xsd:choice>
		 *      <xsd:element name="PowerUsage" type="xsd:double" minOccurs="0" maxOccurs="1"></xsd:element>
		 *   OR
		 *      <xsd:element name="PowerUsageState" type="xsd_1:FlowStateType" minOccurs="0" maxOccurs="1"></xsd:element>
		 *   OR
		 *      <xsd:element name="PowerUsageProfile" type="xsd_1:FlowProfileType" minOccurs="0" maxOccurs="1"></xsd:element>
		 * </xsd:choice>
		 */
		if ($this->getType() != null)
		{
			$array['Type'] = $this->getMaxPower();
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
			else if(!is_object($value))
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
     * @Assert\True(message = "You have to fill in one of these fields: Manufacturer or Product")
     */
    public function isThisCorrect()
    {
        return !empty($this->manufacturer) || !empty($this->product);
    }

    /**
     * Duplicate this entity
     */
    public function __clone()
    {
        $this->id = null;
        return $this;
    }


    /**
     * Set label
     *
     * @param string $label
     * @return Base
     */
    public function setLabel($label)
    {
        $this->label = $label;
    
        return $this;
    }

    /**
     * Get label
     *
     * @return string 
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * Set user
     *
     * @param \CoolEmAll\UserBundle\Entity\User $user
     * @return Base
     */
    public function setUser($user = null)
    {
	    if(!($user instanceof \CoolEmAll\UserBundle\Entity\User))
	    {
		    $user = null;
	    }
        $this->user = $user;
    
        return $this;
    }

    /**
     * Get user
     *
     * @return \CoolEmAll\UserBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set type
     *
     * @param string $type
     * @return Base
     */
    public function setType($type)
    {
        $this->type = $type;
    
        return $this;
    }

    /**
     * Get type
     *
     * @return string 
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set maxPower
     *
     * @param float $maxPower
     * @return Base
     */
    public function setMaxPower($maxPower)
    {
        $this->maxPower = $maxPower;
    
        return $this;
    }

    /**
     * Get maxPower
     *
     * @return float 
     */
    public function getMaxPower()
    {
        return $this->maxPower;
    }
}