<?php

namespace Debb\ManagementBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class MainboardType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('manufacturer')
            ->add('product', null, array('attr' => array('class' => 'noBreakAfterThis')))
            ->add('model')
            ->add('description', null, array('attr' => array('class' => 'noBreakAfterThis')))
            ->add('socket', 'text')
            ->add('connections', null, array('attr' => array('class' => 'bigTextbox')))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Debb\ManagementBundle\Entity\Mainboard'
        ));
    }

    public function getName()
    {
        return 'debb_managementbundle_mainboardtype';
    }
}
