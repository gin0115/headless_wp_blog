<?php

declare (strict_types=1);
/**
 * Basic Ajax Call using GET
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
class Ajax_Get extends \PC_Headless_Blog_1AA\PinkCrab\Registerables\Ajax
{
    protected $nonce_handle = 'basic_ajax_get';
    protected $action = 'basic_ajax_get';
    /**
     * @param ResponseInterface $response New response instance
     * @return ResponseInterface
     */
    public function callback(\PC_Headless_Blog_1AA\Psr\Http\Message\ResponseInterface $response) : \PC_Headless_Blog_1AA\Psr\Http\Message\ResponseInterface
    {
        $response_array = array('result' => $this->request->getQueryParams()['ajax_get_data']);
        return $response->withBody(\PC_Headless_Blog_1AA\PinkCrab\HTTP\HTTP_Helper::stream_from_scalar($response_array));
    }
}
