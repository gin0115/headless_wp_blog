<?php

namespace PC_Headless_Blog_1AA;

use PC_Headless_Blog_1AA\Dice\Dice;
use PC_Headless_Blog_1AA\PinkCrab\Core\Application\App;
use PC_Headless_Blog_1AA\PinkCrab\Core\Interfaces\Renderable;
use PC_Headless_Blog_1AA\PinkCrab\Core\Services\Dice\WP_Dice;
use PC_Headless_Blog_1AA\PinkCrab\Core\Application\App_Factory;
use PC_Headless_Blog_1AA\PinkCrab\Core\Services\View\PHP_Engine;
use PC_Headless_Blog_1AA\Gin0115\WPUnit_Helpers\WP\WP_Dependencies;
use PC_Headless_Blog_1AA\PinkCrab\Core\Services\ServiceContainer\Container;
/**
 * PHPUnit bootstrap file
 */
// Composer autoloader must be loaded before WP_PHPUNIT__DIR will be available
require_once \dirname(__DIR__) . '/vendor/autoload.php';
// Give access to tests_add_filter() function.
require_once \getenv('WP_PHPUNIT__DIR') . '/includes/functions.php';
$wp_install_path = \dirname(__FILE__, 2) . '/wordpress';
\define('TEST_WP_ROOT', $wp_install_path);
\PC_Headless_Blog_1AA\tests_add_filter('muplugins_loaded', function () {
    // Boot an instance of the app, with the view path set.
    (new \PC_Headless_Blog_1AA\PinkCrab\Core\Application\App_Factory())->with_wp_dice(\true)->di_rules(array('*' => array('substitutions' => array(\PC_Headless_Blog_1AA\PinkCrab\Core\Interfaces\Renderable::class => new \PC_Headless_Blog_1AA\PinkCrab\Core\Services\View\PHP_Engine(__DIR__ . '/Mocks')))))->boot();
    // Install ACF
    $acf_plugin_url = 'https://github.com/wp-premium/advanced-custom-fields-pro/archive/refs/heads/master.zip';
    $acf_plugin_file = 'advanced-custom-fields-pro-master/acf.php';
    try {
        \PC_Headless_Blog_1AA\Gin0115\WPUnit_Helpers\WP\WP_Dependencies::install_remote_plugin_from_zip($acf_plugin_url, \TEST_WP_ROOT);
    } catch (\Throwable $th) {
        print 'Failed to install plugin';
        print $th->getMessage();
        print 'Cancelling setup';
        exit;
    }
    \PC_Headless_Blog_1AA\Gin0115\WPUnit_Helpers\WP\WP_Dependencies::activate_plugin($acf_plugin_file);
});
// Start up the WP testing environment.
require \getenv('WP_PHPUNIT__DIR') . '/includes/bootstrap.php';
