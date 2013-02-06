<?php

namespace Debb\ConfigBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

use Debb\ManagementBundle\Form\ComponentType;

class NodeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('product', null, array('required' => false))
            ->add('manufacturer', null, array('required' => false))
            ->add('model', null, array('required' => false))
            ->add('sizeX', null, array('required' => false))
            ->add('sizeY', null, array('required' => false))
            ->add('sizeZ', null, array('required' => false))
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
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Debb\ConfigBundle\Entity\Node'
        ));
    }

    public function getName()
    {
        return 'debb_configbundle_nodetype';
    }
}
