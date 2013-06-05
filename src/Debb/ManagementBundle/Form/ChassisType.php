<?php

namespace Debb\ManagementBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Debb\ManagementBundle\Entity\Chassis;

/**
 * Class ChassisType
 * @package Debb\ManagementBundle\Form
 * @author Patrick Bußmann <patrick.bussmann@christmann.info>
 */
class ChassisType extends AbstractType
{
	/**
	 * @param FormBuilderInterface $builder
	 * @param array $options
	 */
	public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $isNew = !array_key_exists('data', $options) || !($options['data'] instanceof Chassis) || $options['data']->getId() == null;
        if(!$isNew && array_key_exists('attr', $options) && array_key_exists('duplicated', $options['attr']) && $options['attr']['duplicated'] != $isNew)
        {
            $isNew = (bool) $options['attr']['duplicated'];
        }
        $builder
            ->add('manufacturer')
            ->add('product', null, array('attr' => array('class' => 'noBreakAfterThis')))
            ->add('model')
			->add('slotsX', 'choice', array('choices' => $this->getSlotsAmount(), 'empty_value' => false, 'attr' => array('style' => 'width: 223px;', 'class' => 'noBreakAfterThis'), 'disabled' => !$isNew))
			->add('slotsY', 'choice', array('choices' => $this->getSlotsAmount(), 'empty_value' => false, 'attr' => array('style' => 'width: 223px;'), 'disabled' => !$isNew))
            ->add('heSize', 'choice', array('choices' => $this->getSlotsAmount(), 'empty_value' => false, 'attr' => array('style' => 'width: 223px;', 'class' => 'noBreakAfterThis'), 'disabled' => !$isNew))
			->add('frontView', 'choice', array('choices' => array(0 => 'Top', 1 => 'Front'), 'empty_value' => false, 'attr' => array('style' => 'width: 223px;'), 'label' => 'View', 'disabled' => !$isNew))
            ->add('image', 'plupload', array('placeholder' => true))
            ->add('spaceLeft', 'hidden', array('required' => false, 'disabled' => !$isNew))
            ->add('spaceTop', 'hidden', array('required' => false, 'disabled' => !$isNew))
            ->add('spaceRight', 'hidden', array('required' => false, 'disabled' => !$isNew))
            ->add('spaceBottom', 'hidden', array('required' => false, 'disabled' => !$isNew))
            ->add('spaceFront', 'hidden', array('required' => false, 'disabled' => !$isNew))
            ->add('spaceBehind', 'hidden', array('required' => false, 'disabled' => !$isNew))
        ;
    }

	/**
	 * @param OptionsResolverInterface $resolver
	 */
	public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Debb\ManagementBundle\Entity\Chassis'
        ));
    }

	/**
	 * @return array
	 */
	public function getSlotsAmount()
	{
		$res = array();
		for($x = 1; $x < 11; $x++)
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
        return 'debb_managementbundle_chassistype';
    }
}
