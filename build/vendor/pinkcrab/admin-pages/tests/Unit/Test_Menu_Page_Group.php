<?php

namespace PC_Headless_Blog_1AA\PinkCrab\Admin_Pages\Tests\Unit;

use Exception;
use PC_Headless_Blog_1AA\MockClass;
use PC_Headless_Blog_1AA\WP_UnitTestCase;
use ReflectionFunction;
use PC_Headless_Blog_1AA\PinkCrab\Loader\Hook;
use PC_Headless_Blog_1AA\PinkCrab\Loader\Loader;
use PC_Headless_Blog_1AA\PinkCrab\Admin_Pages\Page;
use PC_Headless_Blog_1AA\PinkCrab\Core\Application\App;
use PC_Headless_Blog_1AA\Gin0115\WPUnit_Helpers\Objects;
use PC_Headless_Blog_1AA\PinkCrab\Admin_Pages\Page_Factory;
use PC_Headless_Blog_1AA\PinkCrab\Admin_Pages\Page_Validator;
use PC_Headless_Blog_1AA\PinkCrab\Core\Interfaces\Renderable;
use PC_Headless_Blog_1AA\PinkCrab\Admin_Pages\Page_Collection;
use PC_Headless_Blog_1AA\PinkCrab\Admin_Pages\Tests\Mocks\Mock_Menu_Page_Group_Valid as Mock_Group;
class Test_Menu_Page_Group extends \WP_UnitTestCase
{
    /** @testdox When a group is instanced, all the internal structures and services should be initialised either through DI or in constructor.*/
    public function test_can_construct_group() : void
    {
        $group = new \PC_Headless_Blog_1AA\PinkCrab\Admin_Pages\Tests\Mocks\Mock_Menu_Page_Group_Valid(new \PC_Headless_Blog_1AA\PinkCrab\Core\Application\App());
        $this->assertInstanceOf(\PC_Headless_Blog_1AA\PinkCrab\Core\Application\App::class, \PC_Headless_Blog_1AA\Gin0115\WPUnit_Helpers\Objects::get_property($group, 'app'));
        $this->assertInstanceOf(\PC_Headless_Blog_1AA\PinkCrab\Core\Interfaces\Renderable::class, \PC_Headless_Blog_1AA\Gin0115\WPUnit_Helpers\Objects::get_property($group, 'view'));
        $this->assertInstanceOf(\PC_Headless_Blog_1AA\PinkCrab\Admin_Pages\Page_Validator::class, \PC_Headless_Blog_1AA\Gin0115\WPUnit_Helpers\Objects::get_property($group, 'page_validator'));
        $this->assertInstanceOf(\PC_Headless_Blog_1AA\PinkCrab\Admin_Pages\Page::class, \PC_Headless_Blog_1AA\Gin0115\WPUnit_Helpers\Objects::get_property($group, 'parent'));
        $this->assertInstanceOf(\PC_Headless_Blog_1AA\PinkCrab\Admin_Pages\Page_Collection::class, \PC_Headless_Blog_1AA\Gin0115\WPUnit_Helpers\Objects::get_property($group, 'children'));
    }
    /** @testdox When a group is defined, it should be possible to create and popaulte the parent page using a method. */
    public function test_set_parent_page() : void
    {
        $group = new \PC_Headless_Blog_1AA\PinkCrab\Admin_Pages\Tests\Mocks\Mock_Menu_Page_Group_Valid(new \PC_Headless_Blog_1AA\PinkCrab\Core\Application\App());
        $parent = \PC_Headless_Blog_1AA\Gin0115\WPUnit_Helpers\Objects::get_property($group, 'parent');
        $this->assertSame(\PC_Headless_Blog_1AA\PinkCrab\Admin_Pages\Tests\Mocks\Mock_Menu_Page_Group_Valid::PARENT_PAGE['key'], $parent->key);
        $this->assertSame(\PC_Headless_Blog_1AA\PinkCrab\Admin_Pages\Tests\Mocks\Mock_Menu_Page_Group_Valid::PARENT_PAGE['title'], $parent->title);
        $this->assertSame(\PC_Headless_Blog_1AA\PinkCrab\Admin_Pages\Tests\Mocks\Mock_Menu_Page_Group_Valid::PARENT_PAGE['menu_title'], $parent->menu_title);
        $this->assertSame(\PC_Headless_Blog_1AA\PinkCrab\Admin_Pages\Tests\Mocks\Mock_Menu_Page_Group_Valid::PARENT_PAGE['position'], $parent->get_position());
        $this->assertSame(\PC_Headless_Blog_1AA\PinkCrab\Admin_Pages\Tests\Mocks\Mock_Menu_Page_Group_Valid::PARENT_PAGE['template'], $parent->view_template);
        $this->assertSame(\PC_Headless_Blog_1AA\PinkCrab\Admin_Pages\Tests\Mocks\Mock_Menu_Page_Group_Valid::PARENT_PAGE['data'], $parent->view_data);
    }
    /** @testdox When a group is defined, it should be possible to define child pages and have them populated ready to regisered. */
    public function test_set_child_pages()
    {
        $group = new \PC_Headless_Blog_1AA\PinkCrab\Admin_Pages\Tests\Mocks\Mock_Menu_Page_Group_Valid(new \PC_Headless_Blog_1AA\PinkCrab\Core\Application\App());
        // Get all child pages as an array from internal collection.
        $children = \PC_Headless_Blog_1AA\Gin0115\WPUnit_Helpers\Objects::get_property($group, 'children');
        $children = \PC_Headless_Blog_1AA\Gin0115\WPUnit_Helpers\Objects::get_property($children, 'pages')->to_array();
        foreach ($children as $child) {
            // Child 1
            if ($child->key === \PC_Headless_Blog_1AA\PinkCrab\Admin_Pages\Tests\Mocks\Mock_Menu_Page_Group_Valid::CHILD_PAGE_1['key']) {
                $this->assertSame(\PC_Headless_Blog_1AA\PinkCrab\Admin_Pages\Tests\Mocks\Mock_Menu_Page_Group_Valid::CHILD_PAGE_1['key'], $child->key);
                $this->assertSame(\PC_Headless_Blog_1AA\PinkCrab\Admin_Pages\Tests\Mocks\Mock_Menu_Page_Group_Valid::CHILD_PAGE_1['title'], $child->title);
                $this->assertSame(\PC_Headless_Blog_1AA\PinkCrab\Admin_Pages\Tests\Mocks\Mock_Menu_Page_Group_Valid::CHILD_PAGE_1['menu_title'], $child->menu_title);
                $this->assertSame(\PC_Headless_Blog_1AA\PinkCrab\Admin_Pages\Tests\Mocks\Mock_Menu_Page_Group_Valid::CHILD_PAGE_1['position'], $child->get_position());
                $this->assertSame(\PC_Headless_Blog_1AA\PinkCrab\Admin_Pages\Tests\Mocks\Mock_Menu_Page_Group_Valid::CHILD_PAGE_1['template'], $child->view_template);
                $this->assertSame(\PC_Headless_Blog_1AA\PinkCrab\Admin_Pages\Tests\Mocks\Mock_Menu_Page_Group_Valid::CHILD_PAGE_1['data'], $child->view_data);
            }
            // Child 2
            if ($child->key === \PC_Headless_Blog_1AA\PinkCrab\Admin_Pages\Tests\Mocks\Mock_Menu_Page_Group_Valid::CHILD_PAGE_2['key']) {
                $this->assertSame(\PC_Headless_Blog_1AA\PinkCrab\Admin_Pages\Tests\Mocks\Mock_Menu_Page_Group_Valid::CHILD_PAGE_2['key'], $child->key);
                $this->assertSame(\PC_Headless_Blog_1AA\PinkCrab\Admin_Pages\Tests\Mocks\Mock_Menu_Page_Group_Valid::CHILD_PAGE_2['title'], $child->title);
                $this->assertSame(\PC_Headless_Blog_1AA\PinkCrab\Admin_Pages\Tests\Mocks\Mock_Menu_Page_Group_Valid::CHILD_PAGE_2['menu_title'], $child->menu_title);
                $this->assertSame(\PC_Headless_Blog_1AA\PinkCrab\Admin_Pages\Tests\Mocks\Mock_Menu_Page_Group_Valid::CHILD_PAGE_2['position'], $child->get_position());
                $this->assertSame(\PC_Headless_Blog_1AA\PinkCrab\Admin_Pages\Tests\Mocks\Mock_Menu_Page_Group_Valid::CHILD_PAGE_2['template'], $child->view_template);
                $this->assertSame(\PC_Headless_Blog_1AA\PinkCrab\Admin_Pages\Tests\Mocks\Mock_Menu_Page_Group_Valid::CHILD_PAGE_2['data'], $child->view_data);
            }
        }
    }
    /** @testdox When registering the menu group parent and child pages should be hook up to the admin_menu action.  */
    public function test_can_register_pages() : void
    {
        $loader = new \PC_Headless_Blog_1AA\PinkCrab\Loader\Loader();
        $group = new \PC_Headless_Blog_1AA\PinkCrab\Admin_Pages\Tests\Mocks\Mock_Menu_Page_Group_Valid(new \PC_Headless_Blog_1AA\PinkCrab\Core\Application\App());
        $group->register($loader);
        // Filter out all admin_menu hooks for this group only.
        $menu_pages = \array_filter(\PC_Headless_Blog_1AA\Gin0115\WPUnit_Helpers\Objects::get_property($loader, 'hooks')->export(), function (\PC_Headless_Blog_1AA\PinkCrab\Loader\Hook $hook) : bool {
            // Get the closures 'use' state and ensure its our group.
            $fn = new \ReflectionFunction($hook->get_callback());
            $bound_class = \get_class($fn->getClosureThis());
            return $hook->get_handle() === 'admin_menu' && $bound_class === \PC_Headless_Blog_1AA\PinkCrab\Admin_Pages\Tests\Mocks\Mock_Menu_Page_Group_Valid::class;
        });
        $this->assertCount(3, $menu_pages);
    }
    /** @testdox When registering a menu group, all pages should be validated and any that fail should result in an error. */
    public function test_register_throws_exception_for_invaid_page() : void
    {
        $this->expectException(\InvalidArgumentException::class);
        $loader = new \PC_Headless_Blog_1AA\PinkCrab\Loader\Loader();
        $group = new \PC_Headless_Blog_1AA\PinkCrab\Admin_Pages\Tests\Mocks\Mock_Menu_Page_Group_Valid(new \PC_Headless_Blog_1AA\PinkCrab\Core\Application\App());
        // Get child page collection and add an invalid page.
        /** @var Page_Collection */
        $children = \PC_Headless_Blog_1AA\Gin0115\WPUnit_Helpers\Objects::get_property($group, 'children');
        $children->add_child_page(function (\PC_Headless_Blog_1AA\PinkCrab\Admin_Pages\Page_Factory $factory) : page {
            return $factory->child_page('invalid key', '££');
        });
        $group->register($loader);
    }
}
