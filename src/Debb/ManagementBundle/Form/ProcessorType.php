<?php

namespace Debb\ManagementBundle\Form;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Class ProcessorType
 * @package Debb\ManagementBundle\Form
 * @author Patrick Bußmann <patrick.bussmann@christmann.info>
 */
class ProcessorType extends BaseType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
	    parent::buildForm($builder, $options);
        $builder
			->add('MaxClockSpeed', 'text')
			->add('cores', 'text', array('attr' => array('class' => 'noBreakAfterThis')))
            ->add('tdp', 'text')
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Debb\ManagementBundle\Entity\Processor'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'debb_managementbundle_processortype';
    }
}
