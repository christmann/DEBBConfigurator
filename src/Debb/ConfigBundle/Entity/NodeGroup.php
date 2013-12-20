<?php

namespace Debb\ConfigBundle\Entity;

use Debb\ConfigBundle\Controller\XMLController;
use Debb\ManagementBundle\DataTransformer\DecimalTransformer;
use Debb\ManagementBundle\Entity\Chassis;
use Debb\ManagementBundle\Entity\DEBBComponent;
use Debb\ManagementBundle\Entity\Network;
use Debb\ManagementBundle\Entity\NodegroupToRack;
use Debb\ManagementBundle\Entity\NodeToNodegroup;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * NodeGroup
 *
 * @ORM\Table(name="nodegroup")
 * @ORM\Entity(repositoryClass="Debb\ManagementBundle\Repository\BaseRepository")
 */
class NodeGroup extends DEBBComponent
{
    /**
     * Nodes
     * @ORM\OneToMany(targetEntity="Debb\ManagementBundle\Entity\NodeToNodegroup", cascade={"persist"}, mappedBy="nodeGroup", orphanRemoval=true)
     *
     * @var \Debb\ManagementBundle\Entity\NodeToNodegroup[]
     */
    private $nodes;

    /**
     * Chassis
     * @ORM\ManyToOne(targetEntity="Debb\ManagementBundle\Entity\Chassis", inversedBy="nodeGroups")
     * @ORM\JoinColumn(name="draft_id", referencedColumnName="id", onDelete="SET NULL")
     *
     * @var Chassis
     */
    private $draft;

    /**
     * Racks
     * @ORM\OneToMany(targetEntity="Debb\ManagementBundle\Entity\NodegroupToRack", mappedBy="nodegroup")
     *
     * @var \Doctrine\Common\Collections\ArrayCollection|NodegroupToRack[]
     */
    private $racks;

	/**
	 * @var \Debb\ManagementBundle\Entity\Network[]
	 *
	 * @ORM\ManyToMany(targetEntity="Debb\ManagementBundle\Entity\Network", cascade={"persist"})
	 */
	private $networks;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->nodes = new ArrayCollection();
    }

    /**
     * Add nodes
     *
     * @param NodeToNodegroup $nodes
     *
     * @return NodeGroup
     */
    public function addNode(NodeToNodegroup $nodes)
    {
        $nodes->setNodeGroup($this);
        $this->nodes[] = $nodes;

        return $this;
    }

    /**
     * Set nodes
     *
     * @param NodeToNodegroup $nodes
     *
     * @return NodeGroup
     */
    public function setNodes($nodes)
    {
        $this->nodes = $nodes;

        foreach ($this->nodes as $node) {
            $node->setNodeGroup($this);
        }

        return $this;
    }

    /**
     * Remove nodes
     *
     * @param NodeToNodegroup $nodes
     */
    public function removeNode(NodeToNodegroup $nodes)
    {
        $this->nodes->removeElement($nodes);
    }

    /**
     * Get nodes
     *
     * @return \Debb\ManagementBundle\Entity\NodeToNodegroup[]
     */
    public function getNodes()
    {
        return $this->nodes;
    }

    /**
     * Sort nodes (unused) (reverse)
     */
    public function sortNodes()
    {
        $ordered = new ArrayCollection();
        for ($i = $this->nodes->count() - 1; $i >= 0; $i--) {
            $ordered->add($this->nodes[$i]);
        }
        $this->nodes = $ordered;

        $x = 0;
        foreach ($this->nodes as $node) {
            $node->setField($x);
            $x++;
        }
    }

    /**
     * Get the next free field in node array
     *
     * @return int the next free field in node array
     */
    public function getFreeNode()
    {
        $ids = array();
        foreach ($this->getNodes() as $node) {
            $ids[] = $node->getField();
        }
        ksort($ids);

        $res = 0;
        foreach ($ids as $id) {
            if ($id == $res) {
                $res++;
            }
        }
        return $res;
    }

    /**
     * Returns a array for later converting
     *
     * @return array the array for later converting
     */
    public function getDebbXmlArray()
    {
        $array['NodeGroup'] = parent::getDebbXmlArray();
		if($this->getDraft() != null && $this->getDraft()->getTypspecification() != null)
		{
			/** @var $typSpec \Debb\ManagementBundle\Entity\ChassisTypSpecification */
			foreach($this->getDraft()->getTypspecification() as $slot => $typSpec)
			{
				$slot++;
				$array['NodeGroup'][] = array(array('Slot' => array('Number' => $slot, 'ConnectorType' => $typSpec->getTyp(), 'Label' => 'Slot_' . $slot)));
			}
		}
        return $array;
    }

	/**
	 * Get the inlets of this node group
	 *
	 * @param bool $useOutletsInstead should this function return outlets instead of inlets?
	 * @return \Debb\ManagementBundle\Entity\FlowPump[]
	 */
	public function getInlets($useOutletsInstead = false)
	{
		$array = array();
		if($this->getDraft() !== null)
		{
			foreach($this->getDraft()->getFlowPumps() as $flowPumpToChassis)
			{
				$flowPump = $flowPumpToChassis->getFlowPump();
				if($flowPump !== null && $flowPump->isInlet() == !$useOutletsInstead)
				{
					$array[] = $flowPump;
				}
			}
		}
		return $array;
	}

	/**
	 * Get the outlets of this node group
	 *
	 * @return \Debb\ManagementBundle\Entity\FlowPump[]
	 */
	public function getOutlets()
	{
		return $this->getInlets(true);
	}

    /**
     * Set draft
     *
     * @param Chassis $draft
     *
     * @return NodeGroup
     */
    public function setDraft(Chassis $draft = null)
    {
        $this->draft = $draft;

        return $this;
    }

    /**
     * Get draft
     *
     * @return Chassis
     */
    public function getDraft()
    {
        return $this->draft;
    }

    /**
     * Add racks
     *
     * @param NodegroupToRack $racks
     *
     * @return NodeGroup
     */
    public function addRack(NodegroupToRack $racks)
    {
        $this->racks[] = $racks;

        return $this;
    }

    /**
     * Remove racks
     *
     * @param NodegroupToRack $racks
     */
    public function removeRack(NodegroupToRack $racks)
    {
        $this->racks->removeElement($racks);
    }

    /**
     * Get racks
     *
     * @return NodegroupToRack[]
     */
    public function getRacks()
    {
        return $this->racks;
    }

	/**
	 * Get the parents
	 *
	 * @return NodegroupToRack[]
	 */
	public function getParents()
	{
		return $this->getRacks();
	}

	/**
	 * Get references
	 *
	 * @return \Debb\ManagementBundle\Entity\File[]
	 */
	public function getReferences()
	{
		return $this->getDraft() != null ? $this->getDraft()->getReferences() : array();
	}

	/**
	 * @return array
	 */
	public function getChildrens()
	{
		$childrens = array();
		$draft = $this->getDraft();
		if($draft !== null)
		{
			/** @var $typSpecs array */
			$typSpecs = $draft->getTypspecification()->toArray();
			/** @var $nodes array */
			$nodes = $this->getNodes()->toArray();

			for($x = 0; $x < count($typSpecs); $x++)
			{
				if(array_key_exists($x, $nodes))
				{
					$childrens[] = array($nodes[$x]->getNode(), $typSpecs[$x]);
				}
			}

			foreach($draft->getFlowPumps() as $flowPumpToChassis)
			{
				if($flowPumpToChassis->getFlowPump() != null)
				{
					$childrens[] = array($flowPumpToChassis->getFlowPump(), $flowPumpToChassis);
				}
			}
		}
		return $childrens;
	}

	/**
	 * @return string the debb level
	 */
	public function getDebbLevel()
	{
		return 'NodeGroup';
	}

    /**
     * Add networks
     *
     * @param \Debb\ManagementBundle\Entity\Network $networks
     * @return NodeGroup
     */
    public function addNetwork(\Debb\ManagementBundle\Entity\Network $networks)
    {
        $this->networks[] = $networks;
    
        return $this;
    }

    /**
     * Remove networks
     *
     * @param \Debb\ManagementBundle\Entity\Network $networks
     */
    public function removeNetwork(\Debb\ManagementBundle\Entity\Network $networks)
    {
        $this->networks->removeElement($networks);
    }

    /**
     * Get networks
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getNetworks()
    {
        return $this->networks;
    }

	/**
	 * @return float
	 */
	public function getRealCostsEur($inclSelf = true)
	{
		$costs = 0;

		// Count nodes
		foreach($this->getNodes() as $nodeToNodegroup)
		{
			if($nodeToNodegroup !== null && $nodeToNodegroup->getNode() instanceof Node)
			{
				$costs += $nodeToNodegroup->getNode()->getRealCostsEur();
			}
		}

		// Count networks
		foreach($this->getNetworks() as $network)
		{
			if($network instanceof Network)
			{
				$costs += $network->getRealCostsEur();
			}
		}

		// Count chassis
		if($this->getDraft() instanceof Chassis)
		{
			$costs += $this->getDraft()->getRealCostsEur();
		}

		// Count self
		if($inclSelf)
		{
			$costs += parent::getRealCostsEur();
		}

		return DecimalTransformer::convert($costs);
	}

	/**
	 * @return float
	 */
	public function getRealCostsEnv($inclSelf = true)
	{
		$costs = 0;

		// Count nodes
		foreach($this->getNodes() as $nodeToNodegroup)
		{
			if($nodeToNodegroup !== null && $nodeToNodegroup->getNode() instanceof Node)
			{
				$costs += $nodeToNodegroup->getNode()->getRealCostsEnv();
			}
		}

		// Count networks
		foreach($this->getNetworks() as $network)
		{
			if($network instanceof Network)
			{
				$costs += $network->getRealCostsEnv();
			}
		}

		// Count chassis
		if($this->getDraft() instanceof Chassis)
		{
			$costs += $this->getDraft()->getRealCostsEnv();
		}

		// Count self
		if($inclSelf)
		{
			$costs += parent::getRealCostsEnv();
		}

		return DecimalTransformer::convert($costs);
	}

	/**
	 * Get the costs array for xml
	 *
	 * @return array
	 */
	public function getCostsXml()
	{
		$costs = parent::getCostsXml();

		// Count nodes
		foreach($this->getNodes() as $nodeToNodegroup)
		{
			if($nodeToNodegroup !== null && $nodeToNodegroup->getNode() instanceof Node)
			{
				$costs[] = array(XMLController::get_real_class($nodeToNodegroup->getNode()) => $nodeToNodegroup->getNode()->getCostsXml());
			}
		}

		// Count networks
		foreach($this->getNetworks() as $network)
		{
			if($network instanceof Network)
			{
				$costs[] = array(XMLController::get_real_class($network) => $network->getCostsXml());
			}
		}

		// Count chassis
		if($this->getDraft() instanceof Chassis)
		{
			$costs[] = array(XMLController::get_real_class($this->getDraft()) => $this->getDraft()->getCostsXml());
		}

		return $costs;
	}
}