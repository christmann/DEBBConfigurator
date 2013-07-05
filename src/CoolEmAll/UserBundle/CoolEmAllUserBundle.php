<?php

namespace CoolEmAll\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class CoolEmAllUserBundle extends Bundle
{
	public function getParent()
	{
		return 'FOSUserBundle';
	}
}
