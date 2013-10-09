<?php

namespace Debb\ConfigBundle\Utilities;

use Debb\ConfigBundle\Controller\XMLController;
use Debb\ConfigBundle\Entity\Node;
use Debb\ConfigBundle\Entity\NodeGroup;
use Debb\ConfigBundle\Entity\Rack;
use Debb\ConfigBundle\Entity\Room;
use Debb\ManagementBundle\Entity\Base;
use Debb\ManagementBundle\Entity\ChassisTypSpecification;
use Debb\ManagementBundle\Entity\Component;
use Debb\ManagementBundle\Entity\Connector;
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

		if ($className == 'Rack' || $className == 'FlowPump')
		{
			/** @var $connector RackToRoom */
			$posX = $connector->getPosX() * ($className == 'FlowPump' && XMLController::get_real_class($connector) == 'FlowPumpToChassis' ? -1 : 10);
			$posY = $connector->getPosY() * ($className == 'FlowPump' && XMLController::get_real_class($connector) == 'FlowPumpToChassis' ? -1 : 10);
			$posZ = $connector->getPosZ();
			$rotation = $connector->getRotation();
			/** @var $children Rack */
			self::$transformations[] = array($posX, $posY, $posZ, $rotation, $children->getSizeX() * 1000, $children->getSizeZ() * 1000, $children->getSizeY() * 1000);
			$transform = self::generate_transform($separator, $posX, $posY, $posZ, $rotation, $children->getSizeX() * 1000, $children->getSizeZ() * 1000, $children->getSizeY() * 1000);
		}
		else if ($className == 'Node')
		{
			/** @var $connector ChassisTypSpecification */
			$posX = $connector->getPosX();
			$posY = $connector->getPosY();
			$posZ = $connector->getPosZ();
			$rotation = $connector->getRotation();
			/** @var $children Node */
			self::$transformations[] = array($posX, $posY, 15, $rotation , $children->getSizeX() * 1000, $children->getSizeZ() * 1000, $children->getSizeY() * 1000);
			$transform = self::generate_transform($separator, - $posX, -  $posY, 15, $rotation , $children->getSizeX() * 1000, $children->getSizeZ() * 1000);
		}
		else if ($className == 'NodeGroup' && is_callable(array($connector, 'getRack')))
		{
			$ru = 44.45; // 1 Rack Unit = 44.45mm
			/** @var $connector NodegroupToRack */
			/** @var $children NodeGroup */
			$posX = $connector->getRack()->getSpaceLeft() * 1000;
			$posY = $connector->getRack()->getSpaceFront() * 1000;
			$posZ = $connector->getField() * $ru;
			$posZ -= $ru * (($children->getDraft() != null ? $children->getDraft()->getHeSize() : 1) - 1) + $connector->getRack()->getSpaceBottom() * 1000;
			self::$transformations[] = array($posX, $posY, $posZ, 0, $children->getSizeX() * 1000, $children->getSizeZ() * 1000, $children->getSizeY() * 1000);
			$transform = self::generate_transform($separator, $posX, $posY, $posZ, 0, $children->getSizeX() * 1000, $children->getSizeZ() * 1000);
		}
		else if ($className == 'Component')
		{
			/** @var $children Component */
			/** @var $connector mixed */ /* Node for example */
			if($children->getActive() instanceof Heatsink)
			{
				self::$transformations[] = array(0, 0, $connector->getFullY() * 1000, 0, 0, 0, 0);
				$transform = self::generate_transform($separator, 0, 0, $connector->getFullY() * 1000, 0, 0, 0);
			}
		}
		else
		{
			/** @var $connector Room|mixed */
			/** @var $children Transformation|mixed */
			self::$transformations[] = array(0, 0, 0, 0, round($children->getSizeX()) * 10, round($children->getSizeZ()) * 10, $children->getSizeY() * 1000);
			$transform = self::generate_transform($separator, 0, 0, 0, 0, round($children->getSizeX()) * 10, round($children->getSizeZ()) * 10, $children->getSizeY() * 1000);
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
		$boundingBox[0] -= 100;
		$boundingBox[1] -= 100;
		$boundingBox[2] -= 100;
		$boundingBox[3] += 100;
		$boundingBox[4] += 100;
		$boundingBox[5] += 100;
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
	public static function generate_transform($separator = ' ', $x = 0, $y = 0, $z = 0, $rotation = 0, $xSide = 0, $ySide = 0)
	{
		$x = floatval($x);
		$y = floatval($y);
		$z = floatval($z);
		$rotation = floatval($rotation);
		$xSide = floatval($xSide);
		$ySide = floatval($ySide);

		$matrix = array();

		for ($i=0; $i < 4*4; $i++)
		{
			$matrix[$i] = 0;
		}

		$rotation = $rotation % 360;
		if ($rotation == 270)
		{
			$matrix[12] = $x + $ySide;
			$matrix[13] = $y;
		}
		elseif ($rotation == 180)
		{
			$matrix[12] = $x;
			$matrix[13] = $y;
		}
		elseif ($rotation == 90)
		{
			$matrix[12] = $x;
			$matrix[13] = $y+ $xSide;
		}
		else
		{
			$matrix[12] = $x + $xSide;
			$matrix[13] = $y + $ySide;
		}
		$matrix[12] -= $xSide;
		$matrix[13] -= $ySide;

		$matrix[0] = round(cos(deg2rad($rotation)), 14);
		$matrix[1] = round(sin(deg2rad($rotation)), 14);
		$matrix[4] = round(-sin(deg2rad($rotation)), 14);
		$matrix[5] = round(cos(deg2rad($rotation)), 14);
		$matrix[10] = 1;
		$matrix[14] = $z;
		$matrix[15] = 1;

		return implode($separator, $matrix);
	}
}
