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

namespace CoolEmAll\UserBundle\EventListener;

use CoolEmAll\UserBundle\Entity\User;
use Debb\ManagementBundle\Entity\Base;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Symfony\Component\DependencyInjection\Container;

/**
 * Class AddUserToEntityListener
 * @package CoolEmAll\UserBundle\EventListener
 *
 * @author Patrick Bußmann <patrick.bussmann@christmann.info>
 */
class AddUserToEntityListener
{
	/**
	 * @var \Symfony\Component\DependencyInjection\Container
	 */
	private $container;

	/**
	 * @param Container $container
	 */
	public function __construct(Container $container)
	{
		$this->container = $container;
	}

	/**
	 * @param LifecycleEventArgs $args
	 */
	public function prePersist(LifecycleEventArgs $args)
	{
		$user = $this->getUser();
		if($user instanceof User)
		{
			$entity = $args->getEntity();
			$entityManager = $args->getEntityManager();
			if(method_exists($entity, 'setUser') && method_exists($entity, 'getUser') && $entity->getUser() === null)
			{
				$entity->setUser($user);
			}
		}
	}

	/**
	 * Copied from below @see
	 * @see \Symfony\Bundle\FrameworkBundle\Controller\Controller::getUser()
	 */
	public function getUser()
	{
		if (!$this->container->has('security.context')) {
			throw new \LogicException('The SecurityBundle is not registered in your application.');
		}

		if (null === $token = $this->container->get('security.context')->getToken()) {
			return null;
		}

		if (!is_object($user = $token->getUser())) {
			return null;
		}

		return $user;
	}
}