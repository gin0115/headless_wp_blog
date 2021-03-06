<?php

declare (strict_types=1);
/**
 * Interface for tests, must impliment a get(): mixed method.
 *
 * @since 0.2.0
 * @author Glynn Quelch <glynn.quelch@gmail.com>
 * @license http://www.opensource.org/licenses/mit-license.html  MIT License
 * @package PinkCrab\Core
 */
namespace PC_Headless_Blog_1AA\PinkCrab\Core\Tests\Fixtures\Mock_Objects;

interface Interface_Get
{
    /**
     * @return mixed
     */
    public function get_property_a();
}
