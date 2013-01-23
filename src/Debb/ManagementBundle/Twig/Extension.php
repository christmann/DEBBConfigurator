<?php

namespace Debb\ManagementBundle\Twig;

use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * {@inheritdoc}
 */
class Extension extends \Twig_Extension
{

	/**
	 * @var \Symfony\Component\DependencyInjection\ContainerInterface $container a container interface
	 */
	private $container;

	/**
	 * Creates the twig extension
	 * 
	 * @param \Symfony\Component\DependencyInjection\ContainerInterface $container the container interface of this project
	 */
	public function __construct(ContainerInterface $container)
	{
		$this->container = $container;
	}

	/**
	 * {@inheritdoc}
	 */
	public function getFunctions()
	{
		return array(
			'route_exists' => new \Twig_Function_Method($this, 'routeExists'),
		);
	}

	/**
	 * Check if a route exists
	 * 
	 * @param string $route the route to check
	 * @return boolean true if the $route exists else false
	 */
	public function routeExists($route)
	{
		$router = $this->container->get('router');

		$exists = false;
		foreach ($router->getRouteCollection()->all() as $key => $val)
		{
			if($route == $key)
			{
				$exists = true;
			}
		}
		return $exists;
	}

	/**
	 * {@inheritdoc}
	 */
	public function getName()
	{
		return 'managementbundle_extension';
	}

}
