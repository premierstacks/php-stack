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
use Premierstacks\PhpStack\Http\NetworkException;
use Premierstacks\PhpStack\Http\Request;
use Tests\Unit\TestCase;

/**
 * @internal
 */
#[Small]
#[CoversClass(NetworkException::class)]
class NetworkExceptionTest extends TestCase
{
    #[Test]
    public function testGetRequest(): void
    {
        $request = $this->request();

        $exception = new NetworkException($request);

        $pulled = $exception->getRequest();

        static::assertInstanceOf(Request::class, $pulled);
        static::assertSame($request, $pulled);
    }
}
