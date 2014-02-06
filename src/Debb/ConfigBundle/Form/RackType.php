<?php
/**
 * DEBBConfigurator - A configurator for DEBB component and PLMXML files
 * Copyright (C) 2013-2014 christmann informationstechnik + medien GmbH & Co. KG
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Library General Public
 * License as published by the Free Software Foundation; either
 * version 2 of the License, or (at your option) any later version.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
 * Library General Public License for more details.
 *
 * You should have received a copy of the GNU Library General Public
 * License along with this library; if not, write to the
 * Free Software Foundation, Inc., 51 Franklin St, Fifth Floor,
 * Boston, MA  02110-1301, USA.
 */

namespace Debb\ConfigBundle\Form;

use Debb\ManagementBundle\Form\BaseType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Class RackType
 * @package Debb\ConfigBundle\Form
 * @author Patrick Bußmann <patrick.bussmann@christmann.info>
 */
class RackType extends BaseType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
	    parent::buildForm($builder, $options);
        $builder
            ->remove('maxPower')
            ->add('sizeX', null, array('required' => false, 'label' => 'SizeX', 'attr' => array('class' => 'noBreakAfterThis')))
            ->add('sizeY', null, array('required' => false, 'label' => 'SizeY'))
            ->add('sizeZ', null, array('required' => false, 'label' => 'SizeZ', 'attr' => array('class' => 'noBreakAfterThis')))
			->add('spaceBottom', null, array('required' => false, 'label' => 'SpaceBottom'))
			->add('spaceLeft', null, array('required' => false, 'label' => 'SpaceLeft', 'attr' => array('class' => 'noBreakAfterThis')))
			->add('spaceFront', null, array('required' => false, 'label' => 'SpaceFront'))
			->add('nodeGroupSize', 'choice', array('choices' => $this->getNodeGroupSizeChoices(), 'required' => false, 'label' => 'RackSize',
				'empty_value' => false, 'attr' => array('class' => 'updateRackSize noBreakAfterThis')))
			->add('flowDirection', 'choice', array('required' => false, 'choices' => $this->getFlowDirections(true)))
	        ->add('meshResolution', null, array('required' => false, 'attr' => array('placeholder' => '0 0 0', 'class' => 'noBreakAfterThis')))
	        ->add('locationInMesh', null, array('required' => false, 'attr' => array('placeholder' => '0 0 0')))
	        ->add('currentPowerUsage', 'decimal', array('required' => false))
	        ->add('nodegroups', 'collection', array(
		        'type' => new \Debb\ManagementBundle\Form\NodegroupToRackType(),
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
        ;
    }

	/**
	 * @return array the choices for the node group size select box
	 */
	public function getNodeGroupSizeChoices()
	{
		$res = array();
		for($x = 1; $x < 50; $x++)
		{
			$res[$x] = $x;
		}
		return $res;
	}

	/**
	 * @return array the array with valid flow directions
	 */
	public static function getFlowDirections($inclKeys = false)
	{
		$ret = array();
		foreach(array('+x', '-x', '+y', '-y', '+z', '-z') as $class)
		{
			if($inclKeys)
			{
				$ret[$class] = $class;
			}
			else
			{
				$ret[] = $class;
			}
		}
		return $ret;
	}

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Debb\ConfigBundle\Entity\Rack'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'debb_configbundle_racktype';
    }
}
