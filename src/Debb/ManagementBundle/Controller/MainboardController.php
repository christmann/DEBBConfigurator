<?php

namespace Debb\ManagementBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Localdev\AdminBundle\Controller\CRUDController;

/**
 * @Route("/{_locale}/management/mainboard", requirements={"_locale" = "en|de"}, defaults={"_locale" = "en"})
 */
class MainboardController extends CRUDController
{
	/**
	 * Displays the mainboard image from mainboard with id
	 *
	 * @Route("/get/image/{id}")
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
    public function getImageAction()
    {
		$mainboard = $this->getEntity($id);

		return $this->jsonResponse(array(
//			'path' => $mainboard->getFile
		));
    }
}
