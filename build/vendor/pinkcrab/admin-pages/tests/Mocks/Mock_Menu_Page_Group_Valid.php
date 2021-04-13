<?php

declare (strict_types=1);
namespace PC_Headless_Blog_1AA\PinkCrab\Admin_Pages\Tests\Mocks;

use PC_Headless_Blog_1AA\PinkCrab\Admin_Pages\Page;
use PC_Headless_Blog_1AA\PinkCrab\Admin_Pages\Page_Factory;
use PC_Headless_Blog_1AA\PinkCrab\Admin_Pages\Menu_Page_Group;
use PC_Headless_Blog_1AA\PinkCrab\Admin_Pages\Page_Collection;
/**
 * Testing example of the Admin_Pages Group.
 */
class Mock_Menu_Page_Group_Valid extends \PC_Headless_Blog_1AA\PinkCrab\Admin_Pages\Menu_Page_Group
{
    // Mock values
    public const GROUP_KEY = 'pc_framework_admin_page_group';
    public const MENU_TITLE = 'Test';
    public const ICON = 'dashicons-carrot';
    public const PARENT_PAGE = array('key' => self::GROUP_KEY, 'title' => 'Test Page', 'menu_title' => self::MENU_TITLE, 'position' => 1, 'template' => 'mock-menu-page-view', 'data' => array('foo' => 'foo', 'bar' => 'bar'), 'capability' => 'manage_options');
    public const CHILD_PAGE_1 = array('key' => 'sub_page_1', 'title' => 'Sub Page 1', 'menu_title' => 'Sub Page 1', 'position' => 9, 'template' => 'mock-menu-page-view', 'data' => array('foo' => 'foo1', 'bar' => 'bar1'), 'capability' => 'manage_options');
    public const CHILD_PAGE_2 = array('key' => 'sub_page_2', 'title' => 'Sub Page 2', 'menu_title' => 'Sub Page 2', 'position' => 2, 'template' => 'mock-menu-page-view', 'data' => array('foo' => 'foo2', 'bar' => 'bar2'), 'capability' => 'edit_others_posts');
    // End mock values.
    public $key = self::GROUP_KEY;
    public $menu_title = self::MENU_TITLE;
    public $icon_url = self::ICON;
    /**
     * Register the parent/main page.
     *
     * @param Page $page
     * @return Page $page
     */
    protected function set_parent_page(\PC_Headless_Blog_1AA\PinkCrab\Admin_Pages\Page $page) : \PC_Headless_Blog_1AA\PinkCrab\Admin_Pages\Page
    {
        return $page->title(self::PARENT_PAGE['title'])->view_template(self::PARENT_PAGE['template'])->view_data(self::PARENT_PAGE['data']);
    }
    /**
     * Register all child pages.
     *
     * @param Page_Collection $children
     * @return Page_Collection
     */
    protected function set_child_pages(\PC_Headless_Blog_1AA\PinkCrab\Admin_Pages\Page_Collection $children) : \PC_Headless_Blog_1AA\PinkCrab\Admin_Pages\Page_Collection
    {
        // Has no defined capability, should use group/parent capability
        $children->add_child_page(function (\PC_Headless_Blog_1AA\PinkCrab\Admin_Pages\Page_Factory $factory) : Page {
            return $factory->child_page(self::CHILD_PAGE_1['menu_title'], self::CHILD_PAGE_1['key'])->title(self::CHILD_PAGE_1['title'])->position(self::CHILD_PAGE_1['position'])->view_template(self::CHILD_PAGE_1['template'])->view_data(self::CHILD_PAGE_1['data']);
        });
        // With custom capability
        $children->add_child_page(function (\PC_Headless_Blog_1AA\PinkCrab\Admin_Pages\Page_Factory $factory) : Page {
            return $factory->child_page(self::CHILD_PAGE_2['menu_title'], self::CHILD_PAGE_2['key'])->title(self::CHILD_PAGE_2['title'])->position(self::CHILD_PAGE_2['position'])->view_template(self::CHILD_PAGE_2['template'])->view_data(self::CHILD_PAGE_2['data'])->capability(self::CHILD_PAGE_2['capability']);
        });
        return $children;
    }
}
