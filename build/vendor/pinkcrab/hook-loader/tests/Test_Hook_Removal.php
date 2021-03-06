<?php

declare (strict_types=1);
/**
 * Hook_Removal tests.
 *
 * @since 0.3.6
 * @author Glynn Quelch <glynn.quelch@gmail.com>
 * @license http://www.opensource.org/licenses/mit-license.html  MIT License
 * @package PinkCrab\Loader
 */
namespace PC_Headless_Blog_1AA\PinkCrab\Loader\Tests;

use PC_Headless_Blog_1AA\WP_UnitTestCase;
use InvalidArgumentException;
use PC_Headless_Blog_1AA\PinkCrab\Loader\Hook_Removal;
use PC_Headless_Blog_1AA\PinkCrab\PHPUnit_Helpers\Reflection;
use PC_Headless_Blog_1AA\PinkCrab\Loader\Tests\Fixtures\Hooks_Via_Static;
use PC_Headless_Blog_1AA\PinkCrab\Loader\Tests\Fixtures\Hooks_Via_Instance;
class Test_Hook_Removal extends \WP_UnitTestCase
{
    /**
     * Static Action
     */
    public function test_can_remove_static_action()
    {
        // Register action.
        (new \PC_Headless_Blog_1AA\PinkCrab\Loader\Tests\Fixtures\Hooks_Via_Static())->register_action();
        $response = (new \PC_Headless_Blog_1AA\PinkCrab\Loader\Hook_Removal(\PC_Headless_Blog_1AA\PinkCrab\Loader\Tests\Fixtures\Hooks_Via_Static::ACTION_HANDLE, array(\PC_Headless_Blog_1AA\PinkCrab\Loader\Tests\Fixtures\Hooks_Via_Static::class, 'action_callback_static')))->remove();
        $this->assertTrue($response);
        $this->assertEmpty($GLOBALS['wp_filter'][\PC_Headless_Blog_1AA\PinkCrab\Loader\Tests\Fixtures\Hooks_Via_Static::ACTION_HANDLE]->callbacks[10]);
    }
    /**
     * Static Filter
     */
    public function test_can_remove_static_filter()
    {
        // Register action.
        (new \PC_Headless_Blog_1AA\PinkCrab\Loader\Tests\Fixtures\Hooks_Via_Static())->register_filter();
        $response = (new \PC_Headless_Blog_1AA\PinkCrab\Loader\Hook_Removal(\PC_Headless_Blog_1AA\PinkCrab\Loader\Tests\Fixtures\Hooks_Via_Static::FILTER_HANDLE, array(\PC_Headless_Blog_1AA\PinkCrab\Loader\Tests\Fixtures\Hooks_Via_Static::class, 'filter_callback_static')))->remove();
        $this->assertTrue($response);
        $this->assertEmpty($GLOBALS['wp_filter'][\PC_Headless_Blog_1AA\PinkCrab\Loader\Tests\Fixtures\Hooks_Via_Static::FILTER_HANDLE]->callbacks[10]);
    }
    /**
     * Instanced Action
     */
    public function test_can_remove_instanced_action()
    {
        // Register action.
        (new \PC_Headless_Blog_1AA\PinkCrab\Loader\Tests\Fixtures\Hooks_Via_Instance())->register_action();
        $response = (new \PC_Headless_Blog_1AA\PinkCrab\Loader\Hook_Removal(\PC_Headless_Blog_1AA\PinkCrab\Loader\Tests\Fixtures\Hooks_Via_Instance::ACTION_HANDLE, array(new \PC_Headless_Blog_1AA\PinkCrab\Loader\Tests\Fixtures\Hooks_Via_Instance(), 'action_callback_instance')))->remove();
        $this->assertTrue($response);
        $this->assertEmpty($GLOBALS['wp_filter'][\PC_Headless_Blog_1AA\PinkCrab\Loader\Tests\Fixtures\Hooks_Via_Instance::ACTION_HANDLE]->callbacks[10]);
    }
    /**
     * Instanced Filter
     */
    public function test_can_remove_instanced_filter()
    {
        // Register action.
        (new \PC_Headless_Blog_1AA\PinkCrab\Loader\Tests\Fixtures\Hooks_Via_Instance())->register_filter();
        $response = (new \PC_Headless_Blog_1AA\PinkCrab\Loader\Hook_Removal(\PC_Headless_Blog_1AA\PinkCrab\Loader\Tests\Fixtures\Hooks_Via_Instance::FILTER_HANDLE, array(new \PC_Headless_Blog_1AA\PinkCrab\Loader\Tests\Fixtures\Hooks_Via_Instance(), 'filter_callback_instance')))->remove();
        $this->assertTrue($response);
        $this->assertEmpty($GLOBALS['wp_filter'][\PC_Headless_Blog_1AA\PinkCrab\Loader\Tests\Fixtures\Hooks_Via_Instance::FILTER_HANDLE]->callbacks[10]);
    }
    /**
     * Global Function
     */
    public function test_can_remove_global_functon()
    {
        add_action('test_global_function', 'pc_tests_noop');
        $response = (new \PC_Headless_Blog_1AA\PinkCrab\Loader\Hook_Removal('test_global_function', 'pc_tests_noop'))->remove();
        $this->assertTrue($response);
        $this->assertEmpty($GLOBALS['wp_filter']['test_global_function']->callbacks[10]);
    }
    /**
     * Returns false for all closures.
     */
    public function test_returns_false_for_closures() : void
    {
        add_action('clousre_hook', function () {
            echo 'THIS CAN NOT BE REMOVED';
        });
        $this->assertFalse((new \PC_Headless_Blog_1AA\PinkCrab\Loader\Hook_Removal('clousre_hook', function () {
            echo 'THIS CAN NOT BE REMOVED';
        }))->remove());
    }
    /**
     * Checks the is_array check for class callbacks.
     * Mainly tested for coverage.
     */
    public function test_retruns_empty_class_array_if_not_an_array()
    {
        $hook_remover = new \PC_Headless_Blog_1AA\PinkCrab\Loader\Hook_Removal('fake_handle', array(new \PC_Headless_Blog_1AA\PinkCrab\Loader\Tests\Fixtures\Hooks_Via_Instance(), 'action_callback_instance'));
        // Mock a none valid class.
        \PC_Headless_Blog_1AA\PinkCrab\PHPUnit_Helpers\Reflection::set_private_property($hook_remover, 'callback', 'NOT ARRAY');
        $callback_as_array = \PC_Headless_Blog_1AA\PinkCrab\PHPUnit_Helpers\Reflection::invoke_private_method($hook_remover, 'get_callback_as_array');
        $this->assertEmpty($callback_as_array['class']);
        $this->assertEmpty($callback_as_array['method']);
    }
    /**
     * Tests just the name of a class whose hook was registered as an instance
     * can be removed.
     *
     * @return void
     */
    public function test_can_use_name_for_instanced_hook()
    {
        // Register action.
        (new \PC_Headless_Blog_1AA\PinkCrab\Loader\Tests\Fixtures\Hooks_Via_Instance())->register_filter();
        $response = (new \PC_Headless_Blog_1AA\PinkCrab\Loader\Hook_Removal(\PC_Headless_Blog_1AA\PinkCrab\Loader\Tests\Fixtures\Hooks_Via_Instance::FILTER_HANDLE, array(\PC_Headless_Blog_1AA\PinkCrab\Loader\Tests\Fixtures\Hooks_Via_Instance::class, 'filter_callback_instance')))->remove();
        $this->assertTrue($response);
        $this->assertEmpty($GLOBALS['wp_filter'][\PC_Headless_Blog_1AA\PinkCrab\Loader\Tests\Fixtures\Hooks_Via_Instance::FILTER_HANDLE]->callbacks[10]);
    }
    /**
     * Test throw exception if invalid type passed as callback.
     *
     * @return void
     */
    public function test_exception_thrown_for_invalid_callback_type()
    {
        $this->expectException(\InvalidArgumentException::class);
        new \PC_Headless_Blog_1AA\PinkCrab\Loader\Hook_Removal(\PC_Headless_Blog_1AA\PinkCrab\Loader\Tests\Fixtures\Hooks_Via_Instance::FILTER_HANDLE, 12.45);
    }
    /**
     * Test throw exception if array with more than 2 elements passed
     * This fails the callable test, as filter_callback_instance isnt a static method.
     * @return void
     */
    public function test_exception_thrown_for_invalid_callback_array_too_long()
    {
        $this->expectException(\InvalidArgumentException::class);
        new \PC_Headless_Blog_1AA\PinkCrab\Loader\Hook_Removal(\PC_Headless_Blog_1AA\PinkCrab\Loader\Tests\Fixtures\Hooks_Via_Instance::FILTER_HANDLE, array(\PC_Headless_Blog_1AA\PinkCrab\Loader\Tests\Fixtures\Hooks_Via_Instance::class, 'filter_callback_instance', 'too', 'many'));
    }
    /**
     * Test throw exception if class passed isnt an actual class.
     *
     * @return void
     */
    public function test_exception_thrown_for_invalid_callback_class()
    {
        $this->expectException(\InvalidArgumentException::class);
        new \PC_Headless_Blog_1AA\PinkCrab\Loader\Hook_Removal(\PC_Headless_Blog_1AA\PinkCrab\Loader\Tests\Fixtures\Hooks_Via_Instance::FILTER_HANDLE, array('Class_Thats_Not', 'function'));
    }
    /**
     * Test throw exception if class passed isnt an actual method on the class.
     *
     * @return void
     */
    public function test_exception_thrown_for_invalid_callback_method()
    {
        $this->expectException(\InvalidArgumentException::class);
        new \PC_Headless_Blog_1AA\PinkCrab\Loader\Hook_Removal(\PC_Headless_Blog_1AA\PinkCrab\Loader\Tests\Fixtures\Hooks_Via_Instance::FILTER_HANDLE, array(\PC_Headless_Blog_1AA\PinkCrab\Loader\Tests\Fixtures\Hooks_Via_Instance::class, 'fake_method'));
    }
}
