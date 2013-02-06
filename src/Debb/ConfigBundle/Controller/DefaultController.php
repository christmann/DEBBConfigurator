<?php

namespace Debb\ConfigBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use \Localdev\FrameworkExtraBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

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

	/**
	 * Uploads a file
	 *
	 * @Route("/upload")
	 * @param $request Symfony\Component\HttpFoundation\Request the request (should be POST)
	 * @return json response with results
	 */
	public function uploadAction(Request $request)
	{
		$class = $this->container->getParameter('cim.plupload.entity');
		$file = new $class();
		$result = array();
		if ($request->getMethod() == 'POST')
		{
			$em = $this->getEntityManager();
			$file->setFile($request->files->get('Filedata'));

			$em->persist($file);
			$em->flush();

			/* @var \Avalanche\Bundle\ImagineBundle\Imagine\CachePathResolver $cachePath */
			$cachePath = $this->get('imagine.cache.path.resolver');

			$result = array(
				'name' => $file->getName(),
				'path' => $file->getFullPath(),
				'thumb' => $cachePath->getBrowserPath($file->getFullPath(), 'admin_thumb'),
				'is_image' => $file->isImage()
			);
		}

		return $this->jsonResponse(array('success' => ($request->getMethod() == 'POST'), 'fileId' => $file->getId()) + $result);
	}

}
