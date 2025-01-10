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

namespace Tests\Unit\Http;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Small;
use PHPUnit\Framework\Attributes\Test;
use Premierstacks\PhpStack\Http\Response;
use Tests\Unit\TestCase;

/**
 * @internal
 */
#[Small]
#[CoversClass(Response::class)]
class ResponseTest extends TestCase
{
    #[Test]
    public function testGetReasonPhrase(): void
    {
        static::assertSame('OK', $this->response()->getReasonPhrase());
    }

    #[Test]
    public function testGetStatusCode(): void
    {
        static::assertSame(200, $this->response()->getStatusCode());
    }

    #[Test]
    public function testWithStatus(): void
    {
        $response = $this->response();

        $with = $response->withStatus(404, 'Not Found');

        static::assertInstanceOf(Response::class, $with);
        static::assertNotSame($response, $with);
        static::assertNotSame($response->getStatusCode(), $with->getStatusCode());
        static::assertNotSame($response->getReasonPhrase(), $with->getReasonPhrase());
        static::assertSame(200, $response->getStatusCode());
        static::assertSame(404, $with->getStatusCode());
        static::assertSame('OK', $response->getReasonPhrase());
        static::assertSame('Not Found', $with->getReasonPhrase());
    }
}
