<?php

namespace PC_Headless_Blog_1AA;

use PC_Headless_Blog_1AA\PinkCrab\Core\Tests\Fixtures\DI\Interface_A;
use PC_Headless_Blog_1AA\PinkCrab\Core\Tests\Fixtures\DI\Dependency_E;
/**
 * Stub file for testing Dice Dependencies.
 */
return array(
    // Silence
    \PC_Headless_Blog_1AA\PinkCrab\Core\Tests\Fixtures\DI\Interface_A::class => array('instanceOf' => \PC_Headless_Blog_1AA\PinkCrab\Core\Tests\Fixtures\DI\Dependency_E::class),
);
