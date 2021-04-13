<?php

declare (strict_types=1);
/**
 * Abstract class to base all admin pages from.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS
 * "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT
 * LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR
 * A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT
 * OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL,
 * SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT
 * LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE,
 * DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY
 * THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
 * (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE
 * OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 *
 * @author Glynn Quelch <glynn.quelch@gmail.com>
 * @license http://www.opensource.org/licenses/mit-license.html  MIT License
 * @package PinkCrab\Admin_Pages
 */
namespace PC_Headless_Blog_1AA\PinkCrab\Admin_Pages;

use ReflectionClass;
use PC_Headless_Blog_1AA\PinkCrab\Loader\Loader;
use InvalidArgumentException;
use PC_Headless_Blog_1AA\PinkCrab\Core\Application\App;
use PC_Headless_Blog_1AA\PinkCrab\Admin_Pages\ACF_Page;
use PC_Headless_Blog_1AA\PinkCrab\Core\Interfaces\Renderable;
use PC_Headless_Blog_1AA\PinkCrab\Admin_Pages\Page_Validator;
use PC_Headless_Blog_1AA\PinkCrab\Admin_Pages\Page_Collection;
use PC_Headless_Blog_1AA\PinkCrab\Core\Interfaces\Registerable;
abstract class Menu_Page_Group implements \PC_Headless_Blog_1AA\PinkCrab\Core\Interfaces\Registerable
{
    /**
     * The groups key/slug
     *
     * @var string
     * @required
     */
    public $key;
    /**
     * The title to display in WP-Admin menu
     *
     * @var string
     * @required
     */
    public $menu_title;
    /**
     * The minimum capabilities to show menu group
     *
     * @var string
     * @default 'manage_options'
     */
    public $capability = 'manage_options';
    /**
     * The icon to display, either url or dashicon
     *
     * @var string
     * @default 'dashicons-admin-generic'
     */
    public $icon_url = 'dashicons-admin-generic';
    /**
     * The pages position to be displayed
     *
     * @var int
     * @default 85
     */
    public $position = 85;
    /**
     * Instance of the Apps container
     *
     * @var App
     */
    protected $app;
    /**
     * The parent/primary page object.
     *
     * @var Page
     */
    protected $parent;
    /**
     * All child pages in group.
     *
     * @var Page_Collection
     */
    protected $children;
    /**
     * The current view driver.
     *
     * @var Renderable
     */
    protected $view;
    /**
     * Validates the page properties.
     *
     * @var Page_Validator
     */
    protected $page_validator;
    public function __construct(\PC_Headless_Blog_1AA\PinkCrab\Core\Application\App $app)
    {
        $this->app = $app;
        $this->view = $app::view()->engine();
        // @phpstan-ignore-line
        $this->page_validator = new \PC_Headless_Blog_1AA\PinkCrab\Admin_Pages\Page_Validator();
        // Set the parent page.
        $this->parent = $this->set_parent_page(\PC_Headless_Blog_1AA\PinkCrab\Admin_Pages\Page::create_page($this->key, $this->menu_title, $this->key));
        // Passes a new collection through to inherited class to add child pages to.
        $this->children = $this->set_child_pages(new \PC_Headless_Blog_1AA\PinkCrab\Admin_Pages\Page_Collection($this->key));
    }
    /**
     * Called before the page is registered
     *
     * @return void
     */
    public function setUp()
    {
    }
    /**
     * Default call/return if not defined in child.
     * Sets the parent pages.
     *
     * @param Page $parent_page
     * @return Page
     * @codeCoverageIgnore
     */
    protected function set_parent_page(\PC_Headless_Blog_1AA\PinkCrab\Admin_Pages\Page $parent_page) : \PC_Headless_Blog_1AA\PinkCrab\Admin_Pages\Page
    {
        return $parent_page;
    }
    /**
     * Default call/return if not defined in child.
     * Sets the child pages
     *
     * @param Page_Collection $children
     * @return Page_Collection
     * @codeCoverageIgnore
     */
    protected function set_child_pages(\PC_Headless_Blog_1AA\PinkCrab\Admin_Pages\Page_Collection $children) : \PC_Headless_Blog_1AA\PinkCrab\Admin_Pages\Page_Collection
    {
        return $children;
    }
    /**
     * Validates a page using the page validator.
     *
     * @throws InvalidArgumentException
     * @param Page $page
     * @return void
     */
    protected function validate_page(\PC_Headless_Blog_1AA\PinkCrab\Admin_Pages\Page $page) : void
    {
        $this->page_validator->validate_page($page);
        if ($this->page_validator->has_errors()) {
            throw new \InvalidArgumentException($this->page_validator->get_error_messages());
        }
    }
    /**
     * Registers the admin pages.
     *
     * @return void
     */
    public function register(\PC_Headless_Blog_1AA\PinkCrab\Loader\Loader $loader) : void
    {
        // Register primary page.
        $this->validate_page($this->parent);
        $this->register_parent_page($this->parent, $loader);
        // Register any child pages.
        if (!$this->children->is_empty()) {
            $this->children->register_child_pages(function (\PC_Headless_Blog_1AA\PinkCrab\Admin_Pages\Page $page) use($loader) : void {
                $this->validate_page($page);
                $this->register_child_page($page, $loader);
            });
        }
    }
    /**
     * Registers the parent page, based on type.
     *
     *  @param Page|ACF_Page $page
     * @param Loader $loader
     * @return void
     */
    protected function register_parent_page(\PC_Headless_Blog_1AA\PinkCrab\Admin_Pages\Page $page, \PC_Headless_Blog_1AA\PinkCrab\Loader\Loader $loader) : void
    {
        if ($page instanceof \PC_Headless_Blog_1AA\PinkCrab\Admin_Pages\ACF_Page) {
            $loader->admin_action('acf/init', function () use($page) {
                // @phpstan-ignore-next-line (CHECKS FOR USE FIRST)
                $r = \acf_add_options_page(array('page_title' => $page->title, 'menu_title' => $page->menu_title, 'menu_slug' => $this->key, 'capability' => $page->get_capability() ?? $this->capability, 'redirect' => \false, 'position' => $this->position, 'icon_url' => $this->icon_url, 'update_button' => $page->update_button, 'updated_message' => $page->updated_message));
            });
        } else {
            $loader->admin_action('admin_menu', function () use($page) {
                \add_menu_page($page->title, empty($this->menu_title) ? $this->menu_title : $page->menu_title, $page->get_capability() ?? $this->capability, $this->key, $page->compose_view($this->view), $this->icon_url, $page->get_position());
            });
        }
    }
    /**
     * Registers all child pages.
     *
     * @param Page|ACF_Page $page
     * @param Loader $loader
     * @return void
     */
    protected function register_child_page(\PC_Headless_Blog_1AA\PinkCrab\Admin_Pages\Page $page, \PC_Headless_Blog_1AA\PinkCrab\Loader\Loader $loader) : void
    {
        if ($page instanceof \PC_Headless_Blog_1AA\PinkCrab\Admin_Pages\ACF_Page && \function_exists('PC_Headless_Blog_1AA\\acf_add_options_sub_page')) {
            $loader->admin_action('acf/init', function () use($page) {
                // @phpstan-ignore-next-line (CHECKS FOR USE FIRST)
                \acf_add_options_sub_page(array('page_title' => $page->title, 'menu_title' => $page->menu_title, 'parent_slug' => $this->key, 'capability' => $page->get_capability() ?? $this->capability, 'position' => $page->get_position(), 'update_button' => $page->update_button, 'updated_message' => $page->updated_message));
            });
        } else {
            $loader->admin_action('admin_menu', function () use($page) {
                \add_submenu_page($this->key, $page->title, $page->menu_title, $page->get_capability() ?? $this->capability, $page->key, $page->compose_view($this->view), $page->get_position());
            });
        }
    }
}
