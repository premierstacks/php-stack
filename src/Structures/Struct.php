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
