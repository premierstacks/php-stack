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

namespace Premierstacks\PhpStack\Types;

class Arrays
{
    /**
     * @template K of array-key
     * @template V
     *
     * @param array<K, V> $array
     *
     * @return array<K, V|null>
     */
    public static function nullableTrim(array $array): array
    {
        \array_walk_recursive($array, static function (mixed &$value): void {
            if (\is_string($value) && ($value === '' || \trim($value) === '')) {
                $value = null;
            }
        });

        return $array;
    }

    /**
     * @template K of array-key
     * @template V
     *
     * @param array<K, V> $array
     *
     * @return array<K, V>
     */
    public static function trim(array $array): array
    {
        \array_walk_recursive($array, static function (mixed &$value): void {
            if (\is_string($value) && ($value === '' || \trim($value) === '')) {
                $value = '';
            }
        });

        return $array;
    }
}
