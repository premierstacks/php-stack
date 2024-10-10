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

namespace Premierstacks\PhpStack\Debug;

class Debugf
{
    /**
     * @param iterable<int|string, mixed> $values
     */
    public static function args(iterable $values): string
    {
        return '(' . \implode(', ', static::types($values)) . ')';
    }

    /**
     * @param iterable<int|string, mixed> $values
     */
    public static function context(iterable $values): string
    {
        return '{' . \implode('; ', static::types($values)) . '}';
    }

    /**
     * @param iterable<int|string, mixed> $context
     */
    public static function message(string $message, iterable $context = [], \Throwable|string|null $previous = null): string
    {
        if ($context !== []) {
            $message .= ' ' . static::context($context);
        }

        if ($previous !== null) {
            $message .= ': ' . ($previous instanceof \Throwable ? $previous->getMessage() : $previous);
        }

        return $message;
    }

    public static function type(mixed $value): string
    {
        if (\is_string($value)) {
            return \get_debug_type($value) . '#' . \mb_strlen($value, '8bit');
        }

        if (\is_countable($value)) {
            return \get_debug_type($value) . '#' . \count($value);
        }

        return \get_debug_type($value);
    }

    /**
     * @param iterable<int|string, mixed> $values
     *
     * @return list<string>
     */
    public static function types(iterable $values): array
    {
        $encoded = [];

        foreach ($values as $key => $value) {
            $encoded[] = static::type($value) . ' $' . $key;
        }

        return $encoded;
    }

    /**
     * @param iterable<int|string, mixed>|string $values
     */
    public static function union(iterable|string $values): string
    {
        if (\is_string($values)) {
            return $values;
        }

        $types = [];

        foreach ($values as $value) {
            $type = static::type($value);

            if (!\in_array($type, $types, true)) {
                $types[] = $type;
            }
        }

        return \implode('|', $types);
    }

    public static function value(mixed $value): string
    {
        if (\is_scalar($value) || $value === null) {
            return \var_export($value, true);
        }

        if (\is_array($value)) {
            return 'array<?, ?>';
        }

        if (\is_object($value)) {
            return (string) \spl_object_id($value);
        }

        if (\is_resource($value)) {
            return (string) \get_resource_id($value);
        }

        return '?';
    }

    /**
     * @param iterable<int|string, mixed> $values
     *
     * @return list<string>
     */
    public static function values(iterable $values): array
    {
        $encoded = [];

        foreach ($values as $key => $value) {
            $encoded[] = static::type($value) . ' $' . $key . '= ' . static::value($value);
        }

        return $encoded;
    }
}
