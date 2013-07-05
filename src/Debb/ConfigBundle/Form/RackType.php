<?php

namespace Debb\ConfigBundle\Form;

use Debb\ManagementBundle\Form\BaseType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Class RackType
 * @package Debb\ConfigBundle\Form
 * @author Patrick Bußmann <patrick.bussmann@christmann.info>
 */
class RackType extends BaseType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
	    parent::buildForm($builder, $options);
        $builder
            ->add('sizeX', null, array('required' => false, 'attr' => array('class' => 'noBreakAfterThis'), 'label' => 'SizeX'))
            ->add('sizeY', null, array('required' => false, 'label' => 'SizeY'))
            ->add('sizeZ', null, array('required' => false, 'label' => 'SizeZ'))
            ->add('spaceTop', null, array('required' => false, 'attr' => array('class' => 'noBreakAfterThis'), 'label' => 'SpaceTop'))
            ->add('spaceBottom', null, array('required' => false, 'label' => 'SpaceBottom'))
            ->add('spaceLeft', null, array('required' => false, 'attr' => array('class' => 'noBreakAfterThis'), 'label' => 'SpaceLeft'))
            ->add('spaceRight', null, array('required' => false, 'label' => 'SpaceRight'))
            ->add('nodegroups', 'collection', array(
				'type' => new \Debb\ManagementBundle\Form\NodegroupToRackType(),
				'allow_add' => true,
				'allow_delete' => true,
				'by_reference' => false,
				'required' => false,
			))
			->add('nodeGroupSize', 'choice', array('choices' => $this->getNodeGroupSizeChoices(), 'required' => false, 'label' => 'RackSize',
				'empty_value' => false, 'attr' => array('class' => 'updateRackSize noBreakAfterThis')))
	        ->add(
		        'frontView',
		        'choice',
		        array('choices' => array(0 => 'Top', 1 => 'Front'), 'empty_value' => false, 'label' => 'View')
	        )
        ;
    }

	/**
	 * @return array the choices for the node group size select box
	 */
	public function getNodeGroupSizeChoices()
	{
		$res = array();
		for($x = 1; $x < 50; $x++)
		{
			$res[$x] = $x;
		}
		return $res;
	}

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Debb\ConfigBundle\Entity\Rack'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'debb_configbundle_racktype';
    }
}
