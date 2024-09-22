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
