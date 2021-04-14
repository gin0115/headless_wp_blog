<?php

declare(strict_types=1);

/**
 * Abstract component.
 */

namespace PinkCrab\Headless_Blog\Content_Component\Component;

class Header extends Abstract_Component {

	protected $title = 'header';
    
    /** @inheritdoc */
	public function to_array(): array {
		return $this->render_base_args();
	}
}
