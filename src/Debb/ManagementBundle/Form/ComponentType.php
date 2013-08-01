<?php

namespace Debb\ManagementBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Class ComponentType
 * @package Debb\ManagementBundle\Form
 * @author Patrick Bußmann <patrick.bussmann@christmann.info>
 */
class ComponentType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder
			->add('type', null, array('required' => true))
			->add('node', null, array('required' => false))
			->add('processor', null, array('required' => false))
			->add('baseboard', null, array('required' => false))
			->add('coolingDevice', null, array('required' => false))
			->add('memory', null, array('required' => false))
			->add('powersupply', null, array('required' => false))
			->add('heatsink', null, array('required' => false))
			->add('amount', 'choice', array('choices' => $this->getAmountChoices(), 'required' => false,
				'empty_value' => false, 'attr' => array('style' => 'width: 90px;')))
		;
	}

	/**
	 * @return array the choices for the amount select
	 */
	public function getAmountChoices()
	{
		$res = array();
		for($x = 0; $x < 100; $x++)
		{
			$res[$x] = $x;
		}
		return $res;
	}

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
	{
		$resolver->setDefaults(array(
			'data_class' => 'Debb\ManagementBundle\Entity\Component'
		));
	}

    /**
     * @return string
     */
    public function getName()
	{
		return 'debb_managementbundle_componenttype';
	}
}
