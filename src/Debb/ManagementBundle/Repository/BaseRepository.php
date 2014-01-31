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

namespace Debb\ManagementBundle\Repository;

use CoolEmAll\UserBundle\Entity\User;
use Doctrine\DBAL\LockMode;
use Doctrine\ORM\EntityRepository;

/**
 * Class BaseRepository
 * @package Debb\ManagementBundle\Repository
 * @author Patrick Bußmann <patrick.bussmann@christmann.info>
 */
class BaseRepository extends EntityRepository
{
	/**
	 * @param $user
	 * @return array
	 */
	public function findAllFromUser($user)
	{
		if($user instanceof User && $this->property_exists_depth($this->getEntityName(), 'user'))
		{
			return $this->findBy(array('user' => $user->getId()));
		}
		return $this->findAll();
	}

	/**
	 * @inheritdoc
	 */
	public function findAll()
	{
		if($this->property_exists_depth($this->getEntityName(), 'user'))
		{
			return $this->findBy(array('user' => array_key_exists('user_bypass', $GLOBALS) && $GLOBALS['user_bypass'] !== 'anon.' ? $GLOBALS['user_bypass'] : null));
		}
		return parent::findAll();
	}

	/**
	 * Checks if the object or class has a property (with parents)
	 *
	 * @param mixed $class <p>The class name or an object of the class to test for</p>
	 * @param string $property <p>The name of the property</p>
	 * @return bool true if the property exists, false if it doesn't exist or null in case of an error.
	 */
	public function property_exists_depth($class, $property)
	{
		foreach(array_merge(class_parents($class), array($class => $class)) as $className)
		{
			if(property_exists($className, $property))
			{
				return true;
			}
		}
		return false;
	}
}
