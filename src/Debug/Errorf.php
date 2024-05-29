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
