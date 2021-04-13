<?php

namespace PC_Headless_Blog_1AA\PinkCrab\Admin_Pages\Tests\Unit;

use PC_Headless_Blog_1AA\WP_UnitTestCase;
use PC_Headless_Blog_1AA\PinkCrab\Admin_Pages\Page;
use PC_Headless_Blog_1AA\Gin0115\WPUnit_Helpers\Objects;
use PC_Headless_Blog_1AA\PinkCrab\Admin_Pages\Page_Factory;
use PC_Headless_Blog_1AA\PinkCrab\Core\Collection\Collection;
use PC_Headless_Blog_1AA\PinkCrab\Admin_Pages\Page_Collection;
class Test_Page_Collection extends \WP_UnitTestCase
{
    /** @testdox It should be possible to create a page collection with a defined parent key */
    public function test_can_create_collection() : void
    {
        $colleciton = new \PC_Headless_Blog_1AA\PinkCrab\Admin_Pages\Page_Collection('parent_key');
        $this->assertInstanceOf(\PC_Headless_Blog_1AA\PinkCrab\Core\Collection\Collection::class, \PC_Headless_Blog_1AA\Gin0115\WPUnit_Helpers\Objects::get_property($colleciton, 'pages'));
        $this->assertSame('parent_key', \PC_Headless_Blog_1AA\Gin0115\WPUnit_Helpers\Objects::get_property($colleciton, 'parent_key'));
    }
    /** @testdox It should be possible to check if a collection is empty or not */
    public function test_is_empty() : void
    {
        $colleciton = new \PC_Headless_Blog_1AA\PinkCrab\Admin_Pages\Page_Collection('parent_key');
        $this->assertTrue($colleciton->is_empty());
        $colleciton->add($this->createMock(\PC_Headless_Blog_1AA\PinkCrab\Admin_Pages\Page::class));
        $this->assertFalse($colleciton->is_empty());
    }
    /** @testdox It should be possible to add pages to the collection */
    public function test_add_page()
    {
        $colleciton = new \PC_Headless_Blog_1AA\PinkCrab\Admin_Pages\Page_Collection('parent_key');
        $colleciton->add($this->createMock(\PC_Headless_Blog_1AA\PinkCrab\Admin_Pages\Page::class));
        $this->assertFalse($colleciton->is_empty());
    }
    /** @testdox It should be possible to easily add child pages to the collection. */
    public function test_can_create_child_page_from_factory() : void
    {
        $colleciton = new \PC_Headless_Blog_1AA\PinkCrab\Admin_Pages\Page_Collection('parent_key');
        $colleciton->add_child_page(function (\PC_Headless_Blog_1AA\PinkCrab\Admin_Pages\Page_Factory $factory) : Page {
            return $factory->child_page('title', 'sub_key1');
        });
        $this->assertFalse($colleciton->is_empty());
    }
}
