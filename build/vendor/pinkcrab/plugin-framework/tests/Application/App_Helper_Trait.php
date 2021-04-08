<?php

declare (strict_types=1);
/**
 * Helper trait for all App tests
 * Includes clearing the internal state of an existing instance.
 *
 * @since 0.4.0
 * @author Glynn Quelch <glynn.quelch@gmail.com>
 * @license http://www.opensource.org/licenses/mit-license.html  MIT License
 * @package PinkCrab\Core
 */
namespace PC_Headless_Blog_1AA\PinkCrab\Core\Tests\Application;

use PC_Headless_Blog_1AA\PinkCrab\Core\Application\App;
use PC_Headless_Blog_1AA\Dice\Dice;
use PC_Headless_Blog_1AA\PinkCrab\Loader\Loader;
use PC_Headless_Blog_1AA\PinkCrab\Core\Services\Dice\PinkCrab_Dice;
use PC_Headless_Blog_1AA\PinkCrab\Core\Services\Registration\Registration_Service;
use PC_Headless_Blog_1AA\Gin0115\WPUnit_Helpers\Objects;
trait App_Helper_Trait
{
    /**
     * Resets the any existing App isntance with default properties.
     *
     * @return void
     */
    protected static function unset_app_instance() : void
    {
        $app = new \PC_Headless_Blog_1AA\PinkCrab\Core\Application\App();
        \PC_Headless_Blog_1AA\Gin0115\WPUnit_Helpers\Objects::set_property($app, 'app_config', null);
        \PC_Headless_Blog_1AA\Gin0115\WPUnit_Helpers\Objects::set_property($app, 'container', null);
        \PC_Headless_Blog_1AA\Gin0115\WPUnit_Helpers\Objects::set_property($app, 'registration', null);
        \PC_Headless_Blog_1AA\Gin0115\WPUnit_Helpers\Objects::set_property($app, 'loader', null);
        \PC_Headless_Blog_1AA\Gin0115\WPUnit_Helpers\Objects::set_property($app, 'booted', \false);
        $app = null;
    }
    /**
     * Returns an instance of app (not booted) populated with actual
     * service objects.
     *
     * No registration classes are added, di has no rules, loader is empty
     * but there is the settings from the Fixtures/Application added so we can 
     * use template paths in the App:view() tests.
     *
     * Is a plain and basic instance.
     *
     * @return App
     */
    protected function pre_populated_app_provider() : \PC_Headless_Blog_1AA\PinkCrab\Core\Application\App
    {
        // Build and populate the app.
        $app = new \PC_Headless_Blog_1AA\PinkCrab\Core\Application\App();
        $registration = new \PC_Headless_Blog_1AA\PinkCrab\Core\Services\Registration\Registration_Service();
        $container = new \PC_Headless_Blog_1AA\PinkCrab\Core\Services\Dice\PinkCrab_Dice(new \PC_Headless_Blog_1AA\Dice\Dice());
        $loader = new \PC_Headless_Blog_1AA\PinkCrab\Loader\Loader();
        $app->set_container($container);
        $app->set_registration_services($registration);
        $app->set_loader($loader);
        $app->set_app_config(include FIXTURES_PATH . '/Application/settings.php');
        return $app;
    }
}
