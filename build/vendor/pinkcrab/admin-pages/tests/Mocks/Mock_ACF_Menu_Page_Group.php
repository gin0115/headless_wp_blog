<?php

declare (strict_types=1);
namespace PC_Headless_Blog_1AA\PinkCrab\Admin_Pages\Tests\Mocks;

use PC_Headless_Blog_1AA\PinkCrab\Admin_Pages\Page;
use PC_Headless_Blog_1AA\PinkCrab\Admin_Pages\ACF_Page;
use PC_Headless_Blog_1AA\PinkCrab\Admin_Pages\Page_Factory;
use PC_Headless_Blog_1AA\PinkCrab\Admin_Pages\Menu_Page_Group;
use PC_Headless_Blog_1AA\PinkCrab\Admin_Pages\Page_Collection;
/**
 * Testing example of the Admin_Pages Group.
 */
class Mock_ACF_Menu_Page_Group extends \PC_Headless_Blog_1AA\PinkCrab\Admin_Pages\Menu_Page_Group
{
    // Mock values
    public const GROUP_KEY = 'pc_framework_admin_page_group_acf';
    public const MENU_TITLE = 'Test ACF';
    public const PARENT_PAGE = array('key' => self::GROUP_KEY, 'title' => 'Test Page', 'menu_title' => self::MENU_TITLE, 'position' => 1, 'capability' => 'manage_options', 'updated_message' => 'Parent Updated', 'update_button' => 'Parent up');
    public const CHILD_PAGE_1 = array('key' => 'acf-page-1', 'title' => 'ACF Page 1', 'menu_title' => 'ACF Page 1', 'position' => 9, 'capability' => 'manage_options', 'updated_message' => 'Page 1 Updated', 'update_button' => '1 up');
    // End mock values.
    public $key = self::GROUP_KEY;
    public $menu_title = self::MENU_TITLE;
    /**
     * Register the parent/main page.
     *
     * @param Page $page
     * @return Page $page
     */
    protected function set_parent_page(\PC_Headless_Blog_1AA\PinkCrab\Admin_Pages\Page $page) : \PC_Headless_Blog_1AA\PinkCrab\Admin_Pages\Page
    {
        $page = \PC_Headless_Blog_1AA\PinkCrab\Admin_Pages\ACF_Page::create_page(self::GROUP_KEY, self::PARENT_PAGE['menu_title']);
        $page->title(self::PARENT_PAGE['title']);
        $page->position(self::PARENT_PAGE['position']);
        $page->update_button(self::PARENT_PAGE['update_button']);
        $page->updated_message(self::PARENT_PAGE['updated_message']);
        return $page;
    }
    /**
     * Register all child pages.
     *
     * @param Page_Collection $children
     * @return Page_Collection
     */
    protected function set_child_pages(\PC_Headless_Blog_1AA\PinkCrab\Admin_Pages\Page_Collection $children) : \PC_Headless_Blog_1AA\PinkCrab\Admin_Pages\Page_Collection
    {
        $children->add(\PC_Headless_Blog_1AA\PinkCrab\Admin_Pages\ACF_Page::create_page(self::CHILD_PAGE_1['key'], self::CHILD_PAGE_1['menu_title'], self::GROUP_KEY)->title(self::CHILD_PAGE_1['title'])->position(self::CHILD_PAGE_1['position'])->capability(self::CHILD_PAGE_1['capability'])->updated_message(self::CHILD_PAGE_1['updated_message'])->update_button(self::CHILD_PAGE_1['update_button']));
        return $children;
    }
}
