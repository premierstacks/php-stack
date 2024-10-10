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
