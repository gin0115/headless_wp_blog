<?php

namespace PC_Headless_Blog_1AA\PinkCrab\Admin_Pages\Tests\Intergration;

use PC_Headless_Blog_1AA\MockClass;
use PC_Headless_Blog_1AA\WP_UnitTestCase;
use PC_Headless_Blog_1AA\PinkCrab\Loader\Loader;
use PC_Headless_Blog_1AA\Gin0115\WPUnit_Helpers\Output;
use PC_Headless_Blog_1AA\PinkCrab\Core\Application\App;
use PC_Headless_Blog_1AA\PinkCrab\Admin_Pages\Page_Validator;
use PC_Headless_Blog_1AA\PinkCrab\Admin_Pages\Menu_Page_Group;
use PC_Headless_Blog_1AA\Gin0115\WPUnit_Helpers\WP\Menu_Page_Inspector;
use PC_Headless_Blog_1AA\PinkCrab\Admin_Pages\Tests\Mocks\Mock_ACF_Menu_Page_Group as Mock_Group;
/**
 * Intergration tests for menu groups.
 */
class Test_Mock_ACF_Menu_Page_Group extends \WP_UnitTestCase
{
    /** @testdox When a menu group is registered and an admin user access wp-admin they should see the primary group, wit the defined titles, icons. There then should be 3 pages which can be accessed and make use of the data definied. */
    public function test_pages_added_to_admin_menu() : void
    {
        $pages = $this->register_pages();
        $this->assertCount(2, $pages);
        $parent_page = $pages[\PC_Headless_Blog_1AA\PinkCrab\Admin_Pages\Tests\Mocks\Mock_ACF_Menu_Page_Group::GROUP_KEY];
        $page_1 = $pages['acf-options-' . \PC_Headless_Blog_1AA\PinkCrab\Admin_Pages\Tests\Mocks\Mock_ACF_Menu_Page_Group::CHILD_PAGE_1['key']];
        // Check parent page.
        $this->assertSame(\PC_Headless_Blog_1AA\PinkCrab\Admin_Pages\Tests\Mocks\Mock_ACF_Menu_Page_Group::PARENT_PAGE['title'], $parent_page['page_title']);
        $this->assertSame(\PC_Headless_Blog_1AA\PinkCrab\Admin_Pages\Tests\Mocks\Mock_ACF_Menu_Page_Group::PARENT_PAGE['menu_title'], $parent_page['menu_title']);
        $this->assertSame(\PC_Headless_Blog_1AA\PinkCrab\Admin_Pages\Tests\Mocks\Mock_ACF_Menu_Page_Group::PARENT_PAGE['key'], $parent_page['menu_slug']);
        $this->assertSame(\PC_Headless_Blog_1AA\PinkCrab\Admin_Pages\Tests\Mocks\Mock_ACF_Menu_Page_Group::PARENT_PAGE['capability'], $parent_page['capability']);
        $this->assertSame(\PC_Headless_Blog_1AA\PinkCrab\Admin_Pages\Tests\Mocks\Mock_ACF_Menu_Page_Group::PARENT_PAGE['update_button'], $parent_page['update_button']);
        $this->assertSame(\PC_Headless_Blog_1AA\PinkCrab\Admin_Pages\Tests\Mocks\Mock_ACF_Menu_Page_Group::CHILD_PAGE_1['title'], $page_1['page_title']);
        $this->assertSame(\PC_Headless_Blog_1AA\PinkCrab\Admin_Pages\Tests\Mocks\Mock_ACF_Menu_Page_Group::CHILD_PAGE_1['menu_title'], $page_1['menu_title']);
        $this->assertSame('acf-options-' . \PC_Headless_Blog_1AA\PinkCrab\Admin_Pages\Tests\Mocks\Mock_ACF_Menu_Page_Group::CHILD_PAGE_1['key'], $page_1['menu_slug']);
        $this->assertSame(\PC_Headless_Blog_1AA\PinkCrab\Admin_Pages\Tests\Mocks\Mock_ACF_Menu_Page_Group::CHILD_PAGE_1['capability'], $page_1['capability']);
        $this->assertSame(\PC_Headless_Blog_1AA\PinkCrab\Admin_Pages\Tests\Mocks\Mock_ACF_Menu_Page_Group::CHILD_PAGE_1['updated_message'], $page_1['updated_message']);
        // Clear any existing menu globals.
        $GLOBALS['menu'] = null;
        $GLOBALS['submenu'] = null;
    }
    /**
     * Populates the menu group and returns a new inspector instance, populated with menu and subment globals.
     *
     * @return \Gin0115\WPUnit_Helpers\WP\Menu_Page_Inspector
     */
    public function register_pages() : array
    {
        // Login user and set to accessing dashboard.
        $admin_user = self::factory()->user->create(array('role' => 'administrator'));
        wp_set_current_user($admin_user);
        set_current_screen('dashboard');
        // Register all pages with wp.
        $loader = new \PC_Headless_Blog_1AA\PinkCrab\Loader\Loader();
        $menu_group = new \PC_Headless_Blog_1AA\PinkCrab\Admin_Pages\Tests\Mocks\Mock_ACF_Menu_Page_Group(new \PC_Headless_Blog_1AA\PinkCrab\Core\Application\App());
        $menu_group->register($loader);
        $loader->register_hooks();
        // Clear any existing menu globals.
        $GLOBALS['menu'] = null;
        $GLOBALS['submenu'] = null;
        // Initalise ACF
        do_action('acf/init');
        do_action('admin_menu');
        return acf_get_options_pages();
    }
}
