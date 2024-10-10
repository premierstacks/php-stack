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

namespace Premierstacks\PhpStack\Types;

use Premierstacks\PhpStack\Debug\Errorf;

class Files
{
    public static function tempnamp(string|null $directory, string $prefix = 'php'): string
    {
        $filename = \tempnam($directory ?? \sys_get_temp_dir(), $prefix);

        if ($filename === false) {
            throw new \UnexpectedValueException(Errorf::unexpectedCallableError('tempnam', [$directory ?? \sys_get_temp_dir(), $prefix]));
        }

        return $filename;
    }
}
