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

use Premierstacks\PhpUtil\Debug\Debugf;
use Premierstacks\PhpUtil\Debug\Errorf;

class Assert
{
    /**
     * @template A
     * @template B of object
     *
     * @param A $value
     * @param class-string<B> $class
     *
     * @return A&class-string<B>
     *
     * @phpstan-assert class-string<B> $value
     */
    public static function a(mixed $value, string $class, \Throwable|null $throwable = null): string
    {
        \assert(
            \is_string($value) && \is_a($value, $class, true),
            $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', "class-string<{$class}>", $value)),
        );

        return $value;
    }

    /**
     * @template A
     *
     * @param A $value
     *
     * @return A&array<int|string, mixed>
     *
     * @phpstan-assert array<int|string, mixed> $value
     */
    public static function array(mixed $value, \Throwable|null $throwable = null): array
    {
        \assert(
            \is_array($value),
            $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'array<int|string, mixed>', $value)),
        );

        /** @phpstan-ignore-next-line */
        return $value;
    }

    /**
     * @template A
     *
     * @param A $value
     *
     * @return A&(int|string)
     *
     * @phpstan-assert int|string $value
     */
    public static function arrayKey(mixed $value, \Throwable|null $throwable = null): int|string
    {
        \assert(
            \is_int($value) || \is_string($value),
            $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'int|string', $value)),
        );

        return $value;
    }

    /**
     * @template A
     * @template B
     *
     * @param A $value
     * @param callable(mixed): B $callback
     *
     * @return A&array<int|string, B>
     *
     * @phpstan-assert array<int|string, B> $value
     */
    public static function arrayOf(mixed $value, callable $callback, \Throwable|null $throwable = null): array
    {
        \assert(
            (static function (mixed $value, callable $callback): bool {
                if (!\is_array($value)) {
                    return false;
                }

                foreach ($value as $v) {
                    $expected = $callback($v);

                    if ($v !== $expected) {
                        throw new \UnexpectedValueException(Errorf::unexpectedValue('iterable value', Debugf::type($expected), $v));
                    }
                }

                return true;
            })($value, $callback),
            $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'array<int|string, mixed>', $value)),
        );

        /** @phpstan-ignore-next-line */
        return $value;
    }

    /**
     * @template A
     *
     * @param A $value
     *
     * @return A&bool
     *
     * @phpstan-assert bool $value
     */
    public static function bool(mixed $value, \Throwable|null $throwable = null): bool
    {
        \assert(
            \is_bool($value),
            $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'bool', $value)),
        );

        return $value;
    }

    /**
     * @template A
     *
     * @param A $value
     *
     * @return A&callable(): mixed
     *
     * @phpstan-assert callable(): mixed $value
     */
    public static function callable(mixed $value, \Throwable|null $throwable = null): callable
    {
        \assert(
            \is_callable($value),
            $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'callable(): mixed', $value)),
        );

        return $value;
    }

    /**
     * @template A
     *
     * @param A $value
     *
     * @return A&callable(): mixed&string
     *
     * @phpstan-assert string&callable(): mixed $value
     */
    public static function callableString(mixed $value, \Throwable|null $throwable = null): string
    {
        \assert(
            \is_string($value) && \is_callable($value),
            $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'callable-string', $value)),
        );

        return $value;
    }

    /**
     * @template A
     *
     * @param A $value
     *
     * @return A&class-string
     *
     * @phpstan-assert class-string $value
     */
    public static function classString(mixed $value, \Throwable|null $throwable = null): string
    {
        \assert(
            \is_string($value) && \class_exists($value),
            $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'class-string', $value)),
        );

        return $value;
    }

    /**
     * @template A
     *
     * @param A $value
     *
     * @return A&closed-resource
     *
     * @phpstan-assert closed-resource $value
     */
    public static function closedResource(mixed $value, \Throwable|null $throwable = null): mixed
    {
        \assert(
            $value !== null && !\is_resource($value) && !\is_scalar($value) && !\is_array($value) && !\is_object($value),
            $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'closed-resource', $value)),
        );

        /** @phpstan-ignore-next-line */
        return $value;
    }

    /**
     * @template A
     *
     * @param A $value
     *
     * @return A&(\Countable|array<int|string, mixed>)
     *
     * @phpstan-assert array<int|string, mixed>|\Countable $value
     */
    public static function countable(mixed $value, \Throwable|null $throwable = null): \Countable|array
    {
        \assert(
            \is_countable($value),
            $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'countable', $value)),
        );

        /** @phpstan-ignore-next-line */
        return $value;
    }

    /**
     * @template A
     * @template B of \BackedEnum
     *
     * @param A $value
     * @param class-string<B> $enum
     *
     * @return A&B
     *
     * @phpstan-assert B $value
     */
    public static function enum(mixed $value, string $enum, \Throwable|null $throwable = null): \BackedEnum
    {
        \assert(
            $value instanceof $enum,
            $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', $enum, $value)),
        );

        return $value;
    }

    /**
     * @template A
     *
     * @param A $value
     *
     * @return A&false
     *
     * @phpstan-assert false $value
     */
    public static function false(mixed $value, \Throwable|null $throwable = null): false
    {
        \assert(
            $value === false,
            $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'false', $value)),
        );

        return $value;
    }

    /**
     * @template A
     *
     * @param A $value
     *
     * @return A&float
     *
     * @phpstan-assert float $value
     */
    public static function float(mixed $value, \Throwable|null $throwable = null): float
    {
        \assert(
            \is_float($value),
            $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'float', $value)),
        );

        return $value;
    }

    /**
     * @template A
     * @template B
     *
     * @param A $value
     * @param array<int|string, B> $enum
     *
     * @return A&B
     *
     * @phpstan-assert B $value
     */
    public static function in(mixed $value, array $enum, \Throwable|null $throwable = null): mixed
    {
        \assert(
            \in_array($value, $enum, true),
            $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', Debugf::types($enum), $value)),
        );

        return $value;
    }

    /**
     * @template A
     * @template B of object
     *
     * @param A $value
     * @param class-string<B> $class
     *
     * @return A&B
     *
     * @phpstan-assert B $value
     */
    public static function instance(mixed $value, string $class, \Throwable|null $throwable = null): object
    {
        \assert(
            $value instanceof $class,
            $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', $class, $value)),
        );

        return $value;
    }

    /**
     * @template A
     *
     * @param A $value
     *
     * @return A&int
     *
     * @phpstan-assert int $value
     */
    public static function int(mixed $value, \Throwable|null $throwable = null): int
    {
        \assert(
            \is_int($value),
            $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'int', $value)),
        );

        return $value;
    }

    /**
     * @template A
     *
     * @param A $value
     *
     * @return A&array<int, mixed>
     *
     * @phpstan-assert array<int, mixed> $value
     */
    public static function intArray(mixed $value, \Throwable|null $throwable = null): array
    {
        \assert(
            (static function (mixed $value): bool {
                if (!\is_array($value)) {
                    return false;
                }

                foreach ($value as $k => $v) {
                    if (!\is_int($k)) {
                        return false;
                    }
                }

                return true;
            })($value),
            $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'array<int, mixed>', $value)),
        );

        /** @phpstan-ignore-next-line */
        return $value;
    }

    /**
     * @template A
     * @template B
     *
     * @param A $value
     * @param callable(mixed): B $callback
     *
     * @return A&array<int, B>
     *
     * @phpstan-assert array<int, B> $value
     */
    public static function intArrayOf(mixed $value, callable $callback, \Throwable|null $throwable = null): array
    {
        \assert(
            (static function (mixed $value, callable $callback): bool {
                if (!\is_array($value)) {
                    return false;
                }

                foreach ($value as $k => $v) {
                    if (!\is_int($k)) {
                        return false;
                    }

                    $expected = $callback($v);

                    if ($v !== $expected) {
                        throw new \UnexpectedValueException(Errorf::unexpectedValue('iterable value', Debugf::type($expected), $v));
                    }
                }

                return true;
            })($value, $callback),
            $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'array<int, mixed>', $value)),
        );

        /** @phpstan-ignore-next-line */
        return $value;
    }

    /**
     * @template A
     * @template B of \BackedEnum
     *
     * @param A $value
     * @param class-string<B> $enum
     *
     * @return A&B
     *
     * @phpstan-assert B $value
     */
    public static function intEnum(mixed $value, string $enum, \Throwable|null $throwable = null): \BackedEnum
    {
        \assert(
            $value instanceof $enum,
            $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', $enum, $value)),
        );

        return $value;
    }

    /**
     * @template A
     *
     * @param A $value
     *
     * @return A&iterable<int, mixed>
     *
     * @phpstan-assert iterable<int, mixed> $value
     */
    public static function intIterable(mixed $value, \Throwable|null $throwable = null): iterable
    {
        \assert(
            (static function (mixed $value): bool {
                if (!\is_iterable($value)) {
                    return false;
                }

                foreach ($value as $k => $v) {
                    if (!\is_int($k)) {
                        return false;
                    }
                }

                return true;
            })($value),
            $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'iterable<int, mixed>', $value)),
        );

        /** @phpstan-ignore-next-line */
        return $value;
    }

    /**
     * @template A
     * @template B
     *
     * @param A $value
     * @param callable(mixed): B $callback
     *
     * @return A&iterable<int, B>
     *
     * @phpstan-assert iterable<int, B> $value
     */
    public static function intIterableOf(mixed $value, callable $callback, \Throwable|null $throwable = null): iterable
    {
        \assert(
            (static function (mixed $value, callable $callback): bool {
                if (!\is_iterable($value)) {
                    return false;
                }

                foreach ($value as $k => $v) {
                    if (!\is_int($k)) {
                        return false;
                    }

                    $expected = $callback($v);

                    if ($v !== $expected) {
                        throw new \UnexpectedValueException(Errorf::unexpectedValue('iterable value', Debugf::type($expected), $v));
                    }
                }

                return true;
            })($value, $callback),
            $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'iterable<int, mixed>', $value)),
        );

        /** @phpstan-ignore-next-line */
        return $value;
    }

    /**
     * @template A
     *
     * @param A $value
     *
     * @return A&interface-string
     *
     * @phpstan-assert interface-string $value
     */
    public static function interfaceString(mixed $value, \Throwable|null $throwable = null): string
    {
        \assert(
            \is_string($value) && \interface_exists($value),
            $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'interface-string', $value)),
        );

        return $value;
    }

    /**
     * @template A
     *
     * @param A $value
     *
     * @return A&iterable<int|string, mixed>
     *
     * @phpstan-assert iterable<int|string, mixed> $value
     */
    public static function iterable(mixed $value, \Throwable|null $throwable = null): iterable
    {
        \assert(
            \is_iterable($value),
            $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'iterable<int|string, mixed>', $value)),
        );

        /** @phpstan-ignore-next-line */
        return $value;
    }

    /**
     * @template A
     * @template B
     *
     * @param A $value
     * @param callable(mixed): B $callback
     *
     * @return A&iterable<int|string, B>
     *
     * @phpstan-assert iterable<int|string, B> $value
     */
    public static function iterableOf(mixed $value, callable $callback, \Throwable|null $throwable = null): iterable
    {
        \assert(
            (static function (mixed $value, callable $callback): bool {
                if (!\is_iterable($value)) {
                    return false;
                }

                foreach ($value as $v) {
                    $expected = $callback($v);

                    if ($v !== $expected) {
                        throw new \UnexpectedValueException(Errorf::unexpectedValue('iterable value', Debugf::type($expected), $v));
                    }
                }

                return true;
            })($value, $callback),
            $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'iterable<int|string, mixed>', $value)),
        );

        /** @phpstan-ignore-next-line */
        return $value;
    }

    /**
     * @template A
     *
     * @param A $value
     *
     * @return A&list<mixed>
     *
     * @phpstan-assert list<mixed> $value
     */
    public static function list(mixed $value, \Throwable|null $throwable = null): array
    {
        \assert(
            \is_array($value) && \array_is_list($value),
            $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'list<mixed>', $value)),
        );

        return $value;
    }

    /**
     * @template A
     * @template B
     *
     * @param A $value
     * @param callable(mixed): B $callback
     *
     * @return A&list<B>
     *
     * @phpstan-assert list<B> $value
     */
    public static function listOf(mixed $value, callable $callback, \Throwable|null $throwable = null): array
    {
        \assert(
            (static function (mixed $value, callable $callback): bool {
                if (!\is_array($value)) {
                    return false;
                }

                if (!\array_is_list($value)) {
                    return false;
                }

                foreach ($value as $v) {
                    $expected = $callback($v);

                    if ($v !== $expected) {
                        throw new \UnexpectedValueException(Errorf::unexpectedValue('iterable value', Debugf::type($expected), $v));
                    }
                }

                return true;
            })($value, $callback),
            $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'list<mixed>', $value)),
        );

        /** @phpstan-ignore-next-line */
        return $value;
    }

    /**
     * @template A
     *
     * @param A $value
     *
     * @return A&negative-int
     *
     * @phpstan-assert negative-int $value
     */
    public static function negativeInt(mixed $value, \Throwable|null $throwable = null): int
    {
        \assert(
            \is_int($value) && $value < 0,
            $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'negative-int', $value)),
        );

        return $value;
    }

    /**
     * @template A
     *
     * @param A $value
     *
     * @return A&non-empty-array<int|string, mixed>
     *
     * @phpstan-assert non-empty-array<int|string, mixed> $value
     */
    public static function nonEmptyArray(mixed $value, \Throwable|null $throwable = null): array
    {
        \assert(
            \is_array($value) && $value !== [],
            $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'non-empty-array<int|string, mixed>', $value)),
        );

        /** @phpstan-ignore-next-line */
        return $value;
    }

    /**
     * @template A
     * @template B
     *
     * @param A $value
     * @param callable(mixed): B $callback
     *
     * @return A&non-empty-array<int|string, B>
     *
     * @phpstan-assert non-empty-array<int|string, B> $value
     */
    public static function nonEmptyArrayOf(mixed $value, callable $callback, \Throwable|null $throwable = null): array
    {
        \assert(
            (static function (mixed $value, callable $callback): bool {
                if (!\is_array($value)) {
                    return false;
                }

                if ($value === []) {
                    return false;
                }

                foreach ($value as $v) {
                    $expected = $callback($v);

                    if ($v !== $expected) {
                        throw new \UnexpectedValueException(Errorf::unexpectedValue('iterable value', Debugf::type($expected), $v));
                    }
                }

                return true;
            })($value, $callback),
            $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'non-empty-array<int|string, mixed>', $value)),
        );

        /** @phpstan-ignore-next-line */
        return $value;
    }

    /**
     * @template A
     *
     * @param A $value
     *
     * @return A&non-empty-array<int, mixed>
     *
     * @phpstan-assert non-empty-array<int, mixed> $value
     */
    public static function nonEmptyIntArray(mixed $value, \Throwable|null $throwable = null): array
    {
        \assert(
            (static function (mixed $value): bool {
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
            })($value),
            $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'non-empty-array<int, mixed>', $value)),
        );

        /** @phpstan-ignore-next-line */
        return $value;
    }

    /**
     * @template A
     * @template B
     *
     * @param A $value
     * @param callable(mixed): B $callback
     *
     * @return A&non-empty-array<int, B>
     *
     * @phpstan-assert non-empty-array<int, B> $value
     */
    public static function nonEmptyIntArrayOf(mixed $value, callable $callback, \Throwable|null $throwable = null): array
    {
        \assert(
            (static function (mixed $value, callable $callback): bool {
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
                        throw new \UnexpectedValueException(Errorf::unexpectedValue('iterable value', Debugf::type($expected), $v));
                    }
                }

                return true;
            })($value, $callback),
            $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'non-empty-array<int, mixed>', $value)),
        );

        /** @phpstan-ignore-next-line */
        return $value;
    }

    /**
     * @template A
     *
     * @param A $value
     *
     * @return A&non-empty-list<mixed>
     *
     * @phpstan-assert non-empty-list<mixed> $value
     */
    public static function nonEmptyList(mixed $value, \Throwable|null $throwable = null): array
    {
        \assert(
            \is_array($value) && $value !== [] && \array_is_list($value),
            $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'non-empty-list<mixed>', $value)),
        );

        return $value;
    }

    /**
     * @template A
     * @template B
     *
     * @param A $value
     * @param callable(mixed): B $callback
     *
     * @return A&non-empty-list<B>
     *
     * @phpstan-assert non-empty-list<B> $value
     */
    public static function nonEmptyListOf(mixed $value, callable $callback, \Throwable|null $throwable = null): array
    {
        \assert(
            (static function (mixed $value, callable $callback): bool {
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
                        throw new \UnexpectedValueException(Errorf::unexpectedValue('iterable value', Debugf::type($expected), $v));
                    }
                }

                return true;
            })($value, $callback),
            $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'non-empty-list<mixed>', $value)),
        );

        /** @phpstan-ignore-next-line */
        return $value;
    }

    /**
     * @template A
     *
     * @param A $value
     *
     * @return A&non-empty-string
     *
     * @phpstan-assert non-empty-string $value
     */
    public static function nonEmptyString(mixed $value, \Throwable|null $throwable = null): string
    {
        \assert(
            \is_string($value) && $value !== '',
            $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'non-empty-string', $value)),
        );

        return $value;
    }

    /**
     * @template A
     *
     * @param A $value
     *
     * @return A&non-empty-array<string, mixed>
     *
     * @phpstan-assert non-empty-array<string, mixed> $value
     */
    public static function nonEmptyStringArray(mixed $value, \Throwable|null $throwable = null): array
    {
        \assert(
            (static function (mixed $value): bool {
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
            })($value),
            $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'non-empty-array<string, mixed>', $value)),
        );

        /** @phpstan-ignore-next-line */
        return $value;
    }

    /**
     * @template A
     * @template B
     *
     * @param A $value
     * @param callable(mixed): B $callback
     *
     * @return A&non-empty-array<string, B>
     *
     * @phpstan-assert non-empty-array<string, B> $value
     */
    public static function nonEmptyStringArrayOf(mixed $value, callable $callback, \Throwable|null $throwable = null): array
    {
        \assert(
            (static function (mixed $value, callable $callback): bool {
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
                        throw new \UnexpectedValueException(Errorf::unexpectedValue('iterable value', Debugf::type($expected), $v));
                    }
                }

                return true;
            })($value, $callback),
            $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'non-empty-array<string, mixed>', $value)),
        );

        /** @phpstan-ignore-next-line */
        return $value;
    }

    /**
     * @template A
     *
     * @param A $value
     *
     * @return A&non-falsy-string
     *
     * @phpstan-assert non-falsy-string $value
     */
    public static function nonFalsyString(mixed $value, \Throwable|null $throwable = null): string
    {
        \assert(
            \is_string($value) && (bool) $value,
            $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'non-falsy-string', $value)),
        );

        /** @phpstan-ignore-next-line */
        return $value;
    }

    /**
     * @template A
     *
     * @param A $value
     *
     * @return A&non-negative-int
     *
     * @phpstan-assert non-negative-int $value
     */
    public static function nonNegativeInt(mixed $value, \Throwable|null $throwable = null): int
    {
        \assert(
            \is_int($value) && $value >= 0,
            $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'non-negative-int', $value)),
        );

        return $value;
    }

    /**
     * @template A
     *
     * @param A $value
     *
     * @return A&non-positive-int
     *
     * @phpstan-assert non-positive-int $value
     */
    public static function nonPositiveInt(mixed $value, \Throwable|null $throwable = null): int
    {
        \assert(
            \is_int($value) && $value <= 0,
            $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'non-positive-int', $value)),
        );

        return $value;
    }

    /**
     * @template A
     *
     * @param A $value
     *
     * @return A&non-zero-int
     *
     * @phpstan-assert non-zero-int $value
     */
    public static function nonZeroInt(mixed $value, \Throwable|null $throwable = null): int
    {
        \assert(
            \is_int($value) && $value !== 0,
            $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'non-zero-int', $value)),
        );

        return $value;
    }

    /**
     * @template A
     *
     * @param A $value
     *
     * @return A
     *
     * @phpstan-assert !false $value
     */
    public static function notFalse(mixed $value, \Throwable|null $throwable = null): mixed
    {
        \assert(
            $value !== false,
            $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', '!false', $value)),
        );

        return $value;
    }

    /**
     * @template A
     *
     * @param A $value
     *
     * @return A
     *
     * @phpstan-assert !-1 $value
     */
    public static function notNegativeOne(mixed $value, \Throwable|null $throwable = null): mixed
    {
        \assert(
            $value !== -1,
            $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', '!-1', $value)),
        );

        return $value;
    }

    /**
     * @template A
     *
     * @param A $value
     *
     * @return A
     *
     * @phpstan-assert !null $value
     */
    public static function notNull(mixed $value, \Throwable|null $throwable = null): mixed
    {
        \assert(
            $value !== null,
            $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', '!null', $value)),
        );

        return $value;
    }

    /**
     * @template A
     *
     * @param A $value
     *
     * @return A
     *
     * @phpstan-assert !1 $value
     */
    public static function notPositiveOne(mixed $value, \Throwable|null $throwable = null): mixed
    {
        \assert(
            $value !== 1,
            $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', '!1', $value)),
        );

        return $value;
    }

    /**
     * @template A
     *
     * @param A $value
     *
     * @return A
     *
     * @phpstan-assert !true $value
     */
    public static function notTrue(mixed $value, \Throwable|null $throwable = null): mixed
    {
        \assert(
            $value !== true,
            $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', '!true', $value)),
        );

        return $value;
    }

    /**
     * @template A
     *
     * @param A $value
     *
     * @return A
     *
     * @phpstan-assert !0 $value
     */
    public static function notZero(mixed $value, \Throwable|null $throwable = null): mixed
    {
        \assert(
            $value !== 0,
            $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', '!0', $value)),
        );

        return $value;
    }

    /**
     * @template A
     *
     * @param A $value
     *
     * @return A&null
     *
     * @phpstan-assert null $value
     */
    public static function null(mixed $value, \Throwable|null $throwable = null): null
    {
        \assert(
            $value === null,
            $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'null', $value)),
        );

        return $value;
    }

    /**
     * @template A
     * @template B of object
     *
     * @param A $value
     * @param class-string<B> $class
     *
     * @return A&(class-string<B>|null)
     *
     * @phpstan-assert class-string<B>|null $value
     */
    public static function nullableA(mixed $value, string $class, \Throwable|null $throwable = null): string|null
    {
        \assert(
            $value === null || (\is_string($value) && \is_a($value, $class, true)),
            $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', "class-string<{$class}>|null", $value)),
        );

        return $value;
    }

    /**
     * @template A
     *
     * @param A $value
     *
     * @return A&(array<int|string, mixed>|null)
     *
     * @phpstan-assert array<int|string, mixed>|null $value
     */
    public static function nullableArray(mixed $value, \Throwable|null $throwable = null): array|null
    {
        \assert(
            $value === null || \is_array($value),
            $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'array<int|string, mixed>|null', $value)),
        );

        /** @phpstan-ignore-next-line */
        return $value;
    }

    /**
     * @template A
     *
     * @param A $value
     *
     * @return A&(int|string|null)
     *
     * @phpstan-assert int|string|null $value
     */
    public static function nullableArrayKey(mixed $value, \Throwable|null $throwable = null): int|string|null
    {
        \assert(
            $value === null || \is_int($value) || \is_string($value),
            $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'int|string|null', $value)),
        );

        return $value;
    }

    /**
     * @template A
     * @template B
     *
     * @param A $value
     * @param callable(mixed): B $callback
     *
     * @return A&(array<int|string, B>|null)
     *
     * @phpstan-assert array<int|string, B>|null $value
     */
    public static function nullableArrayOf(mixed $value, callable $callback, \Throwable|null $throwable = null): array|null
    {
        \assert(
            (static function (mixed $value, callable $callback): bool {
                if ($value === null) {
                    return true;
                }

                if (!\is_array($value)) {
                    return false;
                }

                foreach ($value as $v) {
                    $expected = $callback($v);

                    if ($v !== $expected) {
                        throw new \UnexpectedValueException(Errorf::unexpectedValue('iterable value', Debugf::type($expected), $v));
                    }
                }

                return true;
            })($value, $callback),
            $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'array<int|string, mixed>|null', $value)),
        );

        /** @phpstan-ignore-next-line */
        return $value;
    }

    /**
     * @template A
     *
     * @param A $value
     *
     * @return A&(bool|null)
     *
     * @phpstan-assert bool|null $value
     */
    public static function nullableBool(mixed $value, \Throwable|null $throwable = null): bool|null
    {
        \assert(
            $value === null || \is_bool($value),
            $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'bool|null', $value)),
        );

        return $value;
    }

    /**
     * @template A
     *
     * @param A $value
     *
     * @return A&(callable(): mixed|null)
     *
     * @phpstan-assert callable(): mixed|null $value
     */
    public static function nullableCallable(mixed $value, \Throwable|null $throwable = null): callable|null
    {
        \assert(
            $value === null || \is_callable($value),
            $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'callable(): mixed|null', $value)),
        );

        return $value;
    }

    /**
     * @template A
     *
     * @param A $value
     *
     * @return A&((callable(): mixed&string)|null)
     *
     * @phpstan-assert (string&callable(): mixed)|null $value
     */
    public static function nullableCallableString(mixed $value, \Throwable|null $throwable = null): string|null
    {
        \assert(
            $value === null || \is_string($value) && \is_callable($value),
            $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'callable-string|null', $value)),
        );

        return $value;
    }

    /**
     * @template A
     *
     * @param A $value
     *
     * @return A&(class-string|null)
     *
     * @phpstan-assert class-string|null $value
     */
    public static function nullableClassString(mixed $value, \Throwable|null $throwable = null): string|null
    {
        \assert(
            $value === null || \is_string($value) && \class_exists($value),
            $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'class-string|null', $value)),
        );

        return $value;
    }

    /**
     * @template A
     *
     * @param A $value
     *
     * @return A&(closed-resource|null)
     *
     * @phpstan-assert closed-resource|null $value
     */
    public static function nullableClosedResource(mixed $value, \Throwable|null $throwable = null): mixed
    {
        \assert(
            $value === null || (!\is_scalar($value) && !\is_resource($value) && !\is_array($value) && !\is_object($value)),
            $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'closed-resource|null', $value)),
        );

        /** @phpstan-ignore-next-line */
        return $value;
    }

    /**
     * @template A
     *
     * @param A $value
     *
     * @return A&(\Countable|array<int|string, mixed>|null)
     *
     * @phpstan-assert array<int|string, mixed>|\Countable|null $value
     */
    public static function nullableCountable(mixed $value, \Throwable|null $throwable = null): \Countable|array|null
    {
        \assert(
            $value === null || \is_countable($value),
            $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'countable|null', $value)),
        );

        /** @phpstan-ignore-next-line */
        return $value;
    }

    /**
     * @template A
     * @template B of \BackedEnum
     *
     * @param A $value
     * @param class-string<B> $enum
     *
     * @return A&(B|null)
     *
     * @phpstan-assert B|null $value
     */
    public static function nullableEnum(mixed $value, string $enum, \Throwable|null $throwable = null): \BackedEnum|null
    {
        \assert(
            $value === null || $value instanceof $enum,
            $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', "{$enum}|null", $value)),
        );

        return $value;
    }

    /**
     * @template A
     *
     * @param A $value
     *
     * @return A&(false|null)
     *
     * @phpstan-assert false|null $value
     */
    public static function nullableFalse(mixed $value, \Throwable|null $throwable = null): false|null
    {
        \assert(
            $value === null || $value === false,
            $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'false|null', $value)),
        );

        return $value;
    }

    /**
     * @template A
     *
     * @param A $value
     *
     * @return A&(float|null)
     *
     * @phpstan-assert float|null $value
     */
    public static function nullableFloat(mixed $value, \Throwable|null $throwable = null): float|null
    {
        \assert(
            $value === null || \is_float($value),
            $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'float|null', $value)),
        );

        return $value;
    }

    /**
     * @template A
     * @template B
     *
     * @param A $value
     * @param array<int|string, B> $enum
     *
     * @return A&(B|null)
     *
     * @phpstan-assert B|null $value
     */
    public static function nullableIn(mixed $value, array $enum, \Throwable|null $throwable = null): mixed
    {
        \assert(
            $value === null || \in_array($value, $enum, true),
            $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', Debugf::types($enum) . '|null', $value)),
        );

        return $value;
    }

    /**
     * @template A
     * @template B of object
     *
     * @param A $value
     * @param class-string<B> $class
     *
     * @return A&(B|null)
     *
     * @phpstan-assert B|null $value
     */
    public static function nullableInstance(mixed $value, string $class, \Throwable|null $throwable = null): object|null
    {
        \assert(
            $value === null || $value instanceof $class,
            $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', "{$class}|null", $value)),
        );

        return $value;
    }

    /**
     * @template A
     *
     * @param A $value
     *
     * @return A&(int|null)
     *
     * @phpstan-assert int|null $value
     */
    public static function nullableInt(mixed $value, \Throwable|null $throwable = null): int|null
    {
        \assert(
            $value === null || \is_int($value),
            $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'int|null', $value)),
        );

        return $value;
    }

    /**
     * @template A
     *
     * @param A $value
     *
     * @return A&(array<int, mixed>|null)
     *
     * @phpstan-assert array<int, mixed>|null $value
     */
    public static function nullableIntArray(mixed $value, \Throwable|null $throwable = null): array|null
    {
        \assert(
            (static function (mixed $value): bool {
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
            })($value),
            $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'array<int, mixed>|null', $value)),
        );

        /** @phpstan-ignore-next-line */
        return $value;
    }

    /**
     * @template A
     * @template B
     *
     * @param A $value
     * @param callable(mixed): B $callback
     *
     * @return A&(array<int, B>|null)
     *
     * @phpstan-assert array<int, B>|null $value
     */
    public static function nullableIntArrayOf(mixed $value, callable $callback, \Throwable|null $throwable = null): array|null
    {
        \assert(
            (static function (mixed $value, callable $callback): bool {
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
                        throw new \UnexpectedValueException(Errorf::unexpectedValue('iterable value', Debugf::type($expected), $v));
                    }
                }

                return true;
            })($value, $callback),
            $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'array<int, mixed>|null', $value)),
        );

        /** @phpstan-ignore-next-line */
        return $value;
    }

    /**
     * @template A
     * @template B of \BackedEnum
     *
     * @param A $value
     * @param class-string<B> $enum
     *
     * @return A&(B|null)
     *
     * @phpstan-assert B|null $value
     */
    public static function nullableIntEnum(mixed $value, string $enum, \Throwable|null $throwable = null): \BackedEnum|null
    {
        \assert(
            $value === null || $value instanceof $enum,
            $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', "{$enum}|null", $value)),
        );

        return $value;
    }

    /**
     * @template A
     *
     * @param A $value
     *
     * @return A&(iterable<int, mixed>|null)
     *
     * @phpstan-assert iterable<int, mixed>|null $value
     */
    public static function nullableIntIterable(mixed $value, \Throwable|null $throwable = null): iterable|null
    {
        \assert(
            (static function (mixed $value): bool {
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
            })($value),
            $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'iterable<int, mixed>|null', $value)),
        );

        /** @phpstan-ignore-next-line */
        return $value;
    }

    /**
     * @template A
     * @template B
     *
     * @param A $value
     * @param callable(mixed): B $callback
     *
     * @return A&(iterable<int, B>|null)
     *
     * @phpstan-assert iterable<int, B>|null $value
     */
    public static function nullableIntIterableOf(mixed $value, callable $callback, \Throwable|null $throwable = null): iterable|null
    {
        \assert(
            (static function (mixed $value, callable $callback): bool {
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
                        throw new \UnexpectedValueException(Errorf::unexpectedValue('iterable value', Debugf::type($expected), $v));
                    }
                }

                return true;
            })($value, $callback),
            $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'iterable<int, mixed>|null', $value)),
        );

        /** @phpstan-ignore-next-line */
        return $value;
    }

    /**
     * @template A
     *
     * @param A $value
     *
     * @return A&(interface-string|null)
     *
     * @phpstan-assert interface-string|null $value
     */
    public static function nullableInterfaceString(mixed $value, \Throwable|null $throwable = null): string|null
    {
        \assert(
            $value === null || \is_string($value) && \interface_exists($value),
            $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'interface-string|null', $value)),
        );

        return $value;
    }

    /**
     * @template A
     *
     * @param A $value
     *
     * @return A&(iterable<int|string, mixed>|null)
     *
     * @phpstan-assert iterable<int|string, mixed>|null $value
     */
    public static function nullableIterable(mixed $value, \Throwable|null $throwable = null): iterable|null
    {
        \assert(
            $value === null || \is_iterable($value),
            $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'iterable<int|string, mixed>|null', $value)),
        );

        /** @phpstan-ignore-next-line */
        return $value;
    }

    /**
     * @template A
     * @template B
     *
     * @param A $value
     * @param callable(mixed): B $callback
     *
     * @return A&(iterable<int|string, B>|null)
     *
     * @phpstan-assert iterable<int|string, B>|null $value
     */
    public static function nullableIterableOf(mixed $value, callable $callback, \Throwable|null $throwable = null): iterable|null
    {
        \assert(
            (static function (mixed $value, callable $callback): bool {
                if ($value === null) {
                    return true;
                }

                if (!\is_iterable($value)) {
                    return false;
                }

                foreach ($value as $v) {
                    $expected = $callback($v);

                    if ($v !== $expected) {
                        throw new \UnexpectedValueException(Errorf::unexpectedValue('iterable value', Debugf::type($expected), $v));
                    }
                }

                return true;
            })($value, $callback),
            $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'iterable<int|string, mixed>|null', $value)),
        );

        /** @phpstan-ignore-next-line */
        return $value;
    }

    /**
     * @template A
     *
     * @param A $value
     *
     * @return A&(list<mixed>|null)
     *
     * @phpstan-assert list<mixed>|null $value
     */
    public static function nullableList(mixed $value, \Throwable|null $throwable = null): array|null
    {
        \assert(
            $value === null || \is_array($value) && \array_is_list($value),
            $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'list<mixed>|null', $value)),
        );

        return $value;
    }

    /**
     * @template A
     * @template B
     *
     * @param A $value
     * @param callable(mixed): B $callback
     *
     * @return A&(list<B>|null)
     *
     * @phpstan-assert list<B>|null $value
     */
    public static function nullableListOf(mixed $value, callable $callback, \Throwable|null $throwable = null): array|null
    {
        \assert(
            (static function (mixed $value, callable $callback): bool {
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
                        throw new \UnexpectedValueException(Errorf::unexpectedValue('iterable value', Debugf::type($expected), $v));
                    }
                }

                return true;
            })($value, $callback),
            $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'list<mixed>|null', $value)),
        );

        /** @phpstan-ignore-next-line */
        return $value;
    }

    /**
     * @template A
     *
     * @param A $value
     *
     * @return A&(negative-int|null)
     *
     * @phpstan-assert negative-int|null $value
     */
    public static function nullableNegativeInt(mixed $value, \Throwable|null $throwable = null): int|null
    {
        \assert(
            $value === null || \is_int($value) && $value < 0,
            $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'negative-int|null', $value)),
        );

        return $value;
    }

    /**
     * @template A
     *
     * @param A $value
     *
     * @return A&(non-empty-array<int|string, mixed>|null)
     *
     * @phpstan-assert non-empty-array<int|string, mixed>|null $value
     */
    public static function nullableNonEmptyArray(mixed $value, \Throwable|null $throwable = null): array|null
    {
        \assert(
            $value === null || \is_array($value) && $value !== [],
            $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'non-empty-array<int|string, mixed>|null', $value)),
        );

        /** @phpstan-ignore-next-line */
        return $value;
    }

    /**
     * @template A
     * @template B
     *
     * @param A $value
     * @param callable(mixed): B $callback
     *
     * @return A&(non-empty-array<int|string, B>|null)
     *
     * @phpstan-assert non-empty-array<int|string, B>|null $value
     */
    public static function nullableNonEmptyArrayOf(mixed $value, callable $callback, \Throwable|null $throwable = null): array|null
    {
        \assert(
            (static function (mixed $value, callable $callback): bool {
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
                        throw new \UnexpectedValueException(Errorf::unexpectedValue('iterable value', Debugf::type($expected), $v));
                    }
                }

                return true;
            })($value, $callback),
            $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'non-empty-array<int|string, mixed>|null', $value)),
        );

        /** @phpstan-ignore-next-line */
        return $value;
    }

    /**
     * @template A
     *
     * @param A $value
     *
     * @return A&(non-empty-array<int, mixed>|null)
     *
     * @phpstan-assert non-empty-array<int, mixed>|null $value
     */
    public static function nullableNonEmptyIntArray(mixed $value, \Throwable|null $throwable = null): array|null
    {
        \assert(
            (static function (mixed $value): bool {
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
            })($value),
            $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'non-empty-array<int, mixed>|null', $value)),
        );

        /** @phpstan-ignore-next-line */
        return $value;
    }

    /**
     * @template A
     * @template B
     *
     * @param A $value
     * @param callable(mixed): B $callback
     *
     * @return A&(non-empty-array<int, B>|null)
     *
     * @phpstan-assert non-empty-array<int, B>|null $value
     */
    public static function nullableNonEmptyIntArrayOf(mixed $value, callable $callback, \Throwable|null $throwable = null): array|null
    {
        \assert(
            (static function (mixed $value, callable $callback): bool {
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
                        throw new \UnexpectedValueException(Errorf::unexpectedValue('iterable value', Debugf::type($expected), $v));
                    }
                }

                return true;
            })($value, $callback),
            $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'non-empty-array<int, templatevv>|null', $value)),
        );

        /** @phpstan-ignore-next-line */
        return $value;
    }

    /**
     * @template A
     *
     * @param A $value
     *
     * @return A&(non-empty-list<mixed>|null)
     *
     * @phpstan-assert non-empty-list<mixed>|null $value
     */
    public static function nullableNonEmptyList(mixed $value, \Throwable|null $throwable = null): array|null
    {
        \assert(
            $value === null || \is_array($value) && $value !== [] && \array_is_list($value),
            $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'non-empty-list<mixed>|null', $value)),
        );

        return $value;
    }

    /**
     * @template A
     * @template B
     *
     * @param A $value
     * @param callable(mixed): B $callback
     *
     * @return A&(non-empty-list<B>|null)
     *
     * @phpstan-assert non-empty-list<B>|null $value
     */
    public static function nullableNonEmptyListOf(mixed $value, callable $callback, \Throwable|null $throwable = null): array|null
    {
        \assert(
            (static function (mixed $value, callable $callback): bool {
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
                        throw new \UnexpectedValueException(Errorf::unexpectedValue('iterable value', Debugf::type($expected), $v));
                    }
                }

                return true;
            })($value, $callback),
            $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'non-empty-list<mixed>|null', $value)),
        );

        /** @phpstan-ignore-next-line */
        return $value;
    }

    /**
     * @template A
     *
     * @param A $value
     *
     * @return A&(non-empty-string|null)
     *
     * @phpstan-assert non-empty-string|null $value
     */
    public static function nullableNonEmptyString(mixed $value, \Throwable|null $throwable = null): string|null
    {
        \assert(
            $value === null || \is_string($value) && $value !== '',
            $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'non-empty-string', $value)),
        );

        return $value;
    }

    /**
     * @template A
     *
     * @param A $value
     *
     * @return A&(non-empty-array<string, mixed>|null)
     *
     * @phpstan-assert non-empty-array<string, mixed>|null $value
     */
    public static function nullableNonEmptyStringArray(mixed $value, \Throwable|null $throwable = null): array|null
    {
        \assert(
            (static function (mixed $value): bool {
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
            })($value),
            $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'non-empty-array<string, mixed>|null', $value)),
        );

        /** @phpstan-ignore-next-line */
        return $value;
    }

    /**
     * @template A
     * @template B
     *
     * @param A $value
     * @param callable(mixed): B $callback
     *
     * @return A&(non-empty-array<string, B>|null)
     *
     * @phpstan-assert non-empty-array<string, B>|null $value
     */
    public static function nullableNonEmptyStringArrayOf(mixed $value, callable $callback, \Throwable|null $throwable = null): array|null
    {
        \assert(
            (static function (mixed $value, callable $callback): bool {
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
                        throw new \UnexpectedValueException(Errorf::unexpectedValue('iterable value', Debugf::type($expected), $v));
                    }
                }

                return true;
            })($value, $callback),
            $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'non-empty-array<string, mixed>|null', $value)),
        );

        /** @phpstan-ignore-next-line */
        return $value;
    }

    /**
     * @template A
     *
     * @param A $value
     *
     * @return A&(non-falsy-string|null)
     *
     * @phpstan-assert non-falsy-string|null $value
     */
    public static function nullableNonFalsyString(mixed $value, \Throwable|null $throwable = null): string|null
    {
        \assert(
            $value === null || \is_string($value) && (bool) $value,
            $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'non-falsy-string', $value)),
        );

        /** @phpstan-ignore-next-line */
        return $value;
    }

    /**
     * @template A
     *
     * @param A $value
     *
     * @return A&(non-negative-int|null)
     *
     * @phpstan-assert non-negative-int|null $value
     */
    public static function nullableNonNegativeInt(mixed $value, \Throwable|null $throwable = null): int|null
    {
        \assert(
            $value === null || \is_int($value) && $value >= 0,
            $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'non-negative-int|null', $value)),
        );

        return $value;
    }

    /**
     * @template A
     *
     * @param A $value
     *
     * @return A&(non-positive-int|null)
     *
     * @phpstan-assert non-positive-int|null $value
     */
    public static function nullableNonPositiveInt(mixed $value, \Throwable|null $throwable = null): int|null
    {
        \assert(
            $value === null || \is_int($value) && $value <= 0,
            $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'non-positive-int|null', $value)),
        );

        return $value;
    }

    /**
     * @template A
     *
     * @param A $value
     *
     * @return A&(non-zero-int|null)
     *
     * @phpstan-assert non-zero-int|null $value
     */
    public static function nullableNonZeroInt(mixed $value, \Throwable|null $throwable = null): int|null
    {
        \assert(
            $value === null || \is_int($value) && $value !== 0,
            $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'non-zero-int|null', $value)),
        );

        return $value;
    }

    /**
     * @template A
     *
     * @param A $value
     *
     * @return A&(numeric|null)
     *
     * @phpstan-assert numeric|null $value
     */
    public static function nullableNumeric(mixed $value, \Throwable|null $throwable = null): float|int|string|null
    {
        \assert(
            $value === null || \is_numeric($value),
            $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'numeric', $value)),
        );

        return $value;
    }

    /**
     * @template A
     *
     * @param A $value
     *
     * @return A&(numeric-string|null)
     *
     * @phpstan-assert numeric-string|null $value
     */
    public static function nullableNumericString(mixed $value, \Throwable|null $throwable = null): string|null
    {
        \assert(
            $value === null || \is_string($value) && \is_numeric($value),
            $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'numeric-string', $value)),
        );

        return $value;
    }

    /**
     * @template A
     *
     * @param A $value
     *
     * @return A&(object|null)
     *
     * @phpstan-assert object|null $value
     */
    public static function nullableObject(mixed $value, \Throwable|null $throwable = null): object|null
    {
        \assert(
            $value === null || \is_object($value),
            $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'object|null', $value)),
        );

        return $value;
    }

    /**
     * @template A
     *
     * @param A $value
     *
     * @return A&(open-resource|null)
     *
     * @phpstan-assert open-resource|null $value
     */
    public static function nullableOpenResource(mixed $value, \Throwable|null $throwable = null): mixed
    {
        \assert(
            $value === null || \is_resource($value),
            $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'open-resource|null', $value)),
        );

        return $value;
    }

    /**
     * @template A
     *
     * @param A $value
     *
     * @return A&(positive-int|null)
     *
     * @phpstan-assert positive-int|null $value
     */
    public static function nullablePositiveInt(mixed $value, \Throwable|null $throwable = null): int|null
    {
        \assert(
            $value === null || \is_int($value) && $value > 0,
            $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'positive-int|null', $value)),
        );

        return $value;
    }

    /**
     * @template A
     *
     * @param A $value
     *
     * @return A&(resource|null)
     *
     * @phpstan-assert resource|null $value
     */
    public static function nullableResource(mixed $value, \Throwable|null $throwable = null): mixed
    {
        \assert(
            $value === null || \is_resource($value) || (!\is_scalar($value) && !\is_array($value) && !\is_object($value)),
            $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'resource|null', $value)),
        );

        /** @phpstan-ignore-next-line */
        return $value;
    }

    /**
     * @template A
     *
     * @param A $value
     *
     * @return A&(scalar|null)
     *
     * @phpstan-assert scalar|null $value
     */
    public static function nullableScalar(mixed $value, \Throwable|null $throwable = null): bool|float|int|string|null
    {
        \assert(
            $value === null || \is_scalar($value),
            $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'scalar|null', $value)),
        );

        return $value;
    }

    /**
     * @template A
     *
     * @param A $value
     *
     * @return A&(string|null)
     *
     * @phpstan-assert string|null $value
     */
    public static function nullableString(mixed $value, \Throwable|null $throwable = null): string|null
    {
        \assert(
            $value === null || \is_string($value),
            $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'string|null', $value)),
        );

        return $value;
    }

    /**
     * @template A
     *
     * @param A $value
     *
     * @return A&(array<string, mixed>|null)
     *
     * @phpstan-assert array<string, mixed>|null $value
     */
    public static function nullableStringArray(mixed $value, \Throwable|null $throwable = null): array|null
    {
        \assert(
            (static function (mixed $value): bool {
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
            })($value),
            $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'array<string, mixed>|null', $value)),
        );

        /** @phpstan-ignore-next-line */
        return $value;
    }

    /**
     * @template A
     * @template B
     *
     * @param A $value
     * @param callable(mixed): B $callback
     *
     * @return A&(array<string, B>|null)
     *
     * @phpstan-assert array<string, B>|null $value
     */
    public static function nullableStringArrayOf(mixed $value, callable $callback, \Throwable|null $throwable = null): array|null
    {
        \assert(
            (static function (
                mixed $value,
                callable $callback,
            ): bool {
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
                        throw new \UnexpectedValueException(Errorf::unexpectedValue('iterable value', Debugf::type($expected), $v));
                    }
                }

                return true;
            })($value, $callback),
            $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'array<string, mixed>|null', $value)),
        );

        /** @phpstan-ignore-next-line */
        return $value;
    }

    /**
     * @template A
     * @template B of \BackedEnum
     *
     * @param A $value
     * @param class-string<B> $enum
     *
     * @return A&(B|null)
     *
     * @phpstan-assert B|null $value
     */
    public static function nullableStringEnum(mixed $value, string $enum, \Throwable|null $throwable = null): \BackedEnum|null
    {
        \assert(
            $value === null || $value instanceof $enum,
            $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', "{$enum}|null", $value)),
        );

        return $value;
    }

    /**
     * @template A
     *
     * @param A $value
     *
     * @return A&(iterable<string, mixed>|null)
     *
     * @phpstan-assert iterable<string, mixed>|null $value
     */
    public static function nullableStringIterable(mixed $value, \Throwable|null $throwable = null): iterable|null
    {
        \assert(
            (static function (mixed $value): bool {
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
            })($value),
            $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'iterable<string, mixed>|null', $value)),
        );

        /** @phpstan-ignore-next-line */
        return $value;
    }

    /**
     * @template A
     * @template B
     *
     * @param A $value
     * @param callable(mixed): B $callback
     *
     * @return A&(iterable<string, B>|null)
     *
     * @phpstan-assert iterable<string, B>|null $value
     */
    public static function nullableStringIterableOf(mixed $value, callable $callback, \Throwable|null $throwable = null): iterable|null
    {
        \assert(
            (static function (mixed $value, $callback): bool {
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
                        throw new \UnexpectedValueException(Errorf::unexpectedValue('iterable value', Debugf::type($expected), $v));
                    }
                }

                return true;
            })($value, $callback),
            $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'iterable<string, mixed>|null', $value)),
        );

        /** @phpstan-ignore-next-line */
        return $value;
    }

    /**
     * @template A
     *
     * @param A $value
     *
     * @return A&(\Stringable|scalar|null)
     *
     * @phpstan-assert scalar|\Stringable|null $value
     */
    public static function nullableStringable(mixed $value, \Throwable|null $throwable = null): \Stringable|bool|float|int|string|null
    {
        \assert(
            $value === null || \is_scalar($value) || $value instanceof \Stringable,
            $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'stringable|null', $value)),
        );

        return $value;
    }

    /**
     * @template A
     *
     * @param A $value
     *
     * @return A&(trait-string|null)
     *
     * @phpstan-assert trait-string|null $value
     */
    public static function nullableTraitString(mixed $value, \Throwable|null $throwable = null): string|null
    {
        \assert(
            $value === null || \is_string($value) && \trait_exists($value),
            $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'trait-string|null', $value)),
        );

        return $value;
    }

    /**
     * @template A
     *
     * @param A $value
     *
     * @return A&(true|null)
     *
     * @phpstan-assert true|null $value
     */
    public static function nullableTrue(mixed $value, \Throwable|null $throwable = null): true|null
    {
        \assert(
            $value === null || $value === true,
            $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'true|null', $value)),
        );

        return $value;
    }

    /**
     * @template A
     *
     * @param A $value
     *
     * @return A&numeric
     *
     * @phpstan-assert numeric $value
     */
    public static function numeric(mixed $value, \Throwable|null $throwable = null): float|int|string
    {
        \assert(
            \is_numeric($value),
            $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'numeric', $value)),
        );

        return $value;
    }

    /**
     * @template A
     *
     * @param A $value
     *
     * @return A&numeric-string
     *
     * @phpstan-assert numeric-string $value
     */
    public static function numericString(mixed $value, \Throwable|null $throwable = null): string
    {
        \assert(
            \is_string($value) && \is_numeric($value),
            $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'numeric-string', $value)),
        );

        return $value;
    }

    /**
     * @template A
     *
     * @param A $value
     *
     * @return A&object
     *
     * @phpstan-assert object $value
     */
    public static function object(mixed $value, \Throwable|null $throwable = null): object
    {
        \assert(
            \is_object($value),
            $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'object', $value)),
        );

        return $value;
    }

    /**
     * @template A
     *
     * @param A $value
     *
     * @return A&open-resource
     *
     * @phpstan-assert open-resource $value
     */
    public static function openResource(mixed $value, \Throwable|null $throwable = null): mixed
    {
        \assert(
            \is_resource($value),
            $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'open-resource', $value)),
        );

        return $value;
    }

    /**
     * @template A
     *
     * @param A $value
     *
     * @return A&positive-int
     *
     * @phpstan-assert positive-int $value
     */
    public static function positiveInt(mixed $value, \Throwable|null $throwable = null): int
    {
        \assert(
            \is_int($value) && $value > 0,
            $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'positive-int', $value)),
        );

        return $value;
    }

    /**
     * @template A
     *
     * @param A $value
     *
     * @return A&resource
     *
     * @phpstan-assert resource $value
     */
    public static function resource(mixed $value, \Throwable|null $throwable = null): mixed
    {
        \assert(
            \is_resource($value) || ($value !== null && !\is_scalar($value) && !\is_array($value) && !\is_object($value)),
            $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'resource', $value)),
        );

        /** @phpstan-ignore-next-line */
        return $value;
    }

    /**
     * @template A
     *
     * @param A $value
     *
     * @return A&(scalar)
     *
     * @phpstan-assert scalar $value
     */
    public static function scalar(mixed $value, \Throwable|null $throwable = null): bool|float|int|string
    {
        \assert(
            \is_scalar($value),
            $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'scalar', $value)),
        );

        return $value;
    }

    /**
     * @template A
     *
     * @param A $value
     *
     * @return A&string
     *
     * @phpstan-assert string $value
     */
    public static function string(mixed $value, \Throwable|null $throwable = null): string
    {
        \assert(
            \is_string($value),
            $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'string', $value)),
        );

        return $value;
    }

    /**
     * @template A
     *
     * @param A $value
     *
     * @return A&array<string, mixed>
     *
     * @phpstan-assert array<string, mixed> $value
     */
    public static function stringArray(mixed $value, \Throwable|null $throwable = null): array
    {
        \assert(
            (static function (mixed $value): bool {
                if (!\is_array($value)) {
                    return false;
                }

                foreach ($value as $k => $v) {
                    if (!\is_string($k)) {
                        return false;
                    }
                }

                return true;
            })($value),
            $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'array<string, mixed>', $value)),
        );

        /** @phpstan-ignore-next-line */
        return $value;
    }

    /**
     * @template A
     * @template B
     *
     * @param A $value
     * @param callable(mixed): B $callback
     *
     * @return A&array<string, B>
     *
     * @phpstan-assert array<string, B> $value
     */
    public static function stringArrayOf(mixed $value, callable $callback, \Throwable|null $throwable = null): array
    {
        \assert(
            (static function (mixed $value, callable $callback): bool {
                if (!\is_array($value)) {
                    return false;
                }

                foreach ($value as $k => $v) {
                    if (!\is_string($k)) {
                        return false;
                    }

                    $expected = $callback($v);

                    if ($v !== $expected) {
                        throw new \UnexpectedValueException(Errorf::unexpectedValue('iterable value', Debugf::type($expected), $v));
                    }
                }

                return true;
            })($value, $callback),
            $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'array<string, mixed>', $value)),
        );

        /** @phpstan-ignore-next-line */
        return $value;
    }

    /**
     * @template A
     * @template B of \BackedEnum
     *
     * @param A $value
     * @param class-string<B> $enum
     *
     * @return A&B
     *
     * @phpstan-assert B $value
     */
    public static function stringEnum(mixed $value, string $enum, \Throwable|null $throwable = null): \BackedEnum
    {
        \assert(
            $value instanceof $enum,
            $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', $enum, $value)),
        );

        return $value;
    }

    /**
     * @template A
     *
     * @param A $value
     *
     * @return A&iterable<string, mixed>
     *
     * @phpstan-assert iterable<string, mixed> $value
     */
    public static function stringIterable(mixed $value, \Throwable|null $throwable = null): iterable
    {
        \assert(
            (static function (mixed $value): bool {
                if (!\is_iterable($value)) {
                    return false;
                }

                foreach ($value as $k => $v) {
                    if (!\is_string($k)) {
                        return false;
                    }
                }

                return true;
            })($value),
            $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'iterable<string, mixed>', $value)),
        );

        /** @phpstan-ignore-next-line */
        return $value;
    }

    /**
     * @template A
     * @template B
     *
     * @param A $value
     * @param callable(mixed): B $callback
     *
     * @return A&iterable<string, B>
     *
     * @phpstan-assert iterable<string, B> $value
     */
    public static function stringIterableOf(mixed $value, callable $callback, \Throwable|null $throwable = null): iterable
    {
        \assert(
            (static function (mixed $value, callable $callback): bool {
                if (!\is_iterable($value)) {
                    return false;
                }

                foreach ($value as $k => $v) {
                    if (!\is_string($k)) {
                        return false;
                    }
                    $expected = $callback($v);

                    if ($v !== $expected) {
                        throw new \UnexpectedValueException(Errorf::unexpectedValue('iterable value', Debugf::type($expected), $v));
                    }
                }

                return true;
            })($value, $callback),
            $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'iterable<string, mixed>', $value)),
        );

        /** @phpstan-ignore-next-line */
        return $value;
    }

    /**
     * @template A
     *
     * @param A $value
     *
     * @return A&(\Stringable|scalar)
     *
     * @phpstan-assert scalar|\Stringable $value
     */
    public static function stringable(mixed $value, \Throwable|null $throwable = null): \Stringable|bool|float|int|string
    {
        \assert(
            \is_scalar($value) || $value instanceof \Stringable,
            $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'stringable', $value)),
        );

        return $value;
    }

    /**
     * @template A
     *
     * @param A $value
     *
     * @return A&trait-string
     *
     * @phpstan-assert trait-string $value
     */
    public static function traitString(mixed $value, \Throwable|null $throwable = null): string
    {
        \assert(
            \is_string($value) && \trait_exists($value),
            $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'trait-string', $value)),
        );

        return $value;
    }

    /**
     * @template A
     *
     * @param A $value
     *
     * @return A&true
     *
     * @phpstan-assert true $value
     */
    public static function true(mixed $value, \Throwable|null $throwable = null): true
    {
        \assert(
            $value === true,
            $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'true', $value)),
        );

        return $value;
    }
}
