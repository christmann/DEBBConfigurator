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
			->add('fanEfficiency', 'decimal', array('required' => false))
			->add('coolingCoilEfficiency', 'decimal', array('required' => false, 'attr' => array('class' => 'noBreakAfterThis')))
			->add('deltaThEx', 'decimal', array('required' => false))
			->add('maxCoolingCapacity', 'decimal', array('required' => false, 'attr' => array('class' => 'noBreakAfterThis')))
			->add('coolingCapacityRated', 'decimal', array('required' => false))
			->add('eERRated', 'decimal', array('required' => false))
			->add('energyEfficiencyRatio', 'collection', array(
				'type' => new CoolingEERType(),
				'allow_add' => true,
				'allow_delete' => true,
				'by_reference' => false,
				'required' => false,
				'label' => 'Energy efficiency ratio'
			))
			->add('deltaThDryCooler', 'decimal', array('required' => false, 'attr' => array('class' => 'noBreakAfterThis')))
			->add('dryCoolerEfficiency', 'decimal', array('required' => false))
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
		foreach(array('CRAH', 'Free-cooling', 'Refrigeration', 'Heatpipe', 'ILC', 'LCU', 'HVAC') as $class)
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
