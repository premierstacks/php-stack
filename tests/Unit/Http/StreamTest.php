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
use Premierstacks\PhpStack\Http\Stream;
use Tests\Unit\TestCase;

/**
 * @internal
 */
#[Small]
#[CoversClass(Stream::class)]
class StreamTest extends TestCase
{
    #[Test]
    public function testClose(): void
    {
        $stream = $this->stream();

        $stream->close();

        static::assertIsClosedResource($stream->resource);
    }

    #[Test]
    public function testDestruct(): void
    {
        $stream = $this->stream();

        $stream->__destruct();

        static::assertIsClosedResource($stream->resource);
    }

    #[Test]
    public function testDetach(): void
    {
        $stream = $this->stream();

        $resource = $stream->detach();

        static::assertIsResource($resource);
        static::assertNotSame($resource, $stream->resource);
    }

    #[Test]
    public function testEof(): void
    {
        $stream = $this->stream();

        static::assertNotFalse(\stream_get_contents($stream->resource));

        static::assertTrue($stream->eof());
    }

    #[Test]
    public function testGetContents(): void
    {
        $stream = $this->stream();

        static::assertSame(0, \fseek($stream->resource, 2));

        static::assertSame('st', $stream->getContents());
    }

    #[Test]
    public function testGetMetadata(): void
    {
        static::assertSame('php://memory', $this->stream()->getMetadata('uri'));
    }

    #[Test]
    public function testGetSize(): void
    {
        static::assertSame(4, $this->stream()->getSize());
    }

    #[Test]
    public function testIsReadable(): void
    {
        static::assertTrue($this->stream()->isReadable());
    }

    #[Test]
    public function testIsSeekable(): void
    {
        static::assertTrue($this->stream()->isSeekable());
    }

    #[Test]
    public function testIsWritable(): void
    {
        static::assertTrue($this->stream()->isWritable());
    }

    #[Test]
    public function testRead(): void
    {
        static::assertSame('te', $this->stream()->read(2));
    }

    #[Test]
    public function testRewind(): void
    {
        $stream = $this->stream();

        static::assertSame(0, \fseek($stream->resource, 2));

        $stream->rewind();

        static::assertSame(0, \ftell($stream->resource));
    }

    #[Test]
    public function testSeek(): void
    {
        $stream = $this->stream();

        $stream->seek(2);

        static::assertSame(2, \ftell($stream->resource));
    }

    #[Test]
    public function testTell(): void
    {
        $stream = $this->stream();

        static::assertSame(0, \fseek($stream->resource, 2));

        static::assertSame(2, $stream->tell());
    }

    #[Test]
    public function testToString(): void
    {
        $stream = $this->stream();

        static::assertSame(0, \fseek($stream->resource, 2));

        static::assertSame('test', $stream->__toString());
    }

    #[Test]
    public function testWrite(): void
    {
        $stream = $this->stream();

        static::assertSame(0, \fseek($stream->resource, 0));

        $stream->write('test');
        $stream->write('test');
        $stream->write('test');

        static::assertSame(0, \fseek($stream->resource, 0));

        static::assertSame('testtesttest', \stream_get_contents($stream->resource));
    }
}
