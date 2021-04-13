<?php

declare(strict_types=1);

/**
 * Primary Metabox Controller for all Post's
 */

namespace PinkCrab\Headless_Blog\Post;

use PC_Headless_Blog_1AA\PinkCrab\Loader\Loader;
use PC_Headless_Blog_1AA\PinkCrab\Registerables\MetaBox;
use PC_Headless_Blog_1AA\PinkCrab\Core\Services\View\View;
use PC_Headless_Blog_1AA\PinkCrab\Core\Application\App_Config;
use PC_Headless_Blog_1AA\PinkCrab\Core\Interfaces\Registerable;

class Post_Metabox_Controller implements Registerable {

	protected ?View $view;
	protected ?App_Config $app_config;

	public function __construct( View $view, App_Config $app_config ) {
		$this->view       = $view;
		$this->app_config = $app_config;
	}

	/**
	 * Hook loader.
	 *
	 * @param \PC_Headless_Blog_1AA\PinkCrab\Loader\Loader $loader
	 * @return void
	 */
	public function register( Loader $loader ): void {
		$this->register_metabox( $loader );
	}

	/**
	 * Registers the metabox
	 */
	protected function register_metabox( Loader $loader ) {
		MetaBox::normal( 'my_metabox_key_1' )
			->label( 'My MetaBox' )
			->screen( 'post' )
			->view( array( $this, 'metabox_view' ) )
			->register( $loader );
	}

	/**
	 * Renders the metaboxes view
	 * Is bound to class to access $my_service
	 */
	public function metabox_view( \WP_Post $post, array $args ): void {
		dump( $this );
	}
}
