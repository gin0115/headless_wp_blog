<?php

namespace PC_Headless_Blog_1AA\PinkCrab\Admin_Pages\Tests\Unit;

use Exception;
use PC_Headless_Blog_1AA\WP_UnitTestCase;
use PC_Headless_Blog_1AA\PinkCrab\Admin_Pages\Page;
use PC_Headless_Blog_1AA\Gin0115\WPUnit_Helpers\Objects;
use PC_Headless_Blog_1AA\PinkCrab\Admin_Pages\Page_Factory;
class Test_Page_Factory extends \WP_UnitTestCase
{
    /** @testdox It should be possible to create a page factory with a defined parent key for all child pages. */
    public function test_create_factory_with_parent_page()
    {
        $factory = new \PC_Headless_Blog_1AA\PinkCrab\Admin_Pages\Page_Factory('parent');
        $this->assertNotNull(\PC_Headless_Blog_1AA\Gin0115\WPUnit_Helpers\Objects::get_property($factory, 'parent_key'));
    }
    /** @testdox It should be possible to create a page factory withoit a defined parent key. */
    public function test_create_factory_without_parent_key() : void
    {
        $factory = new \PC_Headless_Blog_1AA\PinkCrab\Admin_Pages\Page_Factory();
        $this->assertNull(\PC_Headless_Blog_1AA\Gin0115\WPUnit_Helpers\Objects::get_property($factory, 'parent_key'));
    }
    /** @testdox It should be possible to create a page with a defined menu title and key/slug. */
    public function test_create_page() : void
    {
        $factory = new \PC_Headless_Blog_1AA\PinkCrab\Admin_Pages\Page_Factory();
        $page = $factory->page('title', 'key');
        $this->assertInstanceOf(\PC_Headless_Blog_1AA\PinkCrab\Admin_Pages\Page::class, $page);
        $this->assertEquals('title', $page->menu_title);
        $this->assertEquals('key', $page->key);
    }
    /** @testdox It should be possible to create a child page using the predefined parent key. */
    public function test_create_child_page()
    {
        $factory = new \PC_Headless_Blog_1AA\PinkCrab\Admin_Pages\Page_Factory('parent');
        $page = $factory->child_page('title', 'key');
        $this->assertInstanceOf(\PC_Headless_Blog_1AA\PinkCrab\Admin_Pages\Page::class, $page);
        $this->assertEquals('parent', $page->parent_slug);
        $this->assertEquals('title', $page->menu_title);
        $this->assertEquals('key', $page->key);
    }
    /** @testdox If no parent key defined, an error should be generated if attempting to create a child page. */
    public function test_throws_exception_if_no_parent_defined_when_create_child() : void
    {
        $this->expectException(\Exception::class);
        $factory = new \PC_Headless_Blog_1AA\PinkCrab\Admin_Pages\Page_Factory();
        $page = $factory->child_page('title', 'key');
    }
}
