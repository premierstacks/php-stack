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
