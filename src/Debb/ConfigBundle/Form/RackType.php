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
            ->remove('maxPower')
            ->add('sizeX', null, array('required' => false, 'label' => 'SizeX', 'attr' => array('class' => 'noBreakAfterThis')))
            ->add('sizeY', null, array('required' => false, 'label' => 'SizeY'))
            ->add('sizeZ', null, array('required' => false, 'label' => 'SizeZ', 'attr' => array('class' => 'noBreakAfterThis')))
			->add('nodeGroupSize', 'choice', array('choices' => $this->getNodeGroupSizeChoices(), 'required' => false, 'label' => 'RackSize',
				'empty_value' => false))
	        ->add('nodegroups', 'collection', array(
		        'type' => new \Debb\ManagementBundle\Form\NodegroupToRackType(),
		        'allow_add' => true,
		        'allow_delete' => true,
		        'by_reference' => false,
		        'required' => false,
	        ))
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
