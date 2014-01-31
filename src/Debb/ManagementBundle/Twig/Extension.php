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

namespace Debb\ManagementBundle\Twig;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Form\FormView;

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
			'route_exists' => new \Twig_Function_Method($this, 'routeExists'),
			'renderState' => new \Twig_Function_Method($this, 'renderState'),
			'countUp' => new \Twig_Function_Method($this, 'countUp'),
		);
	}

	/**
	 * {@inheritdoc}
	 */
    public function getFilters()
    {
		return array(
			'dSort' => new \Twig_Filter_Method($this, 'dSort'),
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
	 * Set the field rendered state
	 *
	 * @param FormView $field the field to set the state from
	 * @param bool $state true if the field should be rendered or false if not
	 * @param bool $returnField true if we should return the $field or false = null
	 *
	 * @return FormView|bool the form field or the render state
	 */
	public function renderState(FormView $field, $state, $returnField = false)
	{
		$field->setRendered($state);
		if($state == false && $field->parent != null)
		{
			$field->parent->setRendered($state);
		}
		foreach($field->children as $child)
		{
			/* @var $child \Symfony\Component\Form\FormView */
			$this->renderState($child, $state);
		}
		return $returnField ? $field : $field->isRendered();
	}

	/**
	 * Count up a global variable
	 *
	 * @param string $globalVar the global variable to count
	 *
	 * @return integer the new number
	 */
	public function countUp($globalVar = 'x')
	{
		return @$GLOBALS[$globalVar]++;
	}

	/**
	 * Sort a array collection or a object array (the objects should have getId() and __toString())
	 * 
	 * @param array $array the doctrine array collection (or array with objects which contains getId() and __toString()) to sort
	 * @param boolean $reverse should we sort reverse? (false = ABCDEF... / true = ZYXWVU...)
	 * @return array the sorted and maybe reversed array with objects
	 */
	public function dSort($array = array(), $reverse=false)
	{
		$sortThis = array();
		foreach($array as $arr)
		{
			$sortThis[$arr->getId()] = $arr->__toString(); 
		}
		asort($sortThis);
		$newArray = array();
		foreach($sortThis as $id => $name)
		{
			foreach($array as $obj)
			{
				if($id == $obj->getId())
				{
					$newArray[] = $obj;
				}
			}
		}
		if($reverse)
		{
			$newArray = array_reverse($newArray);
		}
		return $newArray;
	}

	/**
	 * {@inheritdoc}
	 */
	public function getName()
	{
		return 'managementbundle_extension';
	}

}
