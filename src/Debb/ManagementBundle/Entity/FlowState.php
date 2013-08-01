<?php

namespace Debb\ManagementBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * FlowState
 *
 * FlowStateType describes any kind of flow (air, liquid, power, ...) and assumes that for maintaining the flow a certain power usage is necessary.
 * For power supply units only the power which is used for creating/transforming the power flow is counted as PowerUsage,
 * but not the power provided. So adding all PowerUsages will show the overall consumption.
 *
 * @ORM\Table(name="flow_state")
 * @ORM\Entity
 */
class FlowState
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
     * @ORM\Column(name="state", type="string", length=255)
     */
    private $state;

    /**
     * @var float
     *
     * @ORM\Column(name="flow", type="decimal")
     */
    private $flow;

    /**
     * @var float
     *
     * @ORM\Column(name="powerUsage", type="decimal")
     */
    private $powerUsage;

	/**
	 * @var \Debb\ManagementBundle\Entity\FlowProfile
	 *
	 * @ORM\ManyToOne(targetEntity="Debb\ManagementBundle\Entity\FlowProfile", inversedBy="flowStates")
	 */
	private $flowProfile;

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
     * Set state
     *
     * @param string $state
     * @return FlowState
     */
    public function setState($state)
    {
        $this->state = $state;
    
        return $this;
    }

    /**
     * Get state
     *
     * @return string 
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * Set flow
     *
     * @param float $flow
     * @return FlowState
     */
    public function setFlow($flow)
    {
        $this->flow = $flow;
    
        return $this;
    }

    /**
     * Get flow
     *
     * @return float 
     */
    public function getFlow()
    {
        return $this->flow;
    }

    /**
     * Set powerUsage
     *
     * @param float $powerUsage
     * @return FlowState
     */
    public function setPowerUsage($powerUsage)
    {
        $this->powerUsage = $powerUsage;
    
        return $this;
    }

    /**
     * Get powerUsage
     *
     * @return float 
     */
    public function getPowerUsage()
    {
        return $this->powerUsage;
    }

    /**
     * Set flowProfile
     *
     * @param \Debb\ManagementBundle\Entity\FlowProfile $flowProfile
     * @return FlowState
     */
    public function setFlowProfile(\Debb\ManagementBundle\Entity\FlowProfile $flowProfile = null)
    {
        $this->flowProfile = $flowProfile;
    
        return $this;
    }

    /**
     * Get flowProfile
     *
     * @return \Debb\ManagementBundle\Entity\FlowProfile 
     */
    public function getFlowProfile()
    {
        return $this->flowProfile;
    }
}