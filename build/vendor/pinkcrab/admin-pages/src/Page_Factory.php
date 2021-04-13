<?php

declare (strict_types=1);
/**
 * Factory for creating pages and child pages.
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

use PC_Headless_Blog_1AA\PinkCrab\Admin_Pages\Page;
class Page_Factory
{
    /**
     * The parent key used to define child pages.
     *
     * @var string|null
     */
    protected $parent_key = null;
    public function __construct(?string $parent_key = null)
    {
        $this->parent_key = $parent_key;
    }
    /**
     * Returns a child page with the defined parent key.
     *
     * @param string $menu_title
     * @param string $key
     * @return \PinkCrab\Admin_Pages\Page
     */
    public function child_page(string $menu_title, string $key) : \PC_Headless_Blog_1AA\PinkCrab\Admin_Pages\Page
    {
        if ($this->parent_key === null) {
            throw new \Exception('The parent key must be set to create child pages.');
        }
        return \PC_Headless_Blog_1AA\PinkCrab\Admin_Pages\Page::create_page($key, $menu_title, $this->parent_key);
    }
    /**
     * Returns a page.
     *
     * @param string $menu_title
     * @param string $key
     * @return \PinkCrab\Admin_Pages\Page
     */
    public function page(string $menu_title, string $key) : \PC_Headless_Blog_1AA\PinkCrab\Admin_Pages\Page
    {
        return \PC_Headless_Blog_1AA\PinkCrab\Admin_Pages\Page::create_page($key, $menu_title, $key);
    }
}
