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
 * Class SensorType
 * @package Debb\ManagementBundle\Form
 * @author Patrick Bußmann <patrick.bussmann@christmann.info>
 */
class SensorType extends BaseType
{
	/**
	 * @param FormBuilderInterface $builder
	 * @param array $options
	 */
	public function buildForm(FormBuilderInterface $builder, array $options)
    {
	    parent::buildForm($builder, $options);
        $builder
            ->add('class', 'choice', array('choices' => $this->getClasses(true), 'attr' => array('class' => 'noBreakAfterThis')))
            ->add('unit', 'choice', array('choices' => $this->getUnits(true), 'label_attr' => array(
		        'data-title' => 'Annotation',
		        'data-content' => 'Only basic units should be used. For later
								development other units can be used then the Factor should be
								added.',
		        'data-toggle' => 'tooltip'
	        ),))
            ->add('minValue', null, array('required' => false, 'attr' => array('class' => 'noBreakAfterThis')))
            ->add('maxValue', null, array('required' => false))
            ->add('factor', null, array('required' => false, 'attr' => array('class' => 'noBreakAfterThis'), 'label_attr' => array(
		        'data-title' => 'Annotation',
		        'data-content' => 'Factor is just the multiplier between the
								currently used unit and the basic unit (i.e. litre to cubic
								meter)',
		        'data-toggle' => 'tooltip'
	        ),))
            ->add('accuracy', null, array('required' => false))
            ->add('input', null, array('required' => false, 'label_attr' => array(
		        'data-title' => 'Annotation',
		        'data-content' => 'Input is a flag describing that a sensors is a
								input value for the simulation or not. for example heat sources
								can be seen an sources without any output afterwards. Other
								sensors migth be added for extracting results at the end of the
								simulation.',
		        'data-toggle' => 'tooltip'
	        ),))
        ;
    }

	/**
	 * @param OptionsResolverInterface $resolver
	 */
	public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Debb\ManagementBundle\Entity\Sensor'
        ));
    }

	/**
	 * @return string
	 */
	public function getName()
    {
        return 'debb_managementbundle_sensortype';
    }

	/**
	 * @return array the array with valid classes
	 */
	public static function getClasses($inclKeys = false)
	{
		$ret = array();
		foreach(array('Temperature', 'Voltage', 'Power', 'Humidity', 'Throughput', 'Velocity') as $class)
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
	 * @return array the array with valid classes
	 */
	public static function getUnits($inclKeys = false)
	{
		$ret = array();
		foreach(array('°C', 'V', 'mV', 'kV', 'W', 'mW', 'kW', 'MW', '%', 'l/sec', 'l/min', 'l/h', 'm3/min', 'm3/h', 'm/s', 'km/h') as $class)
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
}
