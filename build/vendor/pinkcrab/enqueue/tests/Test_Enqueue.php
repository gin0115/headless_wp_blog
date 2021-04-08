<?php

declare (strict_types=1);
/**
 * Enqueue tests
 *
 * @since 1.1.0
 * @author Glynn Quelch <glynn.quelch@gmail.com>
 * @license http://www.opensource.org/licenses/mit-license.html  MIT License
 * @package PinkCrab\Core
 */
namespace PC_Headless_Blog_1AA\PinkCrab\Core\Tests\Application;

use PC_Headless_Blog_1AA\WP_UnitTestCase;
use PC_Headless_Blog_1AA\PinkCrab\Enqueue\Enqueue;
use PC_Headless_Blog_1AA\PinkCrab\PHPUnit_Helpers\Output;
use PC_Headless_Blog_1AA\PinkCrab\PHPUnit_Helpers\Objects;
class Test_Enqueue extends \WP_UnitTestCase
{
    public function setUp()
    {
    }
    /**
     * Retruns a fully populated enqueue script isntance..
     *
     * @return \PinkCrab\Enqueue\Enqueue
     */
    protected static function create_script() : \PC_Headless_Blog_1AA\PinkCrab\Enqueue\Enqueue
    {
        return \PC_Headless_Blog_1AA\PinkCrab\Enqueue\Enqueue::script('script_handle')->src('https://url.com/Fixtures/script_file.js')->deps('jquery', 'angularjs')->ver('1.2.3')->footer(\false)->localize(array('key_int' => 1, 'key_array' => array('string', 'val')));
    }
    /**
     * Retruns a fully populated enqueue style isntance..
     * Uses latest file date.
     *
     * @return \PinkCrab\Enqueue\Enqueue
     */
    protected static function create_style() : \PC_Headless_Blog_1AA\PinkCrab\Enqueue\Enqueue
    {
        return \PC_Headless_Blog_1AA\PinkCrab\Enqueue\Enqueue::style('style_handle')->src('style_file.css')->deps('theme_styles', 'ache_plugin_styles')->ver('2.3')->media('(orientation: portrait)');
    }
    /**
     * Test can be concstrcuted
     *
     * @return void
     */
    public function test_can_create_from_constructor() : void
    {
        $enqueue = new \PC_Headless_Blog_1AA\PinkCrab\Enqueue\Enqueue('hook', 'script');
        $this->assertEquals('hook', \PC_Headless_Blog_1AA\PinkCrab\PHPUnit_Helpers\Objects::get_private_property($enqueue, 'handle'));
        $this->assertEquals('script', \PC_Headless_Blog_1AA\PinkCrab\PHPUnit_Helpers\Objects::get_private_property($enqueue, 'type'));
    }
    /**
     * Test script and stype statics create with type
     *
     * @return void
     */
    public function test_static_constructors() : void
    {
        $script = self::create_script();
        $this->assertEquals('script_handle', \PC_Headless_Blog_1AA\PinkCrab\PHPUnit_Helpers\Objects::get_private_property($script, 'handle'));
        $this->assertEquals('script', \PC_Headless_Blog_1AA\PinkCrab\PHPUnit_Helpers\Objects::get_private_property($script, 'type'));
        $style = self::create_style();
        $this->assertEquals('style_handle', \PC_Headless_Blog_1AA\PinkCrab\PHPUnit_Helpers\Objects::get_private_property($style, 'handle'));
        $this->assertEquals('style', \PC_Headless_Blog_1AA\PinkCrab\PHPUnit_Helpers\Objects::get_private_property($style, 'type'));
    }
    /**
     * Tests all script setters.
     *
     * @return void
     */
    public function test_script_setters() : void
    {
        $script = self::create_script();
        $this->assertEquals('script', \PC_Headless_Blog_1AA\PinkCrab\PHPUnit_Helpers\Objects::get_private_property($script, 'type'));
        $this->assertEquals('script_handle', \PC_Headless_Blog_1AA\PinkCrab\PHPUnit_Helpers\Objects::get_private_property($script, 'handle'));
        $this->assertEquals('https://url.com/Fixtures/script_file.js', \PC_Headless_Blog_1AA\PinkCrab\PHPUnit_Helpers\Objects::get_private_property($script, 'src'));
        $this->assertEquals('1.2.3', \PC_Headless_Blog_1AA\PinkCrab\PHPUnit_Helpers\Objects::get_private_property($script, 'ver'));
        $this->assertFalse(\PC_Headless_Blog_1AA\PinkCrab\PHPUnit_Helpers\Objects::get_private_property($script, 'footer'));
        $this->assertIsArray(\PC_Headless_Blog_1AA\PinkCrab\PHPUnit_Helpers\Objects::get_private_property($script, 'deps'));
        $this->assertEquals('jquery', \PC_Headless_Blog_1AA\PinkCrab\PHPUnit_Helpers\Objects::get_private_property($script, 'deps')[0]);
        $this->assertEquals('angularjs', \PC_Headless_Blog_1AA\PinkCrab\PHPUnit_Helpers\Objects::get_private_property($script, 'deps')[1]);
        $this->assertIsArray(\PC_Headless_Blog_1AA\PinkCrab\PHPUnit_Helpers\Objects::get_private_property($script, 'localize'));
        $this->assertArrayHasKey('key_int', \PC_Headless_Blog_1AA\PinkCrab\PHPUnit_Helpers\Objects::get_private_property($script, 'localize'));
        $this->assertIsInt(\PC_Headless_Blog_1AA\PinkCrab\PHPUnit_Helpers\Objects::get_private_property($script, 'localize')['key_int']);
        $this->assertIsArray(\PC_Headless_Blog_1AA\PinkCrab\PHPUnit_Helpers\Objects::get_private_property($script, 'localize')['key_array']);
    }
    /**
     * Tests all script setters.
     *
     * @return void
     */
    public function test_style_setters() : void
    {
        $style = self::create_style();
        $this->assertEquals('style', \PC_Headless_Blog_1AA\PinkCrab\PHPUnit_Helpers\Objects::get_private_property($style, 'type'));
        $this->assertEquals('style_handle', \PC_Headless_Blog_1AA\PinkCrab\PHPUnit_Helpers\Objects::get_private_property($style, 'handle'));
        $this->assertEquals('style_file.css', \PC_Headless_Blog_1AA\PinkCrab\PHPUnit_Helpers\Objects::get_private_property($style, 'src'));
        $this->assertEquals('2.3', \PC_Headless_Blog_1AA\PinkCrab\PHPUnit_Helpers\Objects::get_private_property($style, 'ver'));
        $this->assertEquals('(orientation: portrait)', \PC_Headless_Blog_1AA\PinkCrab\PHPUnit_Helpers\Objects::get_private_property($style, 'media'));
        $this->assertIsArray(\PC_Headless_Blog_1AA\PinkCrab\PHPUnit_Helpers\Objects::get_private_property($style, 'deps'));
        $this->assertEquals('theme_styles', \PC_Headless_Blog_1AA\PinkCrab\PHPUnit_Helpers\Objects::get_private_property($style, 'deps')[0]);
        $this->assertEquals('ache_plugin_styles', \PC_Headless_Blog_1AA\PinkCrab\PHPUnit_Helpers\Objects::get_private_property($style, 'deps')[1]);
    }
    /**
     * Test that the scripts/styles are added on regiser()
     *
     * @return void
     */
    public function test_is_add_to_enqueue_stack() : void
    {
        // Not inlined and in footer
        $script = self::create_script()->footer();
        $script->register();
        $this->assertArrayHasKey('script_handle', $GLOBALS['wp_scripts']->registered);
        $dependency = $GLOBALS['wp_scripts']->registered['script_handle'];
        $this->assertEquals('script_handle', $dependency->handle);
        $this->assertEquals('https://url.com/Fixtures/script_file.js', $dependency->src);
        $this->assertEquals('1.2.3', $dependency->ver);
        $this->assertIsArray($dependency->deps);
        $this->assertEquals('jquery', $dependency->deps[0]);
        $this->assertEquals('angularjs', $dependency->deps[1]);
        // Localized values.
        $expected = \sprintf('var %s = %s;', 'script_handle', \json_encode((object) array('key_int' => '1', 'key_array' => array('string', 'val'))));
        $this->assertEquals($expected, $dependency->extra['data']);
        // Check is in footer (extra group 1)
        $this->assertEquals('1', $dependency->extra['group']);
    }
}
