<?php

namespace Debb\ManagementBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Class CoolingDeviceType
 * @package Debb\ManagementBundle\Form
 * @author Patrick Bußmann <patrick.bussmann@christmann.info>
 */
class CoolingDeviceType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
	        ->add('manufacturer', null, array('required' => false))
	        ->add('product', null, array('attr' => array('class' => 'noBreakAfterThis'), 'required' => false))
	        ->add('model', null, array('required' => false))
            ->add('maxPower', null, array('attr' => array('class' => 'noBreakAfterThis')))
            ->add('maxCoolingCapacity')
            ->add('maxAirThroughput', null, array('attr' => array('class' => 'noBreakAfterThis')))
            ->add('maxWaterThroughput')
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Debb\ManagementBundle\Entity\CoolingDevice'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'debb_managementbundle_coolingdevicetype';
    }
}
