<?php

namespace Debb\ManagementBundle\Controller;

use Debb\ManagementBundle\Entity\Base;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * @author Patrick Bußmann <patrick.bussmann@christmann.info>
 * @Route("/{_locale}/management/storage", requirements={"_locale" = "en|de"}, defaults={"_locale" = "en"})
 */
class StorageController extends BaseController
{
}
