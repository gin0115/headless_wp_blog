<?php

declare (strict_types=1);
/**
 * Tests various settings/defaults
 *
 * @since 0.1.0
 * @author Glynn Quelch <glynn.quelch@gmail.com>
 * @license http://www.opensource.org/licenses/mit-license.html  MIT License
 * @package PinkCrab\Core
 */
namespace PC_Headless_Blog_1AA\PinkCrab\Registerables\Tests\Taxonomies;

use PC_Headless_Blog_1AA\WP_UnitTestCase;
use InvalidArgumentException;
use PC_Headless_Blog_1AA\Gin0115\WPUnit_Helpers\Objects;
use PC_Headless_Blog_1AA\PinkCrab\Registerables\Tests\Fixtures\Taxonomies\Basic_Tag_Taxonomy;
class Test_Taxonony_Settings extends \WP_UnitTestCase
{
    public function test_sets_optional_args() : void
    {
        $taxonomy = new \PC_Headless_Blog_1AA\PinkCrab\Registerables\Tests\Fixtures\Taxonomies\Basic_Tag_Taxonomy();
        // Set the options values.
        \PC_Headless_Blog_1AA\Gin0115\WPUnit_Helpers\Objects::set_property($taxonomy, 'capabilities', array('capabilities'));
        \PC_Headless_Blog_1AA\Gin0115\WPUnit_Helpers\Objects::set_property($taxonomy, 'update_count_callback', 'update_count_callback');
        \PC_Headless_Blog_1AA\Gin0115\WPUnit_Helpers\Objects::set_property($taxonomy, 'meta_box_cb', array('meta_box_cb'));
        \PC_Headless_Blog_1AA\Gin0115\WPUnit_Helpers\Objects::set_property($taxonomy, 'default_term', array('default_term'));
        // Run though optional args.
        $properties = \PC_Headless_Blog_1AA\Gin0115\WPUnit_Helpers\Objects::invoke_method($taxonomy, 'optional_args', array(array()));
        // Test the args have been added to the array.
        $this->assertArrayHasKey('capabilities', $properties);
        $this->assertArrayHasKey('update_count_callback', $properties);
        $this->assertArrayHasKey('meta_box_cb', $properties);
        $this->assertArrayHasKey('default_term', $properties);
    }
    /**
     * Test exception thrown if no slug
     *
     * @return void
     */
    public function test_throws_exception_no_slug()
    {
        $taxonomy = new \PC_Headless_Blog_1AA\PinkCrab\Registerables\Tests\Fixtures\Taxonomies\Basic_Tag_Taxonomy();
        \PC_Headless_Blog_1AA\Gin0115\WPUnit_Helpers\Objects::set_property($taxonomy, 'slug', \false);
        $this->expectException(\InvalidArgumentException::class);
        \PC_Headless_Blog_1AA\Gin0115\WPUnit_Helpers\Objects::invoke_method($taxonomy, 'validate', array());
    }
    /**
     * Test exception thrown if no singular
     *
     * @return void
     */
    public function test_throws_exception_no_singular()
    {
        $taxonomy = new \PC_Headless_Blog_1AA\PinkCrab\Registerables\Tests\Fixtures\Taxonomies\Basic_Tag_Taxonomy();
        \PC_Headless_Blog_1AA\Gin0115\WPUnit_Helpers\Objects::set_property($taxonomy, 'singular', \false);
        $this->expectException(\InvalidArgumentException::class);
        \PC_Headless_Blog_1AA\Gin0115\WPUnit_Helpers\Objects::invoke_method($taxonomy, 'validate', array());
    }
    /**
     * Test exception thrown if no plural
     *
     * @return void
     */
    public function test_throws_exception_no_plural()
    {
        $taxonomy = new \PC_Headless_Blog_1AA\PinkCrab\Registerables\Tests\Fixtures\Taxonomies\Basic_Tag_Taxonomy();
        \PC_Headless_Blog_1AA\Gin0115\WPUnit_Helpers\Objects::set_property($taxonomy, 'plural', \false);
        $this->expectException(\InvalidArgumentException::class);
        \PC_Headless_Blog_1AA\Gin0115\WPUnit_Helpers\Objects::invoke_method($taxonomy, 'validate', array());
    }
}
