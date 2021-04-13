<?php

declare(strict_types=1);

/**
 * Enqueue all scripts and styles for content components.
 */

namespace PinkCrab\Headless_Blog\Content_Component;

use PC_Headless_Blog_1AA\PinkCrab\Loader\Loader;
use PC_Headless_Blog_1AA\PinkCrab\Enqueue\Enqueue;
use PC_Headless_Blog_1AA\PinkCrab\Core\Application\App_Config;
use PC_Headless_Blog_1AA\PinkCrab\Core\Interfaces\Registerable;

class Component_Enqueue_Controller implements Registerable {

	/** @var array{admin_metabox:string} */
	public const SCRIPT_HANDLES = array(
		'admin_metabox' => 'contentComponentMetaBoxScript',
	);

	/** @var App_Config */
	protected $config;

	public function __construct( App_Config $config ) {
		$this->config = $config;
	}

	public function register( Loader $loader ): void {
		$loader->admin_action( 'admin_enqueue_scripts', array( $this, 'admin_scripts' ) );
	}

	/** Enqueue all admin scripts */
	public function admin_scripts( string $hook ): void {
		// Only enqueue for edit.php
		if ( $hook !== 'post.php' ) {
			return;
		}

		// Main metabox view file.
		Enqueue::script( self::SCRIPT_HANDLES['admin_metabox'] )
			->src( $this->config->url( 'assets' ) . 'js/content-components/metabox.js' )
			->deps( 'jquery' )
			->ver( $this->config->version() )
			->register();
	}
}