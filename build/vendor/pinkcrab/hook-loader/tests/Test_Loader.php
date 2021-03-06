<?php

declare (strict_types=1);
/**
 * Loader tests.
 *
 * @since 0.1.0
 * @author Glynn Quelch <glynn.quelch@gmail.com>
 * @license http://www.opensource.org/licenses/mit-license.html  MIT License
 * @package PinkCrab\Loader
 */
namespace PC_Headless_Blog_1AA\PinkCrab\Loader\Tests;

use PC_Headless_Blog_1AA\WP_UnitTestCase;
use PC_Headless_Blog_1AA\PinkCrab\Loader\Loader;
use PC_Headless_Blog_1AA\PinkCrab\Loader\Hook_Collection;
use PC_Headless_Blog_1AA\PinkCrab\Core\Collection\Collection;
use PC_Headless_Blog_1AA\PinkCrab\PHPUnit_Helpers\Reflection;
use PC_Headless_Blog_1AA\PinkCrab\Loader\Tests\Fixtures\Hooks_Via_Static;
use PC_Headless_Blog_1AA\PinkCrab\Loader\Tests\Fixtures\Hooks_Via_Instance;
class Loader_Test extends \WP_UnitTestCase
{
    /**
     * Loader
     *
     * @var Loader
     */
    public $loader;
    /**
     * Setup tests with an instance of the loader.
     *
     * @return void
     */
    public function setUp()
    {
        // Ensure all tests start as frontend.
        if (isset($GLOBALS['current_screen'])) {
            \PC_Headless_Blog_1AA\PinkCrab\PHPUnit_Helpers\Reflection::set_private_property($GLOBALS['current_screen'], 'in_admin', \false);
        }
        parent::setUp();
        $this->loader = \PC_Headless_Blog_1AA\PinkCrab\Loader\Loader::boot();
    }
    /**
     * Registers the hooks.
     *
     * @return void
     */
    private function register_hooks()
    {
        $this->loader->register_hooks();
    }
    /**
     * Test that the loader is infact the loader.
     *
     * @return void
     */
    public function test_is_loader_loaded()
    {
        $this->assertInstanceOf(\PC_Headless_Blog_1AA\PinkCrab\Loader\Loader::class, $this->loader);
    }
    /**
     * Test consutructor creates intenral collections.
     *
     * @return void
     */
    public function test_is_constructed_with_internal_collection() : void
    {
        $loader = new \PC_Headless_Blog_1AA\PinkCrab\Loader\Loader();
        $collections = array('global', 'admin', 'front', 'shortcode', 'ajax', 'remove');
        foreach ($collections as $collection) {
            $this->assertInstanceOf(\PC_Headless_Blog_1AA\PinkCrab\Loader\Hook_Collection::class, \PC_Headless_Blog_1AA\PinkCrab\PHPUnit_Helpers\Reflection::get_private_property($loader, $collection));
        }
    }
    /**
     * Test boot populates $instance with itself
     *
     * @return void
     */
    public function test_sets_internal_instance_on_boot()
    {
        // Clear internal (singleton) state..
        \PC_Headless_Blog_1AA\PinkCrab\PHPUnit_Helpers\Reflection::set_private_static_property($this->loader, 'instance', null);
        // Run boot (recreate state) and check is instance.
        $loader = \PC_Headless_Blog_1AA\PinkCrab\Loader\Loader::boot();
        $this->assertInstanceOf(\PC_Headless_Blog_1AA\PinkCrab\Loader\Loader::class, \PC_Headless_Blog_1AA\PinkCrab\PHPUnit_Helpers\Reflection::get_private_static_property($loader, 'instance'));
    }
    /**
     * Test that actions can be added.
     *
     * @return void
     */
    public function test_action_can_be_added_to_loader()
    {
        // Test Global Action
        $this->loader->action('test_action', function () {
            return 3;
        });
        $this->loader->register_hooks();
        $this->assertTrue(has_action('test_action'));
    }
    /**
     * Test that filters are added and used.
     *
     * @return void
     */
    public function test_that_filters_can_be_added()
    {
        $this->loader->filter('test_filter', function ($inital) {
            return 'replaced';
        });
        $this->register_hooks();
        $this->assertEquals('replaced', apply_filters('test_filter', 'initial'));
    }
    /**
     * Test that ajax calls can be added to the loader.
     *
     * @return void
     */
    public function test_ajax_calls_can_be_added_to_loader() : void
    {
        // Check defaults are used for both public & private
        $this->loader->ajax('ajax_test_all', function () {
            return \true;
        });
        // Test only adding to public
        $this->loader->ajax('ajax_test_public', function () {
            return \true;
        }, \true, \false);
        // Test only adding to private.
        $this->loader->ajax('ajax_test_private', function () {
            return \true;
        }, \false, \true);
        // Register all hooks.
        $this->register_hooks();
        // Test the public & private.
        $this->assertTrue(has_action('wp_ajax_ajax_test_all'));
        $this->assertTrue(has_action('wp_ajax_nopriv_ajax_test_all'));
        // Test public
        $this->assertFalse(has_action('wp_ajax_ajax_test_public'));
        $this->assertTrue(has_action('wp_ajax_nopriv_ajax_test_public'));
        // Test private
        $this->assertTrue(has_action('wp_ajax_ajax_test_private'));
        $this->assertFalse(has_action('wp_ajax_nopriv_ajax_test_private'));
    }
    /**
     * Check that only front or admin hooks can be called when in admin/public
     *
     * @return void
     */
    public function test_admin_hooks_are_not_called_in_public() : void
    {
        // Filters
        $this->loader->admin_filter('test_admin_filter', function ($inital) {
            return 'replaced_with_admin_filter';
        });
        $this->loader->front_filter('test_front_filter', function ($inital) {
            return 'replaced_with_front_filter';
        });
        // Actions
        $this->loader->admin_action('test_admin_action', function () {
            return \true;
        });
        $this->loader->front_action('test_front_action', function () {
            return \true;
        });
        // Register all hooks.
        $this->register_hooks();
        $this->assertEquals('initial', apply_filters('test_admin_filter', 'initial'));
        $this->assertEquals('replaced_with_front_filter', apply_filters('test_front_filter', 'initial'));
        $this->assertFalse(has_action('test_admin_action'));
        $this->assertTrue(has_action('test_front_action'));
    }
    public function test_admin_hooks()
    {
        set_current_screen('edit.php');
        $loader = new \PC_Headless_Blog_1AA\PinkCrab\Loader\Loader();
        $loader->admin_action('test_admin_action', function () {
            return \true;
        });
        $loader->register_hooks();
        $this->assertTrue(has_action('test_admin_action'));
    }
    /**
     * Check that shortcodes can be added and called.
     *
     * @return void
     */
    public function test_shortcodes_can_be_added() : void
    {
        $this->loader->shortcode('testShortCode', function ($atts) {
            echo $atts['text'];
        });
        $this->register_hooks();
        // Check the shortcode returns yes.
        \ob_start();
        do_shortcode("[testShortCode text='yes']");
        $this->assertTrue(\ob_get_contents() === 'yes');
        \ob_end_clean();
    }
    /**
     * Ensure hooks can be removed using the loader
     *
     * @return void
     */
    public function test_action_can_be_removed() : void
    {
        add_action('remove_this_action', array(\PC_Headless_Blog_1AA\PinkCrab\Loader\Tests\Fixtures\Hooks_Via_Static::class, 'action_callback_static'), 10);
        $this->loader->remove_action('remove_this_action', array(\PC_Headless_Blog_1AA\PinkCrab\Loader\Tests\Fixtures\Hooks_Via_Static::class, 'action_callback_static'), 10);
        $this->register_hooks();
        $this->assertEmpty($GLOBALS['wp_filter']['remove_this_action']->callbacks[10]);
        $this->assertFalse(has_action('remove_this_action'));
    }
    /**
     * Ensure hooks can be removed using the loader
     *
     * @return void
     */
    public function test_filter_can_be_removed() : void
    {
        add_filter('remove_this_filter', 'pc_tests_noop', 10);
        $this->loader->remove_filter('remove_this_filter', 'pc_tests_noop', 10);
        $this->register_hooks();
        $this->assertEmpty($GLOBALS['wp_filter']['remove_this_filter']->callbacks[10]);
        $this->assertFalse(has_filter('remove_this_filter'));
    }
    /**
     * Test can use remove() as a catch all for remove_filter & remove_action
     *
     * @return void
     */
    public function test_can_remove_etiher_hook_fitler() : void
    {
        add_action('loader_remove_hook', array(new \PC_Headless_Blog_1AA\PinkCrab\Loader\Tests\Fixtures\Hooks_Via_Instance(), 'action_callback_instance'));
        $loader = new \PC_Headless_Blog_1AA\PinkCrab\Loader\Loader();
        $loader->remove('loader_remove_hook', array(new \PC_Headless_Blog_1AA\PinkCrab\Loader\Tests\Fixtures\Hooks_Via_Instance(), 'action_callback_instance'));
        $loader->register_hooks();
        $this->assertEmpty($GLOBALS['wp_filter']['loader_remove_hook']->callbacks[10]);
        $this->assertFalse(has_action('loader_remove_hook'));
    }
}
