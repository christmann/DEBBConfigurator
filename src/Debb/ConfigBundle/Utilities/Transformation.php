<?php

namespace Debb\ConfigBundle\Utilities;

use Debb\ConfigBundle\Controller\XMLController;
use Debb\ManagementBundle\Entity\Base;
use Debb\ManagementBundle\Entity\Connector;

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

		if ((!is_callable(array($connector, 'getPosX')) || !is_callable(array($connector, 'getPosY')) || !is_callable(array($connector, 'getPosZ')) || !is_callable(array($connector, 'getRotation'))) && ($className == 'Rack' || $className == 'Node')
		)
		{
			var_dump(get_class($connector));
			return self::generate_transform();
		}

		if ($className == 'Rack' || $className == 'Node')
		{
			$posX = $connector->getPosX() * ($className == 'Rack' ? 10 : 1);
			$posY = $connector->getPosY() * ($className == 'Rack' ? 10 : 1);
			$posZ = $connector->getPosZ() * ($className == 'Rack' ? 10 : 1);
			$rotation = $connector->getRotation();
			$transform = self::generate_transform($posX, $posY, $posZ, $rotation, $children->getSizeX(), $children->getSizeY());
		}
		else if ($className == 'NodeGroup' && is_callable(array($connector, 'getRack')))
		{
			$ru = 44.45; // 1 Rack Unit = 44.45mm
			$posX = $connector->getRack()->getSpaceLeft();
			$posY = $connector->getRack()->getSpaceFront();
			$posZ = $connector->getRack()->getSpaceBottom() + $connector->getField();
			$posZ *= $ru;
			$transform = self::generate_transform($posX, $posY, $posZ);
		}
		else
		{
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
	 * @param float $xside the x side / width
	 * @param float $yside the from front looking Z position or top look Y position (height/depth)
	 *
	 * @return string the generated transformation
	 */
	public static function generate_transform($x = 0, $y = 0, $z = 0, $rotation = 0, $xside = 0, $yside = 0)
	{
		$matrix = array();

		$xcenter = $x + 0.5 * $xside; // Mittelpunkt auf der x Achse
		$ycenter = $y + 0.5 * $yside; // Mittelpunkt auf der y Achse
		$radius = sqrt(pow($xside * 0.5, 2) + pow($yside * 0.5, 2)); // Radius des Objektes
		$angle = rad2deg(atan($xside / $yside)) + 90 + $rotation; // Winkel im Einheitskreis (rechtsdrehend)
		for ($i = 0; $i < 16; $i++)
		{
			$matrix[$i] = 0;
		}

		$matrix[0] = round(cos(deg2rad($rotation)), 10);
		$matrix[1] = round(sin(deg2rad($rotation)), 10);
		$matrix[4] = round(-sin(deg2rad($rotation)), 10);
		$matrix[5] = round(cos(deg2rad($rotation)), 10);
		$matrix[10] = 1;
		$matrix[12] = $xcenter + cos(deg2rad($angle)) * $radius;
		$matrix[13] = $ycenter - sin(deg2rad($angle)) * $radius;
		$matrix[14] = $z;
		$matrix[15] = 1;

		return implode(' ', $matrix);
	}
}
