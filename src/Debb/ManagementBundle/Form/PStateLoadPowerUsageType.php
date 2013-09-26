<?php

namespace Debb\ManagementBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PStateLoadPowerUsageType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('lLoad', null, array('label' => 'Load [%]'))
            ->add('powerUsage')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Debb\ManagementBundle\Entity\PStateLoadPowerUsage'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'debb_managementbundle_pstateloadpowerusage';
    }
}
