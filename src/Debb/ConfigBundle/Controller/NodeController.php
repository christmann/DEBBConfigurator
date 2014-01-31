<?php
/**
 * DEBBConfigurator - A configurator for DEBB component and PLMXML files
 * Copyright (C) 2013-2014 christmann informationstechnik + medien GmbH & Co. KG
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Library General Public
 * License as published by the Free Software Foundation; either
 * version 2 of the License, or (at your option) any later version.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
 * Library General Public License for more details.
 *
 * You should have received a copy of the GNU Library General Public
 * License along with this library; if not, write to the
 * Free Software Foundation, Inc., 51 Franklin St, Fifth Floor,
 * Boston, MA  02110-1301, USA.
 */

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
	 * @Route("/form/{id}-{duplicated}", defaults={"id"=0, "duplicated"=0}, requirements={"id"="\d+|", "duplicated"="0|1|"});
	 * @Template()
	 *
	 * @param Request                                   $request  Request object
	 * @param int                                       $id       item id
	 * @param int										$duplicated 1/0 true/false is duplicated?
	 * @return array
	 */
	public function formAction(Request $request, $id = 0, $duplicated = 0)
	{
		/** @var $item Node */
		$GLOBALS['user_bypass'] = $this->getUser();
		$item = $this->getEntity($id);

		$typSpecsInUse = $this->getRepository('DebbManagementBundle:NodeToNodegroup')->findBy(array('node' => $item));
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

		$typeUse = array();
		foreach($typSpecsInUse as $typeInUse)
		{
			$typeUse[] = (string) $typeInUse;
		}
		$typeUse = array_unique($typeUse);
		unset($typSpecsInUse);

		return $this->render($this->resolveTemplate(__METHOD__), array(
				'form' => $form->createView(),
				'nodeTypes' => $this->getNodeTypesQuery()->execute(),
				'item' => $item,
				'isTypeInUse' => $typeUse
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
