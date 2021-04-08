<?php

namespace PC_Headless_Blog_1AA\Http\Message;

/**
 * Factory for PSR-7 Request and Response.
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
interface MessageFactory extends \PC_Headless_Blog_1AA\Http\Message\RequestFactory, \PC_Headless_Blog_1AA\Http\Message\ResponseFactory
{
}
