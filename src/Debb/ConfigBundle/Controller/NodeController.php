<?php

namespace Debb\ConfigBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Localdev\AdminBundle\Controller\CRUDController;
use Symfony\Component\HttpFoundation\Request;
use Debb\ManagementBundle\Entity\Component;

/**
 * @Route("/{_locale}/node", requirements={"_locale" = "en|de"}, defaults={"_locale" = "en"})
 */
class NodeController extends CRUDController
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

		if ($request->getMethod() != 'POST' && $item->getId() < 1)
		{
			/* define required components */
			$required = array(
				Component::TYPE_PROCESSOR => false,
				Component::TYPE_COOLING_DEVICE => false,
				Component::TYPE_POWER_SUPPLY => false,
				Component::TYPE_MEMORY => false,
				Component::TYPE_STORAGE => false
			);

			/* check components */
			$components = $item->getComponents();
			foreach ($components as $component)
			{
				foreach ($required as $key => $val)
				{
					if ($component->getType() == $key)
					{
						$required[$key] = true;
						continue;
					}
				}
			}

			/* create required components */
			foreach ($required as $key => $val)
			{
				if ($val == false)
				{
					$component = new Component();
					$component->setType($key);
					$item->addComponent($component);
				}
			}

			$this->getManager()->persist($item);
		}

		/* copied rest of CRUDController::formAction() */
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
				'item' => $item
			));
	}

	/**
	 * Download entity as xml file
	 *
	 * @Route("/xml/{id}", defaults={"id"=0}, requirements={"id"="\d+|"});
	 *
	 * @param int                                       $id       item id
	 *
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function asXmlAction($id = 0)
	{
		$response = new \Symfony\Component\HttpFoundation\Response();
		$response->headers->set('Content-Type', 'text/xml');

		$item = $this->getEntity($id);

		$xml = new \SimpleXMLElement("<?xml version=\"1.0\"?><test />");
		\Debb\ManagementBundle\Entity\Base::array_to_xml($item->getXmlArray(), $xml);
		echo $xml->asXML();

		return $response;
	}

}
