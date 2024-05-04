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

namespace Premierstacks\PhpUtil\Structures;

use Premierstacks\PhpUtil\Debug\Errorf;
use Premierstacks\PhpUtil\Enums\Undefined;

class Structs
{
    /**
     * @param array<array-key, array-key> $keys
     */
    public static function get(mixed $target, array $keys = [], mixed $default = Undefined::value): mixed
    {
        foreach ($keys as $key) {
            if (\is_array($target) && \array_key_exists($key, $target)) {
                $target = $target[$key];

                continue;
            }

            if ($target instanceof \ArrayAccess && $target->offsetExists($key)) {
                $target = $target[$key];

                continue;
            }

            if (\is_object($target) && \property_exists($target, (string) $key)) {
                /** @phpstan-ignore-next-line */
                $target = $target->{$key};

                continue;
            }

            if (\is_iterable($target)) {
                foreach ($target as $k => $v) {
                    if ($k === $key) {
                        $target = $v;

                        continue 2;
                    }
                }
            }

            if ($default !== Undefined::value) {
                return $default;
            }

            throw new \UnexpectedValueException(Errorf::unexpectedValue('key', 'array-key', $key));
        }

        return $target;
    }

    /**
     * @param array<array-key, array-key> $keys
     */
    public static function set(mixed &$target, array $keys, mixed $value, bool $overwrite = true, bool $reformat = true): void
    {
        $key = \array_shift($keys);

        if ($key === null) {
            return;
        }

        if (!\is_array($target) && !\is_object($target) && $reformat) {
            $target = new \ArrayObject();
        }

        if (\is_array($target)) {
            if ($keys !== []) {
                if (!\array_key_exists($key, $target)) {
                    $target[$key] = new \ArrayObject();
                }

                static::set($target[$key], $keys, $value, $overwrite, $reformat);
            } elseif ($overwrite || !\array_key_exists($key, $target)) {
                $target[$key] = $value;
            }
        } elseif ($target instanceof \ArrayAccess) {
            if ($keys !== []) {
                if (!$target->offsetExists($key)) {
                    $target[$key] = new \ArrayObject();
                }

                static::set($target[$key], $keys, $value, $overwrite, $reformat);
            } elseif ($overwrite || !$target->offsetExists($key)) {
                $target[$key] = $value;
            }
        } elseif (\is_object($target)) {
            if ($keys !== []) {
                if (!\property_exists($target, (string) $key)) {
                    // @phpstan-ignore-next-line
                    $target->{$key} = new \ArrayObject();
                }

                // @phpstan-ignore-next-line
                static::set($target->{$key}, $keys, $value, $overwrite, $reformat);
            } elseif ($overwrite || !\property_exists($target, (string) $key)) {
                // @phpstan-ignore-next-line
                $target->{$key} = $value;
            }
        } else {
            throw new \InvalidArgumentException(Errorf::invalidArgument('target', 'iterable|object', $target));
        }
    }
}
