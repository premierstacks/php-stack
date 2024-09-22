<?php

/**
 * @author Tomáš Chochola <chocholatom1997@gmail.com>
 * @copyright Copyright © 2024+ Tomáš Chochola <chocholatom1997@gmail.com> - All Rights Reserved
 *
 * @license
 *
 * This software is proprietary property of Tomáš Chochola and protected by copyright laws.
 * A valid license is required for any use or manipulation of the software or source code.
 * The full license terms are detailed in the LICENSE.md file within the source code repository.
 *
 * @see {@link https://github.com/tomchochola} Personal GitHub
 * @see {@link https://premierstacks.com} Premierstacks website
 * @see {@link https://github.com/premierstacks} Premierstacks GitHub
 * @see {@link https://github.com/sponsors/tomchochola} GitHub Sponsors
 */

declare(strict_types=1);

namespace Tests\Unit\Http;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Small;
use PHPUnit\Framework\Attributes\Test;
use Premierstacks\PhpStack\Http\Message;
use Premierstacks\PhpStack\Http\Stream;
use Tests\Unit\TestCase;

/**
 * @internal
 */
#[Small]
#[CoversClass(Message::class)]
class MessageTest extends TestCase
{
    #[Test]
    public function testGetBody(): void
    {
        $body = $this->message()->getBody();

        static::assertInstanceOf(Stream::class, $body);
        static::assertSame('test', $body->__toString());
    }

    #[Test]
    public function testGetHeader(): void
    {
        static::assertSame(['text/plain'], $this->message()->getHeader('accept'));
    }

    #[Test]
    public function testGetHeaderLine(): void
    {
        static::assertSame('text/plain', $this->message()->getHeaderLine('accept'));
    }

    #[Test]
    public function testGetHeaders(): void
    {
        static::assertSame(['accept' => ['text/plain']], $this->message()->getHeaders());
    }

    #[Test]
    public function testGetProtocolVersion(): void
    {
        static::assertSame('1.1', $this->message()->getProtocolVersion());
    }

    #[Test]
    public function testHasHeader(): void
    {
        static::assertTrue($this->message()->hasHeader('accept'));
    }

    #[Test]
    public function testWithAddedHeader(): void
    {
        $message = $this->message();

        $with = $message->withAddedHeader('accept', 'application/json');

        static::assertInstanceOf(Message::class, $with);
        static::assertNotSame($message, $with);
        static::assertNotSame($message->getHeaders(), $with->getHeaders());
        static::assertSame(['accept' => ['text/plain']], $message->getHeaders());
        static::assertSame(['accept' => ['text/plain', 'application/json']], $with->getHeaders());
    }

    #[Test]
    public function testWithBody(): void
    {
        $message = $this->message();

        $with = $message->withBody($this->stream('testtest'));

        static::assertInstanceOf(Message::class, $with);
        static::assertNotSame($message, $with);
        static::assertNotSame($message->getBody(), $with->getBody());
        static::assertSame('test', $message->getBody()->__toString());
        static::assertSame('testtest', $with->getBody()->__toString());
    }

    #[Test]
    public function testWithHeader(): void
    {
        $message = $this->message();

        $with = $message->withHeader('accept', 'application/json');

        static::assertInstanceOf(Message::class, $with);
        static::assertNotSame($message, $with);
        static::assertNotSame($message->getHeaders(), $with->getHeaders());
        static::assertSame(['accept' => ['text/plain']], $message->getHeaders());
        static::assertSame(['accept' => ['application/json']], $with->getHeaders());
    }

    #[Test]
    public function testWithProtocolVersion(): void
    {
        $message = $this->message();

        $with = $message->withProtocolVersion('2.0');

        static::assertInstanceOf(Message::class, $with);
        static::assertNotSame($message, $with);
        static::assertNotSame($message->getProtocolVersion(), $with->getProtocolVersion());
        static::assertSame('1.1', $message->getProtocolVersion());
        static::assertSame('2.0', $with->getProtocolVersion());
    }

    #[Test]
    public function testWithoutHeader(): void
    {
        $message = $this->message();

        $without = $message->withoutHeader('accept');

        static::assertInstanceOf(Message::class, $without);
        static::assertNotSame($message, $without);
        static::assertNotSame($message->getHeaders(), $without->getHeaders());
        static::assertSame(['accept' => ['text/plain']], $message->getHeaders());
        static::assertSame([], $without->getHeaders());
    }
}
