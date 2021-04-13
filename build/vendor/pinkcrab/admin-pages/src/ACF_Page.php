<?php

declare (strict_types=1);
/**
 * Registers ACF option pages.
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
 *
 * @docs https://www.advancedcustomfields.com/resources/acf_add_options_page/
 */
namespace PC_Headless_Blog_1AA\PinkCrab\Admin_Pages;

use PC_Headless_Blog_1AA\PinkCrab\Admin_Pages\Page;
use PC_Headless_Blog_1AA\PinkCrab\Core\Interfaces\Renderable;
class ACF_Page extends \PC_Headless_Blog_1AA\PinkCrab\Admin_Pages\Page
{
    /**
     * Should this page just be a title holder?
     * If set to true, will redirect to first child page if set.
     *
     * @var bool
     */
    public $redirect = \false;
    /**
     * Denotes which page should be selected to save and load values from.
     *
     * @var int|string
     */
    public $post_id = 'options';
    /**
     * Should all defined options be autoloaded
     *
     * @var bool
     */
    public $autoload = \false;
    /**
     * The message shown when a page is updated.
     *
     * @var string
     */
    public $updated_message = 'Options Updated';
    /**
     * The update button text
     *
     * @var string
     */
    public $update_button = 'Update';
    /**
     * Set the value of view_template
     *
     * This has been removed for ACF pages, as nothing to render.
     * @codeCoverageIgnore
     * @return  self
     */
    public function view_template(string $view_template) : \PC_Headless_Blog_1AA\PinkCrab\Admin_Pages\Page
    {
        // phpcs:disable PSR1.Classes.ClassDeclaration.MissingNamespace
        return $this;
    }
    /**
     * Set the value of view_data
     *
     * This has been removed for ACF pages, as nothing to render.
     * @codeCoverageIgnore
     * @param array<string, mixed> $view_data
     * @return  self
     */
    public function view_data($view_data) : \PC_Headless_Blog_1AA\PinkCrab\Admin_Pages\Page
    {
        return $this;
    }
    /**
     * Renders the passed view and data using the current view engine.
     *
     * This has been removed for ACF pages, as nothing to render.
     *
     * @param Renderable $view
     * @return callable
     */
    public function compose_view(\PC_Headless_Blog_1AA\PinkCrab\Core\Interfaces\Renderable $view) : callable
    {
        return function () {
        };
    }
    /**
     * Set the message shown when a page is updated.
     *
     * @param string $updated_message  The message shown when a page is updated.
     * @return self
     */
    public function updated_message(string $updated_message) : self
    {
        $this->updated_message = $updated_message;
        return $this;
    }
    /**
     * Set the update button text
     *
     * @param string $update_button  The update button text
     *
     * @return self
     */
    public function update_button(string $update_button) : self
    {
        $this->update_button = $update_button;
        return $this;
    }
}
