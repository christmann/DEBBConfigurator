<?php

namespace Debb\ManagementBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CoolingDeviceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('manufacturer')
            ->add('product', null, array('attr' => array('class' => 'noBreakAfterThis')))
            ->add('model')
            ->add('maxPower', null, array('attr' => array('class' => 'noBreakAfterThis')))
            ->add('maxCoolingCapacity')
            ->add('maxAirThroughput', null, array('attr' => array('class' => 'noBreakAfterThis')))
            ->add('maxWaterThroughput')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Debb\ManagementBundle\Entity\CoolingDevice'
        ));
    }

    public function getName()
    {
        return 'debb_managementbundle_coolingdevicetype';
    }
}
