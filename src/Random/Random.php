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
