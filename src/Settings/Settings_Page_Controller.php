<?php

declare(strict_types=1);

/**
 * Page controller for the settings.
 *
 * @author Glynn Quelch <glynn.quelch@gmail.com>
 * @package Settings
 * @since 1.0.0
 */

namespace PinkCrab\Headless_Blog\Settings;

use PC_Headless_Blog_1AA\PinkCrab\Loader\Loader;
use PC_Headless_Blog_1AA\PinkCrab\Core\Application\App_Config;
use PC_Headless_Blog_1AA\PinkCrab\Core\Interfaces\Registerable;
use PC_Headless_Blog_1AA\Psr\Http\Message\ServerRequestInterface;

class Settings_Page_Controller implements Registerable {

	/**
	 * Access to apps config.
	 *
	 * @var App_Config
	 */
	protected $config;

	/**
	 * Current global server request
	 *
	 * @var ServerRequestInterface
	 */
	protected $request;

	public function __construct(
		App_Config $config,
		ServerRequestInterface $request
	) {
		$this->config  = $config;
		$this->request = $request;
	}

	/**
	 * Register all hook calls for the settings page.
	 *
	 * @param \PC_Headless_Blog_1AA\PinkCrab\Loader\Loader $loader
	 * @return void
	 */
	public function register( Loader $loader ): void {
		$loader->action( "toplevel_page_{$this->config->settings_page_slug}", array( $this, 'update_settings' ) );
	}

	/**
	 * Updates the current setttings.
	 *
	 * @return void
	 */
	public function update_settings(): void {
		dump( 'HEAD', $this );
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
