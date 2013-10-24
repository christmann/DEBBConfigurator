<?php

namespace Debb\ManagementBundle\DataTransformer;

use Symfony\Component\Form\DataTransformerInterface;

class DecimalTransformer implements DataTransformerInterface
{
	/**
	 * @param mixed $value
	 * @return string
	 */
	public function transform($value)
	{
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
