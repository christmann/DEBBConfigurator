<?php

namespace Debb\ConfigBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ImportDebbComponentsXmlType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('debbcomponentsxml', 'file')
        ;
    }

    public function getName()
    {
        return 'debb_configbundle_importdebbcomponentsxmltype';
    }
}
