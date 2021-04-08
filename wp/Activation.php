<?php

declare(strict_types=1);

/**
 * Actiation hook event.
 *
 * @package PinkCrab\Headless_Blog
 * @author Glynn Quelch glynn@pinkcrab.co.uk
 * @since 1.0.0
 */

namespace PinkCrab\WP\Headless_Blog;

use PinkCrab\WP\Headless_Blog\Uninstalled;
use PC_Headless_Blog_1AA\PinkCrab\Core\Application\App;

class Activation {

	/**
	 * Entry point for action hook call.
	 *
	 * @return void
	 */
	public function activate() {
		// Register unistall hook.
		register_uninstall_hook( __FILE__, array( App::make( Uninstalled::class ), 'uninstall' ) );
	}
}
