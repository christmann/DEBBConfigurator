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

		$management = $menu->addChild($this->translateIt('management'), array(
			'uri' => '#',
			'displayChildren' => true,
			'linkAttributes' => array('onclick' => '$(this).next().toggle(); return false;'),
			'attributes' => array('class' => 'zero first current')
			));
		$management->addChild($this->translateIt('processor'), array('route' => 'debb_management_processor_index', 'attributes' => array('noclass' => true)));
		$management->addChild($this->translateIt('mainboard'), array('route' => 'debb_management_mainboard_index', 'attributes' => array('noclass' => true)));
		$management->addChild($this->translateIt('coolingdevice'), array('route' => 'debb_management_coolingdevice_index', 'attributes' => array('noclass' => true)));
		$management->addChild($this->translateIt('memory'), array('route' => 'debb_management_memory_index', 'attributes' => array('noclass' => true)));
		$management->addChild($this->translateIt('powersupply'), array('route' => 'debb_management_powersupply_index', 'attributes' => array('noclass' => true)));
		$management->addChild($this->translateIt('storage'), array('route' => 'debb_management_storage_index', 'attributes' => array('noclass' => true)));

		$node = $menu->addChild($this->translateIt('configure.%what%', array('%what%' => 'node')), array(
			'uri' => '#',
			'displayChildren' => true,
			'linkAttributes' => array('onclick' => '$(this).next().toggle(); return false;'),
			'attributes' => array('class' => 'one first')
			));
		$node->addChild($this->translateIt('overview'), array('route' => 'debb_config_node_index', 'attributes' => array('noclass' => true)));
		$node->addChild($this->translateIt('create.%what%', array('%what%' => 'node')), array('route' => 'debb_config_node_form', 'attributes' => array('noclass' => true)));

		$nodeGroup = $menu->addChild($this->translateIt('define.%what%', array('%what%' => 'node.group')), array(
			'uri' => '#',
			'displayChildren' => true,
			'linkAttributes' => array('onclick' => '$(this).next().toggle(); return false;'),
			'attributes' => array('class' => 'two first')
			));

		$rack = $menu->addChild($this->translateIt('equip.%what%', array('%what%' => 'rack')), array(
			'uri' => '#',
			'displayChildren' => true,
			'linkAttributes' => array('onclick' => '$(this).next().toggle(); return false;'),
			'attributes' => array('class' => 'three first')
			));

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
