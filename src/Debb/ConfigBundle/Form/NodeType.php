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
            ->add('product', null, array('required' => false))
            ->add('manufacturer', null, array('required' => false))
            ->add('model', null, array('required' => false))
            ->add('sizeX', null, array('required' => false))
            ->add('sizeY', null, array('required' => false))
            ->add('sizeZ', null, array('required' => false))
            ->add('spaceTop', null, array('required' => false))
            ->add('spaceLeft', null, array('required' => false))
            ->add('spaceBottom', null, array('required' => false))
            ->add('spaceRight', null, array('required' => false))
            ->add('components', 'collection', array(
				'type' => new ComponentType(),
				'allow_add' => true,
				'allow_delete' => true,
				'by_reference' => false,
				'required' => false,
			))
            ->add('image', null, array('required' => false))
            ->add('vrmlFile', null, array('required' => false))
            ->add('stlFile', null, array('required' => false))
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
