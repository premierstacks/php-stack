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
