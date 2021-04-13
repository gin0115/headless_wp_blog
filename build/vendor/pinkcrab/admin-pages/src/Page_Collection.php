<?php

declare (strict_types=1);
/**
 * A colletion of child pages.
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

use Closure;
use PC_Headless_Blog_1AA\PinkCrab\Admin_Pages\Page;
use PC_Headless_Blog_1AA\PinkCrab\Admin_Pages\ACF_Page;
use PC_Headless_Blog_1AA\PinkCrab\Admin_Pages\Page_Factory;
use PC_Headless_Blog_1AA\PinkCrab\Core\Collection\Collection;
class Page_Collection
{
    /**
     * Holds the sub pages.
     *
     * @var Collection
     */
    protected $pages;
    /**
     * Key of parent page
     *
     * @var string
     */
    protected $parent_key;
    /**
     * The page Factory
     *
     * @var Page_Factory
     */
    protected $page_factory;
    public function __construct(string $parent_key)
    {
        $this->parent_key = $parent_key;
        $this->pages = new \PC_Headless_Blog_1AA\PinkCrab\Core\Collection\Collection();
        $this->page_factory = new \PC_Headless_Blog_1AA\PinkCrab\Admin_Pages\Page_Factory($parent_key);
    }
    /**
     * Checks if the collection is emtpy.
     *
     * @return bool
     */
    public function is_empty() : bool
    {
        return $this->pages->is_empty();
    }
    /**
     * Adds a new child page by giving access to the page factory.
     *
     * @param Closure(Page_Factory): Page $create
     * @return self
     */
    public function add_child_page(\Closure $create) : self
    {
        $this->add($create($this->page_factory));
        return $this;
    }
    /**
     * Used to add a page
     *
     * @param Page $page
     * @return self
     */
    public function add(\PC_Headless_Blog_1AA\PinkCrab\Admin_Pages\Page $page) : self
    {
        $this->pages->push($page);
        return $this;
    }
    /**
     * Uses a passed callable to register the child page.s
     *
     * @param callable(Page): void $function
     * @return void
     */
    public function register_child_pages(callable $function) : void
    {
        $this->pages->each(function (\PC_Headless_Blog_1AA\PinkCrab\Admin_Pages\Page $page, $key) use($function) : void {
            // phpcs:disable Generic.CodeAnalysis.UnusedFunctionParameter.FoundAfterLastUsed
            $function($page);
        });
    }
}
