<?php

namespace Debb\ConfigBundle\Form;

use Debb\ConfigBundle\Entity\Node;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

use Debb\ManagementBundle\Form\ComponentType;

/**
 * Class NodeType
 * @package Debb\ConfigBundle\Form
 * @author Patrick Bußmann <patrick.bussmann@christmann.info>
 */
class NodeType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('manufacturer')
            ->add('product', null, array('attr' => array('class' => 'noBreakAfterThis')))
            ->add('model')
            ->add('sizeX', null, array('required' => false, 'attr' => array('class' => 'noBreakAfterThis'), 'label' => 'SizeX'))
            ->add('sizeY', null, array('required' => false, 'label' => 'SizeY'))
            ->add('sizeZ', null, array('required' => false, 'label' => 'SizeZ'))
            ->add('spaceTop', null, array('required' => false, 'attr' => array('class' => 'noBreakAfterThis'), 'label' => 'SpaceTop'))
            ->add('spaceBottom', null, array('required' => false, 'label' => 'SpaceBottom'))
            ->add('spaceLeft', null, array('required' => false, 'attr' => array('class' => 'noBreakAfterThis'), 'label' => 'SpaceLeft'))
            ->add('spaceRight', null, array('required' => false, 'label' => 'SpaceRight'))
            ->add('components', 'collection', array(
				'type' => new ComponentType(),
				'allow_add' => true,
				'allow_delete' => true,
				'by_reference' => false,
				'required' => false,
			))
            ->add('image', 'plupload', array('required' => false))
            ->add('vrmlFile', 'hidden', array('required' => false))
            ->add('stlFile', 'hidden', array('required' => false))
			->add('type', 'choice', array('choices' => Node::getTypes(), 'required' => true, 'empty_value' => false))
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Debb\ConfigBundle\Entity\Node'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'debb_configbundle_nodetype';
    }
}
