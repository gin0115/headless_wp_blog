<?php

declare(strict_types=1);

/**
 * Handles all depenedency injection rules and config.
 *
 * @package PinkCrab\Headless_Blog
 * @author Glynn Quelch glynn@pinkcrab.co.uk
 * @since 1.0.0
 */

use PC_Headless_Blog_1AA\PinkCrab\HTTP\HTTP_Helper;
use PC_Headless_Blog_1AA\PinkCrab\BladeOne\BladeOne_Provider;
use PC_Headless_Blog_1AA\PinkCrab\Core\Interfaces\Renderable;
use PinkCrab\Headless_Blog\Content_Component\Component_Library;
use PC_Headless_Blog_1AA\Psr\Http\Message\ServerRequestInterface;
use PinkCrab\Headless_Blog\Content_Component\Component\Header as Header_Component;

return array(
	'*'                      => array(
		'substitutions' => array(
			Renderable::class             => BladeOne_Provider::init(
				\dirname( __DIR__, 1 ) . '/views',
				ABSPATH . 'blade_cache',
				5 // Debug mode
			),
			ServerRequestInterface::class => HTTP_Helper::global_server_request(),
		),
	),
	// Pass all components to the library.
	Component_Library::class => array(
		'constructParams' => array( ...array( Header_Component::class ) ),
	),
);

