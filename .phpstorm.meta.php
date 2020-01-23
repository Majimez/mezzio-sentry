<?php
/**
 * Copyright (c) 2020 Martin Meredith
 *
 * Permission is hereby granted, free of charge, to any person obtaining
 * a copy of this software and associated documentation files (the
 * "Software"), to deal in the Software without restriction, including
 * without limitation the rights to use, copy, modify, merge, publish,
 * distribute, sublicense, and/or sell copies of the Software, and to
 * permit persons to whom the Software is furnished to do so, subject to
 * the following conditions:
 *
 * The above copyright notice and this permission notice shall be
 * included in all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
 * EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF
 * MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND
 * NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE
 * LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION
 * OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION
 * WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 */

namespace PHPSTORM_META
{

    use Interop\Container\ContainerInterface as InteropContainerInterface;
    use Psr\Container\ContainerInterface as PsrContainerInterface;
    use Psr\Http\Message\ServerRequestInterface;

    // Old Interop\Container\ContainerInterface
    override(
        InteropContainerInterface::get(0),
        map(
            [
                '' => '@',
            ]
        )
    );

    // PSR-11 Container Interface
    override(
        PsrContainerInterface::get(0),
        map(
            [
                '' => '@',
            ]
        )
    );

    // PSR-7 requests attributes; e.g. PSR-7 Storage-less HTTP Session
    override(
        ServerRequestInterface::getAttribute(0),
        map(
            [
                SessionMiddleware::SESSION_ATTRIBUTE
                instanceof
                SessionInterface,
            ]
        )
    );
}
