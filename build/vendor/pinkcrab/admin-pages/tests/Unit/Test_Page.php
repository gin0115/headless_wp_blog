<?php

namespace PC_Headless_Blog_1AA\PinkCrab\Admin_Pages\Tests\Unit;

use PC_Headless_Blog_1AA\WP_UnitTestCase;
use PC_Headless_Blog_1AA\PinkCrab\Admin_Pages\Page;
use PC_Headless_Blog_1AA\Gin0115\WPUnit_Helpers\Output;
use PC_Headless_Blog_1AA\PinkCrab\Core\Services\View\PHP_Engine;
class Test_Page extends \WP_UnitTestCase
{
    /** @testdox It should be possible to create a page using a fully fluent interface. */
    public function test_create_page() : void
    {
        $page = \PC_Headless_Blog_1AA\PinkCrab\Admin_Pages\Page::create_page('key', 'menu title');
        $this->assertEquals('key', $page->key);
        $this->assertEquals('menu title', $page->menu_title);
    }
    /** @testdox It should be possible to set the page title for a page. */
    public function test_title() : void
    {
        $page = new \PC_Headless_Blog_1AA\PinkCrab\Admin_Pages\Page('key');
        $page->title('title');
        $this->assertEquals('title', $page->title);
    }
    /** @testdox It should be possible to define the template and data needed to generate the page content. */
    public function test_view() : void
    {
        $page = new \PC_Headless_Blog_1AA\PinkCrab\Admin_Pages\Page('key');
        $page->view_template('template');
        $page->view_data(array('key' => 'value'));
        $this->assertEquals('template', $page->view_template);
        $this->assertContains('value', $page->view_data);
        $this->assertArrayHasKey('key', $page->view_data);
    }
    /** @testdox It should be possible to set the pages position in realtion to other pages within a group. */
    public function test_position() : void
    {
        $page = new \PC_Headless_Blog_1AA\PinkCrab\Admin_Pages\Page('key');
        $page->position(42);
        $this->assertEquals(42, $page->get_position());
    }
    /** @testdox It should be possible to set the capabilities required to access the page. */
    public function test_capabilities() : void
    {
        $page = new \PC_Headless_Blog_1AA\PinkCrab\Admin_Pages\Page('key');
        $page->capability('edit_post');
        $this->assertEquals('edit_post', $page->get_capability());
        $this->assertEquals('edit_post', $page->capability);
    }
    /** @testdox It should be possible to render the view with data for a page */
    public function test_render_view() : void
    {
        $page = new \PC_Headless_Blog_1AA\PinkCrab\Admin_Pages\Page('key');
        $page->view_template('mock-menu-page-view.php');
        $page->view_data(array('foo' => 'foo1', 'bar' => 'bar1'));
        // Capture output
        $output = \PC_Headless_Blog_1AA\Gin0115\WPUnit_Helpers\Output::buffer(function () use($page) {
            // Rendered as a function, so needs currying.
            $page->compose_view(new \PC_Headless_Blog_1AA\PinkCrab\Core\Services\View\PHP_Engine(\dirname(__DIR__, 1) . '/Mocks'))();
        });
        $this->assertEquals('foo1--bar1', $output);
    }
}
