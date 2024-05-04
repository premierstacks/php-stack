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

class Errorf
{
    /**
     * @param iterable<int|string, mixed> $args
     * @param iterable<int|string, mixed> $context
     */
    public static function callableError(string $callable, iterable $args, iterable $context = [], \Throwable|string|null $previous = null): string
    {
        return Debugf::message(\sprintf('Error returned from "%s%s".', $callable, Debugf::args($args)), $context, $previous);
    }

    /**
     * @param iterable<int|string, mixed> $args
     * @param iterable<int|string, mixed>|string $wanted
     * @param iterable<int|string, mixed> $context
     */
    public static function callableReturn(string $callable, iterable $args, mixed $got, iterable|string $wanted, iterable $context = [], \Throwable|string|null $previous = null): string
    {
        return Debugf::message(\sprintf('Unexpected value returned from "%s%s", got "%s", wanted "%s".', $callable, Debugf::args($args), Debugf::type($got), Debugf::union($wanted)), $context, $previous);
    }

    /**
     * @param iterable<int|string, mixed>|string $wanted
     * @param iterable<int|string, mixed> $context
     */
    public static function invalidArgument(string $param, mixed $got, iterable|string $wanted, iterable $context = [], \Throwable|string|null $previous = null): string
    {
        return Debugf::message(\sprintf('Invalid argument "%s" provided, got "%s", wanted "%s".', $param, Debugf::type($got), Debugf::union($wanted)), $context, $previous);
    }

    /**
     * @param iterable<int|string, mixed> $context
     */
    public static function invalidKey(string $source, mixed $got, iterable $context = [], \Throwable|string|null $previous = null): string
    {
        return Debugf::message(\sprintf('Invalid or missing "%s" key provided, got "%s".', $source, Debugf::type($got)), $context, $previous);
    }

    /**
     * @param iterable<int|string, mixed>|string $wanted
     * @param iterable<int|string, mixed> $context
     */
    public static function notImplemented(string $where, mixed $got, iterable|string $wanted, iterable $context = [], \Throwable|string|null $previous = null): string
    {
        return Debugf::message(\sprintf('Feature not implemented on "%s", got "%s", wanted "%s"', $where, Debugf::type($got), Debugf::union($wanted)), $context, $previous);
    }

    /**
     * @param iterable<int|string, mixed>|string $wanted
     * @param iterable<int|string, mixed> $context
     */
    public static function unexpectedValue(string $where, mixed $got, iterable|string $wanted, iterable $context = [], \Throwable|string|null $previous = null): string
    {
        return Debugf::message(\sprintf('Unexpected value "%s", got "%s", wanted "%s".', $where, Debugf::type($got), Debugf::union($wanted)), $context, $previous);
    }
}
