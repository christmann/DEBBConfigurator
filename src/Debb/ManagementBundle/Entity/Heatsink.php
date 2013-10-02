<?php

namespace Debb\ManagementBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Heatsink
 *
 * A heatsink is any type of device transfering heat betweeen two neighbour gas, fluids or solids like
 * heat exchanger in colling deviced transfering heat from one cooling circuit to
 * another (i.e. air/liquid or liquid/liquid) cpu cooler transfering heta from the cpu to the air
 * or liquid (solid/air or liquid)
 *
 * @ORM\Table(name="heatsink")
 * @ORM\Entity(repositoryClass="Debb\ManagementBundle\Repository\BaseRepository")
 */
class Heatsink extends DEBBSimple
{
	/**
	 * Also called efficiency
	 *
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