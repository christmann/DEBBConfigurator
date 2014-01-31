DEBBConfigurator
========================

The DEBBConfigurator is a component of the CoolEmAll GUI.

1) Installation
----------------------------------

You can install the project with composer if you checked out this project with the following command.

	git pull https://github.com/christmann/DEBBConfigurator.git

Download it if you don't have Composer:

	curl -sS https://getcomposer.org/installer | php

Or if you have no curl:

	php -r "eval('?>'.file_get_contents('https://getcomposer.org/installer'));"

Then you can install the vendors:

	php composer.phar install

After that you need to setup your database connection and other settings.

	cp app/config/parameters.yml.dist app/config/parameters.yml
	nano app/config/parameters.yml

You could use the configurator at http://localhost/project/web/config.php, too.
Please note that you must change localhost/project/web for your needs.

**Now you have finished the basic setup.**

2) Make project running
-------------------------------------

You need to clean up the cache and create the database etc.

    php app/console cache:clear
	php app/console doctrine:schema:update --force
	php app/console assets:install --symlink web
	php app/console assetic:dump

If you want to make this project public you should use "--env=prod".
For example:

	php app/console cache:clear --env=prod
	php app/console doctrine:schema:update --force --env=prod
	php app/console assets:install --symlink web --env=prod
	php app/console assetic:dump --env=prod

Whats inside?
---------------

The DEBBConfigurator uses the following bundles.

  * **FrameworkBundle** - The core Symfony framework bundle
  * [**SecurityBundle**][1] - Adds security by integrating Symfony's security
    component
  * [**TwigBundle**][2] - Adds support for the Twig templating engine
  * [**MonologBundle**][3] - Adds support for Monolog, a logging library
  * [**SwiftmailerBundle**][4] - Adds support for Swiftmailer, a library for
    sending emails
  * [**AsseticBundle**][5] - Adds support for Assetic, an asset processing
    library
  * [**DoctrineBundle**][6] - Adds support for the Doctrine ORM
  * [**SensioFrameworkExtraBundle**][7] - Adds several enhancements, including
    template and routing annotation capability
  * [**KnpMenuBundle**][9] - Object Oriented menus for your Symfony2 project.
  * [**LocaldevFrameworkExtraBundle**][10] - Provides a lots of CRUD controller features.
  * [**LocaldevAdminBundle**][11] - Provides templates and controllers for easy delete/edit/show entities
  * [**AvalancheImagineBundle**][12] - Image manipulation using Imagine and Twig Filters
  * [**BazingaJsTranslationBundle**][13] - A pretty nice way to expose your Symfony2 translation messages to your client applications
  * [**FOSUserBundle**][14] - Provides user management for your Symfony2 Project
  * **CIMPluploadBundle** - Provides a plupload upload
  * **CoolEmAllUserBundle** - Added extra features for the FOSUserBundle
  * **DebbConfigBundle** - Thats the main bundle for the DEBBConfigurator
  * **DebbManagementBundle** - Provides components for the DebbConfigBundle
  * **WebProfilerBundle** (in dev/test env) - Adds profiling functionality and
    the web debug toolbar
  * **SensioDistributionBundle** (in dev/test env) - Adds functionality for
    configuring and working with Symfony distributions
  * [**SensioGeneratorBundle**][8] (in dev/test env) - Adds code generation
    capabilities

All libraries and bundles included are released under the MIT or BSD license.

Enjoy!

[1]: https://github.com/symfony/SecurityBundle
[2]: https://github.com/symfony/TwigBundle
[3]: https://github.com/symfony/MonologBundle
[4]: https://github.com/symfony/SwiftmailerBundle
[5]: https://github.com/symfony/AsseticBundle
[6]: https://github.com/doctrine/DoctrineBundle
[7]: https://github.com/sensiolabs/SensioFrameworkExtraBundle
[8]: https://github.com/sensiolabs/SensioGeneratorBundle
[9]: https://github.com/KnpLabs/KnpMenuBundle
[10]: http://gitlab.localdev.de/bundles/framework-extra-bundle.git
[11]: http://gitlab.localdev.de/bundles/admin-bundle.git
[12]: https://github.com/avalanche123/AvalancheImagineBundle
[13]: https://github.com/willdurand/BazingaJsTranslationBundle
[14]: https://github.com/FriendsOfSymfony/FOSUserBundle