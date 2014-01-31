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

namespace Debb\ManagementBundle\Controller;

use Debb\ConfigBundle\Controller\NodeController;
use Localdev\AdminBundle\Util\ControllerUtils;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use \Debb\ConfigBundle\Entity\Node;
use Symfony\Component\HttpFoundation\Request;

/**
 * @author Patrick Bußmann <patrick.bussmann@christmann.info>
 * @Route("/{_locale}/management/chassis", requirements={"_locale" = "en|de"}, defaults={"_locale" = "en"})
 */
class ChassisController extends BaseController
{
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
		/* @var $item \Debb\ManagementBundle\Entity\Chassis */
		$GLOBALS['user_bypass'] = $this->getUser();
		$item = $this->getEntity($id);
		$flowPumps = $this->getEntities('DebbManagementBundle:FlowPump');

		$form = $this->createForm($this->getFormType($item), $item, array('attr' => array('duplicated' => $duplicated)));
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

		$nodeController = new NodeController();
		$nodeController->setContainer($this->getContainer());

		return $this->render($this->resolveTemplate(__METHOD__), array(
			'form' => $form->createView(),
			'item' => $item,
			'nodetypspecs' => $nodeController->getNodeTypesQuery()->execute(),
            'duplicated' => $duplicated,
			'flowPumps' => $flowPumps
		));
	}
}
