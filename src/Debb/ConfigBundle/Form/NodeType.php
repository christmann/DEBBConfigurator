<?php

namespace Debb\ConfigBundle\Form;

use Debb\ManagementBundle\Form\BaseType;
use Debb\ManagementBundle\Form\ComponentType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Class NodeType
 * @package Debb\ConfigBundle\Form
 * @author Patrick Bußmann <patrick.bussmann@christmann.info>
 */
class NodeType extends BaseType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
	    parent::buildForm($builder, $options);
		$xmlName = $builder->get('xmlName');
        $builder
			->remove('xmlName')
            ->add('sizeX', null, array('required' => false, 'attr' => array('class' => 'noBreakAfterThis'), 'label' => 'SizeX'))
            ->add('sizeY', null, array('required' => false, 'label' => 'SizeY'))
            ->add('sizeZ', null, array('required' => false, 'label' => 'SizeZ', 'attr' => array('class' => 'noBreakAfterThis')))
			->add($xmlName)
            ->add('meshResolution', null, array('required' => false, 'attr' => array('placeholder' => '0 0 0', 'class' => 'noBreakAfterThis')))
	        ->add('locationInMesh', null, array('required' => false, 'attr' => array('placeholder' => '0 0 0')))
            ->add('components', 'collection', array(
				'type' => new ComponentType($this->container),
				'allow_add' => true,
				'allow_delete' => true,
				'by_reference' => false,
				'required' => false,
			))
            ->add('image', 'plupload', array('required' => false, 'label' => 'upload node image', 'placeholder' => true, 'bootstrap' => true, 'showMaxSize' => true))
			->add('references', 'plupload', array(
					'filter' => array('wrl,vrml' => 'VRML', 'stl' => 'STL'),
					'label' => 'Upload model files',
					'bootstrap' => true,
					'multiple' => true,
					'showMaxSize' => true,
				)
			)
            ->remove('type')
			->add('type', 'hidden', array('required' => false, 'disabled' => (bool) $options['data']->isTypeLocked()))
			->add('networks', 'entity', array('class' => 'DebbManagementBundle:Network', 'multiple' => true, 'expanded' => true, 'query_builder' => $this->userQueryBuilder))
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
