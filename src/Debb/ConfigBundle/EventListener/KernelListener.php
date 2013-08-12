<?php
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
		var_dump($deleteThisFiles);
		for($x = 0; $x < count($deleteThisFiles); $x++)
		{
			if(@unlink($deleteThisFiles[$x]))
			{
				unset($deleteThisFiles[$x]);
			}
		}
		$this->getSession($event->getKernel())->set('deletefile', $deleteThisFiles);
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