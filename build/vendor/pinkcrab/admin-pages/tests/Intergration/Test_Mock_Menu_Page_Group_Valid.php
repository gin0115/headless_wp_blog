<?php

namespace PC_Headless_Blog_1AA\PinkCrab\Admin_Pages\Tests\Intergration;

use PC_Headless_Blog_1AA\WP_UnitTestCase;
use PC_Headless_Blog_1AA\PinkCrab\Loader\Loader;
use PC_Headless_Blog_1AA\Gin0115\WPUnit_Helpers\Output;
use PC_Headless_Blog_1AA\PinkCrab\Core\Application\App;
use PC_Headless_Blog_1AA\PinkCrab\Admin_Pages\Page_Validator;
use PC_Headless_Blog_1AA\PinkCrab\Admin_Pages\Menu_Page_Group;
use PC_Headless_Blog_1AA\Gin0115\WPUnit_Helpers\WP\Menu_Page_Inspector;
use PC_Headless_Blog_1AA\PinkCrab\Admin_Pages\Tests\Mocks\Mock_Menu_Page_Group_Valid as Mock_Group;
/**
 * Intergration tests for menu groups.
 */
class Test_Mock_Menu_Page_Group_Valid extends \WP_UnitTestCase
{
    /** @testdox When a menu group is registered and an admin user access wp-admin they should see the primary group, wit the defined titles, icons. There then should be 3 pages which can be accessed and make use of the data definied. */
    public function test_pages_added_to_admin_menu() : void
    {
        $inspector = $this->register_pages();
        // Find group and parent page.
        $group = $inspector->find_group(\PC_Headless_Blog_1AA\PinkCrab\Admin_Pages\Tests\Mocks\Mock_Menu_Page_Group_Valid::GROUP_KEY);
        $parent_page = $inspector->find_child(\PC_Headless_Blog_1AA\PinkCrab\Admin_Pages\Tests\Mocks\Mock_Menu_Page_Group_Valid::PARENT_PAGE['key']);
        $page_1 = $inspector->find_child(\PC_Headless_Blog_1AA\PinkCrab\Admin_Pages\Tests\Mocks\Mock_Menu_Page_Group_Valid::CHILD_PAGE_1['key']);
        $page_2 = $inspector->find_child(\PC_Headless_Blog_1AA\PinkCrab\Admin_Pages\Tests\Mocks\Mock_Menu_Page_Group_Valid::CHILD_PAGE_2['key']);
        // Check group and pages exist.
        $this->assertNotNull($group);
        $this->assertNotNull($parent_page);
        $this->assertNotNull($page_1);
        $this->assertNotNull($page_2);
        // Check the group details (many shared with parent page).
        $this->assertSame(\PC_Headless_Blog_1AA\PinkCrab\Admin_Pages\Tests\Mocks\Mock_Menu_Page_Group_Valid::GROUP_KEY, $group->menu_slug);
        $this->assertSame(\PC_Headless_Blog_1AA\PinkCrab\Admin_Pages\Tests\Mocks\Mock_Menu_Page_Group_Valid::MENU_TITLE, $group->menu_title);
        $this->assertSame(\PC_Headless_Blog_1AA\PinkCrab\Admin_Pages\Tests\Mocks\Mock_Menu_Page_Group_Valid::ICON, $group->icon);
        $this->assertSame(\PC_Headless_Blog_1AA\PinkCrab\Admin_Pages\Tests\Mocks\Mock_Menu_Page_Group_Valid::PARENT_PAGE['capability'], $group->permission);
        $this->assertSame('toplevel_page_' . \PC_Headless_Blog_1AA\PinkCrab\Admin_Pages\Tests\Mocks\Mock_Menu_Page_Group_Valid::GROUP_KEY, $group->hook_name);
        // Check parent page.
        $this->assertSame(\PC_Headless_Blog_1AA\PinkCrab\Admin_Pages\Tests\Mocks\Mock_Menu_Page_Group_Valid::PARENT_PAGE['title'], $parent_page->page_title);
        $this->assertSame(\PC_Headless_Blog_1AA\PinkCrab\Admin_Pages\Tests\Mocks\Mock_Menu_Page_Group_Valid::PARENT_PAGE['menu_title'], $parent_page->menu_title);
        $this->assertSame(\PC_Headless_Blog_1AA\PinkCrab\Admin_Pages\Tests\Mocks\Mock_Menu_Page_Group_Valid::PARENT_PAGE['key'], $parent_page->menu_slug);
        $this->assertSame(\PC_Headless_Blog_1AA\PinkCrab\Admin_Pages\Tests\Mocks\Mock_Menu_Page_Group_Valid::PARENT_PAGE['capability'], $parent_page->permission);
        $this->assertSame(\PC_Headless_Blog_1AA\PinkCrab\Admin_Pages\Tests\Mocks\Mock_Menu_Page_Group_Valid::GROUP_KEY, $parent_page->parent_slug);
        // Check child page 1.
        $this->assertSame(\PC_Headless_Blog_1AA\PinkCrab\Admin_Pages\Tests\Mocks\Mock_Menu_Page_Group_Valid::CHILD_PAGE_1['title'], $page_1->page_title);
        $this->assertSame(\PC_Headless_Blog_1AA\PinkCrab\Admin_Pages\Tests\Mocks\Mock_Menu_Page_Group_Valid::CHILD_PAGE_1['menu_title'], $page_1->menu_title);
        $this->assertSame(\PC_Headless_Blog_1AA\PinkCrab\Admin_Pages\Tests\Mocks\Mock_Menu_Page_Group_Valid::CHILD_PAGE_1['key'], $page_1->menu_slug);
        $this->assertSame(\PC_Headless_Blog_1AA\PinkCrab\Admin_Pages\Tests\Mocks\Mock_Menu_Page_Group_Valid::CHILD_PAGE_1['capability'], $page_1->permission);
        $this->assertSame(\PC_Headless_Blog_1AA\PinkCrab\Admin_Pages\Tests\Mocks\Mock_Menu_Page_Group_Valid::GROUP_KEY, $page_1->parent_slug);
        // Check child page 2.
        $this->assertSame(\PC_Headless_Blog_1AA\PinkCrab\Admin_Pages\Tests\Mocks\Mock_Menu_Page_Group_Valid::CHILD_PAGE_2['title'], $page_2->page_title);
        $this->assertSame(\PC_Headless_Blog_1AA\PinkCrab\Admin_Pages\Tests\Mocks\Mock_Menu_Page_Group_Valid::CHILD_PAGE_2['menu_title'], $page_2->menu_title);
        $this->assertSame(\PC_Headless_Blog_1AA\PinkCrab\Admin_Pages\Tests\Mocks\Mock_Menu_Page_Group_Valid::CHILD_PAGE_2['key'], $page_2->menu_slug);
        $this->assertSame(\PC_Headless_Blog_1AA\PinkCrab\Admin_Pages\Tests\Mocks\Mock_Menu_Page_Group_Valid::CHILD_PAGE_2['capability'], $page_2->permission);
        $this->assertSame(\PC_Headless_Blog_1AA\PinkCrab\Admin_Pages\Tests\Mocks\Mock_Menu_Page_Group_Valid::GROUP_KEY, $page_2->parent_slug);
        // Test page tempalte and data.
        $outputParent = \PC_Headless_Blog_1AA\Gin0115\WPUnit_Helpers\Output::buffer(function () {
            do_action(get_plugin_page_hookname(\PC_Headless_Blog_1AA\PinkCrab\Admin_Pages\Tests\Mocks\Mock_Menu_Page_Group_Valid::GROUP_KEY, ''), function ($e) {
            });
        });
        $this->assertEquals('foo--bar', $outputParent);
        // First child page
        $outputChild1 = \PC_Headless_Blog_1AA\Gin0115\WPUnit_Helpers\Output::buffer(function () {
            do_action(get_plugin_page_hookname(\PC_Headless_Blog_1AA\PinkCrab\Admin_Pages\Tests\Mocks\Mock_Menu_Page_Group_Valid::CHILD_PAGE_1['key'], \PC_Headless_Blog_1AA\PinkCrab\Admin_Pages\Tests\Mocks\Mock_Menu_Page_Group_Valid::GROUP_KEY), function ($e) {
            });
        });
        $this->assertEquals('foo1--bar1', $outputChild1);
        // Second child page.
        $outputChild2 = \PC_Headless_Blog_1AA\Gin0115\WPUnit_Helpers\Output::buffer(function () {
            do_action(get_plugin_page_hookname(\PC_Headless_Blog_1AA\PinkCrab\Admin_Pages\Tests\Mocks\Mock_Menu_Page_Group_Valid::CHILD_PAGE_2['key'], \PC_Headless_Blog_1AA\PinkCrab\Admin_Pages\Tests\Mocks\Mock_Menu_Page_Group_Valid::GROUP_KEY), function ($e) {
            });
        });
        $this->assertEquals('foo2--bar2', $outputChild2);
        // Clear any existing menu globals.
        $GLOBALS['menu'] = null;
        $GLOBALS['submenu'] = null;
    }
    /**
     * Populates the menu group and returns a new inspector instance, populated with menu and subment globals.
     *
     * @return \Gin0115\WPUnit_Helpers\WP\Menu_Page_Inspector
     */
    public function register_pages() : \PC_Headless_Blog_1AA\Gin0115\WPUnit_Helpers\WP\Menu_Page_Inspector
    {
        // Login user and set to accessing dashboard.
        $admin_user = self::factory()->user->create(array('role' => 'administrator'));
        wp_set_current_user($admin_user);
        set_current_screen('dashboard');
        // Register all pages with wp.
        $loader = new \PC_Headless_Blog_1AA\PinkCrab\Loader\Loader();
        $menu_group = new \PC_Headless_Blog_1AA\PinkCrab\Admin_Pages\Tests\Mocks\Mock_Menu_Page_Group_Valid(new \PC_Headless_Blog_1AA\PinkCrab\Core\Application\App());
        $menu_group->register($loader);
        $loader->register_hooks();
        // Clear any existing menu globals.
        $GLOBALS['menu'] = null;
        $GLOBALS['submenu'] = null;
        // Register and initialise inspector
        return \PC_Headless_Blog_1AA\Gin0115\WPUnit_Helpers\WP\Menu_Page_Inspector::initialise()->set_globals(\true)->set_pages();
    }
}
