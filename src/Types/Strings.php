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
