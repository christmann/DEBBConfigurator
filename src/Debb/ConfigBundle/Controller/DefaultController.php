<?php

namespace Debb\ConfigBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
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
	 * @param $request \Symfony\Component\HttpFoundation\Request the request (should be POST)
	 * @return json response with results
	 */
	public function uploadAction(Request $request)
	{
		$class = $this->container->getParameter('cim.plupload.entity');
		/* @var $file \Debb\ManagementBundle\Entity\File */
		$file = new $class();
		$result = array();
		if ($request->getMethod() == 'POST')
		{
			$em = $this->getManager();
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

			if(in_array($file->getExtension(), array('wrl')))
			{
				$content = file_get_contents('./'.$file->getFullPath());
				preg_match_all('#translation ([0-9.-]+) ([0-9.-]+) ([0-9.-]+)#i', $content, $m);
				if(count($m) == 4)
				{
					if(count($m[0]) >= 1)
					{
						$result['dimension'] = array('sizex' => $m[1][0], 'sizey' => $m[2][0], 'sizez' => $m[3][0]);
					}
				}
			}
		}

		return $this->jsonResponse(array('success' => ($request->getMethod() == 'POST'), 'fileId' => $file->getId()) + $result);
	}

    /**
     * Imports a specific file from DEBBComponents format to sql database
     *
     * @Route("/import");
     * @Template()
     *
     * @param Request                                   $request  Request object
     *
     * @return Twig render
     */
    public function importDebbComponentsXmlAction(Request $request)
    {
        $form = $this->createForm(new \Debb\ConfigBundle\Form\ImportDebbComponentsXmlType());
        if ($request->getMethod() == 'POST')
        {
            $form->bind($request);

            if ($form->isValid())
            {
				/* @var $file \Symfony\Component\HttpFoundation\File\UploadedFile */
				$file = $form['debbcomponentsxml']->getData();
				if($file->isValid())
				{
					if($file->getMimeType() == 'text/xml' || $file->getMimeType() == 'application/xml')
					{
						if($file->isReadable())
						{
							$xmlString = preg_replace('#\<[/]{0,1}[a-zA-Z0-9_:]{0,9}ComputeBox[0-9]\>#i', '', file_get_contents($file->getRealPath()));
							$xml = new \SimpleXMLElement($xmlString);

							$this->importDebbComponentsComponent($xml);
							$this->stackNodeComponents();
							$this->addSuccessMsg('localdev_admin.messages.saved');
						}
						else
						{
							$this->addErrorMsg('localdev_admin.messages.cantread');
						}
					}
					else
					{
						$this->addErrorMsg('localdev_admin.messages.wrongfile');
					}
				}
            }
        }

        return array(
            'form' => $form->createView()
        );
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
								$eEntry = $em->getRepository('DebbConfigBundle:'.$type)->findBy(array('manufacturer' => $entry->getManufacturer(), 'product' => $entry->getProduct(), 'model' => $entry->getModel()));
								if(count($eEntry) > 0)
								{
									$entry = $eEntry[0];
								}
								else
								{
									$em->persist($entry);
								}
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

								$eEntry = $em->getRepository('DebbManagementBundle:'.$typeO)->findBy(array('manufacturer' => $entry->getManufacturer(), 'product' => $entry->getProduct(), 'model' => $entry->getModel()));
								if(count($eEntry) > 0)
								{
									$entry = $eEntry[0];
								}
								if($node != null)
								{
									$entity = new \Debb\ManagementBundle\Entity\Component();
									$cmd = 'set' . $typeO;
									$entity->$cmd($entry);
									$entity->setType(constant('\Debb\ManagementBundle\Entity\Component::' . $type));
									$entity->setAmount(1);
									$em->persist($entity);
									$em->persist($entry);
									$node->addComponent($entity);
								}
								$em->persist($entry);
							}
						}
					}
				}
			}
		}

		$em->flush();

		return true;
	}

	/**
	 * Remove double component entries
	 * -> use as cronjob or after DEBBComponents.xml import
	 */
	public function stackNodeComponents()
	{
		$em = $this->getEntityManager();
		$doctrine = $this->getDoctrine();
		$repository = $doctrine->getRepository('DebbConfigBundle:Node');
		foreach($repository->findAll() as $node)
		{
			$components = $node->getComponents();
			/* count the amount from same types */
			$nComponents = array();
			foreach($components as $component)
			{
				if($component->getActive() == null)
				{
					continue;
				}

				if(array_key_exists($component->getType() . '.' . $component->getActive()->getId(), $nComponents))
				{
					$nComponents[$component->getType() . '.' . $component->getActive()->getId()] += $component->getAmount();
				}
				else
				{
					$nComponents[$component->getType() . '.' . $component->getActive()->getId()] = $component->getAmount();
				}
			}

			/* loop the components and remove double components */
			$newComponentArray = array();
			foreach($nComponents as $key => $amount)
			{
				$cache = explode('.', $key);
				$type = $cache[0];
				$activeId = $cache[1];

				$first = true;
				foreach($components as $compKey => $component)
				{
					if($component->getActive() == null)
					{
						continue;
					}
					if($component->getType() == $type && $component->getActive()->getId() == $activeId)
					{
						if($first)
						{
							$first = false;
							$component->setAmount($amount);
							$newComponentArray[] = $component;
						}
						else
						{
							$em->remove($component);
						}
					}
				}
			}
		}
		$em->flush();
	}

}
