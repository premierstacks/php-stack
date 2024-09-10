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
