<?php

namespace Debb\ManagementBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Connector for two things
 *
 * @ORM\MappedSuperclass
 */
class Connector
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
     * @var integer
     *
     * @ORM\Column(name="field", type="integer")
     */
    private $field;


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
     * Set field (x = 0, y = 0 - first field = 0, next field (x = 0, y = 10) = 1, next/third field (x = 10, y = 0) = 2, ...
     *
     * @param integer $field
     * @return Connector
     */
    public function setField($field)
    {
        $this->field = $field;
    
        return $this;
    }

    /**
     * Get field (x = 0, y = 0 - first field = 0, next field (x = 0, y = 10) = 1, next/third field (x = 10, y = 0) = 2, ...
     *
     * @return integer 
     */
    public function getField()
    {
        return $this->field;
    }
}
