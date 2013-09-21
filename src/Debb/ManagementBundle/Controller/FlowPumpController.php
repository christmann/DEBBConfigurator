<?php

namespace Debb\ManagementBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * @author Patrick Bußmann <patrick.bussmann@christmann.info>
 * @Route("/{_locale}/management/flowpump", requirements={"_locale" = "en|de"}, defaults={"_locale" = "en"})
 */
class FlowPumpController extends BaseController
{
}
