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
use PC_Headless_Blog_1AA\PinkCrab\HTTP\HTTP;
use PC_Headless_Blog_1AA\PinkCrab\Loader\Loader;
use PC_Headless_Blog_1AA\Nyholm\Psr7\ServerRequest;
use PC_Headless_Blog_1AA\PinkCrab\Registerables\Tests\Fixtures\Ajax\Ajax_Get;
class Test_Ajax_Get extends \WP_UnitTestCase
{
    protected static $ajax_instance;
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
        $request = (new \PC_Headless_Blog_1AA\PinkCrab\HTTP\HTTP())->request_from_globals();
        $ajax_instance = new \PC_Headless_Blog_1AA\PinkCrab\Registerables\Tests\Fixtures\Ajax\Ajax_Get($request);
        $loader = new \PC_Headless_Blog_1AA\PinkCrab\Loader\Loader();
        $ajax_instance->register($loader);
        $loader->register_hooks();
    }
    /**
     * Ensure the ajax call has been registered.
     *
     * @return void
     */
    public function test_ajax_registered()
    {
        $this->assertArrayHasKey('wp_ajax_basic_ajax_get', $GLOBALS['wp_filter']);
        $this->assertArrayHasKey('wp_ajax_nopriv_basic_ajax_get', $GLOBALS['wp_filter']);
    }
    /**
     * Test output for none logged in call.
     *
     * @runInSeparateProcess
     * @return void
     */
    public function test_can_call_nopriv()
    {
        $this->expectOutputRegex('/Test_Ajax_Get/');
        do_action('wp_ajax_nopriv_basic_ajax_get');
    }
    /**
     * Test output for logged in call.
     *
     * @runInSeparateProcess
     * @return void
     */
    public function test_can_call_priv()
    {
        $this->expectOutputRegex('/Test_Ajax_Get/');
        do_action('wp_ajax_basic_ajax_get');
    }
}
