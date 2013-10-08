<?php

namespace Debb\ConfigBundle\Controller;

use CoolEmAll\UserBundle\Entity\User;
use Debb\ConfigBundle\Entity\Node;
use Localdev\AdminBundle\Util\ControllerUtils;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Debb\ManagementBundle\Entity\Component;

/**
 * @author Patrick Bußmann <patrick.bussmann@christmann.info>
 * @Route("/{_locale}/node", requirements={"_locale" = "en|de"}, defaults={"_locale" = "en"})
 */
class NodeController extends XMLController
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
		/** @var $item Node */
		$item = $this->getEntity($id);

		$typSpecsInUse = $this->getRepository('DebbManagementBundle:NodeToNodegroup')->findOneBy(array('node' => $item));
		if(count($typSpecsInUse) > 0)
		{
			$item->lockType();
		}

		if ($request->getMethod() != 'POST')
		{
			/* define required components */
			$required = array(
				Component::TYPE_BASEBOARD => false,
				Component::TYPE_PROCESSOR => false,
				Component::TYPE_COOLING_DEVICE => false,
				Component::TYPE_POWER_SUPPLY => false,
				Component::TYPE_MEMORY => false,
				Component::TYPE_HEATSINK => false
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
					$component->setAmount(0);
					$item->addComponent($component);
				}
			}

			$this->getManager()->persist($item);
		}

		/* copied rest of CRUDController::formAction() */
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
				'nodeTypes' => $this->getNodeTypesQuery()->execute(),
				'item' => $item,
				'isTypInUse' => count($typSpecsInUse) > 0
			));
	}

	/**
	 * Get the node types query
	 *
	 * @return \Doctrine\ORM\Query
	 */
	public function getNodeTypesQuery()
	{
		$nodeTypesQuery = $this->getManager()->createQuery('SELECT node.type FROM DebbConfigBundle:Node node WHERE node.type IS NOT NULL AND node.user '
						  . ($this->getUser() instanceof User ? '= :user' : 'IS NULL') . ' GROUP BY node.type');
		if($this->getUser() instanceof User)
		{
			$nodeTypesQuery->setParameter('user', $this->getUser());
		}

		return $nodeTypesQuery;
	}
}
