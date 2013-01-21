<?php

namespace Debb\ConfigBundle\Twig;

class Extension extends \Twig_Extension
{
    public function getFunctions()
    {
        return array(
            'component_type' => new \Twig_Function_Method($this, 'componentType'),
        );
    }

    public function componentType($prefix = 'NOTHING')
    {
		$type = 'TYPE_' . $prefix;
        return constant('\Debb\ManagementBundle\Entity\Component::'. $type);
    }

    public function getName()
    {
        return 'extension_extension';
    }
}
