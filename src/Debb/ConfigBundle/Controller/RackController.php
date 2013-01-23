<?php

namespace Debb\ConfigBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Localdev\AdminBundle\Controller\CRUDController;
use Symfony\Component\HttpFoundation\Request;
use Debb\ManagementBundle\Entity\NodeToNodegroup;
use Debb\ManagementBundle\Entity\NodegroupToRack;

/**
 * @Route("/{_locale}/rack", requirements={"_locale" = "en|de"}, defaults={"_locale" = "en"})
 */
class RackController extends CRUDController
{

	/**
	 * Creates a new entity
	 *
	 * @Route("/form/{id}", defaults={"id"=0}, requirements={"id"="\d+|"});
	 * @Template()
	 *
	 * @param Request                                   $request  Request object
	 * @param int                                       $id       item id
	 *
	 * @return array
	 */
	public function formAction(Request $request, $id = 0)
	{
		$item = $this->getEntity($id);
		$nodegroups = $this->getEntities('DebbConfigBundle:NodeGroup');

		if ($request->getMethod() != 'POST' && count($item->getNodeGroups()) < 1)
		{
			while (count($item->getNodeGroups()) < 42)
			{
				/* create required node groups */
				$nodeGroup = new NodegroupToRack();
				$nodeGroup->setField($item->getFreeNodeGroup());
				$item->addNodeGroup($nodeGroup);
			}

			$this->getManager()->persist($item);
		}

		$form = $this->createForm($this->getFormType($item), $item);
		if ($request->getMethod() == 'POST')
		{
			$form->bind($request);

			if ($form->isValid())
			{
				$this->persistEntity($item);
				$this->addSuccessMsg("localdev_admin.messages.saved");
			}
		}

		return $this->render($this->resolveTemplate(__METHOD__), array(
				'form' => $form->createView(),
				'item' => $item,
				'nodegroups' => $nodegroups
			));
	}

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

		$item = $this->getEntity($id);

		$xml = new \SimpleXMLElement("<?xml version=\"1.0\"?><Rack />");
		$rack = $item->getXmlArray();
		$rack = $rack['Rack'];
		\Debb\ManagementBundle\Entity\Base::array_to_xml($rack, $xml);
		echo $xml->asXML();

		return $response;
	}

}
