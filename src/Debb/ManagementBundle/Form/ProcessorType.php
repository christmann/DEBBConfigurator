<?php

namespace Debb\ManagementBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ProcessorType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('manufacturer', 'text')
            ->add('product', 'text', array('attr' => array('class' => 'noBreakAfterThis')))
            ->add('model', 'text')
            ->add('cores', 'text', array('attr' => array('class' => 'noBreakAfterThis')))
            ->add('maxFrequency', 'text')
            ->add('MaxPower', 'text', array('attr' => array('class' => 'noBreakAfterThis')))
            ->add('MaxClockSpeed', 'text')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Debb\ManagementBundle\Entity\Processor'
        ));
    }

    public function getName()
    {
        return 'debb_managementbundle_processortype';
    }
}
