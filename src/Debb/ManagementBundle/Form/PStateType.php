<?php

namespace Debb\ManagementBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Class PStateType
 * @package Debb\ManagementBundle\Form
 * @author Patrick Bußmann <patrick.bussmann@christmann.info>
 */
class PStateType extends AbstractType
{
	/**
	 * @param FormBuilderInterface $builder
	 * @param array $options
	 */
	public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('frequency')
            ->add('voltage')
	        ->add('loadPowerUsages', 'collection', array(
		        'type' => new PStateLoadPowerUsageType(),
		        'allow_add' => true,
		        'allow_delete' => true,
		        'by_reference' => false,
		        'required' => false,
		        'label' => 'Load power usages',
	        ))
        ;
    }

	/**
	 * @param OptionsResolverInterface $resolver
	 */
	public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Debb\ManagementBundle\Entity\PState'
        ));
    }

	/**
	 * @return string
	 */
	public function getName()
    {
        return 'debb_managementbundle_pstatetype';
    }
}
