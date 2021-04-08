<?php

declare (strict_types=1);
/**
 * Dependency C
 * Extends Abstract_B
 *
 * @since 0.2.0
 * @author Glynn Quelch <glynn.quelch@gmail.com>
 * @license http://www.opensource.org/licenses/mit-license.html  MIT License
 * @package PinkCrab\Core
 */
namespace PC_Headless_Blog_1AA\PinkCrab\Core\Tests\Fixtures\DI;

use PC_Headless_Blog_1AA\PinkCrab\Core\Tests\Fixtures\DI\Abstract_B;
class Dependency_C extends \PC_Headless_Blog_1AA\PinkCrab\Core\Tests\Fixtures\DI\Abstract_B
{
    public function foo()
    {
        return self::class;
    }
}
