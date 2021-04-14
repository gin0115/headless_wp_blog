<?php

declare(strict_types=1);

/**
 * Abstract component.
 */

namespace PinkCrab\Headless_Blog\Content_Component\Component;

abstract class Abstract_Component {

	/**
	 * Component Title (type)
	 *
	 * @var string
	 */
	protected $title;

	/**
	 * Components unique key
	 *
	 * @var string
	 */
	protected $key;

	/**
	 * Wrapper class list
	 *
	 * @var array
	 */
	protected $wrapper_classes = array();

	/**
	 * Wrapper attributes
	 *
	 * @var array
	 */
	protected $wrapper_attributes = array();

	/**
	 * Exports the compoent as an array.
	 *
	 * @return array<string, mixed>
	 */
	abstract public function to_array(): array;

	/**
	 * Returns the base args.
	 *
	 * @return array{title:string,key:string,wrapper_classes:string[],wrapper_attributes:string[]}
	 */
	protected function render_base_args(): array {
		return array(
			'title'              => $this->title,
			'key'                => $this->key,
			'wrapper_classes'    => $this->wrapper_classes,
			'wrapper_attributes' => $this->wrapper_attributes,
		);
	}

	/**
	 * Get component Title (type)
	 *
	 * @return string
	 */
	public function get_title(): string {
		return $this->title;
	}

	/**
	 * Set component Title (type)
	 *
	 * @param string $title  Component Title (type)
	 * @return self
	 */
	public function title( string $title ): self {
		$this->title = $title;
		return $this;
	}

	/**
	 * Get components unique key
	 * @return string
	 */
	public function get_key(): string {
		return $this->key;
	}

	/**
	 * Set components unique key
	 *
	 * @param string $key  Components unique key
	 * @return self
	 */
	public function key( string $key ): self {
		$this->key = $key;
		return $this;
	}

	/**
	 * Get wrapper class list
	 *
	 * @return array<string>
	 */
	public function get_wrapper_classes(): array {
		return $this->wrapper_classes;
	}

	/**
	 * Set wrapper class list
	 *
	 * @param array<string> $wrapper_classes  Wrapper class list
	 * @return self
	 */
	public function wrapper_classes( array $wrapper_classes ): self {
		$this->wrapper_classes = $wrapper_classes;
		return $this;
	}

	/**
	 * Get wrapper attributes
	 * @return array<string>
	 */
	public function get_wrapper_attributes(): array {
		return $this->wrapper_attributes;
	}

	/**
	 * Set wrapper attributes
	 *
	 * @param array<string> $wrapper_attributes  Wrapper attributes
	 * @return self
	 */
	public function wrapper_attributes( array $wrapper_attributes ): self {
		$this->wrapper_attributes = $wrapper_attributes;
		return $this;
	}
}
