<?php

declare(strict_types=1);

require __DIR__ . '/Patcher_Manger/Patcher_Dispatcher.php';

use Isolated\Symfony\Component\Finder\Finder;

// Create the patcher dispatcher.
$parch_dispatcher = new Patcher_Dispatcher( __DIR__ . '/patchers' );



return array(
	// Set your namespace prefix here
	'prefix'                     => 'PC_Headless_Blog_1AA',
	'finders'                    => array(
		Finder::create()
			->files()
			->ignoreVCS( true )
			->notName( '/LICENSE|.*\\.md|.*\\.dist|Makefile|composer\\.json|composer\\.lock/' )
			->exclude(
				array(
					'doc',
					'vendor-bin',
				)
			)
			->in( 'vendor' ),
		Finder::create()->append(
			array(
				'composer.json',
			)
		),
	),
	'patchers'                   => array(
		function ( $filePath, $prefix, $contents ) use ( $parch_dispatcher ) {

			foreach ( $parch_dispatcher->get_patcher_elements() as $identifier ) {
				$contents = str_replace( "\\$prefix\\$identifier", "\\$identifier", $contents );
			}

			// Add in any additional symbols to not prefix.
			// $contents = str_replace( "\\$prefix\\my_global_function", '\\my_global_function', $contents );

			return $contents;
		},
	),
	'whitelist'                  => array(
		'PHPUnit\Framework\*',
		'Composer\Autoload\ClassLoader',
		'PinkCrab\Headless_Blog\*',
	),
	'whitelist-global-constants' => true,
	'whitelist-global-classes'   => true,
	'whitelist-global-functions' => true,
);
