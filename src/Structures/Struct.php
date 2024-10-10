<?php

/**
 * @author Tomáš Chochola <chocholatom1997@gmail.com>
 * @copyright © 2024–Present Tomáš Chochola <chocholatom1997@gmail.com>. All rights reserved.
 *
 * @license
 *
 * This software is proprietary and licensed under specific terms set by its owner.
 * Any form of access, use, or distribution requires a valid and active license.
 * For full licensing terms, refer to the LICENSE.md file accompanying this software.
 *
 * @see {@link https://premierstacks.com} Website
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
