<?php

/**
 * @author Tomáš Chochola <chocholatom1997@gmail.com>
 * @copyright © 2024–Present Tomáš Chochola <chocholatom1997@gmail.com>. All rights reserved.
 *
 * @license
 *
 * This software is proprietary and licensed under specific terms set by its owner.
 * Any form of access, use, or distribution requires a valid and active license.
 * For full licensing terms, refer to the LICENSE.md file accompanying this software.
 *
 * @see {@link https://premierstacks.com} Website
 * @see {@link https://github.com/tomchochola} GitHub Personal
 * @see {@link https://github.com/premierstacks} GitHub Organization
 * @see {@link https://github.com/sponsors/tomchochola} GitHub Sponsors
 */

declare(strict_types=1);

namespace Tests\Unit\Http;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Small;
use PHPUnit\Framework\Attributes\Test;
use Premierstacks\PhpStack\Http\Request;
use Premierstacks\PhpStack\Http\Uri;
use Tests\Unit\TestCase;

/**
 * @internal
 */
#[Small]
#[CoversClass(Request::class)]
class RequestTest extends TestCase
{
    #[Test]
    public function testGetMethod(): void
    {
        static::assertSame('GET', $this->request()->getMethod());
    }

    #[Test]
    public function testGetRequestTarget(): void
    {
        static::assertSame('/path?query=query', $this->request()->getRequestTarget());
    }

    #[Test]
    public function testGetUri(): void
    {
        $uri = $this->request()->getUri();

        static::assertInstanceOf(Uri::class, $uri);
        static::assertSame('https://user:password@localhost:80/path?query=query#fragment', $uri->__toString());
    }

    #[Test]
    public function testWithMethod(): void
    {
        $request = $this->request();

        $with = $request->withMethod('POST');

        static::assertInstanceOf(Request::class, $with);
        static::assertNotSame($request, $with);
        static::assertNotSame($request->getMethod(), $with->getMethod());
        static::assertSame('GET', $request->getMethod());
        static::assertSame('POST', $with->getMethod());
    }

    #[Test]
    public function testWithRequestTarget(): void
    {
        $request = $this->request();

        $with = $request->withRequestTarget('/target');

        static::assertInstanceOf(Request::class, $with);
        static::assertNotSame($request, $with);
        static::assertNotSame($request->getRequestTarget(), $with->getRequestTarget());
        static::assertSame('/path?query=query', $request->getRequestTarget());
        static::assertSame('/target', $with->getRequestTarget());
    }

    #[Test]
    public function testWithUri(): void
    {
        $request = $this->request();

        $with = $request->withUri($this->uri(port: 8_000));

        static::assertInstanceOf(Request::class, $with);
        static::assertNotSame($request, $with);
        static::assertNotSame($request->getUri(), $with->getUri());
        static::assertSame('https://user:password@localhost:80/path?query=query#fragment', $request->getUri()->__toString());
        static::assertSame('https://user:password@localhost:8000/path?query=query#fragment', $with->getUri()->__toString());
    }
}
