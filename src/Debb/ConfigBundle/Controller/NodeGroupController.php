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

		if ($request->getMethod() != 'POST' && count($item->getNodes()) < 1)
		{
			while (count($item->getNodes()) < 18)
			{
				/* create required nodes */
				$node = new NodeToNodegroup();
				$node->setField($item->getFreeNode());
				$item->addNode($node);
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

		$xml = new \SimpleXMLElement("<?xml version=\"1.0\"?><NodeGroup />");
		$nodegroup = $item->getDebbXmlArray();
		$nodegroup = $nodegroup['NodeGroup'];
		\Debb\ManagementBundle\Entity\Base::array_to_xml($nodegroup, $xml);
		echo $xml->asXML();

		return $response;
	}

}
