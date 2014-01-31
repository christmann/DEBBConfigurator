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
 * Class DEBBSimpleType
 * @package Debb\ManagementBundle\Form
 * @author Patrick Bußmann <patrick.bussmann@christmann.info>
 */
class DEBBSimpleType extends BaseType
{
	/**
	 * @param FormBuilderInterface $builder
	 * @param array $options
	 */
	public function buildForm(FormBuilderInterface $builder, array $options)
    {
	    parent::buildForm($builder, $options);
        $builder
            ->add('transform', null, array('attr' => array('placeholder' => '1 0 0 0 0 1 0 0 0 0 1 0 0 0 0 1'),
		        'label_attr' => array(
			        'data-title' => 'Annotation',
			        'data-content' => 'The Transform tag is necessary for all part
								which are located within a Component i.e. fans within a RECS or
								sensors or. For The root object of a DEBB it is not used.
								For all parts at a fixed position within the DEBB (fans, sensors,
								etc.) this is the transform matrix relative to the DEBB origin.
								For DEBBComponents this is the relative position of the
								connector to the DEBB\'s origin. By &quot;adding&quot; the relative
								transforms the resulting transform can be directly used for
	                            PLMXML.',
			        'data-toggle' => 'tooltip'
		        ),))
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
	 * @param OptionsResolverInterface $resolver
	 */
	public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Debb\ManagementBundle\Entity\DEBBSimple'
        ));
    }

	/**
	 * @return string
	 */
	public function getName()
    {
        return 'debb_managementbundle_debbsimpletype';
    }
}
