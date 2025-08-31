<?php

/**
 * @author Tomáš Chochola <chocholatom1997@gmail.com>
 * @copyright © 2025 Tomáš Chochola <chocholatom1997@gmail.com>
 *
 * @license CC-BY-ND-4.0
 *
 * @see {@link https://creativecommons.org/licenses/by-nd/4.0/} License
 * @see {@link https://github.com/tomchochola} GitHub Personal
 * @see {@link https://github.com/premierstacks} GitHub Organization
 * @see {@link https://github.com/sponsors/tomchochola} GitHub Sponsors
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
