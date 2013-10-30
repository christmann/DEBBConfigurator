<?php

namespace Debb\ManagementBundle\Form;

use CoolEmAll\UserBundle\Entity\User;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Class ConnectorExtendedType
 * @package Debb\ManagementBundle\Form
 * @author Patrick Bußmann <patrick.bussmann@christmann.info>
 */
class ConnectorExtendedType extends ConnectorType
{
	/**
	 * @param FormBuilderInterface $builder
	 * @param array $options
	 */
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		parent::buildForm($builder, $options);
		$builder
			->add('customPosX', 'hidden_decimal')
			->add('customPosY', 'hidden_decimal')
			->add('customPosZ', 'hidden_decimal')
		;
	}

	/**
	 * @return string
	 */
	public function getName()
	{
		return 'connectorextended';
	}
}
