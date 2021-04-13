<?php

declare(strict_types=1);

/**
 * Handles all depenedency injection rules and config.
 *
 * @package PinkCrab\Headless_Blog
 * @author Glynn Quelch glynn@pinkcrab.co.uk
 * @since 1.0.0
 */

use PC_Headless_Blog_1AA\PinkCrab\BladeOne\BladeOne_Provider;
use PC_Headless_Blog_1AA\PinkCrab\Core\Interfaces\Renderable;

return array(
	'*' => array(
		'substitutions' => array(
			Renderable::class => BladeOne_Provider::init(
				\dirname( __DIR__, 1 ) . '/views',
				ABSPATH . 'blade_cache',
				5 // Debug mode
			),
		),
	),
);

