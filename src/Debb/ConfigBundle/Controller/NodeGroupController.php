<?php

namespace Debb\ConfigBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Localdev\AdminBundle\Controller\CRUDController;
use Symfony\Component\HttpFoundation\Request;
use Debb\ManagementBundle\Entity\NodeToNodegroup;

/**
 * @Route("/{_locale}/nodegroup", requirements={"_locale" = "en|de"}, defaults={"_locale" = "en"})
 */
class NodeGroupController extends CRUDController
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
		$nodes = $this->getEntities('DebbConfigBundle:Node');

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
				'nodes' => $nodes
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

		$xml = new \SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><DEBBComponents />');
		$xmlComputeBoxTwo = $xml->addChild('ComputeBox2');
		$xmlComputeBoxOne = $xmlComputeBoxTwo->addChild('ComputeBox1');
		$nodegroup = $item->getDebbXmlArray();
		\Debb\ManagementBundle\Entity\Base::array_to_xml($nodegroup, $xmlComputeBoxOne);
		echo str_replace('<DEBBComponents>', '<xsd_1:DEBBComponents xmlns:xsd_1="http://www.coolemall.eu/DEBBComponent"
	xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
	xsi:schemaLocation="http://www.coolemall.eu/DEBBComponent DEBBComponents.xsd "><Name>CoolEmAll</Name><Description>Generated DEBBComponent File</Description>', str_replace('</DEBBComponents>', '</xsd_1:DEBBComponents>', $xml->asXML()));

		return $response;
	}

}
