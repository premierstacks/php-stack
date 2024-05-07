<?php

/**
 * Copyright © 2024+ Tomáš Chochola <chocholatom1997@gmail.com> - All Rights Reserved
 *
 * This software is the exclusive property of Tomáš Chochola, protected by copyright laws.
 * Although the source code may be accessible, it is not free for use without a valid license.
 * A valid license, obtainable through proper channels, is required for any software use.
 * For licensing or inquiries, please contact Tomáš Chochola or refer to the GitHub Sponsors page.
 *
 * The full license terms are detailed in the LICENSE.md file within the source code repository.
 * The terms are subject to changes. Users are encouraged to review them periodically.
 *
 * Tomáš Chochola: The Creator, Proprietor & Project Visionary
 * - Email: chocholatom1997@gmail.com
 * - GitHub: https://github.com/tomchochola
 * - Sponsor & License: https://github.com/sponsors/tomchochola
 *
 * Premierstacks: The Organization
 * - GitHub: https://github.com/premierstacks
 */

declare(strict_types=1);

namespace Tests\Unit;

use PHPUnit\Framework\TestCase as VendorTestCase;
use Premierstacks\PhpUtil\Http\Client;
use Premierstacks\PhpUtil\Http\Message;
use Premierstacks\PhpUtil\Http\Request;
use Premierstacks\PhpUtil\Http\Response;
use Premierstacks\PhpUtil\Http\Stream;
use Premierstacks\PhpUtil\Http\Uri;
use Premierstacks\PhpUtil\IO\ResourceObject;
use Premierstacks\PhpUtil\Testing\TestInterface;
use Premierstacks\PhpUtil\Testing\TestTrait;
use Premierstacks\PhpUtil\Types\Resources;
use Symfony\Component\HttpFoundation\HeaderBag;

/**
 * @internal
 */
abstract class TestCase extends VendorTestCase implements TestInterface
{
    use TestTrait;

    protected function client(): Client
    {
        return new Client();
    }

    protected function message(): Message
    {
        return new Message($this->stream(), '1.1', new HeaderBag(['accept' => ['text/plain']]));
    }

    protected function request(): Request
    {
        return new Request($this->stream(), '1.1', 'GET', $this->uri(), new HeaderBag(['accept' => ['text/plain']]), '');
    }

    /**
     * @return resource
     */
    protected function resource(string $content = 'test'): mixed
    {
        $resource = new ResourceObject(Resources::memory());

        $resource->write($content);
        $resource->rewind();

        return $resource->detach();
    }

    protected function response(): Response
    {
        return new Response(200, 'OK', $this->stream(), '1.1', new HeaderBag(['accept' => ['text/plain']]));
    }

    protected function stream(string $content = 'test'): Stream
    {
        return new Stream($this->resource($content));
    }

    protected function tempfile(string $content = 'test'): string
    {
        $tempfile = \tempnam(\sys_get_temp_dir(), 'php');

        static::assertIsString($tempfile);

        static::assertSame(\mb_strlen($content, '8bit'), \file_put_contents($tempfile, $content));

        return $tempfile;
    }

    protected function uri(string $scheme = 'https', string $user = 'user', string|null $password = 'password', string $host = 'localhost', int|null $port = 80, string $path = '/path', string $query = 'query=query', string $fragment = 'fragment'): Uri
    {
        return new Uri($scheme, $user, $password, $host, $port, $path, $query, $fragment);
    }
}
