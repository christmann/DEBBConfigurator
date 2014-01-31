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
 * Class ComponentType
 * @package Debb\ManagementBundle\Form
 * @author Patrick Bußmann <patrick.bussmann@christmann.info>
 */
class ComponentType extends BaseType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder
			->add('type', null, array('required' => true))
			->add('node', null, array('required' => false))
			->add('processor', null, array('required' => false, 'query_builder' => $this->userQueryBuilder))
			->add('baseboard', null, array('required' => false, 'query_builder' => $this->userQueryBuilder))
			->add('coolingDevice', null, array('required' => false, 'query_builder' => $this->userQueryBuilder))
			->add('memory', null, array('required' => false, 'query_builder' => $this->userQueryBuilder))
			->add('powersupply', null, array('required' => false, 'query_builder' => $this->userQueryBuilder))
			->add('heatsink', null, array('required' => false, 'query_builder' => $this->userQueryBuilder))
			->add('amount', 'choice', array('choices' => $this->getAmountChoices(), 'required' => false,
				'empty_value' => false, 'attr' => array('style' => 'width: 90px;')))
		;
	}

	/**
	 * @return array the choices for the amount select
	 */
	public function getAmountChoices()
	{
		$res = array();
		for($x = 0; $x < 100; $x++)
		{
			$res[$x] = $x;
		}
		return $res;
	}

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
	{
		$resolver->setDefaults(array(
			'data_class' => 'Debb\ManagementBundle\Entity\Component'
		));
	}

    /**
     * @return string
     */
    public function getName()
	{
		return 'debb_managementbundle_componenttype';
	}
}
