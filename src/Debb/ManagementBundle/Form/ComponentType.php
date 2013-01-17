<?php

namespace Debb\ManagementBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ComponentType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder
			->add('type', null, array('required' => true))
			->add('node', null, array('required' => false))
			->add('processor', null, array('required' => false))
			->add('mainboard', null, array('required' => false))
			->add('coolingDevice', null, array('required' => false))
			->add('memory', null, array('required' => false))
			->add('powersupply', null, array('required' => false))
			->add('storage', null, array('required' => false))
		;
	}

	public function setDefaultOptions(OptionsResolverInterface $resolver)
	{
		$resolver->setDefaults(array(
			'data_class' => 'Debb\ManagementBundle\Entity\Component'
		));
	}

	public function getName()
	{
		return 'debb_managementbundle_componenttype';
	}
}
