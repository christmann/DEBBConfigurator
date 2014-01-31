<?php
/**
 * DEBBConfigurator - A configurator for DEBB component and PLMXML files
 * Copyright (C) 2013-2014 christmann informationstechnik + medien GmbH & Co. KG
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Library General Public
 * License as published by the Free Software Foundation; either
 * version 2 of the License, or (at your option) any later version.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
 * Library General Public License for more details.
 *
 * You should have received a copy of the GNU Library General Public
 * License along with this library; if not, write to the
 * Free Software Foundation, Inc., 51 Franklin St, Fifth Floor,
 * Boston, MA  02110-1301, USA.
 */

namespace Debb\ManagementBundle\Features\Context;

use Symfony\Component\HttpKernel\KernelInterface;
use Behat\Symfony2Extension\Context\KernelAwareInterface;
use Behat\MinkExtension\Context\MinkContext;
use Behat\Behat\Context\BehatContext,
	Behat\Behat\Exception\PendingException;
use Behat\Gherkin\Node\PyStringNode,
	Behat\Gherkin\Node\TableNode;

require_once 'PHPUnit/Autoload.php';
require_once 'PHPUnit/Framework/Assert/Functions.php';

/**
 * Feature context.
 * @author Patrick Bußmann <patrick.bussmann@christmann.info>
 */
class FeatureContext extends BehatContext //MinkContext if you want to test web implements KernelAwareInterface
{

    /**
     * @var
     */
    private $kernel;

    /**
     * @var array
     */
    private $parameters;

	/**
	 * Initializes context with parameters from behat.yml.
	 *
	 * @param array $parameters
	 */
	public
		function __construct(array $parameters)
	{
		$this->parameters = $parameters;
	}

	/**
	 * Sets HttpKernel instance.
	 * This method will be automatically called by Symfony2Extension ContextInitializer.
	 *
	 * @param KernelInterface $kernel
	 */
	public
		function setKernel(KernelInterface $kernel)
	{
		$this->kernel = $kernel;
	}

}
