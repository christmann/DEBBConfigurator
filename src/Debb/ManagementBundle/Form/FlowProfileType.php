<?php

namespace Debb\ManagementBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class FlowProfileType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
	        ->add('flowStates', 'collection', array(
		        'type' => new FlowStateType(),
		        'allow_add' => true,
		        'allow_delete' => true,
		        'by_reference' => false,
		        'required' => false,
		        'label' => 'Flow state',
	        ))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Debb\ManagementBundle\Entity\FlowProfile'
        ));
    }

    public function getName()
    {
        return 'debb_managementbundle_flowprofiletype';
    }
}
