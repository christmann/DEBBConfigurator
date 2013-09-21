<?php

namespace Debb\ManagementBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Class NetworkType
 * @package Debb\ManagementBundle\Form
 * @author Patrick Bußmann <patrick.bussmann@christmann.info>
 */
class NetworkType extends BaseType
{
	/**
	 * @param FormBuilderInterface $builder
	 * @param array $options
	 */
	public function buildForm(FormBuilderInterface $builder, array $options)
    {
	    parent::buildForm($builder, $options);
        $builder
            ->add('interface', null, array('attr' => array('class' => 'noBreakAfterThis'),
		        'label_attr' => array(
			        'data-title' => 'Annotation',
			        'data-content' => 'Physical Interface description like fibre, twisted pair, etc.',
			        'data-toggle' => 'tooltip'
		        ),))
            ->add('technology', null, array(
		        'label_attr' => array(
			        'data-title' => 'Annotation',
			        'data-content' => '10GE, IB QDR etc.',
			        'data-toggle' => 'tooltip'
		        ),))
            ->add('maxBandwidth', null, array(
		        'label_attr' => array(
			        'data-title' => 'Annotation',
			        'data-content' => 'Bandwidth as number in bit/s',
			        'data-toggle' => 'tooltip'
		        ),))
        ;
    }

	/**
	 * @param OptionsResolverInterface $resolver
	 */
	public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Debb\ManagementBundle\Entity\Network'
        ));
    }

	/**
	 * @return string
	 */
	public function getName()
    {
        return 'debb_managementbundle_networktype';
    }
}
