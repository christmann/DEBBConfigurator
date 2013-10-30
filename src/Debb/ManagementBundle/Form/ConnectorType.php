<?php

namespace Debb\ManagementBundle\Form;

use CoolEmAll\UserBundle\Entity\User;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Class ConnectorType
 * @package Debb\ManagementBundle\Form
 * @author Patrick Bußmann <patrick.bussmann@christmann.info>
 */
class ConnectorType extends AbstractType
{
	/**
	 * @param FormBuilderInterface $builder
	 * @param array $options
	 */
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder
			->add('posX', 'hidden')
			->add('posY', 'hidden')
			->add('posZ', 'hidden')
		;
	}

	/**
	 * @return string
	 */
	public function getName()
	{
		return 'connector';
	}
}
