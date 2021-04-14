<?php

declare(strict_types=1);

/**
 * Holds all components
 */

namespace PinkCrab\Headless_Blog\Content_Component;

use PinkCrab\Headless_Blog\Content_Component\Component\Abstract_Component;

class Component_Library {

	/** @var array<Abstract_Component> */
	protected $components;

	public function __construct( ...$component ) {
		$this->components = array_map(
			function( string $class ): Abstract_Component {
				return new $class();
			},
			$component
		);
	}

	/** @return array<Abstract_Component> */
	public function get_components(): array {
		return $this->components;
	}
}
