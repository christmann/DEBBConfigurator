<?php
/**
 * DEBBConfigurator - A configurator for DEBB component and PLMXML files
 * Copyright (C) 2013-2014 christmann informationstechnik + medien GmbH & Co. KG
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Library General Public
 * License as published by the Free Software Foundation; either
 * version 2 of the License, or (at your option) any later version.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
 * Library General Public License for more details.
 *
 * You should have received a copy of the GNU Library General Public
 * License along with this library; if not, write to the
 * Free Software Foundation, Inc., 51 Franklin St, Fifth Floor,
 * Boston, MA  02110-1301, USA.
 */

namespace Debb\ManagementBundle\Entity;

use CoolEmAll\UserBundle\Entity\User;
use Debb\ManagementBundle\DataTransformer\DecimalTransformer;
use Doctrine\Common\Collections\ArrayCollection;
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
 * @author Patrick Bußmann <patrick.bussmann@christmann.info>
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
	 * @ORM\Column(name="part_id", type="string", length=255, nullable=true)
	 */
	private $partId;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="componentid", type="string", length=255, nullable=true)
	 */
	private $componentId;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="schema_version", type="string", length=255, nullable=true)
	 */
	private $schemaVersion;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="xml_name", type="string", length=255, nullable=true)
	 */
	private $xmlName;

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
	 * @var string
	 *
	 * @ORM\Column(name="instance_name", type="string", length=255, nullable=true)
	 */
	private $instanceName;

	/**
	 * @var \Debb\ManagementBundle\Entity\FlowProfile
	 *
	 * @ORM\ManyToOne(targetEntity="Debb\ManagementBundle\Entity\FlowProfile")
	 */
	private $powerUsageProfile;

	/**
	 * @var float
	 *
	 * @ORM\Column(name="min_allowed_temperature", type="decimal", precision=18, scale=9, nullable=true)
	 */
	private $minAllowedTemperature;

	/**
	 * @var float
	 *
	 * @ORM\Column(name="max_allowed_temperature", type="decimal", precision=18, scale=9, nullable=true)
	 */
	private $maxAllowedTemperature;

	/**
	 * @var bool true if we can ignore our "isThisCorrect" function or false if not
	 */
	protected $isCorrect = false;

	/**
	 * The costs in euro
	 *
	 * @var float
	 *
	 * @ORM\Column(name="costs_eur", type="decimal", precision=18, scale=9, nullable=true)
	 */
	private $costsEur;

	/**
	 * The costs in CO² (environment)
	 *
	 * @var float
	 *
	 * @ORM\Column(name="costs_env", type="decimal", precision=18, scale=9, nullable=true)
	 */
	private $costsEnv;

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
	 * @return Base
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
	 * Sets the part id
	 *
	 * @param string $partId
	 */
	public function setPartId($partId)
	{
		$this->partId = $partId;
	}

	/**
	 * Get the part id - if to short use the unique id
	 * 
	 * @return string the part id
	 */
	public function getPartId()
	{
		if($this->partId == null || strlen($this->partId) < 2)
		{
			$name = preg_replace('#[^\d\w]#', '', $this->getFullName());
			while(strlen($name) < 5)
			{
				$name .= substr(sha1($this->getId()), strlen($name), 5 - strlen($name));
				$name = preg_replace('#[^\d\w]#', '', $name);
			}
			if($name == 'da39a')
			{
				return null;
			}
			$this->setPartId($name . '_' . $this->getId());
		}
		return $this->partId;
	}

	/**
	 * Returns a array for later converting
	 * 
	 * @return array the array for later converting
	 */
	public function getDebbXmlArray()
	{
		$array = array();
		if ($this->getPartId() !== null)
		{
			$array['PartID'] = $this->getPartId();
		}
		if ($this->getLabel() !== null)
		{
			$array['Label'] = $this->getLabel();
		}
		if ($this->getManufacturer() !== null)
		{
			$array['Manufacturer'] = $this->getManufacturer();
		}
		if ($this->getProduct() !== null)
		{
			$array['Product'] = $this->getProduct();
		}
		if ($this->getMaxPower() !== null)
		{
			$array['MaxPower'] = $this->getMaxPower();
		}
		if ($this->getPowerUsageProfile() !== null)
		{
			$array['PowerUsageProfile'] = $this->getPowerUsageProfile()->getDebbXmlArray();
		}
		if ($this->getMinAllowedTemperature() !== null)
		{
			$array['MinAllowedTemperature'] = $this->getMinAllowedTemperature();
		}
		if ($this->getMaxAllowedTemperature() !== null)
		{
			$array['MaxAllowedTemperature'] = $this->getMaxAllowedTemperature();
		}
		if ($this->getType() !== null)
		{
			$array['Type'] = $this->getType();
		}
		/**
		 * Try zone for methods which not implemented in this base class
		 */
		try{
			if(method_exists($this, 'getTransform'))
			{
				if ($this->getTransform() !== null)
				{
					$array['Transform'] = $this->getTransform();
				}
			}
		}catch(\Exception $ex){}try{
			if(method_exists($this, 'getReference'))
			{
				if ($this->getReference() !== null)
				{
					$array['Reference'] = $this->getReference() instanceof Reference ? $this->getReference()->getDebbXmlArray() : array('Type' => $this->getReference()->getFileEnding(), 'Location' => './object/' . $this->getReference()->getId() . '_' . $this->getReference()->getName());
				}
			}
		}catch(\Exception $ex){}try{
			if(method_exists($this, 'getReferences'))
			{
				if ($this->getReferences() !== null)
				{
					foreach($this->getReferences() as $reference)
					{
						if($reference instanceof Reference || $reference instanceof File)
						{
							$array[] = array(array('Reference' => array('Type' => $reference->getFileEnding(), 'Location' => './object/' . $reference->getId() . '_' . $reference->getName())));
						}
					}
				}
			}
		}catch(\Exception $ex){}
		/**
		 * End of try zone
		 */
		if($this->getInstanceName() !== null)
		{
			$array['InstanceName'] = $this->getInstanceName();
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
     * @Assert\True(message = "You have to fill in one of these fields: Manufacturer or product")
     */
    public function isThisCorrect()
    {
        return $this->isCorrect || !empty($this->manufacturer) || !empty($this->product);
    }

    /**
     * Duplicate this entity
     */
    public function __clone()
    {
		if ($this->getId() > 0)
		{
        	$this->id = null;

			$this->setProduct(preg_match_all('# - ([0-9]+)$#', $this->getProduct(), $matches) > 0 ? preg_replace('# - ([0-9]+)$#', ' - ' . ++$matches[1][0], $this->getProduct()) : ($this->getProduct() . ' - ' . 2));
		}
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

    /**
     * Set powerUsageProfile
     *
     * @param \Debb\ManagementBundle\Entity\FlowProfile $powerUsageProfile
     * @return Base
     */
    public function setPowerUsageProfile(\Debb\ManagementBundle\Entity\FlowProfile $powerUsageProfile = null)
    {
        $this->powerUsageProfile = $powerUsageProfile;
    
        return $this;
    }

    /**
     * Get powerUsageProfile
     *
     * @return \Debb\ManagementBundle\Entity\FlowProfile 
     */
    public function getPowerUsageProfile()
    {
        return $this->powerUsageProfile;
    }

    /**
     * Set xmlName
     *
     * @param string $xmlName
     * @return Base
     */
    public function setXmlName($xmlName)
    {
        $this->xmlName = $xmlName;
    
        return $this;
    }

    /**
     * Get xmlName
     *
     * @return string 
     */
    public function getXmlName()
    {
        return $this->xmlName;
    }

    /**
     * Set schemaVersion
     *
     * @param string $schemaVersion
     * @return Base
     */
    public function setSchemaVersion($schemaVersion)
    {
        $this->schemaVersion = $schemaVersion;
    
        return $this;
    }

    /**
     * Get schemaVersion
     *
     * @return string 
     */
    public function getSchemaVersion()
    {
        return $this->schemaVersion;
    }

    /**
     * Set componentId
     *
     * @param string $componentId
     * @return Base
     */
    public function setComponentId($componentId)
    {
        $this->componentId = $componentId;
    
        return $this;
    }

    /**
     * Get componentId
     *
     * @return string 
     */
    public function getComponentId()
    {
        return $this->componentId;
    }

    /**
     * Set instanceName
     *
     * @param string $instanceName
     * @return Base
     */
    public function setInstanceName($instanceName)
    {
        $this->instanceName = $instanceName;
    
        return $this;
    }

    /**
     * Get instanceName
     *
     * @return string 
     */
    public function getInstanceName()
    {
        return $this->instanceName;
    }

    /**
     * Set costsEur
     *
     * @param float $costsEur
     * @return Base
     */
    public function setCostsEur($costsEur)
    {
        $this->costsEur = $costsEur;
    
        return $this;
    }

    /**
     * Get costsEur
     *
     * @return float 
     */
    public function getCostsEur()
    {
        return DecimalTransformer::convert((float) $this->costsEur);
    }

    /**
     * Set costsEnv
     *
     * @param float $costsEnv
     * @return Base
     */
    public function setCostsEnv($costsEnv)
    {
        $this->costsEnv = $costsEnv;
    
        return $this;
    }

    /**
     * Get costsEnv
     *
     * @return float 
     */
    public function getCostsEnv()
    {
        return DecimalTransformer::convert((float) $this->costsEnv);
    }

	/**
	 * @return float
	 */
	public function getRealCostsEur($inclSelf = true)
	{
		$costs = 0;

		// Count self
		if($inclSelf)
		{
			$costs += $this->getCostsEur();
		}

		return $costs;
	}

	/**
	 * @return float
	 */
	public function getRealCostsEnv($inclSelf = true)
	{
		$costs = 0;

		// Count self
		if($inclSelf)
		{
			$costs += $this->getCostsEnv();
		}

		return $costs;
	}

	/**
	 * Get the costs array for xml
	 *
	 * @return array
	 */
	public function getCostsXml()
	{
		return array(
			'PartID' => $this->getPartId(),
			'costs_euro' => $this->getCostsEur(),
			'costs_co2_emission' => $this->getCostsEnv()
		);
	}

    /**
     * Set minAllowedTemperature
     *
     * @param float $minAllowedTemperature
     * @return Base
     */
    public function setMinAllowedTemperature($minAllowedTemperature)
    {
        $this->minAllowedTemperature = $minAllowedTemperature;
    
        return $this;
    }

    /**
     * Get minAllowedTemperature
     *
     * @return float 
     */
    public function getMinAllowedTemperature()
    {
        return DecimalTransformer::convert($this->minAllowedTemperature);
    }

    /**
     * Set maxAllowedTemperature
     *
     * @param float $maxAllowedTemperature
     * @return Base
     */
    public function setMaxAllowedTemperature($maxAllowedTemperature)
    {
        $this->maxAllowedTemperature = $maxAllowedTemperature;
    
        return $this;
    }

    /**
     * Get maxAllowedTemperature
     *
     * @return float 
     */
    public function getMaxAllowedTemperature()
    {
        return DecimalTransformer::convert($this->maxAllowedTemperature);
    }
}
