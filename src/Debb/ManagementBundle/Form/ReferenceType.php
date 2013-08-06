<?php

namespace Debb\ManagementBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ReferenceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('file', 'plupload', array('filter' => array('wrl,vrml' => 'VRML', 'stl' => 'STL'), 'label' => 'upload vrml model', 'bootstrap' => true))
	        //        ->add('vrmlFile', 'plupload', array('required' => false, 'filter' => array('vrml,wrl' => 'VRML'), 'label' => 'upload vrml model', 'bootstrap' => true))
	        //        ->add('stlFile', 'plupload', array('required' => false, 'filter' => array('stl' => 'STL'), 'label' => 'upload stl model', 'bootstrap' => true))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Debb\ManagementBundle\Entity\Reference'
        ));
    }

    public function getName()
    {
        return 'debb_managementbundle_referencetype';
    }
}
