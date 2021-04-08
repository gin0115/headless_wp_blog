<?php

/**
 * @wordpress-plugin
 * Plugin Name:     PinkCrab Headless Blog Core
 * Plugin URI:      https://github.com/gin0115/headless_wp_blog
 * Description:     The core functionality for the PinkCrab Headless Blog Core
 * Version:         1.0.0
 * Author:          Glynn Quelch
 * Author URI:      https://github.com/gin0115/
 * License:         GPL-2.0+
 * License URI:     http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:     pinkcrab-headless-blog
 */

use PC_Headless_Blog_1AA\PinkCrab\Core\Application\App_Factory;

require_once __DIR__ . '/function_pollyfills.php';
require_once __DIR__ . '/build/vendor/autoload.php';

( new App_Factory() )->with_wp_dice( true )
	->di_rules( require __DIR__ . '/config/dependencies.php' )
	->app_config( require __DIR__ . '/config/settings.php' )
	->registration_classses( require __DIR__ . '/config/registration.php' )
	->boot();
