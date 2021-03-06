<?php

declare (strict_types=1);
/**
 * Tests for the view service class
 *
 * @since 0.1.0
 * @author Glynn Quelch <glynn.quelch@gmail.com>
 * @license http://www.opensource.org/licenses/mit-license.html  MIT License
 * @package PinkCrab\Core
 */
namespace PC_Headless_Blog_1AA\PinkCrab\Core\Tests\View;

use PC_Headless_Blog_1AA\WP_UnitTestCase;
use PC_Headless_Blog_1AA\Gin0115\WPUnit_Helpers\Objects;
use PC_Headless_Blog_1AA\PinkCrab\Core\Services\View\View;
use PC_Headless_Blog_1AA\PinkCrab\Core\Services\View\PHP_Engine;
class Test_View extends \WP_UnitTestCase
{
    /**
     * Holds a temp instance to the PHP_ENgine.
     *
     * @var Renderable
     */
    protected $php_engine;
    public function setUp() : void
    {
        parent::setUp();
        $this->php_engine = new \PC_Headless_Blog_1AA\PinkCrab\Core\Services\View\PHP_Engine(\dirname(__DIR__, 1) . '/Fixtures/Views/');
    }
    /** @testdox When a function usually prints to the output, it should be possible to caputure this output and return as a string. */
    public function test_print_buffer() : void
    {
        $result = \PC_Headless_Blog_1AA\PinkCrab\Core\Services\View\View::print_buffer(function () {
            echo 'ECHO...ECHO';
        });
        $this->assertEquals('ECHO...ECHO', $result);
    }
    /** @testdox It should be possible to render(print) a template direct to the output, either CLI or in a reposnse. */
    public function test_can_be_constructed_with_render_engine() : void
    {
        $view = new \PC_Headless_Blog_1AA\PinkCrab\Core\Services\View\View($this->php_engine);
        $this->assertSame($this->php_engine, \PC_Headless_Blog_1AA\Gin0115\WPUnit_Helpers\Objects::get_property($view, 'engine'));
    }
    /** @testdox A template should be returnable as a string for priting elsewhere */
    public function test_return_single_template() : void
    {
        $this->assertEquals('Hello World', (new \PC_Headless_Blog_1AA\PinkCrab\Core\Services\View\View($this->php_engine))->render('hello', array('hello' => 'Hello World'), \PC_Headless_Blog_1AA\PinkCrab\Core\Services\View\View::RETURN_VIEW));
    }
    /** @testdox Partial tempaltes should be renderable within an existsing template. */
    public function test_render_partial_template() : void
    {
        $this->expectOutputString('partial_value');
        (new \PC_Headless_Blog_1AA\PinkCrab\Core\Services\View\View($this->php_engine))->render('layout', array('partial_data' => array('partial' => 'partial_value')), \PC_Headless_Blog_1AA\PinkCrab\Core\Services\View\View::PRINT_VIEW);
    }
    /** @testdox You should be able to get access to the internal rendering engine, for binding additional directives or access internal functionality */
    public function test_get_internal_engine() : void
    {
        $this->assertInstanceOf(\PC_Headless_Blog_1AA\PinkCrab\Core\Services\View\PHP_Engine::class, (new \PC_Headless_Blog_1AA\PinkCrab\Core\Services\View\View($this->php_engine))->engine());
    }
}
