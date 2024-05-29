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

namespace Premierstacks\PhpStack\Random;

use Random\Randomizer;

class Random
{
    public static function alnum(int $length = 64): string
    {
        $random = new Randomizer();

        return $random->getBytesFromString('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789', $length);
    }

    public static function alpha(int $length = 64): string
    {
        $random = new Randomizer();

        return $random->getBytesFromString('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', $length);
    }

    public static function code(int $length = 6, bool $startWithZero = false): string
    {
        $random = new Randomizer();

        return $random->getInt($startWithZero ? 0 : 1, 9) . $random->getBytesFromString('0123456789', $length - 1);
    }

    public static function lower(int $length = 64): string
    {
        $random = new Randomizer();

        return $random->getBytesFromString('abcdefghijklmnopqrstuvwxyz', $length);
    }

    public static function numeric(int $length = 64): string
    {
        $random = new Randomizer();

        return $random->getBytesFromString('0123456789', $length);
    }

    public static function upper(int $length = 64): string
    {
        $random = new Randomizer();

        return $random->getBytesFromString('ABCDEFGHIJKLMNOPQRSTUVWXYZ', $length);
    }
}
