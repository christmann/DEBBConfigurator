<?php

namespace Debb\ManagementBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CoolingEERType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('lWT', null, array('label' => 'LWT',
		        'label_attr' => array(
			        'data-title' => 'Annotation',
			        'data-content' => 'Water temperature entering the chiller',
			        'data-toggle' => 'tooltip'
		        ),))
            ->add('cWT', null, array('label' => 'CWT',
		        'label_attr' => array(
			        'data-title' => 'Annotation',
			        'data-content' => 'Air temperature entering the condenser',
			        'data-toggle' => 'tooltip'
		        ),))
            ->add('capacity', null, array('label' => 'Capacity '))
            ->add('powerUsage', null, array('label' => 'Power usage'))
            ->add('eER', null, array('label' => 'EER'))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Debb\ManagementBundle\Entity\CoolingEER'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'debb_managementbundle_coolingeer';
    }
}
