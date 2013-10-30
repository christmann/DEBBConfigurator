<?php

namespace Debb\ManagementBundle\Form;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Class CoolingDeviceType
 * @package Debb\ManagementBundle\Form
 * @author Patrick Bußmann <patrick.bussmann@christmann.info>
 */
class CoolingDeviceType extends BaseType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
	    parent::buildForm($builder, $options);
        $builder
            ->add('class', 'choice', array('choices' => $this->getClasses(true), 'attr' => array('class' => 'noBreakAfterThis')))
            ->add('maxCoolingCapacity', 'decimal', array('required' => false))
            ->add('maxAirThroughput', 'decimal', array('required' => false, 'attr' => array('class' => 'noBreakAfterThis')))
            ->add('maxWaterThroughput', 'decimal', array('required' => false))
            ->add('airThroughputProfile', null, array('required' => false, 'attr' => array('class' => 'noBreakAfterThis'), 'query_builder' => $this->userQueryBuilder))
            ->add('waterThroughputProfile', null, array('required' => false, 'query_builder' => $this->userQueryBuilder))
	        ->add('coolingCapacityRated', 'decimal')
			->add('energyEfficiencyRatio', 'collection', array(
				'type' => new CoolingEERType(),
				'allow_add' => true,
				'allow_delete' => true,
				'by_reference' => false,
				'required' => false,
				'label' => 'Energy efficiency ratio'
			))
        ;
    }

	/**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Debb\ManagementBundle\Entity\CoolingDevice'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'debb_managementbundle_coolingdevicetype';
    }

	/**
	 * @return array the array with valid classes
	 */
	public static function getClasses($inclKeys = false)
	{
		$ret = array();
		foreach(array('Fan', 'Refrigeration', 'Heatpipe', 'ILC', 'LCU', 'CRAH', 'HVAC') as $class)
		{
			if($inclKeys)
			{
				$ret[$class] = $class;
			}
			else
			{
				$ret[] = $class;
			}
		}
		return $ret;
	}
}
