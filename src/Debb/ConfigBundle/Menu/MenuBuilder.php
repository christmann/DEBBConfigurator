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

		$node = $menu->addChild($this->translateIt('management'), array(
			'uri' => '#',
			'displayChildren' => true,
			'linkAttributes' => array('onclick' => '$(this).next().toggle(); return false;'),
			'attributes' => array('class' => 'current')
			));
		$node->addChild($this->translateIt('processor'), array('route' => 'debb_management_processor_index', 'attributes' => array('noclass' => true)));
		$node->addChild($this->translateIt('mainboard'), array('route' => 'debb_management_mainboard_index', 'attributes' => array('noclass' => true)));

		$node = $menu->addChild($this->translateIt('configure.%what%', array('%what%' => 'node')), array('route' => 'homepage', 'attributes' => array('class' => 'one first')));
		$node->addChild($this->translateIt('overview'), array('uri' => 'homepage', 'attributes' => array('noclass' => true)));
		$node->addChild($this->translateIt('create.%what%', array('%what%' => 'node')), array('uri' => 'homepage', 'attributes' => array('noclass' => true)));

		$menu->addChild($this->translateIt('define.%what%', array('%what%' => 'node.group')), array('route' => 'homepage', 'attributes' => array('class' => 'two first')));

		$menu->addChild($this->translateIt('equip.%what%', array('%what%' => 'rack')), array('route' => 'homepage', 'attributes' => array('class' => 'three first')));

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
