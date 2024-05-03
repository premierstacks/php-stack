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
 * The Proprietor: Tomáš Chochola
 * - Role: The Creator, Proprietor & Project Visionary
 * - Email: chocholatom1997@gmail.com
 * - GitHub: https://github.com/tomchochola
 * - Sponsor & License: https://github.com/sponsors/tomchochola
 */

declare(strict_types=1);

namespace Premierstacks\PhpUtil\Encoding;

use Premierstacks\PhpUtil\IO\ResourceObject;
use Premierstacks\PhpUtil\Support\Resources;

class Csv
{
    /**
     * @param iterable<int|string, array<int|string, scalar|null>> $data
     */
    public static function encode(iterable $data, string $separator = ',', string $enclosure = '"', string $escape = '\\', string $eol = \PHP_EOL): string
    {
        $resource = new ResourceObject(Resources::temp());

        foreach ($data as $v) {
            $resource->fputcsv($v, $separator, $enclosure, $escape, $eol);
        }

        return $resource->streamGetContents(null, 0);
    }
}
