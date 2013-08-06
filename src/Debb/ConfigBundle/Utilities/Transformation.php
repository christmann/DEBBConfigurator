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
	public function generateTransform($children, $connector)
	{
		$className = XMLController::get_real_class($children);

		if(
				!method_exists($connector, 'getPosX')
			||
				!method_exists($connector, 'getPosY')
			||
				!method_exists($connector, 'getPosZ')
				||
				!method_exists($connector, 'getRotation')
		  )
		{
			return $this->generate_transform();
		}

		if($className == 'Room')
		{
			$transform = $this->generate_transform();
		}
		else if($className == 'Rack' || $className == 'Node')
		{
			$posX = $connector->getPosX();
			$posY = $connector->getPosY();
			$posZ = $connector->getPosZ();
			$rotation = $connector->getRotation();
			$transform = generate_transform($posX, $posY, $posZ, $rotation);
		}
		else if($className == 'NodeGroup')
		{
			$ru = 0.04445; // 1 Rack Unit = 44.45mm
			$posx = ($nodegrouptorack->rack_id->spaceLeft);
			$posy = ($nodegrouptorack->rack_id->spaceFront);
			$posz = ($nodegrouptorack->rack_id->spaceBottom) + (nodegrouptorack -> field) * $ru;
			$transform = generate_transform($posx, $posy, $posz);
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
	 *
	 * @return string the generated transformation
	 */
	public function generate_transform($x = 0, $y = 0, $z = 0, $rotation = 0)
	{
		$matrix = array();

		for ($i = 0; $i < 16; $i++)
		{
			$matrix[$i] = 0;
		}

		$matrix[0] = round(cos(deg2rad($rotation)), 10);
		$matrix[1] = round(sin(deg2rad($rotation)), 10);
		$matrix[4] = round(-sin(deg2rad($rotation)), 10);
		$matrix[5] = round(cos(deg2rad($rotation)), 10);
		$matrix[10] = 1;
		$matrix[12] = $x;
		$matrix[13] = $y;
		$matrix[14] = $z;

		return implode(' ', $matrix);
	}
}
