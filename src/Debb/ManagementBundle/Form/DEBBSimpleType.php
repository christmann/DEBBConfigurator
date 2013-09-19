<?php

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
            ->add('transform', null, array('attr' => array('placeholder' => '1 0 0 0 0 1 0 0 0 0 1 0 0 0 0 1')))
            ->add('references', 'plupload', array(
		            'filter' => array('wrl,vrml' => 'VRML', 'stl' => 'STL'),
		            'label' => 'Upload model files',
		            'bootstrap' => true,
		            'multiple' => true,
			        'showMaxSize' => true
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
