<?php

namespace Debb\ManagementBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class FlowPumpType extends DEBBSimpleType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
	    parent::buildForm($builder, $options);
		$transform = $builder->get('transform');
		$references = $builder->get('references');

        $builder
			->remove('transform')
			->remove('references')
	        ->add('sizeX', null, array('required' => false, 'attr' => array('class' => 'noBreakAfterThis'), 'label' => 'SizeX'))
	        ->add('sizeY', null, array('required' => false, 'label' => 'SizeY'))
	        ->add('sizeZ', null, array('required' => false, 'attr' => array('class' => 'noBreakAfterThis'), 'label' => 'SizeZ'))
	        ->add('maxRPM', null, array('required' => false))
	        ->add('efficiency', null, array('required' => false, 'attr' => array('class' => 'noBreakAfterThis')))
			->add('inlet', 'choice', array('choices' => array(0 => 'Outlet', 1 => 'Inlet'), 'label' => 'Mode'))
			->add($transform)
			->add($references)
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Debb\ManagementBundle\Entity\FlowPump'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'debb_managementbundle_flowpump';
    }
}
