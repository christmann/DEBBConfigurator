<?php

namespace Debb\ConfigBundle\Controller;

use CoolEmAll\UserBundle\Entity\User;
use Debb\ConfigBundle\Entity\Node;
use Debb\ConfigBundle\Entity\NodeGroup;
use Debb\ConfigBundle\Entity\Rack;
use Debb\ConfigBundle\Entity\Room;
use Debb\ManagementBundle\Controller\BaseController;
use Debb\ManagementBundle\Entity\NodegroupToRack;
use Debb\ManagementBundle\Entity\RackToRoom;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Contains default actions for xml generation of DEBBComponents or PLMXML
 * @author Patrick Bußmann <patrick.bussmann@christmann.info>
 */
abstract class XMLController extends BaseController
{
	/**
	 * @var string type of debbcomponent
	 */
	public $debbType = 'Node';

	/**
	 * @var string debb entity repository
	 */
	public $debbEntity = 'DebbConfigBundle:Node';

	/**
	 * Download entity as xml file
	 *
	 * @Route("/xml/{id}.xml", requirements={"id"="\d+"});
	 *
	 * @param int                                       $id       item id
	 *
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function asXmlAction($id)
	{
		$response = new \Symfony\Component\HttpFoundation\Response();
		$response->headers->set('Content-Type', 'text/xml');
		header('Content-Type: text/xml');
		echo $this->getDebbXml($id, true);
		return $response;
	}

	/**
	 * Return entity as DEBBComponents.xml string
	 *
	 * @param int $id item id
	 * @param bool $pretty format output for user?
	 *
	 * @return string the DEBBComponents.xml string
	 */
	public function getDebbXml($id, $pretty = false)
	{
		$item = $this->getEntity($id);

		$xml = new \SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><'.$this->debbType.' />');
		$info = $item->getDebbXmlArray();
		if(array_key_exists($this->debbType, $info))
		{
			$info = $info[$this->debbType];
		}
		else
		{
			foreach($info as $key => $val)
			{
				$info = $val;
			}
		}
		\Debb\ManagementBundle\Entity\Base::array_to_xml($info, $xml);

		if ($pretty)
		{
			$dom = dom_import_simplexml($xml)->ownerDocument;
			$dom->formatOutput = true;
			$dom->preserveWhiteSpace = true;
			$xmlStr = $dom->saveXML(null, LIBXML_NOEMPTYTAG);
		}
		else
		{
			$xmlStr = $xml->asXML();
		}

		$xmlStr = str_replace('<'.$this->debbType.'>',  '<xsd_1:'.$this->debbType.' xmlns:xsd_1="http://www.coolemall.eu/DEBBComponent" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.coolemall.eu/DEBBComponent DEBBComponents.xsd " >',
			str_replace('</'.$this->debbType.'>', '</xsd_1:'.$this->debbType.'>', $xmlStr));

		$room = new \Debb\ConfigBundle\Controller\RoomController();
		$room->setContainer($this->getContainer());
		$room->valide($xmlStr, file_get_contents('../utils/DEBBComponents.xsd'), 'DEBBComponents');

		return $xmlStr;
	}

	/**
	 * Return entity as plm xml string
	 *
	 * @param int $id item id
	 *
	 * @return string the plm xml string
	 */
	public function asPlmXmlAction($id, $pretty = false)
	{
		$item = $this->getEntity($id);

		$xml = new \SimpleXMLElement('<?xml version="1.0" encoding="utf-8"?>
<PLMXML xmlns="http://www.plmxml.org/Schemas/PLMXMLSchema"
	xmlns:vis="PLMXMLTcVisSchema" schemaVersion="6" date="' . date('Y-m-d') . '" time="' . date('H:i:s') . '"
	author="'.htmlentities((string) $this->getUser(), ENT_QUOTES).'" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
	xsi:schemaLocation="http://www.plmxml.org/Schemas/PLMXMLSchema PLMXMLSchema.xsd" />');

		$productDef = $xml->addChild('ProductDef');
		$productDef->addAttribute('id', 'id1');
		$instanceGraph = $productDef->addChild('InstanceGraph');
		$instanceGraph->addAttribute('id', 'id2');

		if($item instanceof Room)
		{
			$items = $item->getRacks();
		}
		else
		{
			if($item instanceof NodeGroup)
			{
				$eRack = new Rack();
				$eItem = new NodegroupToRack();
				$eItem->setRack($eRack);
				$eItem->setNodegroup($item);
				$items = array($eRack);
			}
			else
			{
				$items = array($item);
			}
		}

		foreach($items as $item)
		{
			if($item instanceof RackToRoom)
			{
				$item = $item->getRack();
			}

			$rackInstance = $this->addPlmXmlProductRevisionView(
				$instanceGraph,                                                         // $xml
				'iview' . sprintf('%02d', $item->getId()) . '_1',                       // $id
				'DefRackView' . sprintf('%02d', $item->getId()),                        // $name
				null,                                                                   // $instanceRefs
				$item->getHostname()                                                    // $type
			);
			$rackInstanceViewArr = (array) $rackInstance->attributes();
			$rackInstanceView = $this->addPlmXmlProductInstance(
				$instanceGraph,                                                         // $xml
				'inst' . sprintf('%02d', $item->getId()) . '_1',                        // $id
				'DefRack' . sprintf('%02d', $item->getId()),                            // $name
				$rackInstanceViewArr['@attributes']['id'],                              // $partRef
				$item->getHostname()                                                    // $hostname
			);
			if($instanceGraph->attributes()->rootRefs === null)
			{
				$instanceGraph->addAttribute('rootRefs', $rackInstanceView[1]);
			}

			$rackInstance = $rackInstance[0];

			$nodeGroupsForThatRack = array();

			foreach ($item->getNodeGroups() as $nodeGroup)
			{
				if ($nodeGroup->getNodeGroup() != null)
				{
					$id = $item->getId() . $nodeGroup->getId();
					$nodeGroupsForThatRack[] = 'id' . sprintf('%04d', $id);

					/** @var $nodeGroup NodegroupToRack */
					$productRevisionView = $this->addPlmXmlProductRevisionView(
						$instanceGraph,                                                 // $xml
						'id' . sprintf('%04d', $id),                                    // $id
						'DefNodeGroup' . sprintf('%04d', $id),                          // $name
						array(),                                                        // $instanceRefs
						'assembly',                                                     // $type
						array(),                                                        // $representations
						$nodeGroup->getNodeGroup()->getComponentId(),                   // $DEBBComponentId
						'NodeGroup'                                                     // $DEBBLevel
					);

					/* @var $nodeGroup NodegroupToRack */
					$draft = $nodeGroup->getNodegroup()->getDraft();

					$nodesForThatNodeGroup = array();
					$i = 1;
					$x = $nodeGroup->getNodegroup()->getSpaceLeft();
					$y = $nodeGroup->getNodegroup()->getSpaceBottom();
					foreach ($nodeGroup->getNodeGroup()->getNodes() as $node)
					{
						if ($node->getNode() != null)
						{
							$partReference = $this->addPlmXmlProductInstance(
								$instanceGraph,                                         // $xml
								'inst' . sprintf('%04d', $id) . '_2',                   // $id
								'DefNode' . sprintf('%04d', $id),                       // $name
								'id' . sprintf('%04d', $id),                            // $partRef
								$node->getNode()->getHostname(),                        // $hostname
								'0 1 0 0 -1 0 0 0 0 0 1 0 '.$x.' '.$y.' 0.005 1'        // $transform
							);
							if($draft != null)
							{
								if($i == $draft->getSlotsY())
								{
									$x += $node->getNode()->getSizeX();
									$i = 1;
									$y = 0;
								}
								else
								{
									$y = $i * $node->getNode()->getSizeY();
									$i++;
								}
							}
							$nodesForThatNodeGroup[] = '' . $partReference[1];
						}
					}

					$productRevisionView->addAttribute('instanceRefs', implode(' ', $nodesForThatNodeGroup));
				}
			}

			$rackInstance->addAttribute('instanceRefs', implode(' ', $nodeGroupsForThatRack));
		}

		if ($pretty)
		{
			$dom = dom_import_simplexml($xml)->ownerDocument;
			$dom->formatOutput = true;
			$dom->preserveWhiteSpace = true;
			return $dom->saveXML(null, LIBXML_NOEMPTYTAG);
		}
		else
		{
			return $xml->asXML();
		}
	}

	/**
	 * Adds a ProductInstance entry to the SimpleXMLElement $xml [PLMXML]
	 *
	 * @param \SimpleXMLElement $xml the SimpleXMLElement
	 * @param string $id the id of the ProductInstance
	 * @param null|string optional $name the name of this product instance
	 * @param null|string optional $partRef the part reference of this product instance
	 * @param null|string optional $hostname the hostname of this product instance
	 * @param null|string optional $transform the position of this product instance
	 * @return array the SimpleXMLElement product instance (0) and the generated id (1)
	 */
	public function addPlmXmlProductInstance(\SimpleXMLElement &$xml, $id, $name = null, $partRef = null, $hostname = null, $transform = null, $locationInMesh = null)
	{
		$productInstance = $xml->addChild('ProductInstance');

		$isId = explode('_', $id);
		$iId = (int) $isId[count($isId) - 1];
		unset($isId[count($isId) - 1]);
		$exId = implode('_', $isId);
		$id = $exId . '_' . $iId;

		while (count($xml->xpath('*[@id="' . $id . '"]/@id')) > 0)
		{
			$iId++;
			$id = $exId . '_' . $iId;
		}

		$productInstance->addAttribute('id', $id); // example: inst71_01_7
		if ($name != null)
		{
			$productInstance->addAttribute('name', $name . '_' . $iId); // example: Node7
		}

		if($partRef != null)
		{
			$productInstance->addAttribute('partRef', is_array($partRef) ? implode(' ', $partRef) : $partRef);
		}

		if ($transform != null)
		{
			$transform = $productInstance->addChild('Transform', $transform); // example: 0 1 0 0 -1 0 0 0 0 0 1 0 0.175 0.744 0.005 1
			$transform->addAttribute('id', $this->convertIdToTransId($id)); // example: id71_01_07
		}

		if ($hostname != null || $locationInMesh != null)
		{
			$userData = $productInstance->addChild('UserData');
			$userData->addAttribute('id', preg_replace('#[i]{0,1}view#i', 'userdata', $id) . '_1'); // example: id71_01_7_1

			if ($hostname != null)
			{
				$userValue = $userData->addChild('UserValue');
				$userValue->addAttribute('value', $hostname); // example: n007
				$userValue->addAttribute('title', 'hostname');
			}

			if ($locationInMesh != null)
			{
				$locationInMesh = $userData->addChild('LocationInMesh');
				$locationInMesh->addAttribute('value', $locationInMesh); // example: 1 0 0 0 0 1 0 0 0 0 1 0 -0.003 -0.003 0.003 1
				$locationInMesh->addAttribute('title', 'LocationInMesh');
			}
		}

		return array(0 => $productInstance, 1 => $id);
	}

	/**
	 * Adds a ProductRevisionView entry to the SimpleXMLElement $xml [PLMXML]
	 *
	 * @param \SimpleXMLElement $xml the SimpleXMLElement
	 * @param string $id the id of the ProductRevisionView
	 * @param null|string optional $name the name of the ProductRevisionView
	 * @param null|array optional $instanceRefs array of instance refs
	 * @param null|string optional $type the type of ProductRevisionView
	 * @param null|string optional $format the file format of $location file
	 * @param null|string optional $location the path to file for representation
	 * @param null|string optional $DEBBComponentId the ComponentID from DEBBComponents.xml file
	 * @param null|string optional $DEBBLevel the type from DEBBComponents.xml file (Node, NodeGroup, Computebox1, ComputeBox2, Sensor, CoolingDevice, Powersupply, ...)
	 * @return \SimpleXMLElement the SimpleXMLElement product revision view
	 */
	public function addPlmXmlProductRevisionView(\SimpleXMLElement &$xml, $id, $name = null, $instanceRefs = array(), $type = null, $representations = array(), $DEBBComponentId = null, $DEBBLevel = null)
	{
		$productRevisionView = $xml->addChild('ProductRevisionView');

		/* Generate single id */
//		$isId = explode('_', $id);
//		$iId = (int) $isId[count($isId) - 1];
//		unset($isId[count($isId) - 1]);
//		$exId = implode('_', $isId);
//		$id = $exId . '_' . $iId;
//
//		while (count($xml->xpath('*[@id="' . $id . '"]/@id')) > 0)
//		{
//			$iId++;
//			$id = $exId . '_' . $iId;
//		}

		$productRevisionView->addAttribute('id', $id); // example: id84_04_1
		if ($name != null)
		{
			$productRevisionView->addAttribute('name', $name); // example: NodeGeometry
		}
		if (is_array($instanceRefs) && count($instanceRefs) > 1)
		{
			$productRevisionView->addAttribute('instanceRefs', implode(' ', $instanceRefs)); // example: inst83_01_1 inst83_01_2 inst83_01_3 inst83_01_4 inst83_01_5 inst83_01_6
		}
		if ($type != null)
		{
			$productRevisionView->addAttribute('type', $type); // example: assembly
		}

		if ($DEBBComponentId != null && $DEBBLevel != null)
		{
			$userData = $productRevisionView->addChild('UserData');
			$userData->addAttribute('id', $id . '_1'); // example: id84_04_1_1

			if ($DEBBLevel != null)
			{
				$userValue = $userData->addChild('UserValue');
				$userValue->addAttribute('value', $DEBBLevel); // example: Node (Node, NodeGroup, Computebox1, ComputeBox2, Sensor, CoolingDevice, Powersupply, ...)
				$userValue->addAttribute('title', 'DEBBLevel'); // example: DEBBLevel
			}
			if ($DEBBComponentId != null)
			{
				$userValue = $userData->addChild('UserValue');
				$userValue->addAttribute('value', $DEBBComponentId); // example: node_psnc_i7-16GB-sandy
				$userValue->addAttribute('title', 'DEBBComponentId'); // example: DEBBComponentId
			}
		}

		if ($representations != null && count($representations) > 0)
		{
			foreach($representations as $rep)
			{
				$representation = $productRevisionView->addChild('Representation');
				$representation->addAttribute('id', $this->convertLocationToId($rep['location'])); // example: id1084_04_1
				$representation->addAttribute('format', $rep['format']); // example: VRML
				$representation->addAttribute('location', $rep['location']); // example: .\objects\NodeBoard.wrl
			}
		}

		return $productRevisionView;
	}

	/**
	 * Convert a id to another id
	 *
	 * @param string $id the id to convert (example: inst83_01_3)
	 * @return string the converted id (example: id83_01_03)
	 */
	public function convertIdToTransId($id)
	{
		$id = str_replace('inst', 'id', $id);
		$cache = explode('_', $id);
		if (count($cache) > 1)
		{
			$last = & $cache[count($cache) - 1];
			$last = sprintf('%02d', $last);
		}
		return implode('_', $cache);
	}

	/**
	 * Convert a id to another id
	 *
	 * @param string $id the id to convert (example: id84_04_1)
	 * @return string the converted id (example: id1084_04_1)
	 */
	public function convertIdToRevId($id)
	{
		return preg_replace('#[i]{0,1}view#i', 'rep', $id);
	}

	/**
	 * Converts a location to a id
	 *
	 * @param string $location the location to convert (example: .\objects\NodeGroup_recscase.stl)
	 * @return mixed the id of the location (example: _objects_NodeGroup_recscase_stl)
	 */
	public function convertLocationToId($location)
	{
		return preg_replace('#[^0-9a-zA-Z]+#i', '_', $location);
	}

	/**
	 * Download a zip archive with all xml files
	 *
	 * @Route("/download/{id}.zip", defaults={"id"=0}, requirements={"id"="\d+|"});
	 * @param string $id the id of entity to generate plm xml and DEBBComponents.xml
	 * @param boolean $debug only for testing / output to browser
	 * @throws error 404
	 */
	public function exportAsArchiveAction($id, $debug = false)
	{
		$fileName = tempnam(sys_get_temp_dir(), 'zip');

		if($debug)
		{
			header('Content-type: text/plain');
		}
		$zip = new \ZipArchive;
		$res = $zip->open($fileName, \ZipArchive::CREATE);
		if ($res == true)
		{
			$item = $this->getEntity($id);

			/* Init the arrays for later generation of xml files */
			$nodes = array();
			$nodeGroups = array();
			$racks = array(); // @ignore
			$rooms = array(); // @ignore

			if($item instanceof Room)
			{
				$rooms[$item->getId()] = $item;
			}
			if(count($rooms) > 0)
			{
				foreach($rooms as $room)
				{
					/* @var $room \Debb\ManagementBundle\Entity\RackToRoom */
					foreach($item->getRacks() as $rack)
					{
						if($rack->getRack() != null)
						{
							$racks[$rack->getRack()->getId()] = $rack->getRack();
						}
					}
				}
			}
			if($item instanceof Rack)
			{
				$racks[$item->getId()] = $item;
			}
			if(count($racks) > 0)
			{
				foreach($racks as $rack)
				{
					/* @var $nodeGroup \Debb\ManagementBundle\Entity\NodegroupToRack */
					foreach($rack->getNodeGroups() as $nodeGroup)
					{
						if($nodeGroup->getNodegroup() != null)
						{
							$nodeGroups[$nodeGroup->getNodegroup()->getId()] = $nodeGroup->getNodegroup();
						}
					}
				}
			}
			if($item instanceof NodeGroup)
			{
				$nodeGroups[$item->getId()] = $item;
			}
			if(count($nodeGroups) > 0)
			{
				foreach($nodeGroups as $nodeGroup)
				{
					/* @var $node \Debb\ManagementBundle\Entity\NodeToNodegroup */
					foreach($nodeGroup->getNodes() as $node)
					{
						if($node->getNode() != null)
						{
							$nodes[$node->getNode()->getId()] = $node->getNode();
						}
					}
				}
			}
			if($item instanceof Node)
			{
				$nodes[$item->getId()] = $item;
			}

			/* loop every array (which we need!) and generate files */
			$zip->addEmptyDir('pics');
			$zip->addEmptyDir('objects');
			foreach($nodes as $node)
			{
				if($node instanceof Node)
				{
					/* @var $node Node */
					$controller = new NodeController();
					$controller->setContainer($this->getContainer());
					$zip->addFromString('Node_'.$node->getComponentId().'.xml', $controller->getDebbXml($node->getId(), true));
					if ($node->getImage() != null && file_exists($node->getImage()->getFullPath()))
					{
						$zip->addFile($node->getImage()->getFullPath(), 'pics/' . $node->getComponentId() . '.' . $node->getImage()->getExtension());
					}
					if ($node->getStlFile() != null)
					{
						$zip->addFile($node->getStlFile()->getFullPath(), 'objects/' . $node->getStlFile()->getName());
					}
					if ($node->getVrmlFile() != null)
					{
						$zip->addFile($node->getVrmlFile()->getFullPath(), 'objects/' . $node->getVrmlFile()->getName());
					}
				}
			}
			foreach($nodeGroups as $nodeGroup)
			{
				if($nodeGroup instanceof NodeGroup)
				{
					/* @var $nodeGroup NodeGroup */
					$controller = new NodeGroupController();
					$controller->setContainer($this->getContainer());
					$zip->addFromString('NodeGroup_'.$nodeGroup->getComponentId().'.xml', $controller->getDebbXml($nodeGroup->getId(), true));
				}
			}

			$plmXml = $this->asPlmXmlAction($id, true);
			$zip->addFromString('PLMXML_'.$item->getComponentId().'.xml', $plmXml);
			$room = new \Debb\ConfigBundle\Controller\RoomController();
			$room->setContainer($this->getContainer());
			$room->valide($plmXml, file_get_contents('../utils/PLMXMLSchema.xsd'), 'PLMXML');

			$zip->close();
			if(!$debug)
			{
				header('Content-Disposition: attachment; filename=' . date('Y-m-d-H-i-s') . '.zip');
				header('Content-type: application/zip');
				if (readfile($fileName))
				{
					unlink($fileName);
				}
			}
		}
		else
		{
			throw $this->createNotFoundException($this->get('translator')->trans('could not create zip archive'));
		}
		exit(0);
	}

	/**
	 * @return string|User
	 */
	public function getUser()
	{
		return $this->container->get('security.context')->getToken()->getUser();
	}
}
