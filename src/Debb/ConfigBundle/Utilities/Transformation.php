<?php

namespace Debb\ConfigBundle\Utilities;

use Debb\ConfigBundle\Controller\XMLController;
use Debb\ConfigBundle\Entity\Node;
use Debb\ConfigBundle\Entity\NodeGroup;
use Debb\ConfigBundle\Entity\Rack;
use Debb\ConfigBundle\Entity\Room;
use Debb\ManagementBundle\DataTransformer\DecimalTransformer;
use Debb\ManagementBundle\Entity\Base;
use Debb\ManagementBundle\Entity\ChassisTypSpecification;
use Debb\ManagementBundle\Entity\Component;
use Debb\ManagementBundle\Entity\Connector;
use Debb\ManagementBundle\Entity\FlowPump;
use Debb\ManagementBundle\Entity\FlowPumpToChassis;
use Debb\ManagementBundle\Entity\Heatsink;
use Debb\ManagementBundle\Entity\NodegroupToRack;
use Debb\ManagementBundle\Entity\NodeToNodegroup;
use Debb\ManagementBundle\Entity\RackToRoom;

/**
 * Class Transformation
 * @package Debb\ConfigBundle\Utilities
 * @author Jan Großmann <jan.grossmann@christmann.info> / Calculation etc.
 * @author Patrick Bußmann <patrick.bussmann@christmann.info> / PHP Code
 */
class Transformation
{
	/**
	 * @var array a array with all transformations
	 */
	public static $transformations = array();

	/**
	 * @var int the multiplicand for the calculations - 1 = m, 100 = cm, 1000 = mm, etc.
	 */
	private static $sizeMulti = 1;

	/**
	 * Generates a transformation matrix string from entity
	 *
	 * @param Base $children the base entity
	 * @param Connector $connector a connector which have a connector as base
	 * @param string $separator the separator for output
	 *
	 * @return string
	 */
	public static function generateTransform($children, $connector, $separator = ' ')
	{
		$className = XMLController::get_real_class($children);

		if ((!is_callable(array($connector, 'getPosX')) || !is_callable(array($connector, 'getPosY')) || !is_callable(array($connector, 'getPosZ')) || !is_callable(array($connector, 'getRotation'))) && ($className == 'Rack' || $className == 'Node'))
		{
			self::$transformations[] = array(0, 0, 0, 0, 0, 0, 0);
			return self::generate_transform($separator);
		}

		if ($className == 'Rack')
		{
			/** @var $connector RackToRoom */
			$customs = ($connector->getCustomPosX() ? 'X' : '') . ($connector->getCustomPosY() ? 'Y' : '') . ($connector->getCustomPosZ() ? 'Z' : '');
			$posX = $connector->getCustomPosX() ? $connector->getCustomPosX() * 1000 : $connector->getPosX() * 10;
			$posY = $connector->getCustomPosY() ? $connector->getCustomPosY() * 1000 : $connector->getPosY() * 10;
			$posZ = $connector->getCustomPosZ() ? $connector->getCustomPosZ() * 1000 : $connector->getPosZ();
			$rotation = $connector->getRotation();
			/** @var $children Rack */
			self::$transformations[] = array($posX, $posY, $posZ, $rotation, $children->getSizeX() * 1000, $children->getSizeZ() * 1000, $children->getSizeY() * 1000);
			$transform = self::generate_transform($separator, $posX, $posY, $posZ, $rotation, $children->getSizeX() * 1000, $children->getSizeZ() * 1000, $customs);
		}
		else if ($className == 'FlowPump')
		{
			/** @var $connector FlowPumpToChassis */
			$customs = ($connector->getCustomPosX() ? 'X' : '') . ($connector->getCustomPosY() ? 'Y' : '') . ($connector->getCustomPosZ() ? 'Z' : '');
			$posX = $connector->getCustomPosX() ? $connector->getCustomPosX() * (XMLController::get_real_class($connector) == 'FlowPumpToChassis' ? 1000 : 1000) : ($connector->getPosX() * (XMLController::get_real_class($connector) == 'FlowPumpToChassis' ? 1 : 10));
			$posY = $connector->getCustomPosY() ? $connector->getCustomPosY() * (XMLController::get_real_class($connector) == 'FlowPumpToChassis' ? 1000 : 1000) : ($connector->getPosY() * (XMLController::get_real_class($connector) == 'FlowPumpToChassis' ? 1 : 10));
			$posZ = $connector->getCustomPosZ() ? $connector->getCustomPosZ() * (XMLController::get_real_class($connector) == 'FlowPumpToChassis' ? 1000 : 1000) : $connector->getPosZ();
			$rotation = $connector->getRotation();
			/** @var $children FlowPump */
			self::$transformations[] = array($posX, $posY, $posZ, $rotation, $children->getSizeX() * 1000, $children->getSizeZ() * 1000, $children->getSizeY() * 1000);
			$transform = self::generate_transform($separator, $posX, $posY, $posZ, $rotation, $children->getSizeX() * 1000, $children->getSizeZ() * 1000, $customs);
		}
		else if ($className == 'Node')
		{
			/** @var $connector ChassisTypSpecification */
			$customs = ($connector->getCustomPosX() ? 'X' : '') . ($connector->getCustomPosY() ? 'Y' : '') . ($connector->getCustomPosZ() ? 'Z' : '');
			$posX = $connector->getCustomPosX() ? $connector->getCustomPosX() * 1000 : $connector->getPosX();
			$posY = $connector->getCustomPosY() ? $connector->getCustomPosY() * 1000 : $connector->getPosY();
			$posZ = $connector->getCustomPosZ() ? $connector->getCustomPosZ() * 1000 : $connector->getPosZ();
			$rotation = $connector->getRotation();
			/** @var $children Node */
			self::$transformations[] = array($posX, $posY, $posZ, $rotation , $children->getSizeX() * 1000, $children->getSizeZ() * 1000, $children->getSizeY() * 1000);
			$transform = self::generate_transform($separator, $posX, $posY, $posZ, $rotation, $children->getSizeX() * 1000, $children->getSizeZ() * 1000, $customs);
		}
		else if ($className == 'NodeGroup' && is_callable(array($connector, 'getRack')))
		{
			$ru = 44.45; // 1 Rack Unit = 44.45mm
			/** @var $connector NodegroupToRack */
			/** @var $children NodeGroup */
			$posX = $connector->getRack()->getSpaceLeft() * 1000;
			$posY = $connector->getRack()->getSpaceFront() * 1000;
			$posZ = ($connector->getField() - ($children->getDraft() != null ? $children->getDraft()->getHeSize() : 1) + 1) * $ru;
			$posZ += $connector->getRack()->getSpaceBottom() * 1000;
			self::$transformations[] = array($posX, $posY, $posZ, 0, $children->getSizeX() * 1000, $children->getSizeZ() * 1000, $children->getSizeY() * 1000);
			$transform = self::generate_transform($separator, $posX, $posY, $posZ, 0, $children->getSizeX() * 1000, $children->getSizeZ() * 1000);
		}
		else if ($className == 'Heatsink')
		{
			/** @var $children Component */
			/** @var $connector mixed */ /* Node for example */
			self::$transformations[] = array(0, 0, $connector->getFullY() * 1000, 0, 0, 0, 0);
			$transform = self::generate_transform($separator, 0, 0, $connector->getFullY() * 1000, 0, 0, 0);
		}
		else
		{
			/** @var $connector Room|mixed */
			/** @var $children Transformation|mixed */
			self::$transformations[] = array(0, 0, 0, 0, round($children->getSizeX()) * 10, round($children->getSizeZ()) * 10, $children->getSizeY() * 1000);
			$transform = self::generate_transform($separator, 0, 0, 0, 0, round($children->getSizeX()) * 10, round($children->getSizeZ()) * 10);
		}
		return $transform;
	}

	/**
	 * Generates a transformation matrix string for bounding box
	 *
	 * @param string $separator the separator for output
	 *
	 * @return string the generated transformation
	 */
	public static function generateBoundingBox($separator = ' ')
	{
		$boundingBox = array(0, 0, 0, 0, 0, 0);
		foreach (self::$transformations as $transformation)
		{
			list($xPos, $yPos, $zPos, $rotation, $xSize, $ySize, $zSize) = $transformation;
			if ($xPos < $boundingBox[0])
			{
				$boundingBox[0] = $xPos;
			}
			if ($yPos < $boundingBox[1])
			{
				$boundingBox[1] = $xPos;
			}
			if ($zPos < $boundingBox[2])
			{
				$boundingBox[2] = $xPos;
			}
			if ($rotation == 90 || $rotation == 270)
			{
				if ($xPos + $ySize > $boundingBox[3])
				{
					$boundingBox[3] = $xPos + $ySize;
				}
				if ($yPos + $xSize > $boundingBox[4])
				{
					$boundingBox[4] = $yPos + $xSize;
				}
				if ($zPos + $zSize > $boundingBox[5])
				{
					$boundingBox[5] = $zPos + $zSize;
				}
			}
			else
			{
				if ($xPos + $xSize > $boundingBox[3])
				{
					$boundingBox[3] = $xPos + $xSize;
				}
				if ($yPos + $ySize > $boundingBox[4])
				{
					$boundingBox[4] = $yPos + $ySize;
				}
				if ($zPos + $zSize > $boundingBox[5])
				{
					$boundingBox[5] = $zPos + $zSize;
				}
			}
		}
		$boundingBox[0] -= 10;
		$boundingBox[1] -= 10;
		$boundingBox[2] -= 10;
		$boundingBox[3] += 10;
		$boundingBox[4] += 10;
		$boundingBox[5] += 10;

		for($x = 0; $x < count($boundingBox); $x++)
		{
			$boundingBox[$x] = DecimalTransformer::convert($boundingBox[$x] / 1000 * self::$sizeMulti);
		}

		return implode($separator, $boundingBox);
	}

	/**
	 * Generates a transformation matrix string
	 *
	 * @param string $separator the separator for output
	 * @param float $x the x coordinate
	 * @param float $y the y coordinate
	 * @param float $z the z coordinate
	 * @param float $rotation the rotation in degrees
	 * @param float $xSide the x side / width
	 * @param float $ySide the from front looking Z position or top look Y position (height/depth)
	 *
	 * @return string the generated transformation
	 */
	public static function generate_transform($separator = ' ', $x = 0, $y = 0, $z = 0, $rotation = 0, $xSide = 0, $ySide = 0, $isCustom = '')
	{
		$x = floatval($x);
		$y = floatval($y);
		$z = floatval($z);
		$rotation = 360 - intval($rotation);
		$rotation %= 360;
		$xSide = floatval($xSide);
		$ySide = floatval($ySide);

		if(strpos(strtoupper($isCustom), 'Y') === false && ($rotation == 270 || $rotation == 180))
		{
			$y += $ySide;
		}
		if(strpos(strtoupper($isCustom), 'X') === false && ($rotation == 180 || $rotation == 90))
		{
			$x += $xSide;
		}

		$matrix = array();

		for ($i=0; $i < 4*4; $i++)
		{
			$matrix[$i] = 0;
		}

		$matrix[0] = round(cos(deg2rad($rotation)), 14);
		$matrix[1] = round(sin(deg2rad($rotation)), 14);
		$matrix[4] = round(-sin(deg2rad($rotation)), 14);
		$matrix[5] = round(cos(deg2rad($rotation)), 14);
		$matrix[10] = 1;
		$matrix[12] = $x / 1000 * self::$sizeMulti;
		$matrix[13] = $y / 1000 * self::$sizeMulti;
		$matrix[14] = $z / 1000 * self::$sizeMulti;
		$matrix[15] = 1;

		for($x = 0; $x < count($matrix); $x++)
		{
			$matrix[$x] = DecimalTransformer::convert($matrix[$x]);
		}

		return implode($separator, $matrix);
	}
}
