<?php

namespace CoolEmAll\UserBundle\Form\Type;

use Symfony\Component\Form\FormBuilderInterface;
use FOS\UserBundle\Form\Type\ProfileFormType as BaseType;

/**
 * Class ProfileFormType
 * @package CoolEmAll\UserBundle\Form\Type
 * @author Patrick Bußmann <patrick.bussmann@christmann.info>
 */
class ProfileFormType extends BaseType
{
	/**
	 * @param FormBuilderInterface $builder
	 * @param array $options
	 */
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		parent::buildForm($builder, $options);

		$builder->add('plainPassword', 'password', array('required' => false));
	}

	/**
	 * @return string
	 */
	public function getName()
	{
		return 'coolemall_user_profile';
	}
}
