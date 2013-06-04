<?php

namespace Debb\ConfigBundle\Entity;

use Debb\ManagementBundle\Entity\NodeGroupDraft;
use Debb\ManagementBundle\Entity\NodeToNodegroup;
use Doctrine\ORM\Mapping as ORM;

/**
 * NodeGroup
 *
 * @ORM\Table(name="nodegroup")
 * @ORM\Entity
 */
class NodeGroup extends Dimensions
{

	/**
	 * @var NodeToNodegroup
	 *
	 * @ORM\OneToMany(targetEntity="Debb\ManagementBundle\Entity\NodeToNodegroup", cascade={"persist"}, mappedBy="nodeGroup", orphanRemoval=true)
	 */
	private $nodes;

	/**
	 * @var NodeGroupDraft
	 *
	 * @ORM\ManyToOne(targetEntity="Debb\ManagementBundle\Entity\NodeGroupDraft")
	 */
	private $draft;

	/**
	 * Constructor
	 */
	public function __construct()
	{
		$this->nodes = new \Doctrine\Common\Collections\ArrayCollection();
	}

	/**
	 * Add nodes
	 *
	 * @param \Debb\ManagementBundle\Entity\NodeToNodegroup $nodes
	 * @return NodeGroup
	 */
	public function addNode(\Debb\ManagementBundle\Entity\NodeToNodegroup $nodes)
	{
		$nodes->setNodeGroup($this);
		$this->nodes[] = $nodes;

		return $this;
	}

	/**
	 * Set nodes
	 *
	 * @param \Debb\ManagementBundle\Entity\NodeToNodegroup[] $nodes
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
	 * @param \Debb\ManagementBundle\Entity\NodeToNodegroup $nodes
	 */
	public function removeNode(\Debb\ManagementBundle\Entity\NodeToNodegroup $nodes)
	{
		$this->nodes->removeElement($nodes);
	}

	/**
	 * Get nodes
	 *
	 * @return \Doctrine\Common\Collections\Collection
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
		$ordered = new \Doctrine\Common\Collections\ArrayCollection();
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
		return $array;
	}


	/**
	 * Set draft
	 *
	 * @param \Debb\ManagementBundle\Entity\NodeGroupDraft $draft
	 * @return NodeGroup
	 */
	public function setDraft(\Debb\ManagementBundle\Entity\NodeGroupDraft $draft = null)
	{
		$this->draft = $draft;

		return $this;
	}

	/**
	 * Get draft
	 *
	 * @return \Debb\ManagementBundle\Entity\NodeGroupDraft
	 */
	public function getDraft()
	{
		return $this->draft;
	}
}
