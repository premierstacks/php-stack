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
 * Tomáš Chochola: The Creator, Proprietor & Project Visionary
 * - Email: chocholatom1997@gmail.com
 * - GitHub: https://github.com/tomchochola
 * - Sponsor & License: https://github.com/sponsors/tomchochola
 *
 * Premierstacks: The Organization
 * - GitHub: https://github.com/premierstacks
 */

declare(strict_types=1);

namespace Premierstacks\PhpUtil\Random;

use Random\Randomizer;

class Random
{
    /**
     * @return non-falsy-string|numeric-string
     */
    public static function numeric(int $length = 6, bool $startWithZero = true): string
    {
        $random = new Randomizer();

        $code = (string) $random->getInt($startWithZero ? 0 : 1, 9);

        for ($i = 1; $i < $length; ++$i) {
            $code .= $random->getInt(0, 9);
        }

        return $code;
    }

    public static function source(int $length = 6, string $source = ''): string
    {
        if ($source === '') {
            $source = \implode('', \range('a', 'z'));
        }

        $random = new Randomizer();

        return $random->getBytesFromString($source, $length);
    }

    public static function token(int $length = 64): string
    {
        $random = new Randomizer();

        return $random->getBytes($length);
    }
}
