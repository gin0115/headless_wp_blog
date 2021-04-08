<?php

declare (strict_types=1);
/**
 * Basic Ajax Call using Get with none json headers
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
use PC_Headless_Blog_1AA\Psr\Http\Message\ServerRequestInterface;
class Ajax_Post_Simple extends \PC_Headless_Blog_1AA\PinkCrab\Registerables\Ajax
{
    protected $nonce_handle = 'ajax_post_simple';
    protected $action = 'ajax_post_simple';
    /**
     * Handles the callback.
     *
     * @param ServerRequestInterface $request
     * @return void
     */
    public function callback(\PC_Headless_Blog_1AA\Psr\Http\Message\ResponseInterface $response) : \PC_Headless_Blog_1AA\Psr\Http\Message\ResponseInterface
    {
        return $response->withBody(\PC_Headless_Blog_1AA\PinkCrab\HTTP\HTTP_Helper::stream_from_scalar(array('success' => 'Ajax_Post_Simple')));
        // wp_send_json_success( $response->getParsedBody() );
    }
}
