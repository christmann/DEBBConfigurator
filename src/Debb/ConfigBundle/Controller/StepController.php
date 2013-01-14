<?php

namespace Debb\ConfigBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Debb\ConfigBundle\Entity\Processor;
use Debb\ConfigBundle\Form\ProcessorType;

/**
 * @Route("/{_locale}/step", requirements={"_locale" = "en|de"}, defaults={"_locale" = "en"})
 */
class StepController extends Controller
{
	/**
	 * Shows step - 1 - of configuration.
	 * Configure the node.
	 *
	 * @Route("/first")
	 * @Template()
	 * @return array the twig render array
	 */
    public function firstAction()
    {
//		$processor = new Processor();
//		$processor->setTitle('Test');
//		return array('form' => $this->createForm(new ProcessorType(), $processor)->createView());
		return array();
    }
}
