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
		if($user instanceof User)
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
		return $this->findBy(array('user' => null));
	}
}
