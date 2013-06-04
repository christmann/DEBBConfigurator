<?php

namespace Debb\ManagementBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * File
 *
 * @ORM\Table(name="file")
 * @ORM\Entity
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

}
