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
            ->add('model')
            ->add('manufacturer')
            ->add('product')
            ->add('components', 'collection', array(
				'type' => new ComponentType(),
				'allow_add' => true,
				'allow_delete' => true,
				'by_reference' => false,
			))
			->add('mainboard', 'entity', array(
				'class' => 'DebbManagementBundle:Mainboard',
				'query_builder' => function($repository) { return $repository->createQueryBuilder('p')->orderBy('p.id', 'ASC'); },
				'property' => 'name',
			))
            ->add('image', 'plupload')
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
