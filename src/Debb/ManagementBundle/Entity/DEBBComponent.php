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
