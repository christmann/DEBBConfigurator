<?php

namespace Debb\ManagementBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Class NodeGroupDraftType
 * @package Debb\ManagementBundle\Form
 */
class NodeGroupDraftType extends AbstractType
{
	/**
	 * @param FormBuilderInterface $builder
	 * @param array $options
	 */
	public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('manufacturer')
            ->add('product', null, array('attr' => array('class' => 'noBreakAfterThis')))
            ->add('model')
			->add('slotsX', 'choice', array('choices' => $this->getSlotsAmount(), 'empty_value' => false, 'attr' => array('style' => 'width: 223px;', 'class' => 'noBreakAfterThis')))
			->add('slotsY', 'choice', array('choices' => $this->getSlotsAmount(), 'empty_value' => false, 'attr' => array('style' => 'width: 223px;')))
            ->add('heSize', 'choice', array('choices' => $this->getSlotsAmount(), 'empty_value' => false, 'attr' => array('style' => 'width: 223px;', 'class' => 'noBreakAfterThis')))
			->add('frontView', 'choice', array('choices' => array(0 => 'Top', 1 => 'Front'), 'empty_value' => false, 'attr' => array('style' => 'width: 223px;'), 'label' => 'View:'))
            ->add('image', 'plupload')
        ;
    }

	/**
	 * @param OptionsResolverInterface $resolver
	 */
	public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Debb\ManagementBundle\Entity\NodeGroupDraft'
        ));
    }

	/**
	 * @return array
	 */
	public function getSlotsAmount()
	{
		$res = array();
		for($x = 1; $x < 10; $x++)
		{
			$res[$x] = $x;
		}
		return $res;
	}

	/**
	 * @return string
	 */
	public function getName()
    {
        return 'debb_managementbundle_nodegroupdrafttype';
    }
}
