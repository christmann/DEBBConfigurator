<?php

namespace Debb\ConfigBundle\Twig;

use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * {@inheritdoc}
 * @author Patrick Bußmann <patrick.bussmann@christmann.info>
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
			new \Twig_SimpleFunction('component_type', array($this, 'componentType')),
			new \Twig_SimpleFunction('component_type_to_name', array($this, 'componentTypeIdToName')),
			new \Twig_SimpleFunction('svnEnabled', array($this, 'svnEnabled')),
		);
	}

	/**
	 * Get the type id of the specific type
	 * 
	 * @param string $prefix the prefix for the type id search
	 * @return integer the type id of the component with prefix $prefix
	 */
	public function componentType($prefix = 'NOTHING')
	{
		$type = 'TYPE_' . $prefix;
		return constant('\Debb\ManagementBundle\Entity\Component::' . strtoupper($type));
	}

	/**
	 * Check if the svn is enabled
	 *
	 * @return bool true if the svn function is enabled or false if not
	 */
	public function svnEnabled()
	{
		return $this->container->getParameter('debb.configbundle.svn_path') != false && $this->container->getParameter('debb.configbundle.svn_url') !== null;
	}

	/**
	 * {@inheritdoc}
	 */
	public function getName()
	{
		return 'configbundle_extension';
	}

}
