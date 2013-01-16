<?php

namespace Debb\ConfigBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Localdev\AdminBundle\Controller\CRUDController;

/**
 * @Route("/{_locale}/node", requirements={"_locale" = "en|de"}, defaults={"_locale" = "en"})
 */
class NodeController extends CRUDController
{
	/**
	 * Shows step - 1 - of configuration.
	 * Configure the node.
	 *
	 * @Route("/overview")
	 * @Template()
	 * @return array the twig render array
	 */
//    public function firstAction()
//    {
//		return array();
//    }
}
