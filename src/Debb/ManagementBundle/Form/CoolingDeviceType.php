<?php

namespace Debb\ManagementBundle\Form;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Class CoolingDeviceType
 * @package Debb\ManagementBundle\Form
 * @author Patrick Bußmann <patrick.bussmann@christmann.info>
 */
class CoolingDeviceType extends BaseType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
	    parent::buildForm($builder, $options);
        $builder
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
