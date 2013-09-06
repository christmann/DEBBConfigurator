<?php

namespace Debb\ManagementBundle\Form;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Class HeatsinkType
 * @package Debb\ManagementBundle\Form
 * @author Patrick Bußmann <patrick.bussmann@christmann.info>
 */
class HeatsinkType extends DEBBSimpleType
{
	/**
	 * @param FormBuilderInterface $builder
	 * @param array $options
	 */
	public function buildForm(FormBuilderInterface $builder, array $options)
    {
	    parent::buildForm($builder, $options);
		$references = $builder->get('references');
		$transform = $builder->get('transform');
        $builder
			->remove('references')
			->remove('transform')
			->add('transform', null, array_merge_recursive($transform->getOptions(), array('attr' => array('class' => 'noBreakAfterThis'))))
            ->add('transferRate', null, array('required' => false))
			->add($references)
        ;
    }

	/**
	 * @param OptionsResolverInterface $resolver
	 */
	public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Debb\ManagementBundle\Entity\Heatsink'
        ));
    }

	/**
	 * @return string
	 */
	public function getName()
    {
        return 'debb_managementbundle_heatsinktype';
    }
}
