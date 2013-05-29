<?php

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
