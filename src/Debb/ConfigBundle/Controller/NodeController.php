<?php

namespace Debb\ConfigBundle\Controller;

use Localdev\AdminBundle\Controller\CRUDController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Debb\ConfigBundle\Entity\Processor;
use Debb\ConfigBundle\Form\ProcessorType;

/**
 * @Route("/{_locale}/node", requirements={"_locale" = "en|de"}, defaults={"_locale" = "en"})
 */
class NodeController extends CRUDController
{

}
