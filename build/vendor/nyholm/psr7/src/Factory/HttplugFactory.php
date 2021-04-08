<?php

declare (strict_types=1);
namespace PC_Headless_Blog_1AA\Nyholm\Psr7\Factory;

use PC_Headless_Blog_1AA\Http\Message\MessageFactory;
use PC_Headless_Blog_1AA\Http\Message\StreamFactory;
use PC_Headless_Blog_1AA\Http\Message\UriFactory;
use PC_Headless_Blog_1AA\Nyholm\Psr7\Request;
use PC_Headless_Blog_1AA\Nyholm\Psr7\Response;
use PC_Headless_Blog_1AA\Nyholm\Psr7\Stream;
use PC_Headless_Blog_1AA\Nyholm\Psr7\Uri;
use PC_Headless_Blog_1AA\Psr\Http\Message\UriInterface;
/**
 * @author Tobias Nyholm <tobias.nyholm@gmail.com>
 * @author Martijn van der Ven <martijn@vanderven.se>
 *
 * @final This class should never be extended. See https://github.com/Nyholm/psr7/blob/master/doc/final.md
 */
class HttplugFactory implements \PC_Headless_Blog_1AA\Http\Message\MessageFactory, \PC_Headless_Blog_1AA\Http\Message\StreamFactory, \PC_Headless_Blog_1AA\Http\Message\UriFactory
{
    public function createRequest($method, $uri, array $headers = [], $body = null, $protocolVersion = '1.1')
    {
        return new \PC_Headless_Blog_1AA\Nyholm\Psr7\Request($method, $uri, $headers, $body, $protocolVersion);
    }
    public function createResponse($statusCode = 200, $reasonPhrase = null, array $headers = [], $body = null, $version = '1.1')
    {
        return new \PC_Headless_Blog_1AA\Nyholm\Psr7\Response((int) $statusCode, $headers, $body, $version, $reasonPhrase);
    }
    public function createStream($body = null)
    {
        return \PC_Headless_Blog_1AA\Nyholm\Psr7\Stream::create($body ?? '');
    }
    public function createUri($uri = '') : \PC_Headless_Blog_1AA\Psr\Http\Message\UriInterface
    {
        if ($uri instanceof \PC_Headless_Blog_1AA\Psr\Http\Message\UriInterface) {
            return $uri;
        }
        return new \PC_Headless_Blog_1AA\Nyholm\Psr7\Uri($uri);
    }
}
