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
            ->add('sizeX', null, array('required' => false))
            ->add('sizeY', null, array('required' => false))
            ->add('sizeZ', null, array('required' => false))
            ->add('spaceTop', null, array('required' => false))
            ->add('spaceLeft', null, array('required' => false))
            ->add('spaceBottom', null, array('required' => false))
            ->add('spaceRight', null, array('required' => false))
            ->add('nodegroups', 'collection', array(
				'type' => new \Debb\ManagementBundle\Form\NodegroupToRackType(),
				'allow_add' => true,
				'allow_delete' => true,
				'by_reference' => false,
				'required' => false,
			))
			->add('nodeGroupSize', 'choice', array('choices' => $this->getNodeGroupSizeChoices(), 'required' => false,
				'empty_value' => false, 'attr' => array('class' => 'updateRackSize')))
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
