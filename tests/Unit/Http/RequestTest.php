<?php

/**
 * @author Tomáš Chochola <chocholatom1997@gmail.com>
 * @copyright Copyright © 2024+ Tomáš Chochola <chocholatom1997@gmail.com> - All Rights Reserved
 *
 * @license
 *
 * This software is the exclusive property of Tomáš Chochola, protected by copyright laws.
 * Although the source code may be accessible, it is not free for use without a valid license.
 * A valid license, obtainable through proper channels, is required for any software use.
 * For licensing or inquiries, please contact Tomáš Chochola or refer to the GitHub Sponsors page.
 *
 * The full license terms are detailed in the LICENSE.md file within the source code repository.
 * The terms are subject to changes. Users are encouraged to review them periodically.
 *
 * @see {@link https://github.com/tomchochola} Personal GitHub
 * @see {@link https://github.com/premierstacks} Premierstacks GitHub
 * @see {@link https://github.com/sponsors/tomchochola} Sponsor & License
 * @see {@link https://premierstacks.com} Premierstacks website
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
