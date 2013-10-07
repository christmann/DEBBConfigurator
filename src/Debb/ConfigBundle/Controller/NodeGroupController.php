<?php

namespace Debb\ConfigBundle\Controller;

use Localdev\AdminBundle\Util\ControllerUtils;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Debb\ManagementBundle\Entity\NodeToNodegroup;

/**
 * @author Patrick Bußmann <patrick.bussmann@christmann.info>
 * @Route("/{_locale}/nodegroup", requirements={"_locale" = "en|de"}, defaults={"_locale" = "en"})
 */
class NodeGroupController extends XMLController
{
	/**
	 * @var string type of debbcomponent
	 */
	public $debbType = 'NodeGroup';

	/**
	 * @var string debb entity repository
	 */
	public $debbEntity = 'DebbConfigBundle:NodeGroup';

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
		$nodeGroups = array();
		foreach($nodes as $node)
		{
			$nodeGroups[$node->getType()][] = $node;
		}
		ksort($nodeGroups);

		$form = $this->createForm($this->getFormType($item), $item);
		if ($request->getMethod() == 'POST')
		{
			$form->submit($request);

			if ($form->isValid())
			{
				$this->persistEntity($item);
				$this->addSuccessMsg("localdev_admin.messages.saved");
				return $this->redirect($this->generateUrl(ControllerUtils::getRouteName($this->getRequest(), '_form'), array('id' => $item->getId())));
			}
		}

		return $this->render($this->resolveTemplate(__METHOD__), array(
				'form' => $form->createView(),
				'item' => $item,
				'nodeGroups' => $nodeGroups
			));
	}

}
