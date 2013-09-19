<?php

namespace Debb\ManagementBundle\Form;

use Debb\ConfigBundle\Entity\NodeGroup;
use Debb\ManagementBundle\Entity\Chassis;
use Localdev\FrameworkExtraBundle\Extensions\ContainerExtension;
use Localdev\FrameworkExtraBundle\Extensions\FrameworkExtension;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Class ChassisType
 *
 * @package Debb\ManagementBundle\Form
 * @author Patrick Bußmann <patrick.bussmann@christmann.info>
 * @author Fabian Martin <fabian.martin@christmann.info>
 */
class ChassisType extends BaseType
{
    use FrameworkExtension, ContainerExtension;

    /**
     * Container
     *
     * @var ContainerInterface
     */
    protected $container;

    /**
     * Initializes a new instance of the ChassisType class.
     *
     * @param ContainerInterface $container
     */
    function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
	    parent::buildForm($builder, $options);
        $isInUse = false;
        $title = "";
        $content = "";
        $duplicate = isset($options['attr']['duplicated']) ? $options['attr']['duplicated'] : false;
        if (!$duplicate) {
            $data =& $options['data'];
            if (isset($data) && $data instanceof Chassis && $data->getId()) {
                $racks = array();
                $nodeGroups = array();
                /** @var $nodeGroup NodeGroup */
                foreach ($data->getNodeGroups() as $nodeGroup) {
                    $nodeGroups[$nodeGroup->getId()] = $nodeGroup;
                    foreach ($nodeGroup->getRacks() as $nodeRack) {
                        $rack = $nodeRack->getRack();
                        $racks[$rack->getId()] = $rack;
                    }
                }

                $isInUse = count($racks) > 0;

                $translator = $this->getTranslator();
                $title = $isInUse ? $translator->trans('debb_management.chassis.message.title', array(), 'crud') : '';
                if ($nodeGroups) {
                    $items = array('%items%' => '<ul><li>' . implode("</li><li>", $nodeGroups) . '</li></ul>');
                    $content .= $translator->trans('debb_management.chassis.nodegroup.message', $items, 'crud');
                }
                if ($racks) {
                    $items = array('%items%' => '<ul><li>' . implode("", $racks) . '</li></ul>');
                    $content .= $translator->trans('debb_management.chassis.rack.message', $items, 'crud');
                }
            }
        }
        $builder
            ->add(
                'heSize',
                'choice',
                array(
                    'choices' => $this->getSlotsAmount(),
                    'empty_value' => false,
                    'attr' => array('class' => 'noBreakAfterThis'),
                    'label_attr' => array(
                        'data-title' => $title,
                        'data-content' => $content,
                        'data-toggle' => "tooltip"
                    ),
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
	        ->add('sizeX', 'hidden', array('required' => false))
	        ->add('sizeY', 'hidden', array('required' => false))
	        ->add('typspecification', 'collection', array(
		        'type' => new \Debb\ManagementBundle\Form\ChassisTypSpecificationType($this->container),
		        'allow_add' => true,
		        'allow_delete' => true,
		        'by_reference' => false,
		        'required' => false
	        ))
	        ->add('references', 'plupload', array(
			        'filter' => array('wrl,vrml' => 'VRML', 'stl' => 'STL'),
			        'label' => 'Upload model files',
			        'bootstrap' => true,
			        'multiple' => true
		        )
	        )
        ;
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

    /**
     * Returns the service container
     *
     * @return ContainerInterface
     */
    public function getContainer()
    {
        return $this->container;
    }
}
