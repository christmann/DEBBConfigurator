<?php

namespace Debb\ManagementBundle\DataTransformer;

use Symfony\Component\Form\DataTransformerInterface;

/**
 * Class DecimalTransformer
 * @package Debb\ManagementBundle\DataTransformer
 * @author Patrick Bußmann <patrick.bussmann@christmann.info>
 */
class DecimalTransformer implements DataTransformerInterface
{
	/**
	 * @param string $value
	 * @return string
	 */
	public function transform($value)
	{
		return self::convert($value);
	}

	/**
	 * @param string|null $value
	 * @return string|null
	 */
	public static function convert($value, $allowNull = true)
	{
		if($value === null) { return $allowNull ? null : ''; }
		return rtrim(preg_replace('#([.,]\d*?)0+$#', '\\1', $value), '.,');
	}

	/**
	 * @param mixed $value
	 * @return float
	 */
	public function reverseTransform($value)
	{
		return $value;
	}
}
