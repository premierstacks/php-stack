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

namespace Premierstacks\PhpStack\Mixed;

use BackedEnum as B;
use Premierstacks\PhpStack\Debug\Debugf;
use Premierstacks\PhpStack\Debug\Errorf;

class Check
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
    public static function a(mixed $value, string $class, \Throwable|string|null $previous = null): string
    {
        if (\is_string($value) && \is_a($value, $class, true)) {
            return $value;
        }

        throw new \InvalidArgumentException(Errorf::invalidArgument('value', $value, "class-string<{$class}>", [], $previous));
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
    public static function array(mixed $value, \Throwable|string|null $previous = null): array
    {
        if (\is_array($value)) {
            /** @phpstan-ignore-next-line */
            return $value;
        }

        throw new \InvalidArgumentException(Errorf::invalidArgument('value', $value, 'array<int|string, mixed>', [], $previous));
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
    public static function arrayKey(mixed $value, \Throwable|string|null $previous = null): int|string
    {
        if (\is_int($value) || \is_string($value)) {
            return $value;
        }

        throw new \InvalidArgumentException(Errorf::invalidArgument('value', $value, 'int|string', [], $previous));
    }

    /**
     * @template A
     * @template B
     *
     * @param A $value
     * @param callable(array-key, mixed): B $callback
     *
     * @return A&array<int|string, B>
     *
     * @phpstan-assert array<int|string, B> $value
     */
    public static function arrayOf(mixed $value, callable $callback, \Throwable|string|null $previous = null): array
    {
        if (!\is_array($value)) {
            throw new \InvalidArgumentException(Errorf::invalidArgument('value', $value, 'array<int|string, mixed>', [], $previous));
        }

        foreach ($value as $k => $v) {
            $expected = $callback($k, $v);

            if ($v !== $expected) {
                throw new \UnexpectedValueException(Errorf::unexpectedVariableValue((string) $k, $v, Debugf::type($expected)));
            }
        }

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
    public static function bool(mixed $value, \Throwable|string|null $previous = null): bool
    {
        if (\is_bool($value)) {
            return $value;
        }

        throw new \InvalidArgumentException(Errorf::invalidArgument('value', $value, 'bool', [], $previous));
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
    public static function callable(mixed $value, \Throwable|string|null $previous = null): callable
    {
        if (\is_callable($value)) {
            return $value;
        }

        throw new \InvalidArgumentException(Errorf::invalidArgument('value', $value, 'callable(): mixed', [], $previous));
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
    public static function callableString(mixed $value, \Throwable|string|null $previous = null): string
    {
        if (\is_string($value) && \is_callable($value)) {
            return $value;
        }

        throw new \InvalidArgumentException(Errorf::invalidArgument('value', $value, 'callable-string', [], $previous));
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
    public static function classString(mixed $value, \Throwable|string|null $previous = null): string
    {
        if (\is_string($value) && \class_exists($value)) {
            return $value;
        }

        throw new \InvalidArgumentException(Errorf::invalidArgument('value', $value, 'class-string', [], $previous));
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
    public static function closedResource(mixed $value, \Throwable|string|null $previous = null): mixed
    {
        if ($value !== null && !\is_resource($value) && !\is_scalar($value) && !\is_array($value) && !\is_object($value)) {
            /** @phpstan-ignore-next-line */
            return $value;
        }

        throw new \InvalidArgumentException(Errorf::invalidArgument('value', $value, 'closed-resource', [], $previous));
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
    public static function countable(mixed $value, \Throwable|string|null $previous = null): \Countable|array
    {
        if (\is_countable($value)) {
            /** @phpstan-ignore-next-line */
            return $value;
        }

        throw new \InvalidArgumentException(Errorf::invalidArgument('value', $value, 'countable', [], $previous));
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
    public static function enum(mixed $value, string $enum, \Throwable|string|null $previous = null): \BackedEnum
    {
        if ($value instanceof $enum) {
            return $value;
        }

        throw new \InvalidArgumentException(Errorf::invalidArgument('value', $value, $enum, [], $previous));
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
    public static function false(mixed $value, \Throwable|string|null $previous = null): false
    {
        if ($value === false) {
            return $value;
        }

        throw new \InvalidArgumentException(Errorf::invalidArgument('value', $value, 'false', [], $previous));
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
    public static function float(mixed $value, \Throwable|string|null $previous = null): float
    {
        if (\is_float($value)) {
            return $value;
        }

        throw new \InvalidArgumentException(Errorf::invalidArgument('value', $value, 'float', [], $previous));
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
    public static function in(mixed $value, array $enum, \Throwable|string|null $previous = null): mixed
    {
        if (\in_array($value, $enum, true)) {
            return $value;
        }

        throw new \InvalidArgumentException(Errorf::invalidArgument('value', $value, $enum, [], $previous));
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
    public static function instance(mixed $value, string $class, \Throwable|string|null $previous = null): object
    {
        if ($value instanceof $class) {
            return $value;
        }

        throw new \InvalidArgumentException(Errorf::invalidArgument('value', $value, $class, [], $previous));
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
    public static function int(mixed $value, \Throwable|string|null $previous = null): int
    {
        if (\is_int($value)) {
            return $value;
        }

        throw new \InvalidArgumentException(Errorf::invalidArgument('value', $value, 'int', [], $previous));
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
    public static function intArray(mixed $value, \Throwable|string|null $previous = null): array
    {
        if (!\is_array($value)) {
            throw new \InvalidArgumentException(Errorf::invalidArgument('value', $value, 'array<int, mixed>', [], $previous));
        }

        foreach ($value as $k => $v) {
            if (!\is_int($k)) {
                throw new \InvalidArgumentException(Errorf::invalidArgument('value', $value, 'array<int, mixed>', [], $previous));
            }
        }

        /** @phpstan-ignore-next-line */
        return $value;
    }

    /**
     * @template A
     * @template B
     *
     * @param A $value
     * @param callable(array-key, mixed): B $callback
     *
     * @return A&array<int, B>
     *
     * @phpstan-assert array<int, B> $value
     */
    public static function intArrayOf(mixed $value, callable $callback, \Throwable|string|null $previous = null): array
    {
        if (!\is_array($value)) {
            throw new \InvalidArgumentException(Errorf::invalidArgument('value', $value, 'array<int, mixed>', [], $previous));
        }

        foreach ($value as $k => $v) {
            if (!\is_int($k)) {
                throw new \InvalidArgumentException(Errorf::invalidArgument('value', $value, 'array<int, mixed>', [], $previous));
            }

            $expected = $callback($k, $v);

            if ($v !== $expected) {
                throw new \UnexpectedValueException(Errorf::unexpectedVariableValue((string) $k, $v, Debugf::type($expected)));
            }
        }

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
    public static function intEnum(mixed $value, string $enum, \Throwable|string|null $previous = null): \BackedEnum
    {
        if ($value instanceof $enum) {
            return $value;
        }

        throw new \InvalidArgumentException(Errorf::invalidArgument('value', $value, $enum, [], $previous));
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
    public static function intIterable(mixed $value, \Throwable|string|null $previous = null): iterable
    {
        if (!\is_iterable($value)) {
            throw new \InvalidArgumentException(Errorf::invalidArgument('value', $value, 'iterable<int, mixed>', [], $previous));
        }

        foreach ($value as $k => $v) {
            if (!\is_int($k)) {
                throw new \InvalidArgumentException(Errorf::invalidArgument('value', $value, 'iterable<int, mixed>', [], $previous));
            }
        }

        /** @phpstan-ignore-next-line */
        return $value;
    }

    /**
     * @template A
     * @template B
     *
     * @param A $value
     * @param callable(array-key, mixed): B $callback
     *
     * @return A&iterable<int, B>
     *
     * @phpstan-assert iterable<int, B> $value
     */
    public static function intIterableOf(mixed $value, callable $callback, \Throwable|string|null $previous = null): iterable
    {
        if (!\is_iterable($value)) {
            throw new \InvalidArgumentException(Errorf::invalidArgument('value', $value, 'iterable<int, mixed>', [], $previous));
        }

        foreach ($value as $k => $v) {
            if (!\is_int($k)) {
                throw new \InvalidArgumentException(Errorf::invalidArgument('value', $value, 'iterable<int, mixed>', [], $previous));
            }

            $expected = $callback($k, $v);

            if ($v !== $expected) {
                throw new \UnexpectedValueException(Errorf::unexpectedVariableValue((string) $k, $v, Debugf::type($expected)));
            }
        }

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
    public static function interfaceString(mixed $value, \Throwable|string|null $previous = null): string
    {
        if (\is_string($value) && \interface_exists($value)) {
            return $value;
        }

        throw new \InvalidArgumentException(Errorf::invalidArgument('value', $value, 'interface-string', [], $previous));
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
    public static function iterable(mixed $value, \Throwable|string|null $previous = null): iterable
    {
        if (\is_iterable($value)) {
            /** @phpstan-ignore-next-line */
            return $value;
        }

        throw new \InvalidArgumentException(Errorf::invalidArgument('value', $value, 'iterable<int|string, mixed>', [], $previous));
    }

    /**
     * @template A
     * @template B
     *
     * @param A $value
     * @param callable(array-key, mixed): B $callback
     *
     * @return A&iterable<int|string, B>
     *
     * @phpstan-assert iterable<int|string, B> $value
     */
    public static function iterableOf(mixed $value, callable $callback, \Throwable|string|null $previous = null): iterable
    {
        if (!\is_iterable($value)) {
            throw new \InvalidArgumentException(Errorf::invalidArgument('value', $value, 'iterable<int|string, mixed>', [], $previous));
        }

        foreach ($value as $k => $v) {
            /** @phpstan-ignore-next-line */
            $expected = $callback($k, $v);

            if ($v !== $expected) {
                // @phpstan-ignore-next-line
                throw new \UnexpectedValueException(Errorf::unexpectedVariableValue((string) $k, $v, Debugf::type($expected)));
            }
        }

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
    public static function list(mixed $value, \Throwable|string|null $previous = null): array
    {
        if (\is_array($value) && \array_is_list($value)) {
            return $value;
        }

        throw new \InvalidArgumentException(Errorf::invalidArgument('value', $value, 'list<mixed>', [], $previous));
    }

    /**
     * @template A
     * @template B
     *
     * @param A $value
     * @param callable(array-key, mixed): B $callback
     *
     * @return A&list<B>
     *
     * @phpstan-assert list<B> $value
     */
    public static function listOf(mixed $value, callable $callback, \Throwable|string|null $previous = null): array
    {
        if (!\is_array($value)) {
            throw new \InvalidArgumentException(Errorf::invalidArgument('value', $value, 'list<mixed>', [], $previous));
        }

        if (!\array_is_list($value)) {
            throw new \InvalidArgumentException(Errorf::invalidArgument('value', $value, 'list<mixed>', [], $previous));
        }

        foreach ($value as $k => $v) {
            $expected = $callback($k, $v);

            if ($v !== $expected) {
                throw new \UnexpectedValueException(Errorf::unexpectedVariableValue((string) $k, $v, Debugf::type($expected)));
            }
        }

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
    public static function negativeInt(mixed $value, \Throwable|string|null $previous = null): int
    {
        if (\is_int($value) && $value < 0) {
            return $value;
        }

        throw new \InvalidArgumentException(Errorf::invalidArgument('value', $value, 'negative-int', [], $previous));
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
    public static function nonEmptyArray(mixed $value, \Throwable|string|null $previous = null): array
    {
        if (\is_array($value) && $value !== []) {
            /** @phpstan-ignore-next-line */
            return $value;
        }

        throw new \InvalidArgumentException(Errorf::invalidArgument('value', $value, 'non-empty-array<int|string, mixed>', [], $previous));
    }

    /**
     * @template A
     * @template B
     *
     * @param A $value
     * @param callable(array-key, mixed): B $callback
     *
     * @return A&non-empty-array<int|string, B>
     *
     * @phpstan-assert non-empty-array<int|string, B> $value
     */
    public static function nonEmptyArrayOf(mixed $value, callable $callback, \Throwable|string|null $previous = null): array
    {
        if (!\is_array($value)) {
            throw new \InvalidArgumentException(Errorf::invalidArgument('value', $value, 'non-empty-array<int|string, mixed>', [], $previous));
        }

        if ($value === []) {
            throw new \InvalidArgumentException(Errorf::invalidArgument('value', $value, 'non-empty-array<int|string, mixed>', [], $previous));
        }

        foreach ($value as $k => $v) {
            $expected = $callback($k, $v);

            if ($v !== $expected) {
                throw new \UnexpectedValueException(Errorf::unexpectedVariableValue((string) $k, $v, Debugf::type($expected)));
            }
        }

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
    public static function nonEmptyIntArray(mixed $value, \Throwable|string|null $previous = null): array
    {
        if (!\is_array($value)) {
            throw new \InvalidArgumentException(Errorf::invalidArgument('value', $value, 'non-empty-array<int, mixed>', [], $previous));
        }

        if ($value === []) {
            throw new \InvalidArgumentException(Errorf::invalidArgument('value', $value, 'non-empty-array<int, mixed>', [], $previous));
        }

        foreach ($value as $k => $v) {
            if (!\is_int($k)) {
                throw new \InvalidArgumentException(Errorf::invalidArgument('value', $value, 'non-empty-array<int, mixed>', [], $previous));
            }
        }

        /** @phpstan-ignore-next-line */
        return $value;
    }

    /**
     * @template A
     * @template B
     *
     * @param A $value
     * @param callable(array-key, mixed): B $callback
     *
     * @return A&non-empty-array<int, B>
     *
     * @phpstan-assert non-empty-array<int, B> $value
     */
    public static function nonEmptyIntArrayOf(mixed $value, callable $callback, \Throwable|string|null $previous = null): array
    {
        if (!\is_array($value)) {
            throw new \InvalidArgumentException(Errorf::invalidArgument('value', $value, 'non-empty-array<int, mixed>', [], $previous));
        }

        if ($value === []) {
            throw new \InvalidArgumentException(Errorf::invalidArgument('value', $value, 'non-empty-array<int, mixed>', [], $previous));
        }

        foreach ($value as $k => $v) {
            if (!\is_int($k)) {
                throw new \InvalidArgumentException(Errorf::invalidArgument('value', $value, 'non-empty-array<int, mixed>', [], $previous));
            }

            $expected = $callback($k, $v);

            if ($v !== $expected) {
                throw new \UnexpectedValueException(Errorf::unexpectedVariableValue((string) $k, $v, Debugf::type($expected)));
            }
        }

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
    public static function nonEmptyList(mixed $value, \Throwable|string|null $previous = null): array
    {
        if (\is_array($value) && $value !== [] && \array_is_list($value)) {
            return $value;
        }

        throw new \InvalidArgumentException(Errorf::invalidArgument('value', $value, 'non-empty-list<mixed>', [], $previous));
    }

    /**
     * @template A
     * @template B
     *
     * @param A $value
     * @param callable(array-key, mixed): B $callback
     *
     * @return A&non-empty-list<B>
     *
     * @phpstan-assert non-empty-list<B> $value
     */
    public static function nonEmptyListOf(mixed $value, callable $callback, \Throwable|string|null $previous = null): array
    {
        if (!\is_array($value)) {
            throw new \InvalidArgumentException(Errorf::invalidArgument('value', $value, 'non-empty-list<mixed>', [], $previous));
        }

        if ($value === []) {
            throw new \InvalidArgumentException(Errorf::invalidArgument('value', $value, 'non-empty-list<mixed>', [], $previous));
        }

        if (!\array_is_list($value)) {
            throw new \InvalidArgumentException(Errorf::invalidArgument('value', $value, 'non-empty-list<mixed>', [], $previous));
        }

        foreach ($value as $k => $v) {
            $expected = $callback($k, $v);

            if ($v !== $expected) {
                throw new \UnexpectedValueException(Errorf::unexpectedVariableValue((string) $k, $v, Debugf::type($expected)));
            }
        }

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
    public static function nonEmptyString(mixed $value, \Throwable|string|null $previous = null): string
    {
        if (\is_string($value) && $value !== '') {
            return $value;
        }

        throw new \InvalidArgumentException(Errorf::invalidArgument('value', $value, 'non-empty-string', [], $previous));
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
    public static function nonEmptyStringArray(mixed $value, \Throwable|string|null $previous = null): array
    {
        if (!\is_array($value)) {
            throw new \InvalidArgumentException(Errorf::invalidArgument('value', $value, 'non-empty-array<string, mixed>', [], $previous));
        }

        if ($value === []) {
            throw new \InvalidArgumentException(Errorf::invalidArgument('value', $value, 'non-empty-array<string, mixed>', [], $previous));
        }

        foreach ($value as $k => $v) {
            if (!\is_string($k)) {
                throw new \InvalidArgumentException(Errorf::invalidArgument('value', $value, 'non-empty-array<string, mixed>', [], $previous));
            }
        }

        /** @phpstan-ignore-next-line */
        return $value;
    }

    /**
     * @template A
     * @template B
     *
     * @param A $value
     * @param callable(array-key, mixed): B $callback
     *
     * @return A&non-empty-array<string, B>
     *
     * @phpstan-assert non-empty-array<string, B> $value
     */
    public static function nonEmptyStringArrayOf(mixed $value, callable $callback, \Throwable|string|null $previous = null): array
    {
        if (!\is_array($value)) {
            throw new \InvalidArgumentException(Errorf::invalidArgument('value', $value, 'non-empty-array<string, mixed>', [], $previous));
        }

        if ($value === []) {
            throw new \InvalidArgumentException(Errorf::invalidArgument('value', $value, 'non-empty-array<string, mixed>', [], $previous));
        }

        foreach ($value as $k => $v) {
            if (!\is_string($k)) {
                throw new \InvalidArgumentException(Errorf::invalidArgument('value', $value, 'non-empty-array<string, mixed>', [], $previous));
            }

            $expected = $callback($k, $v);

            if ($v !== $expected) {
                throw new \UnexpectedValueException(Errorf::unexpectedVariableValue($k, $v, Debugf::type($expected)));
            }
        }

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
    public static function nonFalsyString(mixed $value, \Throwable|string|null $previous = null): string
    {
        if (\is_string($value) && (bool) $value) {
            return $value;
        }

        throw new \InvalidArgumentException(Errorf::invalidArgument('value', $value, 'non-falsy-string', [], $previous));
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
    public static function nonNegativeInt(mixed $value, \Throwable|string|null $previous = null): int
    {
        if (\is_int($value) && $value >= 0) {
            return $value;
        }

        throw new \InvalidArgumentException(Errorf::invalidArgument('value', $value, 'non-negative-int', [], $previous));
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
    public static function nonPositiveInt(mixed $value, \Throwable|string|null $previous = null): int
    {
        if (\is_int($value) && $value <= 0) {
            return $value;
        }

        throw new \InvalidArgumentException(Errorf::invalidArgument('value', $value, 'non-positive-int', [], $previous));
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
    public static function nonZeroInt(mixed $value, \Throwable|string|null $previous = null): int
    {
        if (\is_int($value) && $value !== 0) {
            return $value;
        }

        throw new \InvalidArgumentException(Errorf::invalidArgument('value', $value, 'non-zero-int', [], $previous));
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
    public static function notFalse(mixed $value, \Throwable|string|null $previous = null): mixed
    {
        if ($value !== false) {
            return $value;
        }

        throw new \InvalidArgumentException(Errorf::invalidArgument('value', $value, '!false', [], $previous));
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
    public static function notNegativeOne(mixed $value, \Throwable|string|null $previous = null): mixed
    {
        if ($value !== -1) {
            return $value;
        }

        throw new \InvalidArgumentException(Errorf::invalidArgument('value', $value, '!-1', [], $previous));
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
    public static function notNull(mixed $value, \Throwable|string|null $previous = null): mixed
    {
        if ($value !== null) {
            return $value;
        }

        throw new \InvalidArgumentException(Errorf::invalidArgument('value', $value, '!null', [], $previous));
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
    public static function notPositiveOne(mixed $value, \Throwable|string|null $previous = null): mixed
    {
        if ($value !== 1) {
            return $value;
        }

        throw new \InvalidArgumentException(Errorf::invalidArgument('value', $value, '!1', [], $previous));
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
    public static function notTrue(mixed $value, \Throwable|string|null $previous = null): mixed
    {
        if ($value !== true) {
            return $value;
        }

        throw new \InvalidArgumentException(Errorf::invalidArgument('value', $value, '!true', [], $previous));
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
    public static function notZero(mixed $value, \Throwable|string|null $previous = null): mixed
    {
        if ($value !== 0) {
            return $value;
        }

        throw new \InvalidArgumentException(Errorf::invalidArgument('value', $value, '!0', [], $previous));
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
    public static function null(mixed $value, \Throwable|string|null $previous = null): null
    {
        if ($value === null) {
            return $value;
        }

        throw new \InvalidArgumentException(Errorf::invalidArgument('value', $value, 'null', [], $previous));
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
    public static function nullableA(mixed $value, string $class, \Throwable|string|null $previous = null): string|null
    {
        if ($value === null || (\is_string($value) && \is_a($value, $class, true))) {
            return $value;
        }

        throw new \InvalidArgumentException(Errorf::invalidArgument('value', $value, "class-string<{$class}>|null", [], $previous));
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
    public static function nullableArray(mixed $value, \Throwable|string|null $previous = null): array|null
    {
        if ($value === null || \is_array($value)) {
            /** @phpstan-ignore-next-line */
            return $value;
        }

        throw new \InvalidArgumentException(Errorf::invalidArgument('value', $value, 'array<int|string, mixed>|null', [], $previous));
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
    public static function nullableArrayKey(mixed $value, \Throwable|string|null $previous = null): int|string|null
    {
        if ($value === null || \is_int($value) || \is_string($value)) {
            return $value;
        }

        throw new \InvalidArgumentException(Errorf::invalidArgument('value', $value, 'int|string|null', [], $previous));
    }

    /**
     * @template A
     * @template B
     *
     * @param A $value
     * @param callable(array-key, mixed): B $callback
     *
     * @return A&(array<int|string, B>|null)
     *
     * @phpstan-assert array<int|string, B>|null $value
     */
    public static function nullableArrayOf(mixed $value, callable $callback, \Throwable|string|null $previous = null): array|null
    {
        if ($value === null) {
            return $value;
        }

        if (!\is_array($value)) {
            throw new \InvalidArgumentException(Errorf::invalidArgument('value', $value, 'array<int|string, mixed>|null', [], $previous));
        }

        foreach ($value as $k => $v) {
            $expected = $callback($k, $v);

            if ($v !== $expected) {
                throw new \UnexpectedValueException(Errorf::unexpectedVariableValue((string) $k, $v, Debugf::type($expected)));
            }
        }

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
    public static function nullableBool(mixed $value, \Throwable|string|null $previous = null): bool|null
    {
        if ($value === null || \is_bool($value)) {
            return $value;
        }

        throw new \InvalidArgumentException(Errorf::invalidArgument('value', $value, 'bool|null', [], $previous));
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
    public static function nullableCallable(mixed $value, \Throwable|string|null $previous = null): callable|null
    {
        if ($value === null || \is_callable($value)) {
            return $value;
        }

        throw new \InvalidArgumentException(Errorf::invalidArgument('value', $value, 'callable(): mixed|null', [], $previous));
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
    public static function nullableCallableString(mixed $value, \Throwable|string|null $previous = null): string|null
    {
        if ($value === null || \is_string($value) && \is_callable($value)) {
            return $value;
        }

        throw new \InvalidArgumentException(Errorf::invalidArgument('value', $value, 'callable-string|null', [], $previous));
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
    public static function nullableClassString(mixed $value, \Throwable|string|null $previous = null): string|null
    {
        if ($value === null || \is_string($value) && \class_exists($value)) {
            return $value;
        }

        throw new \InvalidArgumentException(Errorf::invalidArgument('value', $value, 'class-string|null', [], $previous));
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
    public static function nullableClosedResource(mixed $value, \Throwable|string|null $previous = null): mixed
    {
        if ($value === null || (!\is_scalar($value) && !\is_resource($value) && !\is_array($value) && !\is_object($value))) {
            /** @phpstan-ignore-next-line */
            return $value;
        }

        throw new \InvalidArgumentException(Errorf::invalidArgument('value', $value, 'closed-resource|null', [], $previous));
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
    public static function nullableCountable(mixed $value, \Throwable|string|null $previous = null): \Countable|array|null
    {
        if ($value === null || \is_countable($value)) {
            /** @phpstan-ignore-next-line */
            return $value;
        }

        throw new \InvalidArgumentException(Errorf::invalidArgument('value', $value, 'countable|null', [], $previous));
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
    public static function nullableEnum(mixed $value, string $enum, \Throwable|string|null $previous = null): \BackedEnum|null
    {
        if ($value === null || $value instanceof $enum) {
            return $value;
        }

        throw new \InvalidArgumentException(Errorf::invalidArgument('value', $value, "{$enum}|null", [], $previous));
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
    public static function nullableFalse(mixed $value, \Throwable|string|null $previous = null): false|null
    {
        if ($value === null || $value === false) {
            return $value;
        }

        throw new \InvalidArgumentException(Errorf::invalidArgument('value', $value, 'false|null', [], $previous));
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
    public static function nullableFloat(mixed $value, \Throwable|string|null $previous = null): float|null
    {
        if ($value === null || \is_float($value)) {
            return $value;
        }

        throw new \InvalidArgumentException(Errorf::invalidArgument('value', $value, 'float|null', [], $previous));
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
    public static function nullableIn(mixed $value, array $enum, \Throwable|string|null $previous = null): mixed
    {
        if ($value === null || \in_array($value, $enum, true)) {
            return $value;
        }

        throw new \InvalidArgumentException(Errorf::invalidArgument('value', $value, $enum + [null], [], $previous));
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
    public static function nullableInstance(mixed $value, string $class, \Throwable|string|null $previous = null): object|null
    {
        if ($value === null || $value instanceof $class) {
            return $value;
        }

        throw new \InvalidArgumentException(Errorf::invalidArgument('value', $value, "{$class}|null", [], $previous));
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
    public static function nullableInt(mixed $value, \Throwable|string|null $previous = null): int|null
    {
        if ($value === null || \is_int($value)) {
            return $value;
        }

        throw new \InvalidArgumentException(Errorf::invalidArgument('value', $value, 'int|null', [], $previous));
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
    public static function nullableIntArray(mixed $value, \Throwable|string|null $previous = null): array|null
    {
        if ($value === null) {
            return $value;
        }

        if (!\is_array($value)) {
            throw new \InvalidArgumentException(Errorf::invalidArgument('value', $value, 'array<int, mixed>|null', [], $previous));
        }

        foreach ($value as $k => $v) {
            if (!\is_int($k)) {
                throw new \InvalidArgumentException(Errorf::invalidArgument('value', $value, 'array<int, mixed>|null', [], $previous));
            }
        }

        /** @phpstan-ignore-next-line */
        return $value;
    }

    /**
     * @template A
     * @template B
     *
     * @param A $value
     * @param callable(array-key, mixed): B $callback
     *
     * @return A&(array<int, B>|null)
     *
     * @phpstan-assert array<int, B>|null $value
     */
    public static function nullableIntArrayOf(mixed $value, callable $callback, \Throwable|string|null $previous = null): array|null
    {
        if ($value === null) {
            return $value;
        }

        if (!\is_array($value)) {
            throw new \InvalidArgumentException(Errorf::invalidArgument('value', $value, 'array<int, mixed>|null', [], $previous));
        }

        foreach ($value as $k => $v) {
            if (!\is_int($k)) {
                throw new \InvalidArgumentException(Errorf::invalidArgument('value', $value, 'array<int, mixed>|null', [], $previous));
            }

            $expected = $callback($k, $v);

            if ($v !== $expected) {
                throw new \UnexpectedValueException(Errorf::unexpectedVariableValue((string) $k, $v, Debugf::type($expected)));
            }
        }

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
    public static function nullableIntEnum(mixed $value, string $enum, \Throwable|string|null $previous = null): \BackedEnum|null
    {
        if ($value === null || $value instanceof $enum) {
            return $value;
        }

        throw new \InvalidArgumentException(Errorf::invalidArgument('value', $value, "{$enum}|null", [], $previous));
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
    public static function nullableIntIterable(mixed $value, \Throwable|string|null $previous = null): iterable|null
    {
        if ($value === null) {
            return $value;
        }

        if (!\is_iterable($value)) {
            throw new \InvalidArgumentException(Errorf::invalidArgument('value', $value, 'iterable<int, mixed>|null', [], $previous));
        }

        foreach ($value as $k => $v) {
            if (!\is_int($k)) {
                throw new \InvalidArgumentException(Errorf::invalidArgument('value', $value, 'iterable<int, mixed>|null', [], $previous));
            }
        }

        /** @phpstan-ignore-next-line */
        return $value;
    }

    /**
     * @template A
     * @template B
     *
     * @param A $value
     * @param callable(array-key, mixed): B $callback
     *
     * @return A&(iterable<int, B>|null)
     *
     * @phpstan-assert iterable<int, B>|null $value
     */
    public static function nullableIntIterableOf(mixed $value, callable $callback, \Throwable|string|null $previous = null): iterable|null
    {
        if ($value === null) {
            return $value;
        }

        if (!\is_iterable($value)) {
            throw new \InvalidArgumentException(Errorf::invalidArgument('value', $value, 'iterable<int, mixed>|null', [], $previous));
        }

        foreach ($value as $k => $v) {
            if (!\is_int($k)) {
                throw new \InvalidArgumentException(Errorf::invalidArgument('value', $value, 'iterable<int, mixed>|null', [], $previous));
            }

            $expected = $callback($k, $v);

            if ($v !== $expected) {
                throw new \UnexpectedValueException(Errorf::unexpectedVariableValue((string) $k, $v, Debugf::type($expected)));
            }
        }

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
    public static function nullableInterfaceString(mixed $value, \Throwable|string|null $previous = null): string|null
    {
        if ($value === null || \is_string($value) && \interface_exists($value)) {
            return $value;
        }

        throw new \InvalidArgumentException(Errorf::invalidArgument('value', $value, 'interface-string|null', [], $previous));
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
    public static function nullableIterable(mixed $value, \Throwable|string|null $previous = null): iterable|null
    {
        if ($value === null || \is_iterable($value)) {
            /** @phpstan-ignore-next-line */
            return $value;
        }

        throw new \InvalidArgumentException(Errorf::invalidArgument('value', $value, 'iterable<int|string, mixed>|null', [], $previous));
    }

    /**
     * @template A
     * @template B
     *
     * @param A $value
     * @param callable(array-key, mixed): B $callback
     *
     * @return A&(iterable<int|string, B>|null)
     *
     * @phpstan-assert iterable<int|string, B>|null $value
     */
    public static function nullableIterableOf(mixed $value, callable $callback, \Throwable|string|null $previous = null): iterable|null
    {
        if ($value === null) {
            return $value;
        }

        if (!\is_iterable($value)) {
            throw new \InvalidArgumentException(Errorf::invalidArgument('value', $value, 'iterable<int|string, mixed>|null', [], $previous));
        }

        foreach ($value as $k => $v) {
            /** @phpstan-ignore-next-line */
            $expected = $callback($k, $v);

            if ($v !== $expected) {
                // @phpstan-ignore-next-line
                throw new \UnexpectedValueException(Errorf::unexpectedVariableValue((string) $k, $v, Debugf::type($expected)));
            }
        }

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
    public static function nullableList(mixed $value, \Throwable|string|null $previous = null): array|null
    {
        if ($value === null || \is_array($value) && \array_is_list($value)) {
            return $value;
        }

        throw new \InvalidArgumentException(Errorf::invalidArgument('value', $value, 'list<mixed>|null', [], $previous));
    }

    /**
     * @template A
     * @template B
     *
     * @param A $value
     * @param callable(array-key, mixed): B $callback
     *
     * @return A&(list<B>|null)
     *
     * @phpstan-assert list<B>|null $value
     */
    public static function nullableListOf(mixed $value, callable $callback, \Throwable|string|null $previous = null): array|null
    {
        if ($value === null) {
            return $value;
        }

        if (!\is_array($value)) {
            throw new \InvalidArgumentException(Errorf::invalidArgument('value', $value, 'list<mixed>|null', [], $previous));
        }

        if (!\array_is_list($value)) {
            throw new \InvalidArgumentException(Errorf::invalidArgument('value', $value, 'list<mixed>|null', [], $previous));
        }

        foreach ($value as $k => $v) {
            $expected = $callback($k, $v);

            if ($v !== $expected) {
                throw new \UnexpectedValueException(Errorf::unexpectedVariableValue((string) $k, $v, Debugf::type($expected)));
            }
        }

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
    public static function nullableNegativeInt(mixed $value, \Throwable|string|null $previous = null): int|null
    {
        if ($value === null || \is_int($value) && $value < 0) {
            return $value;
        }

        throw new \InvalidArgumentException(Errorf::invalidArgument('value', $value, 'negative-int|null', [], $previous));
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
    public static function nullableNonEmptyArray(mixed $value, \Throwable|string|null $previous = null): array|null
    {
        if ($value === null || \is_array($value) && $value !== []) {
            /** @phpstan-ignore-next-line */
            return $value;
        }

        throw new \InvalidArgumentException(Errorf::invalidArgument('value', $value, 'non-empty-array<int|string, mixed>|null', [], $previous));
    }

    /**
     * @template A
     * @template B
     *
     * @param A $value
     * @param callable(array-key, mixed): B $callback
     *
     * @return A&(non-empty-array<int|string, B>|null)
     *
     * @phpstan-assert non-empty-array<int|string, B>|null $value
     */
    public static function nullableNonEmptyArrayOf(mixed $value, callable $callback, \Throwable|string|null $previous = null): array|null
    {
        if ($value === null) {
            return $value;
        }

        if (!\is_array($value)) {
            throw new \InvalidArgumentException(Errorf::invalidArgument('value', $value, 'non-empty-array<int|string, mixed>|null', [], $previous));
        }

        if ($value === []) {
            throw new \InvalidArgumentException(Errorf::invalidArgument('value', $value, 'non-empty-array<int|string, mixed>|null', [], $previous));
        }

        foreach ($value as $k => $v) {
            $expected = $callback($k, $v);

            if ($v !== $expected) {
                throw new \UnexpectedValueException(Errorf::unexpectedVariableValue((string) $k, $v, Debugf::type($expected)));
            }
        }

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
    public static function nullableNonEmptyIntArray(mixed $value, \Throwable|string|null $previous = null): array|null
    {
        if ($value === null) {
            return $value;
        }

        if (!\is_array($value)) {
            throw new \InvalidArgumentException(Errorf::invalidArgument('value', $value, 'non-empty-array<int, mixed>|null', [], $previous));
        }

        if ($value === []) {
            throw new \InvalidArgumentException(Errorf::invalidArgument('value', $value, 'non-empty-array<int, mixed>|null', [], $previous));
        }

        foreach ($value as $k => $v) {
            if (!\is_int($k)) {
                throw new \InvalidArgumentException(Errorf::invalidArgument('value', $value, 'non-empty-array<int, mixed>|null', [], $previous));
            }
        }

        /** @phpstan-ignore-next-line */
        return $value;
    }

    /**
     * @template A
     * @template B
     *
     * @param A $value
     * @param callable(array-key, mixed): B $callback
     *
     * @return A&(non-empty-array<int, B>|null)
     *
     * @phpstan-assert non-empty-array<int, B>|null $value
     */
    public static function nullableNonEmptyIntArrayOf(mixed $value, callable $callback, \Throwable|string|null $previous = null): array|null
    {
        if ($value === null) {
            return $value;
        }

        if (!\is_array($value)) {
            throw new \InvalidArgumentException(Errorf::invalidArgument('value', $value, 'non-empty-array<int, templatevv>|null', [], $previous));
        }

        if ($value === []) {
            throw new \InvalidArgumentException(Errorf::invalidArgument('value', $value, 'non-empty-array<int, templatevv>|null', [], $previous));
        }

        foreach ($value as $k => $v) {
            if (!\is_int($k)) {
                throw new \InvalidArgumentException(Errorf::invalidArgument('value', $value, 'non-empty-array<int, templatevv>|null', [], $previous));
            }

            $expected = $callback($k, $v);

            if ($v !== $expected) {
                throw new \UnexpectedValueException(Errorf::unexpectedVariableValue((string) $k, $v, Debugf::type($expected)));
            }
        }

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
    public static function nullableNonEmptyList(mixed $value, \Throwable|string|null $previous = null): array|null
    {
        if ($value === null || \is_array($value) && $value !== [] && \array_is_list($value)) {
            return $value;
        }

        throw new \InvalidArgumentException(Errorf::invalidArgument('value', $value, 'non-empty-list<mixed>|null', [], $previous));
    }

    /**
     * @template A
     * @template B
     *
     * @param A $value
     * @param callable(array-key, mixed): B $callback
     *
     * @return A&(non-empty-list<B>|null)
     *
     * @phpstan-assert non-empty-list<B>|null $value
     */
    public static function nullableNonEmptyListOf(mixed $value, callable $callback, \Throwable|string|null $previous = null): array|null
    {
        if ($value === null) {
            return $value;
        }

        if (!\is_array($value)) {
            throw new \InvalidArgumentException(Errorf::invalidArgument('value', $value, 'non-empty-list<mixed>|null', [], $previous));
        }

        if ($value === []) {
            throw new \InvalidArgumentException(Errorf::invalidArgument('value', $value, 'non-empty-list<mixed>|null', [], $previous));
        }

        if (!\array_is_list($value)) {
            throw new \InvalidArgumentException(Errorf::invalidArgument('value', $value, 'non-empty-list<mixed>|null', [], $previous));
        }

        foreach ($value as $k => $v) {
            $expected = $callback($k, $v);

            if ($v !== $expected) {
                throw new \UnexpectedValueException(Errorf::unexpectedVariableValue((string) $k, $v, Debugf::type($expected)));
            }
        }

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
    public static function nullableNonEmptyString(mixed $value, \Throwable|string|null $previous = null): string|null
    {
        if ($value === null || \is_string($value) && $value !== '') {
            return $value;
        }

        throw new \InvalidArgumentException(Errorf::invalidArgument('value', $value, 'non-empty-string', [], $previous));
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
    public static function nullableNonEmptyStringArray(mixed $value, \Throwable|string|null $previous = null): array|null
    {
        if ($value === null) {
            return $value;
        }

        if (!\is_array($value)) {
            throw new \InvalidArgumentException(Errorf::invalidArgument('value', $value, 'non-empty-array<string, mixed>|null', [], $previous));
        }

        if ($value === []) {
            throw new \InvalidArgumentException(Errorf::invalidArgument('value', $value, 'non-empty-array<string, mixed>|null', [], $previous));
        }

        foreach ($value as $k => $v) {
            if (!\is_string($k)) {
                throw new \InvalidArgumentException(Errorf::invalidArgument('value', $value, 'non-empty-array<string, mixed>|null', [], $previous));
            }
        }

        /** @phpstan-ignore-next-line */
        return $value;
    }

    /**
     * @template A
     * @template B
     *
     * @param A $value
     * @param callable(array-key, mixed): B $callback
     *
     * @return A&(non-empty-array<string, B>|null)
     *
     * @phpstan-assert non-empty-array<string, B>|null $value
     */
    public static function nullableNonEmptyStringArrayOf(mixed $value, callable $callback, \Throwable|string|null $previous = null): array|null
    {
        if ($value === null) {
            return $value;
        }

        if (!\is_array($value)) {
            throw new \InvalidArgumentException(Errorf::invalidArgument('value', $value, 'non-empty-array<string, mixed>|null', [], $previous));
        }

        if ($value === []) {
            throw new \InvalidArgumentException(Errorf::invalidArgument('value', $value, 'non-empty-array<string, mixed>|null', [], $previous));
        }

        foreach ($value as $k => $v) {
            if (!\is_string($k)) {
                throw new \InvalidArgumentException(Errorf::invalidArgument('value', $value, 'non-empty-array<string, mixed>|null', [], $previous));
            }

            $expected = $callback($k, $v);

            if ($v !== $expected) {
                throw new \UnexpectedValueException(Errorf::unexpectedVariableValue($k, $v, Debugf::type($expected)));
            }
        }

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
    public static function nullableNonFalsyString(mixed $value, \Throwable|string|null $previous = null): string|null
    {
        if ($value === null || \is_string($value) && (bool) $value) {
            return $value;
        }

        throw new \InvalidArgumentException(Errorf::invalidArgument('value', $value, 'non-falsy-string', [], $previous));
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
    public static function nullableNonNegativeInt(mixed $value, \Throwable|string|null $previous = null): int|null
    {
        if ($value === null || \is_int($value) && $value >= 0) {
            return $value;
        }

        throw new \InvalidArgumentException(Errorf::invalidArgument('value', $value, 'non-negative-int|null', [], $previous));
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
    public static function nullableNonPositiveInt(mixed $value, \Throwable|string|null $previous = null): int|null
    {
        if ($value === null || \is_int($value) && $value <= 0) {
            return $value;
        }

        throw new \InvalidArgumentException(Errorf::invalidArgument('value', $value, 'non-positive-int|null', [], $previous));
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
    public static function nullableNonZeroInt(mixed $value, \Throwable|string|null $previous = null): int|null
    {
        if ($value === null || \is_int($value) && $value !== 0) {
            return $value;
        }

        throw new \InvalidArgumentException(Errorf::invalidArgument('value', $value, 'non-zero-int|null', [], $previous));
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
    public static function nullableNumeric(mixed $value, \Throwable|string|null $previous = null): float|int|string|null
    {
        if ($value === null || \is_numeric($value)) {
            return $value;
        }

        throw new \InvalidArgumentException(Errorf::invalidArgument('value', $value, 'numeric', [], $previous));
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
    public static function nullableNumericString(mixed $value, \Throwable|string|null $previous = null): string|null
    {
        if ($value === null || \is_string($value) && \is_numeric($value)) {
            return $value;
        }

        throw new \InvalidArgumentException(Errorf::invalidArgument('value', $value, 'numeric-string', [], $previous));
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
    public static function nullableObject(mixed $value, \Throwable|string|null $previous = null): object|null
    {
        if ($value === null || \is_object($value)) {
            return $value;
        }

        throw new \InvalidArgumentException(Errorf::invalidArgument('value', $value, 'object|null', [], $previous));
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
    public static function nullableOpenResource(mixed $value, \Throwable|string|null $previous = null): mixed
    {
        if ($value === null || \is_resource($value)) {
            return $value;
        }

        throw new \InvalidArgumentException(Errorf::invalidArgument('value', $value, 'open-resource|null', [], $previous));
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
    public static function nullablePositiveInt(mixed $value, \Throwable|string|null $previous = null): int|null
    {
        if ($value === null || \is_int($value) && $value > 0) {
            return $value;
        }

        throw new \InvalidArgumentException(Errorf::invalidArgument('value', $value, 'positive-int|null', [], $previous));
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
    public static function nullableResource(mixed $value, \Throwable|string|null $previous = null): mixed
    {
        if ($value === null || \is_resource($value) || (!\is_scalar($value) && !\is_array($value) && !\is_object($value))) {
            /** @phpstan-ignore-next-line */
            return $value;
        }

        throw new \InvalidArgumentException(Errorf::invalidArgument('value', $value, 'resource|null', [], $previous));
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
    public static function nullableScalar(mixed $value, \Throwable|string|null $previous = null): bool|float|int|string|null
    {
        if ($value === null || \is_scalar($value)) {
            return $value;
        }

        throw new \InvalidArgumentException(Errorf::invalidArgument('value', $value, 'scalar|null', [], $previous));
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
    public static function nullableString(mixed $value, \Throwable|string|null $previous = null): string|null
    {
        if ($value === null || \is_string($value)) {
            return $value;
        }

        throw new \InvalidArgumentException(Errorf::invalidArgument('value', $value, 'string|null', [], $previous));
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
    public static function nullableStringArray(mixed $value, \Throwable|string|null $previous = null): array|null
    {
        if ($value === null) {
            return $value;
        }

        if (!\is_array($value)) {
            throw new \InvalidArgumentException(Errorf::invalidArgument('value', $value, 'array<string, mixed>|null', [], $previous));
        }

        foreach ($value as $k => $v) {
            if (!\is_string($k)) {
                throw new \InvalidArgumentException(Errorf::invalidArgument('value', $value, 'array<string, mixed>|null', [], $previous));
            }
        }

        /** @phpstan-ignore-next-line */
        return $value;
    }

    /**
     * @template A
     * @template B
     *
     * @param A $value
     * @param callable(array-key, mixed): B $callback
     *
     * @return A&(array<string, B>|null)
     *
     * @phpstan-assert array<string, B>|null $value
     */
    public static function nullableStringArrayOf(mixed $value, callable $callback, \Throwable|string|null $previous = null): array|null
    {
        if ($value === null) {
            return $value;
        }

        if (!\is_array($value)) {
            throw new \InvalidArgumentException(Errorf::invalidArgument('value', $value, 'array<string, mixed>|null', [], $previous));
        }

        foreach ($value as $k => $v) {
            if (!\is_string($k)) {
                throw new \InvalidArgumentException(Errorf::invalidArgument('value', $value, 'array<string, mixed>|null', [], $previous));
            }

            $expected = $callback($k, $v);

            if ($v !== $expected) {
                throw new \UnexpectedValueException(Errorf::unexpectedVariableValue($k, $v, Debugf::type($expected)));
            }
        }

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
    public static function nullableStringEnum(mixed $value, string $enum, \Throwable|string|null $previous = null): \BackedEnum|null
    {
        if ($value === null || $value instanceof $enum) {
            return $value;
        }

        throw new \InvalidArgumentException(Errorf::invalidArgument('value', $value, "{$enum}|null", [], $previous));
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
    public static function nullableStringIterable(mixed $value, \Throwable|string|null $previous = null): iterable|null
    {
        if ($value === null) {
            return $value;
        }

        if (!\is_iterable($value)) {
            throw new \InvalidArgumentException(Errorf::invalidArgument('value', $value, 'iterable<string, mixed>|null', [], $previous));
        }

        foreach ($value as $k => $v) {
            if (!\is_string($k)) {
                throw new \InvalidArgumentException(Errorf::invalidArgument('value', $value, 'iterable<string, mixed>|null', [], $previous));
            }
        }

        /** @phpstan-ignore-next-line */
        return $value;
    }

    /**
     * @template A
     * @template B
     *
     * @param A $value
     * @param callable(array-key, mixed): B $callback
     *
     * @return A&(iterable<string, B>|null)
     *
     * @phpstan-assert iterable<string, B>|null $value
     */
    public static function nullableStringIterableOf(mixed $value, callable $callback, \Throwable|string|null $previous = null): iterable|null
    {
        if ($value === null) {
            return $value;
        }

        if (!\is_iterable($value)) {
            throw new \InvalidArgumentException(Errorf::invalidArgument('value', $value, 'iterable<string, mixed>|null', [], $previous));
        }

        foreach ($value as $k => $v) {
            if (!\is_string($k)) {
                throw new \InvalidArgumentException(Errorf::invalidArgument('value', $value, 'iterable<string, mixed>|null', [], $previous));
            }

            $expected = $callback($k, $v);

            if ($v !== $expected) {
                throw new \UnexpectedValueException(Errorf::unexpectedVariableValue($k, $v, Debugf::type($expected)));
            }
        }

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
    public static function nullableStringable(mixed $value, \Throwable|string|null $previous = null): \Stringable|bool|float|int|string|null
    {
        if ($value === null || \is_scalar($value) || $value instanceof \Stringable) {
            return $value;
        }

        throw new \InvalidArgumentException(Errorf::invalidArgument('value', $value, 'stringable|null', [], $previous));
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
    public static function nullableTraitString(mixed $value, \Throwable|string|null $previous = null): string|null
    {
        if ($value === null || \is_string($value) && \trait_exists($value)) {
            return $value;
        }

        throw new \InvalidArgumentException(Errorf::invalidArgument('value', $value, 'trait-string|null', [], $previous));
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
    public static function nullableTrue(mixed $value, \Throwable|string|null $previous = null): true|null
    {
        if ($value === null || $value === true) {
            return $value;
        }

        throw new \InvalidArgumentException(Errorf::invalidArgument('value', $value, 'true|null', [], $previous));
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
    public static function numeric(mixed $value, \Throwable|string|null $previous = null): float|int|string
    {
        if (\is_numeric($value)) {
            return $value;
        }

        throw new \InvalidArgumentException(Errorf::invalidArgument('value', $value, 'numeric', [], $previous));
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
    public static function numericString(mixed $value, \Throwable|string|null $previous = null): string
    {
        if (\is_string($value) && \is_numeric($value)) {
            return $value;
        }

        throw new \InvalidArgumentException(Errorf::invalidArgument('value', $value, 'numeric-string', [], $previous));
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
    public static function object(mixed $value, \Throwable|string|null $previous = null): object
    {
        if (\is_object($value)) {
            return $value;
        }

        throw new \InvalidArgumentException(Errorf::invalidArgument('value', $value, 'object', [], $previous));
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
    public static function openResource(mixed $value, \Throwable|string|null $previous = null): mixed
    {
        if (\is_resource($value)) {
            return $value;
        }

        throw new \InvalidArgumentException(Errorf::invalidArgument('value', $value, 'open-resource', [], $previous));
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
    public static function positiveInt(mixed $value, \Throwable|string|null $previous = null): int
    {
        if (\is_int($value) && $value > 0) {
            return $value;
        }

        throw new \InvalidArgumentException(Errorf::invalidArgument('value', $value, 'positive-int', [], $previous));
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
    public static function resource(mixed $value, \Throwable|string|null $previous = null): mixed
    {
        if (\is_resource($value) || ($value !== null && !\is_scalar($value) && !\is_array($value) && !\is_object($value))) {
            /** @phpstan-ignore-next-line */
            return $value;
        }

        throw new \InvalidArgumentException(Errorf::invalidArgument('value', $value, 'resource', [], $previous));
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
    public static function scalar(mixed $value, \Throwable|string|null $previous = null): bool|float|int|string
    {
        if (\is_scalar($value)) {
            return $value;
        }

        throw new \InvalidArgumentException(Errorf::invalidArgument('value', $value, 'scalar', [], $previous));
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
    public static function string(mixed $value, \Throwable|string|null $previous = null): string
    {
        if (\is_string($value)) {
            return $value;
        }

        throw new \InvalidArgumentException(Errorf::invalidArgument('value', $value, 'string', [], $previous));
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
    public static function stringArray(mixed $value, \Throwable|string|null $previous = null): array
    {
        if (!\is_array($value)) {
            throw new \InvalidArgumentException(Errorf::invalidArgument('value', $value, 'array<string, mixed>', [], $previous));
        }

        foreach ($value as $k => $v) {
            if (!\is_string($k)) {
                throw new \InvalidArgumentException(Errorf::invalidArgument('value', $value, 'array<string, mixed>', [], $previous));
            }
        }

        /** @phpstan-ignore-next-line */
        return $value;
    }

    /**
     * @template A
     * @template B
     *
     * @param A $value
     * @param callable(array-key, mixed): B $callback
     *
     * @return A&array<string, B>
     *
     * @phpstan-assert array<string, B> $value
     */
    public static function stringArrayOf(mixed $value, callable $callback, \Throwable|string|null $previous = null): array
    {
        if (!\is_array($value)) {
            throw new \InvalidArgumentException(Errorf::invalidArgument('value', $value, 'array<string, mixed>', [], $previous));
        }

        foreach ($value as $k => $v) {
            if (!\is_string($k)) {
                throw new \InvalidArgumentException(Errorf::invalidArgument('value', $value, 'array<string, mixed>', [], $previous));
            }

            $expected = $callback($k, $v);

            if ($v !== $expected) {
                throw new \UnexpectedValueException(Errorf::unexpectedVariableValue($k, $v, Debugf::type($expected)));
            }
        }

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
    public static function stringEnum(mixed $value, string $enum, \Throwable|string|null $previous = null): \BackedEnum
    {
        if ($value instanceof $enum) {
            return $value;
        }

        throw new \InvalidArgumentException(Errorf::invalidArgument('value', $value, $enum, [], $previous));
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
    public static function stringIterable(mixed $value, \Throwable|string|null $previous = null): iterable
    {
        if (!\is_iterable($value)) {
            throw new \InvalidArgumentException(Errorf::invalidArgument('value', $value, 'iterable<string, mixed>', [], $previous));
        }

        foreach ($value as $k => $v) {
            if (!\is_string($k)) {
                throw new \InvalidArgumentException(Errorf::invalidArgument('value', $value, 'iterable<string, mixed>', [], $previous));
            }
        }

        /** @phpstan-ignore-next-line */
        return $value;
    }

    /**
     * @template A
     * @template B
     *
     * @param A $value
     * @param callable(array-key, mixed): B $callback
     *
     * @return A&iterable<string, B>
     *
     * @phpstan-assert iterable<string, B> $value
     */
    public static function stringIterableOf(mixed $value, callable $callback, \Throwable|string|null $previous = null): iterable
    {
        if (!\is_iterable($value)) {
            throw new \InvalidArgumentException(Errorf::invalidArgument('value', $value, 'iterable<string, mixed>', [], $previous));
        }

        foreach ($value as $k => $v) {
            if (!\is_string($k)) {
                throw new \InvalidArgumentException(Errorf::invalidArgument('value', $value, 'iterable<string, mixed>', [], $previous));
            }

            $expected = $callback($k, $v);

            if ($v !== $expected) {
                throw new \UnexpectedValueException(Errorf::unexpectedVariableValue($k, $v, Debugf::type($expected)));
            }
        }

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
    public static function stringable(mixed $value, \Throwable|string|null $previous = null): \Stringable|bool|float|int|string
    {
        if (\is_scalar($value) || $value instanceof \Stringable) {
            return $value;
        }

        throw new \InvalidArgumentException(Errorf::invalidArgument('value', $value, 'stringable', [], $previous));
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
    public static function traitString(mixed $value, \Throwable|string|null $previous = null): string
    {
        if (\is_string($value) && \trait_exists($value)) {
            return $value;
        }

        throw new \InvalidArgumentException(Errorf::invalidArgument('value', $value, 'trait-string', [], $previous));
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
    public static function true(mixed $value, \Throwable|string|null $previous = null): true
    {
        if ($value === true) {
            return $value;
        }

        throw new \InvalidArgumentException(Errorf::invalidArgument('value', $value, 'true', [], $previous));
    }
}
