<?php

namespace Debb\ManagementBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Reference
 *
 * ReferenceType describes references to external files like STL, VRML, etc. and consists of a type and path.
 *
 * @ORM\Table(name="reference")
 * @ORM\Entity(repositoryClass="Debb\ManagementBundle\Repository\BaseRepository")
 */
class Reference
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
     * @Assert\NotBlank()
     * @ORM\Column(name="type", type="string", length=255)
     */
    private $type;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     * @ORM\Column(name="location", type="string", length=255)
     */
    private $location;

	/**
	 * @var \CoolEmAll\UserBundle\Entity\User
	 *
	 * @ORM\ManyToOne(targetEntity="CoolEmAll\UserBundle\Entity\User")
	 */
	private $user;

	/**
	 * @var \Debb\ManagementBundle\Entity\DEBBSimple
	 *
	 * @ORM\ManyToOne(targetEntity="Debb\ManagementBundle\Entity\DEBBSimple", inversedBy="references")
	 */
	private $debbSimple;

	/**
	 * Returns a array for later converting
	 *
	 * @return array the array for later converting
	 */
	public function getDebbXmlArray()
	{
		$array = array();
		if ($this->getType() !== null)
		{
			$array['Type'] = $this->getType();
		}
		if ($this->getLocation() !== null)
		{
			$array['Location'] = $this->getLocation();
		}
		return $array;
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
     * Set type
     *
     * @param string $type
     * @return Reference
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
     * Set location
     *
     * @param string $location
     * @return Reference
     */
    public function setLocation($location)
    {
        $this->location = $location;
    
        return $this;
    }

    /**
     * Get location
     *
     * @return string 
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * Set user
     *
     * @param \CoolEmAll\UserBundle\Entity\User $user
     * @return Reference
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
     * Set debbSimple
     *
     * @param \Debb\ManagementBundle\Entity\DEBBSimple $debbSimple
     * @return Reference
     */
    public function setDebbSimple(\Debb\ManagementBundle\Entity\DEBBSimple $debbSimple = null)
    {
        $this->debbSimple = $debbSimple;
    
        return $this;
    }

    /**
     * Get debbSimple
     *
     * @return \Debb\ManagementBundle\Entity\DEBBSimple 
     */
    public function getDebbSimple()
    {
        return $this->debbSimple;
    }
}