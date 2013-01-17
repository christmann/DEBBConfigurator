<?php

namespace Debb\ManagementBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class MemoryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('manufacturer')
            ->add('product')
            ->add('model')
            ->add('maxPower')
            ->add('capacity')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Debb\ManagementBundle\Entity\Memory'
        ));
    }

    public function getName()
    {
        return 'debb_managementbundle_memorytype';
    }
}
