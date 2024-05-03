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

namespace Premierstacks\PhpUtil\Mixed;

use BackedEnum as B;

class Is
{
    /**
     * @template A
     * @template B of object
     *
     * @param A $value
     * @param class-string<B> $class
     *
     * @phpstan-assert-if-true class-string<B> $value
     */
    public static function a(mixed $value, string $class, \Throwable|null $throwable = null): bool
    {
        return \is_string($value) && \is_a($value, $class, true);
    }

    /**
     * @template A
     *
     * @param A $value
     *
     * @phpstan-assert-if-true array<int|string, mixed> $value
     */
    public static function array(mixed $value, \Throwable|null $throwable = null): bool
    {
        return \is_array($value);
    }

    /**
     * @template A
     *
     * @param A $value
     *
     * @phpstan-assert-if-true int|string $value
     */
    public static function arrayKey(mixed $value, \Throwable|null $throwable = null): bool
    {
        return \is_int($value) || \is_string($value);
    }

    /**
     * @template A
     * @template B
     *
     * @param A $value
     * @param callable(mixed): B $callback
     *
     * @phpstan-assert-if-true array<int|string, B> $value
     */
    public static function arrayOf(mixed $value, callable $callback, \Throwable|null $throwable = null): bool
    {
        if (!\is_array($value)) {
            return false;
        }

        foreach ($value as $v) {
            $expected = $callback($v);

            if ($v !== $expected) {
                return false;
            }
        }

        return true;
    }

    /**
     * @template A
     *
     * @param A $value
     *
     * @phpstan-assert-if-true bool $value
     */
    public static function bool(mixed $value, \Throwable|null $throwable = null): bool
    {
        return \is_bool($value);
    }

    /**
     * @template A
     *
     * @param A $value
     *
     * @phpstan-assert-if-true callable(): mixed $value
     */
    public static function callable(mixed $value, \Throwable|null $throwable = null): bool
    {
        return \is_callable($value);
    }

    /**
     * @template A
     *
     * @param A $value
     *
     * @phpstan-assert-if-true string&callable(): mixed $value
     */
    public static function callableString(mixed $value, \Throwable|null $throwable = null): bool
    {
        return \is_string($value) && \is_callable($value);
    }

    /**
     * @template A
     *
     * @param A $value
     *
     * @phpstan-assert-if-true class-string $value
     */
    public static function classString(mixed $value, \Throwable|null $throwable = null): bool
    {
        return \is_string($value) && \class_exists($value);
    }

    /**
     * @template A
     *
     * @param A $value
     *
     * @phpstan-assert-if-true closed-resource $value
     */
    public static function closedResource(mixed $value, \Throwable|null $throwable = null): bool
    {
        return $value !== null && !\is_resource($value) && !\is_scalar($value) && !\is_array($value) && !\is_object($value);
    }

    /**
     * @template A
     *
     * @param A $value
     *
     * @phpstan-assert-if-true array<int|string, mixed>|\Countable $value
     */
    public static function countable(mixed $value, \Throwable|null $throwable = null): bool
    {
        return \is_countable($value);
    }

    /**
     * @template A
     * @template B of \BackedEnum
     *
     * @param A $value
     * @param class-string<B> $enum
     *
     * @phpstan-assert-if-true B $value
     */
    public static function enum(mixed $value, string $enum, \Throwable|null $throwable = null): bool
    {
        return $value instanceof $enum;
    }

    /**
     * @template A
     *
     * @param A $value
     *
     * @phpstan-assert-if-true false $value
     */
    public static function false(mixed $value, \Throwable|null $throwable = null): bool
    {
        return $value === false;
    }

    /**
     * @template A
     *
     * @param A $value
     *
     * @phpstan-assert-if-true float $value
     */
    public static function float(mixed $value, \Throwable|null $throwable = null): bool
    {
        return \is_float($value);
    }

    /**
     * @template A
     * @template B
     *
     * @param A $value
     * @param array<int|string, B> $enum
     *
     * @phpstan-assert-if-true B $value
     */
    public static function in(mixed $value, array $enum, \Throwable|null $throwable = null): bool
    {
        return \in_array($value, $enum, true);
    }

    /**
     * @template A
     * @template B of object
     *
     * @param A $value
     * @param class-string<B> $class
     *
     * @phpstan-assert-if-true B $value
     */
    public static function instance(mixed $value, string $class, \Throwable|null $throwable = null): bool
    {
        return $value instanceof $class;
    }

    /**
     * @template A
     *
     * @param A $value
     *
     * @phpstan-assert-if-true int $value
     */
    public static function int(mixed $value, \Throwable|null $throwable = null): bool
    {
        return \is_int($value);
    }

    /**
     * @template A
     *
     * @param A $value
     *
     * @phpstan-assert-if-true array<int, mixed> $value
     */
    public static function intArray(mixed $value, \Throwable|null $throwable = null): bool
    {
        if (!\is_array($value)) {
            return false;
        }

        foreach ($value as $k => $v) {
            if (!\is_int($k)) {
                return false;
            }
        }

        return true;
    }

    /**
     * @template A
     * @template B
     *
     * @param A $value
     * @param callable(mixed): B $callback
     *
     * @phpstan-assert-if-true array<int, B> $value
     */
    public static function intArrayOf(mixed $value, callable $callback, \Throwable|null $throwable = null): bool
    {
        if (!\is_array($value)) {
            return false;
        }

        foreach ($value as $k => $v) {
            if (!\is_int($k)) {
                return false;
            }

            $expected = $callback($v);

            if ($v !== $expected) {
                return false;
            }
        }

        return true;
    }

    /**
     * @template A
     * @template B of \BackedEnum
     *
     * @param A $value
     * @param class-string<B> $enum
     *
     * @phpstan-assert-if-true B $value
     */
    public static function intEnum(mixed $value, string $enum, \Throwable|null $throwable = null): bool
    {
        return $value instanceof $enum;
    }

    /**
     * @template A
     *
     * @param A $value
     *
     * @phpstan-assert-if-true iterable<int, mixed> $value
     */
    public static function intIterable(mixed $value, \Throwable|null $throwable = null): bool
    {
        if (!\is_iterable($value)) {
            return false;
        }

        foreach ($value as $k => $v) {
            if (!\is_int($k)) {
                return false;
            }
        }

        return true;
    }

    /**
     * @template A
     * @template B
     *
     * @param A $value
     * @param callable(mixed): B $callback
     *
     * @phpstan-assert-if-true iterable<int, B> $value
     */
    public static function intIterableOf(mixed $value, callable $callback, \Throwable|null $throwable = null): bool
    {
        if (!\is_iterable($value)) {
            return false;
        }

        foreach ($value as $k => $v) {
            if (!\is_int($k)) {
                return false;
            }

            $expected = $callback($v);

            if ($v !== $expected) {
                return false;
            }
        }

        return true;
    }

    /**
     * @template A
     *
     * @param A $value
     *
     * @phpstan-assert-if-true interface-string $value
     */
    public static function interfaceString(mixed $value, \Throwable|null $throwable = null): bool
    {
        return \is_string($value) && \interface_exists($value);
    }

    /**
     * @template A
     *
     * @param A $value
     *
     * @phpstan-assert-if-true iterable<int|string, mixed> $value
     */
    public static function iterable(mixed $value, \Throwable|null $throwable = null): bool
    {
        return \is_iterable($value);
    }

    /**
     * @template A
     * @template B
     *
     * @param A $value
     * @param callable(mixed): B $callback
     *
     * @phpstan-assert-if-true iterable<int|string, B> $value
     */
    public static function iterableOf(mixed $value, callable $callback, \Throwable|null $throwable = null): bool
    {
        if (!\is_iterable($value)) {
            return false;
        }

        foreach ($value as $v) {
            $expected = $callback($v);

            if ($v !== $expected) {
                return false;
            }
        }

        return true;
    }

    /**
     * @template A
     *
     * @param A $value
     *
     * @phpstan-assert-if-true list<mixed> $value
     */
    public static function list(mixed $value, \Throwable|null $throwable = null): bool
    {
        return \is_array($value) && \array_is_list($value);
    }

    /**
     * @template A
     * @template B
     *
     * @param A $value
     * @param callable(mixed): B $callback
     *
     * @phpstan-assert-if-true list<B> $value
     */
    public static function listOf(mixed $value, callable $callback, \Throwable|null $throwable = null): bool
    {
        if (!\is_array($value)) {
            return false;
        }

        if (!\array_is_list($value)) {
            return false;
        }

        foreach ($value as $v) {
            $expected = $callback($v);

            if ($v !== $expected) {
                return false;
            }
        }

        return true;
    }

    /**
     * @template A
     *
     * @param A $value
     *
     * @phpstan-assert-if-true negative-int $value
     */
    public static function negativeInt(mixed $value, \Throwable|null $throwable = null): bool
    {
        return \is_int($value) && $value < 0;
    }

    /**
     * @template A
     *
     * @param A $value
     *
     * @phpstan-assert-if-true non-empty-array<int|string, mixed> $value
     */
    public static function nonEmptyArray(mixed $value, \Throwable|null $throwable = null): bool
    {
        return \is_array($value) && $value !== [];
    }

    /**
     * @template A
     * @template B
     *
     * @param A $value
     * @param callable(mixed): B $callback
     *
     * @phpstan-assert-if-true non-empty-array<int|string, B> $value
     */
    public static function nonEmptyArrayOf(mixed $value, callable $callback, \Throwable|null $throwable = null): bool
    {
        if (!\is_array($value)) {
            return false;
        }

        if ($value === []) {
            return false;
        }

        foreach ($value as $v) {
            $expected = $callback($v);

            if ($v !== $expected) {
                return false;
            }
        }

        return true;
    }

    /**
     * @template A
     *
     * @param A $value
     *
     * @phpstan-assert-if-true non-empty-array<int, mixed> $value
     */
    public static function nonEmptyIntArray(mixed $value, \Throwable|null $throwable = null): bool
    {
        if (!\is_array($value)) {
            return false;
        }

        if ($value === []) {
            return false;
        }

        foreach ($value as $k => $v) {
            if (!\is_int($k)) {
                return false;
            }
        }

        return true;
    }

    /**
     * @template A
     * @template B
     *
     * @param A $value
     * @param callable(mixed): B $callback
     *
     * @phpstan-assert-if-true non-empty-array<int, B> $value
     */
    public static function nonEmptyIntArrayOf(mixed $value, callable $callback, \Throwable|null $throwable = null): bool
    {
        if (!\is_array($value)) {
            return false;
        }

        if ($value === []) {
            return false;
        }

        foreach ($value as $k => $v) {
            if (!\is_int($k)) {
                return false;
            }

            $expected = $callback($v);

            if ($v !== $expected) {
                return false;
            }
        }

        return true;
    }

    /**
     * @template A
     *
     * @param A $value
     *
     * @phpstan-assert-if-true non-empty-list<mixed> $value
     */
    public static function nonEmptyList(mixed $value, \Throwable|null $throwable = null): bool
    {
        return \is_array($value) && $value !== [] && \array_is_list($value);
    }

    /**
     * @template A
     * @template B
     *
     * @param A $value
     * @param callable(mixed): B $callback
     *
     * @phpstan-assert-if-true non-empty-list<B> $value
     */
    public static function nonEmptyListOf(mixed $value, callable $callback, \Throwable|null $throwable = null): bool
    {
        if (!\is_array($value)) {
            return false;
        }

        if ($value === []) {
            return false;
        }

        if (!\array_is_list($value)) {
            return false;
        }

        foreach ($value as $v) {
            $expected = $callback($v);

            if ($v !== $expected) {
                return false;
            }
        }

        return true;
    }

    /**
     * @template A
     *
     * @param A $value
     *
     * @phpstan-assert-if-true non-empty-string $value
     */
    public static function nonEmptyString(mixed $value, \Throwable|null $throwable = null): bool
    {
        return \is_string($value) && $value !== '';
    }

    /**
     * @template A
     *
     * @param A $value
     *
     * @phpstan-assert-if-true non-empty-array<string, mixed> $value
     */
    public static function nonEmptyStringArray(mixed $value, \Throwable|null $throwable = null): bool
    {
        if (!\is_array($value)) {
            return false;
        }

        if ($value === []) {
            return false;
        }

        foreach ($value as $k => $v) {
            if (!\is_string($k)) {
                return false;
            }
        }

        return true;
    }

    /**
     * @template A
     * @template B
     *
     * @param A $value
     * @param callable(mixed): B $callback
     *
     * @phpstan-assert-if-true non-empty-array<string, B> $value
     */
    public static function nonEmptyStringArrayOf(mixed $value, callable $callback, \Throwable|null $throwable = null): bool
    {
        if (!\is_array($value)) {
            return false;
        }

        if ($value === []) {
            return false;
        }

        foreach ($value as $k => $v) {
            if (!\is_string($k)) {
                return false;
            }

            $expected = $callback($v);

            if ($v !== $expected) {
                return false;
            }
        }

        return true;
    }

    /**
     * @template A
     *
     * @param A $value
     *
     * @phpstan-assert-if-true non-falsy-string $value
     */
    public static function nonFalsyString(mixed $value, \Throwable|null $throwable = null): bool
    {
        return \is_string($value) && (bool) $value;
    }

    /**
     * @template A
     *
     * @param A $value
     *
     * @phpstan-assert-if-true non-negative-int $value
     */
    public static function nonNegativeInt(mixed $value, \Throwable|null $throwable = null): bool
    {
        return \is_int($value) && $value >= 0;
    }

    /**
     * @template A
     *
     * @param A $value
     *
     * @phpstan-assert-if-true non-positive-int $value
     */
    public static function nonPositiveInt(mixed $value, \Throwable|null $throwable = null): bool
    {
        return \is_int($value) && $value <= 0;
    }

    /**
     * @template A
     *
     * @param A $value
     *
     * @phpstan-assert-if-true non-zero-int $value
     */
    public static function nonZeroInt(mixed $value, \Throwable|null $throwable = null): bool
    {
        return \is_int($value) && $value !== 0;
    }

    /**
     * @template A
     *
     * @param A $value
     *
     * @phpstan-assert-if-true !false $value
     */
    public static function notFalse(mixed $value, \Throwable|null $throwable = null): bool
    {
        return $value !== false;
    }

    /**
     * @template A
     *
     * @param A $value
     *
     * @phpstan-assert-if-true !-1 $value
     */
    public static function notNegativeOne(mixed $value, \Throwable|null $throwable = null): bool
    {
        return $value !== -1;
    }

    /**
     * @template A
     *
     * @param A $value
     *
     * @phpstan-assert-if-true !null $value
     */
    public static function notNull(mixed $value, \Throwable|null $throwable = null): bool
    {
        return $value !== null;
    }

    /**
     * @template A
     *
     * @param A $value
     *
     * @phpstan-assert-if-true !1 $value
     */
    public static function notPositiveOne(mixed $value, \Throwable|null $throwable = null): bool
    {
        return $value !== 1;
    }

    /**
     * @template A
     *
     * @param A $value
     *
     * @phpstan-assert-if-true !true $value
     */
    public static function notTrue(mixed $value, \Throwable|null $throwable = null): bool
    {
        return $value !== true;
    }

    /**
     * @template A
     *
     * @param A $value
     *
     * @phpstan-assert-if-true !0 $value
     */
    public static function notZero(mixed $value, \Throwable|null $throwable = null): bool
    {
        return $value !== 0;
    }

    /**
     * @template A
     *
     * @param A $value
     *
     * @phpstan-assert-if-true null $value
     */
    public static function null(mixed $value, \Throwable|null $throwable = null): bool
    {
        return $value === null;
    }

    /**
     * @template A
     * @template B of object
     *
     * @param A $value
     * @param class-string<B> $class
     *
     * @phpstan-assert-if-true class-string<B>|null $value
     */
    public static function nullableA(mixed $value, string $class, \Throwable|null $throwable = null): bool
    {
        return $value === null || (\is_string($value) && \is_a($value, $class, true));
    }

    /**
     * @template A
     *
     * @param A $value
     *
     * @phpstan-assert-if-true array<int|string, mixed>|null $value
     */
    public static function nullableArray(mixed $value, \Throwable|null $throwable = null): bool
    {
        return $value === null || \is_array($value);
    }

    /**
     * @template A
     *
     * @param A $value
     *
     * @phpstan-assert-if-true int|string|null $value
     */
    public static function nullableArrayKey(mixed $value, \Throwable|null $throwable = null): bool
    {
        return $value === null || \is_int($value) || \is_string($value);
    }

    /**
     * @template A
     * @template B
     *
     * @param A $value
     * @param callable(mixed): B $callback
     *
     * @phpstan-assert-if-true array<int|string, B>|null $value
     */
    public static function nullableArrayOf(mixed $value, callable $callback, \Throwable|null $throwable = null): bool
    {
        if ($value === null) {
            return true;
        }

        if (!\is_array($value)) {
            return false;
        }

        foreach ($value as $v) {
            $expected = $callback($v);

            if ($v !== $expected) {
                return false;
            }
        }

        return true;
    }

    /**
     * @template A
     *
     * @param A $value
     *
     * @phpstan-assert-if-true bool|null $value
     */
    public static function nullableBool(mixed $value, \Throwable|null $throwable = null): bool
    {
        return $value === null || \is_bool($value);
    }

    /**
     * @template A
     *
     * @param A $value
     *
     * @phpstan-assert-if-true callable(): mixed|null $value
     */
    public static function nullableCallable(mixed $value, \Throwable|null $throwable = null): bool
    {
        return $value === null || \is_callable($value);
    }

    /**
     * @template A
     *
     * @param A $value
     *
     * @phpstan-assert-if-true (string&callable(): mixed)|null $value
     */
    public static function nullableCallableString(mixed $value, \Throwable|null $throwable = null): bool
    {
        return $value === null || \is_string($value) && \is_callable($value);
    }

    /**
     * @template A
     *
     * @param A $value
     *
     * @phpstan-assert-if-true class-string|null $value
     */
    public static function nullableClassString(mixed $value, \Throwable|null $throwable = null): bool
    {
        return $value === null || \is_string($value) && \class_exists($value);
    }

    /**
     * @template A
     *
     * @param A $value
     *
     * @phpstan-assert-if-true closed-resource|null $value
     */
    public static function nullableClosedResource(mixed $value, \Throwable|null $throwable = null): bool
    {
        return $value === null || (!\is_scalar($value) && !\is_resource($value) && !\is_array($value) && !\is_object($value));
    }

    /**
     * @template A
     *
     * @param A $value
     *
     * @phpstan-assert-if-true array<int|string, mixed>|\Countable|null $value
     */
    public static function nullableCountable(mixed $value, \Throwable|null $throwable = null): bool
    {
        return $value === null || \is_countable($value);
    }

    /**
     * @template A
     * @template B of \BackedEnum
     *
     * @param A $value
     * @param class-string<B> $enum
     *
     * @phpstan-assert-if-true B|null $value
     */
    public static function nullableEnum(mixed $value, string $enum, \Throwable|null $throwable = null): bool
    {
        return $value === null || $value instanceof $enum;
    }

    /**
     * @template A
     *
     * @param A $value
     *
     * @phpstan-assert-if-true false|null $value
     */
    public static function nullableFalse(mixed $value, \Throwable|null $throwable = null): bool
    {
        return $value === null || $value === false;
    }

    /**
     * @template A
     *
     * @param A $value
     *
     * @phpstan-assert-if-true float|null $value
     */
    public static function nullableFloat(mixed $value, \Throwable|null $throwable = null): bool
    {
        return $value === null || \is_float($value);
    }

    /**
     * @template A
     * @template B
     *
     * @param A $value
     * @param array<int|string, B> $enum
     *
     * @phpstan-assert-if-true B|null $value
     */
    public static function nullableIn(mixed $value, array $enum, \Throwable|null $throwable = null): bool
    {
        return $value === null || \in_array($value, $enum, true);
    }

    /**
     * @template A
     * @template B of object
     *
     * @param A $value
     * @param class-string<B> $class
     *
     * @phpstan-assert-if-true B|null $value
     */
    public static function nullableInstance(mixed $value, string $class, \Throwable|null $throwable = null): bool
    {
        return $value === null || $value instanceof $class;
    }

    /**
     * @template A
     *
     * @param A $value
     *
     * @phpstan-assert-if-true int|null $value
     */
    public static function nullableInt(mixed $value, \Throwable|null $throwable = null): bool
    {
        return $value === null || \is_int($value);
    }

    /**
     * @template A
     *
     * @param A $value
     *
     * @phpstan-assert-if-true array<int, mixed>|null $value
     */
    public static function nullableIntArray(mixed $value, \Throwable|null $throwable = null): bool
    {
        if ($value === null) {
            return true;
        }

        if (!\is_array($value)) {
            return false;
        }

        foreach ($value as $k => $v) {
            if (!\is_int($k)) {
                return false;
            }
        }

        return true;
    }

    /**
     * @template A
     * @template B
     *
     * @param A $value
     * @param callable(mixed): B $callback
     *
     * @phpstan-assert-if-true array<int, B>|null $value
     */
    public static function nullableIntArrayOf(mixed $value, callable $callback, \Throwable|null $throwable = null): bool
    {
        if ($value === null) {
            return true;
        }

        if (!\is_array($value)) {
            return false;
        }

        foreach ($value as $k => $v) {
            if (!\is_int($k)) {
                return false;
            }
            $expected = $callback($v);

            if ($v !== $expected) {
                return false;
            }
        }

        return true;
    }

    /**
     * @template A
     * @template B of \BackedEnum
     *
     * @param A $value
     * @param class-string<B> $enum
     *
     * @phpstan-assert-if-true B|null $value
     */
    public static function nullableIntEnum(mixed $value, string $enum, \Throwable|null $throwable = null): bool
    {
        return $value === null || $value instanceof $enum;
    }

    /**
     * @template A
     *
     * @param A $value
     *
     * @phpstan-assert-if-true iterable<int, mixed>|null $value
     */
    public static function nullableIntIterable(mixed $value, \Throwable|null $throwable = null): bool
    {
        if ($value === null) {
            return true;
        }

        if (!\is_iterable($value)) {
            return false;
        }

        foreach ($value as $k => $v) {
            if (!\is_int($k)) {
                return false;
            }
        }

        return true;
    }

    /**
     * @template A
     * @template B
     *
     * @param A $value
     * @param callable(mixed): B $callback
     *
     * @phpstan-assert-if-true iterable<int, B>|null $value
     */
    public static function nullableIntIterableOf(mixed $value, callable $callback, \Throwable|null $throwable = null): bool
    {
        if ($value === null) {
            return true;
        }

        if (!\is_iterable($value)) {
            return false;
        }

        foreach ($value as $k => $v) {
            if (!\is_int($k)) {
                return false;
            }

            $expected = $callback($v);

            if ($v !== $expected) {
                return false;
            }
        }

        return true;
    }

    /**
     * @template A
     *
     * @param A $value
     *
     * @phpstan-assert-if-true interface-string|null $value
     */
    public static function nullableInterfaceString(mixed $value, \Throwable|null $throwable = null): bool
    {
        return $value === null || \is_string($value) && \interface_exists($value);
    }

    /**
     * @template A
     *
     * @param A $value
     *
     * @phpstan-assert-if-true iterable<int|string, mixed>|null $value
     */
    public static function nullableIterable(mixed $value, \Throwable|null $throwable = null): bool
    {
        return $value === null || \is_iterable($value);
    }

    /**
     * @template A
     * @template B
     *
     * @param A $value
     * @param callable(mixed): B $callback
     *
     * @phpstan-assert-if-true iterable<int|string, B>|null $value
     */
    public static function nullableIterableOf(mixed $value, callable $callback, \Throwable|null $throwable = null): bool
    {
        if ($value === null) {
            return true;
        }

        if (!\is_iterable($value)) {
            return false;
        }

        foreach ($value as $v) {
            $expected = $callback($v);

            if ($v !== $expected) {
                return false;
            }
        }

        return true;
    }

    /**
     * @template A
     *
     * @param A $value
     *
     * @phpstan-assert-if-true list<mixed>|null $value
     */
    public static function nullableList(mixed $value, \Throwable|null $throwable = null): bool
    {
        return $value === null || \is_array($value) && \array_is_list($value);
    }

    /**
     * @template A
     * @template B
     *
     * @param A $value
     * @param callable(mixed): B $callback
     *
     * @phpstan-assert-if-true list<B>|null $value
     */
    public static function nullableListOf(mixed $value, callable $callback, \Throwable|null $throwable = null): bool
    {
        if ($value === null) {
            return true;
        }

        if (!\is_array($value)) {
            return false;
        }

        if (!\array_is_list($value)) {
            return false;
        }

        foreach ($value as $v) {
            $expected = $callback($v);

            if ($v !== $expected) {
                return false;
            }
        }

        return true;
    }

    /**
     * @template A
     *
     * @param A $value
     *
     * @phpstan-assert-if-true negative-int|null $value
     */
    public static function nullableNegativeInt(mixed $value, \Throwable|null $throwable = null): bool
    {
        return $value === null || \is_int($value) && $value < 0;
    }

    /**
     * @template A
     *
     * @param A $value
     *
     * @phpstan-assert-if-true non-empty-array<int|string, mixed>|null $value
     */
    public static function nullableNonEmptyArray(mixed $value, \Throwable|null $throwable = null): bool
    {
        return $value === null || \is_array($value) && $value !== [];
    }

    /**
     * @template A
     * @template B
     *
     * @param A $value
     * @param callable(mixed): B $callback
     *
     * @phpstan-assert-if-true non-empty-array<int|string, B>|null $value
     */
    public static function nullableNonEmptyArrayOf(mixed $value, callable $callback, \Throwable|null $throwable = null): bool
    {
        if ($value === null) {
            return true;
        }

        if (!\is_array($value)) {
            return false;
        }

        if ($value === []) {
            return false;
        }

        foreach ($value as $v) {
            $expected = $callback($v);

            if ($v !== $expected) {
                return false;
            }
        }

        return true;
    }

    /**
     * @template A
     *
     * @param A $value
     *
     * @phpstan-assert-if-true non-empty-array<int, mixed>|null $value
     */
    public static function nullableNonEmptyIntArray(mixed $value, \Throwable|null $throwable = null): bool
    {
        if ($value === null) {
            return true;
        }

        if (!\is_array($value)) {
            return false;
        }

        if ($value === []) {
            return false;
        }

        foreach ($value as $k => $v) {
            if (!\is_int($k)) {
                return false;
            }
        }

        return true;
    }

    /**
     * @template A
     * @template B
     *
     * @param A $value
     * @param callable(mixed): B $callback
     *
     * @phpstan-assert-if-true non-empty-array<int, B>|null $value
     */
    public static function nullableNonEmptyIntArrayOf(mixed $value, callable $callback, \Throwable|null $throwable = null): bool
    {
        if ($value === null) {
            return true;
        }

        if (!\is_array($value)) {
            return false;
        }

        if ($value === []) {
            return false;
        }

        foreach ($value as $k => $v) {
            if (!\is_int($k)) {
                return false;
            }

            $expected = $callback($v);

            if ($v !== $expected) {
                return false;
            }
        }

        return true;
    }

    /**
     * @template A
     *
     * @param A $value
     *
     * @phpstan-assert-if-true non-empty-list<mixed>|null $value
     */
    public static function nullableNonEmptyList(mixed $value, \Throwable|null $throwable = null): bool
    {
        return $value === null || \is_array($value) && $value !== [] && \array_is_list($value);
    }

    /**
     * @template A
     * @template B
     *
     * @param A $value
     * @param callable(mixed): B $callback
     *
     * @phpstan-assert-if-true non-empty-list<B>|null $value
     */
    public static function nullableNonEmptyListOf(mixed $value, callable $callback, \Throwable|null $throwable = null): bool
    {
        if ($value === null) {
            return true;
        }

        if (!\is_array($value)) {
            return false;
        }

        if ($value === []) {
            return false;
        }

        if (!\array_is_list($value)) {
            return false;
        }

        foreach ($value as $v) {
            $expected = $callback($v);

            if ($v !== $expected) {
                return false;
            }
        }

        return true;
    }

    /**
     * @template A
     *
     * @param A $value
     *
     * @phpstan-assert-if-true non-empty-string|null $value
     */
    public static function nullableNonEmptyString(mixed $value, \Throwable|null $throwable = null): bool
    {
        return $value === null || \is_string($value) && $value !== '';
    }

    /**
     * @template A
     *
     * @param A $value
     *
     * @phpstan-assert-if-true non-empty-array<string, mixed>|null $value
     */
    public static function nullableNonEmptyStringArray(mixed $value, \Throwable|null $throwable = null): bool
    {
        if ($value === null) {
            return true;
        }

        if (!\is_array($value)) {
            return false;
        }

        if ($value === []) {
            return false;
        }

        foreach ($value as $k => $v) {
            if (!\is_string($k)) {
                return false;
            }
        }

        return true;
    }

    /**
     * @template A
     * @template B
     *
     * @param A $value
     * @param callable(mixed): B $callback
     *
     * @phpstan-assert-if-true non-empty-array<string, B>|null $value
     */
    public static function nullableNonEmptyStringArrayOf(mixed $value, callable $callback, \Throwable|null $throwable = null): bool
    {
        if ($value === null) {
            return true;
        }

        if (!\is_array($value)) {
            return false;
        }

        if ($value === []) {
            return false;
        }

        foreach ($value as $k => $v) {
            if (!\is_string($k)) {
                return false;
            }

            $expected = $callback($v);

            if ($v !== $expected) {
                return false;
            }
        }

        return true;
    }

    /**
     * @template A
     *
     * @param A $value
     *
     * @phpstan-assert-if-true non-falsy-string|null $value
     */
    public static function nullableNonFalsyString(mixed $value, \Throwable|null $throwable = null): bool
    {
        return $value === null || \is_string($value) && (bool) $value;
    }

    /**
     * @template A
     *
     * @param A $value
     *
     * @phpstan-assert-if-true non-negative-int|null $value
     */
    public static function nullableNonNegativeInt(mixed $value, \Throwable|null $throwable = null): bool
    {
        return $value === null || \is_int($value) && $value >= 0;
    }

    /**
     * @template A
     *
     * @param A $value
     *
     * @phpstan-assert-if-true non-positive-int|null $value
     */
    public static function nullableNonPositiveInt(mixed $value, \Throwable|null $throwable = null): bool
    {
        return $value === null || \is_int($value) && $value <= 0;
    }

    /**
     * @template A
     *
     * @param A $value
     *
     * @phpstan-assert-if-true non-zero-int|null $value
     */
    public static function nullableNonZeroInt(mixed $value, \Throwable|null $throwable = null): bool
    {
        return $value === null || \is_int($value) && $value !== 0;
    }

    /**
     * @template A
     *
     * @param A $value
     *
     * @phpstan-assert-if-true numeric|null $value
     */
    public static function nullableNumeric(mixed $value, \Throwable|null $throwable = null): bool
    {
        return $value === null || \is_numeric($value);
    }

    /**
     * @template A
     *
     * @param A $value
     *
     * @phpstan-assert-if-true numeric-string|null $value
     */
    public static function nullableNumericString(mixed $value, \Throwable|null $throwable = null): bool
    {
        return $value === null || \is_string($value) && \is_numeric($value);
    }

    /**
     * @template A
     *
     * @param A $value
     *
     * @phpstan-assert-if-true object|null $value
     */
    public static function nullableObject(mixed $value, \Throwable|null $throwable = null): bool
    {
        return $value === null || \is_object($value);
    }

    /**
     * @template A
     *
     * @param A $value
     *
     * @phpstan-assert-if-true open-resource|null $value
     */
    public static function nullableOpenResource(mixed $value, \Throwable|null $throwable = null): bool
    {
        return $value === null || \is_resource($value);
    }

    /**
     * @template A
     *
     * @param A $value
     *
     * @phpstan-assert-if-true positive-int|null $value
     */
    public static function nullablePositiveInt(mixed $value, \Throwable|null $throwable = null): bool
    {
        return $value === null || \is_int($value) && $value > 0;
    }

    /**
     * @template A
     *
     * @param A $value
     *
     * @phpstan-assert-if-true resource|null $value
     */
    public static function nullableResource(mixed $value, \Throwable|null $throwable = null): bool
    {
        return $value === null || \is_resource($value) || (!\is_scalar($value) && !\is_array($value) && !\is_object($value));
    }

    /**
     * @template A
     *
     * @param A $value
     *
     * @phpstan-assert-if-true scalar|null $value
     */
    public static function nullableScalar(mixed $value, \Throwable|null $throwable = null): bool
    {
        return $value === null || \is_scalar($value);
    }

    /**
     * @template A
     *
     * @param A $value
     *
     * @phpstan-assert-if-true string|null $value
     */
    public static function nullableString(mixed $value, \Throwable|null $throwable = null): bool
    {
        return $value === null || \is_string($value);
    }

    /**
     * @template A
     *
     * @param A $value
     *
     * @phpstan-assert-if-true array<string, mixed>|null $value
     */
    public static function nullableStringArray(mixed $value, \Throwable|null $throwable = null): bool
    {
        if ($value === null) {
            return true;
        }

        if (!\is_array($value)) {
            return false;
        }

        foreach ($value as $k => $v) {
            if (!\is_string($k)) {
                return false;
            }
        }

        return true;
    }

    /**
     * @template A
     * @template B
     *
     * @param A $value
     * @param callable(mixed): B $callback
     *
     * @phpstan-assert-if-true array<string, B>|null $value
     */
    public static function nullableStringArrayOf(mixed $value, callable $callback, \Throwable|null $throwable = null): bool
    {
        if ($value === null) {
            return true;
        }

        if (!\is_array($value)) {
            return false;
        }

        foreach ($value as $k => $v) {
            if (!\is_string($k)) {
                return false;
            }

            $expected = $callback($v);

            if ($v !== $expected) {
                return false;
            }
        }

        return true;
    }

    /**
     * @template A
     * @template B of \BackedEnum
     *
     * @param A $value
     * @param class-string<B> $enum
     *
     * @phpstan-assert-if-true B|null $value
     */
    public static function nullableStringEnum(mixed $value, string $enum, \Throwable|null $throwable = null): bool
    {
        return $value === null || $value instanceof $enum;
    }

    /**
     * @template A
     *
     * @param A $value
     *
     * @phpstan-assert-if-true iterable<string, mixed>|null $value
     */
    public static function nullableStringIterable(mixed $value, \Throwable|null $throwable = null): bool
    {
        if ($value === null) {
            return true;
        }

        if (!\is_iterable($value)) {
            return false;
        }

        foreach ($value as $k => $v) {
            if (!\is_string($k)) {
                return false;
            }
        }

        return true;
    }

    /**
     * @template A
     * @template B
     *
     * @param A $value
     * @param callable(mixed): B $callback
     *
     * @phpstan-assert-if-true iterable<string, B>|null $value
     */
    public static function nullableStringIterableOf(mixed $value, callable $callback, \Throwable|null $throwable = null): bool
    {
        if ($value === null) {
            return true;
        }

        if (!\is_iterable($value)) {
            return false;
        }

        foreach ($value as $k => $v) {
            if (!\is_string($k)) {
                return false;
            }

            $expected = $callback($v);

            if ($v !== $expected) {
                return false;
            }
        }

        return true;
    }

    /**
     * @template A
     *
     * @param A $value
     *
     * @phpstan-assert-if-true scalar|\Stringable|null $value
     */
    public static function nullableStringable(mixed $value, \Throwable|null $throwable = null): bool
    {
        return $value === null || \is_scalar($value) || $value instanceof \Stringable;
    }

    /**
     * @template A
     *
     * @param A $value
     *
     * @phpstan-assert-if-true trait-string|null $value
     */
    public static function nullableTraitString(mixed $value, \Throwable|null $throwable = null): bool
    {
        return $value === null || \is_string($value) && \trait_exists($value);
    }

    /**
     * @template A
     *
     * @param A $value
     *
     * @phpstan-assert-if-true true|null $value
     */
    public static function nullableTrue(mixed $value, \Throwable|null $throwable = null): bool
    {
        return $value === null || $value === true;
    }

    /**
     * @template A
     *
     * @param A $value
     *
     * @phpstan-assert-if-true numeric $value
     */
    public static function numeric(mixed $value, \Throwable|null $throwable = null): bool
    {
        return \is_numeric($value);
    }

    /**
     * @template A
     *
     * @param A $value
     *
     * @phpstan-assert-if-true numeric-string $value
     */
    public static function numericString(mixed $value, \Throwable|null $throwable = null): bool
    {
        return \is_string($value) && \is_numeric($value);
    }

    /**
     * @template A
     *
     * @param A $value
     *
     * @phpstan-assert-if-true object $value
     */
    public static function object(mixed $value, \Throwable|null $throwable = null): bool
    {
        return \is_object($value);
    }

    /**
     * @template A
     *
     * @param A $value
     *
     * @phpstan-assert-if-true open-resource $value
     */
    public static function openResource(mixed $value, \Throwable|null $throwable = null): bool
    {
        return \is_resource($value);
    }

    /**
     * @template A
     *
     * @param A $value
     *
     * @phpstan-assert-if-true positive-int $value
     */
    public static function positiveInt(mixed $value, \Throwable|null $throwable = null): bool
    {
        return \is_int($value) && $value > 0;
    }

    /**
     * @template A
     *
     * @param A $value
     *
     * @phpstan-assert-if-true resource $value
     */
    public static function resource(mixed $value, \Throwable|null $throwable = null): bool
    {
        return \is_resource($value) || ($value !== null && !\is_scalar($value) && !\is_array($value) && !\is_object($value));
    }

    /**
     * @template A
     *
     * @param A $value
     *
     * @phpstan-assert-if-true scalar $value
     */
    public static function scalar(mixed $value, \Throwable|null $throwable = null): bool
    {
        return \is_scalar($value);
    }

    /**
     * @template A
     *
     * @param A $value
     *
     * @phpstan-assert-if-true string $value
     */
    public static function string(mixed $value, \Throwable|null $throwable = null): bool
    {
        return \is_string($value);
    }

    /**
     * @template A
     *
     * @param A $value
     *
     * @phpstan-assert-if-true array<string, mixed> $value
     */
    public static function stringArray(mixed $value, \Throwable|null $throwable = null): bool
    {
        if (!\is_array($value)) {
            return false;
        }

        foreach ($value as $k => $v) {
            if (!\is_string($k)) {
                return false;
            }
        }

        return true;
    }

    /**
     * @template A
     * @template B
     *
     * @param A $value
     * @param callable(mixed): B $callback
     *
     * @phpstan-assert-if-true array<string, B> $value
     */
    public static function stringArrayOf(mixed $value, callable $callback, \Throwable|null $throwable = null): bool
    {
        if (!\is_array($value)) {
            return false;
        }

        foreach ($value as $k => $v) {
            if (!\is_string($k)) {
                return false;
            }

            $expected = $callback($v);

            if ($v !== $expected) {
                return false;
            }
        }

        return true;
    }

    /**
     * @template A
     * @template B of \BackedEnum
     *
     * @param A $value
     * @param class-string<B> $enum
     *
     * @phpstan-assert-if-true B $value
     */
    public static function stringEnum(mixed $value, string $enum, \Throwable|null $throwable = null): bool
    {
        return $value instanceof $enum;
    }

    /**
     * @template A
     *
     * @param A $value
     *
     * @phpstan-assert-if-true iterable<string, mixed> $value
     */
    public static function stringIterable(mixed $value, \Throwable|null $throwable = null): bool
    {
        if (!\is_iterable($value)) {
            return false;
        }

        foreach ($value as $k => $v) {
            if (!\is_string($k)) {
                return false;
            }
        }

        return true;
    }

    /**
     * @template A
     * @template B
     *
     * @param A $value
     * @param callable(mixed): B $callback
     *
     * @phpstan-assert-if-true iterable<string, B> $value
     */
    public static function stringIterableOf(mixed $value, callable $callback, \Throwable|null $throwable = null): bool
    {
        if (!\is_iterable($value)) {
            return false;
        }

        foreach ($value as $k => $v) {
            if (!\is_string($k)) {
                return false;
            }
            $expected = $callback($v);

            if ($v !== $expected) {
                return false;
            }
        }

        return true;
    }

    /**
     * @template A
     *
     * @param A $value
     *
     * @phpstan-assert-if-true scalar|\Stringable $value
     */
    public static function stringable(mixed $value, \Throwable|null $throwable = null): bool
    {
        return \is_scalar($value) || $value instanceof \Stringable;
    }

    /**
     * @template A
     *
     * @param A $value
     *
     * @phpstan-assert-if-true trait-string $value
     */
    public static function traitString(mixed $value, \Throwable|null $throwable = null): bool
    {
        return \is_string($value) && \trait_exists($value);
    }

    /**
     * @template A
     *
     * @param A $value
     *
     * @phpstan-assert-if-true true $value
     */
    public static function true(mixed $value, \Throwable|null $throwable = null): bool
    {
        return $value === true;
    }
}
