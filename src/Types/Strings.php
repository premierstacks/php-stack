<?php

/**
 * @author Tomáš Chochola <chocholatom1997@gmail.com>
 * @copyright © 2024–Present Tomáš Chochola <chocholatom1997@gmail.com>. All rights reserved.
 *
 * @license
 *
 * This software is proprietary and licensed under specific terms set by its owner.
 * Any form of access, use, or distribution requires a valid and active license.
 * For full licensing terms, refer to the LICENSE.md file accompanying this software.
 *
 * @see {@link https://premierstacks.com} Website
 * @see {@link https://github.com/tomchochola} GitHub Personal
 * @see {@link https://github.com/premierstacks} GitHub Organization
 * @see {@link https://github.com/sponsors/tomchochola} GitHub Sponsors
 */

declare(strict_types=1);

namespace Premierstacks\PhpStack\Types;

use Premierstacks\PhpStack\Debug\Errorf;

class Strings
{
    public static function nullify(string|null $value, bool $trim = true): string|null
    {
        if ($value === null || $value === '') {
            return null;
        }

        if ($trim && \trim($value) === '') {
            return null;
        }

        return $value;
    }

    /**
     * @param array<int|string, array<int, int|string|null>|string|null> $matches
     * @param 0|256|512|768 $flags
     */
    public static function pregMatch(string $pattern, string $subject, array &$matches = [], int $flags = 0, int $offset = 0): bool
    {
        $result = \preg_match($pattern, $subject, $matches, $flags, $offset);

        if ($result === false) {
            throw new \UnexpectedValueException(Errorf::unexpectedCallableError('preg_match', [$pattern, $subject, $matches, $flags, $offset]));
        }

        return $result === 1;
    }

    /**
     * @return iterable<int, string>
     */
    public static function pregSplit(string $string, string $pattern = '/\s+/', int $limit = -1, int $flags = \PREG_SPLIT_NO_EMPTY): iterable
    {
        $splited = \preg_split($pattern, $string, $limit, $flags);

        if ($splited === false) {
            throw new \UnexpectedValueException(Errorf::unexpectedCallableError('preg_split', [$pattern, $string, $limit, $flags]));
        }

        return $splited;
    }
}
