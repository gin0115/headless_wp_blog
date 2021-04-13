<?php

namespace PC_Headless_Blog_1AA;

use PC_Headless_Blog_1AA\Dice\Dice;
use PC_Headless_Blog_1AA\PinkCrab\HTTP\HTTP;
use PC_Headless_Blog_1AA\PinkCrab\Registerables\Ajax;
use PC_Headless_Blog_1AA\PinkCrab\Core\Application\App;
use PC_Headless_Blog_1AA\PinkCrab\Core\Services\Dice\WP_Dice;
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
    $app = \PC_Headless_Blog_1AA\PinkCrab\Core\Application\App::init(new \PC_Headless_Blog_1AA\PinkCrab\Core\Services\ServiceContainer\Container());
    $di = \PC_Headless_Blog_1AA\PinkCrab\Core\Services\Dice\WP_Dice::constructWith(new \PC_Headless_Blog_1AA\Dice\Dice());
    $di->addRules(array(\PC_Headless_Blog_1AA\PinkCrab\Registerables\Ajax::class => array('constructParams' => array((new \PC_Headless_Blog_1AA\PinkCrab\HTTP\HTTP())->request_from_globals()), 'shared' => \true, 'inherit' => \true)));
    $app->set('di', $di);
});
// Start up the WP testing environment.
require \getenv('WP_PHPUNIT__DIR') . '/includes/bootstrap.php';
