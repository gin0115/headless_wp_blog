<?php

declare (strict_types=1);
/**
 * Tests the BladeOne Provider.
 *
 * @since 0.1.0
 * @author Glynn Quelch <glynn.quelch@gmail.com>
 * @license http://www.opensource.org/licenses/mit-license.html  MIT License
 * @package PinkCrab\Core
 */
namespace PC_Headless_Blog_1AA\PinkCrab\Registerables\Tests\Taxonomies;

use PC_Headless_Blog_1AA\WP_UnitTestCase;
use BadMethodCallException;
use PC_Headless_Blog_1AA\eftec\bladeone\BladeOne;
use PC_Headless_Blog_1AA\PinkCrab\Core\Services\View\View;
use PC_Headless_Blog_1AA\PinkCrab\BladeOne\BladeOne_Provider;
class Test_BladeOne_Provider extends \WP_UnitTestCase
{
    protected static $blade;
    public function setUp() : void
    {
        parent::setup();
        if (!static::$blade) {
            $cache = \dirname(__FILE__) . '/files/cache';
            $views = \dirname(__FILE__) . '/files/views';
            static::$blade = \PC_Headless_Blog_1AA\PinkCrab\BladeOne\BladeOne_Provider::init($views, $cache, 5);
        }
    }
    /**
     * Test is intance of bladeone
     *
     * @return void
     */
    public function test_can_construct_from_provider() : void
    {
        $this->assertInstanceOf(\PC_Headless_Blog_1AA\PinkCrab\BladeOne\BladeOne_Provider::class, static::$blade);
    }
    /**
     * Test can call out blade.
     *
     * @return void
     */
    public function test_can_get_blade() : void
    {
        $this->assertInstanceOf(\PC_Headless_Blog_1AA\eftec\bladeone\BladeOne::class, static::$blade->get_blade());
    }
    /**
     * Test can render a view (print)
     *
     * @return void
     */
    public function test_can_render_view() : void
    {
        $this->expectOutputString('rendered');
        static::$blade->render('testview', array('foo' => 'rendered'));
    }
    /**
     * Test the view is returned.
     *
     * @return void
     */
    public function test_can_return_a_view() : void
    {
        $this->assertEquals('rendered', static::$blade->render('testview', array('foo' => 'rendered'), \PC_Headless_Blog_1AA\PinkCrab\Core\Services\View\View::RETURN_VIEW));
    }
    /**
     * Test can call an instanced method.
     *
     * @return void
     */
    public function test_can_call_instanced_methods() : void
    {
        $this->assertStringContainsString('testview.blade.php', static::$blade->getTemplateFile('testview'));
    }
    /**
     * Tests BadMethodCallException thrown is static methods called as instanced.
     * $this->staticMethod()
     *
     * @return void
     */
    public function test_throws_exception_on_static_call_as_instanced() : void
    {
        $this->expectException(\BadMethodCallException::class);
        static::$blade->enq('1');
    }
    /**
     * Tests BadMethodCallException thrown if method doesnt exist.
     *
     * @return void
     */
    public function test_throws_exception_on_invalid_method_instanced() : void
    {
        $this->expectException(\BadMethodCallException::class);
        static::$blade->FAKE('1');
    }
    /**
     * Test can call an instanced method.
     *
     * @return void
     */
    public function test_can_call_static_methods() : void
    {
        $this->assertStringContainsString('testview', static::$blade::enq('testview<p>d</p>'));
    }
    /**
     * Tests BadMethodCallException thrown is static methods called as instanced.
     * $this->staticMethod()
     *
     * @return void
     */
    public function test_throws_exception_on_instanced_call_as_static() : void
    {
        $this->expectException(\BadMethodCallException::class);
        static::$blade::getTemplateFile('1');
    }
    /**
     * Tests BadMethodCallException thrown if method doesnt exist.
     *
     * @return void
     */
    public function test_throws_exception_on_invalid_method_static() : void
    {
        $this->expectException(\BadMethodCallException::class);
        static::$blade::FAKE('1');
    }
}
