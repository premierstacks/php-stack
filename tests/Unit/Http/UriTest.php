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
 * 🤵 The Proprietor: Tomáš Chochola
 * - Role: The Creator, Proprietor & Project Visionary
 * - Email: chocholatom1997@gmail.com
 * - GitHub: https://github.com/tomchochola
 * - Sponsor & License: https://github.com/sponsors/tomchochola
 * - Web: https://premierstacks.com
 */

declare(strict_types=1);

namespace Tests\Unit\Http;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Small;
use PHPUnit\Framework\Attributes\Test;
use Premierstacks\PhpStack\Http\Uri;
use Tests\Unit\TestCase;

/**
 * @internal
 */
#[Small]
#[CoversClass(Uri::class)]
class UriTest extends TestCase
{
    #[Test]
    public function testGetAuthority(): void
    {
        static::assertSame('user:password@localhost:80', $this->uri()->getAuthority());
    }

    #[Test]
    public function testGetFragment(): void
    {
        static::assertSame('fragment', $this->uri()->getFragment());
    }

    #[Test]
    public function testGetHost(): void
    {
        static::assertSame('localhost', $this->uri()->getHost());
    }

    #[Test]
    public function testGetPath(): void
    {
        static::assertSame('/path', $this->uri()->getPath());
    }

    #[Test]
    public function testGetPort(): void
    {
        static::assertSame(80, $this->uri()->getPort());
    }

    #[Test]
    public function testGetQuery(): void
    {
        static::assertSame('query=query', $this->uri()->getQuery());
    }

    #[Test]
    public function testGetScheme(): void
    {
        static::assertSame('https', $this->uri()->getScheme());
    }

    #[Test]
    public function testGetUserInfo(): void
    {
        static::assertSame('user:password', $this->uri()->getUserInfo());
    }

    #[Test]
    public function testToString(): void
    {
        static::assertSame('https://user:password@localhost:80/path?query=query#fragment', $this->uri()->__toString());
    }

    #[Test]
    public function testWithFragment(): void
    {
        $uri = $this->uri();

        $with = $uri->withFragment('with');

        static::assertInstanceOf(Uri::class, $with);
        static::assertNotSame($uri, $with);
        static::assertNotSame($uri->getFragment(), $with->getFragment());
        static::assertSame('fragment', $uri->getFragment());
        static::assertSame('with', $with->getFragment());
    }

    #[Test]
    public function testWithHost(): void
    {
        $uri = $this->uri();

        $with = $uri->withHost('0.0.0.0');

        static::assertInstanceOf(Uri::class, $with);
        static::assertNotSame($uri, $with);
        static::assertNotSame($uri->getHost(), $with->getHost());
        static::assertSame('localhost', $uri->getHost());
        static::assertSame('0.0.0.0', $with->getHost());
    }

    #[Test]
    public function testWithPath(): void
    {
        $uri = $this->uri();

        $with = $uri->withPath('/anything');

        static::assertInstanceOf(Uri::class, $with);
        static::assertNotSame($uri, $with);
        static::assertNotSame($uri->getPath(), $with->getPath());
        static::assertSame('/path', $uri->getPath());
        static::assertSame('/anything', $with->getPath());
    }

    #[Test]
    public function testWithPort(): void
    {
        $uri = $this->uri();

        $with = $uri->withPort(8_000);

        static::assertInstanceOf(Uri::class, $with);
        static::assertNotSame($uri, $with);
        static::assertNotSame($uri->getPort(), $with->getPort());
        static::assertSame(80, $uri->getPort());
        static::assertSame(8_000, $with->getPort());
    }

    #[Test]
    public function testWithQuery(): void
    {
        $uri = $this->uri();

        $with = $uri->withQuery('with=with');

        static::assertInstanceOf(Uri::class, $with);
        static::assertNotSame($uri, $with);
        static::assertNotSame($uri->getQuery(), $with->getQuery());
        static::assertSame('query=query', $uri->getQuery());
        static::assertSame('with=with', $with->getQuery());
    }

    #[Test]
    public function testWithScheme(): void
    {
        $uri = $this->uri();

        $with = $uri->withScheme('http');

        static::assertInstanceOf(Uri::class, $with);
        static::assertNotSame($uri, $with);
        static::assertNotSame($uri->getScheme(), $with->getScheme());
        static::assertSame('https', $uri->getScheme());
        static::assertSame('http', $with->getScheme());
    }

    #[Test]
    public function testWithUserInfo(): void
    {
        $uri = $this->uri();

        $with = $uri->withUserInfo('username', 'pass');

        static::assertInstanceOf(Uri::class, $with);
        static::assertNotSame($uri, $with);
        static::assertNotSame($uri->getUserInfo(), $with->getUserInfo());
        static::assertSame('user:password', $uri->getUserInfo());
        static::assertSame('username:pass', $with->getUserInfo());
    }
}
