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
