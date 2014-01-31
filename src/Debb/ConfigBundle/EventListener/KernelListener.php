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

namespace Debb\ConfigBundle\EventListener;

use Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\HttpKernel;
use Symfony\Component\HttpKernel\HttpKernelInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

/**
 * Class KernelListener
 * @package Debb\ConfigBundle\EventListener
 * @author Patrick Bußmann <patrick.bussmann@christmann.info>
 */
class KernelListener extends ContainerAware
{
	/**
	 * @param GetResponseEvent $event
	 */
	public function onKernelRequest(GetResponseEvent $event)
	{
		if ($event->getRequestType() !== HttpKernel::MASTER_REQUEST)
		{
			return;
		}
		$deleteThisFiles = $this->getSession()->has('deletefile') ? (array) $this->getSession()->get('deletefile') : array();
		if(count($deleteThisFiles) > 0)
		{
			for($x = 0; $x < count($deleteThisFiles); $x++)
			{
				if(@unlink($deleteThisFiles[$x]))
				{
					unset($deleteThisFiles[$x]);
				}
			}
			$this->getSession($event->getKernel())->set('deletefile', $deleteThisFiles);
		}
	}

	/**
	 * Get the session
	 *
	 * @return SessionInterface
	 */
	private function getSession()
	{
		return $this->container->get('session');
	}
}