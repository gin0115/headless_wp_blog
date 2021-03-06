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
 * @since 0.1.0
 * @author Glynn Quelch <glynn.quelch@gmail.com>
 * @license http://www.opensource.org/licenses/mit-license.html  MIT License
 * @package PinkCrab\Loader
 */
namespace PC_Headless_Blog_1AA\PinkCrab\Loader;

use Countable;
class Hook_Collection implements \Countable
{
    /**
     * Holds the hooks.
     *
     * @var array<int, array>
     */
    protected $hooks = array();
    /**
     * Pushes an item to the collection.
     *
     * @param array<string, mixed> $data
     * @return self
     */
    public function push(array $data) : self
    {
        $this->hooks[] = $data;
        return $this;
    }
    /**
     * Applies a function to all items in the collection.
     *
     * @param callable(array<string, mixed>):void $function
     * @return void
     */
    public function register(callable $function) : void
    {
        foreach ($this->hooks as $key => $hook) {
            $function($hook);
            $this->hooks[$key]['registered'] = \true;
        }
    }
    /**
     * Get count of hooks registered.
     *
     * @return int
     */
    public function count() : int
    {
        return \count($this->hooks);
    }
    /**
     * Pop the last hook registered.
     *
     * @return mixed
     */
    public function pop()
    {
        if ($this->count() !== 0) {
            return \array_pop($this->hooks);
        }
        return \false;
    }
}
