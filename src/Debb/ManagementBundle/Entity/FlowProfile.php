<?php

namespace Debb\ManagementBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * FlowProfile
 *
 * FlowProfile describes any sort of flow (air, liquid, energy, ...) including different discrete states and possible transitions since they all have the same characteristic attributes.
 * If there are now significant transition times/energy consumptions they are simple omitted.
 *
 * @ORM\Table(name="flow_profile")
 * @ORM\Entity(repositoryClass="Debb\ManagementBundle\Repository\BaseRepository")
 */
class FlowProfile
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
     * @Assert\NotNull()
     * @ORM\Column(name="name", type="string", length=255, nullable=true)
     */
    private $name;

	/**
	 * @var string
	 * @ORM\Column(name="type", type="string", length=255, nullable=true)
	 */
	private $type;

    /**
     * @var \Debb\ManagementBundle\Entity\FlowState[]
     *
     * @Assert\NotNull()
     * @Assert\Count(min="1", minMessage="You need one flow state!")
     * @ORM\OneToMany(targetEntity="Debb\ManagementBundle\Entity\FlowState", mappedBy="flowProfile", cascade={"all"}, orphanRemoval=true)
     */
    private $flowStates;

	/**
	 * @var User
	 *
	 * @ORM\ManyToOne(targetEntity="CoolEmAll\UserBundle\Entity\User")
	 */
	private $user;

	/**
	 * Returns a array for later converting
	 *
	 * @return array the array for later converting
	 */
	public function getDebbXmlArray()
	{
		$array = array();
		if ($this->getName() !== null)
		{
			$array['Name'] = $this->getName();
		}
		if ($this->getType() !== null)
		{
			$array['Type'] = $this->getType();
		}
		$x = 1;
		if(count($this->getFlowStates()) < 1)
		{
			$this->addFlowState(new FlowState());
		}
		foreach($this->getFlowStates() as $flowState)
		{
			$array[] = array(array('FlowState' => $flowState->getDebbXmlArray($x++)));
		}
		return $array;
	}

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->flowStates = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
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
	 * Duplicate this entity
	 */
	public function __clone()
	{
		if ($this->getId() > 0)
		{
			$this->id = null;

			$this->setName(preg_match_all('# - ([0-9]+)$#', $this->getName(), $matches) > 0 ? preg_replace('# - ([0-9]+)$#', ' - ' . ++$matches[1][0], $this->getName()) : ($this->getName() . ' - ' . 2));

			$flowStates = new ArrayCollection();
			foreach($this->getFlowStates() as $flowState)
			{
				$flowStates->add(clone $flowState);
			}
			$this->setFlowState($flowStates);
		}
	}

    /**
     * Set name
     *
     * @param string $name
     * @return FlowProfile
     */
    public function setName($name)
    {
        $this->name = $name;
    
        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Add flowStates
     *
     * @param \Debb\ManagementBundle\Entity\FlowState $flowStates
     * @return FlowProfile
     */
    public function addFlowState($flowStates)
    {
		if($flowStates instanceof \Debb\ManagementBundle\Entity\FlowState)
		{
			$this->flowStates[] = $flowStates;
			$flowStates->setFlowProfile($this);
		}
    
        return $this;
    }

    /**
     * Remove flowStates
     *
     * @param \Debb\ManagementBundle\Entity\FlowState $flowStates
     */
    public function removeFlowState(\Debb\ManagementBundle\Entity\FlowState $flowStates)
    {
	    $flowStates->setFlowProfile();
        $this->flowStates->removeElement($flowStates);
    }

	/**
	 * Set flowStates
	 *
	 * @param \Debb\ManagementBundle\Entity\FlowState[] $flowPumps
	 * @return FlowProfile
	 */
	public function setFlowState($flowStates)
	{
		$this->flowStates = $flowStates;

		foreach ($this->flowStates as $flowState)
		{
			$flowState->setFlowProfile($this);
		}

		return $this;
	}

    /**
     * Get flowStates
     *
     * @return \Debb\ManagementBundle\Entity\FlowState[]
     */
    public function getFlowStates()
    {
        return $this->flowStates;
    }

    /**
     * Set user
     *
     * @param \CoolEmAll\UserBundle\Entity\User $user
     * @return FlowProfile
     */
    public function setUser(\CoolEmAll\UserBundle\Entity\User $user = null)
    {
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
	 * @return string the name of flow profile
	 */
	function __toString()
	{
		return $this->getName();
	}

    /**
     * Set type
     *
     * @param string $type
     * @return FlowProfile
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
}