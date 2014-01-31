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
		return $this->container->get('request')->getSession()->has('context');
	}

	/**
	 * {@inheritdoc}
	 */
	public function getName()
	{
		return 'configbundle_extension';
	}

}
