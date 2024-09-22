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

namespace Premierstacks\PhpStack\Debug;

class Errorf
{
    /**
     * @param iterable<int|string, mixed>|string $wanted
     * @param iterable<int|string, mixed> $context
     */
    public static function invalidArgument(string $param, mixed $got, iterable|string $wanted, iterable $context = [], \Throwable|string|null $previous = null): string
    {
        return Debugf::message(\sprintf('Invalid argument [%s] provided, got [%s], wanted [%s].', $param, Debugf::type($got), Debugf::union($wanted)), $context, $previous);
    }

    /**
     * @param iterable<int|string, mixed> $context
     */
    public static function invalidKey(string $key, iterable $context = [], \Throwable|string|null $previous = null): string
    {
        return Debugf::message(\sprintf('Invalid or missing key [%s] provided.', $key), $context, $previous);
    }

    /**
     * @param iterable<int|string, mixed> $context
     */
    public static function invalidTargetKey(string $key, mixed $target, iterable $context = [], \Throwable|string|null $previous = null): string
    {
        return Debugf::message(\sprintf('Invalid or missing key [%s] provided for [%s].', $key, Debugf::type($target)), $context, $previous);
    }

    /**
     * @param iterable<int|string, mixed>|string $wanted
     * @param iterable<int|string, mixed> $context
     */
    public static function notImplemented(mixed $got, iterable|string $wanted, iterable $context = [], \Throwable|string|null $previous = null): string
    {
        return Debugf::message(\sprintf('Feature not implemented, got [%s], wanted [%s]', Debugf::type($got), Debugf::union($wanted)), $context, $previous);
    }

    /**
     * @param iterable<int|string, mixed> $args
     * @param iterable<int|string, mixed> $context
     */
    public static function unexpectedCallableError(string $callable, iterable $args, iterable $context = [], \Throwable|string|null $previous = null): string
    {
        return Debugf::message(\sprintf('Unexpected error returned from [%s%s].', $callable, Debugf::args($args)), $context, $previous);
    }

    /**
     * @param iterable<int|string, mixed> $args
     * @param iterable<int|string, mixed>|string $wanted
     * @param iterable<int|string, mixed> $context
     */
    public static function unexpectedCallableReturn(string $callable, iterable $args, mixed $got, iterable|string $wanted, iterable $context = [], \Throwable|string|null $previous = null): string
    {
        return Debugf::message(\sprintf('Unexpected value returned from [%s%s], got [%s], wanted [%s].', $callable, Debugf::args($args), Debugf::type($got), Debugf::union($wanted)), $context, $previous);
    }

    /**
     * @param iterable<int|string, mixed>|string $wanted
     * @param iterable<int|string, mixed> $context
     */
    public static function unexpectedValue(mixed $got, iterable|string $wanted, iterable $context = [], \Throwable|string|null $previous = null): string
    {
        return Debugf::message(\sprintf('Unexpected value, got [%s], wanted [%s].', Debugf::type($got), Debugf::union($wanted)), $context, $previous);
    }

    /**
     * @param iterable<int|string, mixed>|string $wanted
     * @param iterable<int|string, mixed> $context
     */
    public static function unexpectedVariableValue(string $variable, mixed $got, iterable|string $wanted, iterable $context = [], \Throwable|string|null $previous = null): string
    {
        return Debugf::message(\sprintf('Unexpected variable [%s] value, got [%s], wanted [%s].', $variable, Debugf::type($got), Debugf::union($wanted)), $context, $previous);
    }
}
