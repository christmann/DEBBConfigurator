<?php

namespace Debb\ConfigBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class RackType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('manufacturer', null, array('required' => false))
            ->add('product', null, array('required' => false))
            ->add('model', null, array('required' => false))
            ->add('nodegroups', 'collection', array(
				'type' => new \Debb\ManagementBundle\Form\NodegroupToRackType(),
				'allow_add' => true,
				'allow_delete' => true,
				'by_reference' => false,
				'required' => false,
			))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Debb\ConfigBundle\Entity\Rack'
        ));
    }

    public function getName()
    {
        return 'debb_configbundle_racktype';
    }
}
