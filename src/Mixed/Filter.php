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

namespace Premierstacks\PhpUtil\Mixed;

use Premierstacks\PhpUtil\Debug\Debugf;
use Premierstacks\PhpUtil\Debug\Errorf;
use Premierstacks\PhpUtil\Enums\Undefined;

class Filter
{
    /**
     * @template B of object
     *
     * @param class-string<B> $class
     * @param Undefined|class-string<B> $default
     *
     * @return class-string<B>
     */
    public static function a(mixed $value, string $class, Undefined|string $default = Undefined::value, \Throwable|null $throwable = null): string
    {
        if (\is_string($value) && \is_a($value, $class, true)) {
            return $value;
        }

        $parsed = \filter_var($value);

        if ($parsed !== false && \is_a($parsed, $class, true)) {
            return $parsed;
        }

        if ($default !== Undefined::value) {
            return $default;
        }

        throw $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', "class-string<{$class}>", $value));
    }

    /**
     * @param Undefined|array<int|string, mixed> $default
     *
     * @return array<int|string, mixed>
     */
    public static function array(mixed $value, Undefined|array $default = Undefined::value, \Throwable|null $throwable = null): array
    {
        if (\is_array($value)) {
            /** @phpstan-ignore-next-line */
            return $value;
        }

        if ($default !== Undefined::value) {
            return $default;
        }

        throw $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'array<int|string, mixed>', $value));
    }

    public static function arrayKey(mixed $value, Undefined|int|string $default = Undefined::value, \Throwable|null $throwable = null): int|string
    {
        if (\is_int($value)) {
            return $value;
        }

        $parsed = \filter_var($value, \FILTER_VALIDATE_INT);

        if ($parsed !== false) {
            return $parsed;
        }

        $parsed = \filter_var($value);

        if ($parsed !== false) {
            return $parsed;
        }

        if ($default !== Undefined::value) {
            return $default;
        }

        throw $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'int|string', $value));
    }

    /**
     * @template B
     *
     * @param callable(mixed): B $callback
     * @param Undefined|array<int|string, B> $default
     *
     * @return array<int|string, B>
     */
    public static function arrayOf(mixed $value, callable $callback, Undefined|array $default = Undefined::value, \Throwable|null $throwable = null): array
    {
        if (!\is_array($value)) {
            if ($default !== Undefined::value) {
                return $default;
            }

            throw $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'array<int|string, mixed>', $value));
        }

        foreach ($value as $v) {
            $expected = $callback($v);

            if ($v !== $expected) {
                if ($default !== Undefined::value) {
                    return $default;
                }

                throw new \UnexpectedValueException(Errorf::unexpectedValue('iterable value', Debugf::type($expected), $v));
            }
        }

        /** @phpstan-ignore-next-line */
        return $value;
    }

    public static function bool(mixed $value, Undefined|bool $default = Undefined::value, \Throwable|null $throwable = null): bool
    {
        if (\is_bool($value)) {
            return $value;
        }

        $parsed = \filter_var($value, \FILTER_VALIDATE_BOOLEAN, \FILTER_NULL_ON_FAILURE);

        if ($parsed !== null) {
            return $parsed;
        }

        if ($default !== Undefined::value) {
            return $default;
        }

        throw $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'bool', $value));
    }

    /**
     * @param Undefined|callable(): mixed $default
     *
     * @return callable(): mixed
     */
    public static function callable(mixed $value, Undefined|callable $default = Undefined::value, \Throwable|null $throwable = null): callable
    {
        if (\is_callable($value)) {
            return $value;
        }

        $parsed = \filter_var($value);

        if ($parsed !== false && \is_callable($parsed)) {
            return $parsed;
        }

        if ($default !== Undefined::value) {
            return $default;
        }

        throw $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'callable(): mixed', $value));
    }

    /**
     * @param Undefined|(callable(): mixed&string) $default
     *
     * @return callable(): mixed&string
     */
    public static function callableString(mixed $value, Undefined|string $default = Undefined::value, \Throwable|null $throwable = null): string
    {
        if (\is_string($value) && \is_callable($value)) {
            return $value;
        }

        $parsed = \filter_var($value);

        if ($parsed !== false && \is_callable($parsed)) {
            return $parsed;
        }

        if ($default !== Undefined::value) {
            return $default;
        }

        throw $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'callable-string', $value));
    }

    /**
     * @param Undefined|class-string $default
     *
     * @return class-string
     */
    public static function classString(mixed $value, Undefined|string $default = Undefined::value, \Throwable|null $throwable = null): string
    {
        if (\is_string($value) && \class_exists($value)) {
            return $value;
        }

        $parsed = \filter_var($value);

        if ($parsed !== false && \class_exists($parsed)) {
            return $parsed;
        }

        if ($default !== Undefined::value) {
            return $default;
        }

        throw $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'class-string', $value));
    }

    /**
     * @param Undefined|closed-resource $default
     *
     * @return closed-resource
     */
    public static function closedResource(mixed $value, mixed $default = Undefined::value, \Throwable|null $throwable = null): mixed
    {
        if ($value !== null && !\is_resource($value) && !\is_scalar($value) && !\is_array($value) && !\is_object($value)) {
            /** @phpstan-ignore-next-line */
            return $value;
        }

        if ($default !== Undefined::value) {
            return $default;
        }

        throw $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'closed-resource', $value));
    }

    /**
     * @param \Countable|Undefined|array<int|string, mixed> $default
     *
     * @return \Countable|array<int|string, mixed>
     */
    public static function countable(mixed $value, \Countable|Undefined|array $default = Undefined::value, \Throwable|null $throwable = null): \Countable|array
    {
        if (\is_countable($value)) {
            /** @phpstan-ignore-next-line */
            return $value;
        }

        if ($default !== Undefined::value) {
            return $default;
        }

        throw $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'countable', $value));
    }

    /**
     * @template B of \BackedEnum
     *
     * @param class-string<B> $enum
     */
    public static function enum(mixed $value, string $enum, \BackedEnum|Undefined $default = Undefined::value, \Throwable|null $throwable = null): \BackedEnum
    {
        if ($value instanceof $enum) {
            return $value;
        }

        if ((string) (new \ReflectionEnum($enum))->getBackingType() === 'int') {
            $parsed = \filter_var($value, \FILTER_VALIDATE_INT);
        } else {
            $parsed = \filter_var($value);
        }

        if ($parsed !== false) {
            $tried = $enum::tryFrom($parsed);

            if ($tried !== null) {
                return $tried;
            }
        }

        if ($default !== Undefined::value) {
            return $default;
        }

        throw $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', $enum, $value));
    }

    public static function false(mixed $value, Undefined|false $default = Undefined::value, \Throwable|null $throwable = null): false
    {
        if ($value === false) {
            return $value;
        }

        $parsed = \filter_var($value, \FILTER_VALIDATE_BOOLEAN, \FILTER_NULL_ON_FAILURE);

        if ($parsed === false) {
            return false;
        }

        if ($default !== Undefined::value) {
            return $default;
        }

        throw $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'false', $value));
    }

    public static function float(mixed $value, Undefined|float $default = Undefined::value, \Throwable|null $throwable = null): float
    {
        if (\is_float($value)) {
            return $value;
        }

        $parsed = \filter_var($value, \FILTER_VALIDATE_FLOAT);

        if ($parsed !== false) {
            return $parsed;
        }

        if ($default !== Undefined::value) {
            return $default;
        }

        throw $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'float', $value));
    }

    /**
     * @template B
     *
     * @param array<int|string, B> $enum
     * @param B|Undefined $default
     *
     * @return B
     */
    public static function in(mixed $value, array $enum, mixed $default = Undefined::value, \Throwable|null $throwable = null): mixed
    {
        if (\in_array($value, $enum, true)) {
            return $value;
        }

        if ($default !== Undefined::value) {
            return $default;
        }

        throw $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', Debugf::types($enum), $value));
    }

    /**
     * @template B of object
     *
     * @param class-string<B> $class
     * @param B|Undefined $default
     *
     * @return B
     */
    public static function instance(mixed $value, string $class, object $default = Undefined::value, \Throwable|null $throwable = null): object
    {
        if ($value instanceof $class) {
            return $value;
        }

        if ($default !== Undefined::value) {
            return $default;
        }

        throw $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', $class, $value));
    }

    public static function int(mixed $value, Undefined|int $default = Undefined::value, \Throwable|null $throwable = null): int
    {
        if (\is_int($value)) {
            return $value;
        }

        $parsed = \filter_var($value, \FILTER_VALIDATE_INT);

        if ($parsed !== false) {
            return $parsed;
        }

        if ($default !== Undefined::value) {
            return $default;
        }

        throw $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'int', $value));
    }

    /**
     * @param Undefined|array<int, mixed> $default
     *
     * @return array<int, mixed>
     */
    public static function intArray(mixed $value, Undefined|array $default = Undefined::value, \Throwable|null $throwable = null): array
    {
        if (!\is_array($value)) {
            if ($default !== Undefined::value) {
                return $default;
            }

            throw $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'array<int, mixed>', $value));
        }

        foreach ($value as $k => $v) {
            if (!\is_int($k)) {
                if ($default !== Undefined::value) {
                    return $default;
                }

                throw $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'array<int, mixed>', $value));
            }
        }

        /** @phpstan-ignore-next-line */
        return $value;
    }

    /**
     * @template B
     *
     * @param callable(mixed): B $callback
     * @param Undefined|array<int, B> $default
     *
     * @return array<int, B>
     */
    public static function intArrayOf(mixed $value, callable $callback, Undefined|array $default = Undefined::value, \Throwable|null $throwable = null): array
    {
        if (!\is_array($value)) {
            if ($default !== Undefined::value) {
                return $default;
            }

            throw $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'array<int, mixed>', $value));
        }

        foreach ($value as $k => $v) {
            if (!\is_int($k)) {
                if ($default !== Undefined::value) {
                    return $default;
                }

                throw $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'array<int, mixed>', $value));
            }

            $expected = $callback($v);

            if ($v !== $expected) {
                if ($default !== Undefined::value) {
                    return $default;
                }

                throw new \UnexpectedValueException(Errorf::unexpectedValue('iterable value', Debugf::type($expected), $v));
            }
        }

        /** @phpstan-ignore-next-line */
        return $value;
    }

    /**
     * @template B of \BackedEnum
     *
     * @param class-string<B> $enum
     */
    public static function intEnum(mixed $value, string $enum, \BackedEnum|Undefined $default = Undefined::value, \Throwable|null $throwable = null): \BackedEnum
    {
        if ($value instanceof $enum) {
            return $value;
        }

        $parsed = \filter_var($value, \FILTER_VALIDATE_INT);

        if ($parsed !== false) {
            $tried = $enum::tryFrom($parsed);

            if ($tried !== null) {
                return $tried;
            }
        }

        if ($default !== Undefined::value) {
            return $default;
        }

        throw $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', $enum, $value));
    }

    /**
     * @param Undefined|iterable<int, mixed> $default
     *
     * @return iterable<int, mixed>
     */
    public static function intIterable(mixed $value, Undefined|iterable $default = Undefined::value, \Throwable|null $throwable = null): iterable
    {
        if (!\is_iterable($value)) {
            if ($default !== Undefined::value) {
                return $default;
            }

            throw $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'iterable<int, mixed>', $value));
        }

        foreach ($value as $k => $v) {
            if (!\is_int($k)) {
                if ($default !== Undefined::value) {
                    return $default;
                }

                throw $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'iterable<int, mixed>', $value));
            }
        }

        /** @phpstan-ignore-next-line */
        return $value;
    }

    /**
     * @template B
     *
     * @param callable(mixed): B $callback
     * @param Undefined|iterable<int, B> $default
     *
     * @return iterable<int, B>
     */
    public static function intIterableOf(mixed $value, callable $callback, Undefined|iterable $default = Undefined::value, \Throwable|null $throwable = null): iterable
    {
        if (!\is_iterable($value)) {
            if ($default !== Undefined::value) {
                return $default;
            }

            throw $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'iterable<int, mixed>', $value));
        }

        foreach ($value as $k => $v) {
            if (!\is_int($k)) {
                if ($default !== Undefined::value) {
                    return $default;
                }

                throw $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'iterable<int, mixed>', $value));
            }

            $expected = $callback($v);

            if ($v !== $expected) {
                if ($default !== Undefined::value) {
                    return $default;
                }

                throw new \UnexpectedValueException(Errorf::unexpectedValue('iterable value', Debugf::type($expected), $v));
            }
        }

        /** @phpstan-ignore-next-line */
        return $value;
    }

    /**
     * @param Undefined|interface-string $default
     *
     * @return interface-string
     */
    public static function interfaceString(mixed $value, Undefined|string $default = Undefined::value, \Throwable|null $throwable = null): string
    {
        if (\is_string($value) && \interface_exists($value)) {
            return $value;
        }

        $parsed = \filter_var($value);

        if ($parsed !== false && \interface_exists($parsed)) {
            return $parsed;
        }

        if ($default !== Undefined::value) {
            return $default;
        }

        throw $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'interface-string', $value));
    }

    /**
     * @param Undefined|iterable<int|string, mixed> $default
     *
     * @return iterable<int|string, mixed>
     */
    public static function iterable(mixed $value, Undefined|iterable $default = Undefined::value, \Throwable|null $throwable = null): iterable
    {
        if (\is_iterable($value)) {
            /** @phpstan-ignore-next-line */
            return $value;
        }

        if ($default !== Undefined::value) {
            return $default;
        }

        throw $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'iterable<int|string, mixed>', $value));
    }

    /**
     * @template B
     *
     * @param callable(mixed): B $callback
     * @param Undefined|iterable<int|string, B> $default
     *
     * @return iterable<int|string, B>
     */
    public static function iterableOf(mixed $value, callable $callback, Undefined|iterable $default = Undefined::value, \Throwable|null $throwable = null): iterable
    {
        if (!\is_iterable($value)) {
            if ($default !== Undefined::value) {
                return $default;
            }

            throw $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'iterable<int|string, mixed>', $value));
        }

        foreach ($value as $v) {
            $expected = $callback($v);

            if ($v !== $expected) {
                if ($default !== Undefined::value) {
                    return $default;
                }

                throw new \UnexpectedValueException(Errorf::unexpectedValue('iterable value', Debugf::type($expected), $v));
            }
        }

        /** @phpstan-ignore-next-line */
        return $value;
    }

    /**
     * @param Undefined|list<mixed> $default
     *
     * @return list<mixed>
     */
    public static function list(mixed $value, Undefined|array $default = Undefined::value, \Throwable|null $throwable = null): array
    {
        if (\is_array($value) && \array_is_list($value)) {
            return $value;
        }

        if ($default !== Undefined::value) {
            return $default;
        }

        throw $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'list<mixed>', $value));
    }

    /**
     * @template B
     *
     * @param callable(mixed): B $callback
     * @param Undefined|list<B> $default
     *
     * @return list<B>
     */
    public static function listOf(mixed $value, callable $callback, Undefined|array $default = Undefined::value, \Throwable|null $throwable = null): array
    {
        if (!\is_array($value)) {
            if ($default !== Undefined::value) {
                return $default;
            }

            throw $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'list<mixed>', $value));
        }

        if (!\array_is_list($value)) {
            if ($default !== Undefined::value) {
                return $default;
            }

            throw $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'list<mixed>', $value));
        }

        foreach ($value as $v) {
            $expected = $callback($v);

            if ($v !== $expected) {
                if ($default !== Undefined::value) {
                    return $default;
                }

                throw new \UnexpectedValueException(Errorf::unexpectedValue('iterable value', Debugf::type($expected), $v));
            }
        }

        return $value;
    }

    /**
     * @param Undefined|negative-int $default
     *
     * @return negative-int
     */
    public static function negativeInt(mixed $value, Undefined|int $default = Undefined::value, \Throwable|null $throwable = null): int
    {
        if (\is_int($value) && $value < 0) {
            return $value;
        }

        $parsed = \filter_var($value, \FILTER_VALIDATE_INT);

        if ($parsed !== false && $parsed < 0) {
            return $parsed;
        }

        if ($default !== Undefined::value) {
            return $default;
        }

        throw $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'negative-int', $value));
    }

    /**
     * @param Undefined|non-empty-array<int|string, mixed> $default
     *
     * @return non-empty-array<int|string, mixed>
     */
    public static function nonEmptyArray(mixed $value, Undefined|array $default = Undefined::value, \Throwable|null $throwable = null): array
    {
        if (\is_array($value) && $value !== []) {
            /** @phpstan-ignore-next-line */
            return $value;
        }

        if ($default !== Undefined::value) {
            return $default;
        }

        throw $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'non-empty-array<int|string, mixed>', $value));
    }

    /**
     * @template B
     *
     * @param callable(mixed): B $callback
     * @param Undefined|non-empty-array<int|string, B> $default
     *
     * @return non-empty-array<int|string, B>
     */
    public static function nonEmptyArrayOf(mixed $value, callable $callback, Undefined|array $default = Undefined::value, \Throwable|null $throwable = null): array
    {
        if (!\is_array($value)) {
            if ($default !== Undefined::value) {
                return $default;
            }

            throw $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'non-empty-array<int|string, mixed>', $value));
        }

        if ($value === []) {
            if ($default !== Undefined::value) {
                return $default;
            }

            throw $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'non-empty-array<int|string, mixed>', $value));
        }

        foreach ($value as $v) {
            $expected = $callback($v);

            if ($v !== $expected) {
                if ($default !== Undefined::value) {
                    return $default;
                }

                throw new \UnexpectedValueException(Errorf::unexpectedValue('iterable value', Debugf::type($expected), $v));
            }
        }

        /** @phpstan-ignore-next-line */
        return $value;
    }

    /**
     * @param Undefined|non-empty-array<int, mixed> $default
     *
     * @return non-empty-array<int, mixed>
     */
    public static function nonEmptyIntArray(mixed $value, Undefined|array $default = Undefined::value, \Throwable|null $throwable = null): array
    {
        if (!\is_array($value)) {
            if ($default !== Undefined::value) {
                return $default;
            }

            throw $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'non-empty-array<int, mixed>', $value));
        }

        if ($value === []) {
            if ($default !== Undefined::value) {
                return $default;
            }

            throw $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'non-empty-array<int, mixed>', $value));
        }

        foreach ($value as $k => $v) {
            if (!\is_int($k)) {
                if ($default !== Undefined::value) {
                    return $default;
                }

                throw $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'non-empty-array<int, mixed>', $value));
            }
        }

        /** @phpstan-ignore-next-line */
        return $value;
    }

    /**
     * @template B
     *
     * @param callable(mixed): B $callback
     * @param Undefined|non-empty-array<int, B> $default
     *
     * @return non-empty-array<int, B>
     */
    public static function nonEmptyIntArrayOf(mixed $value, callable $callback, Undefined|array $default = Undefined::value, \Throwable|null $throwable = null): array
    {
        if (!\is_array($value)) {
            if ($default !== Undefined::value) {
                return $default;
            }

            throw $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'non-empty-array<int, mixed>', $value));
        }

        if ($value === []) {
            if ($default !== Undefined::value) {
                return $default;
            }

            throw $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'non-empty-array<int, mixed>', $value));
        }

        foreach ($value as $k => $v) {
            if (!\is_int($k)) {
                if ($default !== Undefined::value) {
                    return $default;
                }

                throw $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'non-empty-array<int, mixed>', $value));
            }

            $expected = $callback($v);

            if ($v !== $expected) {
                if ($default !== Undefined::value) {
                    return $default;
                }

                throw new \UnexpectedValueException(Errorf::unexpectedValue('iterable value', Debugf::type($expected), $v));
            }
        }

        /** @phpstan-ignore-next-line */
        return $value;
    }

    /**
     * @param Undefined|non-empty-list<mixed> $default
     *
     * @return non-empty-list<mixed>
     */
    public static function nonEmptyList(mixed $value, Undefined|array $default = Undefined::value, \Throwable|null $throwable = null): array
    {
        if (\is_array($value) && $value !== [] && \array_is_list($value)) {
            return $value;
        }

        if ($default !== Undefined::value) {
            return $default;
        }

        throw $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'non-empty-list<mixed>', $value));
    }

    /**
     * @template B
     *
     * @param callable(mixed): B $callback
     * @param Undefined|non-empty-list<B> $default
     *
     * @return non-empty-list<B>
     */
    public static function nonEmptyListOf(mixed $value, callable $callback, Undefined|array $default = Undefined::value, \Throwable|null $throwable = null): array
    {
        if (!\is_array($value)) {
            if ($default !== Undefined::value) {
                return $default;
            }

            throw $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'non-empty-list<mixed>', $value));
        }

        if ($value === []) {
            if ($default !== Undefined::value) {
                return $default;
            }

            throw $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'non-empty-list<mixed>', $value));
        }

        if (!\array_is_list($value)) {
            if ($default !== Undefined::value) {
                return $default;
            }

            throw $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'non-empty-list<mixed>', $value));
        }

        foreach ($value as $v) {
            $expected = $callback($v);

            if ($v !== $expected) {
                if ($default !== Undefined::value) {
                    return $default;
                }

                throw new \UnexpectedValueException(Errorf::unexpectedValue('iterable value', Debugf::type($expected), $v));
            }
        }

        return $value;
    }

    /**
     * @param Undefined|non-empty-string $default
     *
     * @return non-empty-string
     */
    public static function nonEmptyString(mixed $value, Undefined|string $default = Undefined::value, \Throwable|null $throwable = null): string
    {
        if (\is_string($value) && $value !== '') {
            return $value;
        }

        $parsed = \filter_var($value);

        if ($parsed !== false && $parsed !== '') {
            return $parsed;
        }

        if ($default !== Undefined::value) {
            return $default;
        }

        throw $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'non-empty-string', $value));
    }

    /**
     * @param Undefined|non-empty-array<string, mixed> $default
     *
     * @return non-empty-array<string, mixed>
     */
    public static function nonEmptyStringArray(mixed $value, Undefined|array $default = Undefined::value, \Throwable|null $throwable = null): array
    {
        if (!\is_array($value)) {
            if ($default !== Undefined::value) {
                return $default;
            }

            throw $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'non-empty-array<string, mixed>', $value));
        }

        if ($value === []) {
            if ($default !== Undefined::value) {
                return $default;
            }

            throw $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'non-empty-array<string, mixed>', $value));
        }

        foreach ($value as $k => $v) {
            if (!\is_string($k)) {
                if ($default !== Undefined::value) {
                    return $default;
                }

                throw $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'non-empty-array<string, mixed>', $value));
            }
        }

        /** @phpstan-ignore-next-line */
        return $value;
    }

    /**
     * @template B
     *
     * @param callable(mixed): B $callback
     * @param Undefined|non-empty-array<string, B> $default
     *
     * @return non-empty-array<string, B>
     */
    public static function nonEmptyStringArrayOf(mixed $value, callable $callback, Undefined|array $default = Undefined::value, \Throwable|null $throwable = null): array
    {
        if (!\is_array($value)) {
            if ($default !== Undefined::value) {
                return $default;
            }

            throw $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'non-empty-array<string, mixed>', $value));
        }

        if ($value === []) {
            if ($default !== Undefined::value) {
                return $default;
            }

            throw $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'non-empty-array<string, mixed>', $value));
        }

        foreach ($value as $k => $v) {
            if (!\is_string($k)) {
                if ($default !== Undefined::value) {
                    return $default;
                }

                throw $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'non-empty-array<string, mixed>', $value));
            }

            $expected = $callback($v);

            if ($v !== $expected) {
                if ($default !== Undefined::value) {
                    return $default;
                }

                throw new \UnexpectedValueException(Errorf::unexpectedValue('iterable value', Debugf::type($expected), $v));
            }
        }

        /** @phpstan-ignore-next-line */
        return $value;
    }

    /**
     * @param Undefined|non-falsy-string $default
     *
     * @return non-falsy-string
     */
    public static function nonFalsyString(mixed $value, Undefined|string $default = Undefined::value, \Throwable|null $throwable = null): string
    {
        if (\is_string($value) && (bool) $value) {
            /** @phpstan-ignore-next-line */
            return $value;
        }

        $parsed = \filter_var($value);

        if ($parsed !== false && (bool) $parsed) {
            /** @phpstan-ignore-next-line */
            return $parsed;
        }

        if ($default !== Undefined::value) {
            return $default;
        }

        throw $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'non-falsy-string', $value));
    }

    /**
     * @param Undefined|non-negative-int $default
     *
     * @return non-negative-int
     */
    public static function nonNegativeInt(mixed $value, Undefined|int $default = Undefined::value, \Throwable|null $throwable = null): int
    {
        if (\is_int($value) && $value >= 0) {
            return $value;
        }

        $parsed = \filter_var($value, \FILTER_VALIDATE_INT);

        if ($parsed !== false && $parsed >= 0) {
            return $parsed;
        }

        if ($default !== Undefined::value) {
            return $default;
        }

        throw $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'non-negative-int', $value));
    }

    /**
     * @param Undefined|non-positive-int $default
     *
     * @return non-positive-int
     */
    public static function nonPositiveInt(mixed $value, Undefined|int $default = Undefined::value, \Throwable|null $throwable = null): int
    {
        if (\is_int($value) && $value <= 0) {
            return $value;
        }

        $parsed = \filter_var($value, \FILTER_VALIDATE_INT);

        if ($parsed !== false && $parsed <= 0) {
            return $parsed;
        }

        if ($default !== Undefined::value) {
            return $default;
        }

        throw $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'non-positive-int', $value));
    }

    /**
     * @param Undefined|non-zero-int $default
     *
     * @return non-zero-int
     */
    public static function nonZeroInt(mixed $value, Undefined|int $default = Undefined::value, \Throwable|null $throwable = null): int
    {
        if (\is_int($value) && $value !== 0) {
            return $value;
        }

        $parsed = \filter_var($value, \FILTER_VALIDATE_INT);

        if ($parsed !== false && $parsed !== 0) {
            return $parsed;
        }

        if ($default !== Undefined::value) {
            return $default;
        }

        throw $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'non-zero-int', $value));
    }

    public static function notFalse(mixed $value, mixed $default = Undefined::value, \Throwable|null $throwable = null): mixed
    {
        $parsed = \filter_var($value, \FILTER_VALIDATE_BOOLEAN, \FILTER_NULL_ON_FAILURE);

        if ($parsed !== false) {
            return $value;
        }

        if ($default !== Undefined::value) {
            return $default;
        }

        throw $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', '!false', $value));
    }

    public static function notNegativeOne(mixed $value, mixed $default = Undefined::value, \Throwable|null $throwable = null): mixed
    {
        $parsed = \filter_var($value, \FILTER_VALIDATE_INT);

        if ($parsed !== false && $parsed !== -1) {
            return $parsed;
        }

        if ($default !== Undefined::value) {
            return $default;
        }

        throw $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', '!-1', $value));
    }

    public static function notNull(mixed $value, mixed $default = Undefined::value, \Throwable|null $throwable = null): mixed
    {
        if ($value !== null) {
            return $value;
        }

        if ($default !== Undefined::value) {
            return $default;
        }

        throw $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', '!null', $value));
    }

    public static function notPositiveOne(mixed $value, mixed $default = Undefined::value, \Throwable|null $throwable = null): mixed
    {
        $parsed = \filter_var($value, \FILTER_VALIDATE_INT);

        if ($parsed !== false && $parsed !== 1) {
            return $parsed;
        }

        if ($default !== Undefined::value) {
            return $default;
        }

        throw $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', '!1', $value));
    }

    public static function notTrue(mixed $value, mixed $default = Undefined::value, \Throwable|null $throwable = null): mixed
    {
        $parsed = \filter_var($value, \FILTER_VALIDATE_BOOLEAN, \FILTER_NULL_ON_FAILURE);

        if ($parsed !== true) {
            return $value;
        }

        if ($default !== Undefined::value) {
            return $default;
        }

        throw $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', '!true', $value));
    }

    public static function notZero(mixed $value, mixed $default = Undefined::value, \Throwable|null $throwable = null): mixed
    {
        $parsed = \filter_var($value, \FILTER_VALIDATE_INT);

        if ($parsed !== false && $parsed !== 0) {
            return $parsed;
        }

        if ($default !== Undefined::value) {
            return $default;
        }

        throw $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', '!0', $value));
    }

    public static function null(mixed $value, Undefined|null $default = Undefined::value, \Throwable|null $throwable = null): null
    {
        if ($value === null) {
            return $value;
        }

        if ($default !== Undefined::value) {
            return $default;
        }

        throw $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'null', $value));
    }

    /**
     * @template B of object
     *
     * @param class-string<B> $class
     * @param Undefined|class-string<B>|null $default
     *
     * @return class-string<B>|null
     */
    public static function nullableA(mixed $value, string $class, Undefined|string|null $default = Undefined::value, \Throwable|null $throwable = null): string|null
    {
        if ($value === null || (\is_string($value) && \is_a($value, $class, true))) {
            return $value;
        }

        $parsed = \filter_var($value);

        if ($parsed !== false && \is_a($parsed, $class, true)) {
            return $parsed;
        }

        if ($default !== Undefined::value) {
            return $default;
        }

        throw $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', "class-string<{$class}>|null", $value));
    }

    /**
     * @param Undefined|array<int|string, mixed>|null $default
     *
     * @return array<int|string, mixed>|null
     */
    public static function nullableArray(mixed $value, Undefined|array|null $default = Undefined::value, \Throwable|null $throwable = null): array|null
    {
        if ($value === null || \is_array($value)) {
            /** @phpstan-ignore-next-line */
            return $value;
        }

        if ($default !== Undefined::value) {
            return $default;
        }

        throw $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'array<int|string, mixed>|null', $value));
    }

    public static function nullableArrayKey(mixed $value, Undefined|int|string|null $default = Undefined::value, \Throwable|null $throwable = null): int|string|null
    {
        if ($value === null || \is_int($value)) {
            return $value;
        }

        $parsed = \filter_var($value, \FILTER_VALIDATE_INT);

        if ($parsed !== false) {
            return $parsed;
        }

        $parsed = \filter_var($value);

        if ($parsed !== false) {
            return $parsed;
        }

        if ($default !== Undefined::value) {
            return $default;
        }

        throw $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'int|string|null', $value));
    }

    /**
     * @template B
     *
     * @param callable(mixed): B $callback
     * @param Undefined|array<int|string, B>|null $default
     *
     * @return array<int|string, B>|null
     */
    public static function nullableArrayOf(mixed $value, callable $callback, Undefined|array|null $default = Undefined::value, \Throwable|null $throwable = null): array|null
    {
        if ($value === null) {
            return $value;
        }

        if (!\is_array($value)) {
            if ($default !== Undefined::value) {
                return $default;
            }

            throw $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'array<int|string, mixed>|null', $value));
        }

        foreach ($value as $v) {
            $expected = $callback($v);

            if ($v !== $expected) {
                if ($default !== Undefined::value) {
                    return $default;
                }

                throw new \UnexpectedValueException(Errorf::unexpectedValue('iterable value', Debugf::type($expected), $v));
            }
        }

        /** @phpstan-ignore-next-line */
        return $value;
    }

    public static function nullableBool(mixed $value, Undefined|bool|null $default = Undefined::value, \Throwable|null $throwable = null): bool|null
    {
        if ($value === null || \is_bool($value)) {
            return $value;
        }

        $parsed = \filter_var($value, \FILTER_VALIDATE_BOOLEAN, \FILTER_NULL_ON_FAILURE);

        if ($parsed !== null) {
            return $parsed;
        }

        if ($default !== Undefined::value) {
            return $default;
        }

        throw $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'bool|null', $value));
    }

    /**
     * @param Undefined|callable(): mixed|null $default
     *
     * @return callable(): mixed|null
     */
    public static function nullableCallable(mixed $value, Undefined|callable|null $default = Undefined::value, \Throwable|null $throwable = null): callable|null
    {
        if ($value === null || \is_callable($value)) {
            return $value;
        }

        $parsed = \filter_var($value);

        if ($parsed !== false && \is_callable($parsed)) {
            return $parsed;
        }

        if ($default !== Undefined::value) {
            return $default;
        }

        throw $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'callable(): mixed|null', $value));
    }

    /**
     * @param Undefined|(callable(): mixed&string)|null $default
     *
     * @return (callable(): mixed&string)|null
     */
    public static function nullableCallableString(mixed $value, Undefined|string|null $default = Undefined::value, \Throwable|null $throwable = null): string|null
    {
        if ($value === null || \is_string($value) && \is_callable($value)) {
            return $value;
        }

        $parsed = \filter_var($value);

        if ($parsed !== false && \is_callable($parsed)) {
            return $parsed;
        }

        if ($default !== Undefined::value) {
            return $default;
        }

        throw $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'callable-string|null', $value));
    }

    /**
     * @param Undefined|class-string|null $default
     *
     * @return class-string|null
     */
    public static function nullableClassString(mixed $value, Undefined|string|null $default = Undefined::value, \Throwable|null $throwable = null): string|null
    {
        if ($value === null || \is_string($value) && \class_exists($value)) {
            return $value;
        }

        $parsed = \filter_var($value);

        if ($parsed !== false && \class_exists($parsed)) {
            return $parsed;
        }

        if ($default !== Undefined::value) {
            return $default;
        }

        throw $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'class-string|null', $value));
    }

    /**
     * @param Undefined|closed-resource|null $default
     *
     * @return closed-resource|null
     */
    public static function nullableClosedResource(mixed $value, mixed $default = Undefined::value, \Throwable|null $throwable = null): mixed
    {
        if ($value === null || (!\is_scalar($value) && !\is_resource($value) && !\is_array($value) && !\is_object($value))) {
            /** @phpstan-ignore-next-line */
            return $value;
        }

        if ($default !== Undefined::value) {
            return $default;
        }

        throw $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'closed-resource|null', $value));
    }

    /**
     * @param \Countable|Undefined|array<int|string, mixed>|null $default
     *
     * @return \Countable|array<int|string, mixed>|null
     */
    public static function nullableCountable(mixed $value, \Countable|Undefined|array|null $default = Undefined::value, \Throwable|null $throwable = null): \Countable|array|null
    {
        if ($value === null || \is_countable($value)) {
            /** @phpstan-ignore-next-line */
            return $value;
        }

        if ($default !== Undefined::value) {
            return $default;
        }

        throw $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'countable|null', $value));
    }

    /**
     * @template B of \BackedEnum
     *
     * @param class-string<B> $enum
     */
    public static function nullableEnum(mixed $value, string $enum, \BackedEnum|Undefined|null $default = Undefined::value, \Throwable|null $throwable = null): \BackedEnum|null
    {
        if ($value === null || $value instanceof $enum) {
            return $value;
        }

        if ((string) (new \ReflectionEnum($enum))->getBackingType() === 'int') {
            $parsed = \filter_var($value, \FILTER_VALIDATE_INT);
        } else {
            $parsed = \filter_var($value);
        }

        if ($parsed !== false) {
            $tried = $enum::tryFrom($parsed);

            if ($tried !== null) {
                return $tried;
            }
        }

        if ($default !== Undefined::value) {
            return $default;
        }

        throw $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', "{$enum}|null", $value));
    }

    public static function nullableFalse(mixed $value, Undefined|false|null $default = Undefined::value, \Throwable|null $throwable = null): false|null
    {
        if ($value === null || $value === false) {
            return $value;
        }

        $parsed = \filter_var($value, \FILTER_VALIDATE_BOOLEAN, \FILTER_NULL_ON_FAILURE);

        if ($parsed === false) {
            return false;
        }

        if ($default !== Undefined::value) {
            return $default;
        }

        throw $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'false|null', $value));
    }

    public static function nullableFloat(mixed $value, Undefined|float|null $default = Undefined::value, \Throwable|null $throwable = null): float|null
    {
        if ($value === null || \is_float($value)) {
            return $value;
        }

        $parsed = \filter_var($value, \FILTER_VALIDATE_FLOAT);

        if ($parsed !== false) {
            return $parsed;
        }

        if ($default !== Undefined::value) {
            return $default;
        }

        throw $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'float|null', $value));
    }

    /**
     * @template B
     *
     * @param array<int|string, B> $enum
     * @param B|Undefined|null $default
     *
     * @return B|null
     */
    public static function nullableIn(mixed $value, array $enum, mixed $default = Undefined::value, \Throwable|null $throwable = null): mixed
    {
        if ($value === null || \in_array($value, $enum, true)) {
            return $value;
        }

        if ($default !== Undefined::value) {
            return $default;
        }

        throw $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', Debugf::types($enum) . '|null', $value));
    }

    /**
     * @template B of object
     *
     * @param class-string<B> $class
     * @param B|Undefined|null $default
     *
     * @return B|null
     */
    public static function nullableInstance(mixed $value, string $class, object|null $default = Undefined::value, \Throwable|null $throwable = null): object|null
    {
        if ($value === null || $value instanceof $class) {
            return $value;
        }

        if ($default !== Undefined::value) {
            return $default;
        }

        throw $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', "{$class}|null", $value));
    }

    public static function nullableInt(mixed $value, Undefined|int|null $default = Undefined::value, \Throwable|null $throwable = null): int|null
    {
        if ($value === null || \is_int($value)) {
            return $value;
        }

        $parsed = \filter_var($value, \FILTER_VALIDATE_INT);

        if ($parsed !== false) {
            return $parsed;
        }

        if ($default !== Undefined::value) {
            return $default;
        }

        throw $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'int|null', $value));
    }

    /**
     * @param Undefined|array<int, mixed>|null $default
     *
     * @return array<int, mixed>|null
     */
    public static function nullableIntArray(mixed $value, Undefined|array|null $default = Undefined::value, \Throwable|null $throwable = null): array|null
    {
        if ($value === null) {
            return $value;
        }

        if (!\is_array($value)) {
            if ($default !== Undefined::value) {
                return $default;
            }

            throw $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'array<int, mixed>|null', $value));
        }

        foreach ($value as $k => $v) {
            if (!\is_int($k)) {
                if ($default !== Undefined::value) {
                    return $default;
                }

                throw $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'array<int, mixed>|null', $value));
            }
        }

        /** @phpstan-ignore-next-line */
        return $value;
    }

    /**
     * @template B
     *
     * @param callable(mixed): B $callback
     * @param Undefined|array<int, B>|null $default
     *
     * @return array<int, B>|null
     */
    public static function nullableIntArrayOf(mixed $value, callable $callback, Undefined|array|null $default = Undefined::value, \Throwable|null $throwable = null): array|null
    {
        if ($value === null) {
            return $value;
        }

        if (!\is_array($value)) {
            if ($default !== Undefined::value) {
                return $default;
            }

            throw $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'array<int, mixed>|null', $value));
        }

        foreach ($value as $k => $v) {
            if (!\is_int($k)) {
                if ($default !== Undefined::value) {
                    return $default;
                }

                throw $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'array<int, mixed>|null', $value));
            }
            $expected = $callback($v);

            if ($v !== $expected) {
                if ($default !== Undefined::value) {
                    return $default;
                }

                throw new \UnexpectedValueException(Errorf::unexpectedValue('iterable value', Debugf::type($expected), $v));
            }
        }

        /** @phpstan-ignore-next-line */
        return $value;
    }

    /**
     * @template B of \BackedEnum
     *
     * @param class-string<B> $enum
     */
    public static function nullableIntEnum(mixed $value, string $enum, \BackedEnum|Undefined|null $default = Undefined::value, \Throwable|null $throwable = null): \BackedEnum|null
    {
        if ($value === null || $value instanceof $enum) {
            return $value;
        }

        $parsed = \filter_var($value, \FILTER_VALIDATE_INT);

        if ($parsed !== false) {
            $tried = $enum::tryFrom($parsed);

            if ($tried !== null) {
                return $tried;
            }
        }

        if ($default !== Undefined::value) {
            return $default;
        }

        throw $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', "{$enum}|null", $value));
    }

    /**
     * @param Undefined|iterable<int, mixed>|null $default
     *
     * @return iterable<int, mixed>|null
     */
    public static function nullableIntIterable(mixed $value, Undefined|iterable|null $default = Undefined::value, \Throwable|null $throwable = null): iterable|null
    {
        if ($value === null) {
            return $value;
        }

        if (!\is_iterable($value)) {
            if ($default !== Undefined::value) {
                return $default;
            }

            throw $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'iterable<int, mixed>|null', $value));
        }

        foreach ($value as $k => $v) {
            if (!\is_int($k)) {
                if ($default !== Undefined::value) {
                    return $default;
                }

                throw $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'iterable<int, mixed>|null', $value));
            }
        }

        /** @phpstan-ignore-next-line */
        return $value;
    }

    /**
     * @template B
     *
     * @param callable(mixed): B $callback
     * @param Undefined|iterable<int, B>|null $default
     *
     * @return iterable<int, B>|null
     */
    public static function nullableIntIterableOf(mixed $value, callable $callback, Undefined|iterable|null $default = Undefined::value, \Throwable|null $throwable = null): iterable|null
    {
        if ($value === null) {
            return $value;
        }

        if (!\is_iterable($value)) {
            if ($default !== Undefined::value) {
                return $default;
            }

            throw $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'iterable<int, mixed>|null', $value));
        }

        foreach ($value as $k => $v) {
            if (!\is_int($k)) {
                if ($default !== Undefined::value) {
                    return $default;
                }

                throw $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'iterable<int, mixed>|null', $value));
            }

            $expected = $callback($v);

            if ($v !== $expected) {
                if ($default !== Undefined::value) {
                    return $default;
                }

                throw new \UnexpectedValueException(Errorf::unexpectedValue('iterable value', Debugf::type($expected), $v));
            }
        }

        /** @phpstan-ignore-next-line */
        return $value;
    }

    /**
     * @param Undefined|interface-string|null $default
     *
     * @return interface-string|null
     */
    public static function nullableInterfaceString(mixed $value, Undefined|string|null $default = Undefined::value, \Throwable|null $throwable = null): string|null
    {
        if ($value === null || \is_string($value) && \interface_exists($value)) {
            return $value;
        }

        $parsed = \filter_var($value);

        if ($parsed !== false && \interface_exists($parsed)) {
            return $parsed;
        }

        if ($default !== Undefined::value) {
            return $default;
        }

        throw $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'interface-string|null', $value));
    }

    /**
     * @param Undefined|iterable<int|string, mixed>|null $default
     *
     * @return iterable<int|string, mixed>|null
     */
    public static function nullableIterable(mixed $value, Undefined|iterable|null $default = Undefined::value, \Throwable|null $throwable = null): iterable|null
    {
        if ($value === null || \is_iterable($value)) {
            /** @phpstan-ignore-next-line */
            return $value;
        }

        if ($default !== Undefined::value) {
            return $default;
        }

        throw $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'iterable<int|string, mixed>|null', $value));
    }

    /**
     * @template B
     *
     * @param callable(mixed): B $callback
     * @param Undefined|iterable<int|string, B>|null $default
     *
     * @return iterable<int|string, B>|null
     */
    public static function nullableIterableOf(mixed $value, callable $callback, Undefined|iterable|null $default = Undefined::value, \Throwable|null $throwable = null): iterable|null
    {
        if ($value === null) {
            return $value;
        }

        if (!\is_iterable($value)) {
            if ($default !== Undefined::value) {
                return $default;
            }

            throw $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'iterable<int|string, mixed>|null', $value));
        }

        foreach ($value as $v) {
            $expected = $callback($v);

            if ($v !== $expected) {
                if ($default !== Undefined::value) {
                    return $default;
                }

                throw new \UnexpectedValueException(Errorf::unexpectedValue('iterable value', Debugf::type($expected), $v));
            }
        }

        /** @phpstan-ignore-next-line */
        return $value;
    }

    /**
     * @param Undefined|list<mixed>|null $default
     *
     * @return list<mixed>|null
     */
    public static function nullableList(mixed $value, Undefined|array|null $default = Undefined::value, \Throwable|null $throwable = null): array|null
    {
        if ($value === null || \is_array($value) && \array_is_list($value)) {
            return $value;
        }

        if ($default !== Undefined::value) {
            return $default;
        }

        throw $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'list<mixed>|null', $value));
    }

    /**
     * @template B
     *
     * @param callable(mixed): B $callback
     * @param Undefined|list<B>|null $default
     *
     * @return list<B>|null
     */
    public static function nullableListOf(mixed $value, callable $callback, Undefined|array|null $default = Undefined::value, \Throwable|null $throwable = null): array|null
    {
        if ($value === null) {
            return $value;
        }

        if (!\is_array($value)) {
            if ($default !== Undefined::value) {
                return $default;
            }

            throw $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'list<mixed>|null', $value));
        }

        if (!\array_is_list($value)) {
            if ($default !== Undefined::value) {
                return $default;
            }

            throw $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'list<mixed>|null', $value));
        }

        foreach ($value as $v) {
            $expected = $callback($v);

            if ($v !== $expected) {
                if ($default !== Undefined::value) {
                    return $default;
                }

                throw new \UnexpectedValueException(Errorf::unexpectedValue('iterable value', Debugf::type($expected), $v));
            }
        }

        return $value;
    }

    /**
     * @param Undefined|negative-int|null $default
     *
     * @return negative-int|null
     */
    public static function nullableNegativeInt(mixed $value, Undefined|int|null $default = Undefined::value, \Throwable|null $throwable = null): int|null
    {
        if ($value === null || \is_int($value) && $value < 0) {
            return $value;
        }

        $parsed = \filter_var($value, \FILTER_VALIDATE_INT);

        if ($parsed !== false && $parsed < 0) {
            return $parsed;
        }

        if ($default !== Undefined::value) {
            return $default;
        }

        throw $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'negative-int|null', $value));
    }

    /**
     * @param Undefined|non-empty-array<int|string, mixed>|null $default
     *
     * @return non-empty-array<int|string, mixed>|null
     */
    public static function nullableNonEmptyArray(mixed $value, Undefined|array|null $default = Undefined::value, \Throwable|null $throwable = null): array|null
    {
        if ($value === null || \is_array($value) && $value !== []) {
            /** @phpstan-ignore-next-line */
            return $value;
        }

        if ($default !== Undefined::value) {
            return $default;
        }

        throw $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'non-empty-array<int|string, mixed>|null', $value));
    }

    /**
     * @template B
     *
     * @param callable(mixed): B $callback
     * @param Undefined|non-empty-array<int|string, B>|null $default
     *
     * @return non-empty-array<int|string, B>|null
     */
    public static function nullableNonEmptyArrayOf(mixed $value, callable $callback, Undefined|array|null $default = Undefined::value, \Throwable|null $throwable = null): array|null
    {
        if ($value === null) {
            return $value;
        }

        if (!\is_array($value)) {
            if ($default !== Undefined::value) {
                return $default;
            }

            throw $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'non-empty-array<int|string, mixed>|null', $value));
        }

        if ($value === []) {
            if ($default !== Undefined::value) {
                return $default;
            }

            throw $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'non-empty-array<int|string, mixed>|null', $value));
        }

        foreach ($value as $v) {
            $expected = $callback($v);

            if ($v !== $expected) {
                if ($default !== Undefined::value) {
                    return $default;
                }

                throw new \UnexpectedValueException(Errorf::unexpectedValue('iterable value', Debugf::type($expected), $v));
            }
        }

        /** @phpstan-ignore-next-line */
        return $value;
    }

    /**
     * @param Undefined|non-empty-array<int, mixed>|null $default
     *
     * @return non-empty-array<int, mixed>|null
     */
    public static function nullableNonEmptyIntArray(mixed $value, Undefined|array|null $default = Undefined::value, \Throwable|null $throwable = null): array|null
    {
        if ($value === null) {
            return $value;
        }

        if (!\is_array($value)) {
            if ($default !== Undefined::value) {
                return $default;
            }

            throw $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'non-empty-array<int, mixed>|null', $value));
        }

        if ($value === []) {
            if ($default !== Undefined::value) {
                return $default;
            }

            throw $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'non-empty-array<int, mixed>|null', $value));
        }

        foreach ($value as $k => $v) {
            if (!\is_int($k)) {
                if ($default !== Undefined::value) {
                    return $default;
                }

                throw $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'non-empty-array<int, mixed>|null', $value));
            }
        }

        /** @phpstan-ignore-next-line */
        return $value;
    }

    /**
     * @template B
     *
     * @param callable(mixed): B $callback
     * @param Undefined|non-empty-array<int, B>|null $default
     *
     * @return non-empty-array<int, B>|null
     */
    public static function nullableNonEmptyIntArrayOf(mixed $value, callable $callback, Undefined|array|null $default = Undefined::value, \Throwable|null $throwable = null): array|null
    {
        if ($value === null) {
            return $value;
        }

        if (!\is_array($value)) {
            if ($default !== Undefined::value) {
                return $default;
            }

            throw $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'non-empty-array<int, templatevv>|null', $value));
        }

        if ($value === []) {
            if ($default !== Undefined::value) {
                return $default;
            }

            throw $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'non-empty-array<int, templatevv>|null', $value));
        }

        foreach ($value as $k => $v) {
            if (!\is_int($k)) {
                if ($default !== Undefined::value) {
                    return $default;
                }

                throw $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'non-empty-array<int, templatevv>|null', $value));
            }

            $expected = $callback($v);

            if ($v !== $expected) {
                if ($default !== Undefined::value) {
                    return $default;
                }

                throw new \UnexpectedValueException(Errorf::unexpectedValue('iterable value', Debugf::type($expected), $v));
            }
        }

        /** @phpstan-ignore-next-line */
        return $value;
    }

    /**
     * @param Undefined|non-empty-list<mixed>|null $default
     *
     * @return non-empty-list<mixed>|null
     */
    public static function nullableNonEmptyList(mixed $value, Undefined|array|null $default = Undefined::value, \Throwable|null $throwable = null): array|null
    {
        if ($value === null || \is_array($value) && $value !== [] && \array_is_list($value)) {
            return $value;
        }

        if ($default !== Undefined::value) {
            return $default;
        }

        throw $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'non-empty-list<mixed>|null', $value));
    }

    /**
     * @template B
     *
     * @param callable(mixed): B $callback
     * @param Undefined|non-empty-list<B>|null $default
     *
     * @return non-empty-list<B>|null
     */
    public static function nullableNonEmptyListOf(mixed $value, callable $callback, Undefined|array|null $default = Undefined::value, \Throwable|null $throwable = null): array|null
    {
        if ($value === null) {
            return $value;
        }

        if (!\is_array($value)) {
            if ($default !== Undefined::value) {
                return $default;
            }

            throw $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'non-empty-list<mixed>|null', $value));
        }

        if ($value === []) {
            if ($default !== Undefined::value) {
                return $default;
            }

            throw $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'non-empty-list<mixed>|null', $value));
        }

        if (!\array_is_list($value)) {
            if ($default !== Undefined::value) {
                return $default;
            }

            throw $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'non-empty-list<mixed>|null', $value));
        }

        foreach ($value as $v) {
            $expected = $callback($v);

            if ($v !== $expected) {
                if ($default !== Undefined::value) {
                    return $default;
                }

                throw new \UnexpectedValueException(Errorf::unexpectedValue('iterable value', Debugf::type($expected), $v));
            }
        }

        return $value;
    }

    /**
     * @param Undefined|non-empty-string|null $default
     *
     * @return non-empty-string|null
     */
    public static function nullableNonEmptyString(mixed $value, Undefined|string|null $default = Undefined::value, \Throwable|null $throwable = null): string|null
    {
        if ($value === null || \is_string($value) && $value !== '') {
            return $value;
        }

        $parsed = \filter_var($value);

        if ($parsed !== false && $parsed !== '') {
            return $parsed;
        }

        if ($default !== Undefined::value) {
            return $default;
        }

        throw $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'non-empty-string', $value));
    }

    /**
     * @param Undefined|non-empty-array<string, mixed>|null $default
     *
     * @return non-empty-array<string, mixed>|null
     */
    public static function nullableNonEmptyStringArray(mixed $value, Undefined|array|null $default = Undefined::value, \Throwable|null $throwable = null): array|null
    {
        if ($value === null) {
            return $value;
        }

        if (!\is_array($value)) {
            if ($default !== Undefined::value) {
                return $default;
            }

            throw $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'non-empty-array<string, mixed>|null', $value));
        }

        if ($value === []) {
            if ($default !== Undefined::value) {
                return $default;
            }

            throw $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'non-empty-array<string, mixed>|null', $value));
        }

        foreach ($value as $k => $v) {
            if (!\is_string($k)) {
                if ($default !== Undefined::value) {
                    return $default;
                }

                throw $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'non-empty-array<string, mixed>|null', $value));
            }
        }

        /** @phpstan-ignore-next-line */
        return $value;
    }

    /**
     * @template B
     *
     * @param callable(mixed): B $callback
     * @param Undefined|non-empty-array<string, B>|null $default
     *
     * @return non-empty-array<string, B>|null
     */
    public static function nullableNonEmptyStringArrayOf(mixed $value, callable $callback, Undefined|array|null $default = Undefined::value, \Throwable|null $throwable = null): array|null
    {
        if ($value === null) {
            return $value;
        }

        if (!\is_array($value)) {
            if ($default !== Undefined::value) {
                return $default;
            }

            throw $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'non-empty-array<string, mixed>|null', $value));
        }

        if ($value === []) {
            if ($default !== Undefined::value) {
                return $default;
            }

            throw $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'non-empty-array<string, mixed>|null', $value));
        }

        foreach ($value as $k => $v) {
            if (!\is_string($k)) {
                if ($default !== Undefined::value) {
                    return $default;
                }

                throw $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'non-empty-array<string, mixed>|null', $value));
            }

            $expected = $callback($v);

            if ($v !== $expected) {
                if ($default !== Undefined::value) {
                    return $default;
                }

                throw new \UnexpectedValueException(Errorf::unexpectedValue('iterable value', Debugf::type($expected), $v));
            }
        }

        /** @phpstan-ignore-next-line */
        return $value;
    }

    /**
     * @param Undefined|non-falsy-string|null $default
     *
     * @return non-falsy-string|null
     */
    public static function nullableNonFalsyString(mixed $value, Undefined|string|null $default = Undefined::value, \Throwable|null $throwable = null): string|null
    {
        if ($value === null || \is_string($value) && (bool) $value) {
            /** @phpstan-ignore-next-line */
            return $value;
        }

        $parsed = \filter_var($value);

        if ($parsed !== false && (bool) $parsed) {
            /** @phpstan-ignore-next-line */
            return $parsed;
        }

        if ($default !== Undefined::value) {
            return $default;
        }

        throw $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'non-falsy-string', $value));
    }

    /**
     * @param Undefined|non-negative-int|null $default
     *
     * @return non-negative-int|null
     */
    public static function nullableNonNegativeInt(mixed $value, Undefined|int|null $default = Undefined::value, \Throwable|null $throwable = null): int|null
    {
        if ($value === null || \is_int($value) && $value >= 0) {
            return $value;
        }

        $parsed = \filter_var($value, \FILTER_VALIDATE_INT);

        if ($parsed !== false && $parsed >= 0) {
            return $parsed;
        }

        if ($default !== Undefined::value) {
            return $default;
        }

        throw $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'non-negative-int|null', $value));
    }

    /**
     * @param Undefined|non-positive-int|null $default
     *
     * @return non-positive-int|null
     */
    public static function nullableNonPositiveInt(mixed $value, Undefined|int|null $default = Undefined::value, \Throwable|null $throwable = null): int|null
    {
        if ($value === null || \is_int($value) && $value <= 0) {
            return $value;
        }

        $parsed = \filter_var($value, \FILTER_VALIDATE_INT);

        if ($parsed !== false && $parsed <= 0) {
            return $parsed;
        }

        if ($default !== Undefined::value) {
            return $default;
        }

        throw $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'non-positive-int|null', $value));
    }

    /**
     * @param Undefined|non-zero-int|null $default
     *
     * @return non-zero-int|null
     */
    public static function nullableNonZeroInt(mixed $value, Undefined|int|null $default = Undefined::value, \Throwable|null $throwable = null): int|null
    {
        if ($value === null || \is_int($value) && $value !== 0) {
            return $value;
        }

        $parsed = \filter_var($value, \FILTER_VALIDATE_INT);

        if ($parsed !== false && $parsed !== 0) {
            return $parsed;
        }

        if ($default !== Undefined::value) {
            return $default;
        }

        throw $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'non-zero-int|null', $value));
    }

    /**
     * @param Undefined|numeric|null $default
     *
     * @return numeric|null
     */
    public static function nullableNumeric(mixed $value, Undefined|float|int|string|null $default = Undefined::value, \Throwable|null $throwable = null): float|int|string|null
    {
        if ($value === null) {
            return $value;
        }

        $parsed = \filter_var($value, \FILTER_VALIDATE_INT);

        if ($parsed !== false) {
            return $parsed;
        }

        $parsed = \filter_var($value, \FILTER_VALIDATE_FLOAT);

        if ($parsed !== false) {
            return $parsed;
        }

        $parsed = \filter_var($value);

        if ($parsed !== false && \is_numeric($parsed)) {
            return $parsed;
        }

        if ($default !== Undefined::value) {
            return $default;
        }

        throw $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'numeric', $value));
    }

    /**
     * @param Undefined|numeric-string|null $default
     *
     * @return numeric-string|null
     */
    public static function nullableNumericString(mixed $value, Undefined|string|null $default = Undefined::value, \Throwable|null $throwable = null): string|null
    {
        if ($value === null || \is_string($value) && \is_numeric($value)) {
            return $value;
        }

        $parsed = \filter_var($value);

        if ($parsed !== false && \is_numeric($parsed)) {
            return $parsed;
        }

        if ($default !== Undefined::value) {
            return $default;
        }

        throw $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'numeric-string', $value));
    }

    /**
     * @param Undefined|object|null $default
     */
    public static function nullableObject(mixed $value, object|null $default = Undefined::value, \Throwable|null $throwable = null): object|null
    {
        if ($value === null || \is_object($value)) {
            return $value;
        }

        if ($default !== Undefined::value) {
            return $default;
        }

        throw $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'object|null', $value));
    }

    /**
     * @param Undefined|open-resource|null $default
     *
     * @return open-resource|null
     */
    public static function nullableOpenResource(mixed $value, mixed $default = Undefined::value, \Throwable|null $throwable = null): mixed
    {
        if ($value === null || \is_resource($value)) {
            return $value;
        }

        if ($default !== Undefined::value) {
            return $default;
        }

        throw $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'open-resource|null', $value));
    }

    /**
     * @param Undefined|positive-int|null $default
     *
     * @return positive-int|null
     */
    public static function nullablePositiveInt(mixed $value, Undefined|int|null $default = Undefined::value, \Throwable|null $throwable = null): int|null
    {
        if ($value === null || \is_int($value) && $value > 0) {
            return $value;
        }

        $parsed = \filter_var($value, \FILTER_VALIDATE_INT);

        if ($parsed !== false && $parsed > 0) {
            return $parsed;
        }

        if ($default !== Undefined::value) {
            return $default;
        }

        throw $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'positive-int|null', $value));
    }

    /**
     * @param Undefined|resource|null $default
     *
     * @return resource|null
     */
    public static function nullableResource(mixed $value, mixed $default = Undefined::value, \Throwable|null $throwable = null): mixed
    {
        if ($value === null || \is_resource($value) || (!\is_scalar($value) && !\is_array($value) && !\is_object($value))) {
            /** @phpstan-ignore-next-line */
            return $value;
        }

        if ($default !== Undefined::value) {
            return $default;
        }

        throw $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'resource|null', $value));
    }

    /**
     * @param Undefined|scalar|null $default
     *
     * @return scalar|null
     */
    public static function nullableScalar(mixed $value, Undefined|bool|float|int|string|null $default = Undefined::value, \Throwable|null $throwable = null): bool|float|int|string|null
    {
        if ($value === null) {
            return $value;
        }

        $parsed = \filter_var($value, \FILTER_VALIDATE_INT);

        if ($parsed !== false) {
            return $parsed;
        }

        $parsed = \filter_var($value, \FILTER_VALIDATE_FLOAT);

        if ($parsed !== false) {
            return $parsed;
        }

        $parsed = \filter_var($value, \FILTER_VALIDATE_BOOLEAN, \FILTER_NULL_ON_FAILURE);

        if ($parsed !== null) {
            return $parsed;
        }

        $parsed = \filter_var($value);

        if ($parsed !== false) {
            return $parsed;
        }

        if ($default !== Undefined::value) {
            return $default;
        }

        throw $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'scalar|null', $value));
    }

    public static function nullableString(mixed $value, Undefined|string|null $default = Undefined::value, \Throwable|null $throwable = null): string|null
    {
        if ($value === null || \is_string($value)) {
            return $value;
        }

        $parsed = \filter_var($value);

        if ($parsed !== false) {
            return $parsed;
        }

        if ($default !== Undefined::value) {
            return $default;
        }

        throw $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'string|null', $value));
    }

    /**
     * @param Undefined|array<string, mixed>|null $default
     *
     * @return array<string, mixed>|null
     */
    public static function nullableStringArray(mixed $value, Undefined|array|null $default = Undefined::value, \Throwable|null $throwable = null): array|null
    {
        if ($value === null) {
            return $value;
        }

        if (!\is_array($value)) {
            if ($default !== Undefined::value) {
                return $default;
            }

            throw $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'array<string, mixed>|null', $value));
        }

        foreach ($value as $k => $v) {
            if (!\is_string($k)) {
                if ($default !== Undefined::value) {
                    return $default;
                }

                throw $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'array<string, mixed>|null', $value));
            }
        }

        /** @phpstan-ignore-next-line */
        return $value;
    }

    /**
     * @template B
     *
     * @param callable(mixed): B $callback
     * @param Undefined|array<string, B>|null $default
     *
     * @return array<string, B>|null
     */
    public static function nullableStringArrayOf(mixed $value, callable $callback, Undefined|array|null $default = Undefined::value, \Throwable|null $throwable = null): array|null
    {
        if ($value === null) {
            return $value;
        }

        if (!\is_array($value)) {
            if ($default !== Undefined::value) {
                return $default;
            }

            throw $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'array<string, mixed>|null', $value));
        }

        foreach ($value as $k => $v) {
            if (!\is_string($k)) {
                if ($default !== Undefined::value) {
                    return $default;
                }

                throw $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'array<string, mixed>|null', $value));
            }

            $expected = $callback($v);

            if ($v !== $expected) {
                if ($default !== Undefined::value) {
                    return $default;
                }

                throw new \UnexpectedValueException(Errorf::unexpectedValue('iterable value', Debugf::type($expected), $v));
            }
        }

        /** @phpstan-ignore-next-line */
        return $value;
    }

    /**
     * @template B of \BackedEnum
     *
     * @param class-string<B> $enum
     */
    public static function nullableStringEnum(mixed $value, string $enum, \BackedEnum|Undefined|null $default = Undefined::value, \Throwable|null $throwable = null): \BackedEnum|null
    {
        if ($value === null || $value instanceof $enum) {
            return $value;
        }

        $parsed = \filter_var($value);

        if ($parsed !== false) {
            $tried = $enum::tryFrom($parsed);

            if ($tried !== null) {
                return $tried;
            }
        }

        if ($default !== Undefined::value) {
            return $default;
        }

        throw $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', "{$enum}|null", $value));
    }

    /**
     * @param Undefined|iterable<string, mixed>|null $default
     *
     * @return iterable<string, mixed>|null
     */
    public static function nullableStringIterable(mixed $value, Undefined|iterable|null $default = Undefined::value, \Throwable|null $throwable = null): iterable|null
    {
        if ($value === null) {
            return $value;
        }

        if (!\is_iterable($value)) {
            if ($default !== Undefined::value) {
                return $default;
            }

            throw $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'iterable<string, mixed>|null', $value));
        }

        foreach ($value as $k => $v) {
            if (!\is_string($k)) {
                if ($default !== Undefined::value) {
                    return $default;
                }

                throw $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'iterable<string, mixed>|null', $value));
            }
        }

        /** @phpstan-ignore-next-line */
        return $value;
    }

    /**
     * @template B
     *
     * @param callable(mixed): B $callback
     * @param Undefined|iterable<string, B>|null $default
     *
     * @return iterable<string, B>|null
     */
    public static function nullableStringIterableOf(mixed $value, callable $callback, Undefined|iterable|null $default = Undefined::value, \Throwable|null $throwable = null): iterable|null
    {
        if ($value === null) {
            return $value;
        }

        if (!\is_iterable($value)) {
            if ($default !== Undefined::value) {
                return $default;
            }

            throw $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'iterable<string, mixed>|null', $value));
        }

        foreach ($value as $k => $v) {
            if (!\is_string($k)) {
                if ($default !== Undefined::value) {
                    return $default;
                }

                throw $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'iterable<string, mixed>|null', $value));
            }

            $expected = $callback($v);

            if ($v !== $expected) {
                if ($default !== Undefined::value) {
                    return $default;
                }

                throw new \UnexpectedValueException(Errorf::unexpectedValue('iterable value', Debugf::type($expected), $v));
            }
        }

        /** @phpstan-ignore-next-line */
        return $value;
    }

    /**
     * @param \Stringable|Undefined|scalar|null $default
     *
     * @return \Stringable|scalar|null
     */
    public static function nullableStringable(mixed $value, \Stringable|Undefined|bool|float|int|string|null $default = Undefined::value, \Throwable|null $throwable = null): \Stringable|bool|float|int|string|null
    {
        if ($value === null || $value instanceof \Stringable) {
            return $value;
        }

        $parsed = \filter_var($value, \FILTER_VALIDATE_INT);

        if ($parsed !== false) {
            return $parsed;
        }

        $parsed = \filter_var($value, \FILTER_VALIDATE_FLOAT);

        if ($parsed !== false) {
            return $parsed;
        }

        $parsed = \filter_var($value, \FILTER_VALIDATE_BOOLEAN, \FILTER_NULL_ON_FAILURE);

        if ($parsed !== null) {
            return $parsed;
        }

        $parsed = \filter_var($value);

        if ($parsed !== false) {
            return $parsed;
        }

        if ($default !== Undefined::value) {
            return $default;
        }

        throw $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'stringable|null', $value));
    }

    /**
     * @param Undefined|trait-string|null $default
     *
     * @return trait-string|null
     */
    public static function nullableTraitString(mixed $value, Undefined|string|null $default = Undefined::value, \Throwable|null $throwable = null): string|null
    {
        if ($value === null || \is_string($value) && \trait_exists($value)) {
            return $value;
        }

        $parsed = \filter_var($value);

        if ($parsed !== false && \trait_exists($parsed)) {
            return $parsed;
        }

        if ($default !== Undefined::value) {
            return $default;
        }

        throw $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'trait-string|null', $value));
    }

    public static function nullableTrue(mixed $value, Undefined|true|null $default = Undefined::value, \Throwable|null $throwable = null): true|null
    {
        if ($value === null || $value === true) {
            return $value;
        }

        $parsed = \filter_var($value, \FILTER_VALIDATE_BOOLEAN, \FILTER_NULL_ON_FAILURE);

        if ($parsed === true) {
            return true;
        }

        if ($default !== Undefined::value) {
            return $default;
        }

        throw $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'true|null', $value));
    }

    /**
     * @param Undefined|numeric $default
     *
     * @return numeric
     */
    public static function numeric(mixed $value, Undefined|float|int|string $default = Undefined::value, \Throwable|null $throwable = null): float|int|string
    {
        if (\is_numeric($value)) {
            return $value;
        }

        $parsed = \filter_var($value, \FILTER_VALIDATE_INT);

        if ($parsed !== false) {
            return $parsed;
        }

        $parsed = \filter_var($value, \FILTER_VALIDATE_FLOAT);

        if ($parsed !== false) {
            return $parsed;
        }

        $parsed = \filter_var($value);

        if ($parsed !== false && \is_numeric($parsed)) {
            return $parsed;
        }

        if ($default !== Undefined::value) {
            return $default;
        }

        throw $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'numeric', $value));
    }

    /**
     * @param Undefined|numeric-string $default
     *
     * @return numeric-string
     */
    public static function numericString(mixed $value, Undefined|string $default = Undefined::value, \Throwable|null $throwable = null): string
    {
        if (\is_string($value) && \is_numeric($value)) {
            return $value;
        }

        $parsed = \filter_var($value);

        if ($parsed !== false && \is_numeric($parsed)) {
            return $parsed;
        }

        if ($default !== Undefined::value) {
            return $default;
        }

        throw $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'numeric-string', $value));
    }

    /**
     * @param Undefined|object $default
     */
    public static function object(mixed $value, object $default = Undefined::value, \Throwable|null $throwable = null): object
    {
        if (\is_object($value)) {
            return $value;
        }

        if ($default !== Undefined::value) {
            return $default;
        }

        throw $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'object', $value));
    }

    /**
     * @param Undefined|open-resource $default
     *
     * @return open-resource
     */
    public static function openResource(mixed $value, mixed $default = Undefined::value, \Throwable|null $throwable = null): mixed
    {
        if (\is_resource($value)) {
            return $value;
        }

        if ($default !== Undefined::value) {
            return $default;
        }

        throw $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'open-resource', $value));
    }

    /**
     * @param Undefined|positive-int $default
     *
     * @return positive-int
     */
    public static function positiveInt(mixed $value, Undefined|int $default = Undefined::value, \Throwable|null $throwable = null): int
    {
        if (\is_int($value) && $value > 0) {
            return $value;
        }

        $parsed = \filter_var($value, \FILTER_VALIDATE_INT);

        if ($parsed !== false && $parsed > 0) {
            return $parsed;
        }

        if ($default !== Undefined::value) {
            return $default;
        }

        throw $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'positive-int', $value));
    }

    /**
     * @param Undefined|resource $default
     *
     * @return resource
     */
    public static function resource(mixed $value, mixed $default = Undefined::value, \Throwable|null $throwable = null): mixed
    {
        if (\is_resource($value) || ($value !== null && !\is_scalar($value) && !\is_array($value) && !\is_object($value))) {
            /** @phpstan-ignore-next-line */
            return $value;
        }

        if ($default !== Undefined::value) {
            return $default;
        }

        throw $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'resource', $value));
    }

    /**
     * @param Undefined|scalar $default
     *
     * @return scalar
     */
    public static function scalar(mixed $value, Undefined|bool|float|int|string $default = Undefined::value, \Throwable|null $throwable = null): bool|float|int|string
    {
        $parsed = \filter_var($value, \FILTER_VALIDATE_INT);

        if ($parsed !== false) {
            return $parsed;
        }

        $parsed = \filter_var($value, \FILTER_VALIDATE_FLOAT);

        if ($parsed !== false) {
            return $parsed;
        }

        $parsed = \filter_var($value, \FILTER_VALIDATE_BOOLEAN, \FILTER_NULL_ON_FAILURE);

        if ($parsed !== null) {
            return $parsed;
        }

        $parsed = \filter_var($value);

        if ($parsed !== false) {
            return $parsed;
        }

        if ($default !== Undefined::value) {
            return $default;
        }

        throw $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'scalar', $value));
    }

    public static function string(mixed $value, Undefined|string $default = Undefined::value, \Throwable|null $throwable = null): string
    {
        if (\is_string($value)) {
            return $value;
        }

        $parsed = \filter_var($value);

        if ($parsed !== false) {
            return $parsed;
        }

        if ($default !== Undefined::value) {
            return $default;
        }

        throw $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'string', $value));
    }

    /**
     * @param Undefined|array<string, mixed> $default
     *
     * @return array<string, mixed>
     */
    public static function stringArray(mixed $value, Undefined|array $default = Undefined::value, \Throwable|null $throwable = null): array
    {
        if (!\is_array($value)) {
            if ($default !== Undefined::value) {
                return $default;
            }

            throw $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'array<string, mixed>', $value));
        }

        foreach ($value as $k => $v) {
            if (!\is_string($k)) {
                if ($default !== Undefined::value) {
                    return $default;
                }

                throw $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'array<string, mixed>', $value));
            }
        }

        /** @phpstan-ignore-next-line */
        return $value;
    }

    /**
     * @template B
     *
     * @param callable(mixed): B $callback
     * @param Undefined|array<string, B> $default
     *
     * @return array<string, B>
     */
    public static function stringArrayOf(mixed $value, callable $callback, Undefined|array $default = Undefined::value, \Throwable|null $throwable = null): array
    {
        if (!\is_array($value)) {
            if ($default !== Undefined::value) {
                return $default;
            }

            throw $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'array<string, mixed>', $value));
        }

        foreach ($value as $k => $v) {
            if (!\is_string($k)) {
                if ($default !== Undefined::value) {
                    return $default;
                }

                throw $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'array<string, mixed>', $value));
            }

            $expected = $callback($v);

            if ($v !== $expected) {
                if ($default !== Undefined::value) {
                    return $default;
                }

                throw new \UnexpectedValueException(Errorf::unexpectedValue('iterable value', Debugf::type($expected), $v));
            }
        }

        /** @phpstan-ignore-next-line */
        return $value;
    }

    /**
     * @template B of \BackedEnum
     *
     * @param class-string<B> $enum
     */
    public static function stringEnum(mixed $value, string $enum, \BackedEnum|Undefined $default = Undefined::value, \Throwable|null $throwable = null): \BackedEnum
    {
        if ($value instanceof $enum) {
            return $value;
        }

        $parsed = \filter_var($value);

        if ($parsed !== false) {
            $tried = $enum::tryFrom($parsed);

            if ($tried !== null) {
                return $tried;
            }
        }

        if ($default !== Undefined::value) {
            return $default;
        }

        throw $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', $enum, $value));
    }

    /**
     * @param Undefined|iterable<string, mixed> $default
     *
     * @return iterable<string, mixed>
     */
    public static function stringIterable(mixed $value, Undefined|iterable $default = Undefined::value, \Throwable|null $throwable = null): iterable
    {
        if (!\is_iterable($value)) {
            if ($default !== Undefined::value) {
                return $default;
            }

            throw $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'iterable<string, mixed>', $value));
        }

        foreach ($value as $k => $v) {
            if (!\is_string($k)) {
                if ($default !== Undefined::value) {
                    return $default;
                }

                throw $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'iterable<string, mixed>', $value));
            }
        }

        /** @phpstan-ignore-next-line */
        return $value;
    }

    /**
     * @template B
     *
     * @param callable(mixed): B $callback
     * @param Undefined|iterable<string, B> $default
     *
     * @return iterable<string, B>
     */
    public static function stringIterableOf(mixed $value, callable $callback, Undefined|iterable $default = Undefined::value, \Throwable|null $throwable = null): iterable
    {
        if (!\is_iterable($value)) {
            if ($default !== Undefined::value) {
                return $default;
            }

            throw $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'iterable<string, mixed>', $value));
        }

        foreach ($value as $k => $v) {
            if (!\is_string($k)) {
                if ($default !== Undefined::value) {
                    return $default;
                }

                throw $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'iterable<string, mixed>', $value));
            }
            $expected = $callback($v);

            if ($v !== $expected) {
                if ($default !== Undefined::value) {
                    return $default;
                }

                throw new \UnexpectedValueException(Errorf::unexpectedValue('iterable value', Debugf::type($expected), $v));
            }
        }

        /** @phpstan-ignore-next-line */
        return $value;
    }

    /**
     * @param \Stringable|Undefined|scalar $default
     *
     * @return \Stringable|scalar
     */
    public static function stringable(mixed $value, \Stringable|Undefined|bool|float|int|string $default = Undefined::value, \Throwable|null $throwable = null): \Stringable|bool|float|int|string
    {
        if ($value instanceof \Stringable) {
            return $value;
        }

        $parsed = \filter_var($value, \FILTER_VALIDATE_INT);

        if ($parsed !== false) {
            return $parsed;
        }

        $parsed = \filter_var($value, \FILTER_VALIDATE_FLOAT);

        if ($parsed !== false) {
            return $parsed;
        }

        $parsed = \filter_var($value, \FILTER_VALIDATE_BOOLEAN, \FILTER_NULL_ON_FAILURE);

        if ($parsed !== null) {
            return $parsed;
        }

        $parsed = \filter_var($value);

        if ($parsed !== false) {
            return $parsed;
        }

        if ($default !== Undefined::value) {
            return $default;
        }

        throw $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'stringable', $value));
    }

    /**
     * @param Undefined|trait-string $default
     *
     * @return trait-string
     */
    public static function traitString(mixed $value, Undefined|string $default = Undefined::value, \Throwable|null $throwable = null): string
    {
        if (\is_string($value) && \trait_exists($value)) {
            return $value;
        }

        $parsed = \filter_var($value);

        if ($parsed !== false && \trait_exists($parsed)) {
            return $parsed;
        }

        if ($default !== Undefined::value) {
            return $default;
        }

        throw $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'trait-string', $value));
    }

    public static function true(mixed $value, Undefined|true $default = Undefined::value, \Throwable|null $throwable = null): true
    {
        if ($value === true) {
            return $value;
        }

        $parsed = \filter_var($value, \FILTER_VALIDATE_BOOLEAN, \FILTER_NULL_ON_FAILURE);

        if ($parsed === true) {
            return true;
        }

        if ($default !== Undefined::value) {
            return $default;
        }

        throw $throwable ?? new \InvalidArgumentException(Errorf::invalidArgument('value', 'true', $value));
    }
}
