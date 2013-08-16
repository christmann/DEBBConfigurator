<?php

namespace Debb\ConfigBundle\Entity;

use Debb\ManagementBundle\Entity\Chassis;
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
class NodeGroup extends Dimensions
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
			foreach($this->getDraft()->getTypspecification() as $slot => $typSpec)
			{
				/**
						<Slot>
							<Number>1</Number>
							<ConnectorType>ComExpress Type 2</ConnectorType>
							<Label>Slot_1</Label>
							<Transform>0 -1 0 0 1 0 0 0 0 0 1 0 X Y Z 1</Transform><!-- No input in chassis! -->
						</Slot>
				 */
				$slot++;
				$array['NodeGroup'][] = array(array('Slot' => array('Number' => $slot, 'ConnectorType' => $typSpec, 'Label' => 'Slot_' . $slot)));
			}
		}
        return $array;
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
     * @return \Doctrine\Common\Collections\Collection|NodegroupToRack[]
     */
    public function getRacks()
    {
        return $this->racks;
    }

	/**
	 * @return \Debb\ConfigBundle\Entity\Node[]
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
		}
		return $childrens;
	}
}