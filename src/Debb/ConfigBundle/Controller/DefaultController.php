<?php

namespace Debb\ConfigBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use \Localdev\FrameworkExtraBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use \Symfony\Component\HttpFoundation\Response;

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

	/**
	 * Imports a specific file from DEBBComponents format to sql database
	 * 
	 * @Route("/import/DEBBComponents.xml")
	 */
	public function importDebbComponentsXmlAction()
	{
		$xml = new \SimpleXMLElement(file_get_contents('../utils/DEBBComponents.xml'));

		$this->importDebbComponentsComponent($xml);

		return new Response();
	}

	/**
	 * Import a depth DEBBComponents.xml
	 * 
	 * @param \SimpleXMLElement $xml the xml level from import
	 * @param \Debb\ConfigBundle\Entity\Node $node the node to add the components
	 * @param \Debb\ConfigBundle\Entity\NodeGroup $nodeGroup the node group to add the nodes
	 * @return boolean true
	 */
	public function importDebbComponentsComponent(\SimpleXMLElement & $xml, \Debb\ConfigBundle\Entity\Node & $node = null, \Debb\ConfigBundle\Entity\NodeGroup & $nodeGroup = null)
	{
		$em = $this->getEntityManager();

		foreach ($xml as $type => $obj)
		{
			if (in_array(strtolower($type), array('computebox2', 'computebox1')))
			{
				continue;
			}

			if (!empty($obj))
			{
				if (is_array($obj))
				{
					foreach ($obj as $kKey => $uObj)
					{
						$this->importDebbComponentsComponent(array($type => $uObj));
					}
				}
				else
				{
					if (in_array(strtolower($type), array('computebox2', 'computebox1', 'node', 'nodegroup')))
					{
						if (in_array(strtolower($type), array('node', 'nodegroup')))
						{
							$class = '\\Debb\\ConfigBundle\\Entity\\' . $type;
							if (class_exists($class))
							{
								$entry = new $class();
								foreach ((array) $obj as $key => $value)
								{
									$cmd = 'set' . $key;
									if (method_exists($entry, $cmd))
									{
										$entry->$cmd($value);
									}
								}
								$em->persist($entry);
								if (in_array(strtolower($type), array('node')))
								{
									$this->importDebbComponentsComponent($obj, $entry, $nodeGroup);
								}
								else
								{
									$this->importDebbComponentsComponent($obj, $node, $entry);
								}
								if($nodeGroup != null)
								{
									$nodeToNodeGroup = new \Debb\ManagementBundle\Entity\NodeToNodegroup();
									$nodeToNodeGroup->setField($nodeGroup->getFreeNode());
									$nodeToNodeGroup->setNode($entry);
									$nodeToNodeGroup->setNodeGroup($nodeGroup);
									$em->persist($nodeToNodeGroup);
									$nodeGroup->addNode($nodeToNodeGroup);
								}
							}
						}
						else
						{
							$this->importDebbComponentsComponent($obj);
						}
					}
					else
					{
						preg_match_all('#([A-Z][a-z]+)#', $type, $m);
						$typeO = $type;
						$type = 'TYPE_' . strtoupper(implode('_', $m[1]));

						/* check if entry could be a component */
						if (defined('\Debb\ManagementBundle\Entity\Component::' . $type))
						{
							$class = '\\Debb\\ManagementBundle\\Entity\\' . $typeO;
							if (class_exists($class))
							{
								$entry = new $class();
								foreach ((array) $obj as $key => $value)
								{
									$cmd = 'set' . $key;
									if (method_exists($entry, $cmd))
									{
										$entry->$cmd($value);
									}
								}

								if($node != null)
								{
									$entity = new \Debb\ManagementBundle\Entity\Component();
									$cmd = 'set' . $typeO;
									$entity->$cmd($entry);
									$entity->setType(constant('\Debb\ManagementBundle\Entity\Component::' . $type));
									$entity->setAmount(1);
									$em->persist($entry);
									$em->persist($entity);
									$node->addComponent($entity);
								}
							}
						}
					}
				}
			}
		}

		$em->flush();

		return true;
	}

}
