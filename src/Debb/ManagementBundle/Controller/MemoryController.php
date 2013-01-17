<?php

namespace Debb\ManagementBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Localdev\AdminBundle\Controller\CRUDController;

/**
 * @Route("/{_locale}/management/memory", requirements={"_locale" = "en|de"}, defaults={"_locale" = "en"})
 */
class MemoryController extends CRUDController
{
}
