<?php

namespace Debb\ConfigBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Class ImportDebbComponentsXmlType
 * @package Debb\ConfigBundle\Form
 * @author Patrick Bußmann <patrick.bussmann@christmann.info>
 */
class ImportDebbComponentsXmlType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('ziparchive', 'plupload', array('filter' => array('zip' => 'DEBBComponents'), 'label' => 'upload zip file', 'bootstrap' => true, 'showMaxSize' => true))
        ;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'debb_configbundle_importdebbcomponentsxmltype';
    }
}
