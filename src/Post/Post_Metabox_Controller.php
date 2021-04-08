<?php

declare(strict_types=1);

/**
 * Primary Metabox Controller for all Post's
 */

namespace PinkCrab\Headless_Blog\Post;

use PC_Headless_Blog_1AA\PinkCrab\Loader\Loader;
use PC_Headless_Blog_1AA\PinkCrab\Core\Interfaces\Registerable;

class Post_Metabox_Controller implements Registerable {

	/**
	 * Hook loader.
	 *
	 * @param \PC_Headless_Blog_1AA\PinkCrab\Loader\Loader $loader
	 * @return void
	 */
	public function register( Loader $loader ): void {
		# code...
	}
}
