<?php

namespace Debb\ConfigBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Class RoomType
 * @package Debb\ConfigBundle\Form
 * @author Patrick Bußmann <patrick.bussmann@christmann.info>
 */
class RoomType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
			->add('name', null, array('required' => false, 'attr' => array('class' => 'noBreakAfterThis')))
            ->add('building', null, array('required' => false))
			->add('sizeX', 'hidden', array('required' => false))
			->add('sizeY', 'number', array('required' => false, 'label' => 'SizeY', 'attr' => array('class' => 'noBreakAfterThis')))
            ->add('meshResolution', null, array('required' => false, 'attr' => array('placeholder' => '0 0 0')))
			->add('sizeZ', 'hidden', array('required' => false))
            ->add('racks', 'collection', array(
				'type' => new \Debb\ManagementBundle\Form\RackToRoomType(),
				'allow_add' => true,
				'allow_delete' => true,
				'by_reference' => false,
				'required' => false,
			))
			->add('references', 'plupload', array(
					'filter' => array('wrl,vrml' => 'VRML', 'stl' => 'STL'),
					'label' => 'Upload model files',
					'bootstrap' => true,
					'multiple' => true
				)
			)
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
