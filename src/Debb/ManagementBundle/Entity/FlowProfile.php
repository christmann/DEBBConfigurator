<?php

namespace Debb\ManagementBundle\Entity;

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
     *
     * @ORM\Column(name="Name", type="string", length=255)
     */
    private $name;

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
    public function addFlowState(\Debb\ManagementBundle\Entity\FlowState $flowStates)
    {
        $this->flowStates[] = $flowStates;
	    $flowStates->setFlowProfile($this);
    
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
     * Get flowStates
     *
     * @return \Doctrine\Common\Collections\Collection 
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
}