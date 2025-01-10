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

namespace Premierstacks\PhpStack\Structures;

use Premierstacks\PhpStack\Enums\Undefined;

class Struct
{
    public function __construct(public mixed $data = []) {}

    /**
     * @param array<array-key, array-key> $keys
     */
    public function get(array $keys = [], mixed $default = Undefined::value): mixed
    {
        return Structs::get($this->data, $keys, $default);
    }

    /**
     * @param array<array-key, array-key> $keys
     */
    public function set(array $keys, mixed $value, bool $overwrite = true, bool $reformat = true): void
    {
        Structs::set($this->data, $keys, $value, $overwrite, $reformat);
    }
}
