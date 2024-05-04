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

namespace Premierstacks\PhpUtil\Debug;

class Debugf
{
    /**
     * @param iterable<int|string, mixed> $args
     */
    public static function args(iterable $args): string
    {
        $encoded = [];

        foreach ($args as $k => $v) {
            if (\is_int($k)) {
                $encoded[] = static::type($v);
            } else {
                $encoded[] = \sprintf('%s: %s', $k, static::type($v));
            }
        }

        return \implode(', ', $encoded);
    }

    public static function type(mixed $value): string
    {
        $type = \get_debug_type($value);
        $size = null;

        if (\is_countable($value)) {
            $size = \count($value);
        } elseif (\is_string($value)) {
            $size = \mb_strlen($value, '8bit');
        }

        if (\is_iterable($value)) {
            $arrayKey = null;
            $valueTypes = [];

            foreach ($value as $k => $v) {
                if (\is_int($k) && \in_array($arrayKey, ['int', null], true)) {
                    $arrayKey = 'int';
                } elseif (\is_string($k) && \in_array($arrayKey, ['string', null], true)) {
                    $arrayKey = 'string';
                } else {
                    $arrayKey = 'mixed';
                }

                $valueType = static::type($v);

                if (!\in_array($valueType, $valueTypes, true)) {
                    $valueTypes[] = $valueType;
                }
            }

            $type = \sprintf('%s<%s, %s>', $type, $arrayKey ?? 'mixed', \count($valueTypes) > 0 ? \implode('|', $valueTypes) : 'mixed');
        }

        if ($size !== null) {
            $type .= "[{$size}]";
        }

        return $type;
    }

    /**
     * @param iterable<int|string, mixed> $args
     */
    public static function types(iterable $args): string
    {
        $types = [];

        foreach ($args as $v) {
            $type = static::type($v);

            if (!\in_array($type, $types, true)) {
                $types[] = $type;
            }
        }

        return \implode('|', $types);
    }
}
