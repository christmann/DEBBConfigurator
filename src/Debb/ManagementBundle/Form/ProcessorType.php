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

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Class ProcessorType
 * @package Debb\ManagementBundle\Form
 * @author Patrick Bußmann <patrick.bussmann@christmann.info>
 */
class ProcessorType extends BaseType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
	    parent::buildForm($builder, $options);
        $builder
			->add('MaxClockSpeed', 'text', array('attr' => array('class' => 'noBreakAfterThis')))
			->add('VirtualCoresPerCore', 'number', array('required' => false))
			->add('cores', 'text', array('attr' => array('class' => 'noBreakAfterThis'), 'required' => false))
            ->add('tdp', 'decimal', array('required' => false))
	        ->add('pstates', 'collection', array(
		        'type' => new PStateType(),
		        'allow_add' => true,
		        'allow_delete' => true,
		        'by_reference' => false,
		        'required' => false,
	            'attr' => array('class' => 'noBreakAfterThis'),
	            'label' => 'PStates',
	        ))
	        ->add('cstates', 'collection', array(
		        'type' => new CStateType(),
		        'allow_add' => true,
		        'allow_delete' => true,
		        'by_reference' => false,
		        'required' => false,
	            'label' => 'CStates',
	        ))
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Debb\ManagementBundle\Entity\Processor'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'debb_managementbundle_processortype';
    }
}
