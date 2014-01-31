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

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * FlowPumpToChassis
 *
 * @ORM\Table(name="flowpumptochassis")
 * @ORM\Entity()
 * @author Patrick Bußmann <patrick.bussmann@christmann.info>
 */
class FlowPumpToChassis extends ConnectorExtended
{

	/**
	 * @var FlowPump
	 *
	 * @ORM\ManyToOne(targetEntity="Debb\ManagementBundle\Entity\FlowPump", inversedBy="flowPumpToChassis")
	 * @ORM\JoinColumn(name="flowpump_id", referencedColumnName="id", onDelete="cascade")
	 */
	private $flowPump;

	/**
	 * @var Room
	 *
	 * @ORM\ManyToOne(targetEntity="Debb\ManagementBundle\Entity\Chassis", inversedBy="flowPumps")
	 * @ORM\JoinColumn(name="chassis_id", referencedColumnName="id", onDelete="cascade")
	 */
	private $chassis;

	/**
	 * Set flowPump
	 *
	 * @param \Debb\ManagementBundle\Entity\FlowPump $flowPump
	 * @return FlowPumpToChassis
	 */
	public function setFlowPump(FlowPump $flowPump = null)
	{
		$this->flowPump = $flowPump;

		return $this;
	}

	/**
	 * Get flowPump
	 *
	 * @return \Debb\ManagementBundle\Entity\FlowPump
	 */
	public function getFlowPump()
	{
		return $this->flowPump;
	}

	/**
	 * Set chassis
	 *
	 * @param \Debb\ManagementBundle\Entity\Chassis $chassis
	 * @return FlowPumpToChassis
	 */
	public function setChassis(Chassis $chassis = null)
	{
		$this->chassis = $chassis;

		return $this;
	}

	/**
	 * Get room
	 *
	 * @return \Debb\ManagementBundle\Entity\Chassis
	 */
	public function getChassis()
	{
		return $this->chassis;
	}

	function __toString()
	{
		return (string) $this->getChassis();
	}

	/**
	 * @return Chassis
	 */
	public function getHigherElement()
	{
		return $this->getChassis();
	}
}