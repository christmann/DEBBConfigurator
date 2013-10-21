<?php

namespace Debb\ConfigBundle\Form;

use Debb\ManagementBundle\Form\BaseType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Class NodeGroupType
 * @package Debb\ConfigBundle\Form
 * @author Patrick Bußmann <patrick.bussmann@christmann.info>
 */
class NodeGroupType extends BaseType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
	    parent::buildForm($builder, $options);
        $builder
			->add('nodes', null, array('required' => false))
            ->add('sizeX', null, array('required' => false))
            ->add('sizeY', null, array('required' => false))
            ->add('sizeZ', null, array('required' => false))
            ->add('spaceLeft', null, array('required' => false))
            ->add('spaceRight', null, array('required' => false))
            ->add('spaceTop', null, array('required' => false))
            ->add('spaceBottom', null, array('required' => false))
            ->add('spaceFront', null, array('required' => false))
            ->add('spaceBehind', null, array('required' => false))
	        ->add('meshResolution', null, array('required' => false, 'attr' => array('placeholder' => '0 0 0')))
	        ->add('locationInMesh', null, array('required' => false, 'attr' => array('placeholder' => '0 0 0')))
            ->add('nodes', 'collection', array(
				'type' => new \Debb\ManagementBundle\Form\NodeToNodegroupType(),
				'allow_add' => true,
				'allow_delete' => true,
				'by_reference' => false,
				'required' => false,
			))
			->add('draft', 'entity', array(
				'class' => 'DebbManagementBundle:Chassis',
				'label' => 'Chassis',
	            'choices' => $this->container->get('doctrine')->getRepository('DebbManagementBundle:Chassis')->findAllFromUser($this->container->get('security.context')->getToken()->getUser())
			))
			->add('networks', 'entity', array('class' => 'DebbManagementBundle:Network', 'multiple' => true, 'expanded' => true, 'query_builder' => $this->userQueryBuilder))
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Debb\ConfigBundle\Entity\NodeGroup'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'debb_configbundle_nodegrouptype';
    }
}
