<?php

declare (strict_types=1);
/**
 * tests the JsonSerializeable interface on collections.
 *
 * @since 0.1.0
 * @author Glynn Quelch <glynn.quelch@gmail.com>
 * @license http://www.opensource.org/licenses/mit-license.html  MIT License
 * @package PinkCrab\Core
 */
namespace PC_Headless_Blog_1AA\PinkCrab\Core\Tests\Collection;

use PC_Headless_Blog_1AA\PinkCrab\Core\Tests\Fixtures\Mock_Objects\Json_Serializeable_Collection;
use PC_Headless_Blog_1AA\WP_UnitTestCase;
class Test_Json_Serializeable_Collection extends \WP_UnitTestCase
{
    public function test_can_json_encode()
    {
        $array = array(1, 2, 3, 4, 5);
        $collection = new \PC_Headless_Blog_1AA\PinkCrab\Core\Tests\Fixtures\Mock_Objects\Json_Serializeable_Collection($array);
        $this->assertSame(\json_encode($array), \json_encode($collection));
    }
}
