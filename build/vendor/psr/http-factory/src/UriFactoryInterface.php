<?php

namespace PC_Headless_Blog_1AA\Psr\Http\Message;

interface UriFactoryInterface
{
    /**
     * Create a new URI.
     *
     * @param string $uri
     *
     * @return UriInterface
     *
     * @throws \InvalidArgumentException If the given URI cannot be parsed.
     */
    public function createUri(string $uri = '') : \PC_Headless_Blog_1AA\Psr\Http\Message\UriInterface;
}
