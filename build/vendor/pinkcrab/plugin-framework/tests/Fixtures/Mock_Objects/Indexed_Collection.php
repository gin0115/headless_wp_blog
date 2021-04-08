<?php

declare (strict_types=1);
/**
 * Collection mock using the Indexed trait.
 *
 * @since 0.2.0
 * @author Glynn Quelch <glynn.quelch@gmail.com>
 * @license http://www.opensource.org/licenses/mit-license.html  MIT License
 * @package PinkCrab\Core
 */
namespace PC_Headless_Blog_1AA\PinkCrab\Core\Tests\Fixtures\Mock_Objects;

use PC_Headless_Blog_1AA\PinkCrab\Core\Collection\Collection;
use PC_Headless_Blog_1AA\PinkCrab\Core\Collection\Traits\Indexed;
class Indexed_Collection extends \PC_Headless_Blog_1AA\PinkCrab\Core\Collection\Collection
{
    use Indexed;
}
