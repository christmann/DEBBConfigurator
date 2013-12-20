<?php

namespace Debb\ConfigBundle\Form;

use Debb\ManagementBundle\Form\BaseType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Class RoomType
 * @package Debb\ConfigBundle\Form
 * @author Patrick Bußmann <patrick.bussmann@christmann.info>
 */
class RoomType extends BaseType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
			->add('componentId', null, array('required' => false))
			->add('name', null, array('required' => false, 'attr' => array('class' => 'noBreakAfterThis')))
            ->add('building', null, array('required' => false))
			->add('sizeX', 'hidden', array('required' => false))
			->add('sizeY', 'number', array('required' => false, 'label' => 'SizeY', 'attr' => array('class' => 'noBreakAfterThis')))
			->add('xmlName', null, array('required' => false))
			->add('costsEur', 'decimal', array('attr' => array('class' => 'noBreakAfterThis'), 'required' => false))
			->add('costsEnv', 'decimal', array('required' => false))
            ->add('meshResolution', null, array('required' => false, 'attr' => array('placeholder' => '0 0 0', 'class' => 'noBreakAfterThis')))
            ->add('locationInMesh', null, array('required' => false, 'attr' => array('placeholder' => '0 0 0')))
			->add('sizeZ', 'hidden', array('required' => false))
            ->add('racks', 'collection', array(
				'type' => new \Debb\ManagementBundle\Form\RackToRoomType(),
				'allow_add' => true,
				'allow_delete' => true,
				'by_reference' => false,
				'required' => false,
			))
	        ->add('flowPumps', 'collection', array(
		        'type' => new \Debb\ManagementBundle\Form\FlowPumpToRoomType(),
		        'allow_add' => true,
		        'allow_delete' => true,
		        'by_reference' => false,
		        'required' => false,
	        ))
			->add('references', 'plupload', array(
					'filter' => array('wrl,vrml' => 'VRML', 'stl' => 'STL'),
					'label' => 'Upload model files',
					'bootstrap' => true,
					'multiple' => true,
					'showMaxSize' => true,
				)
			)
			->add('coolingDevices', 'entity', array('class' => 'DebbManagementBundle:CoolingDevice', 'multiple' => true, 'expanded' => true, 'query_builder' => $this->userQueryBuilder))
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Debb\ConfigBundle\Entity\Room'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'debb_configbundle_roomtype';
    }
}
