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
