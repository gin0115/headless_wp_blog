<?php

declare (strict_types=1);
/**
 * Factory for creating standard instances of the App.
 *
 * @author Glynn Quelch <glynn.quelch@gmail.com>
 * @license http://www.opensource.org/licenses/mit-license.html  MIT License
 * @package PinkCrab\Core
 * @since 0.4.0
 */
namespace PC_Headless_Blog_1AA\PinkCrab\Core\Application;

use PC_Headless_Blog_1AA\Dice\Dice;
use PC_Headless_Blog_1AA\PinkCrab\Loader\Loader;
use PC_Headless_Blog_1AA\PinkCrab\Core\Application\App;
use PC_Headless_Blog_1AA\PinkCrab\Core\Interfaces\Renderable;
use PC_Headless_Blog_1AA\PinkCrab\Core\Interfaces\DI_Container;
use PC_Headless_Blog_1AA\PinkCrab\Core\Services\View\PHP_Engine;
use PC_Headless_Blog_1AA\PinkCrab\Core\Services\Dice\PinkCrab_Dice;
use PC_Headless_Blog_1AA\PinkCrab\Core\Services\Registration\Registration_Service;
use PC_Headless_Blog_1AA\PinkCrab\Core\Services\Registration\Middleware\Registerable_Middleware;
class App_Factory
{
    /**
     * The app instance.
     *
     * @var App
     */
    protected $app;
    public function __construct()
    {
        $this->app = new \PC_Headless_Blog_1AA\PinkCrab\Core\Application\App();
    }
    /**
     * Pre populates a standard isntance of the App
     * Uses the PinkCrab_Dice container
     * Sets up registration and loader instances.
     * Adds Registerable Middleware
     *
     * Just requires Class List, Config and DI Rules.
     *
     * @return self
     */
    public function with_wp_dice(bool $include_default_rules = \false) : self
    {
        $loader = new \PC_Headless_Blog_1AA\PinkCrab\Loader\Loader();
        // Setup DI Container
        $container = \PC_Headless_Blog_1AA\PinkCrab\Core\Services\Dice\PinkCrab_Dice::withDice(new \PC_Headless_Blog_1AA\Dice\Dice());
        if ($include_default_rules === \true) {
            $container->addRules($this->default_di_rules());
        }
        $this->app->set_container($container);
        // Set registration middleware
        $this->app->set_registration_services(new \PC_Headless_Blog_1AA\PinkCrab\Core\Services\Registration\Registration_Service());
        $this->app->set_loader($loader);
        // Include Registerables.
        $this->app->registration_middleware(new \PC_Headless_Blog_1AA\PinkCrab\Core\Services\Registration\Middleware\Registerable_Middleware($loader));
        return $this;
    }
    /**
     * Returns the basic DI rules which are used to set.
     * WPDB
     * Renderable with PHP_Engine implementation
     *
     * @return array<mixed>
     */
    protected function default_di_rules() : array
    {
        return array('*' => array('substitutions' => array(\PC_Headless_Blog_1AA\PinkCrab\Core\Interfaces\Renderable::class => new \PC_Headless_Blog_1AA\PinkCrab\Core\Services\View\PHP_Engine(__DIR__), \wpdb::class => $GLOBALS['wpdb'])));
    }
    /**
     * Set the DI rules
     *
     * @param array<string,array<string,string|object|callable|null|false|\Closure>> $rules
     * @return self
     */
    public function di_rules(array $rules) : self
    {
        $this->app->container_config(function (\PC_Headless_Blog_1AA\PinkCrab\Core\Interfaces\DI_Container $container) use($rules) : void {
            $container->addRules($rules);
        });
        return $this;
    }
    /**
     * Sets the registation class list.
     *
     * @param array<int, string> $class_list Array of fully namespaced class names.
     * @return self
     */
    public function registration_classses(array $class_list) : self
    {
        $this->app->registration_classses($class_list);
        return $this;
    }
    /**
     * Sets the apps internal config
     *
     * @param array<string, mixed> $app_config
     * @return self
     */
    public function app_config(array $app_config) : self
    {
        $this->app->set_app_config($app_config);
        return $this;
    }
    /**
     * Returns the populated app.
     *
     * @return \PinkCrab\Core\Application\App
     */
    public function app() : \PC_Headless_Blog_1AA\PinkCrab\Core\Application\App
    {
        return $this->app;
    }
    /**
     * Returns a booted version of the app.
     *
     * @return \PinkCrab\Core\Application\App
     */
    public function boot() : \PC_Headless_Blog_1AA\PinkCrab\Core\Application\App
    {
        // Sets defualt settings if not already set.
        if (!$this->app->has_app_config()) {
            $this->app_config(array());
        }
        return $this->app->boot();
    }
}
