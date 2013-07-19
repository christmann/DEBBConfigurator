<?php
namespace Debb\ManagementBundle\Repository;

use CoolEmAll\UserBundle\Entity\User;
use Doctrine\DBAL\LockMode;
use Doctrine\ORM\EntityRepository;

/**
 * Class BaseRepository
 * @package Debb\ManagementBundle\Repository
 *
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
			return $this->findBy(array('user' => null));
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
