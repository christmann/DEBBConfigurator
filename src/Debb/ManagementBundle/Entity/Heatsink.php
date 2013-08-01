<?php

namespace Debb\ManagementBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Heatsink
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Debb\ManagementBundle\Repository\BaseRepository")
 */
class Heatsink extends DEBBSimple
{
	/**
	 * @var float
	 *
	 * @ORM\Column(name="transfer_rate", type="float", nullable=true)
	 */
	private $transferRate;

	/**
	 * Returns a array for later converting
	 *
	 * @return array the array for later converting
	 */
	public function getDebbXmlArray()
	{
		$array = parent::getDebbXmlArray();
		if($this->getTransferRate() !== null)
		{
			$array['TransferRate'] = $this->getTransferRate();
		}
		return $array;
	}

    /**
     * Set transferRate
     *
     * @param float $transferRate
     * @return Heatsink
     */
    public function setTransferRate($transferRate)
    {
        $this->transferRate = $transferRate;
    
        return $this;
    }

    /**
     * Get transferRate
     *
     * @return float 
     */
    public function getTransferRate()
    {
        return $this->transferRate;
    }
}