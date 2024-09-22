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

namespace Premierstacks\PhpStack\Structures;

use Premierstacks\PhpStack\Debug\Errorf;
use Premierstacks\PhpStack\Enums\Undefined;

class Structs
{
    /**
     * @param array<array-key, array-key> $keys
     */
    public static function get(mixed $target, array $keys = [], mixed $default = Undefined::value): mixed
    {
        foreach ($keys as $key => $value) {
            if (\is_array($target) && \array_key_exists($value, $target)) {
                $target = $target[$value];

                continue;
            }

            if ($target instanceof \ArrayAccess && $target->offsetExists($value)) {
                $target = $target[$value];

                continue;
            }

            if (\is_object($target) && \property_exists($target, (string) $value)) {
                /** @phpstan-ignore-next-line */
                $target = $target->{$value};

                continue;
            }

            if (\is_iterable($target)) {
                foreach ($target as $k => $v) {
                    if ($k === $value) {
                        $target = $v;

                        continue 2;
                    }
                }
            }

            if ($default !== Undefined::value) {
                return $default;
            }

            throw new \UnexpectedValueException(Errorf::unexpectedVariableValue((string) $key, $value, 'array-key'));
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
            throw new \InvalidArgumentException(Errorf::invalidArgument('target', $target, 'iterable|object'));
        }
    }
}
