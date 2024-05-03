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

namespace Premierstacks\PhpUtil\Debug;

class Errorf
{
    /**
     * @param iterable<int|string, mixed> $args
     */
    public static function errorReturn(string|null $callable = null, iterable $args = [], string|null $previous = null): string
    {
        $chunks = [];

        if ($previous !== null) {
            $previous = ": {$previous}";
        }

        if ($callable === null) {
            $chunks[] = 'unexpected error value occurred';
        } else {
            $chunks[] = \sprintf('unexpected error value occurred from "%s(%s)"', $callable, Debugf::args($args));
        }

        return \implode(', ', $chunks) . $previous;
    }

    public static function invalidArgument(string|null $argument = null, string|null $expected = null, mixed $received = null, string|null $previous = null): string
    {
        $chunks = [];

        if ($previous !== null) {
            $previous = ": {$previous}";
        }

        if ($argument === null) {
            $chunks[] = 'invalid argument received';
        } else {
            $chunks[] = \sprintf('invalid argument "%s" received', $argument);
        }

        if ($expected !== null) {
            $chunks[] = \sprintf('expected "%s"', $expected);
        }

        if ($received !== null) {
            $chunks[] = \sprintf('received "%s"', Debugf::type($received));
        }

        return \implode(', ', $chunks) . $previous;
    }

    /**
     * @param iterable<int|string, mixed> $args
     */
    public static function unexpectedReturn(string|null $callable = null, iterable $args = [], string|null $expected = null, mixed $received = null, string|null $previous = null): string
    {
        $chunks = [];

        if ($previous !== null) {
            $previous = ": {$previous}";
        }

        if ($callable === null) {
            $chunks[] = 'unexpected return value occurred';
        } else {
            $chunks[] = \sprintf('unexpected return value occurred from "%s(%s)"', $callable, Debugf::args($args));
        }

        if ($expected !== null) {
            $chunks[] = \sprintf('expected "%s"', $expected);
        }

        if ($received !== null) {
            $chunks[] = \sprintf('received "%s"', Debugf::type($received));
        }

        return \implode(', ', $chunks) . $previous;
    }

    public static function unexpectedValue(string|null $value = null, string|null $expected = null, mixed $received = null, string|null $previous = null): string
    {
        $chunks = [];

        if ($previous !== null) {
            $previous = ": {$previous}";
        }

        if ($value === null) {
            $chunks[] = 'unexpected value occurred';
        } else {
            $chunks[] = \sprintf('unexpected value "%s" occurred', $value);
        }

        if ($expected !== null) {
            $chunks[] = \sprintf('expected "%s"', $expected);
        }

        if ($received !== null) {
            $chunks[] = \sprintf('received "%s"', Debugf::type($received));
        }

        return \implode(', ', $chunks) . $previous;
    }
}
