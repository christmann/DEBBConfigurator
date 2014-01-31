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
