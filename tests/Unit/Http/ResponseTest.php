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
