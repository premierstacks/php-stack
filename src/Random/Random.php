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
