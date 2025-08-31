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

namespace Premierstacks\PhpStack\Types;

use Premierstacks\PhpStack\Debug\Errorf;

class Strings
{
    public static function nullify(string|null $value, bool $trim = true): string|null
    {
        if ($value === null || $value === '') {
            return null;
        }

        if ($trim && \mb_trim($value) === '') {
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
    public static function pregSplit(string $string, string $pattern = '/\s+/', int $limit = -1): iterable
    {
        $splited = \preg_split($pattern, $string, $limit, \PREG_SPLIT_NO_EMPTY);

        if ($splited === false) {
            throw new \UnexpectedValueException(Errorf::unexpectedCallableError('preg_split', [$pattern, $string, $limit, \PREG_SPLIT_NO_EMPTY]));
        }

        return $splited;
    }
}
