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

namespace Debb\ManagementBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\MimeType\ExtensionGuesser;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * File
 *
 * @ORM\Table(name="file")
 * @ORM\Entity(repositoryClass="Debb\ManagementBundle\Repository\BaseRepository")
 * @author Patrick Bußmann <patrick.bussmann@christmann.info>
 */
class File extends \CIM\PluploadBundle\Entity\File
{

	/**
	 * Id
	 *
	 * @ORM\Column(name="id", type="integer")
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="AUTO")
	 *
	 * @var integer $id
	 */
	protected $id;

	/**
	 * Returns the file id
	 *
	 * @return int
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * Returns the file type, extracted from the mime type
	 *
	 * @return string
	 */
	public function getType()
	{
		list(, $type) = explode('/', $this->getMimeType());
		return $type;
	}

	/**
	 * Returns the file ending
	 *
	 * @return string
	 */
	public function getFileEnding($upper = true)
	{
		list(, $ending) = explode('.', $this->getName());
		return !$upper ? : str_replace('WRL', 'VRML', strtoupper($ending));
	}

	function __clone()
	{
		if($this->id > 0)
		{
			$this->id = null;

			$guesser = ExtensionGuesser::getInstance();
			$newPath = uniqid() . '.' . $guesser->guess($this->getMimeType());
			if(file_exists($this->getFullPath()) && copy($this->getFullPath(), $this->getUploadRoot() . DIRECTORY_SEPARATOR . $newPath))
			{
				$this->setPath($newPath);
			}
		}
	}

	/*
	 * {@inheritdoc}
	 */
	private function getUploadRoot()
	{
		return __DIR__ . '/../../../../web/' . parent::getUploadRootDir();
	}
}
