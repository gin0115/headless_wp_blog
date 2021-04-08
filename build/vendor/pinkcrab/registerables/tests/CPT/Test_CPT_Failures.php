<?php

declare (strict_types=1);
/**
 * Tests that exceptions are thrown for missing values.
 *
 * @since 0.1.0
 * @author Glynn Quelch <glynn.quelch@gmail.com>
 * @license http://www.opensource.org/licenses/mit-license.html  MIT License
 * @package PinkCrab\Core
 */
namespace PC_Headless_Blog_1AA\PinkCrab\Registerables\Tests;

use PC_Headless_Blog_1AA\WP_UnitTestCase;
use InvalidArgumentException;
use PC_Headless_Blog_1AA\Gin0115\WPUnit_Helpers\Objects;
use PC_Headless_Blog_1AA\PinkCrab\Registerables\Tests\Fixtures\CPT\Basic_CPT;
use PC_Headless_Blog_1AA\PinkCrab\Registerables\Tests\Fixtures\CPT\Invlaid_CPT;
class Test_CPT_Failures extends \WP_UnitTestCase
{
    /**
     * Test exception thrown if no key
     *
     * @return void
     */
    public function test_throws_exception_no_slug()
    {
        $cpt = new \PC_Headless_Blog_1AA\PinkCrab\Registerables\Tests\Fixtures\CPT\Basic_CPT();
        \PC_Headless_Blog_1AA\Gin0115\WPUnit_Helpers\Objects::set_property($cpt, 'key', null);
        $this->expectException(\InvalidArgumentException::class);
        \PC_Headless_Blog_1AA\Gin0115\WPUnit_Helpers\Objects::invoke_method($cpt, 'validate', array());
    }
    /**
     * Test exception thrown if no singular
     *
     * @return void
     */
    public function test_throws_exception_no_singular()
    {
        $cpt = new \PC_Headless_Blog_1AA\PinkCrab\Registerables\Tests\Fixtures\CPT\Basic_CPT();
        \PC_Headless_Blog_1AA\Gin0115\WPUnit_Helpers\Objects::set_property($cpt, 'singular', \false);
        $this->expectException(\InvalidArgumentException::class);
        \PC_Headless_Blog_1AA\Gin0115\WPUnit_Helpers\Objects::invoke_method($cpt, 'validate', array());
    }
    /**
     * Test exception thrown if no plural
     *
     * @return void
     */
    public function test_throws_exception_no_plural()
    {
        $cpt = new \PC_Headless_Blog_1AA\PinkCrab\Registerables\Tests\Fixtures\CPT\Basic_CPT();
        \PC_Headless_Blog_1AA\Gin0115\WPUnit_Helpers\Objects::set_property($cpt, 'plural', \false);
        $this->expectException(\InvalidArgumentException::class);
        \PC_Headless_Blog_1AA\Gin0115\WPUnit_Helpers\Objects::invoke_method($cpt, 'validate', array());
    }
}
