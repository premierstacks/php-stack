<?php

/**
 * @author Tomáš Chochola <chocholatom1997@gmail.com>
 * @copyright © 2025 Tomáš Chochola <chocholatom1997@gmail.com>
 *
 * @license CC-BY-ND-4.0
 *
 * @see {@link https://creativecommons.org/licenses/by-nd/4.0/} License
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
