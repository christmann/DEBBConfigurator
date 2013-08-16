<?php

namespace Debb\ConfigBundle\Utilities;

use Debb\ConfigBundle\Controller\XMLController;
use Debb\ConfigBundle\Entity\Node;
use Debb\ConfigBundle\Entity\NodeGroup;
use Debb\ConfigBundle\Entity\Rack;
use Debb\ConfigBundle\Entity\Room;
use Debb\ManagementBundle\Entity\Base;
use Debb\ManagementBundle\Entity\ChassisTypSpecification;
use Debb\ManagementBundle\Entity\Connector;
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
	 * Generates a transformation matrix string from entity
	 *
	 * @param Base $children the base entity
	 * @param Connector $connector a connector which have a connector as base
	 *
	 * @return string
	 */
	public static function generateTransform($children, $connector)
	{
		$className = XMLController::get_real_class($children);

		if ((!is_callable(array($connector, 'getPosX')) || !is_callable(array($connector, 'getPosY')) || !is_callable(array($connector, 'getPosZ')) || !is_callable(array($connector, 'getRotation'))) && ($className == 'Rack' || $className == 'Node'))
		{
			var_dump(get_class($connector));
			return self::generate_transform();
		}

		if ($className == 'Rack')
		{
			/** @var $connector RackToRoom */
			$posX = $connector->getPosX() * 10;
			$posY = $connector->getPosY() * 10;
			$posZ = $connector->getPosZ() * 10;
			$rotation = $connector->getRotation();
			/** @var $children Rack */
			$transform = self::generate_transform($posX, $posY, $posZ, $rotation, $children->getSizeX() * 1000, $children->getSizeY() * 1000);
		}
		else if ($className == 'Node')
		{
			/** @var $connector ChassisTypSpecification */
			$posX = $connector->getPosX();
			$posY = $connector->getPosY();
			$posZ = $connector->getPosZ();
			$rotation = $connector->getRotation();
			/** @var $children Node */
			$transform = self::generate_transform($posX, $posY, $posZ, $rotation, $children->getSizeX() * 1000, $children->getSizeY() * 1000);
		}
		else if ($className == 'NodeGroup' && is_callable(array($connector, 'getRack')))
		{
			$ru = 44.45; // 1 Rack Unit = 44.45mm
			/** @var $connector NodegroupToRack */
			$posX = $connector->getRack()->getSpaceLeft();
			$posY = $connector->getRack()->getSpaceFront();
			$posZ = $connector->getRack()->getSpaceBottom() + $connector->getField();
			$posZ *= $ru;
			/** @var $children NodeGroup */
			$transform = self::generate_transform($posX, $posY, $posZ);
		}
		else
		{
			/** @var $connector Room|mixed */
			/** @var $children Transformation|mixed */
			$transform = self::generate_transform();
		}

		return $transform;
	}

	/**
	 * Generates a transformation matrix string
	 *
	 * @param float $x the x coordinate
	 * @param float $y the y coordinate
	 * @param float $z the z coordinate
	 * @param float $rotation the rotation in degrees
	 * @param float $xSide the x side / width
	 * @param float $ySide the from front looking Z position or top look Y position (height/depth)
	 *
	 * @return string the generated transformation
	 */
	public static function generate_transform($x = 0, $y = 0, $z = 0, $rotation = 0, $xSide = 0, $ySide = 0)
	{
		$matrix = array();

		$xCenter = (float) $x + 0.5 * (float) $xSide; // Centered on the x axis
		$yCenter = (float) $y + 0.5 * (float) $ySide; // Centered on the y axis
		$radius = sqrt(pow((float) $xSide * 0.5, 2) + pow((float) $ySide * 0.5, 2)); // Radius of the object
		$angle = rad2deg(atan((float) $ySide != 0 ? (float) $xSide / (float) $ySide : 0)) + 90 + (float) $rotation; // Angle in the unit circle (clockwise)
		for ($i = 0; $i < 16; $i++)
		{
			$matrix[$i] = 0;
		}

		$matrix[0] = round(cos(deg2rad((float) $rotation)), 14);
		$matrix[1] = round(sin(deg2rad((float) $rotation)), 14);
		$matrix[4] = round(-sin(deg2rad((float) $rotation)), 14);
		$matrix[5] = round(cos(deg2rad((float) $rotation)), 14);
		$matrix[10] = 1;
		$matrix[12] = round($xCenter + cos(deg2rad($angle)) * $radius, 8);
		$matrix[13] = round($yCenter - sin(deg2rad($angle)) * $radius, 8);
		$matrix[14] = (float) $z;
		$matrix[15] = 1;

		return implode(' ', $matrix);
	}
}
