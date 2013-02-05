<?php

namespace Debb\ConfigBundle\Twig;

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
			'component_type' => new \Twig_Function_Method($this, 'componentType'),
			'component_type_to_name' => new \Twig_Function_Method($this, 'componentTypeIdToName'),
		);
	}

	/**
	 * Get the type id of the specific type
	 * 
	 * @param type $prefix the prefix for the type id search
	 * @return integer the type id of the component with prefix $prefix
	 */
	public function componentType($prefix = 'NOTHING')
	{
		$type = 'TYPE_' . $prefix;
		return constant('\Debb\ManagementBundle\Entity\Component::' . $type);
	}

	/**
	 * {@inheritdoc}
	 */
	public function getName()
	{
		return 'configbundle_extension';
	}

}
