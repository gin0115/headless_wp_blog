<?php

declare (strict_types=1);
/**
 * The hook loader.
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
 * @since 1.0.0
 * @author Glynn Quelch <glynn.quelch@gmail.com>
 * @license http://www.opensource.org/licenses/mit-license.html  MIT License
 * @package PinkCrab\Loader
 */
namespace PC_Headless_Blog_1AA\PinkCrab\Loader;

use PC_Headless_Blog_1AA\PinkCrab\Loader\Hook_Removal;
use PC_Headless_Blog_1AA\PinkCrab\Loader\Hook_Collection;
class Loader
{
    /**
     * Global hooks
     *
     * @var Hook_Collection
     */
    protected $global;
    /**
     * Admin only hooks
     *
     * @var Hook_Collection
     */
    protected $admin;
    /**
     * Front hooks
     *
     * @var Hook_Collection
     */
    protected $front;
    /**
     * Shortoces
     *
     * @var Hook_Collection
     */
    protected $shortcode;
    /**
     * Ajax Calls
     *
     * @var Hook_Collection
     */
    protected $ajax;
    /**
     * Hooks to be removed.
     *
     * @since 0.3.5
     * @var Hook_Collection
     */
    protected $remove;
    /**
     * Static instance.
     *
     * @var self|null
     */
    protected static $instance = null;
    /**
     * Creates an instance of the loader.
     */
    public function __construct()
    {
        $this->global = new \PC_Headless_Blog_1AA\PinkCrab\Loader\Hook_Collection();
        $this->admin = new \PC_Headless_Blog_1AA\PinkCrab\Loader\Hook_Collection();
        $this->front = new \PC_Headless_Blog_1AA\PinkCrab\Loader\Hook_Collection();
        $this->shortcode = new \PC_Headless_Blog_1AA\PinkCrab\Loader\Hook_Collection();
        $this->ajax = new \PC_Headless_Blog_1AA\PinkCrab\Loader\Hook_Collection();
        $this->remove = new \PC_Headless_Blog_1AA\PinkCrab\Loader\Hook_Collection();
    }
    /**
     * Boots the loader as a static instance.
     *
     * @return self
     */
    public static function boot() : self
    {
        if (!self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    /**
     * Adds and admin hook to the collection.
     *
     * @param string     $handle
     * @param callable   $method
     * @param integer    $priority
     * @param integer    $args
     * @return void
     */
    public function admin_action(string $handle, callable $method, int $priority = 10, int $args = 1) : void
    {
        $this->admin->push(array('type' => 'action', 'handle' => $handle, 'method' => $method, 'priority' => $priority, 'args' => $args, 'registered' => \false));
    }
    /**
     * Adds an admin filter to the admin collection.
     *
     * @param string     $handle
     * @param callable   $method
     * @param integer    $priority
     * @param integer    $args
     * @return void
     */
    public function admin_filter(string $handle, callable $method, int $priority = 10, int $args = 1)
    {
        $this->admin->push(array('type' => 'filter', 'handle' => $handle, 'method' => $method, 'priority' => $priority, 'args' => $args, 'registered' => \false));
    }
    /**
     * Adds an action for the front end.
     *
     * @param string     $handle
     * @param callable   $method
     * @param integer    $priority
     * @param integer    $args
     * @return void
     */
    public function front_action(string $handle, callable $method, int $priority = 10, int $args = 1) : void
    {
        $this->front->push(array('type' => 'action', 'handle' => $handle, 'method' => $method, 'priority' => $priority, 'args' => $args, 'registered' => \false));
    }
    /**
     * Adds an front filter to the front collection.
     *
     * @param string     $handle
     * @param callable   $method
     * @param integer    $priority
     * @param integer    $args
     * @return void
     */
    public function front_filter(string $handle, callable $method, int $priority = 10, int $args = 1) : void
    {
        $this->front->push(array('type' => 'filter', 'handle' => $handle, 'method' => $method, 'priority' => $priority, 'args' => $args, 'registered' => \false));
    }
    /**
     * Adds an action for the global end.
     *
     * @param string     $handle
     * @param callable   $method
     * @param integer    $priority
     * @param integer    $args
     * @return void
     */
    public function action(string $handle, callable $method, int $priority = 10, int $args = 1) : void
    {
        $this->global->push(array('type' => 'action', 'handle' => $handle, 'method' => $method, 'priority' => $priority, 'args' => $args, 'registered' => \false));
    }
    /**
     * Adds an global filter to the global collection.
     *
     * @param string     $handle
     * @param callable   $method
     * @param integer    $priority
     * @param integer    $args
     * @return void
     */
    public function filter(string $handle, callable $method, int $priority = 10, int $args = 1) : void
    {
        $this->global->push(array('type' => 'filter', 'handle' => $handle, 'method' => $method, 'priority' => $priority, 'args' => $args, 'registered' => \false));
    }
    /**
     * Adds a shortcode to the loader.
     *
     * @param string     $handle
     * @param callable   $method
     * @return void
     */
    public function shortcode(string $handle, callable $method) : void
    {
        $this->shortcode->push(array('handle' => $handle, 'method' => $method, 'registered' => \false));
    }
    /**
     * Adds an ajax call
     *
     * @param string $handle
     * @param callable $method
     * @param bool $public
     * @param bool $private
     * @return void
     */
    public function ajax(string $handle, callable $method, bool $public = \true, bool $private = \true) : void
    {
        $this->ajax->push(array('handle' => $handle, 'method' => $method, 'public' => $public, 'private' => $private, 'registered' => \false));
    }
    /**
     * Removes a pre registered action.
     *
     * @param string $handle
     * @param callable $method
     * @param int $priority
     * @return void
     */
    public function remove_action(string $handle, callable $method, int $priority = 10)
    {
        $this->remove->push(array('type' => 'action', 'handle' => $handle, 'method' => $method, 'priority' => $priority, 'args' => \false, 'registered' => \false));
    }
    /**
     * Removes a pre registered filter.
     *
     * @param string $handle
     * @param callable $method
     * @param int $priority
     * @return void
     */
    public function remove_filter(string $handle, callable $method, int $priority = 10)
    {
        $this->remove->push(array('type' => 'filter', 'handle' => $handle, 'method' => $method, 'priority' => $priority, 'args' => \false, 'registered' => \false));
    }
    /**
     * Removes a pre registered filter or action.
     *
     * @param string $handle
     * @param callable $method
     * @param int $priority
     * @return void
     */
    public function remove(string $handle, callable $method, int $priority = 10)
    {
        $this->remove->push(array('type' => \false, 'handle' => $handle, 'method' => $method, 'priority' => $priority, 'args' => \false, 'registered' => \false));
    }
    /**
     * Registers all the added hooks.
     *
     * @return void
     */
    public function register_hooks() : void
    {
        // Remove all requested hooks.
        $this->remove->register(function ($hook) {
            if (\is_array($hook)) {
                $this->remove_hook_callback($hook);
            }
        });
        // Register shortcodes.
        $this->shortcode->register(function ($shortcode) {
            if (\is_array($shortcode)) {
                \add_shortcode($shortcode['handle'], $shortcode['method']);
            }
        });
        // Register Ajax Calls.
        $this->ajax->register(function ($ajax) {
            if (\is_array($ajax)) {
                // If public (none logged in users)
                if ($ajax['public']) {
                    $this->global->push(array('type' => 'action', 'handle' => 'wp_ajax_nopriv_' . $ajax['handle'], 'method' => $ajax['method'], 'priority' => 10, 'args' => 1));
                }
                // If private (logged in users only)
                if ($ajax['private']) {
                    $this->global->push(array('type' => 'action', 'handle' => 'wp_ajax_' . $ajax['handle'], 'method' => $ajax['method'], 'priority' => 10, 'args' => 1));
                }
            }
        });
        /**
         * Register all globals hooks.
         */
        $this->global->register(function ($hook) {
            if (\is_array($hook)) {
                $this->register_hook_callback($hook);
            }
        });
        /**
         * Register all admin only hooks.
         */
        if (\is_admin()) {
            $this->admin->register(function ($hook) {
                if (\is_array($hook)) {
                    $this->register_hook_callback($hook);
                }
            });
        }
        /**
         * Register all admin only hooks.
         */
        if (!\is_admin()) {
            $this->front->register(function ($hook) {
                if (\is_array($hook)) {
                    $this->register_hook_callback($hook);
                }
            });
        }
    }
    /**
     * Registers both hooks and filters.
     *
     * @param array<string, mixed> $hook
     * @return void
     */
    private function register_hook_callback(array $hook) : void
    {
        switch ($hook['type']) {
            case 'action':
                \add_action($hook['handle'], $hook['method'], $hook['priority'], $hook['args']);
                break;
            case 'filter':
                \add_filter($hook['handle'], $hook['method'], $hook['priority'], $hook['args']);
                break;
        }
    }
    /**
     * Remove hook if set.
     *
     * @since 0.3.5
     * @param array<string, mixed> $hook
     * @return void
     */
    private function remove_hook_callback(array $hook) : void
    {
        (new \PC_Headless_Blog_1AA\PinkCrab\Loader\Hook_Removal($hook['handle'], $hook['method'], $hook['priority']))->remove();
    }
}
