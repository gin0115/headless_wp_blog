<?php

declare (strict_types=1);
/**
 * Tests the Ajax_Get mock.
 *
 * @since 0.1.0
 * @author Glynn Quelch <glynn.quelch@gmail.com>
 * @license http://www.opensource.org/licenses/mit-license.html  MIT License
 * @package PinkCrab\Core
 */
namespace PC_Headless_Blog_1AA\PinkCrab\Registerables\Tests;

use PC_Headless_Blog_1AA\WP_UnitTestCase;
use PC_Headless_Blog_1AA\PinkCrab\Loader\Loader;
use InvalidArgumentException;
use PC_Headless_Blog_1AA\PinkCrab\HTTP\HTTP_Helper;
use PC_Headless_Blog_1AA\Gin0115\WPUnit_Helpers\Objects;
use PC_Headless_Blog_1AA\PinkCrab\Registerables\Tests\Fixtures\Ajax\Ajax_Get;
use PC_Headless_Blog_1AA\PinkCrab\Registerables\Tests\Fixtures\Ajax\Ajax_Missing_Nonce_And_Action;
class Test_Ajax_Get_Failures extends \WP_UnitTestCase
{
    /**
     * The ajax class isntnace
     *
     * @var Ajax
     */
    protected static $ajax_instance;
    /**
     * User isntance
     *
     * @var \WP_User
     */
    protected static $user;
    /**
     * Ensure the headers are cleared on each test.
     *
     * @var bool
     */
    protected $preserveGlobalState = \false;
    public function setUp()
    {
        // Mock the request globals
        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_GET['nonce'] = wp_create_nonce('basic_ajax_get');
        $_GET['ajax_get_data'] = 'Test_Ajax_Get';
        // Request
        $request = \PC_Headless_Blog_1AA\PinkCrab\HTTP\HTTP_Helper::global_server_request();
        static::$ajax_instance = new \PC_Headless_Blog_1AA\PinkCrab\Registerables\Tests\Fixtures\Ajax\Ajax_Get($request);
        $loader = new \PC_Headless_Blog_1AA\PinkCrab\Loader\Loader();
        static::$ajax_instance->register($loader);
        $loader->register_hooks();
    }
    /**
     * Test can fail validation.
     *
     * @return void
     */
    public function test_fails_validation()
    {
        unset($_GET['nonce']);
        $this->assertFalse(\PC_Headless_Blog_1AA\Gin0115\WPUnit_Helpers\Objects::invoke_method(static::$ajax_instance, 'validate', array(\PC_Headless_Blog_1AA\PinkCrab\HTTP\HTTP_Helper::global_server_request())));
    }
    /**
     * Tests returns blank array when trying to get params for PUT
     *
     * @return void
     */
    public function test_returns_blank_array_if_none_post_get_method()
    {
        $_SERVER['REQUEST_METHOD'] = 'PUT';
        $this->assertSame(array(), \PC_Headless_Blog_1AA\Gin0115\WPUnit_Helpers\Objects::invoke_method(static::$ajax_instance, 'extract_request_params', array(\PC_Headless_Blog_1AA\PinkCrab\HTTP\HTTP_Helper::global_server_request())));
    }
    /**
     * Test exception thrown if not action defined.
     *
     * @return void
     */
    public function test_exception_thrown_if_no_action()
    {
        $ajax_instance = new \PC_Headless_Blog_1AA\PinkCrab\Registerables\Tests\Fixtures\Ajax\Ajax_Get(\PC_Headless_Blog_1AA\PinkCrab\HTTP\HTTP_Helper::global_server_request());
        \PC_Headless_Blog_1AA\Gin0115\WPUnit_Helpers\Objects::set_property($ajax_instance, 'action', null);
        $this->expectException(\InvalidArgumentException::class);
        $ajax_instance->register(new \PC_Headless_Blog_1AA\PinkCrab\Loader\Loader());
    }
    /**
     * Test that a 401 unauthorised is returned for failed nonce.
     *
     * @runInSeparateProcess
     * @return void
     */
    public function test_returns_401_if_fails_nonce_check() : void
    {
        $this->expectOutputRegex('/Request not authenticated/');
        // Mock the request globals
        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_GET['nonce'] = 'fail';
        $_GET['ajax_get_data'] = 'Test_Ajax_Get';
        // Trigger the request.
        $ajax_instance = new \PC_Headless_Blog_1AA\PinkCrab\Registerables\Tests\Fixtures\Ajax\Ajax_Get(\PC_Headless_Blog_1AA\PinkCrab\HTTP\HTTP_Helper::global_server_request());
        $loader = new \PC_Headless_Blog_1AA\PinkCrab\Loader\Loader();
        $ajax_instance->register($loader);
        $loader->register_hooks();
        $ajax_instance->entry();
    }
    /**
     * Tests returns a blank string i
     *
     * @return void
     */
    public function test_returns_blank_string_for_nonce_value_if_unset() : void
    {
        $ajax_instance = new \PC_Headless_Blog_1AA\PinkCrab\Registerables\Tests\Fixtures\Ajax\Ajax_Missing_Nonce_And_Action(\PC_Headless_Blog_1AA\PinkCrab\HTTP\HTTP_Helper::global_server_request());
        $this->assertEquals('', $ajax_instance::nonce_value());
    }
    /**
     * Tests returns a blank string i
     *
     * @return void
     */
    public function test_returns_blank_string_for_action_if_unset() : void
    {
        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_GET['nonce'] = 'fail';
        $_GET['ajax_get_data'] = 'Test_Ajax_Get';
        $ajax_instance = new \PC_Headless_Blog_1AA\PinkCrab\Registerables\Tests\Fixtures\Ajax\Ajax_Missing_Nonce_And_Action(\PC_Headless_Blog_1AA\PinkCrab\HTTP\HTTP_Helper::global_server_request());
        $this->assertEquals('', $ajax_instance::action());
    }
}
