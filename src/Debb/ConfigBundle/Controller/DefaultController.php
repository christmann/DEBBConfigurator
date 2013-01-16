<?php

namespace Debb\ConfigBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * @Route("/{_locale}", requirements={"_locale" = "en|de"}, defaults={"_locale" = "en"})
 */
class DefaultController extends Controller
{
	/**
	 * Redirect to default route
	 *
	 * @Route("/Debb")
	 * @return redirect to default route
	 */
    public function debbAction()
    {
		return $this->redirect($this->generateUrl('debb_config_node_index'));
    }
}
