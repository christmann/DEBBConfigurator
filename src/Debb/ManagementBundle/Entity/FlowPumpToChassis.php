<?php

namespace Debb\ManagementBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * FlowPumpToChassis
 *
 * @ORM\Table(name="flowpumptochassis")
 * @ORM\Entity
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