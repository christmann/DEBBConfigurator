<?php

namespace Debb\ConfigBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Translation\Translator;

class MenuBuilder
{

	private $factory;
	private $translator;

	/**
	 * Our menu builder with translator and factoryinterface
	 * 
	 * @param \Knp\Menu\FactoryInterface $factory
	 * @param \Symfony\Bundle\FrameworkBundle\Translation\Translator $translator
	 */
	public function __construct(FactoryInterface $factory, Translator $translator)
	{
		$this->factory = $factory;
		$this->translator = $translator;
	}

	/**
	 * Creates the main menu (left side)
	 * 
	 * @param \Symfony\Component\HttpFoundation\Request $request
	 * @return type
	 */
	public function createMainMenu(Request $request)
	{
		$menu = $this->factory->createItem('root');

		$management = $menu->addChild($this->translateIt('Components'), array(
			'uri' => '#',
			'displayChildren' => true,
			'linkAttributes' => array('onclick' => '$(this).next().toggle(); return false;'),
			'attributes' => array('class' => 'zero first current')
		));
		$management->addChild($this->translateIt('Processor'), array('route' => 'debb_management_processor_index'));
		$management->addChild($this->translateIt('Mainboard'), array('route' => 'debb_management_mainboard_index'));
		$management->addChild($this->translateIt('Coolingdevice'), array('route' => 'debb_management_coolingdevice_index'));
		$management->addChild($this->translateIt('Memory'), array('route' => 'debb_management_memory_index'));
		$management->addChild($this->translateIt('Powersupply'), array('route' => 'debb_management_powersupply_index'));
		$management->addChild($this->translateIt('Storage'), array('route' => 'debb_management_storage_index'));
		$management->addChild($this->translateIt('nodegroup'), array('route' => 'debb_management_nodegroupdraft_index'));

		$menu->addChild($this->translateIt('node'), array(
			'route' => 'debb_config_node_index',
			'attributes' => array('class' => 'one first')
		));

		$menu->addChild($this->translateIt('node.group'), array(
			'route' => 'debb_config_nodegroup_index',
			'attributes' => array('class' => 'two first')
		));

		$menu->addChild($this->translateIt('rack'), array(
			'route' => 'debb_config_rack_index',
			'attributes' => array('class' => 'three first')
		));

		$menu->addChild($this->translateIt('room'), array(
			'route' => 'debb_config_room_index',
			'attributes' => array('class' => 'four first')
		));

		$menu->addChild(
			$this->translateIt('import.%name%', array('%name%' => '')), array('route' => 'debb_config_default_importdebbcomponentsxml',
			'attributes' => array('class' => 'first', 'style' => 'margin-top: 15px;', 'noextra' => true)));

		return $menu;
	}

	/**
	 * Translate a complete string inclusive (optional) the parameter array
	 * 
	 * @param string $path the word to translate
	 * @param array $options optional array with parameters for translator
	 * @param boolean $complete should we translate the whole $options?
	 * @return string the translated result
	 */
	private function translateIt($path, $options = array(), $complete = true)
	{
		if ($complete && count($options) > 0)
		{
			$optionsNew = array();
			foreach ($options as $var => $val)
			{
				$optionsNew[$var] = $this->translator->trans($val);
			}
			$options = $optionsNew;
		}
		return $this->translator->trans($path, $options);
	}

}
