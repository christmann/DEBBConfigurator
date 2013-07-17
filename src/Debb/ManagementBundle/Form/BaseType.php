<?php

namespace Debb\ManagementBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Class BaseType
 * @package Debb\ManagementBundle\Form
 */
class BaseType extends AbstractType
{
	/**
	 * @param FormBuilderInterface $builder
	 * @param array $options
	 */
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder
			->add('manufacturer', null, array('attr' => array('class' => 'noBreakAfterThis'), 'required' => false))
			->add('product', null, array('required' => false))
			->add('label', null, array('required' => false))
		;
	}

	/**
	 * @return string
	 */
	public function getName()
	{
		return 'base';
	}
}
