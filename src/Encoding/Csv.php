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

namespace Premierstacks\PhpStack\Encoding;

use Premierstacks\PhpStack\IO\ResourceObject;

class Csv
{
    /**
     * @param iterable<int|string, array<int|string, scalar|null>> $data
     */
    public static function encode(iterable $data, string $separator = ',', string $enclosure = '"', string $escape = '\\', string $eol = \PHP_EOL): string
    {
        $resource = ResourceObject::newFromString();

        foreach ($data as $v) {
            $resource->fputcsv($v, $separator, $enclosure, $escape, $eol);
        }

        return $resource->streamGetContents(null, 0);
    }
}
