<?php

declare(strict_types=1);

/**
 * Primary Metabox Controller for all Post's
 */

namespace PinkCrab\Headless_Blog\Content_Component;

use PC_Headless_Blog_1AA\PinkCrab\Loader\Loader;
use PC_Headless_Blog_1AA\PinkCrab\Registerables\MetaBox;
use PC_Headless_Blog_1AA\PinkCrab\Core\Services\View\View;
use PC_Headless_Blog_1AA\PinkCrab\Core\Application\App_Config;
use PC_Headless_Blog_1AA\PinkCrab\Core\Interfaces\Registerable;

class Component_Metabox_Controller implements Registerable {

	/** @var View */
	protected $view;

	/** @var App_Config */
	protected $app_config;

	/** @var Component_Library */
	protected $component_library;

	public function __construct(
		View $view,
		App_Config $app_config,
		Component_Library $component_library
	) {
		$this->view              = $view;
		$this->app_config        = $app_config;
		$this->component_library = $component_library;
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
		$r = MetaBox::normal( 'content-component-metabox' )
			->label( 'Content Compoents' )
			->screen( 'post' )
			->set_renderable( $this->view->engine() )
			->view_vars(
				array(
					'components' => $this->component_library->get_components(),
				)
			)
			->render( 'content-component.layouts.metabox' )
			->register( $loader );
	}
}
