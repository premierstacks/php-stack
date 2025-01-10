<?php

/**
 * @author Tomáš Chochola <chocholatom1997@gmail.com>
 * @copyright © 2025, Tomáš Chochola <chocholatom1997@gmail.com>. Some rights reserved.
 *
 * @license CC-BY-ND-4.0
 *
 * @see {@link https://creativecommons.org/licenses/by-nd/4.0/} License
 * @see {@link https://github.com/tomchochola} GitHub Personal
 * @see {@link https://github.com/premierstacks} GitHub Organization
 * @see {@link https://github.com/sponsors/tomchochola} GitHub Sponsors
 */

declare(strict_types=1);

namespace Tests\Unit;

use PHPUnit\Framework\TestCase as VendorTestCase;
use Premierstacks\PhpStack\Http\Client;
use Premierstacks\PhpStack\Http\Message;
use Premierstacks\PhpStack\Http\Request;
use Premierstacks\PhpStack\Http\Response;
use Premierstacks\PhpStack\Http\Stream;
use Premierstacks\PhpStack\Http\Uri;
use Premierstacks\PhpStack\IO\ResourceObject;
use Premierstacks\PhpStack\Testing\TestInterface;
use Premierstacks\PhpStack\Testing\TestTrait;
use Premierstacks\PhpStack\Types\Resources;
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
