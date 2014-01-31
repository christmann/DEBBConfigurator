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

use Debb\ConfigBundle\Controller\XMLController;
use Debb\ManagementBundle\Entity\Base;
use Localdev\AdminBundle\Controller\CRUDController;
use Localdev\AdminBundle\Util\ControllerUtils;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Used for user specific entities
 *
 * @author Patrick Bußmann <patrick.bussmann@christmann.info>
 */
class BaseController extends CRUDController
{
	/**
	 * @inheritdoc
	 */
	protected function getEntities($repository = '')
	{
		return $this->getRepository($repository)->findAllFromUser($this->getUser());
	}

	/**
	 * Check if the entity is in use
	 *
	 * @param $entity the entity to check (should have a getParents method)
	 * @return bool true if the entity is in use or false if not
	 */
	public function isEntityInUse($entity)
	{
		return is_callable(array($entity, 'getParents')) ? count($entity->getParents()) > 0 : false;
	}

	/**
	 * Removes an entity
	 *
	 * @Route("/remove/{id}")
	 *
	 * @param int   $id     item id
	 *
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse
	 */
	public function removeAction($id)
	{
		return $this->isEntityInUse($this->getEntity($id)) ? new JsonResponse(array('error' => 'entity is used', 'errno' => 423), 423) : parent::removeAction($id);
	}

	/**
	 * @inheritdoc
	 */
	public function createForm($type, $data = null, array $options = array())
	{
		if($data instanceof Base && method_exists($data, 'setUser') && method_exists($data, 'getUser') && $data->getUser() === null)
		{
			$data->setUser($this->getUser());
		}
		return $this->container->get('form.factory')->create($type, $data, $options);
	}

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
		$item = $this->getEntity($id);

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
			'item' => $item
		));
	}

	/**
	 * Duplicate entity
	 *
	 * @Route("/duplicate/{id}", requirements={"id"="\d+"});
	 *
	 * @param int $id item id
	 *
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function duplicateAction($id)
	{
		$item = $this->getEntity($id);
		$itemNew = clone $item;
		$this->persistEntity($itemNew);
		return $this->redirect($this->generateUrl(ControllerUtils::getRouteName($this->getRequest(), '_form'), array('id' => $itemNew->getId(), 'duplicated' => 1)));
	}
}
