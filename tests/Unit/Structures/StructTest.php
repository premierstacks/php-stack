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

namespace Tests\Unit\Structures;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Small;
use PHPUnit\Framework\Attributes\Test;
use Premierstacks\PhpStack\Structures\Struct;
use Tests\Unit\TestCase;

/**
 * @internal
 */
#[Small]
#[CoversClass(Struct::class)]
class StructTest extends TestCase
{
    #[Test]
    public function testGet(): void
    {
        $struct = new Struct(['a' => ['aa' => new \ArrayObject(['aaa' => true])], 'b' => ['bb' => (object) ['bbb' => true]]]);

        static::assertTrue($struct->get(['a', 'aa', 'aaa']));
        static::assertTrue($struct->get(['b', 'bb', 'bbb']));

        static::assertSame('fallback', $struct->get(['a', 'key'], 'fallback'));
        static::assertSame('fallback', $struct->get(['key'], 'fallback'));
        static::assertSame('fallback', $struct->get(['key', 'aa'], 'fallback'));

        static::expectException(\UnexpectedValueException::class);

        $struct->get(['key']);
    }

    #[Test]
    public function testSet(): void
    {
        $struct = new Struct(['a' => ['aa' => new \ArrayObject(['aaa' => true])], 'b' => ['bb' => (object) ['bbb' => true]]]);

        $struct->set(['a', 'aa', 'aaa', 'aaaa'], true);

        static::assertTrue($struct->get(['a', 'aa', 'aaa', 'aaaa']));

        static::expectException(\InvalidArgumentException::class);

        $struct->set(['a', 'aa', 'aaa', 'aaaa', 'aaaaa'], 50, false, false);
    }
}
