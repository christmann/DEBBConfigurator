<?php
/**
 * DEBBConfigurator - A configurator for DEBB component and PLMXML files
 * Copyright (C) 2013-2014 christmann informationstechnik + medien GmbH & Co. KG
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Library General Public
 * License as published by the Free Software Foundation; either
 * version 2 of the License, or (at your option) any later version.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
 * Library General Public License for more details.
 *
 * You should have received a copy of the GNU Library General Public
 * License along with this library; if not, write to the
 * Free Software Foundation, Inc., 51 Franklin St, Fifth Floor,
 * Boston, MA  02110-1301, USA.
 */

namespace Debb\ConfigBundle\Controller;

use CoolEmAll\UserBundle\Entity\User;
use Debb\ConfigBundle\Entity\Node;
use Debb\ConfigBundle\Entity\NodeGroup;
use Debb\ManagementBundle\Controller\BaseController;
use Debb\ManagementBundle\Entity\File;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use \Symfony\Component\HttpFoundation\Response;
use \Debb\ManagementBundle\Entity\Component;

/**
 * @author Patrick Bußmann <patrick.bussmann@christmann.info>
 * @Route("/{_locale}", requirements={"_locale" = "en|de"}, defaults={"_locale" = "en"})
 */
class DefaultController extends BaseController
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
            $form->submit($request);

            if ($form->isValid())
            {
                /* @var $file \Debb\ManagementBundle\Entity\File */
                $file = $form['ziparchive']->getData();
                if($file->getMimeType() == 'application/zip' || $file->getMimeType() == 'application/octet-stream')
                {
                    /* Temp directory creation */
                    $dir = sys_get_temp_dir() . DIRECTORY_SEPARATOR . rand(11111, 99999) . 'debb';
                    mkdir($dir);

                    /* Open the uploaded zip archive */
                    $zip = new \ZipArchive;
                    $res = $zip->open($file->getFullPath());
                    if ($res === TRUE)
                    {
                        /* Extract $zip to $dir */
                        $zip->extractTo($dir);
                        $zip->close();
                        /* Remove $file / $zip */
	                    unlink($file->getFullPath());
                        unset($file);
                        unset($zip);
                        /* Import each xml file */
                        foreach (glob($dir . DIRECTORY_SEPARATOR . '*.xml') as $file)
                        {
                            $this->importDebbComponentsComponent(new \SimpleXMLElement(file_get_contents($file)), $file);
                        }
                    }

                    self::rmfdir($dir);
                    $this->addSuccessMsg('localdev_admin.messages.saved');
                }
                else
                {
                    $this->addErrorMsg('localdev_admin.messages.wrongfile');
                }
            }
        }

        return array(
            'form' => $form->createView()
        );
    }

	/**
	 * Removes a directory incl. all files and directories
	 *
	 * @param $dir the directory to remove recursive
	 * @author http://us3.php.net/manual/en/function.rmdir.php#98622
	 */
	static function rmfdir($dir) {
		if (is_dir($dir)) {
			$objects = scandir($dir);
			foreach ($objects as $object) {
				if ($object != '.' && $object != '..') {
					if (filetype($dir.DIRECTORY_SEPARATOR.$object) == 'dir') self::rmfdir($dir.DIRECTORY_SEPARATOR.$object); else unlink($dir.DIRECTORY_SEPARATOR.$object);
				}
			}
			reset($objects);
			rmdir($dir);
		}
	}

	/**
	 * Import a depth DEBBComponents.xml
	 * 
	 * @param \SimpleXMLElement $xml the xml level from import
	 * @param \Debb\ConfigBundle\Entity\Node $node the node to add the components
	 * @param \Debb\ConfigBundle\Entity\NodeGroup $nodeGroup the node group to add the nodes
	 * @return boolean true
	 */
	public function importDebbComponentsComponent(\SimpleXMLElement & $xml, $filename = null)
	{
		$em = $this->getManager();

		if(strtolower($xml->getName()) == 'node')
		{
			// Node
			$node = $em->getRepository('DebbConfigBundle:Node')->findBy(array('componentId' => $xml->ComponentId, 'user' => $this->getUserId()));
			if(count($node) > 0)
			{
				$node = $node[0];
			}
			else
			{
				$node = new Node();
			}

			foreach($xml as $key => $val)
			{
				/* @var $key string the name - something like ComponentId, Manufacturer, Product, Baseboard, Processor, Memory */
				/* @var $val \SimpleXMLElement */

				if (defined('\Debb\ManagementBundle\Entity\Component::TYPE_' . strtoupper($key)))
				{
					$class = '\\Debb\\ManagementBundle\\Entity\\' . $key;
					if (class_exists($class))
					{
						$entry = new $class();
						foreach ((array) $val as $kkey => $vval)
						{
							$cmd = 'set' . $kkey;
							if (method_exists($entry, $cmd))
							{
								$entry->$cmd($vval);
							}
						}

						$eEntry = $em->getRepository('DebbManagementBundle:'.$key)->findBy(array('partId' => $entry->getPartId(), 'user' => $this->getUserId()));
						if(count($eEntry) > 0)
						{
							$entry = $eEntry[0];
						}
						if($node != null)
						{
							/* @var $nodeComp Component */
							$counted = false;
							foreach($node->getComponents() as $nodeComp)
							{
								if($nodeComp->getActive()->getPartId() == $entry->getPartId())
								{
									$nodeComp->setAmount($nodeComp->getAmount() + 1);
									$counted = true;
								}
							}
							if(!$counted)
							{
								$entity = new \Debb\ManagementBundle\Entity\Component();
								$cmd = 'set' . $key;
								$entity->$cmd($entry);
								$entity->setType(constant('\Debb\ManagementBundle\Entity\Component::TYPE_' . strtoupper($key)));
								$entity->setAmount(1);
								$em->persist($entity);
								$em->persist($entry);
								$node->addComponent($entity);
							}
						}
						$em->persist($entry);
					}
				}
				else
				{
					$cmd = 'set' . $key;
					if (method_exists($node, $cmd))
					{
						$node->$cmd((string) $val);
					}
				}
			}
			/* Try to get image and object files */
			if($filename != null)
			{
				/* Search images */
				foreach(array('Image' => array('jpeg', 'jpg', 'bmp', 'png', 'gif'), 'VrmlFile' => array('wrl'), 'StlFile' => array('stl')) as $setter => $ext)
				{
					foreach (glob(dirname($filename) . DIRECTORY_SEPARATOR . '*' . DIRECTORY_SEPARATOR . substr(basename($filename, '.xml'), 5) . '.{'.implode(',', $ext).'}', GLOB_BRACE) as $file)
					{
						$fileClass = new File();
						$fileSymfonyClass = new \Symfony\Component\HttpFoundation\File\UploadedFile($file, basename($file));
						$fileClass->setMimeType($fileSymfonyClass->getMimeType());
						$fileClass->setName($fileSymfonyClass->getClientOriginalName());
						$fileClass->setPath(uniqid() . '.' . $fileSymfonyClass->guessExtension());
						$fileClass->setSize($fileSymfonyClass->getSize());
						copy($file, $fileClass->getFullPath());
						$cmd = 'set' . $setter;
						$node->$cmd($fileClass);
						$em->persist($fileClass);
					}
				}
			}
			$em->persist($node);
		}
		else if(strtolower($xml->getName()) == 'nodegroup')
		{
			// NodeGroup
			$nodeGroup = $em->getRepository('DebbConfigBundle:NodeGroup')->findBy(array('componentId' => $xml->ComponentId, 'user' => $this->getUserId()));
			if(count($nodeGroup) > 0)
			{
				$nodeGroup = $nodeGroup[0];
			}
			else
			{
				$nodeGroup = new NodeGroup();
			}

			foreach($xml as $key => $val)
			{
				/* @var $key string the name - something like ComponentId, Manufacturer, Product */
				/* @var $val \SimpleXMLElement */

				$cmd = 'set' . $key;
				if (method_exists($nodeGroup, $cmd))
				{
					$nodeGroup->$cmd((string) $val);
				}
			}
			$em->persist($nodeGroup);
		}
		else if(strtolower($xml->getName()) == 'plmxml')
		{
			// PLMXML
			// No import needed
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
		$em = $this->getManager();
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

	/**
	 * Gets the current user id or null
	 *
	 * @return integer|null
	 */
	public function getUserId()
	{
		$user = parent::getUser();
		if(!($user instanceof User))
		{
			return null;
		}
		return $user->getId();
	}
}
