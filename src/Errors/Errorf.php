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
 * The Proprietor: Tomáš Chochola
 * - Role: The Creator, Proprietor & Project Visionary
 * - Email: chocholatom1997@gmail.com
 * - GitHub: https://github.com/tomchochola
 * - Sponsor & License: https://github.com/sponsors/tomchochola
 */

declare(strict_types=1);

namespace Tomchochola\PhpUtil\Errors;

class Errorf
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

    /**
     * @param iterable<int|string, mixed> $args
     */
    public static function errorReturnValue(string $callable, iterable $args, string|null $previous = null): string
    {
        if ($previous !== null) {
            return \sprintf('calling "%s(%s)" resulted in an error: %s', $callable, static::args($args), $previous);
        }

        return \sprintf('calling "%s(%s)" resulted in an error', $callable, static::args($args));
    }

    public static function invalidArgument(string $argument, string $expected, mixed $received, string|null $previous = null): string
    {
        if ($previous !== null) {
            return \sprintf('argument "%s" must be "%s", but "%s" received: %s', $argument, $expected, static::type($received), $previous);
        }

        return \sprintf('argument "%s" must be "%s", but "%s" received', $argument, $expected, static::type($received));
    }

    public static function invalidArgumentType(string $argument, string $expected, mixed $received, string|null $previous = null): string
    {
        if ($previous !== null) {
            return \sprintf('argument "%s" must be of type "%s", but "%s" received: %s', $argument, $expected, static::type($received), $previous);
        }

        return \sprintf('argument "%s" must be of type "%s", but "%s" received', $argument, $expected, static::type($received));
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

    /**
     * @param iterable<int|string, mixed> $args
     */
    public static function unexpectedReturnValue(string $callable, iterable $args, string $expected, mixed $received, string|null $previous = null): string
    {
        if ($previous !== null) {
            return \sprintf('returned value from "%s(%s)" must be "%s", but "%s" received: %s', $callable, static::args($args), $expected, static::type($received), $previous);
        }

        return \sprintf('returned value from "%s(%s)" must be "%s", but "%s" received', $callable, static::args($args), $expected, static::type($received));
    }

    /**
     * @param iterable<int|string, mixed> $args
     */
    public static function unexpectedReturnValueType(string $callable, iterable $args, string $expected, mixed $received, string|null $previous = null): string
    {
        if ($previous !== null) {
            return \sprintf('returned value from "%s(%s)" must be of type "%s", but "%s" received: %s', $callable, static::args($args), $expected, static::type($received), $previous);
        }

        return \sprintf('returned value from "%s(%s)" must be of type "%s", but "%s" received', $callable, static::args($args), $expected, static::type($received));
    }

    public static function unexpectedValue(string $processed, string $expected, mixed $received, string|null $previous = null): string
    {
        if ($previous !== null) {
            return \sprintf('processed "%s" must be "%s", but "%s" received: %s', $processed, $expected, static::type($received), $previous);
        }

        return \sprintf('processed "%s" must be "%s", but "%s" received', $processed, $expected, static::type($received));
    }

    public static function unexpectedValueType(string $processed, string $expected, mixed $received, string|null $previous = null): string
    {
        if ($previous !== null) {
            return \sprintf('processed "%s" must be of type "%s", but "%s" received: %s', $processed, $expected, static::type($received), $previous);
        }

        return \sprintf('processed "%s" must be of type "%s", but "%s" received', $processed, $expected, static::type($received));
    }
}
