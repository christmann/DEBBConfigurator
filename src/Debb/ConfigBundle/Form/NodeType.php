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
        $builder
			->remove('instanceName')
            ->add('sizeX', null, array('attr' => array('class' => 'noBreakAfterThis'), 'required' => false, 'label' => 'SizeX'))
            ->add('sizeY', null, array('required' => false, 'label' => 'SizeY'))
            ->add('sizeZ', null, array('attr' => array('class' => 'noBreakAfterThis'), 'required' => false, 'label' => 'SizeZ'))
			->add('meshResolution', null, array('required' => false, 'attr' => array('placeholder' => '0 0 0')))
			->add('instanceName', null, array('attr' => array('class' => 'noBreakAfterThis'), 'required' => false))
			->add('locationInMesh', null, array('required' => false, 'attr' => array('placeholder' => '0 0 0')))
            ->add('components', 'collection', array(
				'type' => new ComponentType($this->container),
				'allow_add' => true,
				'allow_delete' => true,
				'by_reference' => false,
				'required' => false,
			))
            ->add('image', 'plupload', array('required' => false, 'label' => 'upload node image', 'placeholder' => true,
				'bootstrap' => true, 'showMaxSize' => true))
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
			->add('networks', 'entity', array('attr' => array('useRow' => true),
				'class' => 'DebbManagementBundle:Network', 'multiple' => true, 'expanded' => true, 'query_builder' => $this->userQueryBuilder))
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
