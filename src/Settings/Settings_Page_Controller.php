<?php

declare(strict_types=1);

/**
 * The primary admin menu group.
 *
 * @author Glynn Quelch <glynn.quelch@gmail.com>
 * @package Settings
 * @since 1.0.0
 */

namespace PinkCrab\Headless_Blog\Settings;

use PC_Headless_Blog_1AA\PinkCrab\Loader\Loader;
use PC_Headless_Blog_1AA\PinkCrab\Core\Interfaces\Registerable;

class Settings_Page_Controller implements Registerable {

	/**
	 * Register all hook calls for the settings page.
	 *
	 * @param \PC_Headless_Blog_1AA\PinkCrab\Loader\Loader $loader
	 * @return void
	 */
	public function register( Loader $loader ): void {
		# code...
	}

	/**
	 * Returns the view data used for the settings page.
	 *
	 * @return array
	 */
	public function page_view_data(): array {
		return array(
			'key' => 'value',
		);
	}
}
