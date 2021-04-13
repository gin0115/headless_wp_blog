<?php

declare (strict_types=1);
/**
 * Tests registering ajax with scripts.
 *
 * @since 0.2.0
 * @author Glynn Quelch <glynn.quelch@gmail.com>
 * @license http://www.opensource.org/licenses/mit-license.html  MIT License
 * @package PinkCrab\Registerables
 */
namespace PC_Headless_Blog_1AA\PinkCrab\Registerables\Tests\Fixtures\Ajax;

use PC_Headless_Blog_1AA\PinkCrab\Enqueue\Enqueue;
use PC_Headless_Blog_1AA\PinkCrab\Registerables\Ajax;
use PC_Headless_Blog_1AA\Psr\Http\Message\ResponseInterface;
use PC_Headless_Blog_1AA\Psr\Http\Message\ServerRequestInterface;
class Ajax_With_Scripts extends \PC_Headless_Blog_1AA\PinkCrab\Registerables\Ajax
{
    protected $nonce_handle = 'ajax_with_scripts';
    protected $action = 'ajax_with_scripts';
    public $_conditional_value = \true;
    /**
     * Fires before register, can be used to do last min changes.
     *
     * @return void
     */
    public function set_up() : void
    {
        // Remote JS File.
        $this->scripts->push(\PC_Headless_Blog_1AA\PinkCrab\Enqueue\Enqueue::script('ajax_with_scripts_one')->src('http://www.url.tld/file.js')->deps('jquery')->ver('1.2.3')->footer());
        // Local JS file.
        $this->scripts->push(\PC_Headless_Blog_1AA\PinkCrab\Enqueue\Enqueue::script('ajax_with_scripts_two')->src(__DIR__ . '/file.js')->deps('angular')->ver('0.1.2'));
    }
    /**
     * Should the scripts be loaded.
     *
     * @return boolean
     */
    public function conditional() : bool
    {
        return $this->_conditional_value;
    }
    /**
     * Handles the callback.
     *
     * @param ServerRequestInterface $request
     * @return ServerRequestInterface
     */
    public function callback(\PC_Headless_Blog_1AA\Psr\Http\Message\ResponseInterface $response) : \PC_Headless_Blog_1AA\Psr\Http\Message\ResponseInterface
    {
        // Does nothing here
    }
}
