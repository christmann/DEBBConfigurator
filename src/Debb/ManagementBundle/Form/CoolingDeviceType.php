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
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Class CoolingDeviceType
 * @package Debb\ManagementBundle\Form
 * @author Patrick Bußmann <patrick.bussmann@christmann.info>
 */
class CoolingDeviceType extends BaseType
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
			->add('fanEfficiency', 'decimal', array('required' => false))
			->add('coolingCoilEfficiency', 'decimal', array('required' => false, 'attr' => array('class' => 'noBreakAfterThis')))
			->add('deltaThEx', 'decimal', array('required' => false))
			->add('maxCoolingCapacity', 'decimal', array('required' => false, 'attr' => array('class' => 'noBreakAfterThis')))
			->add('coolingCapacityRated', 'decimal', array('required' => false))
			->add('eERRated', 'decimal', array('required' => false))
			->add('energyEfficiencyRatio', 'collection', array(
				'type' => new CoolingEERType(),
				'allow_add' => true,
				'allow_delete' => true,
				'by_reference' => false,
				'required' => false,
				'label' => 'Energy efficiency ratio'
			))
			->add('deltaThDryCooler', 'decimal', array('required' => false, 'attr' => array('class' => 'noBreakAfterThis')))
			->add('dryCoolerEfficiency', 'decimal', array('required' => false))
        ;
    }

	/**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Debb\ManagementBundle\Entity\CoolingDevice'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'debb_managementbundle_coolingdevicetype';
    }

	/**
	 * @return array the array with valid classes
	 */
	public static function getClasses($inclKeys = false)
	{
		$ret = array();
		foreach(array('CRAH', 'Free-cooling', 'Refrigeration', 'Heatpipe', 'ILC', 'LCU', 'HVAC') as $class)
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
