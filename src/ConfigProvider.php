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

declare(strict_types=1);

namespace Mez\Sentry;

use Laminas\ServiceManager\AbstractFactory\ReflectionBasedAbstractFactory;
use Laminas\Stratigility\Middleware\ErrorHandler;
use Mez\Sentry\Listener\Delegator;
use Mez\Sentry\Listener\Listener;
use Mez\Sentry\Service\ClientFactory;
use Mez\Sentry\Service\HubFactory;
use Sentry\Client;
use Sentry\ClientInterface;
use Sentry\State\Hub;
use Sentry\State\HubInterface;

/**
 * Class ConfigProvider
 *
 * @package Mez\Sentry
 */
final class ConfigProvider
{
    /**
     * __invoke
     *
     * @return array<string, array<string, array<string, string>|array<string, array<string>>>>
     */
    public function __invoke(): array
    {
        return ['dependencies' => $this->getDependencies()];
    }

    /**
     * getDependencies
     *
     * @return array<string, array<string, string>|array<string, array<string>>>
     */
    private function getDependencies(): array
    {
        return [
            'aliases' => [
                Client::class => ClientInterface::class,
                Hub::class => HubInterface::class,

            ],
            'factories' => [
                ClientInterface::class => ClientFactory::class,
                HubInterface::class => HubFactory::class,
                Listener::class => ReflectionBasedAbstractFactory::class,
            ],
            'delegators' => [
                ErrorHandler::class => [
                    Delegator::class,
                ],
            ],
        ];
    }
}
