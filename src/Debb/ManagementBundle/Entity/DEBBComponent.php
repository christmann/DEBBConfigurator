<?php
/**
 * Created by IntelliJ IDEA.
 * Project: DebbConfig
 * User: Patrick Bußmann <patrick.bussmann@christmann.info>
 * Date: 12.12.13
 * Time: 13:00
 */

namespace Debb\ManagementBundle\Entity;

use Debb\ConfigBundle\Entity\Dimensions;

/**
 * Class DEBBComponent
 * @package Debb\ManagementBundle\Entity
 * @author Patrick Bußmann <patrick.bussmann@christmann.info>
 */
abstract class DEBBComponent extends Dimensions
{
	/**
	 * {@inheritdoc}
	 */
	public function getDebbXmlArray()
	{
		$array = parent::getDebbXmlArray();
		if($this->getComponentId() !== null)
		{
			$array['ComponentId'] = $this->getComponentId();
		}
		if($this->getSchemaVersion() !== null)
		{
			$array['SchemaVersion'] = $this->getSchemaVersion();
		}
		/**
		 * Try zone for methods which not implemented in this base class
		 */
		try{
			if(method_exists($this, 'getInlets'))
			{
				if ($this->getInlets() !== null)
				{
					/** @var $inlet FlowPump */
					foreach($this->getInlets() as $inlet)
					{
						if($inlet instanceof FlowPump)
						{
							$array[] = $inlet->getDebbXmlArray();
						}
					}
				}
			}
		}catch(\Exception $ex){}try{
			if(method_exists($this, 'getOutlets'))
			{
				if ($this->getOutlets() !== null)
				{
					/** @var $outlet FlowPump */
					foreach($this->getOutlets() as $outlet)
					{
						if($outlet instanceof FlowPump)
						{
							$array[] = $outlet->getDebbXmlArray();
						}
					}
				}
			}
		}catch(\Exception $ex){}try{
			if(method_exists($this, 'getHeatsinks'))
			{
				if($this->getHeatsinks() !== null)
				{
					/** @var $heatsink Heatsink */
					foreach($this->getHeatsinks() as $heatsink)
					{
						$array[] = array($heatsink->getDebbXmlArray());
					}
				}
			}
		}catch(\Exception $ex){}try{
			if(method_exists($this, 'getNetworks'))
			{
				if($this->getNetworks() !== null)
				{
					/** @var $network Network */
					foreach($this->getNetworks() as $network)
					{
						$array[] = array('Network' => $network->getDebbXmlArray());
					}
				}
			}
		}catch(\Exception $ex){}
		/**
		 * End of try zone
		 */
		return $array;
	}
}
