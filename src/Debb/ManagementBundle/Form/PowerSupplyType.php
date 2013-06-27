<?php

namespace Debb\ManagementBundle\Form;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Class PowerSupplyType
 * @package Debb\ManagementBundle\Form
 * @author Patrick Bußmann <patrick.bussmann@christmann.info>
 */
class PowerSupplyType extends BaseType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
	    parent::buildForm($builder, $options);
        $builder
            ->add('efficiency', 'text', array('attr' => array('class' => 'noBreakAfterThis')))
            ->add('totalOutputPower')
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Debb\ManagementBundle\Entity\PowerSupply'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'debb_managementbundle_powersupplytype';
    }
}
