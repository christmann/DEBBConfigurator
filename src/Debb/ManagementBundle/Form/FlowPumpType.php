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

namespace Debb\ManagementBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Class FlowPumpType
 * @package Debb\ManagementBundle\Form
 * @author Patrick Bußmann <patrick.bussmann@christmann.info>
 */
class FlowPumpType extends DEBBSimpleType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
	    parent::buildForm($builder, $options);
		$transform = $builder->get('transform');
		$references = $builder->get('references');

        $builder
			->remove('transform')
			->remove('references')
	        ->add('sizeX', null, array('required' => false, 'attr' => array('class' => 'noBreakAfterThis'), 'label' => 'SizeX'))
	        ->add('sizeY', null, array('required' => false, 'label' => 'SizeY'))
	        ->add('sizeZ', null, array('required' => false, 'attr' => array('class' => 'noBreakAfterThis'), 'label' => 'SizeZ'))
	        ->add('maxRPM', null, array('required' => false))
	        ->add('efficiency', null, array('required' => false, 'attr' => array('class' => 'noBreakAfterThis')))
			->add('inlet', 'choice', array('choices' => array(0 => 'Outlet', 1 => 'Inlet'), 'label' => 'Mode'))
			->add($transform)
			->add($references)
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Debb\ManagementBundle\Entity\FlowPump'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'debb_managementbundle_flowpump';
    }
}
