<?php

namespace Debb\ManagementBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class HeatsinkType extends BaseType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
	    parent::buildForm($builder, $options);
        $builder
            ->add('type')
	        ->add('vrmlFile', 'plupload', array('required' => false, 'filter' => array('vrml,wrl' => 'VRML'), 'label' => 'upload vrml model', 'bootstrap' => true))
	        ->add('stlFile', 'plupload', array('required' => false, 'filter' => array('stl' => 'STL'), 'label' => 'upload stl model', 'bootstrap' => true))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Debb\ManagementBundle\Entity\Heatsink'
        ));
    }

    public function getName()
    {
        return 'debb_managementbundle_heatsinktype';
    }
}
