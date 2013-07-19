<?php
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
			if($entity instanceof Base && method_exists($entity, 'setUser') && method_exists($entity, 'getUser') && $entity->getUser() === null)
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