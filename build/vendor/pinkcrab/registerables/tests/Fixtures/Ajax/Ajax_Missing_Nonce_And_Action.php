<?php

declare (strict_types=1);
/**
 * Ajax call with missing nonce and action
 *
 * @since 0.2.0
 * @author Glynn Quelch <glynn.quelch@gmail.com>
 * @license http://www.opensource.org/licenses/mit-license.html  MIT License
 * @package PinkCrab\Registerables
 */
namespace PC_Headless_Blog_1AA\PinkCrab\Registerables\Tests\Fixtures\Ajax;

use PC_Headless_Blog_1AA\PinkCrab\HTTP\HTTP_Helper;
use PC_Headless_Blog_1AA\PinkCrab\Registerables\Ajax;
use PC_Headless_Blog_1AA\Psr\Http\Message\ResponseInterface;
class Ajax_Missing_Nonce_And_Action extends \PC_Headless_Blog_1AA\PinkCrab\Registerables\Ajax
{
    protected $nonce_handle = null;
    protected $action = null;
    /**
     * @param ResponseInterface $response New response instance
     * @return ResponseInterface
     */
    public function callback(\PC_Headless_Blog_1AA\Psr\Http\Message\ResponseInterface $response) : \PC_Headless_Blog_1AA\Psr\Http\Message\ResponseInterface
    {
        //NO OP
    }
}
