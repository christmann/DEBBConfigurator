<?php

namespace Debb\ManagementBundle\Form;

use Debb\ConfigBundle\Entity\NodeGroup;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Debb\ManagementBundle\Entity\Chassis;

/**
 * Class ChassisType
 *
 * @package Debb\ManagementBundle\Form
 * @author Patrick Bußmann <patrick.bussmann@christmann.info>
 */
class ChassisType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $isInUse = false;
        $duplicate = isset($options['attr']['duplicated']) ? $options['attr']['duplicated'] : false;
        if (!$duplicate) {
            $data =& $options['data'];
            if (isset($data) && $data instanceof Chassis && $data->getId()) {
                /** @var $nodeGroup NodeGroup */
                foreach ($data->getNodeGroups() as $nodeGroup) {
                    if ($nodeGroup->getRacks()->count()) {
                        $isInUse = true;
                        break;
                    }
                }
            }
        }
        $builder
            ->add('manufacturer', null, array('required' => false))
            ->add('product', null, array('attr' => array('class' => 'noBreakAfterThis'), 'required' => false))
            ->add('model', null, array('required' => false))
            ->add(
                'slotsX',
                'choice',
                array(
                    'choices' => $this->getSlotsAmount(),
                    'empty_value' => false,
                    'attr' => array('class' => 'noBreakAfterThis')
                )
            )
            ->add('slotsY', 'choice', array('choices' => $this->getSlotsAmount(), 'empty_value' => false))
            ->add(
                'heSize',
                'choice',
                array(
                    'choices' => $this->getSlotsAmount(),
                    'empty_value' => false,
                    'attr' => array('class' => 'noBreakAfterThis'),
                    'disabled' => $isInUse
                )
            )
            ->add(
                'frontView',
                'choice',
                array('choices' => array(0 => 'Top', 1 => 'Front'), 'empty_value' => false, 'label' => 'View')
            )
            ->add(
                'image',
                'plupload',
                array('placeholder' => true, 'label' => 'upload chassis image', 'bootstrap' => true)
            )
            ->add('spaceLeft', 'hidden', array('required' => false))
            ->add('spaceTop', 'hidden', array('required' => false))
            ->add('spaceRight', 'hidden', array('required' => false))
            ->add('spaceBottom', 'hidden', array('required' => false))
            ->add('spaceFront', 'hidden', array('required' => false))
            ->add('spaceBehind', 'hidden', array('required' => false));
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(
            array(
                'data_class' => 'Debb\ManagementBundle\Entity\Chassis'
            )
        );
    }

    /**
     * @return array
     */
    public function getSlotsAmount()
    {
        $res = array();
        for ($x = 1; $x < 11; $x++) {
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
