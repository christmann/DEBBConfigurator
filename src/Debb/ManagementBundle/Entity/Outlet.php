<?php

namespace Debb\ManagementBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Outlet
 *
 * @ORM\Table(name="outlet")
 * @ORM\Entity(repositoryClass="Debb\ManagementBundle\Repository\BaseRepository")
 */
class Outlet extends DEBBSimple
{
    /**
     * @var integer|null
     *
     * @ORM\Column(name="MaxRPM", type="integer", nullable=true)
     */
    private $maxRPM;

	/**
	 * Returns a array for later converting
	 *
	 * @return array the array for later converting
	 */
	public function getDebbXmlArray()
	{
		$array = parent::getDebbXmlArray();
		if ($this->getMaxRPM() !== null)
		{
			$array['MaxRPM'] = $this->getMaxRPM();
		}
		return $array;
	}

    /**
     * Set maxRPM
     *
     * @param integer $maxRPM
     * @return Outlet
     */
    public function setMaxRPM($maxRPM)
    {
        $this->maxRPM = $maxRPM;
    
        return $this;
    }

    /**
     * Get maxRPM
     *
     * @return integer 
     */
    public function getMaxRPM()
    {
        return $this->maxRPM;
    }
}
