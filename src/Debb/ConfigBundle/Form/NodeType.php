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
	        ->add('manufacturer', null, array('required' => false))
	        ->add('product', null, array('attr' => array('class' => 'noBreakAfterThis'), 'required' => false))
	        ->add('model', null, array('required' => false))
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
            ->add('image', 'plupload', array('required' => false, 'label' => 'upload node image', 'placeholder' => true, 'bootstrap' => true))
            ->add('vrmlFile', 'plupload', array('required' => false, 'filter' => array('vrml,wrl' => 'VRML'), 'label' => 'upload vrml model', 'bootstrap' => true))
            ->add('stlFile', 'plupload', array('required' => false, 'filter' => array('stl' => 'STL'), 'label' => 'upload stl model', 'bootstrap' => true))
			->add('type', 'hidden', array('required' => false))
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
