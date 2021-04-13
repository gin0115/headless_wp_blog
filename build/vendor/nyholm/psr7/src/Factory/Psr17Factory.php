<?php

declare (strict_types=1);
namespace PC_Headless_Blog_1AA\Nyholm\Psr7\Factory;

use PC_Headless_Blog_1AA\Nyholm\Psr7\Request;
use PC_Headless_Blog_1AA\Nyholm\Psr7\Response;
use PC_Headless_Blog_1AA\Nyholm\Psr7\ServerRequest;
use PC_Headless_Blog_1AA\Nyholm\Psr7\Stream;
use PC_Headless_Blog_1AA\Nyholm\Psr7\UploadedFile;
use PC_Headless_Blog_1AA\Nyholm\Psr7\Uri;
use PC_Headless_Blog_1AA\Psr\Http\Message\RequestFactoryInterface;
use PC_Headless_Blog_1AA\Psr\Http\Message\RequestInterface;
use PC_Headless_Blog_1AA\Psr\Http\Message\ResponseFactoryInterface;
use PC_Headless_Blog_1AA\Psr\Http\Message\ResponseInterface;
use PC_Headless_Blog_1AA\Psr\Http\Message\ServerRequestFactoryInterface;
use PC_Headless_Blog_1AA\Psr\Http\Message\ServerRequestInterface;
use PC_Headless_Blog_1AA\Psr\Http\Message\StreamFactoryInterface;
use PC_Headless_Blog_1AA\Psr\Http\Message\StreamInterface;
use PC_Headless_Blog_1AA\Psr\Http\Message\UploadedFileFactoryInterface;
use PC_Headless_Blog_1AA\Psr\Http\Message\UploadedFileInterface;
use PC_Headless_Blog_1AA\Psr\Http\Message\UriFactoryInterface;
use PC_Headless_Blog_1AA\Psr\Http\Message\UriInterface;
/**
 * @author Tobias Nyholm <tobias.nyholm@gmail.com>
 * @author Martijn van der Ven <martijn@vanderven.se>
 *
 * @final This class should never be extended. See https://github.com/Nyholm/psr7/blob/master/doc/final.md
 */
class Psr17Factory implements \PC_Headless_Blog_1AA\Psr\Http\Message\RequestFactoryInterface, \PC_Headless_Blog_1AA\Psr\Http\Message\ResponseFactoryInterface, \PC_Headless_Blog_1AA\Psr\Http\Message\ServerRequestFactoryInterface, \PC_Headless_Blog_1AA\Psr\Http\Message\StreamFactoryInterface, \PC_Headless_Blog_1AA\Psr\Http\Message\UploadedFileFactoryInterface, \PC_Headless_Blog_1AA\Psr\Http\Message\UriFactoryInterface
{
    public function createRequest(string $method, $uri) : \PC_Headless_Blog_1AA\Psr\Http\Message\RequestInterface
    {
        return new \PC_Headless_Blog_1AA\Nyholm\Psr7\Request($method, $uri);
    }
    public function createResponse(int $code = 200, string $reasonPhrase = '') : \PC_Headless_Blog_1AA\Psr\Http\Message\ResponseInterface
    {
        if (2 > \func_num_args()) {
            // This will make the Response class to use a custom reasonPhrase
            $reasonPhrase = null;
        }
        return new \PC_Headless_Blog_1AA\Nyholm\Psr7\Response($code, [], null, '1.1', $reasonPhrase);
    }
    public function createStream(string $content = '') : \PC_Headless_Blog_1AA\Psr\Http\Message\StreamInterface
    {
        return \PC_Headless_Blog_1AA\Nyholm\Psr7\Stream::create($content);
    }
    public function createStreamFromFile(string $filename, string $mode = 'r') : \PC_Headless_Blog_1AA\Psr\Http\Message\StreamInterface
    {
        $resource = @\fopen($filename, $mode);
        if (\false === $resource) {
            if ('' === $mode || \false === \in_array($mode[0], ['r', 'w', 'a', 'x', 'c'])) {
                throw new \InvalidArgumentException('The mode ' . $mode . ' is invalid.');
            }
            throw new \RuntimeException('The file ' . $filename . ' cannot be opened.');
        }
        return \PC_Headless_Blog_1AA\Nyholm\Psr7\Stream::create($resource);
    }
    public function createStreamFromResource($resource) : \PC_Headless_Blog_1AA\Psr\Http\Message\StreamInterface
    {
        return \PC_Headless_Blog_1AA\Nyholm\Psr7\Stream::create($resource);
    }
    public function createUploadedFile(\PC_Headless_Blog_1AA\Psr\Http\Message\StreamInterface $stream, int $size = null, int $error = \UPLOAD_ERR_OK, string $clientFilename = null, string $clientMediaType = null) : \PC_Headless_Blog_1AA\Psr\Http\Message\UploadedFileInterface
    {
        if (null === $size) {
            $size = $stream->getSize();
        }
        return new \PC_Headless_Blog_1AA\Nyholm\Psr7\UploadedFile($stream, $size, $error, $clientFilename, $clientMediaType);
    }
    public function createUri(string $uri = '') : \PC_Headless_Blog_1AA\Psr\Http\Message\UriInterface
    {
        return new \PC_Headless_Blog_1AA\Nyholm\Psr7\Uri($uri);
    }
    public function createServerRequest(string $method, $uri, array $serverParams = []) : \PC_Headless_Blog_1AA\Psr\Http\Message\ServerRequestInterface
    {
        return new \PC_Headless_Blog_1AA\Nyholm\Psr7\ServerRequest($method, $uri, [], null, '1.1', $serverParams);
    }
}
