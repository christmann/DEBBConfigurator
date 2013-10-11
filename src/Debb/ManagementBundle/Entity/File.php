<?php

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
