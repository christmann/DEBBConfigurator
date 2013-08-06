<?php

namespace Debb\ManagementBundle\Form;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class DEBBSimpleType extends BaseType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
	    parent::buildForm($builder, $options);
        $builder
            ->add('transform')
            ->add('references', 'plupload', array(
		            'filter' => array('wrl,vrml' => 'VRML', 'stl' => 'STL'),
		            'label' => 'upload model files',
		            'bootstrap' => true,
		            'multiple' => true
	            )
            )
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Debb\ManagementBundle\Entity\DEBBSimple'
        ));
    }

    public function getName()
    {
        return 'debb_managementbundle_debbsimpletype';
    }
}
