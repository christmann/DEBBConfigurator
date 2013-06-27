<?php

namespace Debb\ManagementBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class BaseType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder
			->add('manufacturer', null, array('attr' => array('class' => 'noBreakAfterThis'), 'required' => false))
			->add('product', null, array('required' => false))
		;
	}

	public function getName()
	{
		return 'base';
	}
}
